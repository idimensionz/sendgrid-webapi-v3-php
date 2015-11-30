<?php
/*
 * iDimensionz/{sendgrid-webapi-v3}
 * Request.php
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

namespace iDimensionz\SendGridWebApiV3;

use iDimensionz\SendGridWebApiV3\Authentication\AuthenticationInterface;
use iDimensionz\SendGridWebApiV3\Guzzle\HttpClient;

class SendGridRequest
{
    // @todo Inject API host into constructor
    const SENDGRID_API_HOST = 'https://api.sendgrid.com/v3/';

    /**
     * @var AuthenticationInterface $authentication
     */
    private $authentication;
    /**
     * @var HttpClientInterface $httpClient
     */
    private $httpClient;
    /**
     * @var string $apiHost URI to SendGrid API v3
     */
    private $apiHost;

    /**
     * @param AuthenticationInterface $authentication
     * @param string $apiHost
     * @param HttpClientInterface $httpClient
     */
    public function __construct(
        AuthenticationInterface $authentication,
        $apiHost,
        HttpClientInterface $httpClient = null
    ) {
        $this->setAuthentication($authentication);
        $this->setApiHost($apiHost);
        $this->setHttpClient($httpClient);
        // Default the Accept header to 'application/json'
        $this->getHttpClient()->setDefaultHeaders(['Accept' => 'application/json']);
    }

    /**
     * @param string $url
     * @param array $options
     * @return SendGridResponse
     */
    public function get($url = null, $options = [])
    {
        $options = $this->assembleOptions($options);
        $httpResponse = $this->getHttpClient()->get($url, $options);
        $sendGridResponse = new SendGridResponse($httpResponse);

        return $sendGridResponse;
    }

    /**
     * @param null $url
     * @param array $options
     * @return \iDimensionz\SendGridWebApiV3\SendGridResponse
     */
    public function patch($url = null, $options = [])
    {
        $options = $this->assembleOptions($options);
        $httpResponse = $this->getHttpClient()->patch($url, $options);
        $sendGridResponse = new SendGridResponse($httpResponse);

        return $sendGridResponse;
    }

    /**
     * @param string $url
     * @param array $options
     * @return SendGridResponse
     */
    public function post($url = null, $options = [])
    {
        $options = $this->assembleOptions($options);
        $httpResponse = $this->getHttpClient()->post($url, $options);
        $sendGridResponse = new SendGridResponse($httpResponse);

        return $sendGridResponse;
    }

    /**
     * @param null $url
     * @param array $options
     * @return SendGridResponse
     */
    public function delete($url = null, $options = [])
    {
        $options = $this->assembleOptions($options);
        $httpResponse = $this->getHttpClient()->delete($url, $options);
        $sendGridResponse = new SendGridResponse($httpResponse);

        return $sendGridResponse;
    }

    /**
     * @param AuthenticationInterface $authentication
     */
    public function setAuthentication($authentication)
    {
        $this->authentication = $authentication;
    }

    /**
     * @param HttpClientInterface $httpClient
     */
    public function setHttpClient($httpClient)
    {
        if (is_null($httpClient)) {
            $this->httpClient = new HttpClient(['base_url' => $this->apiHost]);
        } else {
            if (! $httpClient instanceof HttpClientInterface) {
                throw new \InvalidArgumentException('HTTP Client must be an instance of HttpClientInterface');
            }
            $this->httpClient = $httpClient;
        };
    }

    /**
     * @param string $apiHost
     */
    public function setApiHost($apiHost)
    {
        $this->apiHost = $apiHost;
    }

    /**
     * @return AuthenticationInterface
     */
    protected function getAuthentication()
    {
        return $this->authentication;
    }

    /**
     * @return HttpClientInterface
     */
    protected function getHttpClient()
    {
        return $this->httpClient;
    }

    /**
     * @param array $options
     * @return array
     */
    protected function assembleOptions(array $options)
    {
        $options = array_merge($options, $this->getAuthentication()->getOptions());

        return $options;
    }

    /**
     * @return string
     */
    protected function getApiHost()
    {
        return $this->apiHost;
    }
}