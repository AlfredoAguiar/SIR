<?php
session_start();
include 'bd.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $matricula = $_POST["newVehicleMatricula"];
    $marca = $_POST["newVehicleMarca"];
    $modelo = $_POST["newVehicleModelo"];
    $ano = $_POST["newVehicleAno"];
    $km = $_POST["newVehicleKM"];
    $cor = $_POST["newVehicleCor"];

    $targetDirectory = "uplo/"; 
    
    $targetFile = $targetDirectory . uniqid() . "_" . basename($_FILES["newVehicleImage"]["name"]);

    move_uploaded_file($_FILES["newVehicleImage"]["tmp_name"], $targetFile);


    try {
        $checkQuery = $conn->prepare("SELECT Matrícula FROM veiculos WHERE Matrícula = ?");
        $checkQuery->bind_param("s", $matricula);
        $checkQuery->execute();
        $checkResult = $checkQuery->get_result();
    
        $response = ['exists' => ($checkResult->num_rows > 0)];
        if ($response['exists']) {
                echo("Matrícula em uso");
            exit;
        }
        else{
          
        $insertQuery = $conn->prepare("INSERT INTO veiculos (Matrícula, Marca, Modelo, Ano, KM, Cor, Img) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $insertQuery->bind_param("sssssss", $matricula, $marca, $modelo, $ano, $km, $cor, $targetFile);
        $insertQuery->execute();
    
        if ($insertQuery->affected_rows > 0) {
            $insertUserVeiculoQuery = $conn->prepare("INSERT INTO user_veiculo (veiculo, user) VALUES (?, ?)");
            $insertUserVeiculoQuery->bind_param("ss", $matricula, $_SESSION['username']);
            $insertUserVeiculoQuery->execute();
    
            if ($insertUserVeiculoQuery->affected_rows > 0) {
                echo '"Veículo adicionado com sucesso!"';
                exit();
            }
        } }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    } finally {

        $conn->close();
    }}
    
?>