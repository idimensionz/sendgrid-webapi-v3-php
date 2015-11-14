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
    /**
     * @var TemplateVersionDto
     */
    private $validVersion;

    public function setUp()
    {
        parent::setUp();
        $this->validId = '733ba07f-ead1-41fc-933a-3976baa23716';
        $this->validName = 'This is a valid template name';
        $this->validVersion = new TemplateVersionDto([
            'id'            =>  $this->validId,
            'template_id'   =>  'e3a61852-1acb-4b32-a1bc-b44b3814ab78',
            'active'        =>  1,
            'name'          =>  $this->validName,
            'html_content'  =>  '<%body%>',
            'plain_content' =>  '<%body%>',
            'subject'       =>  '<%subject%>',
            'updated_at'    =>  '2015-11-14 10:45:00'
        ]);
        $this->validVersions = [
            $this->validVersion->toArray()
        ];

        $this->hasTemplateDto();
    }

    public function tearDown()
    {
        unset($this->validId);
        unset($this->validName);
        unset($this->validVersion);
        unset($this->validVersions);
        unset($this->templateDto);
        parent::tearDown();
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testConstructThrowsExceptionWhenDataDoesNotContainId()
    {
        $templateData = $this->hasTemplateData();
        unset($templateData['id']);
        $this->hasTemplateDto($templateData);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testConstructThrowsExceptionWhenDataDoesNotContainName()
    {
        $templateData = $this->hasTemplateData();
        unset($templateData['name']);
        $this->hasTemplateDto($templateData);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testConstructThrowsExceptionWhenDataDoesNotContainVersions()
    {
        $templateData = $this->hasTemplateData();
        unset($templateData['versions']);
        $this->hasTemplateDto($templateData);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testConstructThrowsExceptionWhenVersionsIsNotAnArray()
    {
        $templateData = $this->hasTemplateData();
        $templateData['versions'] = 'This is not an array';
        $this->hasTemplateDto($templateData);
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
        $this->assertEquals($this->validVersion, $this->templateDto->getVersions()[0]);
    }

    /**
     * @param array|null $templateData
     */
    private function hasTemplateDto($templateData = null)
    {
        if (is_null($templateData)) {
            $templateData = $this->hasTemplateData();
        }
        $this->templateDto = new TemplateDto($templateData);
    }

    /**
     * @return array
     */
    private function hasTemplateData()
    {
        $templateData = [];
        $templateData['id'] = $this->validId;
        $templateData['name'] = $this->validName;
        $templateData['versions'] = $this->validVersions;
        return $templateData;
    }
}
 