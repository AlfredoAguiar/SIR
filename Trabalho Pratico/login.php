<?php
session_start(); 
include 'bd.php';
ob_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $loginQuery = $conn->prepare("SELECT user, password FROM users WHERE user = ?");
    $loginQuery->bind_param("s", $username);
    $loginQuery->execute();
    $loginResult = $loginQuery->get_result();

    if ($loginResult->num_rows > 0) {
        $row = $loginResult->fetch_assoc();
        $storedPassword = $row["password"];

        if ($password === $storedPassword) {
            $selectQuery = $conn->prepare("SELECT count FROM count WHERE id = 'count'");
            $selectQuery->execute();
            $selectResult = $selectQuery->get_result();

            if ($selectResult->num_rows > 0) {
                $row = $selectResult->fetch_assoc();
                $currentCount = $row["count"];
                $updatedCount = $currentCount + 1;

                $updateQuery = $conn->prepare("UPDATE count SET count = ? WHERE id = 'count'");
                $updateQuery->bind_param("i", $updatedCount);
                $updateQuery->execute();
                $updateQuery->close();

                $_SESSION['username'] = $username;
                echo "Login efetuado com sucesso.";
                exit;
            } else {
                echo "Error retrieving count.";
            }
        } else {
            echo "Invalid username or password.";
        }
    } else {
        echo "Invalid username or password.";
    }

    $loginQuery->close();
}
$conn->close();
?>