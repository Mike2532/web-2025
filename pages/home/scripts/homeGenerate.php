<?php
    require __DIR__ . '/../../id_convert.php';

    function getPostTime(int $seconds): string {
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

    function findUser(array $users, string $post_author_id): array|bool {
        foreach ($users as $user) {
            if (($user['user_id'] == $post_author_id) && 
                nameValidate($user['user_first_name']) &&
                nameValidate($user['user_last_name']) &&
                innerContentValidate($user['user_avatar'])) {

                $post_author_first_name = $user['user_first_name'];
                $post_author_last_name = $user['user_last_name'];
                $post_author_ava = $user['user_avatar'];
                return $user;
            }
        }
        return false;
    }

    function postFormat(array $user, array $post): array {
        return [
            'user_first_name' => $user['user_first_name'],
            'user_last_name' => $user['user_last_name'],
            'user_avatar' => $user['user_avatar'],
            'post_when_posted' => getPostTime($post['post_whenPosted']),
            'post_content' => $post['post_content'],
            'post_id' => $post['post_id'],
            'post_reactions' => $post['post_reactions'],
            'post_description' => $post['post_description'],
        ];
    }

    function homeGenerate(): array {
        $users = json_decode(file_get_contents(__DIR__ . '/../../../json_folder/users.json'), true);
        $posts = json_decode(file_get_contents(__DIR__ . '/../../../json_folder/posts.json'), true);

        $homeContent = [];

        foreach ($posts as $post) {

            if (!isValidUser($post, idGet())) {
                continue;
            }

            $user = findUser($users, $post['post_author_id']);
            if ($user === false) {
                continue;
            }
            
            if (!postTimeValidate($post['post_whenPosted'])) {
                continue;
            }
            
            $homeContent[] = postFormat($user, $post);
        }

        return $homeContent;
    }

    function printHome(array $homeContent): void {
        foreach ($homeContent as $post) {
            require __DIR__ . '/post.php';
        }
    }

    function getHomeContent() {
        printHome(homeGenerate());
    }
?>