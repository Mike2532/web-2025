<?php
    require __DIR__ . '/id_convert.php';
    require __DIR__ . '/validator.php';
    $users = json_decode(file_get_contents(__DIR__ . '/../json_folder/users.json'), true);
    
    $error = true;
    if (isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT, ['min_range' => 1])) {
        $user_id = short_to_long_id($_GET['id']);
        foreach ($users as $user) {
            if ($user_id == $user['user_id']) {

                if (name_validate($user['user_first_name']) &&
                    name_validate($user['user_last_name']) &&
                    text_validate($user['user_status']) &&
                    inner_content_validate($user['user_avatar'])) {

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