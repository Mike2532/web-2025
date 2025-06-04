<?php

function addImage(PDO $pdo, array $image): bool {
    if (!isset($image['owner_id'], $image['image_name'])) {
        return false;
    }

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
        error_log("Ошибка добавления картинки: " . $exception->getMessage());
        return false;
    }
}

function deliteImageByName(PDO $pdo, string $name) {
    $sql = <<<SQL
        DELETE FROM 
            post
        WHERE 
            image_name = :name
    SQL;
    
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':name' => $name,
        ]);
        return true;
    } catch (PDOException $exception) {
        error_log("Ошибка удаления картинки по ID: " . $exception->getMessage());
        return false;
    }
}

function addImagestoDB(PDO $pdo, string $ownerId, string $authorId): bool {
    $sql = <<<SQL
        INSERT INTO 
            image (
                owner_id,
                image_name,
                image_id
            )
        VALUES (
            :owner_id,
            :image_name,
            :image_id
        );
    SQL;
    
    $pdo->beginTransaction();
    $stm = $pdo->prepare($sql);

    $size = count($_FILES['image']['name']);
    for ($i = 0; $i < $size; $i++) {
        $imgId = generateNewId($pdo, 'image');
        $imgName = $imgId . '_' . basename($_FILES['image']['name'][$i]);
        
        try {
            $params = [
                ':owner_id' => $ownerId,
                ':image_name' => $imgName,
                ':image_id' => $imgId,
            ];
            $stm->execute($params); 
            move_uploaded_file($_FILES['image']['tmp_name'][$i], __DIR__ . '/../media/user_media/' . $authorId . '/posts/' . $imgName);
        } catch (PDOException $exception) {
            $pdo->rollBack();
            error_log("Ошибка добавления картинки: " . $exception->getMessage());
            delitePostById($pdo, $ownerId);
            return false;
        }        
    } 
    $pdo->commit();
    return true;
}

?>