<?php
/*
 * iDimensionz/{sendgrid-webapi-v3}
 * TemplateDtoUnitTest.php
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

namespace Tests\iDimensionz\SendGridWebApiV3\Api\Templates;

use iDimensionz\SendGridWebApiV3\Api\Templates\TemplateDto;
use iDimensionz\SendGridWebApiV3\Api\Templates\TemplateVersionDto;

class TemplateDtoUnitTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var TemplateDto
     */
    private $templateDto;
    /**
     * @var string
     */
    private $validId;
    /**
     * @var string
     */
    private $validName;
    /**
     * @var TemplateVersionDto[]
     */
    private $validVersions;

    public function setUp()
    {
        parent::setUp();
        $this->validId = '733ba07f-ead1-41fc-933a-3976baa23716';
        $this->validName = 'This is a valid template name';
        $this->validVersions = [];

        $this->hasTemplateDto();
    }

    public function tearDown()
    {
        unset($this->validId);
        unset($this->validName);
        unset($this->validVersions);
        unset($this->templateDto);
        parent::tearDown();
    }

    public function testConstructReturnsInstanceOfTemplateDto()
    {
        $this->assertTemplateDto();
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testSetNameThrowsExceptionWhenNameIsTooLong()
    {
        $invalidName = 'This name is over 100 characters long.   ' .
            '1234567890123456789012345678901234567890123456789012345678901';
        $this->templateDto->setName($invalidName);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testSetVersionsThrowsExceptionWhenVersionsIsNotAnArray()
    {
        $invalidVersions = 'This is not an array';
        $this->templateDto->setVersions($invalidVersions);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testSetVersionsThrowsExceptionWhenVersionsArrayDoesNotContainTemplateVersionDto()
    {
        $invalidVersions = ['This is not a TemplateVersionDto'];
        $this->templateDto->setVersions($invalidVersions);
    }

    public function testToArrayReturnsArrayWithValidData()
    {
        $actualArray = $this->templateDto->toArray();
        $this->assertTrue(is_array($actualArray));
        $this->assertArrayHasKey('id', $actualArray);
        $this->assertEquals($this->validId, $actualArray['id']);
        $this->assertArrayHasKey('name', $actualArray);
        $this->assertEquals($this->validName, $actualArray['name']);
        $this->assertArrayHasKey('versions', $actualArray);
        $this->assertEquals($this->validVersions, $actualArray['versions']);
    }

    private function assertTemplateDto()
    {
        $this->assertInstanceOf('\iDimensionz\SendGridWebApiV3\Api\Templates\TemplateDto', $this->templateDto);
        $this->assertEquals($this->validId, $this->templateDto->getId());
        $this->assertEquals($this->validName, $this->templateDto->getName());
        $this->assertEquals($this->validVersions, $this->templateDto->getVersions());
    }

    private function hasTemplateDto()
    {
        $templateData = [];
        $templateData['id'] = $this->validId;
        $templateData['name'] = $this->validName;
        $templateData['versions'] = $this->validVersions;
        $this->templateDto = new TemplateDto($templateData);
    }
}
 