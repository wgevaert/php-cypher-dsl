<?php declare(strict_types=1);
/*
 * This file is part of php-cypher-dsl.
 *
 * Copyright (C) 2021-  Wikibase Solutions
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace WikibaseSolutions\CypherDSL\Tests\Unit;

use TypeError;
use PHPUnit\Framework\TestCase;
use WikibaseSolutions\CypherDSL\Query;
use WikibaseSolutions\CypherDSL\Types\AnyType;
use WikibaseSolutions\CypherDSL\Patterns\Node;
use WikibaseSolutions\CypherDSL\Patterns\Path;
use WikibaseSolutions\CypherDSL\Patterns\Relationship;

/**
 * Tests the "create" method of the Query class.
 *
 * @covers \WikibaseSolutions\CypherDSL\Query
 */
final class QueryCreateTest extends TestCase
{
	public function testCreateSinglePattern(): void
	{
		$pattern = Query::node()->withVariable('hello');

        $query = Query::new()->create($pattern);

        $this->assertSame('CREATE (hello)', $query->toQuery());
	}

    public function testCreateMultiplePatterns(): void
    {
        $hello = Query::node()->withVariable('hello');
        $world = Query::node()->withVariable('world');

        $query = Query::new()->create([$hello, $world]);

        $this->assertSame('CREATE (hello), (world)', $query->toQuery());
    }

    public function testDoesNotAcceptRelationship(): void
    {
        $rel = Query::relationship(Relationship::DIR_RIGHT);

        $this->expectException(TypeError::class);

        Query::new()->create($rel);
    }
}
