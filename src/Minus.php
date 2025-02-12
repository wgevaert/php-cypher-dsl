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

namespace WikibaseSolutions\CypherDSL;

use WikibaseSolutions\CypherDSL\Traits\NumeralTypeTrait;
use WikibaseSolutions\CypherDSL\Types\PropertyTypes\NumeralType;

/**
 * This class represents an application of the unary minus operator.
 *
 * @see https://neo4j.com/docs/cypher-manual/current/syntax/operators/#syntax-using-the-unary-minus-operator
 */
class Minus implements NumeralType
{
    use NumeralTypeTrait;

    /**
     * @var NumeralType The expression to negate
     */
    private NumeralType $expression;

    /**
     * Minus constructor.
     *
     * @param NumeralType $expression The expression to negate
     */
    public function __construct(NumeralType $expression)
    {
        $this->expression = $expression;
    }

    /**
     * Returns the expression to negate.
     *
     * @return NumeralType
     */
    public function getExpression(): NumeralType
    {
        return $this->expression;
    }

    /**
     * @inheritDoc
     */
    public function toQuery(): string
    {
        return sprintf("-%s", $this->expression->toQuery());
    }
}
