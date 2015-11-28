<?php
/*
 * iDimensionz/{sendgrid-webapi-v3}
 * SendGridResponseTest.php
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

use iDimensionz\SendGridWebApiV3\SendGridResponse;
use iDimensionz\SendGridWebApiV3\HttpResponseInterface;

class SendGridResponseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var SendGridResponse $sendGridResponse
     */
    private $sendGridResponse;
    /**
     * @var HttpResponseInterface $validHttpResponse
     */
    private $validHttpResponse;
    private $validPaginationLink;
    private $validRateLimitValues;

    public function setUp()
    {
        parent::setUp();
        $this->validPaginationLink = 'This is a valid pagination link.';
        $resetTimestamp = (new \DateTime())->add(new \DateInterval('PT2H'))->getTimestamp();
        $this->validRateLimitValues = [
            SendGridResponse::HEADER_RATELIMIT_LIMIT => [100],
            SendGridResponse::HEADER_RATELIMIT_REMAINING => [25],
            SendGridResponse::HEADER_RATELIMIT_RESET => [$resetTimestamp]
        ];
    }

    public function tearDown()
    {
        unset($this->validPaginationLink);
        unset($this->validHttpResponse);
        unset($this->sendGridResponse);
        parent::tearDown();
    }

    public function testGetContentType()
    {
        $this->hasHttpResponse();
        $this->sendGridResponse = new SendGridResponse($this->validHttpResponse);
        $actualContentType = $this->sendGridResponse->getContentType();
        $this->assertEquals(SendGridResponse::CONTENT_TYPE_JSON, $actualContentType);
    }

    public function testIsContentTypeJsonReturnsTrueWhenContentTypeEqualsJson()
    {
        $this->hasHttpResponse();
        $this->sendGridResponse = new SendGridResponse($this->validHttpResponse);
        $actualResult = $this->sendGridResponse->isContentTypeJson();
        $this->assertTrue($actualResult);
    }

    public function testIsContentTypeJsonReturnFalseWhenContentTypeIsNotJson()
    {
        $this->hasHttpResponse(['Content-Type'=>'not json']);
        $this->sendGridResponse = new SendGridResponse($this->validHttpResponse);
        $actualResult = $this->sendGridResponse->isContentTypeJson();
        $this->assertFalse($actualResult);
    }

    public function testGetErrorsReturnsEmptyArrayWhenContentTypeIsNotJson()
    {
        $this->hasHttpResponse(['Content-Type'=>'not json']);
        $this->sendGridResponse = new SendGridResponse($this->validHttpResponse);
        $actualErrors = $this->sendGridResponse->getErrors();
        $this->assertTrue(is_array($actualErrors));
        $this->assertEmpty($actualErrors);
    }

    public function testGetErrorsReturnsEmptyArrayWhenContentTypeIsJsonAndNoErrorsExist()
    {
        $this->hasHttpResponse();
        $this->sendGridResponse = new SendGridResponse($this->validHttpResponse);
        $actualErrors = $this->sendGridResponse->getErrors();
        $this->assertTrue(is_array($actualErrors));
        $this->assertEmpty($actualErrors);
    }

    public function testGetErrorsReturnsErrorsWhenContentTypeIsJsonAndErrorsExist()
    {
        $validError = ['message'=>'This is a valid error.'];
        $this->hasHttpResponse([], ['errors'=>$validError]);
        $this->sendGridResponse = new SendGridResponse($this->validHttpResponse);
        $actualErrors = $this->sendGridResponse->getErrors();
        $this->assertEquals($validError, $actualErrors);
    }

    public function testGetErrorMessageReturnsValidErrorMessage()
    {
        $validError = ['message'=>'This is a valid error.'];
        $this->hasHttpResponse();
        $this->sendGridResponse = new SendGridResponse($this->validHttpResponse);
        $actualErrorMessage = $this->sendGridResponse->getErrorMessage($validError);
        $this->assertEquals($validError['message'], $actualErrorMessage);
    }

    public function testGetPaginationLinksReturnsValidData()
    {
        $this->hasHttpResponse();
        $this->sendGridResponse = new SendGridResponse($this->validHttpResponse);
        $actualData = $this->sendGridResponse->getPaginationLinks();
        $this->assertEquals($this->validPaginationLink, $actualData);
    }

    public function testGetRateLimitReturnsValidRateLimitObject()
    {
        $this->hasHttpResponse();
        $this->sendGridResponse = new SendGridResponse($this->validHttpResponse);
        $actualRateLimit = $this->sendGridResponse->getRateLimit();
        $this->assertInstanceOf('\iDimensionz\SendGridWebApiV3\SendGridRateLimit', $actualRateLimit);
        $this->assertEquals(
            $this->validRateLimitValues[SendGridResponse::HEADER_RATELIMIT_LIMIT][0],
            $actualRateLimit->getLimit()
        );
        $this->assertEquals(
            $this->validRateLimitValues[SendGridResponse::HEADER_RATELIMIT_REMAINING][0],
            $actualRateLimit->getRemaining()
        );
        $expectedDateTime = new \DateTime();
        $this->assertEquals(
            $expectedDateTime->setTimestamp($this->validRateLimitValues[SendGridResponse::HEADER_RATELIMIT_RESET][0]),
            $actualRateLimit->getResetDateTime()
        );
    }

    private function hasHttpResponse($headers = [], $body = [])
    {
        $this->validHttpResponse = \Phake::mock('\iDimensionz\SendGridWebApiV3\Guzzle\HttpResponse');
        \Phake::when($this->validHttpResponse)->getStatusCode()
            ->thenReturn(200);
        $returnHeaders = array_merge($this->getValidHeaders(), $headers);
        \Phake::when($this->validHttpResponse)->getHeaders()
            ->thenReturn($returnHeaders);
        \Phake::when($this->validHttpResponse)->getHeader('Content-Type')
            ->thenReturn($returnHeaders['Content-Type']);
        \Phake::when($this->validHttpResponse)->getHeader('Link')
            ->thenReturn($returnHeaders['Link']);
        \Phake::when($this->validHttpResponse)->json()
            ->thenReturn($body);
    }

    /**
     * @return array
     */
    private function getValidHeaders()
    {
        return array_merge(
            $this->validRateLimitValues,
            [
                'Content-Type' => SendGridResponse::CONTENT_TYPE_JSON,
                'Link' => $this->validPaginationLink
            ]
        );
    }
}
 