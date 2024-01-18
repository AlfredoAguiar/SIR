<?php
include '../bd.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['addVeiculo'])) {
    
        $matricula = $_POST['carMatricula'];
        $user=$_GET['id'];;

        $insertUserVeiculoQuery = $conn->prepare("INSERT INTO user_veiculo (veiculo, user) VALUES (?, ?)");
        $insertUserVeiculoQuery->bind_param("ss", $matricula,$user );
        $insertUserVeiculoQuery->execute();


        if ($insertUserVeiculoQuery->affected_rows > 0) {
            $response = array('status' => 'success', 'message' => 'Veículo adicionado com sucesso!');
            header("Location: info.php");
            exit();
        } else {
            $response = array('status' => 'error', 'message' => 'Erro ao adicionar o veículo.');
            echo json_encode($response);
            exit();
        }
    }
}
?>