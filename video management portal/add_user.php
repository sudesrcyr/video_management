<?php
include('db.php');

$username = 'sude';
$password = '123456';

$username = 'mzg';
$password = '1905';

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$query = "UPDATE admin SET password = '$hashed_password' WHERE username = '$username'";
if (mysqli_query($conn, $query)) {
    echo "The user updated successfully..";
} else {
    echo "An error occurred while updating the user." . mysqli_error($conn);
}
?>
