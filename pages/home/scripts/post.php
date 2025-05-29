<div class="post">
    <div class="header">
        <div class="header__user-info">
            <img class="header__author-ava" src=<?= $post['user_avatar'] ?> alt="фотография пользователя">
            <span><?= $post['user_first_name'] ?> <?= $post['user_last_name'] ?></span>
        </div>
        <img class="header__edit-icon" src="/media/static_media/edit_icon.svg" alt="кнопка редактирования">
    </div>

    <div class="content-block">
        <div class="content-block__media">
            <div class="posts">
                <?php getPostPictures($post) ?>
            </div>
            <?php if($addUI) require __DIR__ . '/post_arrows.php' ?>
        </div>
        <?php if($addUI) require __DIR__ . '/post_counter.php' ?>
    </div>
            
    <div class="post__reactions">
        <img src="/media/static_media/heart.png" alt="картинка реакций">
        <span><?= $post['post_reactions'] ?></span>
    </div>

    <p class="post__description"> <?= $post['post_description'] ?> </p>
    <P class="post__when-posted"> <?= $post['post_when_posted'] ?> </p>
</div>    