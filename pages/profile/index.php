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
        <div class="menu"> 
            <img class="menu__icon" src="/media/static_media/menu_items/home-active.svg"  alt="кнопка меню"> 
            <img class="menu__icon" src="/media/static_media/menu_items/user.svg"         alt="кнопка профиля">
            <img class="menu__icon" src="/media/static_media/menu_items/plus.svg"         alt="кнопка плюс">       
        </div>     

        <header class="page-top"></header>

        <main class="content">
            <div class="user-info">
                <img class="user-info__photo" src=<?= $user_avatar ?> alt="фотография пользователя">
                <h1 class="user-info__name" ><?= $user_first_name ?> <?= $user_last_name ?></h1>
                <p class="user-info__status"> <?= $user_status ?> </p>
                <div class="profile-statistic">
                    <img class="profile-statistic__picture" src="/media/static_media/profile__posts.svg" alt="изображение картинки">
                    <span class="profile-statistic__info"><?= $user_posts['counter'] ?> <?php postCounterEnding($user_posts['counter']) ?></span>
                </div>
            </div>

            <div class="user-posts">
                <?php printProfile($user_posts) ?>
            </div>
        </main>        
    </body>
</html>