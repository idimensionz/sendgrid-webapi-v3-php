<?php
/*
 * iDimensionz/{sendgrid-webapi-v3}
 * TemplateVersionDtoTest.php
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


use iDimensionz\SendGridWebApiV3\Api\Templates\TemplateVersionDto;

class TemplateVersionDtoTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var TemplateVersionDto $templateVersionDto
     */
    private $templateVersionDto;
    /**
     * @var array $validTemplateVersionData
     */
    private $validTemplateVersionData;

    public function setUp()
    {
        parent::setUp();
        $this->validTemplateVersionData = [];
    }

    public function tearDown()
    {
        unset($this->templateVersionDto);
        parent::tearDown();
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testConstructThrowsExceptionWhenDataDoesNotContainId()
    {
        $this->hasValidTemplateVersionData();
        $invalidTemplateVersionData = $this->validTemplateVersionData;
        unset($invalidTemplateVersionData['id']);
        $this->hasTemplateVersionDto($invalidTemplateVersionData);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testConstructThrowsExceptionWhenDataDoesNotContainTemplateId()
    {
        $this->hasValidTemplateVersionData();
        $invalidTemplateVersionData = $this->validTemplateVersionData;
        unset($invalidTemplateVersionData['template_id']);
        $this->hasTemplateVersionDto($invalidTemplateVersionData);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testConstructThrowsExceptionWhenDataDoesNotContainActive()
    {
        $this->hasValidTemplateVersionData();
        $invalidTemplateVersionData = $this->validTemplateVersionData;
        unset($invalidTemplateVersionData['active']);
        $this->hasTemplateVersionDto($invalidTemplateVersionData);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testConstructThrowsExceptionWhenDataDoesNotContainName()
    {
        $this->hasValidTemplateVersionData();
        $invalidTemplateVersionData = $this->validTemplateVersionData;
        unset($invalidTemplateVersionData['name']);
        $this->hasTemplateVersionDto($invalidTemplateVersionData);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testConstructThrowsExceptionWhenDataDoesNotContainUpdatedAt()
    {
        $this->hasValidTemplateVersionData();
        $invalidTemplateVersionData = $this->validTemplateVersionData;
        unset($invalidTemplateVersionData['updated_at']);
        $this->hasTemplateVersionDto($invalidTemplateVersionData);
    }

    public function testConstructWithEmptyArrayDoesNotSetAnyValues()
    {
        $this->hasTemplateVersionDto();
    }

    public function testConstructSetsSubjectHtmlContentAndPlainContentWhenSupplied()
    {
        $this->hasTemplateVersionDto();
        $this->assertEquals($this->validTemplateVersionData['subject'], $this->templateVersionDto->getSubject());
        $this->assertEquals(
            $this->validTemplateVersionData['html_content'],
            $this->templateVersionDto->getHtmlContent()
        );
        $this->assertEquals(
            $this->validTemplateVersionData['plain_content'],
            $this->templateVersionDto->getPlainContent()
        );
    }

    public function testConstructDoesNotSetSubjectHtmlContentAndPlainContentWhenNotSupplied()
    {
        $this->hasValidTemplateVersionData();
        unset($this->validTemplateVersionData['subject']);
        unset($this->validTemplateVersionData['html_content']);
        unset($this->validTemplateVersionData['plain_content']);
        $this->hasTemplateVersionDto($this->validTemplateVersionData);
        $this->assertNull($this->templateVersionDto->getSubject());
        $this->assertNull($this->templateVersionDto->getHtmlContent());
        $this->assertNull($this->templateVersionDto->getPlainContent());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testSetNameThrowsExceptionWhenNameLengthTooBig()
    {
        $this->hasTemplateVersionDto();
        $invalidName = 'This name is over 100 characters long.   ' .
            '1234567890123456789012345678901234567890123456789012345678901';
        $this->templateVersionDto->setName($invalidName);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testSetSubjectThrowsExceptionWhenSubjectTagMissing()
    {
        $this->hasTemplateVersionDto();
        $invalidSubject = 'Subject tag not here...move along';
        $this->templateVersionDto->setSubject($invalidSubject);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testSetHtmlContentThrowsExceptionWhenBodyTagMissing()
    {
        $this->hasTemplateVersionDto();
        $invalidHtmlContent = '<html><head></head><body>HTML content missing body tag...move along</body></html>';
        $this->templateVersionDto->setHtmlContent($invalidHtmlContent);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testSetHtmlContentThrowsExceptionWhenContentTooLarge()
    {
        $invalidContent = 'a';
        // Build a string that's too long
        for ($loop = 0; $loop <= TemplateVersionDto::MAX_LENGTH_HTML_CONTENT; $loop++) {
            $invalidContent .= 'a';
        }
        $this->assertGreaterThan(TemplateVersionDto::MAX_LENGTH_HTML_CONTENT, strlen($invalidContent));
        $this->hasTemplateVersionDto();
        $this->templateVersionDto->setHtmlContent($invalidContent);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testSetPlainContentThrowsExceptionWhenBodyTagMissing()
    {
        $this->hasTemplateVersionDto();
        $invalidContent = 'Plaing content missing body tag...move along';
        $this->templateVersionDto->setPlainContent($invalidContent);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testSetPlainContentThrowsExceptionWhenContentTooLarge()
    {
        $invalidContent = 'a';
        // Build a string that's too long
        for ($loop = 0; $loop <= TemplateVersionDto::MAX_LENGTH_PLAIN_CONTENT; $loop++) {
            $invalidContent .= 'a';
        }
        $this->assertGreaterThan(TemplateVersionDto::MAX_LENGTH_PLAIN_CONTENT, strlen($invalidContent));
        $this->hasTemplateVersionDto();
        $this->templateVersionDto->setPlainContent($invalidContent);
    }

    public function testToArrayReturnsValidArray()
    {
        $this->hasTemplateVersionDto();
        $actualArray = $this->templateVersionDto->toArray();
        $this->assertEquals($this->validTemplateVersionData, $actualArray);
    }

    /**
     * @param array|null $templateVersionData
     */
    private function hasTemplateVersionDto($templateVersionData = null)
    {
        if (is_null($templateVersionData)) {
            $this->hasValidTemplateVersionData();
            $templateVersionData = $this->validTemplateVersionData;
        }
        $this->templateVersionDto = new TemplateVersionDto($templateVersionData);
    }

    private function hasValidTemplateVersionData()
    {
        $this->validTemplateVersionData = [
            'id'            =>  '8aefe0ee-f12b-4575-b5b7-c97e21cb36f3',
            'template_id'   =>  'e3a61852-1acb-4b32-a1bc-b44b3814ab78',
            'active'        =>  1,
            'name'          =>  'This is a valid template version name.',
            'html_content'  =>  '<%body%>',
            'plain_content' =>  '<%body%>',
            'subject'       =>  '<%subject%>',
            'updated_at'    =>  '2015-11-14 14:00:00'
        ];
    }
}
 