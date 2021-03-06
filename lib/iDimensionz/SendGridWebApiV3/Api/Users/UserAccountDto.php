<?php
/*
 * iDimensionz/{sendgrid-webapi-v3}
 * UserAccount.php
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

namespace iDimensionz\SendGridWebApiV3\Api\Users;

use iDimensionz\Api\DtoInterface;

class UserAccountDto implements DtoInterface
{
    /**
     * @var string $type    Free, Silver, etc.
     */
    private $type;
    /**
     * @var float $reputation
     */
    private $reputation;

    /**
     * @param array $account
     */
    public function __construct(array $account)
    {
        $this->setType($account['type']);
        $this->setReputation($account['reputation']);
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
     * @return float
     */
    public function getReputation()
    {
        return $this->reputation;
    }

    /**
     * @param float $reputation
     */
    public function setReputation($reputation)
    {
        $this->reputation = (float) $reputation;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $output = [];
        $output['type'] = $this->getType();
        $output['reputation'] = $this->getReputation();

        return $output;
    }
}
 