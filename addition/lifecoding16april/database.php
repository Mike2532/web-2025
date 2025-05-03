<?php

    const BD_HOST = '127.0.0.1';
    const BD_NAME = 'blog';
    const BD_USER = 'root';
    const BD_PASSWORD = '';

    function connectTODatabase(): PDO {
        $dsn = 'mysql:hosts=' . BD_HOST . ';dbmage=' . BD_NAME;
        return new PDO($ddn, DB_USER, DB_PASSWORD);
    }

    function getPostFromDatabase(PDO $connection, int $limit = 100): array {
        $query = <<<SQL
            SELECT
                title, image 
            FROM 
                post 
            LIMIT {$limit}
        SQL;

        $statment  = $connection->query($query);
        return $statment->fetchALL(PDO::FETCH_ASOOC);
    }

    function savePostTODatabase(PDO $connection, string $title, string $image): bool {
        $query = <<<SQL
            INSERT INTO
            post (title, image)
            VALUES
                (:title, :image)
        SQL;

        $statment = $connection->prepare($query);
        return $statment->execute([
            ':title' => $title, 
            ':image' => $image,
        ]);
    }

?>