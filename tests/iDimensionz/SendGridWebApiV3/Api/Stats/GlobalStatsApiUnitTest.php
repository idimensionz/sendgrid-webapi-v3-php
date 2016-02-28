<?php
/*
 * iDimensionz/{sendgrid-webapi-v3}
 * GlobalStatsApiUnitTest.php
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

use iDimensionz\SendGridWebApiV3\Api\Stats\GlobalStats\GlobalStatsApi;
use iDimensionz\SendGridWebApiV3\Api\Stats\StatisticsDto;
use Tests\iDimensionz\SendGridWebApiV3\Api\ApiUnitTestAbstract;

class GlobalStatsApiUnitTest extends ApiUnitTestAbstract
{
    /**
     * @var GlobalStatsApi
     */
    private $globalStatsApi;
    /**
     * @var StatisticsDto
     */
    private $validStaticsDto;

    public function setUp()
    {
        parent::setUp();
        $this->setEndPoint(GlobalStatsApi::ENDPOINT);
        $staticsData = $this->hasStatisticsData();
        $this->validStaticsDto = new StatisticsDto($staticsData);
    }

    public function tearDown()
    {
        unset($this->validStaticsDto);
        unset($this->globalStatsApi);
        parent::tearDown();
    }

    public function testConstants()
    {
        $this->assertEquals('YYYY-MM-DD', GlobalStatsApi::DATE_FORMAT);
        $this->assertEquals('stats', GlobalStatsApi::ENDPOINT);
    }

    public function testConstructReturnsGlobalStatsApi()
    {
        $this->hasSendGridGetRequest('?', [$this->validStaticsDto->toArray()]);
        $this->assertInstanceOf(
            'iDimensionz\SendGridWebApiV3\Api\Stats\GlobalStats\GlobalStatsApi',
            $this->globalStatsApi
        );
    }

    public function testGetGlobalStatsReturnsArrayOfStatisticsDtos()
    {
        $this->markTestSkipped('Fix this test');
        $startDate = new \DateTime();
        $endDate = $startDate->add(new \DateInterval('P1W'));
        $command = '?start_date=' . $startDate->format('Y-m-d') . '&end_date=' . $endDate->format('Y-m-d');
        $actualData = $this->hasSendGridGetRequest($command, [$this->validStaticsDto->toArray()]);
        $this->assertEquals([$this->validStaticsDto->toArray()], $actualData);

    }
    /**
     * @param string $command
     * @param string $content
     */
    protected function hasSendGridGetRequest($command, $content)
    {
        parent::hasSendGridGetRequest($command, $content);
        $this->globalStatsApi = new GlobalStatsApi($this->sendGridRequest);
    }

    private function hasStatisticsData()
    {
        $metricsData = [
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
        $statisticsData = [];
        $statisticsData['date'] = '2016-01-19';
        $statisticsData['stats'] = [
            [
                'metrics' => [$metricsData]
            ]
        ];
        return $statisticsData;
    }
}