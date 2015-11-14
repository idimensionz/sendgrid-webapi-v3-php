<?php
/*
 * iDimensionz/{sendgrid-webapi-v3}
 * TemplateVersionDto.php
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

namespace iDimensionz\SendGridWebApiV3\Api\Templates;

use iDimensionz\Api\DtoInterface;

class TemplateVersionDto implements DtoInterface
{
    const MAX_LENGTH_PLAIN_CONTENT = 1048576;
    const MAX_LENGTH_HTML_CONTENT = 1048576;
    const MAX_LENGTH_NAME = 100;

    /**
     * @var string $id UUID
     */
    private $id;
    /**
     * @var string $id UUID
     */
    private $templateId;
    /**
     * @var bool
     */
    private $active;
    /**
     * @var string $name Maximum 100 characters
     */
    private $name;
    /**
     * @var string <%subject%> tag must be present
     */
    private $subject;
    /**
     * @var string <%body%> tag must be inside the content. Maximum of 1048576 bytes allowed for html content.
     */
    private $htmlContent;
    /**
     * @var string <%body%> tag must be inside the content. Maximum of 1048576 bytes allowed for plain content.
     */
    private $plainContent;
    /**
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @param array $templateVersionData
     */
    public function __construct(array $templateVersionData)
    {
        $this->validateArray($templateVersionData);
        if (!empty($templateVersionData)) {
            $this->setId($templateVersionData['id']);
            $this->setTemplateId($templateVersionData['template_id']);
            $this->setActive(1 === (int) $templateVersionData['active']);
            $this->setName($templateVersionData['name']);
            $this->setSubject($templateVersionData['subject']);
            $this->setHtmlContent($templateVersionData['html_content']);
            $this->setPlainContent($templateVersionData['plain_content']);
            $this->setUpdatedAt(new \DateTime($templateVersionData['updated_at']));
        }
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
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
     * @return boolean
     */
    public function isActive()
    {
        return $this->active;
    }

    /**
     * @param boolean $active
     */
    public function setActive($active)
    {
        $this->active = $active;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        // name must be MAX_LENGTH_NAME characters or less
        if (self::MAX_LENGTH_NAME < strlen($name)) {
            throw new \InvalidArgumentException('Name must be ' . self::MAX_LENGTH_NAME . ' characters or less');
        }
        $this->name = $name;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return string
     */
    public function getHtmlContent()
    {
        return $this->htmlContent;
    }

    /**
     * @param string $htmlContent
     */
    public function setHtmlContent($htmlContent)
    {
        if (false === strpos($htmlContent, '<%body%>')) {
            throw new \InvalidArgumentException('Plain Content must contain the <%body%> tag');
        }
        if (self::MAX_LENGTH_HTML_CONTENT < strlen($htmlContent)) {
            throw new \InvalidArgumentException(
                'HTML Content must be ' . self::MAX_LENGTH_HTML_CONTENT . ' bytes or less'
            );
        }
        $this->htmlContent = $htmlContent;
    }

    /**
     * @return string
     */
    public function getPlainContent()
    {
        return $this->plainContent;
    }

    /**
     * @param string $plainContent
     */
    public function setPlainContent($plainContent)
    {
        if (false === strpos($plainContent, '<%body%>')) {
            throw new \InvalidArgumentException('Plain Content must contain the <%body%> tag');
        }
        if (self::MAX_LENGTH_PLAIN_CONTENT < strlen($plainContent)) {
            throw new \InvalidArgumentException(
                'Plain Content must be ' . self::MAX_LENGTH_PLAIN_CONTENT . ' bytes or less');
        }
        $this->plainContent = $plainContent;
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
        if (false === strpos($subject, '<%subject%>')) {
            throw new \InvalidArgumentException('Subject must contain the <%subject%> tag');
        }
        $this->subject = $subject;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $output = [];
        $output['id'] = $this->getId();
        $output['template_id'] = $this->getTemplateId();
        $output['active'] = $this->isActive();
        $output['name'] = $this->getName();
        $output['html_content'] = $this->getHtmlContent();
        $output['plain_content'] = $this->getPlainContent();
        $output['subject'] = $this->getSubject();
        $output['updated_at'] = $this->getUpdatedAt()->format('Y-m-d H:i:s');

        return $output;
    }

    /**
     * Validates template version data is an array with all the expected keys
     * @param array $templateVersionData
     */
    private function validateArray($templateVersionData)
    {
        $isValid = true;
        $isValid = $isValid && is_array($templateVersionData);
        if ($isValid) {
            $keys = array_keys($templateVersionData);
            $isValid = $isValid &&
                in_array('id', $keys) &&
                in_array('template_id', $keys) &&
                in_array('active', $keys) &&
                in_array('name', $keys) &&
                in_array('html_content', $keys) &&
                in_array('plain_content', $keys) &&
                in_array('subject', $keys) &&
                in_array('updated_at', $keys);
        }

        if (!$isValid) {
            throw new \InvalidArgumentException('Template Version data must be an array and contain valid keys');
        }
    }
}
 