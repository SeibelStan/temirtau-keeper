<?php

error_reporting(1);
error_reporting(E_ALL);

require('lib.php');
require('score.php');

$input = file_get_contents('php://input');
$data = json_decode($input);

$message = $data->message;

if (botScore($data->message)) {
    tg('deleteMessage', [
        'chat_id' => $message->chat->id,
        'message_id' => $message->message_id,
    ]);

    tg('banChatSenderChat', [
        'chat_id' => $message->chat->id,
        'sender_chat_id' => $message->from->id,
    ]);

    $f = fopen('log.txt', 'a+');
    fwrite($f, $input);
    fclose($f);
}
