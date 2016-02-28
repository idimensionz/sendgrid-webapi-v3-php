<?php
/*
 * iDimensionz/{sendgrid-webapi-v3}
 * StatsAggregatedBy.php
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

class StatsAggregatedBy
{
    const DAY = 'day';
    const WEEK = 'week';
    const MONTH = 'month';

    /**
     * @var array
     */
    private static $validValues = [self::DAY, self::MONTH, self::WEEK];

    /**
     * @var string $aggregatedBy
     */
    private $aggregatedBy;

    public function __construct($aggregatedBy)
    {
        $this->setAggregatedBy($aggregatedBy);
    }

    public function setAggregatedByDay()
    {
        $this->setAggregatedBy(self::DAY);
    }

    public function setAggregatedByWeek()
    {
        $this->setAggregatedBy(self::WEEK);
    }

    public function setAggregatedByMonth()
    {
        $this->setAggregatedBy(self::MONTH);
    }

    /**
     * @return string
     */
    public function getAggregatedBy()
    {
        return $this->aggregatedBy;
    }

    /**
     * @param $aggregatedBy
     */
    public function setAggregatedBy($aggregatedBy)
    {
        if (!$this->isValidValue($aggregatedBy)) {
            throw new \InvalidArgumentException(
                'Aggregated By value must be one of ' . implode(',', self::getValidValues())
            );
        }
        $this->aggregatedBy = $aggregatedBy;
    }

    /**
     * @return array
     */
    public static function getValidValues()
    {
        return self::$validValues;
    }

    /**
     * @param string $value
     * @return bool
     */
    private function isValidValue($value)
    {
        return in_array($value, self::getValidValues());
    }
}
