<?php

declare(strict_types = 1);

namespace App\Test;


interface SMSServiceInterface
{
    public function __construct(SMSProviderInterface $provider, Result $result);

    public function result(): Result;
}