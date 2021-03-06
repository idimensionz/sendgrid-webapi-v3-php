<?php
/*
 * iDimensionz/{sendgrid-webapi-v3}
 * AttachmentsDto.php
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

class AttachmentDto
{
    const DISPOSITION_INLINE = 'inline';
    const DISPOSITION_ATTACHMENT = 'attachment';

    /**
     * @var string
     */
    private $content;
    /**
     * @var string
     */
    private $type;
    /**
     * @var string
     */
    private $filename;
    /**
     * @var string
     */
    private $disposition;
    /**
     * @var string
     */
    private $contentId;
    /**
     * @var array
     */
    private $validDispositions;

    public function __construct($content, $filename, $type=null, $disposition=null, $contentId=null)
    {
        $this->setContent($content);
        $this->setFilename($filename);
        $this->setType($type);
        $this->setDisposition($disposition);
        $this->setContentId($contentId);
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent($content)
    {
        // @todo Content must be base64 encoded. Automatically do this from filename?
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
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * @param string $filename
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;
    }

    /**
     * @return string
     */
    public function getDisposition()
    {
        return $this->disposition;
    }

    /**
     * @param string $disposition
     */
    public function setDisposition($disposition)
    {
        if (!$this->isValidDisposition($disposition)) {
            $exceptionMessage = "Disposition '{$disposition}' invalid. Must be one of " .
                implode(', ', $this->getValidDispositions());
            throw new \InvalidArgumentException($exceptionMessage);
        }
        $this->disposition = $disposition;
        // Inline dispositions need an id
        if ($this->isDispositionInline() && empty($this->getContentId())) {
            $someUniqueId = time();
            $this->setContentId($someUniqueId);
        }
    }

    /**
     * @return string
     */
    public function getContentId()
    {
        return $this->contentId;
    }

    /**
     * @param string $contentId
     */
    public function setContentId($contentId)
    {
        $this->contentId = $contentId;
    }

    /**
     * @return array
     */
    public function getValidDispositions()
    {
        if (empty($this->validDispositions)) {
            $this->validDispositions = [
                self::DISPOSITION_INLINE,
                self::DISPOSITION_ATTACHMENT
            ];
        }

        return $this->validDispositions;
    }

    /**
     * Determines if a disposition is valid
     * @param string $disposition
     * @return bool
     */
    public function isValidDisposition($disposition)
    {
        return (bool) in_array($disposition, $this->validDispositions);
    }

    /**
     * @return bool
     */
    public function isDispositionInline()
    {
        return (bool) self::DISPOSITION_INLINE == $this->getDisposition();
    }

    /**
     * @return bool
     */
    public function isDispositionAttachment()
    {
        return (bool) self::DISPOSITION_ATTACHMENT == $this->getDisposition();
    }

    public function toArray()
    {
        $output = [];
        $output['content'] = $this->getContent();
        $output['type'] = $this->getType();
        $output['filename'] = $this->getFilename();
        $output['disposition'] = $this->getDisposition();
        $output['content_id'] = $this->getContentId();

        return $output;
    }
}
