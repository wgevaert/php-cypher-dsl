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

namespace WikibaseSolutions\CypherDSL\Types\StructuralTypes;

use WikibaseSolutions\CypherDSL\Patterns\Path;
use WikibaseSolutions\CypherDSL\PropertyMap;
use WikibaseSolutions\CypherDSL\Types\AnyType;
use WikibaseSolutions\CypherDSL\Variable;

/**
 * Represents any structural type in Cypher.
 *
 * Structural types are types that:
 *
 * - can be returned from Cypher queries
 * - cannot be used as parameters
 * - cannot be stored as properties
 * - cannot be constructed with Cypher literals
 *
 * The structural types are:
 *
 * - node
 * - relationship
 * - path
 *
 * @see https://neo4j.com/docs/cypher-manual/current/syntax/values/#structural-types
 */
interface StructuralType extends AnyType
{
    /**
     * Adds a new relationship from the end of the structural type to the node pattern.
     * @param RelationshipType $relationship
     * @param NodeType $node
     * @return Path
     */
    public function relationship(RelationshipType $relationship, NodeType $node): Path;

    /**
     * Adds a new relationship to the node pattern at the end of the structural type to form a path.
     *
     * @param NodeType $node The node to attach to the end of the structural type
     * @param string|null $type The type of the relationship
     * @param array|PropertyMap|null $properties The properties to attach to the relationship
     * @param string|Variable|null $name The name fo the relationship
     *
     * @return Path
     */
    public function relationshipTo(NodeType $node, ?string $type = null, $properties = null, $name = null): Path;

    /**
     * Adds a new relationship from the node pattern at the end of the structural type to form a path.
     *
     * @param NodeType $node The node to attach to the end of the structural type.
     * @param string|null $type The type of the relationship
     * @param array|PropertyMap|null $properties The properties to attach to the relationship
     * @param string|Variable|null $name The name fo the relationship
     *
     * @return Path
     */
    public function relationshipFrom(NodeType $node, ?string $type = null, $properties = null, $name = null): Path;

    /**
     * Adds a new unidirectional relationship to the node pattern at the end of the structural type to form a path.
     *
     * @param NodeType $node The node to attach to the end of the structural type.
     * @param string|null $type The type of the relationship
     * @param array|PropertyMap|null $properties The properties to attach to the relationship
     * @param string|Variable|null $name The name fo the relationship
     *
     * @return Path
     */
    public function relationshipUni(NodeType $node, ?string $type = null, $properties = null, $name = null): Path;
}
