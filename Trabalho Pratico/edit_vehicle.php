<?php
include 'bd.php';

function getVehicleById($conn, $vehicleId) {
    $selectQuery = $conn->prepare("SELECT * FROM veiculos WHERE Matrícula = ?");
    $selectQuery->bind_param("s", $vehicleId);
    $selectQuery->execute();
    $result = $selectQuery->get_result();
    return $result->fetch_assoc();
}

if (isset($_GET['id'])) {
    $vehicleId = $_GET['id'];
    $car = getVehicleById($conn, $vehicleId);

    if ($car) {
        include 'edit_vehicle_form.html';
    } else {
        echo 'Vehicle not found.';
    }
} else {
    echo 'Invalid request.';
}

$conn->close();
?>