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
     * @var string $name
     */
    private $name;
    /**
     * @var \DateTime
     */
    private $updatedAt;

    public function __construct(array $templateVersionData)
    {
        if (!empty($templateVersionData)) {
            $this->setId($templateVersionData['id']);
            $this->setTemplateId($templateVersionData['template_id']);
            $this->setActive(1 == $templateVersionData['active']);
            $this->setName($templateVersionData['name']);
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
     * @return array
     */
    public function toArray()
    {
        $output = [];
        $output['id'] = $this->getId();
        $output['template_id'] = $this->getTemplateId();
        $output['active'] = $this->isActive();
        $output['name'] = $this->getName();
        $output['updated_at'] = $this->getUpdatedAt()->format('Y-m-d H:i:s');

        return $output;
    }
}
 