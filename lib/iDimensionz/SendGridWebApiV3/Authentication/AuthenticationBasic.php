<?php
/*
 * iDimensionz/{sendgrid-webapi-v3}
 * AuthenticationBasic.php
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

namespace iDimensionz\SendGridWebApiV3\Authentication;

use InvalidArgumentException;

/**
 * Implements HTTP Basic authentication for a request
 * Class AuthenticationBasic
 * @package iDimensionz\SendGridWebApiV3\Authentication
 */
class AuthenticationBasic extends AuthenticationAbstract
{
    /**
     * @var string $userName
     */
    private $userName;
    /**
     * @var string password
     */
    private $password;

    /**
     * @return string
     */
    private function getUserName()
    {
        return $this->userName;
    }

    /**
     * @param string $userName
     * @throws InvalidArgumentException
     */
    private function setUserName($userName)
    {
        if (!is_string($userName)) {
            throw new InvalidArgumentException('Basic Authentication: User Name must be a string.');
        }
        $this->userName = $userName;
    }

    /**
     * @return string
     */
    private function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @throws InvalidArgumentException
     */
    private function setPassword($password)
    {
        if (!is_string($password)) {
            throw new InvalidArgumentException('Basic Authentication: Password must be a string.');
        }
        $this->password = $password;
    }

    /**
     * @param array $authenticationData
     * @throws InvalidArgumentException
     */
    public function setAuthentication($authenticationData)
    {
        if (!is_array($authenticationData) || 2 !== count($authenticationData)) {
            throw new InvalidArgumentException(
                'Basic Authentication: Authentication Data must be an array containing username and password'
            );
        }

        if (array_key_exists('username', $authenticationData) && array_key_exists('password', $authenticationData)) {
            $this->setUserName($authenticationData['username']);
            $this->setPassword($authenticationData['password']);
        } else {
            $this->setUserName($authenticationData[0]);
            $this->setPassword($authenticationData[1]);
        }

        $authenticationOption = [
            $this->getUserName(),
            $this->getPassword()
        ];
        $this->setOptions($authenticationOption);
    }
}
 