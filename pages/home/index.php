<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <title>Лента</title>
        <link href="/pages/font.css" rel="stylesheet">
        <link href="/pages/home/home.css" rel="stylesheet">
    </head>
    <body>        
        <div class="page__menu"> 
            <img class="page__menu__icon--active" src="/media/static_media/menu_items/home-active.svg"  alt="кнопка меню"> 
            <img class="page__menu__icon"         src="/media/static_media/menu_items/user.svg"         alt="кнопка профиля">
            <img class="page__menu__icon"         src="/media/static_media/menu_items/plus.svg"         alt="кнопка плюс">       
        </div>   
        
        <header class="header"></header>
        <?php require __DIR__ . '/scripts/homeGenerate.php' ?>
    </body>
</html>