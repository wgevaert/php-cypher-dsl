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

namespace WikibaseSolutions\CypherDSL\Tests\Unit\Expressions\Functions;

use PHPUnit\Framework\TestCase;
use WikibaseSolutions\CypherDSL\Expressions\Functions\All;
use WikibaseSolutions\CypherDSL\Expressions\Functions\Any;
use WikibaseSolutions\CypherDSL\Expressions\Functions\Date;
use WikibaseSolutions\CypherDSL\Expressions\Functions\DateTime;
use WikibaseSolutions\CypherDSL\Expressions\Functions\Exists;
use WikibaseSolutions\CypherDSL\Expressions\Functions\FunctionCall;
use WikibaseSolutions\CypherDSL\Expressions\Functions\IsEmpty;
use WikibaseSolutions\CypherDSL\Expressions\Functions\LocalDateTime;
use WikibaseSolutions\CypherDSL\Expressions\Functions\LocalTime;
use WikibaseSolutions\CypherDSL\Expressions\Functions\None;
use WikibaseSolutions\CypherDSL\Expressions\Functions\Point;
use WikibaseSolutions\CypherDSL\Expressions\Functions\RawFunction;
use WikibaseSolutions\CypherDSL\Expressions\Functions\Single;
use WikibaseSolutions\CypherDSL\Expressions\Functions\Time;
use WikibaseSolutions\CypherDSL\Expressions\Variable;
use WikibaseSolutions\CypherDSL\Tests\Unit\Expressions\TestHelper;
use WikibaseSolutions\CypherDSL\Types\AnyType;
use WikibaseSolutions\CypherDSL\Types\CompositeTypes\ListType;
use WikibaseSolutions\CypherDSL\Types\CompositeTypes\MapType;

/**
 * @covers \WikibaseSolutions\CypherDSL\Expressions\Functions\FunctionCall
 */
class FunctionCallTest extends TestCase
{
    use TestHelper;

    public function testRaw()
    {
        $raw = FunctionCall::raw("foo", []);

        $this->assertInstanceOf(RawFunction::class, $raw);
    }

    public function testAll()
    {
        $variable = $this->getQueryConvertibleMock(Variable::class, "a");
        $list = $this->getQueryConvertibleMock(ListType::class, "[]");
        $predicate = $this->getQueryConvertibleMock(AnyType::class, "b");

        $all = FunctionCall::all($variable, $list, $predicate);

        $this->assertInstanceOf(All::class, $all);
    }

    public function testAny()
    {
        $variable = $this->getQueryConvertibleMock(Variable::class, "a");
        $list = $this->getQueryConvertibleMock(ListType::class, "[]");
        $predicate = $this->getQueryConvertibleMock(AnyType::class, "b");

        $any = FunctionCall::any($variable, $list, $predicate);

        $this->assertInstanceOf(Any::class, $any);
    }

    public function testExists()
    {
        $expression = $this->getQueryConvertibleMock(AnyType::class, "a");

        $exists = FunctionCall::exists($expression);

        $this->assertInstanceOf(Exists::class, $exists);
    }

    public function testIsEmpty()
    {
        $list = $this->getQueryConvertibleMock(ListType::class, "[]");

        $isEmpty = FunctionCall::isEmpty($list);

        $this->assertInstanceOf(IsEmpty::class, $isEmpty);
    }

    public function testNone()
    {
        $variable = $this->getQueryConvertibleMock(Variable::class, "a");
        $list = $this->getQueryConvertibleMock(ListType::class, "[]");
        $predicate = $this->getQueryConvertibleMock(AnyType::class, "b");

        $none = FunctionCall::none($variable, $list, $predicate);

        $this->assertInstanceOf(None::class, $none);
    }

    public function testSingle()
    {
        $variable = $this->getQueryConvertibleMock(Variable::class, "a");
        $list = $this->getQueryConvertibleMock(ListType::class, "[]");
        $predicate = $this->getQueryConvertibleMock(AnyType::class, "b");

        $single = FunctionCall::single($variable, $list, $predicate);

        $this->assertInstanceOf(Single::class, $single);
    }

    public function testPoint()
    {
        $map = $this->getQueryConvertibleMock(MapType::class, "map");

        $point = FunctionCall::point($map);

        $this->assertInstanceOf(Point::class, $point);
    }

    public function testDate()
    {
        $value = $this->getQueryConvertibleMock(AnyType::class, "value");

        $date = FunctionCall::date($value);

        $this->assertInstanceOf(Date::class, $date);

        $date = FunctionCall::date();

        $this->assertInstanceOf(Date::class, $date);
    }

    public function testDateTime()
    {
        $value = $this->getQueryConvertibleMock(AnyType::class, "value");

        $date = FunctionCall::datetime($value);

        $this->assertInstanceOf(DateTime::class, $date);

        $date = FunctionCall::datetime();

        $this->assertInstanceOf(DateTime::class, $date);
    }

    public function testLocalDateTime()
    {
        $value = $this->getQueryConvertibleMock(AnyType::class, "value");

        $date = FunctionCall::localdatetime($value);

        $this->assertInstanceOf(LocalDateTime::class, $date);

        $date = FunctionCall::localdatetime();

        $this->assertInstanceOf(LocalDateTime::class, $date);
    }

    public function testLocalTime()
    {
        $value = $this->getQueryConvertibleMock(AnyType::class, "value");

        $date = FunctionCall::localtime($value);

        $this->assertInstanceOf(LocalTime::class, $date);

        $date = FunctionCall::localtime();

        $this->assertInstanceOf(LocalTime::class, $date);
    }

    public function testTime()
    {
        $value = $this->getQueryConvertibleMock(AnyType::class, "value");

        $date = FunctionCall::time($value);

        $this->assertInstanceOf(Time::class, $date);

        $date = FunctionCall::time();

        $this->assertInstanceOf(Time::class, $date);
    }
}