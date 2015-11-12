<?php
/*
 * iDimensionz/{sendgrid-webapi-v3}
 * UserProfileUnitTest.php
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

use iDimensionz\SendGridWebApiV3\Api\Users\UserProfileDto;

class UserProfileDtoUnitTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var UserProfileDto $userProfile
     */
    private $userProfile;
    /**
     * @var array $expectedData
     */
    private $expectedData;

    public function setUp()
    {
        parent::setUp();
        $this->expectedData = [
            'address'   =>  '123 Main Street',
            'city'      =>  'Anytown',
            'company'   =>  'iDimensionz',
            'country'   =>  'USA',
            'first_name'    =>  'Ima',
            'last_name'     =>  'Tester',
            'phone'     =>  '484-455-4WEB',
            'state'     =>  'PA',
            'website'   =>  'http://communique.idimensionz.com',
            'zip'       =>  '12345-6789'
        ];
        $this->userProfile = new UserProfileDto($this->expectedData);
    }

    public function tearDown()
    {
        unset($this->userProfile);
        parent::tearDown();
    }

    public function testConstruct()
    {
        $this->assertUserProfile();
        $this->assertEquals([], $this->userProfile->getUpdatedFields());
    }

    private function assertUserProfile()
    {
        $this->assertInstanceOf('\iDimensionz\SendGridWebApiV3\Api\Users\UserProfileDto', $this->userProfile);
        $this->assertEquals($this->expectedData, $this->userProfile->toArray());
        $this->assertEquals($this->expectedData['address'], $this->userProfile->getAddress());
        $this->assertEquals($this->expectedData['city'], $this->userProfile->getCity());
        $this->assertEquals($this->expectedData['company'], $this->userProfile->getCompany());
        $this->assertEquals($this->expectedData['country'], $this->userProfile->getCountry());
        $this->assertEquals($this->expectedData['first_name'], $this->userProfile->getFirstName());
        $this->assertEquals($this->expectedData['last_name'], $this->userProfile->getLastName());
        $this->assertEquals($this->expectedData['phone'], $this->userProfile->getPhone());
        $this->assertEquals($this->expectedData['state'], $this->userProfile->getState());
        $this->assertEquals($this->expectedData['website'], $this->userProfile->getWebsite());
        $this->assertEquals($this->expectedData['zip'], $this->userProfile->getZip());
    }
}
 