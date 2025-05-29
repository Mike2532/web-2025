document.addEventListener("DOMContentLoaded", function() {
    const button = document.querySelector('.auth__send-button');
    button.addEventListener('click', (event) => formcheck(event));
});



function formcheck(event) {
    // allErrorsReset();

    event.preventDefault(); //отключаем дефолтную отправку форму

    const target = event.target;
    const form = target.closest('form');
    const formData = new FormData(form);
    
    const email = formData.get('email');
    const password = formData.get('password');

    console.log(email);
    console.log(password);

    dataValidate(email, password);

}


function dataValidate(email, password) {
    if (isNotEmptyEmail(email) && isNotEmptyPassword(password)) {
        emailValidate(email);
    }
}

function isEmpty(data) {
    return data == ""; 
}

function setRedEmailField() {
    const emailField = document.getElementById('email');
    emailField.classList.add('auth__field-error');
}

function setRedPasswordField() {
    const passwordField = document.getElementById('password');
    passwordField.classList.add('auth__field-error');    
}

function isNotEmptyEmail(email) {
    if (isEmpty(email)) {
        setEmptyError();
        setRedEmailField();
        return false;
    }
}

function isNotEmptyPassword(password) {
    if (isEmpty(password)) {
        setEmptyError();
        setRedPasswordField();
        return false;
    }
}

function emailValidate(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        setInvalidError();
        setRedEmailField();
    }
}

function setEmptyError() {
    const errorWindow = document.querySelector('.error-message');
    errorWindow.innerText = '🤓 Поля обязательные';
    errorWindow.classList.remove('error-message--hidden');
}

function setInvalidError() {
    const errorWindow = document.querySelector('.error-message');
    errorWindow.innerText = '🤥 Неверный формат электропочты';
    errorWindow.classList.remove('error-message--hidden');
}

function unsetError() {
    const errorWindow = document.querySelector('.error-message');
    errorWindow.classList.add('error-message--hidden');
}

// allErrorsReset() {
//     const errorWindow = document.querySelector('.error-message');
//     const 
// }