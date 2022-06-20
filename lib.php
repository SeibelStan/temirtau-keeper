<?php

function tg($method, $params)
{
    $token = file_get_contents('token.txt');

    $ch = curl_init("https://api.telegram.org/bot{$token}/$method");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $params);

    $request = curl_exec($ch);
    curl_close($ch);

    return json_decode($request);
}