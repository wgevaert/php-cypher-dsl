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

namespace WikibaseSolutions\CypherDSL\Traits\TypeTraits;

use WikibaseSolutions\CypherDSL\In;
use WikibaseSolutions\CypherDSL\Types\CompositeTypes\ListType;
use WikibaseSolutions\CypherDSL\Types\PropertyTypes\PropertyType;

/**
 * This trait provides a default implementation to satisfy the "ListType" interface.
 *
 * @see ListType
 */
trait ListTypeTrait
{
    /**
     * Checks whether the given element exists in this list.
     *
     * @param PropertyType $left
     * @param bool $insertParentheses
     * @return In
     */
    public function has(PropertyType $left, bool $insertParentheses = true): In
    {
        return new In($left, $this, $insertParentheses);
    }
}