<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <title>Профиль</title>
        <link href="/pages/font.css" rel="stylesheet">
        <link href="/pages/profile/profile.css" rel="stylesheet">
        <?php require __DIR__ . '/scripts/profileGenerate.php' ?>
    </head>
    <body>
        <div class="page-menu"> 
            <img class="page-menu__icon"         src="/media/static_media/menu_items/home.svg"         alt="кнопка меню"> 
            <img class="page-menu__icon--active" src="/media/static_media/menu_items/user-active.svg"  alt="кнопка профиля">
            <img class="page-menu__icon"         src="/media/static_media/menu_items/plus.svg"         alt="кнопка плюс">       
        </div>    

        <main class="content">
            <div class="page-user-info">
                <img class="page-user-info--photo" src=<?= $user_avatar ?> alt="фотография пользователя">
                <h1 class="page-user-info--name" ><?= $user_first_name ?> <?= $user_last_name ?></h1>
                <p class="page-user-info--status"> <?= $user_status ?> </p>
                <div class="page-header__profile-statistic">
                    <img class="profile-statistic__picture" src="/media/static_media/profile__posts.svg" alt="изображение картинки">
                    <span class="profile-statistic__info"><?= $user_posts['counter'] ?> <?php post_counter_ending($user_posts['counter']) ?></span>
                </div>
            </div>

            <div class="page-user-posts">
                <?php user_post_generation($user_posts) ?>
            </div>

        </main>        
    </body>
</html>