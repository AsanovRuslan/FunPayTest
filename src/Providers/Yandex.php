<?php

declare(strict_types = 1);

namespace App\Test\Providers;

use App\Test\Request;
use App\Test\SMSProviderInterface;

class Yandex implements SMSProviderInterface
{
    /**
     * @var int
     */
    private $wallet;
    /**
     * @var int
     */
    private $sum;

    public function __construct(int $wallet, int $sum)
    {
        $this->wallet = $wallet;
        $this->sum    = $sum;
    }

    public function getData()
    {
        return Request::post('https://funpay.ru/yandex/emulator', [
            'receiver' => $this->wallet,
            'sum'      => $this->sum,
        ]);
    }

}