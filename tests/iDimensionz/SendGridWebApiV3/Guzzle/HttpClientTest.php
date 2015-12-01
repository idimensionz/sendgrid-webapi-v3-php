<?php
/*
 * iDimensionz/{sendgrid-webapi-v3}
 * HttpClientTest.php
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

namespace Tests\iDimensionz\SendGridWebApiV3\Guzzle;

require_once 'HttpClientCase.php';

use iDimensionz\SendGridWebApiV3\Guzzle\HttpClient;
use iDimensionz\SendGridWebApiV3\Guzzle\HttpClientCase;
use GuzzleHttp\Stream\Stream;

class HttpClientTest extends \PHPUnit_Framework_TestCase
{
    private $guzzleResponse;
    private $validStatusCode;
    private $validHeaders;
    private $validBody;

    public function setUp()
    {
        parent::setUp();
        $this->validStatusCode = '400';
        $this->validHeaders = [['valid header']];
        $this->validBody = Stream::factory('valid body');
    }

    public function tearDown()
    {
        unset($this->validStatusCode);
        unset($this->validHeaders);
        unset($this->validBody);
        parent::tearDown();
    }

    public function testConstruct()
    {
        $instance = new HttpClient();
        $this->assertInstanceOf('\GuzzleHttp\Client', $instance);
        $this->assertInstanceOf('\iDimensionz\SendGridWebApiV3\HttpClientInterface', $instance);
    }

    public function testGetResponseOptionsReturnsEmptyOptionsWhenReasonPhraseAndProtocolVersionEmpty()
    {
        $this->hasGuzzleResponse([]);
        $httpClient = new HttpClientCase();
        $actualOptions = $httpClient->getResponseOptions($this->guzzleResponse);
        $this->assertTrue(is_array($actualOptions));
        $this->assertTrue(empty($actualOptions));
    }

    public function testGetResponseOptionsReturnsOptionsWhenReasonPhraseAndProtocolVersionNotEmpty()
    {
        $expectedOptions = ['reason_phrase'=>'valid reason', 'protocol_version'=>'1.1'];
        $this->hasGuzzleResponse($expectedOptions);
        $httpClient = new HttpClientCase();
        $actualOptions = $httpClient->getResponseOptions($this->guzzleResponse);
        $this->assertTrue(is_array($actualOptions));
        $this->assertTrue(array_key_exists('reason_phrase', $actualOptions));
        $this->assertTrue(array_key_exists('protocol_version', $actualOptions));
        $this->assertEquals($expectedOptions, $actualOptions);
    }

    public function testGetHttpResponseReturnsHttpResponse()
    {
        $expectedOptions = ['reason_phrase'=>'valid reason', 'protocol_version'=>'1.1'];
        $this->hasGuzzleResponse($expectedOptions);
        $httpClient = new HttpClientCase();
        $actualHttpResponse = $httpClient->getHttpResponse($this->guzzleResponse);
        $this->assertInstanceOf('\iDimensionz\SendGridWebApiV3\Guzzle\HttpResponse', $actualHttpResponse);
        $this->assertEquals($this->validBody, $actualHttpResponse->getBody());
        $this->assertEquals($this->validHeaders, $actualHttpResponse->getHeaders());
        $this->assertEquals($this->validStatusCode, $actualHttpResponse->getStatusCode());
        $this->assertEquals($expectedOptions['reason_phrase'], $actualHttpResponse->getReasonPhrase());
        $this->assertEquals($expectedOptions['protocol_version'], $actualHttpResponse->getProtocolVersion());
    }

    /**
     * @param array $options
     */
    private function hasGuzzleResponse(array $options)
    {
        $this->guzzleResponse = \Phake::mock('\GuzzleHttp\Message\Response');
        $reasonPhrase = '';
        if (array_key_exists('reason_phrase', $options)) {
            $reasonPhrase = $options['reason_phrase'];
        }
        \Phake::when($this->guzzleResponse)->getReasonPhrase()
            ->thenReturn($reasonPhrase);
        $actualReasonPhrase = $this->guzzleResponse->getReasonPhrase();
        $this->assertEquals($reasonPhrase, $actualReasonPhrase);

        $protocolVersion = '';
        if (array_key_exists('protocol_version', $options)) {
            $protocolVersion = $options['protocol_version'];
        }
        \Phake::when($this->guzzleResponse)->getProtocolVersion()
            ->thenReturn($protocolVersion);
        $actualProtocolVersion = $this->guzzleResponse->getProtocolVersion();
        $this->assertEquals($protocolVersion, $actualProtocolVersion);
        \Phake::when($this->guzzleResponse)->getStatusCode()
            ->thenReturn($this->validStatusCode);
        \Phake::when($this->guzzleResponse)->getHeaders()
            ->thenReturn($this->validHeaders);
        \Phake::when($this->guzzleResponse)->getBody()
            ->thenReturn($this->validBody);
    }
}
 