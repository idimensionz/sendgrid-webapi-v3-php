<?php
/*
 * iDimensionz/{sendgrid-webapi-v3}
 * HttpResponseTest.php
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


use iDimensionz\SendGridWebApiV3\Guzzle\HttpResponse;

class HttpResponseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var HttpResponse $httpResponse
     */
    private $httpResponse;
    /**
     * @var int $validStatusCode
     */
    private $validStatusCode;
    /**
     * @var string $validBody
     */
    private $validBody;

    public function setUp()
    {
        parent::setUp();
        $this->validStatusCode = 200;
        $this->validBody = json_encode(['some data', 2]);
        $this->httpResponse = new HttpResponse($this->validStatusCode);
    }

    public function tearDown()
    {
        unset($this->httpResponse);
        unset($this->validBody);
        unset($this->validStatusCode);
        parent::tearDown();
    }

    public function testConstruct()
    {
        $this->assertInstanceOf('\iDimensionz\SendGridWebApiV3\HttpResponseInterface', $this->httpResponse);
        $this->assertInstanceOf('GuzzleHttp\Message\Response', $this->httpResponse);
    }

    public function testBodySetterAndGetter()
    {
        $this->httpResponse->setBodyContent($this->validBody);
        $actualBody = $this->httpResponse->getBody();
        $this->assertEquals($this->validBody, $actualBody);
    }
}
 