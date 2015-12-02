<?php
/*
 * iDimensionz/{sendgrid-webapi-v3}
 * TemplatesApiUnitTest.php
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

use Tests\iDimensionz\SendGridWebApiV3\Api\ApiUnitTestAbstract;
use iDimensionz\SendGridWebApiV3\Api\Templates\TemplateDto;
use iDimensionz\SendGridWebApiV3\Api\Templates\TemplatesApi;
use iDimensionz\SendGridWebApiV3\Api\Templates\TemplateVersionDto;

class TemplatesApiUnitTest extends ApiUnitTestAbstract
{
    /**
     * @var TemplatesApi $templatesApi
     */
    private $templatesApi;
    /**
     * @var TemplateDto $validTemplateDto
     */
    private $validTemplateDto;
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
        $this->setEndPoint(TemplatesApi::ENDPOINT);
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
        $templateData = $this->hasTemplateData();
        $this->validTemplateDto = new TemplateDto($templateData);
    }

    public function tearDown()
    {
        parent::tearDown();
    }

    public function testGetAllReturnsAllTemplates()
    {
        $this->hasSendGridGetRequest('', ['templates' => [$this->validTemplateDto->toArray()]]);
        $actualTemplates = $this->templatesApi->getAllTemplates();
        $this->assertTemplateDtos($actualTemplates);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testCreateThrowsExceptionWhenNameIsTooLong()
    {
        $invalidName = 'This name is too long.'.
            '3456789023456789012345678901234567890123456789012345678901234567890123456789012';
        $this->hasSendGridPostRequest(
            '',
            json_encode(['templates' => [$this->validTemplateDto->toArray()]]),
            $invalidName
        );
        $this->templatesApi->createTemplate($invalidName);
    }

    public function testCreateReturnsTemplateDto()
    {
        $validName = "Valid Template Name";
        $this->validTemplateDto->setName($validName);
        $this->validTemplateDto->setVersions([]);
        /**
         * @var TemplateDto $actualTemplateDto
         */
        $this->hasSendGridPostRequest(
            '',
            $this->validTemplateDto->toArray(),
            ['name' => $validName]
        );
        $actualTemplateDto = $this->templatesApi->createTemplate($validName);
        $this->assertInstanceOf('\iDimensionz\SendGridWebApiV3\Api\Templates\TemplateDto', $actualTemplateDto);
        $this->assertEquals($validName, $actualTemplateDto->getName());
        $this->assertEquals([], $actualTemplateDto->getVersions());
    }

    public function testGetTemplateReturnsTemplateDto()
    {
        $this->hasSendGridGetRequest("/{$this->validId}", $this->validTemplateDto->toArray());
        $actualTemplate = $this->templatesApi->getTemplate($this->validId);
        $this->assertEquals($this->validTemplateDto, $actualTemplate);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testUpdateTemplateThrowsInvalidArgumentExceptionWhenNameTooLong()
    {
        $invalidName = str_repeat('0123456789', 31);
        $this->hasSendGridPatchRequest(
            "/{$this->validId}",
            $this->validTemplateDto->toArray(),
            ['name' => $invalidName]
        );
        $this->templatesApi->updateTemplate($this->validId, $invalidName);
        $this->fail('Exception not thrown');
    }

    public function testUpdateTemplateReturnsTemplateDto()
    {
        $this->hasSendGridPatchRequest(
            "/{$this->validId}",
            $this->validTemplateDto->toArray(),
            ['name' => $this->validName]
        );
        $actualTemplateDto = $this->templatesApi->updateTemplate($this->validId, $this->validName);
        $this->assertEquals($this->validTemplateDto, $actualTemplateDto);
    }

    public function testDeleteTemplateReturnsTrueWhenTemplateIsDeleted()
    {
        $this->hasSendGridDeleteRequest("/{$this->validId}", 204);
        $isDeleted = $this->templatesApi->deleteTemplate($this->validId);
        $this->assertTrue($isDeleted);
    }

    public function testDeletedTemplateReturnsFalseWhenTemplateNotDeleted()
    {
        $this->hasSendGridDeleteRequest("/{$this->validId}", 400);
        $isDeleted = $this->templatesApi->deleteTemplate($this->validId);
        $this->assertFalse($isDeleted);
    }

    /**
     * @param string $command
     * @param string $content
     */
    protected function hasSendGridGetRequest($command, $content)
    {
        parent::hasSendGridGetRequest($command, $content);
        $this->templatesApi = new TemplatesApi($this->sendGridRequest);
    }

    /**
     * @param string $command
     * @param string $content
     * @param mixed $data
     */
    protected function hasSendGridPostRequest($command, $content, $data)
    {
        parent::hasSendGridPostRequest($command, $content, $data);
        $this->templatesApi = new TemplatesApi($this->sendGridRequest);
    }

    /**
     * @param string $command
     * @param string $content
     * @param mixed $data
     */
    protected function hasSendGridPatchRequest($command, $content, $data)
    {
        parent::hasSendGridPatchRequest($command, $content, $data);
        $this->templatesApi = new TemplatesApi($this->sendGridRequest);
    }

    /**
     * @param string $command
     * @param int $statusCode
     */
    protected function hasSendGridDeleteRequest($command, $statusCode)
    {
        parent::hasSendGridDeleteRequest($command, $statusCode);
        $this->templatesApi = new TemplatesApi($this->sendGridRequest);
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

    /**
     * @param array $actualTemplateDtos
     */
    private function assertTemplateDtos($actualTemplateDtos)
    {
        $this->assertTrue(is_array($actualTemplateDtos));
        $this->assertEquals(1, count($actualTemplateDtos));
        $actualTemplateDto = $actualTemplateDtos[0];
        $this->assertEquals($this->validTemplateDto, $actualTemplateDto);
    }
}
