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

namespace WikibaseSolutions\CypherDSL\Clauses;

use WikibaseSolutions\CypherDSL\Expressions\Expression;

/**
 * This class represents a LIMIT clause.
 *
 * @see https://neo4j.com/docs/cypher-manual/current/clauses/limit/
 */
class LimitClause extends Clause
{
    /**
     * The expression of the LIMIT statement.
     *
     * @var Expression $expression
     */
    private Expression $expression;

    /**
     * Sets the expression that returns the limit.
     *
     * @param  Expression $expression The expression that returns a scalar that is the limit
     * @return LimitClause
     */
    public function setExpression(Expression $expression): self
    {
        $this->expression = $expression;

        return $this;
    }

    /**
     * @inheritDoc
     */
    protected function getClause(): string
    {
        return "LIMIT";
    }

    /**
     * @inheritDoc
     */
    protected function getSubject(): string
    {
        if (isset($this->expression) ) {
            return $this->expression->toQuery();
        }

        return "";
    }
}