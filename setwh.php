<?php

error_reporting(1);
error_reporting(E_ALL);

require('lib.php');

$params = [
    'url' => 'https://' . $_SERVER['SERVER_NAME'] . '/wh.php',
    'ip_address' => $_SERVER['SERVER_ADDR'],
    'allowed_updates' => json_encode(['message', 'edited_message', 'chat_member'])
];
echo tg('setWebhook', $params);
