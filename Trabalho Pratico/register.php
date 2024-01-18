<?php
include 'bd.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST["user"];
    $userPassword = $_POST["password"]; 
    

    $checkQuery = $conn->prepare("SELECT user FROM users WHERE user = ?");
    $checkQuery->bind_param("s", $user);
    $checkQuery->execute();
    $checkResult = $checkQuery->get_result();

    if ($checkResult->num_rows > 0) {
        echo "Nome de utilizador já em uso. Por favor, escolha outro.";
    } else {
        $insertQuery = $conn->prepare("INSERT INTO users (user, password) VALUES (?, ?)");
        $insertQuery->bind_param("ss", $user, $userPassword); 
        if ($insertQuery->execute()) {
            echo "Registration successful!";
        } else {
            echo "Error: " . $insertQuery->error;
        }
        $insertQuery->close();
    }

    $checkQuery->close();
}

$conn->close();
?>