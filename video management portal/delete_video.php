<?php
session_start();

if (!isset($_SESSION['username'])) {
    echo "Unauthorized access!";
    exit();
}

include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    var_dump($_POST); 
    if (isset($_POST['id']) && !empty($_POST['id'])) {
        $id = intval($_POST['id']); 

        $sql = "UPDATE video SET is_deleted=1 WHERE id=$id";
        
        if ($conn->query($sql) === TRUE) {
            echo "Video deleted successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "ID is not set or empty.";
    }
}
?>




