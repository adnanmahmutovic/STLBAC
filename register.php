<?php

$host = 'localhost';
$dbname = 'stlbac';
$username = 'root';
$password = 'root';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $pass = $_POST["password"];

    if (!empty($user) && !empty($email) && !empty($pass)) {
        $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
        $stmt = $pdo->prepare($sql);

        try {
            $stmt->execute([
                ':username' => $user,
                ':email' => $email,
                ':password' => $hashed_password
            ]);
            header("Location: welcome.php?user=" . urlencode($user));
            exit;

        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                echo "Username or email already exists.";
            } else {
                echo "Error: " . $e->getMessage();
            }
        }
    } else {
        echo "Please fill in all fields.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>St. Louis Balkan American Connection Login/SignUp</title>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <header>
        <div class="logo">
            <img src="STLBAC_Logo2.webp" alt="Community Logo">
        </div>
        <nav>
            <ul>
                <li><a href="index.html" class="active">Home</a></li>
                <li><a href="events.html">Events</a></li>
                <li><a href="connect.html">Connect</a></li>
                <li><a href="our-story.html">Our Story</a></li>
                <li><a href="profile.html">Profile</a></li>
            </ul>
        </nav>
        <div class="buttons">
            <a href="donate.html"><button class="donate">Donate</button></a>
            <a href="profile.html"><button class="join">Join Today</button></a>
        </div>
    </header>
