console.log('=== Auth start ===');

/**
 * Выбор режима входа
 */

var currentMode = 'sign-in';

var buttonSignIn = document.getElementById('button-sign-in');
var buttonSignUp = document.getElementById('button-sign-up');

buttonSignIn.addEventListener('click', function () {
    currentMode = 'sign-in';
    changeForm();
});

buttonSignUp.addEventListener('click', function () {
    currentMode = 'sign-up';
    changeForm();
});

var changeForm = function () {
    if (currentMode === 'sign-in') {
        document.getElementById('input-email').style.display = 'none';
    }
    if (currentMode === 'sign-up') {
        document.getElementById('input-email').style.display = 'block';
    }
}

changeForm();

/**
 * Отправка данных
 */

var buttonOk = document.getElementById('button-ok');

buttonOk.addEventListener('click', function (event) {
    event.preventDefault();

    var formData = new FormData(document.forms.auth);

    var urlSignIn = 'api/authentication.php';
    var urlSignUp = 'api/registration.php';
    var xhr = new XMLHttpRequest();

    if (currentMode === 'sign-in') {
        xhr.open("POST", urlSignIn);
    }
    if (currentMode === 'sign-up') {
        xhr.open("POST", urlSignUp);
    }

    xhr.send(formData);


    xhr.onload = function() {
        console.log(xhr.response)
        document.cookie = (xhr.response);
    }
    document.location.href = "api/check-token.php";
});