<?php
/*
 * iDimensionz/{sendgrid-webapi-v3}
 * AsmDto.php
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

class AsmDto
{
    /**
     * @var int
     */
    private $groupId;
    /**
     * @var int[]
     */
    private $displayGroups;

    /**
     * @param int $groupId
     * @param int[]|null $displayGroups
     */
    public function __construct($groupId, $displayGroups = null)
    {
        $this->setGroupId($groupId);
        $this->setDisplayGroups($displayGroups);
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $output = [
            'group_id'          => $this->getGroupId(),
        ];
        if (!empty($this->getDisplayGroups())) {
            $output['groups_to_display'] = $this->getDisplayGroups();
        }

        return $output;
    }

    /**
     * @return int
     */
    public function getGroupId()
    {
        return $this->groupId;
    }

    /**
     * @param int $groupId
     */
    public function setGroupId($groupId)
    {
        $this->groupId = $groupId;
    }

    /**
     * @return int[]
     */
    public function getDisplayGroups()
    {
        return $this->displayGroups;
    }

    /**
     * @param int[] $displayGroups
     */
    public function setDisplayGroups($displayGroups)
    {
        $this->displayGroups = $displayGroups;
    }
}
