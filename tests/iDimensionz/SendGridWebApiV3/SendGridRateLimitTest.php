<?php
/*
 * iDimensionz/{sendgrid-webapi-v3}
 * SendGridRateLimitTest.php
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

namespace Tests\iDimensionz\SendGridWebApiV3;

use iDimensionz\SendGridWebApiV3\SendGridRateLimit;

class SendGridRateLimitTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var SendGridRateLimit $sendGridRateLimit
     */
    private $sendGridRateLimit;
    /**
     * @var int $validLimit
     */
    private $validLimit;
    /**
     * @var int $validRemaining
     */
    private $validRemaining;
    /**
     * @var string $validDateTimeString
     */
    private $validDateTimeString;

    public function setUp()
    {
        parent::setUp();
        $this->validLimit = 100;
        $this->validRemaining = 25;
        $this->validDateTimeString = '2015-09-21 22:57:30';
    }

    public function tearDown()
    {
        unset($this->validDateTimeString);
        unset($this->validRemaining);
        unset($this->validLimit);
        unset($this->sendGridRateLimit);
        parent::tearDown();
    }

    public function testSettersAndGettersWithIntegersReturnsIntegers()
    {
        $this->sendGridRateLimit = new SendGridRateLimit(
            $this->validLimit,
            $this->validRemaining,
            $this->validDateTimeString
        );
        $this->assertSendGridRateLimit();
    }

    public function testSettersAndGettersWithStringReturnsIntegers()
    {
        $this->sendGridRateLimit = new SendGridRateLimit(
            (string) $this->validLimit,
            (string) $this->validRemaining,
            $this->validDateTimeString
        );
        $this->assertSendGridRateLimit();
    }

    private function assertSendGridRateLimit()
    {
        $actualLimit = $this->sendGridRateLimit->getLimit();
        $this->assertTrue(is_int($actualLimit));
        $this->assertEquals($this->validLimit, $actualLimit);
        $actualRemaining = $this->sendGridRateLimit->getRemaining();
        $this->assertTrue(is_int($actualRemaining));
        $this->assertEquals($this->validRemaining, $actualRemaining);
        $actualResetDateTime = $this->sendGridRateLimit->getResetDateTime();
        $this->assertInstanceOf('\DateTime', $actualResetDateTime);
        $this->assertEquals($this->validDateTimeString, $actualResetDateTime->format('Y-m-d H:i:s'));
    }
}
 