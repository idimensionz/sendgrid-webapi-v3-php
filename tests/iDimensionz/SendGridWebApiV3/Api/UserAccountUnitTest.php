<?php
/*
 * iDimensionz/{sendgrid-webapi-v3}
 * UserAccountUnitTest.php
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

namespace Tests\iDimensionz\SendGridWebApiV3\Api;

use iDimensionz\SendGridWebApiV3\Api\User\UserAccount;

class UserAccountUnitTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var UserAccount $userAccount
     */
    private $userAccount;

    public function setUp()
    {
        parent::setUp();
        $this->userAccount = new UserAccount(['type' => 'Free', 'reputation' => 96.9]);
    }

    public function tearDown()
    {
        unset($this->userAccount);
        parent::tearDown();
    }

    public function testConstruct()
    {
        $this->assertInstanceOf('\iDimensionz\SendGridWebApiV3\Api\User\UserAccount', $this->userAccount);
        $this->assertEquals('Free', $this->userAccount->getType());
        $this->assertEquals(96.9, $this->userAccount->getReputation());
    }
}
 