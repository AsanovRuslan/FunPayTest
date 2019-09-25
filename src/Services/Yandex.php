<?php

declare(strict_types = 1);

namespace App\Test\Services;

use App\Test\Result;
use App\Test\SMSProviderInterface;
use App\Test\SMSServiceInterface;

class Yandex implements SMSServiceInterface
{
    /**
     * @var string
     */
    private $sms = null;
    /**
     * @var SMSProviderInterface
     */
    private $provider;
    /**
     * @var Result
     */
    private $result;

    public function __construct(SMSProviderInterface $provider, Result $result)
    {
        $this->provider = $provider;
        $this->result   = $result;

        $this->sms = $provider->getData();

        if (!$this->sms) {
            throw new \RuntimeException('Provider returned an empty result');
        }
    }

    public function result(): Result
    {
        return (new Result())
            ->add('amount', $this->getAmount())
            ->add('password', $this->getPassword())
            ->add('wallet', $this->getWallet());
    }

    private function getPassword(): ?int
    {
        preg_match('/\b\d{4}\b/', $this->sms, $matches);

        return isset($matches[0]) ? (int)$matches[0] : null;
    }

    private function getAmount(): ?float
    {
        preg_match('/\b\d+[,.]?\d*\s?(?:р\.|рубль|рублей|рубля)/ui', $this->sms, $matches);

        $amount = $matches[0] ?? '';

        if (!$amount) {
            return null;
        }

        $amount = preg_replace('/,/', '.', $amount);
        $amount = preg_replace('/[^\d.]/', '', $amount);

        return (float)$amount;
    }

    private function getWallet(): ?int
    {
        preg_match('/\b\d{15}\b/', $this->sms, $matches);

        return isset($matches[0]) ? (int)$matches[0] : null;
    }

}