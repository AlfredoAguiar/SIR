// Veiculos .................................................................................................

fetch('retrive_vec.php')
    .then(response => response.text())
    .then(data => {
        document.getElementById('veiculosContainer').innerHTML = data;
    })
    .catch(error => console.error('Error:', error));


function handleAddVehicle(event) {
    event.preventDefault()
    if (!validateYear()) {
        alert('Ano do veículo deve estar entre 1900 e 2024.');
       
    } else {
     submitForm();
           
    }
}

function validateYear() {
    var yearInput = document.getElementById('newVehicleAno').value;
    var year = parseInt(yearInput, 10);

    return year >= 1900 && year <= 2024;
}

function submitForm() {
    var formData = new FormData(document.getElementById('veiculosForm'));
    var xhr = new XMLHttpRequest();

    document.querySelector('button[type="submit"]').setAttribute('disabled', 'disabled');

    xhr.open('POST', 'veiculos.php', true);

    xhr.onload = function () {
        if (xhr.status === 200) {
            alert(xhr.responseText);
            window.location.href = "veiculos.html";
        } else {
            alert('Ocorreu um erro durante o envio.');
        }

        document.querySelector('button[type="submit"]').removeAttribute('disabled');
    };

    xhr.send(formData);
}


// INDEX .................................................................................................

function showRegistrationModal() {
    $('#loginModal').modal('hide');
    $('#registrationModal').modal('show');
}

function showLoginModal() {
    $('#registrationModal').modal('hide');
    $('#loginModal').modal('show');
}

function handleLogin(event) {
    event.preventDefault();

    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'login.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    if (username === "dm" && password === "dm") {
        window.location.href = "dm/dm.php";
        return; 
    }

    var data = 'username=' + encodeURIComponent(username) + '&password=' + encodeURIComponent(password);

    xhr.onload = function() {
        if (xhr.status === 200) {
            alert(xhr.responseText);
            window.location.href = "veiculos.html";
        } else {
            alert('An error occurred during login.');
        }
    };

    xhr.send(data);
}


function handleRegistration(event) {
    $('#registrationModal').modal('hide');
    $('#loginModal').modal('show');
    event.preventDefault();
var formData = new FormData(document.getElementById('registrationForm'));
var xhr = new XMLHttpRequest();
xhr.open('POST', 'register.php', true);
xhr.onload = function() {

if (xhr.status === 200) {

alert(xhr.responseText);
} else {
alert('An error occurred during registration.');
}
};
xhr.send(formData);
}

function navigateToPage() {
        window.location.href = "veiculos.html";
    }