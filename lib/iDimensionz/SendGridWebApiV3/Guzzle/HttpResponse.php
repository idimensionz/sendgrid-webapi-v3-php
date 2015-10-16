<?php
/*
 * iDimensionz/{sendgrid-webapi-v3}
 * HttpResponse.php
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

use GuzzleHttp\Message\Response;
use GuzzleHttp\Stream\Stream;
use GuzzleHttp\Stream\StreamInterface;
use iDimensionz\SendGridWebApiV3\HttpResponseInterface;

class HttpResponse extends Response implements HttpResponseInterface
{
    /**
     * @param int|string      $statusCode The response status code (e.g. 200)
     * @param array           $headers    The response headers
     * @param StreamInterface $body       The body of the response
     * @param array           $options    Response message options
     *     - reason_phrase: Set a custom reason phrase
     *     - protocol_version: Set a custom protocol version
     */
    public function __construct(
        $statusCode,
        array $headers = [],
        StreamInterface $body = null,
        array $options = []
    ) {
        parent::__construct($statusCode, $headers, $body, $options);
    }

    public function getBody()
    {
        return parent::getBody()->getContents();
    }

    public function setBodyContent($body)
    {
        parent::setBody(Stream::factory($body));
    }
}
 