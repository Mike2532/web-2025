<?php
    require __DIR__ . '/../../user_info.php';

    function chooseMode(int $i): void {
        if ($i % 3 == 0) {
            echo 'left-and-center';
        } else {
            echo 'right';   
        }  
    }

    function postCounterEnding(int $post_counter): void {
        echo ' пост';
        switch ($post_counter % 10): 
            case 0:
            case 5:
            case 6:
            case 7:
            case 8:
            case 9:
                echo 'ов';
                break;
            case 2:
            case 3:
            case 4:
                echo 'а';
            endswitch;
    }

    function getUserPosts(string $user_id): array {
        $posts = json_decode(file_get_contents(__DIR__ . '/../../../json_folder/posts.json'), true);
    
        $user_posts = [
            'post-image' => [],
            'counter' => 0,
        ];
    
        foreach ($posts as $post) {
            if (postValidate($user_id, $post)) {
                $user_posts['post-image'][] = $post['post_content'];
                $user_posts['counter']++;
            }
        }
    
        return $user_posts;
    }

    function printProfile(array $user_posts): void {
        for ($i = 0; $i < $user_posts['counter']; $i++) {
            require __DIR__ . '/post_sample.php';
        }
    }   

    $user_posts = getUserPosts($user_id);
?>