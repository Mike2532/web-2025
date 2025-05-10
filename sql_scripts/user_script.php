<?php

function addUser(PDO $pdo, array $user): bool {
    $sql = <<<SQL
        INSERT INTO 
            user (
                user_id,
                user_first_name,
                user_last_name,
                user_status,
                user_email,
                user_password
            )
        VALUES (
            :user_id,
            :user_first_name,
            :user_last_name,
            :user_status,
            :user_email,
            :user_password 
        );
    SQL;

    
    try {
        $stm = $pdo->prepare($sql);
        $params = [
            ':user_id' => $user['user_id'],
            ':user_first_name' => $user['user_first_name'],
            ':user_email' => $user['user_email'],
            ':user_password' => $user['user_password'],  
            ':user_status' => $user['user_status'] ?? NULL,
            ':user_last_name' => $user['user_last_name'] ?? NULL,
        ];
        $stm->execute($params);  
        return true;
    } catch (PDOException $exception) {
        echo $exception->getMessage();
        return false;
    }
}

function deliteUserById(PDO $pdo, string $id): bool {
    $sql = <<<SQL
        DELETE FROM 
            user 
        WHERE 
            user_id = :id
    SQL;
    
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':id' => $id,
        ]);
        return true;
    } catch (PDOException $exception) {
        echo $exception->getMessage();
        return false;
    }
}

function getAllUsers(PDO $pdo): bool|array {
    $sql = 'SELECT * FROM user';
    try {
        $stmt = $pdo->query($sql);
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($users as &$user) {
            if ($user['user_avatar'] != '/media/static_media/empty_ava.jpeg') {
                $user['user_avatar'] = "/media/user_media/{$user['user_id']}/avatar/{$user['user_avatar']}";
            }
        }
        unset($user);
        return $users;
    } catch (PDOException $exception) {
        echo $exception->getMessage();
        return false;
    }
}

?>