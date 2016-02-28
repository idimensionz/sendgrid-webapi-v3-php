<?php
/*
 * iDimensionz/{sendgrid-webapi-v3}
 * StatsAggregatedByUnitTest.php
 *  
 * The MIT License (MIT)
 * 
 * Copyright (c) 2015 iDimensionz
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 * 
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
*/

namespace Tests\iDimensionz\SendGridWebApiV3\Api\Stats;

use iDimensionz\SendGridWebApiV3\Api\Stats\StatsAggregatedBy;

class StatsAggregatedByUnitTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var StatsAggregatedBy
     */
    private $statsAggregatedBy;

    public function setUp()
    {
        parent::setUp();
    }

    public function tearDown()
    {
        parent::tearDown();
    }

    public function testConstantValues()
    {
        $this->assertEquals('day', StatsAggregatedBy::DAY);
        $this->assertEquals('week', StatsAggregatedBy::WEEK);
        $this->assertEquals('month', StatsAggregatedBy::MONTH);
    }

    public function testGetValidValuesReturnsArrayOfValidValues()
    {
        $actualValidValues = StatsAggregatedBy::getValidValues();
        $this->assertEquals($this->getValidValues(), $actualValidValues);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testConstructThrowsInvalidArgumentExceptionWhenParamIsNotValid()
    {
        $invalidValue = 'invalid';
        $this->statsAggregatedBy = new StatsAggregatedBy($invalidValue);
    }

    public function testConstructReturnsStatsAggregatedByWhenParamIsValid()
    {
        $validValues = $this->getValidValues();
        foreach ($validValues as $validValue) {
            $this->statsAggregatedBy = new StatsAggregatedBy($validValue);
            $this->assertInstanceOf(
                '\iDimensionz\SendGridWebApiV3\Api\Stats\StatsAggregatedBy',
                $this->statsAggregatedBy
            );
        }
    }

    public function testConstructSetsStatsAggregatedByValueWhenParamIsValid()
    {
        $validValues = $this->getValidValues();
        foreach ($validValues as $validValue) {
            $this->statsAggregatedBy = new StatsAggregatedBy($validValue);
            $this->assertEquals($validValue, $this->statsAggregatedBy->getAggregatedBy());
        }
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testSetAggregatedByThrowsExceptionWhenParamIsNotValid()
    {
        $invalidValue = 'invalid';
        $this->statsAggregatedBy = new StatsAggregatedBy(StatsAggregatedBy::DAY);
        $this->statsAggregatedBy->setAggregatedBy($invalidValue);
    }

    public function testSetAggregatedBySetsValueWhenParamIsValid()
    {
        $this->statsAggregatedBy = new StatsAggregatedBy(StatsAggregatedBy::DAY);
        $validValues = $this->getValidValues();
        foreach ($validValues as $validValue) {
            $this->statsAggregatedBy->setAggregatedBy($validValue);
            $this->assertEquals($validValue, $this->statsAggregatedBy->getAggregatedBy());
        }
    }

    public function testSetAggregatedByDaySetsDayValue()
    {
        $this->statsAggregatedBy = new StatsAggregatedBy(StatsAggregatedBy::MONTH);
        $this->statsAggregatedBy->setAggregatedByDay();
        $actualValue = $this->statsAggregatedBy->getAggregatedBy();
        $this->assertEquals(StatsAggregatedBy::DAY, $actualValue);
    }

    public function testSetAggregatedByWeekSetsWeekValue()
    {
        $this->statsAggregatedBy = new StatsAggregatedBy(StatsAggregatedBy::DAY);
        $this->statsAggregatedBy->setAggregatedByWeek();
        $actualValue = $this->statsAggregatedBy->getAggregatedBy();
        $this->assertEquals(StatsAggregatedBy::WEEK, $actualValue);
    }

    public function testSetAggregatedByMonthSetsMonthValue()
    {
        $this->statsAggregatedBy = new StatsAggregatedBy(StatsAggregatedBy::MONTH);
        $this->statsAggregatedBy->setAggregatedByMonth();
        $actualValue = $this->statsAggregatedBy->getAggregatedBy();
        $this->assertEquals(StatsAggregatedBy::MONTH, $actualValue);
    }

    /**
     * @return array
     */
    private function getValidValues()
    {
        $validValues = [
            StatsAggregatedBy::DAY,
            StatsAggregatedBy::MONTH,
            StatsAggregatedBy::WEEK
        ];

        return $validValues;
    }
}