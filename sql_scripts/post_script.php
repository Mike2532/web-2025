<?php

// function getPDO(): bool|PDO {
//     $dsn = 'mysql:host=127.0.0.1;dbname=blog';
//     $user = 'root';
//     $password = '1872';
//     try {
//         return new PDO($dsn, $user, $password);
//     } catch (PDOException $exception) {
//         echo $exception->getMessage();
//         return false;
//     }
// }

function addPost(PDO $pdo, array $post): bool {
    $sql = <<<SQL
        INSERT INTO
            post (
                post_id,
                post_author_id,
                post_description,
                post_reactions
            )
        VALUES (
            :post_id,
            :post_author_id,
            :post_description,
            :post_reactions
        );       
    SQL;

    try {
        $stmt = $pdo->prepare($sql);
        $params = [
            ':post_id' => $post['post_id'],
            ':post_author_id' => $post['post_author_id'],
            ':post_description' => $post['post_description'] ?? NULL,
            ':post_reactions' => $post['post_reactions'],
        ];
        $stmt->execute($params);
        return true;
    } catch (PDOException $exception) {
        echo $exception->getMessage();
        return false;
    }
}

function delitePostById(PDO $pdo, string $id) {
    $sql = <<<SQL
        DELETE FROM 
            post
        WHERE 
            post_id = :id
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

function getAllPosts(PDO $pdo): bool|array {
    $sql = <<<SQL
        SELECT * FROM 
            post 
        ORDER BY 
            post_when_posted ASC
    SQL;

    try {
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $exception) {
        echo $exception->getMessage();
        return false;
    }
}

function postGetImages(PDO $pdo, array $posts): bool|array {
    $sql = <<<SQL
        SELECT
            post.post_id,
            post.post_author_id,
            post.post_description,
            post.post_reactions,
            post.post_when_posted,
            GROUP_CONCAT(image.image_name) AS post_content
        FROM
            post 
        INNER JOIN
            image ON image.owner_id = post.post_id 
        GROUP BY 
            post.post_id 
        ORDER BY 
            post.post_when_posted ASC
    SQL;

    try {
        $stmt = $pdo->query($sql);
        $posts = $stmt->fetchALL(PDO::FETCH_ASSOC);
        foreach ($posts as &$post) {
            $post['post_content'] = explode(',', $post['post_content']);
    
            $post['post_content'] = array_map(
                fn($n) => "/media/user_media/{$post['post_author_id']}/posts/{$n}", 
                $post['post_content']
            );
        }
        unset($post);
        return $posts;
    } catch (PDOException $exception) {
        echo $exception->getMessage();
        return false;
    }
}

function getPostsWithImages(PDO $pdo): bool|array {
    $posts = getAllPosts($pdo);
    if ($posts !== false) {
        return postGetImages($pdo, $posts);
    } else {
        return false;
    }
}

// $pdo = getPDO();

// $posts = getPostsWithImages($pdo);


// foreach ($posts as $post) {
//     foreach ($post as $key => $value) {
//         if (is_array($value)) {
//             echo "{$key} => [" . implode(', ', $value) . "]<br>";
//         } else {
//             echo "{$key} => {$value} <br>";
//         }
//     }
//     echo "<hr>";
// }

// echo "<img src={$posts[0]['post_content'][0]}>";
?>