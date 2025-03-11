<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <title>Вход</title>
        <link href="/login/styles/text.css" rel="stylesheet"> 
        <link href="/login/styles/pictures.css" rel="stylesheet"> 
        <link href="/login/styles/forms.css" rel="stylesheet"> 
    </head>
    <body>
        <h1 class="enter">Войти</h1>
        <img class="hellophoto" src="/login/images/login.png" alt="Картинка страницы входа"> 
        <form action="/handler">
            <p class="maintext">Электропочта</p>
            <input class="inputform" type="email" name="login_email" required>
            <p class="loginformcomments">Введите электропочту в формате *****@***.***</p>
            <p class="maintext">Пароль</p>
            <input class="inputform" type="password" name="login_password" required>
            <img src="/login/images/eye_off.svg" alt="скрыть пароль">
            <p></p>
            <input class="inputsubmit" type="submit" name="sumbit_form">
        </form>
    </body>
</html>