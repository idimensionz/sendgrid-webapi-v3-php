<?php
/*
 * iDimensionz/{sendgrid-webapi-v3}
 * ApiEndpointAbstractTest.php
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

namespace Tests\iDimensionz\Api;

require_once 'TestApiEndpointAbstract.php';

class ApiEndpointAbstractTest extends \PHPUnit_Framework_TestCase
{
    const ENDPOINT = 'test';
    /**
     * @var TestApiEndPointAbstract $apiEndpoint
     */
    private $apiEndpoint;
    private $sendGridRequest;
    private $sendGridResponse;
    private $validContent;

    public function setUp()
    {
        parent::setUp();
        $this->validContent = 'Valid content';
        $this->sendGridRequest = \Phake::mock('\iDimensionz\SendGridWebApiV3\SendGridRequest');
        $this->apiEndpoint = new TestApiEndpointAbstract($this->sendGridRequest, self::ENDPOINT);
    }

    public function tearDown()
    {
        unset($this->apiEndpoint);
        unset($this->sendGridRequest);
        parent::tearDown();
    }

    public function testConstructSetsRequestAndEndpoint()
    {
        $this->assertEquals($this->sendGridRequest, $this->apiEndpoint->getSendGridRequest());
        $this->assertEquals(self::ENDPOINT, $this->apiEndpoint->getEndpoint());
    }

    public function testGetSetsSendGridResponseAndReturnsContent()
    {
        $this->hasSendGridResponse();
        $actualContent = $this->apiEndpoint->get('test');
        $this->assertEquals($this->validContent, $actualContent);
        $this->assertEquals($this->sendGridResponse, $this->apiEndpoint->getLastSendGridResponse());
    }

    private function hasSendGridResponse()
    {
        $this->sendGridResponse = \Phake::mock('\iDimensionz\SendGridWebApiV3\SendGridResponse');
        \Phake::when($this->sendGridResponse)->getContent()
            ->thenReturn($this->validContent);
        $this->assertEquals($this->validContent, $this->sendGridResponse->getContent());
        $this->sendGridRequest = \Phake::mock('\iDimensionz\SendGridWebApiV3\SendGridRequest');
        \Phake::when($this->sendGridRequest)->get(\Phake::anyParameters())
            ->thenReturn($this->sendGridResponse);
        $this->assertEquals($this->sendGridResponse, $this->sendGridRequest->get('blah'));
        $this->apiEndpoint->setSendGridRequest($this->sendGridRequest);
    }
}
