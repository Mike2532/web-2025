<?php

function getPDO(): bool|PDO {
    $dsn = 'mysql:host=127.0.0.1;dbname=blog';
    $user = 'root';
    $password = '1872';
    try {
        return new PDO($dsn, $user, $password);
    } catch (PDOException $exception) {
        echo $exception->getMessage();
        return false;
    }
}

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
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $exception) {
        echo $exception->getMessage();
        return false;
    }
}

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
    $sql = 'SELECT * FROM post';
    try {
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $exception) {
        echo $exception->getMessage();
        return false;
    }
}

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
        echo $exception->getMessage();
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
        echo $exception->getMessage();
        return false;
    }
}

$pdo = getPDO();

$post1 = [
    "post_id" => "67f6605d3028a6.36415352", 
    "post_author_id" => "67f6e135bd0068.08606824", 
    "post_description" => "Так красиво сегодня на улице! Настоящая зима)) Вспоминается Бродский: «Поздно ночью, в уснувшей долине, на самом дне, в городке, занесенном снегом по ручку двери...»", 
    "post_reactions" => 203,
];

$post2 = [
    "post_id" => "67f6605d3028b4.48795563", 
    "post_author_id" => "67f6e14c3c9b40.71886685", 
    "post_description" => "То, что стоит запомнить.", 
    "post_reactions" => 534,
];

$post3 = [
    "post_id" => "67f6605d302893.94604725", 
    "post_author_id" => "67f6e135bd0068.08606824", 
    "post_description" => "Время идет, а некоторые моменты остаются.", 
    "post_reactions" => 176,
];

$post4 = [
    "post_id" => "67f6605d302885.71059498", 
    "post_author_id" => "67f6e135bd0068.08606824", 
    "post_description" => "Тишина тоже может говорить.", 
    "post_reactions" => 519,
];

$post5 = [
    "post_id" => "67f6605d302878.40580805", 
    "post_author_id" => "67f6e135bd0068.08606824", 
    "post_description" => "Без лишних слов, только впечатления.", 
    "post_reactions" => 201,
];

$post6 = [
    "post_id" => "67f6605d302867.64262496", 
    "post_author_id" => "67f6e135bd0068.08606824", 
    "post_description" => "Иногда реальность сама становится композицией.", 
    "post_reactions" => 209,
];

$post7 = [
    "post_id" => "67f6605d302852.38686771", 
    "post_author_id" => "67f6e135bd0068.08606824", 
    "post_description" => "Иногда все складывается именно так, как нужно.", 
    "post_reactions" => 502,
];

addPost($pdo, $post7);
sleep(3);
addPost($pdo, $post6);
sleep(3);
addPost($pdo, $post5);
sleep(3);
addPost($pdo, $post4);
sleep(3);
addPost($pdo, $post3);
sleep(3);
addPost($pdo, $post2);
sleep(3);
addPost($pdo, $post1);


$user1 = [
    "user_id" => "67f6e135bd0068.08606824",
    "user_first_name" => "Ваня",
    "user_avatar" => "/media/user_media/ivan/avatar/profileava.png",
    "user_email" => "ivanDenisov@gmail.com",
    "user_password" => "964b398ecd55793d8ca93e01274efe1377a70c8dc358fdca17cb4e94a9ed7777",
    "user_status" => "Привет! Я системный аналитик в ACME :) Тут моя жизнь только для самых классных!",
    "user_last_name" => "Денисов",
];

$user2 = [
    "user_id" => "67f6e14c3c9b40.71886685",
    "user_first_name" => "Лиза",
    "user_last_name" => "Демина",
    "user_status" => "Привет)",
    "user_avatar" => "/media/user_media/lisa/avatar/profileavaLisa.png",
    "user_email" => "lisaDemina@gmail.com",
    "user_password" => "1d58cd50d9d0a850f31401a5a3e7dcf02874dcbe8d4de4f804140180d7c2f867",
];


$image1 = [
    
    'owner_id' => '67f6605d3028a6.36415352',
    'image_name' => 'Frame22.png',
];
$image2 = [
    
    'owner_id' => '67f6605d3028b4.48795563',
    'image_name' => 'Frame28.png',
];
$image3 = [
    
    'owner_id' => '67f6605d302893.94604725',
    'image_name' => 'Frame23.png',
];
$image4 = [
    
    'owner_id' => '67f6605d302885.71059498',
    'image_name' => 'Frame24.png',
];
$image5 = [
    
    'owner_id' => '67f6605d302878.40580805',
    'image_name' => 'Frame25.png',
];
$image6 = [
    
    'owner_id' => '67f6605d302867.64262496',
    'image_name' => 'Frame26.png',
];
$image7 = [
    
    'owner_id' => '67f6605d302852.38686771',
    'image_name' => 'Frame27.png',
];
$image8 = [
    
    'owner_id' => '67f6e135bd0068.08606824',
    'image_name' => 'profileava.png',
];
$image9 = [
    
    'owner_id' => '67f6e14c3c9b40.71886685',
    'image_name' => 'profileavaLisa.png',
];

// addImage($pdo, $image1);
// addImage($pdo, $image2);
// addImage($pdo, $image3);
// addImage($pdo, $image4);
// addImage($pdo, $image5);
// addImage($pdo, $image6);
// addImage($pdo, $image7);
// addImage($pdo, $image8);
// addImage($pdo, $image9);

// addUser($pdo, $user1);
// addUser($pdo, $user2);

// $arr = getAllPosts($pdo);

// foreach ($arr as $user) {
//     foreach ($user as $key => $value) {
//         echo "$key => $value <br>";
//     }
//     echo "<hr>"; // Разделитель между пользователями
// }


// deliteUserById($pdo, '67f6e135bd0068.08606824');





// if (($pdo !== false)) {
//     addUser($pdo, $user);
// }

?>