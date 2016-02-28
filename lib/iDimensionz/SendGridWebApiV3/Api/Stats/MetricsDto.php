<?php
/*
 * iDimensionz/{sendgrid-webapi-v3}
 * MetricsDto.php
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

namespace iDimensionz\SendGridWebApiV3\Api\Stats;

class MetricsDto
{
    /**
     * @var array
     */
    private $metrics;
    /**
     * @var int
     */
    private $blocks;
    /**
     * @var int
     */
    private $bounceDrops;
    /**
     * @var int
     */
    private $bounces;
    /**
     * @var int
     */
    private $clicks;
    /**
     * @var int
     */
    private $deferred;
    /**
     * @var int
     */
    private $delivered;
    /**
     * @var int
     */
    private $invalidEmails;
    /**
     * @var int
     */
    private $opens;
    /**
     * @var int
     */
    private $processed;
    /**
     * @var int
     */
    private $requests;
    /**
     * @var int
     */
    private $spamReportDrops;
    /**
     * @var int
     */
    private $spamReports;
    /**
     * @var int
     */
    private $uniqueClicks;
    /**
     * @var int
     */
    private $uniqueOpens;
    /**
     * @var int
     */
    private $unsubscribeDrops;
    /**
     * @var int
     */
    private $unsubscribes;
    /**
     * @var string
     */
    private $name;
    /**
     * @var string|null
     */
    private $type;

    /**
     * @param array $metricsData
     */
    public function __construct(array $metricsData)
    {
        if (array_key_exists('metrics', $metricsData)) {
            $this->setMetrics($metricsData['metrics']);
            if (array_key_exists('name', $metricsData)) {
                $this->setName($metricsData['name']);
            }
            if (array_key_exists('type', $metricsData)) {
                $this->setType($metricsData['type']);
            }
        } else {
            throw new \InvalidArgumentException(
                'Metrics data must be an array containing metrics and optionally name and type indexes'
            );
        }
    }

    /**
     * @return int
     */
    public function getBlocks()
    {
        return $this->blocks;
    }

    /**
     * @param int $blocks
     */
    private function setBlocks($blocks)
    {
        $this->blocks = $blocks;
    }

    /**
     * @return int
     */
    public function getBounceDrops()
    {
        return $this->bounceDrops;
    }

    /**
     * @param int $bounceDrops
     */
    private function setBounceDrops($bounceDrops)
    {
        $this->bounceDrops = $bounceDrops;
    }

    /**
     * @return int
     */
    public function getBounces()
    {
        return $this->bounces;
    }

    /**
     * @param int $bounces
     */
    private function setBounces($bounces)
    {
        $this->bounces = $bounces;
    }

    /**
     * @return int
     */
    public function getClicks()
    {
        return $this->clicks;
    }

    /**
     * @param int $clicks
     */
    private function setClicks($clicks)
    {
        $this->clicks = $clicks;
    }

    /**
     * @return int
     */
    public function getDeferred()
    {
        return $this->deferred;
    }

    /**
     * @param int $deferred
     */
    private function setDeferred($deferred)
    {
        $this->deferred = $deferred;
    }

    /**
     * @return int
     */
    public function getDelivered()
    {
        return $this->delivered;
    }

    /**
     * @param int $delivered
     */
    private function setDelivered($delivered)
    {
        $this->delivered = $delivered;
    }

    /**
     * @return int
     */
    public function getInvalidEmails()
    {
        return $this->invalidEmails;
    }

    /**
     * @param int $invalidEmails
     */
    private function setInvalidEmails($invalidEmails)
    {
        $this->invalidEmails = $invalidEmails;
    }

    /**
     * @return int
     */
    public function getOpens()
    {
        return $this->opens;
    }

    /**
     * @param int $opens
     */
    private function setOpens($opens)
    {
        $this->opens = $opens;
    }

    /**
     * @return int
     */
    public function getProcessed()
    {
        return $this->processed;
    }

    /**
     * @param int $processed
     */
    private function setProcessed($processed)
    {
        $this->processed = $processed;
    }

    /**
     * @return int
     */
    public function getRequests()
    {
        return $this->requests;
    }

    /**
     * @param int $requests
     */
    private function setRequests($requests)
    {
        $this->requests = $requests;
    }

    /**
     * @return int
     */
    public function getSpamReportDrops()
    {
        return $this->spamReportDrops;
    }

    /**
     * @param int $spamReportDrops
     */
    private function setSpamReportDrops($spamReportDrops)
    {
        $this->spamReportDrops = $spamReportDrops;
    }

    /**
     * @return int
     */
    public function getSpamReports()
    {
        return $this->spamReports;
    }

    /**
     * @param int $spamReports
     */
    private function setSpamReports($spamReports)
    {
        $this->spamReports = $spamReports;
    }

    /**
     * @return int
     */
    public function getUniqueClicks()
    {
        return $this->uniqueClicks;
    }

    /**
     * @param int $uniqueClicks
     */
    private function setUniqueClicks($uniqueClicks)
    {
        $this->uniqueClicks = $uniqueClicks;
    }

    /**
     * @return int
     */
    public function getUniqueOpens()
    {
        return $this->uniqueOpens;
    }

    /**
     * @param int $uniqueOpens
     */
    private function setUniqueOpens($uniqueOpens)
    {
        $this->uniqueOpens = $uniqueOpens;
    }

    /**
     * @return int
     */
    public function getUnsubscribeDrops()
    {
        return $this->unsubscribeDrops;
    }

    /**
     * @param int $unsubscribeDrops
     */
    private function setUnsubscribeDrops($unsubscribeDrops)
    {
        $this->unsubscribeDrops = $unsubscribeDrops;
    }

    /**
     * @return int
     */
    public function getUnsubscribes()
    {
        return $this->unsubscribes;
    }

    /**
     * @param int $unsubscribes
     */
    private function setUnsubscribes($unsubscribes)
    {
        $this->unsubscribes = $unsubscribes;
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
     */
    private function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string|null
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string|null $type
     */
    private function setType($type)
    {
        if (!$this->isValidType($type)) {
            throw new \InvalidArgumentException("Type must be one of " . implode(',', $this->getValidTypes()));
        }

        $this->type = $type;
    }
    /**
     * @param array $metrics
     */
    private function setMetrics(array $metrics)
    {
        $this->metrics = $metrics;

        $this->setBlocks($this->getMetricOrNull('blocks'));
        $this->setBounceDrops($this->getMetricOrNull('bounce_drops'));
        $this->setBounces($this->getMetricOrNull('bounces'));
        $this->setClicks($this->getMetricOrNull('clicks'));
        $this->setDeferred($this->getMetricOrNull('deferred'));
        $this->setDelivered($this->getMetricOrNull('delivered'));
        $this->setInvalidEmails($this->getMetricOrNull('invalid_emails'));
        $this->setOpens($this->getMetricOrNull('opens'));
        $this->setProcessed($this->getMetricOrNull('processed'));
        $this->setRequests($this->getMetricOrNull('requests'));
        $this->setSpamReportDrops($this->getMetricOrNull('spam_report_drops'));
        $this->setSpamReports($this->getMetricOrNull('spam_reports'));
        $this->setUniqueClicks($this->getMetricOrNull('unique_clicks'));
        $this->setUniqueOpens($this->getMetricOrNull('unique_opens'));
        $this->setUnsubscribeDrops($this->getMetricOrNull('unsubscribe_drops'));
        $this->setUnsubscribes($this->getMetricOrNull('unsubscribes'));
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $output = [];
        $output['name'] = $this->getName();
        $output['type'] = $this->getType();
        $metrics = [
            'blocks' => $this->getMetricOrNull('blocks'),
            'bounce_drops' => $this->getMetricOrNull('bounce_drops'),
            'bounces' => $this->getMetricOrNull('bounces'),
            'clicks' => $this->getMetricOrNull('clicks'),
            'deferred' => $this->getMetricOrNull('deferred'),
            'delivered' => $this->getMetricOrNull('delivered'),
            'invalid_emails' => $this->getMetricOrNull('invalid_emails'),
            'opens' => $this->getMetricOrNull('opens'),
            'processed' => $this->getMetricOrNull('processed'),
            'requests' => $this->getMetricOrNull('requests'),
            'spam_report_drops' => $this->getMetricOrNull('spam_report_drops'),
            'spam_reports' => $this->getMetricOrNull('spam_reports'),
            'unique_clicks' => $this->getMetricOrNull('unique_clicks'),
            'unique_opens' => $this->getMetricOrNull('unique_opens'),
            'unsubscribe_drops' => $this->getMetricOrNull('unsubscribe_drops'),
            'unsubscribes' => $this->getMetricOrNull('unsubscribes')
        ];
        $output['metrics'] = $metrics;

        return $output;
    }
    /**
     * @param string $metric
     * @return int | null
     */
    private function getMetricOrNull($metric)
    {
        return array_key_exists($metric, $this->metrics) ? $this->metrics[$metric] : null;
    }

    /**
     * @return array
     */
    private function getValidTypes()
    {
        return [
            // Global stats
            null,
            // Category stats
            'category',
            // Subuser stats
            'subuser',
            // Advanced stats
            'country',
            'device',
            'client',
            'esp',
            'browser'
        ];
    }

    /**
     * @param $type
     * @return bool
     */
    private function isValidType($type)
    {
        return in_array($type, $this->getValidTypes());
    }
}