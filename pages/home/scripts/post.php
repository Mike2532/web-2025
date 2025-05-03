<div class="post">
    <div class="post__header">
        <img class="post__author-ava" src=<?= $post['user_avatar'] ?> alt="фотография пользователя">
        <span><?= $post['user_first_name'] ?> <?= $post['user_last_name'] ?></span>
        <img class="post__edit-icon" src="/media/static_media/edit_icon.svg" alt="кнопка редактирования">
    </div>

    <img class="post__picture" src=<?= $post['post_content'][0] ?> alt="картинка поста">
            
    <div class="post__reactions">
        <img src="/media/static_media/heart.png" alt="картинка реакций">
        <span><?= $post['post_reactions'] ?></span>
    </div>

    <p class="post__description"> <?= $post['post_description'] ?> </p>
    <P class="post__when-posted"> <?= $post['post_when_posted'] ?> </p>
</div>    