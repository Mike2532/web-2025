<?php
    require __DIR__ . '/id_convert.php';
    $users = json_decode(file_get_contents(__DIR__ . '/../json_folder/users.json'), true);
    
    $error = true;

    $user_id = idGet();
    if ($user_id !== '-1') {
        foreach ($users as $user) {
            if ($user_id == $user['user_id']) {

                if (nameValidate($user['user_first_name']) &&
                    nameValidate($user['user_last_name']) &&
                    textValidate($user['user_status']) &&
                    innerContentValidate($user['user_avatar'])) {

                    $user_first_name = $user['user_first_name'];
                    $user_last_name = $user['user_last_name'];
                    $user_status = $user['user_status'];
                    $user_avatar = $user['user_avatar'];
                    $error = false;
                }
            }
        }
    }
    if ($error) {
        header('Location: /pages/home/');
        exit();
    }
?>