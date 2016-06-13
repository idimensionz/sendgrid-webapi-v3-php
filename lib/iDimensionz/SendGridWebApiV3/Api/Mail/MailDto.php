<?php
/*
 * iDimensionz/{sendgrid-webapi-v3}
 * MailDto.php
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

class MailDto
{
    const DATE_FORMAT = 'Y-m-d';

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

    public function __construct()
    {
        $this->personalizations = [];
        $this->attachments = [];
        $this->sections = [];
        $this->headers = [];
        $this->categories = [];
        $this->content = [];
        $this->type = [];
    }

    /**
     * @param string $emailAddress
     * @param string|null $name
     */
    public function addTo($emailAddress, $name=null)
    {
        $to = new EmailAddressDto($emailAddress, $name);
        $personalizationDto = new PersonalizationDto();
        $personalizationDto->setTo($to);
        $this->setPersonalizations([$personalizationDto]);
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
     * @param string $emailAddress
     * @param string|null $name
     */
    public function setFrom($emailAddress, $name=null)
    {
        $this->from = new EmailAddressDto($emailAddress, $name);
    }

    /**
     * @return EmailAddressDto
     */
    public function getReplyTo()
    {
        return $this->replyTo;
    }

    /**
     * @param string $emailAddress
     * @param string|null $name
     */
    public function setReplyTo($emailAddress, $name=null)
    {
        $this->replyTo = new EmailAddressDto($emailAddress, $name);
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
     * @param string $html
     */
    public function addHtmlContent($html)
    {
        $this->content[1] = ['type'=>'html', 'value'=>$html];
    }

    /**
     * @param string $text
     */
    public function addTextContent($text)
    {
        $this->content[0] = ['type'=>'text', 'value'=>$text];
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
     * @param int $groupId
     * @param int[] $displayGroups
     */
    public function addAsm($groupId, $displayGroups=null)
    {
        $asm = new AsmDto($groupId, $displayGroups);
        $this->asm = $asm;
    }

    /**
     * @param AsmDto $asmDto
     */
    public function setAsm(AsmDto $asmDto)
    {
        $this->asm = $asmDto;
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

    public function toArray()
    {
        $output = [];
        $personalizationData = [];
        $personalizations = $this->getPersonalizations();
        foreach ($personalizations as $personalizationDto) {
            $personalizationData[] = $personalizationDto->toArray();
        }
        $output['personalizations'] = $personalizationData;
        if (!empty($this->getFrom())) {
            $output['from'] = $this->getFrom()->toArray();
        }
        if (!empty($this->getReplyTo())) {
            $output['reply_to'] = $this->getReplyTo()->toArray();
        }
        $output['subject'] = $this->getSubject();
        $output['content'] = $this->getContent();
        $output['type'] = $this->getType();
        $output['value'] = $this->getValue();
        if (!empty($this->getAttachments())) {
            $attachmentsData = [];
            $attachments = $this->getAttachments();
            foreach ($attachments as $attachmentDto) {
                $attachmentsData[] = $attachmentDto->toArray();
            }
            $output['attachments'] = $attachmentsData;
        }
        if (!empty($this->getTemplateId())) {
            $output['template_id'] = $this->getTemplateId();
        }
        if (!empty($this->getSections())) {
            $output['sections'] = $this->getSections();
        }
        if (!empty($this->getHeaders())) {
            $output['headers'] = $this->getHeaders();
        }
        if (!empty($this->getCategories())) {
            $output['categories'] = $this->getCategories();
        }
        if (!empty($this->getCustomArguments())) {
            $output['custom_args'] = $this->getCustomArguments();
        }
        if (!empty($this->getSendAt())) {
            $output['send_at'] = $this->getSendAt()->format(self::DATE_FORMAT);
        }
        if (!empty($this->getBatchId())) {
            $output['batch_id'] = $this->getBatchId();
        }
        if (!empty($this->getAsm())) {
            $output['asm'] = $this->getAsm()->toArray();
        }
        if (!empty($this->getIpPoolName())) {
            $output['ip_pool_name'] = $this->getIpPoolName();
        }
        if (!empty($this->getMailSettings())) {
            $output['mail_settings'] = $this->getMailSettings()->toArray();
        }
        if (!empty($this->getTrackingSettings())) {
            $output['tracking_settings'] = $this->getTrackingSettings()->toArray();
        }

        return $output;
    }
}
