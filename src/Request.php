<?php

declare(strict_types = 1);

namespace App\Test;


class Request
{
    public static function post(string $url, array $data)
    {
        $fields_string = '';

        foreach ($data as $key => $value) {
            $fields_string .= $key . '=' . $value . '&';
        }

        rtrim($fields_string, '&');

        $ch = curl_init();

        curl_setopt_array($ch, [
            CURLOPT_URL            => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST           => true,
            CURLOPT_HTTPHEADER     => [
                "Content-Length:" . strlen($fields_string),
                "Content-Type:application/x-www-form-urlencoded; charset=UTF-8",
                "x-requested-with:XMLHttpRequest",
            ],
            CURLOPT_POSTFIELDS     => $fields_string,
        ]);

        $result = curl_exec($ch);

        curl_close($ch);

        return $result;
    }
}