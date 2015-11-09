<?php
/*
 * iDimensionz/{sendgrid-webapi-v3}
 * Profile.php
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

namespace iDimensionz\SendGridWebApiV3\Api\User;

class UserProfile
{
    /**
     * @var string $address
     */
    private $address;
    /**
     * @var string $city
     */
    private $city;
    /**
     * @var string $company
     */
    private $company;
    /**
     * @var string $country
     */
    private $country;
    /**
     * @var string $firstName
     */
    private $firstName;
    /**
     * @var string $lastName
     */
    private $lastName;
    /**
     * @var string $phone
     */
    private $phone;
    /**
     * @var string state
     */
    private $state;
    /**
     * @var string $website
     */
    private $website;
    /**
     * @var string $zip
     */
    private $zip;

    /**
     * @var array Fields that have been updated.
     */
    private $updatedFields;

    /**
     * @param array $profile
     */
    public function __construct(array $profile)
    {
        $this->setAddress($profile['address']);
        $this->setCity($profile['city']);
        $this->setCompany($profile['company']);
        $this->setCountry($profile['country']);
        $this->setFirstName($profile['first_name']);
        $this->setLastName($profile['last_name']);
        $this->setPhone($profile['phone']);
        $this->setState($profile['state']);
        $this->setWebsite($profile['website']);
        $this->setZip($profile['zip']);
        // Mark all fields as unmodified.
        $this->setUpdatedFields([]);
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
        $this->addUpdatedField('address', $address);
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $city
     */
    public function setCity($city)
    {
        $this->city = $city;
        $this->addUpdatedField('city', $city);
    }

    /**
     * @return string
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param string $company
     */
    public function setCompany($company)
    {
        $this->company = $company;
        $this->addUpdatedField('company', $company);
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param string $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
        $this->addUpdatedField('country', $country);
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
        $this->addUpdatedField('first_name', $firstName);
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
        $this->addUpdatedField('last_name', $lastName);
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
        $this->addUpdatedField('phone', $phone);
    }

    /**
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param string $state
     */
    public function setState($state)
    {
        $this->state = $state;
        $this->addUpdatedField('state', $state);
    }

    /**
     * @return string
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * @param string $website
     */
    public function setWebsite($website)
    {
        $this->website = $website;
        $this->addUpdatedField('website', $website);
    }

    /**
     * @return string
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * @param string $zip
     */
    public function setZip($zip)
    {
        $this->zip = $zip;
        $this->addUpdatedField('zip', $zip);
    }

    /**
     * @return array
     */
    public function getUpdatedFields()
    {
        return $this->updatedFields;
    }

    /**
     * @param array $updatedFields
     */
    public function setUpdatedFields($updatedFields)
    {
        $this->updatedFields = $updatedFields;
    }

    /**
     * @param $field
     * @param $value
     */
    public function addUpdatedField($field, $value)
    {
        $this->updatedFields[$field] = $value;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $output = [];
        $output['address'] = $this->getAddress();
        $output['city'] = $this->getCity();
        $output['company'] = $this->getCompany();
        $output['country'] = $this->getCountry();
        $output['first_name'] = $this->getFirstName();
        $output['last_name'] = $this->getLastName();
        $output['phone'] = $this->getPhone();
        $output['state'] = $this->getState();
        $output['website'] = $this->getWebsite();
        $output['zip'] = $this->getZip();

        return $output;
    }
}
 