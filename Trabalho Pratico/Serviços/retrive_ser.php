<?php
include '../bd.php';

try {
    session_start();

    if (!isset($_SESSION['username'])) {
        echo "Utilizador não autenticado.";
        exit();
    }

    $username = $_SESSION['username'];

    $selectUserVeiculoQuery = $conn->prepare("SELECT veiculo FROM user_veiculo WHERE user = ?");
    $selectUserVeiculoQuery->bind_param("s", $username);
    $selectUserVeiculoQuery->execute();
    $resultUserVeiculo = $selectUserVeiculoQuery->get_result();

    if ($resultUserVeiculo->num_rows > 0) {
        $associatedVehicles = array();

        while ($rowUserVeiculo = $resultUserVeiculo->fetch_assoc()) {
            $associatedVehicles[] = $rowUserVeiculo['veiculo'];
        }

        $matriculaFilter = isset($_GET['matricula']) ? $_GET['matricula'] : null;

        if ($matriculaFilter) {
            $selectQuery = $conn->prepare("SELECT * FROM serviços WHERE Matrícula = ?");
            $selectQuery->bind_param("s", $matriculaFilter);
        } else {
            $selectQuery = $conn->prepare("SELECT * FROM serviços WHERE Matrícula IN (" . implode(",", array_fill(0, count($associatedVehicles), "?")) . ")");
            $selectQuery->bind_param(str_repeat("s", count($associatedVehicles)), ...$associatedVehicles);
        }

        $selectQuery->execute();

        $result = $selectQuery->get_result();

        while ($car = $result->fetch_assoc()) {
            echo '<a href="edit_m.php?id=' . $car['id_ser'] . '" class="vehicle-link">';
            echo '<div class="container">';
            echo '<div class="row">';
            echo '<div class="col-md-6">';
            echo '<ul class="list-group list-group-flush">';
            echo '<li class="list-group-item"><strong>Matrícula:</strong> ' . $car['Matrícula'] . '</li>';
            echo '<li class="list-group-item"><strong>Data:</strong> ' . $car['Data'] . '</li>';
            echo '<li class="list-group-item"><strong>Estado:</strong> ' . $car['Estado'] . '</li>';
            echo '<li class="list-group-item"><strong>Tipo:</strong> ' . $car['Tipo'] . '</li>';
            echo '<li class="list-group-item"><strong>Preço:</strong> ' . $car['Preço'] . '</li>';
            echo '<li class="list-group-item"><strong>Observações:</strong> ' . $car['Observações'] . '</li>';
            echo '</ul>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</a>';
            echo '<br>';
            echo '<br>';
        }
    } else {
        echo "Nenhum veículo associado ao utilizador.";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
} finally {
    $conn->close();
}
?>