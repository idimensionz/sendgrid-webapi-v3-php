<?php
/*
 * iDimensionz/{sendgrid-webapi-v3}
 * MailApi.php
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

namespace iDimensionz\SendGridWebApiV3\Api\Mail;

use iDimensionz\SendGridWebApiV3\Api\SendGridApiEndpointAbstract;
use iDimensionz\SendGridWebApiV3\SendGridRequest;

class MailApi extends SendGridApiEndpointAbstract
{
    const ENDPOINT = 'mail';

    /**
     * @var bool
     * @todo move initialization to __construct()
     */
    private $isBeta;

    /**
     * @param SendGridRequest $sendGridRequest
     */
    public function __construct(SendGridRequest $sendGridRequest)
    {
        parent::__construct($sendGridRequest, self::ENDPOINT);
        $this->isBeta = true;
    }

    /**
     * @param MailDto $mailDto
     * @return bool
     */
    public function isReadyToSend(MailDto $mailDto)
    {
        $isReady = true;
        // Check personalizations.
        $personalizationCount = count($mailDto->getPersonalizations());
        $isReady = $isReady && $personalizationCount > 0 && $personalizationCount < 101;
        if ($isReady) {
            foreach ($mailDto->getPersonalizations() as $personalization) {
                // check "to" for each personalization
                $isReady = $isReady && count($personalization->getTo()) > 0;
            }
        } else {
            echo 'Personalizations needed';
        }
        if ($isReady) {
            // Check subject
            $isReady = $isReady && !empty($mailDto->getSubject());
        } else {
            echo 'Subject empty' . PHP_EOL;
        }
        if ($isReady) {
            // Check content
            $isReady = $isReady && count($mailDto->getContent()) > 0;
        } else {
            echo 'No Content' . PHP_EOL;
        }
        if ($isReady) {
            // Check type
            $isReady = $isReady && strlen($mailDto->getType()) > 0;
        } else {
            echo 'No type' . PHP_EOL;
        }
        if ($isReady) {
            // Check value
            $isReady = $isReady && strlen($mailDto->getValue()) > 0;
        } else {
            echo 'No value' . PHP_EOL;
        }

        return $isReady;
    }

    /**
     * @param MailDto $mailDto
     * @return string
     */
    public function send(MailDto $mailDto)
    {
        $result = '';
        if ($this->isReadyToSend($mailDto)) {
            $command = 'send' . ($this->isBeta() ? '/beta' : '');
var_dump(__METHOD__.'/Command: '.$command);
            $data = $mailDto->toArray();
var_dump(__METHOD__.'/data: '.$data);
            $result = $this->post($command, $data);
        } else {
            $result = "Not ready to send";
        }

        return $result;
    }

    /**
     * @return boolean
     */
    public function isBeta()
    {
        return $this->isBeta;
    }

    /**
     * @param boolean $isBeta
     */
    public function setIsBeta($isBeta)
    {
        $this->isBeta = $isBeta;
    }
}
