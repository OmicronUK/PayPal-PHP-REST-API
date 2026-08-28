<?php

namespace PayPalRestApi\Orders;

class OrderData
{
    private float $amount;
    private string $currency;
    private string $description;
    private string $customId;
    private ?string $softDescriptor = null;

    // Constructor to initialize order data
    public function __construct(
        float $amount,
        string $currency,
        string $customId,
        string $description,
        ?string $softDescriptor = null,
    ) {
        $this->amount = $amount;
        $this->currency = $currency;
        $this->customId = $customId;
        $this->description = $description;
        $this->softDescriptor = $softDescriptor;
    }

    // Getters for order data
    public function getAmount(): string
    {
        return $this->amount;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getCustomId(): string
    {
        return $this->customId;
    }

    public function getSoftDescriptor(): ?string
    {
        return $this->softDescriptor;
    }

    // Convert order data to the format required by PayPal
    public function toPayPalFormat(): array
    {
        $purchaseUnit = [
            "custom_id" => $this->getCustomId(),
            "amount" => [
                "value" => $this->getAmount(),
                "currency_code" => $this->getCurrency(),
            ],
            'description' => $this->getDescription(),
        ];

        if (!empty($this->softDescriptor)) {
            $purchaseUnit['soft_descriptor'] = $this->softDescriptor;
        }

        return [
            "intent" => "CAPTURE",
            "purchase_units" => [
                $purchaseUnit
            ],
            "application_context" => [
                'shipping_preference' => 'NO_SHIPPING'
            ]
        ];
    }
}
