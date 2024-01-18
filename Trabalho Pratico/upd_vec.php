<?php
include 'bd.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['matricula'])) {
    $matricula = $_POST['matricula'];
    $newMarca = $_POST["newVehicleMarca"];
    $newModelo = $_POST["newVehicleModelo"];
    $newAno = $_POST["newVehicleAno"];
    $newKM = $_POST["newVehicleKM"];
    $newCor = $_POST["newVehicleCor"];

    try {
        $updateQuery = $conn->prepare("UPDATE veiculos SET Marca=?, Modelo=?, Ano=?, KM=?, Cor=? WHERE Matrícula=?");

        $updateQuery->bind_param("ssssss", $newMarca, $newModelo, $newAno, $newKM, $newCor, $matricula);

        $updateQuery->execute();

        
        if ($updateQuery->affected_rows > 0) {
            header("Location: veiculos.html");
            exit();
        } else {
            header("Location: veiculos.html");
            exit();
        }

        $updateQuery->close();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    } finally {
        
        $conn->close();
    }
} else {
    echo 'Erro';
}
?>