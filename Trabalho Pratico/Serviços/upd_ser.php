<?php
include '../bd.php';
ob_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_ser'])) {
    $id = $_POST['id_ser'];
    $newT = $_POST["newtipoServico"];
    $newD = $_POST["newdataServico"];
    $newE =  $_POST["newestado"];
    try {
        $updateQuery = $conn->prepare("UPDATE serviços SET Data=?, Tipo=?,Estado=? WHERE id_ser=?");

        $updateQuery->bind_param("ssss", $newD, $newT,$newE, $id);

        $updateQuery->execute();

        if ($updateQuery->affected_rows > 0) {

            ob_end_flush();
            header("Location: manuten.html");
            exit;
           
        } else {
            header("Location: manuten.html");
            exit;
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