<?php

/*
 * Cypher DSL
 * Copyright (C) 2021  Wikibase Solutions
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 */

namespace WikibaseSolutions\CypherDSL\Tests\Unit;

use PHPUnit\Framework\TestCase;
use TypeError;
use WikibaseSolutions\CypherDSL\Exponentiation;
use WikibaseSolutions\CypherDSL\Types\AnyType;
use WikibaseSolutions\CypherDSL\Types\PropertyTypes\NumeralType;

/**
 * @covers \WikibaseSolutions\CypherDSL\Exponentiation
 */
class ExponentiationTest extends TestCase
{
    use TestHelper;

    public function testToQuery(): void
    {
        $exponentiation = new Exponentiation($this->getQueryConvertableMock(NumeralType::class, "10"), $this->getQueryConvertableMock(NumeralType::class, "15"));

        $this->assertSame("(10 ^ 15)", $exponentiation->toQuery());

        $exponentiation = new Exponentiation($exponentiation, $exponentiation);

        $this->assertSame("((10 ^ 15) ^ (10 ^ 15))", $exponentiation->toQuery());
    }

    public function testToQueryNoParentheses(): void
    {
        $exponentiation = new Exponentiation($this->getQueryConvertableMock(NumeralType::class, "10"), $this->getQueryConvertableMock(NumeralType::class, "15"), false);

        $this->assertSame("10 ^ 15", $exponentiation->toQuery());

        $exponentiation = new Exponentiation($exponentiation, $exponentiation);

        $this->assertSame("(10 ^ 15 ^ 10 ^ 15)", $exponentiation->toQuery());
    }

    public function testDoesNotAcceptAnyTypeAsOperands(): void
    {
        $this->expectException(TypeError::class);

        $exponentiation = new Exponentiation($this->getQueryConvertableMock(AnyType::class, "10"), $this->getQueryConvertableMock(AnyType::class, "15"));

        $exponentiation->toQuery();
    }
}
