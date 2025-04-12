<?php 
    function inner_content_validate(string $data) {
        return (isset($data) && !(trim($data) === ""));
    }

    function name_validate($data) {
        if (preg_match('/^[a-zа-яА-ЯёË]+$/iu', $data)) { 
            return mb_strlen($data, 'UTF-8') <= 64;
        }
        return false;
    }

    function email_validate($data) {
        if (!filter_var($data, FILTER_VALIDATE_EMAIL) === false) {
            return true;
        }
        return false;
    }

    function text_validate($data) {
        if (preg_match('/^[a-zа-яА-Я\d\s\"\',.:?!()@#$%^&*{}\[\]~\/\\\\+=;—_\\p{Emoji}]+$/iu', $data)) {
            return mb_strlen($data, 'UTF-8') <= 2200;
        }
        return false;
    }

    function reactions_validate(int $data) {
        if (!filter_var($data, FILTER_VALIDATE_INT, ['min_range' => 0]) === false) {
            return true;
        }
        return false;
    }

    function postTime_validate(int $data) {
        if (!filter_var($data, FILTER_VALIDATE_INT, ['min_range' => 0]) === false) {
            return time() - $data >= 0;
        }
    }

    function post_validate(array $posts) {
        foreach ($posts as $post) {
            if (!inner_content_validate($post)) {
                return false;
            }
        }
        return true;
    }
?>