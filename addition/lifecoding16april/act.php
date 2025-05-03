<?php

const STATUS_ERROR = 'error';
const STATUS_OR = 'ok';
const MESSAGE_INVALID_REQUEST_METHOD = 'invalid method';
const MESSAGE_INVALID_ACT_METHOD = 'invalid method';
const ACTUPLOADER = 'upload';


function getResponse (string $status, string $message): string {
    $response = [
        'status' => $status,
        'message' => $message,
    ];
    return (string)json_encode($response);
}

function uploadData(): string {
    $title = isset($_POST['title']) ? $_POST['title'] : null; 
    if (!$title) {
        return getResponse(STATUS_ERROR, MESSAGE_INVALID_TITLE);
    }

    if (!validateTitle()) {
        return getResponse(STATUS_ERROR, MESSAGE_INVALID_TITLE);
    }


    $image = $_FILES && $_FILES['image']['error'] === UPLOAD_ERR_OK ? $_FILES['image'] : null;
    if (!$image) {
        return getResponse(STATUS_ERROR, MESSAGE_INVALID_TITLE);
    }

    if (!validateImage($image['type'], $image['size'])) {
        return getResponse(STATUS_ERROR, MESSAGE_IMVALID_IMAGE);
    }

    $filename = generateImageName($title);

    $isSuccess = move_uploaded_file($image['tmp_name'], 'images/' . $filename);
    if (!$isSuccess) {
        return getResponse(STATUS_ERROR, MESSAGE_INVALID_SAVE_IMAGE);
    }

    $connection = connectTODatabase($connection, $title, $filename);

    return getResponse(STATUS_OK, '');
}