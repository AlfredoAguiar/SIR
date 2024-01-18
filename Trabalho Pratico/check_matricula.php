<?php
include 'bd.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $matricula = $_POST["matricula"];

    $checkQuery = $conn->prepare("SELECT Matrícula FROM veiculos WHERE Matrícula = ?");
    $checkQuery->bind_param("s", $matricula);
    $checkQuery->execute();
    $checkResult = $checkQuery->get_result();

    $response = ['exists' => ($checkResult->num_rows > 0)];
    if ($response['exists']) {
    }
    echo json_encode($response);
}
?>