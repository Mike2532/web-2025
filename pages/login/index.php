<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <title>Вход</title>
        <link href="/pages/font.css" rel="stylesheet">
        <link href="/pages/login/login.css" rel="stylesheet">
    </head>
    <body>
        <h1 class="title">Войти</h1>
        <img class="user-avatar" src="/media/static_media/login__picture.png" alt="Картинка страницы входа"> 
        <form class="auth">
            <label for="email">Электропочта</label>
            <input class="auth__field" type="email" id="email" required>
            <span class="auth__comments">Введите электропочту в формате *****@***.***</span>
            <label for="password">Пароль</label>
            <input class="auth__field" type="password" id="password" required>
            <img class="auth__hide-password" src="/media/static_media/eye_off.svg" alt="показать/скрыть пароль">
            <input class="auth__send-button" type="submit" name="sumbit_form">
        </form>
    </body>
</html>