<?php
include 'db_conn.php';

$id = $_GET['id'];

// Delete query
$sql = "DELETE FROM place WHERE id='$id'";

if (mysqli_query($conn, $sql)) {
    header("Location: place.php");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
?>