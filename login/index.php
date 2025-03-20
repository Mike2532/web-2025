<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <title>Вход</title>
        <link href="/font.css" rel="stylesheet">
        <link href="/login/styles/login.css" rel="stylesheet"> 
    </head>
    <body>
        <h1 class="title">Войти</h1>
        <img class="user-avatar" src="/login/images/login.png" alt="Картинка страницы входа"> 
        <form class="auth">
            <label for="email">Электропочта</label>
            <input class="auth__field" type="email" id="email" required>
            <span class="auth__comments">Введите электропочту в формате *****@***.***</span>
            <label for="password">Пароль</label>
            <input class="auth__field" type="password" id="password" required>
            <img class="auth__hide-password" src="/login/images/eye_off.svg" alt="показать/скрыть пароль">
            <input class="auth__send-button" type="submit" name="sumbit_form">
        </form>
    </body>
</html>