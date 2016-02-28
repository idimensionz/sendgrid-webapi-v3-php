<?php
/*
 * iDimensionz/{sendgrid-webapi-v3}
 * GlobalStatsApi.php
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

namespace iDimensionz\SendGridWebApiV3\Api\Stats\GlobalStats;

use Doctrine\Instantiator\Exception\InvalidArgumentException;
use iDimensionz\SendGridWebApiV3\Api\SendGridApiEndpointAbstract;
use iDimensionz\SendGridWebApiV3\Api\Stats\StatisticsDto;
use iDimensionz\SendGridWebApiV3\Api\Stats\StatsAggregatedBy;
use iDimensionz\SendGridWebApiV3\SendGridRequest;

class GlobalStatsApi extends SendGridApiEndpointAbstract
{
    const ENDPOINT = 'stats';
    const DATE_FORMAT = 'YYYY-MM-DD';

    /**
     * @var array
     */
    private $parameters;

    /**
     * @param SendGridRequest $sendGridRequest
     */
    public function __construct(SendGridRequest $sendGridRequest)
    {
        parent::__construct($sendGridRequest, self::ENDPOINT);
    }

    /**
     * @param string $startDate
     * @param string|null $endDate
     * @param string|null $aggregatedBy
     * @return string
     */
    public function getGlobalStats($startDate, $endDate = null, $aggregatedBy = null)
    {
        $this->addParameterStartDate($startDate);
        $this->addParameterEndDate($endDate);
        $this->addParameterAggregatedBy($aggregatedBy);
        $command = '?';
        $parameters = implode('&', $this->getParameters());
        $statisticsData = $this->get($command . $parameters);
        $statisticsDtos = [];
        foreach ($statisticsData as $statisticsItem) {
            $statisticsDtos[] = new StatisticsDto($statisticsItem);
        }

        return $statisticsDtos;
    }

    /**
     * @param string $startDate
     */
    private function addParameterStartDate($startDate)
    {
        if ($startDate == (new \DateTime($startDate))->format(self::DATE_FORMAT)) {
            $this->parameters[] = "start_date={$startDate}";
        } else {
            throw new InvalidArgumentException('Start Date must be a valid date in ' . self::DATE_FORMAT . ' format');
        }
    }

    /**
     * @param string $endDate
     */
    private function addParameterEndDate($endDate)
    {
        if ($endDate == (new \DateTime($endDate))->format(self::DATE_FORMAT)) {
            $this->parameters[] = "end_date={$endDate}";
        }
    }

    /**
     * @param string $aggregatedByValue
     */
    private function addParameterAggregatedBy($aggregatedByValue)
    {
        if (!empty($aggregatedByValue)) {
            $aggregatedBy = new StatsAggregatedBy($aggregatedByValue);
            $this->parameters[] = $aggregatedBy->getAggregatedBy();
        }
    }

    /**
     * @return array
     */
    private function getParameters()
    {
        return $this->parameters;
    }
}
