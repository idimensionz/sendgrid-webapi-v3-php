<?php
/*
 * iDimensionz/{sendgrid-webapi-v3}
 * AuthenticationBasicTest.php
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

namespace Tests\iDimensionz\SendGridWebApiV3\Authentication;

use iDimensionz\SendGridWebApiV3\Guzzle\AuthenticationOptionSetter;
use iDimensionz\SendGridWebApiV3\Authentication\AuthenticationBasic;

class AuthenticationBasicTest extends \PHPUnit_Framework_TestCase
{
    private $validUserName;
    private $validPassword;
    /**
     * @var array $expectedAuthentication
     */
    private $expectedAuthentication;
    /**
     * @var AuthenticationBasic $authentication
     */
    private $authentication;

    public function setUp()
    {
        parent::setUp();
        $this->validUserName = 'imauser';
        $this->validPassword = 'someValidPassword';
        $this->expectedAuthentication = ['auth' => [$this->validUserName, $this->validPassword]];
        $this->authentication = new AuthenticationBasic(new AuthenticationOptionSetter());
    }

    public function tearDown()
    {
        unset($this->authentication);
        unset($this->expectedAuthentication);
        unset($this->validPassword);
        unset($this->validUserName);
        parent::tearDown();
    }

    public function testSetAuthenticationWithSequentialArray()
    {
        $this->authentication->setAuthentication([$this->validUserName, $this->validPassword]);
        $this->assertEquals($this->expectedAuthentication, $this->authentication->getOptions());
    }

    public function testSetAuthenticationWithAssociativeArray()
    {
        $this->authentication->setAuthentication([
            'username' => $this->validUserName,
            'password' => $this->validPassword

        ]);
        $this->assertEquals($this->expectedAuthentication, $this->authentication->getOptions());
    }
}
 