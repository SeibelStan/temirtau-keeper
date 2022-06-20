<?php

function botScore($message)
{
    $score = 0;
    $fname = $message->from->first_name;
    $lname = $message->from->last_name;
    $uname = $message->from->username;
    $text = $message->text;

    if (preg_match('/^[A-z][a-z]+$/', $fname)) {
        $score += 5;
    }
    if (preg_match('/^[A-Z]+$/', $lname)) {
        $score += 5;
    }
    if (!$uname) {
        $score += 1;
    }

    if (preg_match('/[А-я]/', $fname . $lname)) {
        $score -= 1;
    }

    if (preg_match('/работ\S{1,2}/ui', $text)) {
        $score += 3;
    }
    if (preg_match('/\$/ui', $text)) {
        $score += 2;
    }
    if (preg_match('/в неделю/ui', $text)) {
        $score += 3;
    }
    if (preg_match('/\@[A-z]+\b/ui', $text)) {
        $score += 3;
    }

    tg('sendMessage', [
        'chat_id' => $message->from->id,
        'text' => $score
    ]);

    return $score >= 10;
}
