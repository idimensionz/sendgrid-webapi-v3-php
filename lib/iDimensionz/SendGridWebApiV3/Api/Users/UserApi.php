<?php
/*
 * iDimensionz/{sendgrid-webapi-v3}
 * UserApi.php
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

use iDimensionz\SendGridWebApiV3\Api\SendGridApiEndpointAbstract;
use iDimensionz\SendGridWebApiV3\SendGridRequest;

class UserApi extends SendGridApiEndpointAbstract
{
    const ENDPOINT = 'user';

    /**
     * @param SendGridRequest $sendGridRequest
     */
    public function __construct(SendGridRequest $sendGridRequest)
    {
        parent::__construct($sendGridRequest, self::ENDPOINT);
    }

    /**
     * @return UserProfileDto
     */
    public function getProfile()
    {
        $profileContent = json_decode($this->get('profile'), true);
        $userProfileDto = new UserProfileDto($profileContent);

        return $userProfileDto;
    }

    /**
     * Updates the User Profile with any changed data (via setters).
     * @param UserProfileDto $userProfileDto
     * @return \iDimensionz\SendGridWebApiV3\Api\Users\UserProfileDto
     */
    public function updateProfile(UserProfileDto $userProfileDto)
    {
        $changedFieldData = $userProfileDto->getUpdatedFields();
        $profileContent = json_decode($this->patch('profile', $changedFieldData), true);
        $userProfileDto = new UserProfileDto($profileContent);

        return $userProfileDto;
    }

    /**
     * @return UserAccountDto
     */
    public function getAccount()
    {
        $accountContent = $this->get('account');
        $userAccountDto = new UserAccountDto($accountContent);

        return $userAccountDto;
    }
}
 