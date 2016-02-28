<?php
/*
 * iDimensionz/{sendgrid-webapi-v3}
 * StatisticsDtoTest.php
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

namespace iDimensionz\SendGridWebApiV3\Api\Stats;

use iDimensionz\SendGridWebApiV3\Api\Stats\StatisticsDto;

class StatisticsDtoTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    public function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testConstructThrowsExceptionWhenDateMissing()
    {
        $statistics = [
            'stats' =>  [['some stats']],
            'date'  =>  '2016-01-19'
        ];
        new StatisticsDto($statistics);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testConstructThrowsExceptionWhenStatsMissing()
    {
        $statistics = [
            'date'  =>  '2016-01-19',
            'stats' =>  [['some stats']]
        ];
        new StatisticsDto($statistics);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testSetDateThrowsExceptionWhenDateInWrongFormat()
    {
        $invalidDateFormat = '01/19/2016';
        $statistics = [
            'date'  =>  $invalidDateFormat,
            'stats' =>  [['some stats']]
        ];
        new StatisticsDto($statistics);
    }

    public function testSettersAndGetters()
    {
        $validDateFormat = '2016-01-09';
        $metrics = $this->hasMetrics();
        $statistics = [
            'date'  =>  $validDateFormat,
            'stats' =>  [
                [
                    'name'      =>  'some name',
                    'type'      =>  'category',
                    'metrics'   =>  $metrics
                ]
            ]
        ];
        $statisticsDto = new StatisticsDto($statistics);
        $this->assertEquals($validDateFormat, $statisticsDto->getDate()->format(StatisticsDto::DATE_FORMAT));
        /**
         * @var MetricsDto[] $metricsDtos
         */
        $metricsDtos = $statisticsDto->getMetricsDtos();
        $actualMetrics = $metricsDtos[0];
        $this->assertEquals($metrics['blocks'], $actualMetrics->getBlocks());
        $this->assertEquals($metrics['bounce_drops'], $actualMetrics->getBounceDrops());
        $this->assertEquals($metrics['bounces'], $actualMetrics->getBounces());
        $this->assertEquals($metrics['clicks'], $actualMetrics->getClicks());
        $this->assertEquals($metrics['deferred'], $actualMetrics->getDeferred());
        $this->assertEquals($metrics['delivered'], $actualMetrics->getDelivered());
        $this->assertEquals($metrics['invalid_emails'], $actualMetrics->getInvalidEmails());
        $this->assertEquals($metrics['opens'], $actualMetrics->getOpens());
        $this->assertEquals($metrics['processed'], $actualMetrics->getProcessed());
        $this->assertEquals($metrics['requests'], $actualMetrics->getRequests());
        $this->assertEquals($metrics['spam_report_drops'], $actualMetrics->getSpamReportDrops());
        $this->assertEquals($metrics['spam_reports'], $actualMetrics->getSpamReports());
        $this->assertEquals($metrics['unique_clicks'], $actualMetrics->getUniqueClicks());
        $this->assertEquals($metrics['unique_opens'], $actualMetrics->getUniqueOpens());
        $this->assertEquals($metrics['unsubscribe_drops'], $actualMetrics->getUnsubscribeDrops());
        $this->assertEquals($metrics['unsubscribes'], $actualMetrics->getUnsubscribes());
    }

    public function testToArray()
    {
        $validDateFormat = '2016-01-09';
        $metrics = $this->hasMetrics();
        $statistics = [
            'date'  =>  $validDateFormat,
            'stats' =>  [
                [
                    'name'      =>  'some name',
                    'type'      =>  'category',
                    'metrics'   =>  $metrics
                ]
            ]
        ];
        $statisticsDto = new StatisticsDto($statistics);
        $actualStatisticsDtoArray = $statisticsDto->toArray();
        $this->assertEquals($statistics, $actualStatisticsDtoArray);
    }

    /**
     * @return array
     */
    private function hasMetrics()
    {
        return [
            'blocks'        =>  10,
            'bounce_drops'  =>  20,
            'bounces'       =>  30,
            'clicks'        =>  40,
            'deferred'      =>  50,
            'delivered'     =>  60,
            'invalid_emails'    =>  70,
            'opens'         =>  80,
            'processed'     =>  90,
            'requests'      =>  100,
            'spam_report_drops' =>  110,
            'spam_reports'  =>  120,
            'unique_clicks' =>  130,
            'unique_opens'  =>  140,
            'unsubscribe_drops' =>  150,
            'unsubscribes'  =>  160
        ];
    }
}
 