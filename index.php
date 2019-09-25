<?php

declare(strict_types = 1);

use App\Test\Result;
use App\Test\Services\Yandex;

require_once './vendor/autoload.php';

$wallet     = 410011281547666;
$sum        = 115;

$yandex_sms = new Yandex(
    new App\Test\Providers\Yandex($wallet, $sum),
    new Result()
);


print_r($yandex_sms->result()->toArray());