<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: page1.php');
    exit();
}

include('db.php');

$query = "SELECT * FROM video WHERE is_deleted=0";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video Management</title>
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
    <table border="1">
        <tr>
            <th>Thumbnail</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><img src="https://img.youtube.com/vi/<?php echo htmlspecialchars($row['link']); ?>/default.jpg" alt="Thumbnail" onclick="window.open('https://www.youtube.com/watch?v=<?php echo htmlspecialchars($row['link']); ?>', '_blank')"></td>
                <td><?php echo htmlspecialchars($row['description']); ?></td>
                <td>
                    <button onclick="window.location.href='page4.php?id=<?php echo $row['id']; ?>'">Update</button>
                    <button class="delete-btn" data-id="<?php echo $row['id']; ?>">Delete</button>
                </td>
            </tr>
        <?php } ?>
    </table>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="page2.js"></script>
</body>
</html>

