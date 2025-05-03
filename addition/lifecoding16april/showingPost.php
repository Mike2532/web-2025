<?php
    require_once '/database.php';
    $connection = connectTODatabase();
    $posts = getPostsFromDatabase($connection);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Cоздать пост</title>
    </head>
    <body>
        <div class="container">
            <h1>Создать пост</h1>
            <?php
                foreach ($posts as $post) {
                    include '/postSample.php';
                }
            ?>
        </div>
    </body>
</html>