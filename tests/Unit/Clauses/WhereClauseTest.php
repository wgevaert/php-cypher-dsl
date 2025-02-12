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

namespace WikibaseSolutions\CypherDSL\Tests\Unit\Clauses;

use PHPUnit\Framework\TestCase;
use WikibaseSolutions\CypherDSL\Clauses\WhereClause;
use WikibaseSolutions\CypherDSL\Tests\Unit\TestHelper;
use WikibaseSolutions\CypherDSL\Types\AnyType;

/**
 * @covers \WikibaseSolutions\CypherDSL\Clauses\WhereClause
 */
class WhereClauseTest extends TestCase
{
    use TestHelper;

    public function testEmptyClause(): void
    {
        $where = new WhereClause();

        $this->assertSame("", $where->toQuery());
        $this->assertNull($where->getExpression());
    }

    public function testExpression(): void
    {
        $where = new WhereClause();
        $expression = $this->getQueryConvertableMock(AnyType::class, "(a)");

        $where->setExpression($expression);

        $this->assertSame("WHERE (a)", $where->toQuery());
        $this->assertEquals($expression, $where->getExpression());
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testAcceptsAnyType(): void
    {
        $where = new WhereClause();
        $expression = $this->getQueryConvertableMock(AnyType::class, "(a)");

        $where->setExpression($expression);

        $where->toQuery();
    }
}
