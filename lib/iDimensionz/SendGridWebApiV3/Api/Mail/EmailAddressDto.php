<?php
/*
 * iDimensionz/{sendgrid-webapi-v3}
 * EmailAddress.php
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


class EmailAddressDto
{
    /**
     * @var string
     */
    private $emailAddress;
    /**
     * @var string
     */
    private $name;

    public function __construct($emailAddress, $name=null)
    {
        $this->setEmailAddress($emailAddress);
        $this->setName($name);
    }

    /**
     * @return string
     */
    public function getEmailAddress()
    {
        return $this->emailAddress;
    }

    /**
     * @param string $emailAddress
     */
    public function setEmailAddress($emailAddress)
    {
        // @todo Validate $emailAddress
        $this->emailAddress = $emailAddress;
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
     * @throws \InvalidArgumentException
     */
    public function setName($name)
    {
        if (!is_null($name) && !is_string($name)) {
            throw new \InvalidArgumentException('Name must be a string');
        }
        $this->name = $name;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $output = [
            'email' => $this->getEmailAddress()
        ];
        // Include the name if supplied.
        if (!is_null($this->getName())) {
            $output['name'] = $this->getName();
        }

        return $output;
    }
}
