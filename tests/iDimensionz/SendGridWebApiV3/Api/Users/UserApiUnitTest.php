<?php
/*
 * iDimensionz/{sendgrid-webapi-v3}
 * UserApiUnitTest.php
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

namespace Tests\iDimensionz\SendGridWebApiV3\Api\Users;

use Tests\iDimensionz\SendGridWebApiV3\Api\ApiUnitTestAbstract;
use iDimensionz\SendGridWebApiV3\Api\Users\UserAccountDto;
use iDimensionz\SendGridWebApiV3\Api\Users\UserApi;
use iDimensionz\SendGridWebApiV3\Api\Users\UserProfileDto;

class UserApiUnitTest extends ApiUnitTestAbstract
{
    /**
     * @var UserApi $userApi
     */
    private $userApi;
    /**
     * @var UserProfileDto $validUserProfileDto
     */
    private $validUserProfileDto;
    /**
     * @var UserAccountDto $validUserAccountDto
     */
    private $validUserAccountDto;

    public function setUp()
    {
        parent::setUp();
        $this->setEndPoint(UserApi::ENDPOINT);
        $this->validUserProfileDto = new UserProfileDto(
            [
                'first_name' => 'Ima',
                'last_name' => 'Test',
                'address' => '123 Main Street',
                'city' => 'Whoville',
                'state' => 'PA',
                'zip' => '12345-6789',
                'country' => 'USA',
                'website' => 'http://communique.idimensionz.com',
                'company' => 'iDimensionz',
                'phone' => '484-455-4WEB'
            ]
        );
        $this->validUserAccountDto = new UserAccountDto(
            [
                'type' => 'free',
                'reputation' => 99.7
            ]
        );
    }

    public function tearDown()
    {
        unset($this->validUserAccountDto);
        unset($this->validUserProfileDto);
        unset($this->userApi);
        parent::tearDown();
    }

    public function testGetProfileReturnsUserProfileDto()
    {
        $this->hasSendGridGetRequest('profile', json_encode($this->validUserProfileDto->toArray()));
        $actualUserProfile = $this->userApi->getProfile();
        $this->assertEquals($this->validUserProfileDto, $actualUserProfile);
    }

    public function testUpdateProfile()
    {
        $this->validUserProfileDto->setFirstName('Shesa');
        $this->validUserProfileDto->setLastName('Nuthertest');
        $this->hasSendGridPatchRequest('profile', json_encode($this->validUserProfileDto->toArray()), $this->validUserProfileDto->getUpdatedFields());
        $actualUserProfileDto = $this->userApi->updateProfile($this->validUserProfileDto);
        // Unset the updated fields since the result profile won't have modified fields
        $this->validUserProfileDto->setUpdatedFields([]);
        $this->assertEquals($this->validUserProfileDto, $actualUserProfileDto);
    }

    public function testGetAccountReturnUserAccountDto()
    {
        $this->hasSendGridGetRequest('account', json_encode($this->validUserAccountDto->toArray()));
        $actualUserAccountDto = $this->userApi->getAccount();
        $this->assertEquals($this->validUserAccountDto, $actualUserAccountDto);
    }

    /**
     * @param string $command
     * @param $content
     */
    protected function hasSendGridGetRequest($command, $content)
    {
        parent::hasSendGridGetRequest($command, $content);
        $this->userApi = new UserApi($this->sendGridRequest);
    }

    /**
     * @param $command
     * @param $data
     */
    protected function hasSendGridPatchRequest($command, $dto, $data)
    {
        parent::hasSendGridPatchRequest($command, $dto, $data);
        $this->userApi = new UserApi($this->sendGridRequest);
    }
}
 