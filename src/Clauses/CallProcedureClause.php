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

use InvalidArgumentException;
use TypeError;
use WikibaseSolutions\CypherDSL\ErrorHandling\ErrorTextHelper;
use WikibaseSolutions\CypherDSL\Types\AnyType;
use WikibaseSolutions\CypherDSL\Variable;

/**
 * This class represents a CALL (CALL procedure) clause.
 *
 * @see https://neo4j.com/docs/cypher-manual/current/clauses/call/
 */
class CallProcedureClause extends Clause
{
    /**
     * @var string|null The procedure to call
     */
    private ?string $procedure;

    /**
     * @var AnyType[] The arguments passed to the procedure
     */
    private array $arguments = [];

    /**
     * @var Variable[] The results field that will be returned
     */
    private array $yieldVariables = [];

    /**
     * Sets the procedure to call. This can be for instance "apoc.load.json". This
     * procedure name is passed unescaped to the query.
     *
     * @note The given procedure name is not escaped before being inserted into the
     * query.
     *
     * @param string $procedure
     * @return CallProcedureClause
     */
    public function setProcedure(string $procedure): self
    {
        $this->procedure = $procedure;

        return $this;
    }

    /**
     * Sets the arguments to pass to this procedure call. This overwrites any previously passed
     * arguments.
     *
     * @param AnyType[] $arguments
     * @return CallProcedureClause
     */
    public function withArguments(array $arguments): self
    {
        foreach ($arguments as $argument) {
            if (!($argument instanceof AnyType)) {
                throw new TypeError(
                    ErrorTextHelper::getTypeErrorObjectArrayText(
                        'arguments',
                        'AnyType',
                        $argument
                    )
                );
            }
        }

        $this->arguments = $arguments;

        return $this;
    }

    /**
     * Add an argument to pass to this procedure call.
     *
     * @param AnyType $argument
     * @return CallProcedureClause
     */
    public function addArgument(AnyType $argument): self
    {
        $this->arguments[] = $argument;

        return $this;
    }

    /**
     * Used to explicitly select which available result fields are returned as newly-bound
     * variables.
     *
     * @param Variable[] $variables
     * @return CallProcedureClause
     */
    public function yields(array $variables): self
    {
        foreach ($variables as $variable) {
            if (!($variable instanceof Variable)) {
                throw new InvalidArgumentException("\$variables should only consist of Variable objects");
            }
        }

        $this->yieldVariables = $variables;

        return $this;
    }

    /**
     * @inheritDoc
     */
    protected function getClause(): string
    {
        return "CALL";
    }

    /**
     * @inheritDoc
     */
    protected function getSubject(): string
    {
        if (!isset($this->procedure)) {
            return "";
        }

        $arguments = implode(
            ", ",
            array_map(fn(AnyType $pattern): string => $pattern->toQuery(), $this->arguments)
        );

        if (count($this->yieldVariables) > 0) {
            $yieldParameters = implode(
                ", ",
                array_map(fn(Variable $variable): string => $variable->toQuery(), $this->yieldVariables)
            );

            return sprintf("%s(%s) YIELD %s", $this->procedure, $arguments, $yieldParameters);
        } else {
            return sprintf("%s(%s)", $this->procedure, $arguments);
        }
    }
}