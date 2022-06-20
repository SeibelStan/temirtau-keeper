<?php

function tg($method, $params)
{
    $token = trim(file_get_contents('token.txt'));

    $ch = curl_init("https://api.telegram.org/bot$token/$method");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $params);

    $result = curl_exec($ch);
    curl_close($ch);

    return $result;
}
