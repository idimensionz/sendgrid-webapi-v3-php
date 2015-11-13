<?php
/*
 * iDimensionz/{sendgrid-webapi-v3}
 * SendGridRequestTest.php
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

require_once 'Authentication/TestAuthenticationAbstract.php';
require_once 'TestSendGridRequest.php';

use Tests\iDimensionz\SendGridWebApiV3\Authentication\TestAuthenticationAbstract;
//use Tests\iDimensionz\SendGridWebApiV3\TestSendGridRequest;

class SendGridRequestUnitTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var TestSendGridRequest $sendGridRequest
     */
    private $sendGridRequest;
    /**
     * @var TestAuthenticationAbstract $authentication
     */
    private $authentication;
    private $httpClient;
    private $apiHost;
    private $validContent;
    private $validAuthenticationOptions;
    private $validResponse;

    public function setUp()
    {
        parent::setUp();
        $this->validAuthenticationOptions = ['username'=>'foo', 'password'=>'bar'];
        $this->hasAuthentication($this->validAuthenticationOptions);
        $this->apiHost = 'https://some-phake-url.invaliddomain/v3/';
        $this->httpClient = \Phake::mock('\iDimensionz\SendGridWebApiV3\Guzzle\HttpClient');
        $this->sendGridRequest = new TestSendGridRequest($this->authentication, $this->apiHost, $this->httpClient);
        $this->validContent = 'Crazy good web stuff';
        $this->validResponse = \Phake::mock('\iDimensionz\SendGridWebApiV3\Guzzle\HttpResponse');
    }

    public function tearDown()
    {
        unset($this->validResponse);
        unset($this->validContent);
        unset($this->httpClient);
        unset($this->apiHost);
        unset($this->authentication);
        unset($this->sendGridRequest);
        parent::tearDown();
    }

    public function testConstructReturnsSendGridRequest()
    {
        $this->assertInstanceOf('\iDimensionz\SendGridWebApiV3\SendGridRequest', $this->sendGridRequest);
    }

    public function testConstructSetsAuthenticationAndApiHostAndHttpClientWhenSupplied()
    {
        $actualAuthentication = $this->sendGridRequest->getAuthentication();
        $actualApiHost = $this->sendGridRequest->getApiHost();
        $actualHttpClient = $this->sendGridRequest->getHttpClient();
        $this->assertEquals($this->authentication, $actualAuthentication);
        $this->assertEquals($this->apiHost, $actualApiHost);
        $this->assertEquals($this->httpClient, $actualHttpClient);
    }

    public function testConstructCreatesHttpClientWhenNoneSupplied()
    {
        $this->sendGridRequest = new TestSendGridRequest($this->authentication, $this->apiHost);
        $actualHttpClient = $this->sendGridRequest->getHttpClient();
        $this->assertInstanceOf('\iDimensionz\SendGridWebApiV3\HttpClientInterface', $actualHttpClient);
    }

    public function testGetReturnsHttpResponse()
    {
        $this->hasGetContent();
        $validUrl = 'api/some-command/with/get/params';
        $actualResponse = $this->sendGridRequest->get($validUrl);
        $this->assertInstanceOf('\iDimensionz\SendGridWebApiV3\SendGridResponse', $actualResponse);
    }

    public function testPatchReturnsHttpResponse()
    {
        $this->hasPatchContent();
        $validUrl = 'api/some-command';
        $actualResponse = $this->sendGridRequest->patch($validUrl);
        $this->assertInstanceOf('\iDimensionz\SendGridWebApiV3\SendGridResponse', $actualResponse);
    }

    public function testSetHttpClientCreatesDefaultHttpClientWhenNullSupplied()
    {
        $this->sendGridRequest->setHttpClient(null);
        $actualHttpClient = $this->sendGridRequest->getHttpClient();
        $this->assertInstanceOf('\iDimensionz\SendGridWebApiV3\HttpClientInterface', $actualHttpClient);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testSetHttpClientThrowsExceptionWhenHttpClientNotInstanceOfHttpClientInterface()
    {
        $this->sendGridRequest->setHttpClient(new \StdClass());
    }

    public function testAssembleOptionsReturnsAllOptions()
    {
        $moreValidOptions = ['someSetting' => 'someValue'];
        $expectedOptions = array_merge($moreValidOptions, $this->validAuthenticationOptions);
        $actualOptions = $this->sendGridRequest->assembleOptions($moreValidOptions);
        $this->assertEquals($expectedOptions, $actualOptions);
    }

    /**
     * @return string
     */
    private function hasGetContent()
    {
        \Phake::when($this->httpClient)->get(\Phake::anyParameters())
            ->thenReturn($this->validResponse);
        $this->sendGridRequest->setHttpClient($this->httpClient);
        $actualResponse = $this->httpClient->get($this->apiHost.'api/some-command/with/get/params');
        $this->assertEquals($this->validResponse, $actualResponse);
    }

    private function hasPatchContent()
    {
        \Phake::when($this->httpClient)->patch(\Phake::anyParameters())
            ->thenReturn($this->validResponse);
        $this->sendGridRequest->setHttpClient($this->httpClient);
        $actualResponse = $this->httpClient->patch($this->apiHost.'api/some-command');
        $this->assertEquals($this->validResponse, $actualResponse);
    }

    /**
     * @param array $validOptions
     */
    private function hasAuthentication(array $validOptions)
    {
        $this->authentication = \Phake::mock(
            '\Tests\iDimensionz\SendGridWebApiV3\Authentication\TestAuthenticationAbstract'
        );
        \Phake::when($this->authentication)->getOptions()
            ->thenReturn($validOptions);
    }
}
