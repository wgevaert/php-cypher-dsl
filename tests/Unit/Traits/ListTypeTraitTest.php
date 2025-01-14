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

namespace WikibaseSolutions\CypherDSL\Tests\Unit\Traits;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use WikibaseSolutions\CypherDSL\In;
use WikibaseSolutions\CypherDSL\Tests\Unit\TestHelper;
use WikibaseSolutions\CypherDSL\Types\CompositeTypes\ListType;
use WikibaseSolutions\CypherDSL\Types\PropertyTypes\PropertyType;

/**
 * @covers \WikibaseSolutions\CypherDSL\Traits\ListTypeTrait
 */
class ListTypeTraitTest extends TestCase
{
    use TestHelper;

    /**
     * @var MockObject|PropertyType
     */
    private $a;

    /**
     * @var MockObject|ListType
     */
    private $b;

    public function setUp(): void
    {
        $this->a = $this->getQueryConvertableMock(PropertyType::class, "a");
        $this->b = $this->getQueryConvertableMock(ListType::class, "[]");
    }

    public function testHas()
    {
        $has = $this->b->has($this->a);

        $this->assertInstanceOf(In::class, $has);
    }
}
