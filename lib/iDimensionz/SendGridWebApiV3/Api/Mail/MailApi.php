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

class MailApi
{
    /**
     * @var PersonalizationDto[]
     */
    private $personalizations;
    /**
     * @var EmailAddressDto
     */
    private $from;
    /**
     * @var EmailAddressDto
     */
    private $replyTo;
    /**
     * @var string
     */
    private $subject;
    /**
     * @var array
     * @todo define ContentTypeDto class
     */
    private $content;
    /**
     * @var string
     */
    private $type;
    /**
     * @var string
     */
    private $value;
    /**
     * @var AttachmentDto[]
     */
    private $attachments;
    /**
     * @var string
     */
    private $templateId;
    /**
     * @var mixed
     * @todo define key/value sections
     */
    private $sections;
    /**
     * @var mixed
     * @todo define key/value headers
     */
    private $headers;
    /**
     * @var string[]
     */
    private $categories;
    /**
     * @var mixed
     * @todo define key/value customArguments class
     */
    private $customArguments;
    /**
     * @var \DateTime
     */
    private $sendAt;
    /**
     * @var string
     */
    private $batchId;
    /**
     * @var AsmDto ASM/Unsubscribe data
     */
    private $asm;
    /**
     * @var string
     */
    private $ipPoolName;
    /**
     * @var MailSettingsDto
     */
    private $mailSettings;
    /**
     * @var TrackSettingsDto
     */
    private $trackingSettings;
    /**
     * @var bool
     * @todo move initialization to __construct()
     */
    private $isBeta = true;

    public function send()
    {
        //@todo flesh out this function
    }

    /**
     * @return PersonalizationDto[]
     */
    public function getPersonalizations()
    {
        return $this->personalizations;
    }

    /**
     * @param PersonalizationDto[] $personalizations
     */
    public function setPersonalizations($personalizations)
    {
        $this->personalizations = $personalizations;
    }

    /**
     * @return EmailAddressDto
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * @param EmailAddressDto $from
     */
    public function setFrom($from)
    {
        $this->from = $from;
    }

    /**
     * @return EmailAddressDto
     */
    public function getReplyTo()
    {
        return $this->replyTo;
    }

    /**
     * @param EmailAddressDto $replyTo
     */
    public function setReplyTo($replyTo)
    {
        $this->replyTo = $replyTo;
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
     * @return array
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param array $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @return AttachmentDto[]
     */
    public function getAttachments()
    {
        return $this->attachments;
    }

    /**
     * @param AttachmentDto[] $attachments
     */
    public function setAttachments($attachments)
    {
        $this->attachments = $attachments;
    }

    /**
     * @return string
     */
    public function getTemplateId()
    {
        return $this->templateId;
    }

    /**
     * @param string $templateId
     */
    public function setTemplateId($templateId)
    {
        $this->templateId = $templateId;
    }

    /**
     * @return mixed
     */
    public function getSections()
    {
        return $this->sections;
    }

    /**
     * @param mixed $sections
     */
    public function setSections($sections)
    {
        $this->sections = $sections;
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
     * @return \string[]
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * @param \string[] $categories
     */
    public function setCategories($categories)
    {
        $this->categories = $categories;
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
     * @param \DateTime $sendAt
     */
    public function setSendAt($sendAt)
    {
        $this->sendAt = $sendAt;
    }

    /**
     * @return string
     */
    public function getBatchId()
    {
        return $this->batchId;
    }

    /**
     * @param string $batchId
     */
    public function setBatchId($batchId)
    {
        $this->batchId = $batchId;
    }

    /**
     * @return AsmDto
     */
    public function getAsm()
    {
        return $this->asm;
    }

    /**
     * @param AsmDto $asm
     */
    public function setAsm($asm)
    {
        $this->asm = $asm;
    }

    /**
     * @return string
     */
    public function getIpPoolName()
    {
        return $this->ipPoolName;
    }

    /**
     * @param string $ipPoolName
     */
    public function setIpPoolName($ipPoolName)
    {
        $this->ipPoolName = $ipPoolName;
    }

    /**
     * @return MailSettingsDto
     */
    public function getMailSettings()
    {
        return $this->mailSettings;
    }

    /**
     * @param MailSettingsDto $mailSettings
     */
    public function setMailSettings($mailSettings)
    {
        $this->mailSettings = $mailSettings;
    }

    /**
     * @return TrackSettingsDto
     */
    public function getTrackingSettings()
    {
        return $this->trackingSettings;
    }

    /**
     * @param TrackSettingsDto $trackingSettings
     */
    public function setTrackingSettings($trackingSettings)
    {
        $this->trackingSettings = $trackingSettings;
    }

    /**
     * @return boolean
     */
    public function isIsBeta()
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
