<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <?php require __DIR__ . '/validator.php' ?>
    </head>
    <body>
        <?php
         $user_id = "67f6e135bd0068.08606824";
         $user_first_name = "Ваня";
         $user_last_name = "Денисов";
         $user_status = "Привет! Я системный аналитик в ACME  = ) Тут моя жизнь только для самых классных!";
         $user_avatar = "/media/user_media/ivan/avatar/profileava.png";
         $user_email = "ivanDenisov@gmail.com";
         $user_password = "964b398ecd55793d8ca93e01274efe1377a70c8dc358fdca17cb4e94a9ed7777";
         $post_reactions = 203; 
         $post_whenPosted = 1744230426;
         $post_content = ["/media/user_media/ivan/posts/Frame24.png", "/media/user_media/ivan/posts/Frame24.png", "/media/user_media/ivan/posts/Frame24.png"];
         
         if (inner_content_validate($user_id)) {
            echo ' id_valid; ';
         }

         if (name_validate($user_first_name)) {
            echo ' name_valid; ';
         }

         if (name_validate($user_last_name)) {
            echo ' name_valid; ';
         }
         
         if (text_validate($user_status)) {
            echo ' status_valid; ';
         }

         if (inner_content_validate($user_avatar)) {
            echo ' avatar_valid; ';
         }

         if (email_validate($user_email)) {
            echo ' email_valid; ';
         }

         if (inner_content_validate($user_password)) {
            echo ' password_valid; ';
         }
         
         if (reactions_validate($post_reactions)) {
            echo ' reactions_valid; ';
         }

         if (postTime_validate($post_whenPosted)) {
            echo ' postTime_valid; ';
         }
        
         if (post_validate($post_content)) {
            echo ' post_valid; ';
         }

        ?>
        
    </body>
</html>