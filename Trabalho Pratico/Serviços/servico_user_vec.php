<?php
include '../bd.php';

try {
    session_start();

    if (!isset($_SESSION['username'])) {
        header('Content-Type: application/json');
        echo json_encode(["error" => "Utilizador não autenticado"]);
        exit();
    }

    $username = $_SESSION['username'];

    $selectUserVeiculoQuery = $conn->prepare("SELECT veiculo FROM user_veiculo WHERE user = ?");
    $selectUserVeiculoQuery->bind_param("s", $username);
    $selectUserVeiculoQuery->execute();
    $resultUserVeiculo = $selectUserVeiculoQuery->get_result();

    if ($resultUserVeiculo->num_rows > 0) {
        $associatedVehicles = array();

        while ($row = $resultUserVeiculo->fetch_assoc()) {
            $associatedVehicles[] = $row['veiculo'];
        }

    
        header('Content-Type: application/json');
        echo json_encode($associatedVehicles);
    } else {
        header('Content-Type: application/json');
        echo json_encode(["error" => "Nenhum veículo associado ao utilizador"]);
    }
} catch (Exception $e) {
    header('Content-Type: application/json');
    echo json_encode(["error" => "Error: " . $e->getMessage()]);
} finally {
    $conn->close();
}
?>