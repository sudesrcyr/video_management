<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: page1.php');
    exit();
}

include('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $link = $_POST['link'];
    $description = $_POST['description'];
    $date_added = date('Y-m-d H:i:s');

    preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $link, $matches);
    if (isset($matches[1])) {
        $video_id = $matches[1];

        $query = "INSERT INTO video (link, description, date_added, is_deleted) VALUES ('$video_id', '$description', '$date_added', 0)";
        if (mysqli_query($conn, $query)) {
            header('Location: page2.php');
        } else {
            $error = "An error occured while uploading the video. " . mysqli_error($conn);
        }
    } else {
        $error = "Enter a valid YouTube link!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Video</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background-color: #f0f0f0; 
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Video Admin</h1>
        <a href="page3.php" class="add-video-button">Add a new video <span class="plus-icon">+</span></a>
    </div>
    <hr class="header-line">
    <div class="form-container">
        <h2>Adding Video</h2>
        <a href="page2.php" class="cancel-button">Cancel <span class="cancel-icon">✖</span></a>
        <form method="post">
            <label for="link">Youtube Link:</label>
            <input type="text" id="link" name="link" required><br>
            <label for="description">Video Description:</label>
            <input type="text" id="description" name="description" required><br>
            <button type="submit">Save</button>
        </form>
        <?php if (isset($error)) { echo "<p>$error</p>"; } ?>
    </div>
</body>
</html>
