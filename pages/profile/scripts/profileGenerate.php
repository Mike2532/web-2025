<?php
    require __DIR__ . '/../../user_info.php';

    function choose_mode(int $i)
    {
        if ($i % 3 == 0) {
            echo 'left-and-center';
        } else {
            echo 'right';   
        }  
    }

    function post_counter_ending(int $post_counter) {
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

    function get_user_posts(string $user_id) {
        $posts = json_decode(file_get_contents(__DIR__ . '/../../../json_folder/posts.json'), true);
    
        $user_posts = [
            'post-image' => [],
            'post-id' => [],
            'counter' => 0,
        ];
    
        foreach ($posts as $post) {
            if ($post['post_author_id'] == $user_id) {

                if (inner_content_validate($post['post_content'][0]) && inner_content_validate($post['post_id'])) {
                    $user_posts['post-image'][] = $post['post_content'][0];
                    $user_posts['post-id'][] = $post['post_id'];
                    $user_posts['counter']++;
                }
            }
        }
    
        return $user_posts;
    }

    function user_post_generation(array $user_posts)
    {
        for ($i = 0; $i < $user_posts['counter']; $i++)
        {
            $post_image = $user_posts['post-image'][$i];
            $post_id = $user_posts['post-id'][$i];
            require __DIR__ . '/post_sample.php';
        }
    }   
    
    $user_posts = get_user_posts($user_id);
?>