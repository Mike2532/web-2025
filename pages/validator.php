<?php 

    function idValidate(string $id): bool {
        return (preg_match('/^[a-z0-9.]{23}$/', $id) && (substr_count($id, '.') == 1));
    }

    function innerContentValidate(string $data): bool {
        return (isset($data) && !(trim($data) === ""));
    }

    function nameValidate($data): bool {
        if (preg_match('/^[a-zа-яА-ЯёË]+$/iu', $data)) { 
            return mb_strlen($data, 'UTF-8') <= 64;
        }
        return false;
    }

    function emailValidate($data): bool {
        if (!filter_var($data, FILTER_VALIDATE_EMAIL) === false) {
            return true;
        }
        return false;
    }

    function textValidate($data): bool {
        if (preg_match('/^[a-zа-яА-Я\d\s\"\',.:?!()@#$%^&*{}\[\]~\/\\\\+=;—_\\p{Emoji}]+$/iu', $data)) {
            return mb_strlen($data, 'UTF-8') <= 2200;
        }
        return false;
    }

    function reactionsValidate(int $data): bool {
        if (!filter_var($data, FILTER_VALIDATE_INT, ['min_range' => 0]) === false) {
            return true;
        }
        return false;
    }

    function postTimeValidate(string|int $data): bool {
        if (!is_numeric($data)){
            die("{$data}");
        }
        
        if (!filter_var($data, FILTER_VALIDATE_INT, ['min_range' => 0]) === false) {
            return time() - $data >= 0;
        }
    }

    function postValidate(string $user_id, array $post): bool {
        if (($post['post_author_id'] == $user_id) && innerContentValidate($post['post_content'][0]) && innerContentValidate($post['post_id'])) 
            return true;
        return false;
    }

    function isValidUser(array $post, int|string $seeker_id): bool {
        return (innerContentValidate($post['post_author_id']) && (($seeker_id == $post['post_author_id']) || ($seeker_id == '-1')));
    }
?>