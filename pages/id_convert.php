<?php 
    require __DIR__ . '/validator.php';

    function idGet(): string {
        if (isset($_GET['id'])) {
            $short_id = $_GET['id'];
            if (idValidate($short_id)) {
                return $short_id;
            } else {
                $users = json_decode(file_get_contents(__DIR__ . '/../json_folder/users.json'), true);
                if ($short_id <= count($users)) {
                    return $users[$short_id - 1]['user_id'];
                } 
            }
        }
        return '-1';
    }
?>