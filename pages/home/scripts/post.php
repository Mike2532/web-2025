<div class="post">
    <div class="post__header">
        <img class="post__author-ava" src=<?= $post_author_ava ?> alt="фотография пользователя">
        <span><?= $post_author_first_name ?> <?= $post_author_last_name ?></span>
        <img class="post__edit-icon" src="/media/static_media/edit_icon.svg" alt="кнопка редактирования">
    </div>

    <div class="post__picture">
        <img src=<?= $post['post_content'][0] ?> data-post-id=<?= $post['post_id'] ?> alt="картинка поста">
    </div>
            
    <div class="post__reactions">
        <img src="/media/static_media/heart.png" alt="картинка реакций">
        <span><?= $post['post_reactions'] ?></span>
    </div>

    <p class="post__description"> <?= $post['post_description'] ?> </p>
    <P class="post__when-posted"> <?= $whenPosted ?> </p>
</div>    