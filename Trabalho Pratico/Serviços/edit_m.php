<?php
include '../bd.php';

function getVehicleById($conn, $serId) {
    $selectQuery = $conn->prepare("SELECT * FROM serviços WHERE id_ser = ?");
    $selectQuery->bind_param("s", $serId);
    $selectQuery->execute();
    $result = $selectQuery->get_result();
    return $result->fetch_assoc();
}

if (isset($_GET['id'])) {
    $serId = $_GET['id'];
    $car = getVehicleById($conn, $serId);

    if ($car) {
        include 'edit_ser.php';
    } else {
        echo 'Vehicle not found.';
    }
} else {
    echo 'Invalid request.';
}

$conn->close();
?>