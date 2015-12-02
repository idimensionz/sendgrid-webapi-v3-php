<?php
/*
 * iDimensionz/{sendgrid-webapi-v3}
 * ApiUnitTestAbstract.php
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

class ApiUnitTestAbstract extends \PHPUnit_Framework_TestCase
{
    protected $sendGridRequest;
    protected $sendGridResponse;
    protected $endPoint;

    public function setUp()
    {
        parent::setUp();
    }

    public function tearDown()
    {
        unset($this->sendGridRequest);
        unset($this->sendGridResponse);
        unset($this->endPoint);
        parent::tearDown();
    }

    /**
     * @return mixed
     */
    protected function getEndPoint()
    {
        return $this->endPoint;
    }

    /**
     * @param mixed $endPoint
     */
    protected function setEndPoint($endPoint)
    {
        $this->endPoint = $endPoint;
    }

    protected function hasSendGridRequest()
    {
        $this->sendGridRequest = \Phake::mock('\iDimensionz\SendGridWebApiV3\SendGridRequest');
    }

    protected function hasSendGridResponse()
    {
        $this->sendGridResponse = \Phake::mock('\iDimensionz\SendGridWebApiV3\SendGridResponse');
    }

    /**
     * @param string $command
     * @param $content
     */
    protected function hasSendGridGetRequest($command, $content)
    {
        $this->hasSendGridRequest();
        $this->hasSendGridResponse();
        \Phake::when($this->sendGridResponse)->getContent()
            ->thenReturn($content);
        if (!empty($command)) {
            $command = "/{$command}";
        }
        $endPoint = $this->getEndPoint();
        $url = $endPoint . $command;
        \Phake::when($this->sendGridRequest)->get($url)
            ->thenReturn($this->sendGridResponse);
    }

    /**
     * @param $command
     * @param $content
     * @param $data
     */
    protected function hasSendGridPatchRequest($command, $content, $data)
    {
        $this->hasSendGridRequest();
        $this->hasSendGridResponse();
        \Phake::when($this->sendGridResponse)->getContent()
            ->thenReturn($content);
        $this->assertEquals($content, $this->sendGridResponse->getContent());
        if (!empty($command)) {
            $command = "/{$command}";
        }
        $endPoint = $this->getEndPoint();
        $url = $endPoint . $command;
        \Phake::when($this->sendGridRequest)->patch($url, ['body' => $data])
            ->thenReturn($this->sendGridResponse);
    }

    /**
     * @param string $command
     * @param string $content
     * @param mixed $data
     */
    protected function hasSendGridPostRequest($command, $content, $data)
    {
        $this->hasSendGridRequest();
        $this->hasSendGridResponse();
        \Phake::when($this->sendGridResponse)->getContent()
            ->thenReturn($content);
        $this->assertEquals($content, $this->sendGridResponse->getContent());
        if (!empty($command)) {
            $command = "/{$command}";
        }
        $endPoint = $this->getEndPoint();
        $url = $endPoint . $command;
        \Phake::when($this->sendGridRequest)->post($url, ['body' => $data])
            ->thenReturn($this->sendGridResponse);
    }

    /**
     * @param string $command
     * @param int $statusCode
     */
    protected function hasSendGridDeleteRequest($command, $statusCode)
    {
        $this->hasSendGridRequest();
        $this->hasSendGridResponse();
        \Phake::when($this->sendGridResponse)->getStatusCode()
            ->thenReturn($statusCode);
        if (!empty($command)) {
            $command = "/{$command}";
        }
        $endPoint = $this->getEndPoint();
        $url = $endPoint . $command;
        \Phake::when($this->sendGridRequest)->delete($url)
            ->thenReturn($this->sendGridResponse);
    }
}
