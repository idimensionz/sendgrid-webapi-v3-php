<?php
/*
 * iDimensionz/{sendgrid-webapi-v3}
 * SendGridRateLimit.php
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

namespace iDimensionz\SendGridWebApiV3;

use DateTime;

class SendGridRateLimit
{
    /**
     * @var int $limit
     */
    private $limit;
    /**
     * @var int remaining
     */
    private $remaining;
    /**
     * @var DateTime $resetDateTime
     */
    private $resetDateTime;

    public function __construct($limit, $remaining, $resetTimestamp)
    {
        $this->setLimit($limit);
        $this->setRemaining($remaining);
        $this->setResetDateTime($resetTimestamp);
    }

    /**
     * @return int
     */
    public function getLimit()
    {
        return $this->limit;
    }

    /**
     * @param int $limit
     */
    public function setLimit($limit)
    {
        $this->limit = (int) $limit;
    }

    /**
     * @return int
     */
    public function getRemaining()
    {
        return $this->remaining;
    }

    /**
     * @param int $remaining
     */
    public function setRemaining($remaining)
    {
        $this->remaining = (int) $remaining;
    }

    /**
     * @return DateTime
     */
    public function getResetDateTime()
    {
        return $this->resetDateTime;
    }

    /**
     * @param DateTime $resetDateTime
     */
    public function setResetDateTime($resetDateTime)
    {
        $this->resetDateTime = new DateTime($resetDateTime);
    }
}
 