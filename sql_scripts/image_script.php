<?php

function addImage(PDO $pdo, array $image): bool {
    $sql = <<<SQL
        INSERT INTO 
            image (
                owner_id,
                image_name
            )
        VALUES (
            :owner_id,
            :image_name
        );
    SQL;


    try {
        $stm = $pdo->prepare($sql);
        $params = [
            ':owner_id' => $image['owner_id'],
            ':image_name' => $image['image_name']
        ];
        $stm->execute($params);  
        return true;
    } catch (PDOException $exception) {
        //echo $exception->getMessage();
        echo "Что-то пошло не так. Попробуйте позже.";
        return false;
    }
}

function deliteImageByName(PDO $pdo, string $name) {
    $sql = <<<SQL
        DELETE FROM 
            post
        WHERE 
            iamge_name = :name
    SQL;
    
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':name' => $name,
        ]);
        return true;
    } catch (PDOException $exception) {
        //echo $exception->getMessage();
        echo "Что-то пошло не так. Попробуйте позже.";
        return false;
    }
}

?>