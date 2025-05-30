document.addEventListener("DOMContentLoaded", function() {
    addSendInteractivity();
    addEyeInteractivity();
});

function addEyeInteractivity() {
    const eyeOff = document.querySelector('.auth__hide-password');
    eyeOff.addEventListener('click', () => {
        const passwordField = document.getElementById('password');
        const isClose = eyeOff.src.endsWith('/media/static_media/eye_off.svg');
        if (isClose) {
            eyeOff.src = '/media/static_media/eye_open.svg';
            passwordField.type = 'text';
        } else {
            eyeOff.src = '/media/static_media/eye_off.svg';
            passwordField.type = 'password';
        }
    });
}

function addSendInteractivity() {
    const button = document.querySelector('.auth__send-button');
    button.addEventListener('click', (event) => formCheck(event));
}

function formCheck(event) {
    event.preventDefault();
    const target = event.target;
    
    const form = target.closest('form');
    const formData = new FormData(form);
    
    const email = formData.get('email');
    const password = formData.get('password');

    dataValidate(email, password);
}

function dataValidate(email, password) {
    const settedEmail = isFieldNotEmpty(email);
    const settedPassword = isFieldNotEmpty(password);
    let valid = true;
    
    if (!settedEmail) {
        setRedBorder('email');
        valid = false;
    }

    if (!settedPassword) {
        setRedBorder('password');
        valid = false;
    }

    if (valid) {
        valid = emailValidate(email)
    }

    if (valid) {
        setErrorMessage('🤥 Не те логин или пароль...');
    }
}

function isEmpty(data) {
    return !data || data.trim() === ""; 
}

function removeRedBorder(field) {
    field.classList.remove('auth__field_error');
    hideErrorMessageIfNeed();
}

function hideErrorMessageIfNeed() {
    const allErrorsItems = document.querySelectorAll('.auth__field_error');
    if (allErrorsItems.length == 0) {
        const errorWindow = document.querySelector('.error-message');
        errorWindow.classList.add('error-message--hidden');
    }
}

function setRedBorder(id) {
    const field = document.getElementById(id);
    field.classList.add('auth__field_error');
    field.addEventListener('click', () => removeRedBorder(field), {once: true});
}

function isFieldNotEmpty(field) {
    if (isEmpty(field)) {
        setErrorMessage('🤓 Поля обязательные');
        return false;
    }
    return true;
}

function emailValidate(email) {
    const emailRegex = /^[^\s@.]+@[^\s@]+\.[^\s@.]+$/;
    if (!emailRegex.test(email)) {
        setErrorMessage('🤥 Неверный формат электропочты')
        setRedBorder('email');
        return false;
    }
    return true;
}

function setErrorMessage(message) {
    const errorWindow = document.querySelector('.error-message');
    errorWindow.innerText = message;
    errorWindow.classList.remove('error-message--hidden');
}

function unsetError() {
    const errorWindow = document.querySelector('.error-message');
    errorWindow.classList.add('error-message--hidden');
}