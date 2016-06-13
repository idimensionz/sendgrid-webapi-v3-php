<?php
/*
 * iDimensionz/{sendgrid-webapi-v3}
 * PersonalizationsDto.php
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

class PersonalizationDto
{
    const DATE_FORMAT = 'Y-m-d';

    /**
     * @var EmailAddressDto[]
     */
    private $to;
    /**
     * @var EmailAddressDto[]
     */
    private $cc;
    /**
     * @var EmailAddressDto[]
     */
    private $bcc;
    /**
     * @var string
     */
    private $subject;
    /**
     * @var mixed
     * @todo Create Headers class
     */
    private $headers;
    /**
     * @var mixed $subtitutions Associative array in the form of "tag"=>"substitution value"
     * @todo create key/value substitutions
     */
    private $substitutions;
    /**
     * @var mixed
     * @todo create customArguments class
     */
    private $customArguments;
    /**
     * @var \DateTime
     */
    private $sendAt;

    /**
     * @return EmailAddressDto[]
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * @param EmailAddressDto[] $to
     */
    public function setTo($to)
    {
        $this->to = $to;
    }

    /**
     * @return EmailAddressDto[]
     */
    public function getCc()
    {
        return $this->cc;
    }

    /**
     * @param EmailAddressDto[] $cc
     */
    public function setCc($cc)
    {
        $this->cc = $cc;
    }

    /**
     * @return EmailAddressDto[]
     */
    public function getBcc()
    {
        return $this->bcc;
    }

    /**
     * @param EmailAddressDto[] $bcc
     */
    public function setBcc($bcc)
    {
        $this->bcc = $bcc;
    }

    /**
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param string $subject
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    /**
     * @return mixed
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * @param mixed $headers
     */
    public function setHeaders($headers)
    {
        $this->headers = $headers;
    }

    /**
     * @return array
     */
    public function getSubstitutions()
    {
        return $this->substitutions;
    }

    /**
     * @param array $substitutions
     */
    public function setSubstitutions($substitutions)
    {
        $this->substitutions = $substitutions;
    }

    /**
     * @return mixed
     */
    public function getCustomArguments()
    {
        return $this->customArguments;
    }

    /**
     * @param mixed $customArguments
     */
    public function setCustomArguments($customArguments)
    {
        $this->customArguments = $customArguments;
    }

    /**
     * @return \DateTime
     */
    public function getSendAt()
    {
        return $this->sendAt;
    }

    /**
     * @return int
     */
    public function getSendAtTimestamp()
    {
        return $this->sendAt->getTimestamp();
    }

    /**
     * @param \DateTime $sendAt
     */
    public function setSendAt(\DateTime $sendAt)
    {
        $this->sendAt = $sendAt;
    }

    public function toArray()
    {
        $output = [];
        // @todo implement this function.
        $output['to'] = $this->getTo()->toArray();
        $output['cc'] = $this->getCc()->toArray();
        $output['bcc'] = $this->getBcc()->toArray();
        $output['subject'] = $this->getSubject();
        $output['headers'] = $this->getHeaders();
        $output['substitutions'] = $this->getSubstitutions();
        $output['custom_args'] = $this->getCustomArguments();
        $output['send_at'] = $this->getSendAt()->format(self::DATE_FORMAT);
        return $output;
    }
}
