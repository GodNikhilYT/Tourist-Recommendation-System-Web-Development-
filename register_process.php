<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];

    // Check if passwords match
    if ($password != $confirm_password) {
        header("Location: register.html?error=password_mismatch");
        exit();
    }

    // Check if fullname contains any digits
    if (preg_match('/[0-9]/', $fullname)) {
        header("Location: register.html?error=invalid_name");
        exit();
    }

    // Check if email already exists
    $check_email_sql = "SELECT id FROM users WHERE email = ?";
    $stmt = $conn->prepare($check_email_sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->close();
        header("Location: register.html?error=email_exists");
        exit();
    }
    $stmt->close();

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert user
    $insert_sql = "INSERT INTO users (fullname, email, password, latitude, longitude) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($insert_sql);
    $stmt->bind_param("sssss", $fullname, $email, $hashed_password, $latitude, $longitude);

    if ($stmt->execute()) {
        header("Location: login.html?success=registered");
        exit();
    } else {
        header("Location: register.html?error=registration_failed");
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>
