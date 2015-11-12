<?php
/*
 * iDimensionz/{sendgrid-webapi-v3}
 * TemplateDto.php
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

class TemplateDto implements DtoInterface
{
    /**
     * @var string $id UUID
     */
    private $id;
    /**
     * @var string $name
     */
    private $name;
    /**
     * @var TemplateVersionDto[] $versions
     */
    private $versions;

    public function __construct($templateData)
    {
        $this->setId($templateData['id']);
        $this->setName($templateData['name']);
        $versionsData = $templateData['versions'];
        $versionsDtos = [];
        foreach ($versionsData as $versionData) {
            $versionsDtos[] = new TemplateVersionDto($versionData);
        }
        $this->setVersions($versionsDtos);
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
     * @return TemplateVersionDto[]
     */
    public function getVersions()
    {
        return $this->versions;
    }

    /**
     * @param TemplateVersionDto[] $versions
     */
    public function setVersions($versions)
    {
        $this->versions = $versions;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $output = [];
        $output['id'] = $this->getId();
        $output['name'] = $this->getName();
        $versionDtos = $this->getVersions();
        $versionOutput = [];
        foreach ($versionDtos as $versionDto) {
            $versionOutput[] = $versionDto->toArray();
        }
        $output['versions'] = $versionOutput;

        return $output;
    }
}
 