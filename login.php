<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "<h2>Form Submitted:</h2>";
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";

    $host = 'localhost';
    $dbname = 'stlbac';
    $username = 'root';
    $password = 'root';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("DB connection failed: " . $e->getMessage());
    }

    $user = trim($_POST["username"]);
    $pass = $_POST["password"];

    if (!empty($user) && !empty($pass)) {
        echo "<p>Username and password received</p>";

        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->execute([':username' => $user]);
        $userData = $stmt->fetch(PDO::FETCH_ASSOC);

        echo "<pre>";
        print_r($userData);
        echo "</pre>";
    }
} else {
    echo "No form submitted.";
}
?>
