function handleAddServico(event) {
    event.preventDefault();

    var formData = new FormData(document.getElementById('ServiçosForm'));
    var xhr = new XMLHttpRequest();

    xhr.open('POST', 'Serviços.php', true);

    xhr.onload = function () {

        if (xhr.status === 200) {
            alert(xhr.responseText);
            window.location.href = "manuten.html";
        } else {
            alert('Ocorreu um erro durante o envio.');
        }
    };

    xhr.send(formData);
}

function updatePrice() {
    var selectedService = document.getElementById("tipoServico").value;

    var price;
    switch(selectedService) {
        case "mudarOleo":
            price = 50.00;
            break;
        case "trocarPneus":
            price = 100.00;
            break;
        case "reparacaoMotor":
            price = 150.00;
            break;
        case "alinhamentoDirecao":
            price = 80.00;
            break;
        case "outro":
            price = 200.00;
            break;
        default:
            price = 0; 
    }

    var formattedPrice = (price === 0) ? "Ainda não disponível" : "$" + price.toFixed(2);

    document.getElementById("precoInput").value = price;

    document.getElementById("preco").innerText = formattedPrice;
}


//---------------------------------------------------------------------------------------------------
var today = new Date();
var dd = String(today.getDate()).padStart(2, '0');
var mm = String(today.getMonth() + 1).padStart(2, '0');
var yyyy = today.getFullYear();
today = yyyy + '-' + mm + '-' + dd;

document.getElementById('dataServico').min = today;


//---------------------------------------------------------------------------------------------------


fetch('retrive_ser.php')
    .then(response => response.text())
    .then(data => {
        document.getElementById('ServiçosContainer').innerHTML = data;
        applySearchEventListener();
    })
    .catch(error => console.error('Error:', error));



    function searchByMatricula() {
        var matricula = document.getElementById('matriculaSearch').value;
        var servicesContainer = document.getElementById('ServiçosContainer');
    
        servicesContainer.innerHTML = '';
    
        fetch('retrive_ser.php?matricula=' + matricula)
            .then(response => response.text())
            .then(data => {
                servicesContainer.innerHTML = data;
            })
            .catch(error => console.error('Error:', error));
    }
//---------------------------------------------------------------------------------------------------

    
    fetch('servico_user_vec.php')
        .then(response => response.json())
        .then(matriculas => {
           
            var carMatriculaSelect = document.getElementById('carMatricula');

            matriculas.forEach(function (matricula) {
                var option = document.createElement('option');
                option.value = matricula;
                option.text = matricula;
                carMatriculaSelect.add(option);
            });
        })
        .catch(error => console.error('Error:', error));

function navigateToPage() {
        window.location.href = "manuten.html";
    }