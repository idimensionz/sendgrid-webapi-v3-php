<?php
/*
 * iDimensionz/{sendgrid-webapi-v3}
 * MailSettingsDto.php
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

class MailSettingsDto
{
    /**
     * @var boolean
     */
    private $isBccEnabled;
    /**
     * @var string
     */
    private $bccEmailAddress;
    /**
     * @var boolean
     */
    private $bypassListManagement;
    /**
     * @var boolean
     */
    private $isFooterEnabled;
    /**
     * @var string
     */
    private $footerText;
    /**
     * @var string
     */
    private $footerHtml;
    /**
     * @var boolean
     */
    private $isSandboxModeEnabled;
    /**
     * @var boolean
     */
    private $isSpamCheckEnabled;
    /**
     * @var int
     */
    private $spamCheckThreshold;
    /**
     * @var string
     */
    private $spamCheckPostToUrl;

    /**
     * @return boolean
     */
    public function isBccEnabled()
    {
        return $this->isBccEnabled;
    }

    /**
     * @param boolean $isBccEnabled
     */
    public function setIsBccEnabled($isBccEnabled)
    {
        $this->isBccEnabled = $isBccEnabled;
    }

    /**
     * @return string
     */
    public function getBccEmailAddress()
    {
        return $this->bccEmailAddress;
    }

    /**
     * @param string $bccEmailAddress
     */
    public function setBccEmailAddress($bccEmailAddress)
    {
        $this->bccEmailAddress = $bccEmailAddress;
    }

    /**
     * @return boolean
     */
    public function isBypassListManagement()
    {
        return $this->bypassListManagement;
    }

    /**
     * @param boolean $bypassListManagement
     */
    public function setBypassListManagement($bypassListManagement)
    {
        $this->bypassListManagement = $bypassListManagement;
    }

    /**
     * @return boolean
     */
    public function isFooterEnabled()
    {
        return $this->isFooterEnabled;
    }

    /**
     * @param boolean $isFooterEnabled
     */
    public function setIsFooterEnabled($isFooterEnabled)
    {
        $this->isFooterEnabled = $isFooterEnabled;
    }

    /**
     * @return string
     */
    public function getFooterText()
    {
        return $this->footerText;
    }

    /**
     * @param string $footerText
     */
    public function setFooterText($footerText)
    {
        $this->footerText = $footerText;
    }

    /**
     * @return string
     */
    public function getFooterHtml()
    {
        return $this->footerHtml;
    }

    /**
     * @param string $footerHtml
     */
    public function setFooterHtml($footerHtml)
    {
        $this->footerHtml = $footerHtml;
    }

    /**
     * @return boolean
     */
    public function isSandboxModeEnabled()
    {
        return $this->isSandboxModeEnabled;
    }

    /**
     * @param boolean $isSandboxModeEnabled
     */
    public function setIsSandboxModeEnabled($isSandboxModeEnabled)
    {
        $this->isSandboxModeEnabled = $isSandboxModeEnabled;
    }

    /**
     * @return boolean
     */
    public function isSpamCheckEnabled()
    {
        return $this->isSpamCheckEnabled;
    }

    /**
     * @param boolean $isSpamCheckEnabled
     */
    public function setIsSpamCheckEnabled($isSpamCheckEnabled)
    {
        $this->isSpamCheckEnabled = $isSpamCheckEnabled;
    }

    /**
     * @return int
     */
    public function getSpamCheckThreshold()
    {
        return $this->spamCheckThreshold;
    }

    /**
     * @param int $spamCheckThreshold
     */
    public function setSpamCheckThreshold($spamCheckThreshold)
    {
        $this->spamCheckThreshold = $spamCheckThreshold;
    }

    /**
     * @return string
     */
    public function getSpamCheckPostToUrl()
    {
        return $this->spamCheckPostToUrl;
    }

    /**
     * @param string $spamCheckPostToUrl
     */
    public function setSpamCheckPostToUrl($spamCheckPostToUrl)
    {
        $this->spamCheckPostToUrl = $spamCheckPostToUrl;
    }
}
