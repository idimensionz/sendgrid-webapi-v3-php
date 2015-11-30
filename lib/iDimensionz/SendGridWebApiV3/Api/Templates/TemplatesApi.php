<?php
/*
 * iDimensionz/{sendgrid-webapi-v3}
 * TemplatesApi.php
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

use iDimensionz\SendGridWebApiV3\Api\SendGridApiEndpointAbstract;
use iDimensionz\SendGridWebApiV3\SendGridRequest;

class TemplatesApi extends SendGridApiEndpointAbstract
{
    const ENDPOINT = 'templates';

    /**
     * @param SendGridRequest $sendGridRequest
     */
    public function __construct(SendGridRequest $sendGridRequest)
    {
        parent::__construct($sendGridRequest, self::ENDPOINT);
    }

    /**
     * @return TemplateDto[]
     * @see https://sendgrid.com/docs/API_Reference/Web_API_v3/Template_Engine/templates.html#-GET
     */
    public function getAllTemplates()
    {
        $result = $this->get('');
        $templatesData = $result['templates'];
        $templateDtos = [];
        foreach ($templatesData as $templateData) {
            $templateDtos[] = new TemplateDto($templateData);
        }

        return $templateDtos;
    }

    /**
     * @param $name
     * @return TemplateDto
     * @throws \InvalidArgumentException
     */
    public function createTemplate($name)
    {
        if (TemplateDto::MAX_LENGTH_NAME < strlen($name)) {
            throw new \InvalidArgumentException('Name must be ' . TemplateDto::MAX_LENGTH_NAME . ' characters or less');
        }
        $options = ['name'  =>  $name];
        $templateData = $this->post('', $options);
        $templateDto = new TemplateDto($templateData);

        return $templateDto;
    }

    /**
     * @param string $templateId UUID of template to retrieve
     * @return TemplateDto
     */
    public function getTemplate($templateId)
    {
        $templateData = $this->get("/{$templateId}");
        $templateDto = new TemplateDto($templateData);

        return $templateDto;
    }

    /**
     * @param string $templateId UUID of template to update
     * @param string $newName
     * @return TemplateDto
     */
    public function updateTemplate($templateId, $newName)
    {
        if (TemplateDto::MAX_LENGTH_NAME < strlen($newName)) {
            throw new \InvalidArgumentException('Name must be ' . TemplateDto::MAX_LENGTH_NAME . ' characters or less');
        }
        $options = ['name' => $newName];
        $templateData = $this->patch("/{$templateId}", $options);
        $templateDto = new TemplateDto($templateData);

        return $templateDto;
    }

    /**
     * @param string $templateId UUID of the template to delete
     * @return bool  Returns true if the template was deleted. False otherwise.
     */
    public function deleteTemplate($templateId)
    {
        $this->delete("/{$templateId}");
        return (bool)(204 == $this->getLastSendGridResponse()->getStatusCode());
    }
}
 