<?php
header('Content-Type: application/json');
include('db.php');

try {
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM video WHERE is_deleted=0";
    $result = $conn->query($sql);

    $result_array = [];
    while ($row = $result->fetch_assoc()) {
        $result_array[] = $row;
    }

    error_log('Fetched Result: ' . json_encode($result_array));
    echo json_encode($result_array);

    $conn->close();
} catch (Exception $e) {
    error_log('Exception: ' . $e->getMessage());
    echo json_encode(['error' => 'An error occurred']);
}
?>

