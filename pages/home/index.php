<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <title>Лента</title>
        <link href="/pages/font.css" rel="stylesheet">
        <link href="/pages/home/home.css" rel="stylesheet">
        <?php require __DIR__ . '/scripts/homeGenerate.php' ?>
    </head>
    <body>        
        <div class="menu"> 
            <img class="menu__icon" src="/media/static_media/menu_items/home-active.svg"  alt="кнопка меню"> 
            <img class="menu__icon" src="/media/static_media/menu_items/user.svg"         alt="кнопка профиля">
            <img class="menu__icon" src="/media/static_media/menu_items/plus.svg"         alt="кнопка плюс">       
        </div>   
        
        <header class="top-of-page"></header>
        <?php getHomeContent() ?>
    </body>
</html>