<?php
/*
 * iDimensionz/{sendgrid-webapi-v3}
 * Response.php
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

class SendGridResponse
{
    const HEADER_RATELIMIT_LIMIT = 'X-Ratelimit-Limit';
    const HEADER_RATELIMIT_REMAINING = 'X-Ratelimit-Remaining';
    const HEADER_RATELIMIT_RESET = 'X-Ratelimit-Reset';

    const CONTENT_TYPE_JSON = 'application/json';

    const STATUS_CODE_NO_ERROR = 200;
    const STATUS_CODE_SUCCESSFULLY_CREATED = 201;
    const STATUS_CODE_SUCCESSFULLY_DELETED = 204;
    const STATUS_CODE_BAD_REQUEST = 400;
    const STATUS_CODE_REQUIRES_AUTHENTICATION = 401;
    const STATUS_CODE_TOO_MANY_REQUESTS = 429;
    const STATUS_CODE_INTERNAL_SERVER_ERROR = 500;

    /**
     * @var HttpResponseInterface $httpResponse
     */
    private $httpResponse;
    /**
     * @var SendGridRateLimit $rateLimit
     */
    private $rateLimit;

    public function __construct(HttpResponseInterface $httpResponse)
    {
        $this->setHttpResponse($httpResponse);
        $headers = $this->getHttpResponse()->getHeaders();
        $this->rateLimit = new SendGridRateLimit(
            $headers[self::HEADER_RATELIMIT_LIMIT][0],
            $headers[self::HEADER_RATELIMIT_REMAINING][0],
            $headers[self::HEADER_RATELIMIT_RESET][0]
        );
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        $body = ($this->isContentTypeJson()) ? $this->httpResponse->json() : [];
        $errors = (isset($body['errors'])) ? $body['errors'] : [];

        return $errors;
    }

    public function getErrorMessage($error)
    {
        $errorMessage = array_key_exists('message', $error) ? $error['message'] : '';
        return $errorMessage;
    }

    /**
     * @return string
     */
    public function getContentType()
    {
        return $this->httpResponse->getHeader('Content-Type');
    }

    /**
     * @return bool
     */
    public function isContentTypeJson()
    {
        return self::CONTENT_TYPE_JSON == $this->getContentType();
    }

    /**
     * @return string
     */
    public function getPaginationLinks()
    {
        return $this->httpResponse->getHeader('Link');
    }

    /**
     * @return SendGridRateLimit
     */
    public function getRateLimit()
    {
        return $this->rateLimit;
    }

    /**
     * @return string|array
     */
    public function getContent()
    {
        $content = $this->isContentTypeJson() ? $this->getHttpResponse()->json() : $this->getHttpResponse()->getBody();

        return $content;
    }
    /**
     * @return HttpResponseInterface
     */
    protected function getHttpResponse()
    {
        return $this->httpResponse;
    }

    /**
     * @param HttpResponseInterface $httpResponse
     */
    protected function setHttpResponse($httpResponse)
    {
        $this->httpResponse = $httpResponse;
    }
}
 