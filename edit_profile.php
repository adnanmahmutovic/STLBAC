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

    // profile picture upload
    $profile_picture = '';
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
        $targetDir = "uploads/";
        if (!is_dir($targetDir)) mkdir($targetDir);
        $targetFile = $targetDir . basename($_FILES["profile_picture"]["name"]);
        if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $targetFile)) {
            $profile_picture = $targetFile;
        }
    }

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
    <link rel="stylesheet" href="styles.css">
    <style>
        .profile-edit-container {
            max-width: 700px;
            margin: 3rem auto;
            background-color: #fff;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .profile-edit-container h2 {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .form-group {
            margin-bottom: 1.2rem;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 0.6rem;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 1rem;
        }

        .form-group textarea {
            resize: vertical;
            height: 120px;
        }

        .form-group input[type="file"] {
            padding: 0;
        }

        .save-btn {
            display: block;
            width: 100%;
            background-color: #002D62;
            color: white;
            padding: 0.75rem;
            font-size: 1rem;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .save-btn:hover {
            background-color: #0056b3;
        }
    </style>
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

<div class="profile-edit-container">
    <h2>Edit Your Profile</h2>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="full_name">Full Name:</label>
            <input type="text" id="full_name" name="full_name">
        </div>

        <div class="form-group">
            <label for="major">Major:</label>
            <input type="text" id="major" name="major">
        </div>

        <div class="form-group">
            <label for="hobbies">Hobbies/Interests:</label>
            <textarea id="hobbies" name="hobbies"></textarea>
        </div>

        <div class="form-group">
            <label for="profile_picture">Profile Picture:</label>
            <input type="file" id="profile_picture" name="profile_picture">
        </div>

        <button type="submit" class="save-btn">Save Profile</button>
    </form>
</div>
</body>
</html>