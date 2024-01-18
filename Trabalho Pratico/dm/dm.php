<?php
include '../bd.php';

$countUsersQuery = $conn->prepare("SELECT COUNT(*) as userCount FROM users");
$countUsersQuery->execute();
$countUsersResult = $countUsersQuery->get_result();

if ($countUsersResult->num_rows > 0) {
    $row = $countUsersResult->fetch_assoc();
    $userCount = $row['userCount'];
} else {
    $userCount = 0;
}

$countVeiculosQuery = $conn->prepare("SELECT COUNT(*) as veiculosCount FROM veiculos");
$countVeiculosQuery->execute();
$countVeiculosResult = $countVeiculosQuery->get_result();

if ($countVeiculosResult->num_rows > 0) {
    $row = $countVeiculosResult->fetch_assoc();
    $veiculosCount = $row['veiculosCount'];
} else {
    $veiculosCount = 0;
}


$countServicosQuery = $conn->prepare("SELECT COUNT(*) as servicosCount FROM serviços");
$countServicosQuery->execute();
$countServicosResult = $countServicosQuery->get_result();

if ($countServicosResult->num_rows > 0) {
    $row = $countServicosResult->fetch_assoc();
    $servicosCount = $row['servicosCount'];
} else {
    $servicosCount = 0;
}

$selectQuery = $conn->prepare("SELECT count FROM count WHERE id = 'count'");
$selectQuery->execute();
$selectResult = $selectQuery->get_result();

if ($selectResult->num_rows > 0) {
    $row = $selectResult->fetch_assoc();
    $currentCount = $row["count"];
} else {
    $currentCount = 0;
}

$countUsersQuery->close();
$countVeiculosQuery->close();
$countServicosQuery->close();
$selectQuery->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CarManager - Manutenções</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="t.css">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <div class="d-flex align-items-center">
                        <img src="../logo.jpg" alt="CarManager Logo" width="50" height="50">
                        <span class="ml-3">CarManager</span>
                    </div>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                       
                        <li class="nav-item">
                            <button class="button-3" onclick="location.href='../logout.php'">Sair</button>
                        </li>
        
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <body>
     <h2>Número total de usuários: <?php echo $userCount; ?></h2>
     <h2>Número total de veiculos: <?php echo $veiculosCount; ?></h2>
     <h2>Número total de serviços: <?php echo $servicosCount; ?></h2>
     <h2>Número total de Entradas no site: <?php echo $currentCount; ?></h2>
    </body>
    </html>