<?php
include 'db_connect.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];

    $sql = "SELECT id, fullname, password FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['fullname'] = $user['fullname'];
            $_SESSION['latitude'] = $latitude;
            $_SESSION['longitude'] = $longitude;

            // Redirect to dashboard or index.html
            header("Location: index-login.php");
            exit();
        } else {
            // Redirect back with error
            header("Location: login.html?error=invalid_password");
            exit();
        }
    } else {
        header("Location: login.html?error=no_account");
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>