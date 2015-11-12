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

use iDimensionz\SendGridWebApiV3\Api\Users\UserAccountDto;
use iDimensionz\SendGridWebApiV3\Api\Users\UserApi;
use iDimensionz\SendGridWebApiV3\Api\Users\UserProfileDto;

class UserApiUnitTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var UserApi $userApi
     */
    private $userApi;
    private $sendGridRequest;
    private $sendGridResponse;
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
        $this->validUserProfileDto = new UserProfileDto(
            [
                'first_name'    =>  'Ima',
                'last_name'     =>  'Test',
                'address'       =>  '123 Main Street',
                'city'          =>  'Whoville',
                'state'         =>  'PA',
                'zip'           =>  '12345-6789',
                'country'       =>  'USA',
                'website'       =>  'http://communique.idimensionz.com',
                'company'       =>  'iDimensionz',
                'phone'         =>  '484-455-4WEB'
            ]
        );
        $this->validUserAccountDto = new UserAccountDto(
            [
                'type'          => 'free',
                'reputation'    =>  99.7
            ]
        );
        parent::setUp();
    }

    public function tearDown()
    {
        unset($this->validUserAccountDto);
        unset($this->validUserProfileDto);
        unset($this->userApi);
        unset($this->sendGridRequest);
        parent::tearDown();
    }

    public function testGetProfileReturnsUserProfileDto()
    {
        $this->hasSendGridGetRequest('profile', $this->validUserProfileDto);
        $actualUserProfile = $this->userApi->getProfile();
        $this->assertEquals($this->validUserProfileDto, $actualUserProfile);
    }

    public function testUpdateProfile()
    {
        $this->validUserProfileDto->setFirstName('Shesa');
        $this->validUserProfileDto->setLastName('Nuthertest');
        $this->hasSendGridPatchRequest('profile', $this->validUserProfileDto->getUpdatedFields());
        $actualUserProfileDto = $this->userApi->updateProfile($this->validUserProfileDto);
        // Unset the updated fields since the result profile won't have modified fields
        $this->validUserProfileDto->setUpdatedFields([]);
        $this->assertEquals($this->validUserProfileDto, $actualUserProfileDto);
    }

    public function testGetAccountReturnUserAccountDto()
    {
        $this->hasSendGridGetRequest('account', $this->validUserAccountDto);
        $actualUserAccountDto = $this->userApi->getAccount();
        $this->assertEquals($this->validUserAccountDto, $actualUserAccountDto);
    }

    /**
     * @param string $command
     * @param $dto
     */
    private function hasSendGridGetRequest($command, $dto)
    {
        $this->hasSendGridRequest();
        $this->hasSendGridResponse();
        \Phake::when($this->sendGridResponse)->getContent()
            ->thenReturn(json_encode($dto->toArray()));
        \Phake::when($this->sendGridRequest)->get(UserApi::ENDPOINT . '/' . $command)
            ->thenReturn($this->sendGridResponse);
        $this->userApi = new UserApi($this->sendGridRequest);
    }

    private function hasSendGridPatchRequest($command, $data)
    {
        $this->hasSendGridRequest();
        $this->hasSendGridResponse();
        \Phake::when($this->sendGridResponse)->getContent()
            ->thenReturn(json_encode($this->validUserProfileDto->toArray()));
        $this->assertEquals(json_encode($this->validUserProfileDto->toArray()), $this->sendGridResponse->getContent());
        \Phake::when($this->sendGridRequest)->patch(UserApi::ENDPOINT . '/' . $command, ['body' => $data])
            ->thenReturn($this->sendGridResponse);
        $this->userApi = new UserApi($this->sendGridRequest);
    }

    private function hasSendGridRequest()
    {
        $this->sendGridRequest = \Phake::mock('\iDimensionz\SendGridWebApiV3\SendGridRequest');
    }

    private function hasSendGridResponse()
    {
        $this->sendGridResponse = \Phake::mock('\iDimensionz\SendGridWebApiV3\SendGridResponse');
    }
}
 