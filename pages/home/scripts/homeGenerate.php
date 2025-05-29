<?php
    require_once __DIR__ . '/../../id_convert.php';
    require_once __DIR__ . '/../../../sql_scripts/pdo_script.php';
    require_once __DIR__ . '/../../../sql_scripts/user_script.php';
    require_once __DIR__ . '/../../../sql_scripts/post_script.php';
    require_once __DIR__ . '/getPostTime.php';
    require_once __DIR__ . '/../../validator.php';

    function findUserByPostId(array $users, string $post_author_id): ?array {
        foreach ($users as $user) {

            if (($user['user_id'] == $post_author_id) && userValidate($user)) {                
                return $user;
            }
        }
        
        return false;
    }

    function makePostData(array $user, array $post): array {
        return [
            'user_first_name' => $user['user_first_name'],
            'user_last_name' => $user['user_last_name'],
            'user_avatar' => $user['user_avatar'],
            'post_when_posted' => getPostTime($post['post_when_posted']),
            'post_content' => $post['post_content'],
            'post_id' => $post['post_id'],
            'post_reactions' => $post['post_reactions'],
            'post_description' => $post['post_description'],
        ];
    }

    function homeGenerate(): array {
        //$users = json_decode(file_get_contents(__DIR__ . '/../../../json_folder/users.json'), true);
        //$posts = json_decode(file_get_contents(__DIR__ . '/../../../json_folder/posts.json'), true);
        $PDO = getPDO();
        $users = getAllUsers($PDO);
        $posts = getPostsWithImages($PDO);

        $homeContent = [];

        foreach ($posts as $post) {

            if (!isValidUser($post, idGet())) {
                continue;
            }

            $user = findUserByPostId($users, $post['post_author_id']);
            if (!$user) {
                continue;
            }
            
            if (!postTimeValidate($post['post_when_posted'])) {
                continue;
            }
            
            $homeContent[] = makePostData($user, $post);
        }

        return $homeContent;
    }

    function printHome(array $homeContent): void {
        foreach ($homeContent as $post) {
            $postSize = count($post['post_content']);
            $addUI = $postSize > 1;
            require __DIR__ . '/post.php';
        }
    }

    function getPostPictures(array $post): void {
        $pictures = $post['post_content'];

        for ($i = 0; $i < count($pictures); $i++) {
            $img = '<img class="post-picture';
            
            if ($i == 0) {
                $img .= ' visiable';
            }

            $img .= '" src="' . $pictures[$i] . '" alt="картинка поста">';

            echo $img;
        }

    }

    function getHomeContent(): void {
        printHome(homeGenerate());
    }
    
?>