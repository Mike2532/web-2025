<?php
    define('MAX_MEDIUMTEXT_SIZE', 16777215);

    require_once __DIR__ . '/../../../sql_scripts/pdo_script.php';
    require_once __DIR__ . '/../../../sql_scripts/post_script.php';
    require_once __DIR__ . '/../../../sql_scripts/image_script.php';


    function generateNewId(PDO $pdo, string $table): string {
        $newId = '';
        $columnId = $table . '_id';
        $sql = <<<SQL
            SELECT 
                COUNT(*) 
            FROM 
                $table
            WHERE 
                $columnId = :newId
        SQL;

        do {
            try {
                $newId = uniqid('', true);
                $stmt = $pdo->prepare($sql);
                $stmt->execute(['newId' => $newId]);
                $count = $stmt->fetchColumn();
            } catch(PDOException $exception) {
                error_log("Ошибка при попытке получения нового id: " . $exception->getMessage());
                $newId = '';
                break;
            }
        } while ($count > 0);

        return $newId;
    }

    function isFieldsSet(): bool {
        return (isset($_FILES['image']) && isset($_FILES['image']['error']) && isset($_POST['description']));
    }

    function checkFilesErrors(): bool {
        if (is_array($_FILES['image']['error']) && (count($_FILES['image']['error']) > 0) && (count($_FILES['image']['error']) <= 10)) {
            foreach ($_FILES['image']['error'] as $errorCode) {
                if ($errorCode != UPLOAD_ERR_OK) {
                    return false;
                }
            }

            return true;
        } else {
            return false;
        }
    }

    function checkDescription(): bool {
        $description = $_POST['description'];
        return ((trim($description !== "") && (strlen($description) <= MAX_MEDIUMTEXT_SIZE)));
    }

    function checkFilesType(): bool {
        $allowedTypes = ['image/jpeg', 'image/png'];

        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        foreach ($_FILES['image']['tmp_name'] as $tmpFile) {
            $mimeType = finfo_file($finfo, $tmpFile);
            if (!in_array($mimeType, $allowedTypes)) {
                return false;
            }
        }
        finfo_close($finfo);
        return true;
    }

    if(($_SERVER['REQUEST_METHOD'] == 'POST') &&  isFieldsSet() && checkFilesErrors() && checkFilesType() && checkDescription()) {
        $authorId = '67f6e135bd0068.08606824';
        $pdo= getPDO();
        $newPostId = generateNewId($pdo, 'post');
        if (addPostToDB($pdo, $newPostId, $authorId)) {
            addImagestoDB($pdo, $newPostId, $authorId);
        }

    }
?>