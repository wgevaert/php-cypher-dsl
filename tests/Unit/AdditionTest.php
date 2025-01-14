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
use WikibaseSolutions\CypherDSL\Addition;
use WikibaseSolutions\CypherDSL\Types\AnyType;
use WikibaseSolutions\CypherDSL\Types\PropertyTypes\NumeralType;

/**
 * @covers \WikibaseSolutions\CypherDSL\Addition
 */
class AdditionTest extends TestCase
{
    use TestHelper;

    public function testToQuery(): void
    {
        $left = $this->getQueryConvertableMock(NumeralType::class, "10");
        $right = $this->getQueryConvertableMock(NumeralType::class, "15");
        $addition = new Addition($left, $right);

        $this->assertSame("(10 + 15)", $addition->toQuery());

        $this->assertEquals($left, $addition->getLeft());
        $this->assertEquals($right, $addition->getRight());

        $newAddition = new Addition($addition, $addition);

        $this->assertSame("((10 + 15) + (10 + 15))", $newAddition->toQuery());

        $this->assertTrue($newAddition->insertsParentheses());
        $this->assertEquals($addition, $newAddition->getLeft());
        $this->assertEquals($addition, $newAddition->getRight());

        $newAddition = new Addition($addition, $addition, false);

        $this->assertSame("(10 + 15) + (10 + 15)", $newAddition->toQuery());

        $this->assertFalse($newAddition->insertsParentheses());
        $this->assertEquals($addition, $newAddition->getLeft());
        $this->assertEquals($addition, $newAddition->getRight());
    }

    public function testDoesNotAcceptAnyTypeAsOperands(): void
    {
        $this->expectException(TypeError::class);

        $addition = new Addition($this->getQueryConvertableMock(AnyType::class, "10"), $this->getQueryConvertableMock(AnyType::class, "15"));

        $addition->toQuery();
    }
}
