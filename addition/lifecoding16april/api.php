<?php

    require_once 'act.php';
    const METHOD_POST = 'POST';

    if ($_SERVER['REQUEST_METHOD'] != METHOD_POST) {
        echo getResponse(STATUS_ERROR, MESSAGE_INVALID_REQUEST_METHOD);
        die();
    }

    $act = isset($GET['act']) ? $_GET['act'] : null;

    switch($act) {
        case ACT_UPLOADER:
            echo uploadData();
            break;
        default:
            echo getResponse(STATUS_ERROR, MESSAGE_INVALID_ACT_METHOD);
            die();
    }
?>