<?php
    require __DIR__ . '/../../validator.php';
    require __DIR__ . '/../../id_convert.php';

    function get_seeker_id()
    {
        if (isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT, ['min_range' => 1])) {
            return short_to_long_id($_GET['id']);
        }
        return -1;
    }

    function get_post_time(int $seconds)
    {
        $time = time() - $seconds;
       
        if ($time < 60) {
            return 'только что';
        } elseif ($time < 3600) {
            $minutes = floor($time / 60);
            return "$minutes минут назад";
        } elseif ($time < 86400) {
            $hours = floor($time / 3600);
            return "$hours часов назад";
        } elseif ($time < 604800) {
            $days = floor($time / 86400);
            return "$days суток назад";
        } elseif ($time < 2629743) { 
            $weeks = floor($time / 604800);
            return "$weeks недель назад";
        } elseif ($time < 31556926) {
            $months = floor($time / 2629743);
            return "$months месяцев назад";
        } else {
            $years = floor($time / 31556926);
            return "$years лет назад";
        }
    }

    function homeGenerate()
    {
        $users = json_decode(file_get_contents(__DIR__ . '/../../../json_folder/users.json'), true);
        $posts = json_decode(file_get_contents(__DIR__ . '/../../../json_folder/posts.json'), true);
        $seeker_id = get_seeker_id();
        $last_author_id = null;

        foreach ($posts as $post) {
            $valid = false;
            $post_author_id = null;
            $whenPosted = null;
            if (inner_content_validate($post['post_author_id'])) {
                $post_author_id = $post['post_author_id'];
            }
            
            if (isset($post_author_id) && (($seeker_id == $post_author_id) || ($seeker_id == -1))) {
                $post_whenPosted = $post['post_whenPosted'];
                
                if ($post_author_id !== $last_author_id) {
                    foreach ($users as $user) {
                        if ($user['user_id'] == $post_author_id) {
                            if (name_validate($user['user_first_name']) &&
                                name_validate($user['user_last_name']) &&
                                inner_content_validate($user['user_avatar'])) {
    
                                    $post_author_first_name = $user['user_first_name'];
                                    $post_author_last_name = $user['user_last_name'];
                                    $post_author_ava = $user['user_avatar'];
                                    $last_author_id = $user['user_id'];
                                    $valid = true;
                            } 
                        }
                    }
                } else {
                    $valid = true;
                }

                
                if (postTime_validate($post['post_whenPosted'])) {
                    $whenPosted = get_post_time($post['post_whenPosted']);
                }
                
                if ($valid && isset($whenPosted)) {
                    require __DIR__ . '/post.php'; 
                }
            }   
        }
    }

?>