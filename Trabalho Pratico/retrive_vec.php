<?php
include 'bd.php';

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
            $associatedVehicles = [];

            while ($rowUserVeiculo = $resultUserVeiculo->fetch_assoc()) {
                $associatedVehicles[] = $rowUserVeiculo['veiculo'];
            }

            $placeholders = implode(",", array_fill(0, count($associatedVehicles), "?"));
            $selectQuery = $conn->prepare("SELECT * FROM veiculos WHERE Matrícula IN ($placeholders)");
            $selectQuery->bind_param(str_repeat("s", count($associatedVehicles)), ...$associatedVehicles);
        } else {
            echo "Nenhum veículo associado ao utilizador.";
            exit();
        }
    

    $selectQuery->execute();
    $result = $selectQuery->get_result();

    while ($car = $result->fetch_assoc()) {
        echo '<a href="edit_vehicle.php?id=' . $car['Matrícula'] . '" class="vehicle-link">';
        echo '<div class="card-deck">';
        echo '<div class="card">';
        echo '<img src="' . $car['img'] . '" class="card-img-top">';
        echo '<div class="card-body">';
        echo '<ul class="list-group list-group-flush">';
        echo '<li class="list-group-item"><strong>Matrícula:</strong> ' . $car['Matrícula'] . '</li>';
        echo '<li class="list-group-item"><strong>Marca:</strong> ' . $car['Marca'] . '</li>';
        echo '<li class="list-group-item"><strong>Modelo:</strong> ' . $car['Modelo'] . '</li>';
        echo '<li class="list-group-item"><strong>Ano:</strong> ' . $car['Ano'] . '</li>';
        echo '<li class="list-group-item"><strong>KM:</strong> ' . $car['KM'] . '</li>';
        echo '<li class="list-group-item"><strong>Cor:</strong> ' . $car['Cor'] . '</li>';
        echo '</ul>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</a>';
        echo '<br>';
        echo '<br>';
    }

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
} finally {
    if (isset($selectUserVeiculoQuery)) {
        $selectUserVeiculoQuery->close();
    }
    $selectQuery->close();
    $conn->close();
}
?>