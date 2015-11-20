<?php
/*
 * iDimensionz/{sendgrid-webapi-v3}
 * AuthenticationAbstractTest.php
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

require_once 'TestAuthenticationOptionSetter.php';
require_once 'TestAuthenticationAbstract.php';

use iDimensionz\SendGridWebApiV3\Authentication\AuthenticationOptionSetterInterface;

class AuthenticationAbstractTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var TestAuthenticationAbstract $instance
     */
    private $instance;
    /**
     * @var AuthenticationOptionSetterInterface
     */
    private $optionSetter;
    /**
     * @var mixed $validAuthValue
     */
    private $validAuthValue;
    /**
     * @var array $expectedOption
     */
    private $expectedOption;

    public function setUp()
    {
        parent::setUp();
        $this->optionSetter = new TestAuthenticationOptionSetter();
        $this->validAuthValue = 'SomeApiKeyValue!';
        $this->instance = new TestAuthenticationAbstract($this->optionSetter, $this->validAuthValue);
        $this->expectedOption = ['testAuth' => $this->validAuthValue];
    }

    public function tearDown()
    {
        unset($this->expectedOption);
        unset($this->validAuthValue);
        unset($this->instance);
        unset($this->optionSetter);
        parent::tearDown();
    }

    public function testConstructReturnsAuthenticationAbstract()
    {
        $this->assertInstanceOf('iDimensionz\SendGridWebApiV3\Authentication\AuthenticationAbstract', $this->instance);
    }

    public function testSetGetOption()
    {
        $this->instance->setOptions($this->validAuthValue);
        $actualOption = $this->instance->getOptions();
        $this->assertEquals($this->expectedOption, $actualOption);
    }
}
 