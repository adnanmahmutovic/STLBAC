<?php
$host = 'localhost';
$dbname = 'stlbac';
$username = 'root';
$password = 'root';

// Connect to the database
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

$user = $_GET['user'] ?? '';

// Get user data
$sql = "SELECT * FROM users WHERE username = :username";
$stmt = $pdo->prepare($sql);
$stmt->execute([':username' => $user]);
$userData = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$userData) {
    die("User not found.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome, <?php echo htmlspecialchars($user); ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 30px;
            background-color: #f4f4f4;
        }
        .profile-container {
            background: white;
            border-radius: 12px;
            padding: 30px;
            display: inline-block;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        .profile-picture {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="profile-container">
        <h1>Welcome, <?php echo htmlspecialchars($userData['username']); ?>!</h1>

        <?php if (!empty($userData['profile_picture'])): ?>
            <img class="profile-picture" src="<?php echo htmlspecialchars($userData['profile_picture']); ?>" alt="Profile Picture">
        <?php endif; ?>

        <?php if (!empty($userData['full_name'])): ?>
            <p><strong>Full Name:</strong> <?php echo htmlspecialchars($userData['full_name']); ?></p>
        <?php endif; ?>

        <?php if (!empty($userData['major'])): ?>
            <p><strong>Major:</strong> <?php echo htmlspecialchars($userData['major']); ?></p>
        <?php endif; ?>

        <?php if (!empty($userData['hobbies'])): ?>
            <p><strong>Hobbies & Interests:</strong> <?php echo nl2br(htmlspecialchars($userData['hobbies'])); ?></p>
        <?php endif; ?>

        <br>
        <a href="edit_profile.php?user=<?php echo urlencode($user); ?>">Please complete your profile here!</a>
    </div>
</body>
</html>

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
