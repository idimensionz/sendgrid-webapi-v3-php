<?php
/*
 * iDimensionz/{sendgrid-webapi-v3}
 * HttpClient.php
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

namespace iDimensionz\SendGridWebApiV3\Guzzle;

use GuzzleHttp\Client;
use GuzzleHttp\Message\ResponseInterface;
use iDimensionz\SendGridWebApiV3\HttpClientInterface;

/**
 * A Guzzle specific implementation of the HttpClientInterface.
 * Class HttpClient
 * @package iDimensionz\SendGridWebApiV3
 */
class HttpClient extends Client implements HttpClientInterface
{
    public function __construct(array $config = [])
    {
        parent::__construct($config);
    }

    /**
     * @param array $headers
     */
    public function setDefaultHeaders(array $headers)
    {
        $this->setDefaultOption('headers', $headers);
    }

    /**
     * @param string $url
     * @param array $options
     * @return \GuzzleHttp\Message\FutureResponse|\GuzzleHttp\Message\ResponseInterface|\GuzzleHttp\Ring\Future\FutureInterface|HttpResponse|\iDimensionz\SendGridWebApiV3\HttpResponseInterface|null
     */
    public function get($url = null, $options = [])
    {
        $guzzleResponse = parent::get($url, $options);
        $response = $this->getHttpResponse($guzzleResponse);

        return $response;
    }

    /**
     * @param ResponseInterface $guzzleResponse
     * @return mixed
     */
    protected function getResponseOptions($guzzleResponse)
    {
        $options = [];
        $reasonPhrase = $guzzleResponse->getReasonPhrase();
        if (!empty($reasonPhrase)) {
            $options['reason_phrase'] = $reasonPhrase;
        }
        $protocolVersion = $guzzleResponse->getProtocolVersion();
        if (!empty($protocolVersion)) {
            $options['protocol_version'] = $protocolVersion;
            return $options;
        }

        return $options;
    }

    /**
     * @param ResponseInterface $guzzleResponse
     * @return HttpResponse
     */
    protected function getHttpResponse($guzzleResponse)
    {
        $options = $this->getResponseOptions($guzzleResponse);
        $response = new HttpResponse(
            $guzzleResponse->getStatusCode(),
            $guzzleResponse->getHeaders(),
            $guzzleResponse->getBody(),
            $options
        );

        return $response;
    }
}
 