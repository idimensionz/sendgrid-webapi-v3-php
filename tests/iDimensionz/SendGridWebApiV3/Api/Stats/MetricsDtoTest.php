<?php
/*
 * iDimensionz/{sendgrid-webapi-v3}
 * MetricsDtoTest.php
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

use iDimensionz\SendGridWebApiV3\Api\Stats\MetricsDto;

class MetricsDtoTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var MetricsDto
     */
    private $metricsDto;

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
    public function testConstructThrowsInvalidArgumentExceptionWhenMetricsDataDoesNotContainMetricsIndex()
    {
        $metricsData = [
            'name' => 'Test name',
            'type' => 'Test type'
        ];
        $this->metricsDto = new MetricsDto($metricsData);
    }

    public function testConstructSetsMetricsNameAndType()
    {
        $metrics = ['some data'];
        $name = 'Test name';
        $type = 'category';
        $metricsData = [
            'metrics'   => $metrics,
            'name'      => $name,
            'type'      => $type
        ];
        $this->metricsDto = new MetricsDto($metricsData);
        $this->assertEquals($name, $this->metricsDto->getName());
        $this->assertEquals($type, $this->metricsDto->getType());
    }

    public function testMetricsGettersAndSetters()
    {
        $metrics = $this->hasMetrics();
        $metricsData = $this->hasMetricsData($metrics);
        $this->hasMetricsDto($metricsData);
        $this->assertEquals($metrics['blocks'], $this->metricsDto->getBlocks());
        $this->assertEquals($metrics['bounce_drops'], $this->metricsDto->getBounceDrops());
        $this->assertEquals($metrics['bounces'], $this->metricsDto->getBounces());
        $this->assertEquals($metrics['clicks'], $this->metricsDto->getClicks());
        $this->assertEquals($metrics['deferred'], $this->metricsDto->getDeferred());
        $this->assertEquals($metrics['delivered'], $this->metricsDto->getDelivered());
        $this->assertEquals($metrics['invalid_emails'], $this->metricsDto->getInvalidEmails());
        $this->assertEquals($metrics['opens'], $this->metricsDto->getOpens());
        $this->assertEquals($metrics['processed'], $this->metricsDto->getProcessed());
        $this->assertEquals($metrics['requests'], $this->metricsDto->getRequests());
        $this->assertEquals($metrics['spam_report_drops'], $this->metricsDto->getSpamReportDrops());
        $this->assertEquals($metrics['spam_reports'], $this->metricsDto->getSpamReports());
        $this->assertEquals($metrics['unique_clicks'], $this->metricsDto->getUniqueClicks());
        $this->assertEquals($metrics['unique_opens'], $this->metricsDto->getUniqueOpens());
        $this->assertEquals($metrics['unsubscribe_drops'], $this->metricsDto->getUnsubscribeDrops());
        $this->assertEquals($metrics['unsubscribes'], $this->metricsDto->getUnsubscribes());
    }

    public function testToArray()
    {
        $metrics = $this->hasMetrics();
        $metricsData = $this->hasMetricsData($metrics);
        $this->hasMetricsDto($metricsData);
        $actualMetricsArray = $this->metricsDto->toArray();
        $this->assertEquals($metricsData, $actualMetricsArray);
    }

    /**
     * @return array
     */
    private function hasMetrics()
    {
        $metrics = [
            'blocks' => 10,
            'bounce_drops' => 20,
            'bounces' => 30,
            'clicks' => 40,
            'deferred' => 50,
            'delivered' => 60,
            'invalid_emails' => 70,
            'opens' => 80,
            'processed' => 90,
            'requests' => 100,
            'spam_report_drops' => 110,
            'spam_reports' => 120,
            'unique_clicks' => 130,
            'unique_opens' => 140,
            'unsubscribe_drops' => 150,
            'unsubscribes' => 160
        ];
        return $metrics;
    }

    /**
     * @param array $metricsData
     */
    private function hasMetricsDto(array $metricsData)
    {
        $this->metricsDto = new MetricsDto($metricsData);
    }

    /**
     * @param $metrics
     * @return array
     */
    private function hasMetricsData($metrics)
    {
        $name = 'Test name';
        $type = 'category';
        $metricsData = [
            'metrics' => $metrics,
            'name' => $name,
            'type' => $type
        ];
        return $metricsData;
    }
}