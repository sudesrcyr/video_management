<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: page1.php');
    exit();
}

include('db.php');

$id = $_GET['id'];
$query = "SELECT * FROM video WHERE id='$id'";
$result = mysqli_query($conn, $query);
$video = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $link = $_POST['link'];
    $description = $_POST['description'];

    preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $link, $matches);
    if (isset($matches[1])) {
        $video_id = $matches[1];

        $query = "UPDATE video SET link='$video_id', description='$description' WHERE id=$id";
        if (mysqli_query($conn, $query)) {
            header('Location: page2.php');
        } else {
            $error = "An error occurred while updating the video: " . mysqli_error($conn);
        }
    } else {
        $error = "Enter a valid youtube link.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
   <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video Update</title>
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
        <h2>Updating Video</h2>
        <a href="page2.php" class="cancel-button">Cancel <span class="cancel-icon">✖</span></a>
        <form method="post">
            <label for="link">Youtube Link:</label>
            <input type="text" id="link" name="link" value="<?php echo htmlspecialchars($video['link']); ?>" required><br>
            <label for="description">Video Description:</label>
            <input type="text" id="description" name="description" value="<?php echo htmlspecialchars($video['description']); ?>" required><br>
            <button type="submit">Save</button>
        </form>
        <?php if (isset($error)) { echo "<p>$error</p>"; } ?>
    </div>
</body>
</html>
