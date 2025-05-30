<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <title>Вход</title>
        <link href="/pages/font.css" rel="stylesheet">
        <link href="/pages/login/login.css" rel="stylesheet">
        <script src="/pages/login/scripts/form-validate.js"></script>
    </head>
    <body>

        <main class="content">
            <div class="media">
                <h1 class="media__title">Войти</h1>
                <img class="media__hello-picture" src="/media/static_media/login__picture_2.png" alt="Картинка страницы входа"> 
            </div>
            <form class="auth">
                <div class="auth__error-message auth__error-message_hidden">
                </div>

                <label for="email">Электропочта</label>
                <input class="auth__field" type="text" id="email" name="email">
                <span class="auth__comments">Введите электропочту в формате *****@***.***</span>
                <label for="password">Пароль</label>
                <div class="auth__field-wrapper">
                    <input class="auth__field" type="password" id="password" name="password">
                    <img class="auth__hide-password" src="/media/static_media/eye_off.svg" alt="показать/скрыть пароль">
                </div>
                <button class="auth__send-button" type="submit">Продолжить</button>
            </form>  
        </main>

    </body>
</html>

