<?php

    const IMAGE_EXT = '.png';
    const TITLE_MAX_LENGTH = 255;
    const TITLE_IMAGE_LENGTH = 50;
    const TITLE_IMAGE_RANDOM = 50;
    const IMAGE_TYPE = 'image/png';
    const IMAGE_SIZE = 1024 * 1024;

    function validateTitle(string $title): bool {
        return preg_match('/^[A-Za-zА-Яа-я\s]+$/u', $title) && strlen($title) <= TITLE_MAX_LENGTH;
    }

    function validateImage(string $type, int $size): bool {
        return $type === IMAGE_TYPE && $size <= IMAGE_SIZE; 
    }

    function generateImageName(string $title) {
        $filemane = substr($title, 0, IMAGE_MAX_LENGTH);
        $randomPart = substr(sha1($title . time()), 0, IMAGE_MAX_RANDOM);

        return $filemane . '-' . $randomPart . INAGE_EXT;
    }
?>