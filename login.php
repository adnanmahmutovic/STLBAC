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
    
<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Database config
$host = 'localhost';
$dbname = 'stlbac';
$username = 'root';
$password = 'root';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("<h2>DB connection failed: " . $e->getMessage() . "</h2>");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = trim($_POST["username"]);
    $pass = $_POST["password"];

    if (!empty($user) && !empty($pass)) {
        $sql = "SELECT * FROM users WHERE username = :username";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':username' => $user]);
        $userData = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($userData) {
            if (password_verify($pass, $userData["password"])) {
                $_SESSION["username"] = $userData["username"];
                header("Location: welcome.php?user=" . urlencode($userData["username"]));
                exit();
            } else {
                echo "<h2>Incorrect password.</h2>";
            }
        } else {
            echo "<h2>User not found.</h2>";
        }
    } else {
        echo "<h2>Please fill in all fields.</h2>";
    }
} else {
    echo "<h2>Invalid request method.</h2>";
}
?>
