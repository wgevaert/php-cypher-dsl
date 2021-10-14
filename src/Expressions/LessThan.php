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

namespace WikibaseSolutions\CypherDSL\Expressions;

use WikibaseSolutions\CypherDSL\Expressions\Types\BooleanType;
use WikibaseSolutions\CypherDSL\Expressions\Types\NumeralType;

/**
 * Represents the application of the less than (<) operator.
 *
 * @see https://neo4j.com/docs/cypher-manual/current/syntax/operators/#query-operators-comparison
 */
class LessThan extends BinaryOperator implements BooleanType
{
    /**
     * @inheritDoc
     */
    public function __construct(NumeralType $left, NumeralType $right)
    {
        parent::__construct($left, $right);
    }

    /**
     * @inheritDoc
     */
    protected function getOperator(): string
    {
        return "<";
    }
}