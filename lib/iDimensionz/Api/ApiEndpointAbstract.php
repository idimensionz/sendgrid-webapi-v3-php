<?php
/*
 * iDimensionz/{sendgrid-webapi-v3}
 * ApiEndpointAbstract.php
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

namespace iDimensionz\Api;

use iDimensionz\SendGridWebApiV3\SendGridRequest;
use iDimensionz\SendGridWebApiV3\SendGridResponse;

abstract class ApiEndpointAbstract
{
    const HTTP_METHOD_GET = "GET";
    const HTTP_METHOD_POST = "POST";
    const HTTP_METHOD_DELETE = "DELETE";
    const HTTP_METHOD_PUT = "PUT";
    const HTTP_METHOD_PATCH = "PATCH";
    const HTTP_METHOD_HEAD = "HEAD";
    const HTTP_METHOD_OPTIONS = "OPTIONS";

    //@todo Refactor out SendGrid specific references to make this abstract class more generic and reusable.
    /**
     * @var SendGridRequest $sendGridRequest
     */
    private $sendGridRequest;
    /**
     * @var string $httpMethod  One of the HTTP methods (GET, POST, etc)
     */
    private $httpMethod;
    /**
     * @var string $endpoint
     */
    private $endpoint;
    /**
     * @var SendGridResponse $lastSendGridResponse
     */
    private $lastSendGridResponse;

    /**
     * @param SendGridRequest $sendGridRequest
     * @param $endpoint
     */
    public function __construct(SendGridRequest $sendGridRequest, $endpoint)
    {
        $this->setSendGridRequest($sendGridRequest);
        $this->setEndpoint($endpoint);
    }

    /**
     * @param string $command
     * @return string
     */
    public function get($command)
    {
        if (!empty($command)) {
            $command = "/{$command}";
        }
        $this->setLastSendGridResponse($this->getSendGridRequest()->get($this->getEndpoint() . $command));
        return $this->getLastSendGridResponse()->getContent();
    }

    /**
     * @param string $command
     * @param string $data JSON encoded data
     * @return string
     */
    public function patch($command, $data)
    {
        $body = [
            'body' => $data
        ];
        if (!empty($command)) {
            $command = "/{$command}";
        }
        $this->setLastSendGridResponse(
            $this->getSendGridRequest()->patch($this->getEndpoint() . $command, $body)
        );

        return $this->getLastSendGridResponse()->getContent();
    }

    /**
     * @param string $command
     * @param array $data
     * @return string
     */
    public function post($command, $data)
    {
        $body = [
            'body'  =>  $data
        ];
        if (!empty($command)) {
            $command = "/{$command}";
        }
        $this->setLastSendGridResponse(
            $this->getSendGridRequest()->post($this->getEndpoint() . $command, $body)
        );

        return $this->getLastSendGridResponse()->getContent();
    }

    /**
     * @param $command
     * @return array|string
     */
    public function delete($command)
    {
        if (!empty($command)) {
            $command = "/{$command}";
        }
        $this->setLastSendGridResponse(
            $this->getSendGridRequest()->delete($this->getEndpoint() . $command)
        );

        return $this->getLastSendGridResponse()->getContent();

    }

    /**
     * @return SendGridResponse
     */
    protected function getLastSendGridResponse()
    {
        return $this->lastSendGridResponse;
    }

    /**
     * @param SendGridResponse $lastSendGridResponse
     */
    public function setLastSendGridResponse($lastSendGridResponse)
    {
        $this->lastSendGridResponse = $lastSendGridResponse;
    }

    /**
     * @return SendGridRequest
     */
    protected function getSendGridRequest()
    {
        return $this->sendGridRequest;
    }

    /**
     * @param SendGridRequest $sendGridRequest
     */
    public function setSendGridRequest($sendGridRequest)
    {
        $this->sendGridRequest = $sendGridRequest;
    }

    /**
     * @return string
     */
    protected function getHttpMethod()
    {
        return $this->httpMethod;
    }

    /**
     * @param string $httpMethod
     */
    public function setHttpMethod($httpMethod)
    {
        $this->httpMethod = $httpMethod;
    }

    /**
     * @return string
     */
    protected function getEndpoint()
    {
        return $this->endpoint;
    }

    /**
     * @param string $endpoint
     */
    public function setEndpoint($endpoint)
    {
        $this->endpoint = $endpoint;
    }
}
 