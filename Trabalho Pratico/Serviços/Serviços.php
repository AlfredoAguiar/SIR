<?php
session_start();
include '../bd.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uniqueId = uniqid();
    $matricula = $_POST["carMatricula"];
    $tipoServico = $_POST["tipoServico"];
    $dataServico = $_POST["dataServico"];
    $estado = "Pendente";
    $preco =  $_POST["preco"]; 
    $observacoes = $_POST["observacoes"];

    try {
    
        $insertQuery = $conn->prepare("INSERT INTO serviços ( Matrícula, Tipo, Data, Estado, Preço, Observações) VALUES ( ?, ?, ?, ?, ?, ?)");
        $insertQuery->bind_param("ssssss", $matricula, $tipoServico, $dataServico, $estado, $preco, $observacoes);
        $insertQuery->execute();
        echo "Serviço adicionado com sucesso!";
        exit();

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    } finally {
        $conn->close();
    }
}
?>