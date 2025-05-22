<?php

function getPostTime(int $seconds): string {
    $time = time() - $seconds;
   
    if ($time < 60) {
        return 'только что';
    } elseif ($time < 3600) {
        $minutes = floor($time / 60);
        return "$minutes минут назад";
    } elseif ($time < 86400) {
        $hours = floor($time / 3600);
        return "$hours часов назад";
    } elseif ($time < 604800) {
        $days = floor($time / 86400);
        return "$days суток назад";
    } elseif ($time < 2629743) { 
        $weeks = floor($time / 604800);
        return "$weeks недель назад";
    } elseif ($time < 31556926) {
        $months = floor($time / 2629743);
        return "$months месяцев назад";
    } else {
        $years = floor($time / 31556926);
        return "$years лет назад";
    }
}

?>