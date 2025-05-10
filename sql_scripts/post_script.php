<?php

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
        SELECT 
            post_id,
            post_author_id,
            post_description,
            post_reactions,
            UNIX_TIMESTAMP(post_when_posted) AS post_when_posted  
        FROM 
            post 
        ORDER BY 
            post_when_posted DESC
    SQL;

    try {
        $stmt = $pdo->query($sql);
        $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $posts;
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
            UNIX_TIMESTAMP(post.post_when_posted) AS post_when_posted,
            GROUP_CONCAT(image.image_name) AS post_content
        FROM
            post 
        INNER JOIN
            image ON image.owner_id = post.post_id 
        GROUP BY 
            post.post_id 
        ORDER BY 
            post.post_when_posted DESC
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

?>