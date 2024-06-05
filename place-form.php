<?php
include 'db_conn.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $unitName = $_POST['unitName'];
    $status = $_POST['status'];
    $order = $_POST['order'];
    $parentUnit = $_POST['parentUnit'];
    $director = $_POST['director'];
    $date = date('Y-m-d');

    $sql = "INSERT INTO place (UnitName, Status, `Order`, ParentUnit, Director, Date) VALUES ('$unitName', '$status', '$order', '$parentUnit', '$director', '$date')";

    if (mysqli_query($conn, $sql)) {
        header("Location: http://localhost:8000/place.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>
