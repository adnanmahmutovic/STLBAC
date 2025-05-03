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

$user = $_GET['user'] ?? '';

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($user)) {
    $full_name = $_POST['full_name'];
    $major = $_POST['major'];
    $hobbies = $_POST['hobbies'];

    // Handle profile picture upload
    $profile_picture = '';
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
        $targetDir = "uploads/";
        if (!is_dir($targetDir)) mkdir($targetDir);
        $targetFile = $targetDir . basename($_FILES["profile_picture"]["name"]);
        if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $targetFile)) {
            $profile_picture = $targetFile;
        }
    }

    // Update user info
    $sql = "UPDATE users SET full_name = :full_name, major = :major, hobbies = :hobbies, profile_picture = :profile_picture WHERE username = :username";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':full_name' => $full_name,
        ':major' => $major,
        ':hobbies' => $hobbies,
        ':profile_picture' => $profile_picture,
        ':username' => $user
    ]);

    echo "<p>Profile updated successfully. <a href='welcome.php?user=$user'>Go to Profile</a></p>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Profile</title>
</head>
<body>
    <h2>Edit Your Profile</h2>
    <form action="" method="POST" enctype="multipart/form-data">
        <label>Full Name: <input type="text" name="full_name"></label><br><br>
        <label>Major: <input type="text" name="major"></label><br><br>
        <label>Hobbies/Interests:<br><textarea name="hobbies" rows="4" cols="40"></textarea></label><br><br>
        <label>Profile Picture: <input type="file" name="profile_picture"></label><br><br>
        <button type="submit">Save Profile</button>
    </form>
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
