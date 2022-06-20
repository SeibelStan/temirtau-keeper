<?php

function botScore($message)
{
    $limit = 10;

    $score = 0;
    $fname = $message->from->first_name;
    $lname = $message->from->last_name;
    $uname = $message->from->username;
    $text = $message->text;

    if (preg_match('/^[A-z][a-z]+$/', $fname)) {
        $score += 3;
    }
    if (preg_match('/^[A-Z]+$/', $lname)) {
        $score += 7;
    }
    if (!$uname) {
        $score += 1;
    }

    if (preg_match('/[А-я]/', $fname . $lname)) {
        $score -= 1;
    }

    if (preg_match('/работ\S{0,2}/ui', $text)) {
        $score += 5;
    }
    if (preg_match('/деньг\S{0,2}/ui', $text)) {
        $score += 4;
    }
    if (preg_match('/\$/ui', $text)) {
        $score += 2;
    }
    if (preg_match('/в недел\S+/ui', $text)) {
        $score += 3;
    }
    if (preg_match('/\@[A-z]+\b/ui', $text)) {
        $score += 4;
    }

    $photos = tg('getUserProfilePhotos', [
        'user_id' => $message->from->id,
    ]);
    $photosCount = json_decode($photos)?->result->total_count;
    if (!$photosCount) {
        $score += 1;
    }

    if (preg_match('/test/i', $message->chat->title ?? '')) {
        tg('sendMessage', [
            'chat_id' => $message->from->id,
            'text' => $score
        ]);
    }

    return $score >= $limit;
}
