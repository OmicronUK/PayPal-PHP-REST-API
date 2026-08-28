<?php

namespace PayPalRestApi\Subscriptions;

class SubscriptionData
{
    private string $planId;
    private string $custom_id;
    private ?string $startTime;
    private ?string $brandName;
    
    public function __construct(
        string $planId,
        string $custom_id,
        ?string $startTime = null,
        ?string $brandName = null,
    ) {
        $this->planId = $planId;
        $this->custom_id = $custom_id;
        $this->startTime = $startTime;
        $this->brandName = $brandName;
    }

    public function getBrandName(): ?string
    {
        return $this->brandName;
    }

    public function toArray(): array
    {
        $data = [
            'plan_id' => $this->planId,
            'custom_id' => $this->custom_id,
        ];

        if ($this->startTime) {
            $data['start_time'] = $this->startTime;
        }

        if (!empty($this->brandName)) {
            $data['application_context'] = ['brand_name' => $this->brandName];
        }
        
        return $data;
    }
}
