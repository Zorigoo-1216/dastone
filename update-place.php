<?php
include 'db_conn.php'; 

$id = $_GET['id'];

// Fetch the current details of the place
$sql = "SELECT * FROM place WHERE id='$id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $unitName = $_POST['unitName'];
    $status = $_POST['status'];
    $order = $_POST['order'];
    $parentUnit = $_POST['parentUnit'];
    $director = $_POST['director'];
    $date = date('Y-m-d');

    // Update query
    $sql = "UPDATE place SET UnitName='$unitName', Status='$status', `Order`='$order', ParentUnit='$parentUnit', Director='$director', Date='$date' WHERE id='$id'";

    if (mysqli_query($conn, $sql)) {
        header("Location: place.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Place</title>
</head>
<body>
    <h2>Update Place</h2>
    <form method="POST">
        <label for="unitName">Газар нэгжийн нэршил:</label>
        <input type="text" id="unitName" name="unitName" value="<?php echo $row['UnitName']; ?>" required><br>
        
        <label for="status">Төлөв:</label>
        <select id="status" name="status" required>
            <option value="Идэвхитэй" <?php if ($row['Status'] == 'Идэвхитэй') echo 'selected'; ?>>Идэвхитэй</option>
            <option value="Идэвхгүй" <?php if ($row['Status'] == 'Идэвхгүй') echo 'selected'; ?>>Идэвхгүй</option>
        </select><br>

        <label for="order">Эрэмбэ:</label>
        <input type="text" id="order" name="order" value="<?php echo $row['Order']; ?>"><br>

        <label for="parentUnit">Эцэг газар нэгж:</label>
        <select id="parentUnit" name="parentUnit" required>
            <option value="Төлөвлөлт удирдах зөвлөл-1" <?php if ($row['ParentUnit'] == 'Төлөвлөлт удирдах зөвлөл-1') echo 'selected'; ?>>Төлөвлөлт удирдах зөвлөл-1</option>
            <option value="Төлөвлөлт удирдах зөвлөл-2" <?php if ($row['ParentUnit'] == 'Төлөвлөлт удирдах зөвлөл-2') echo 'selected'; ?>>Төлөвлөлт удирдах зөвлөл-2</option>
        </select><br>

        <label for="director">Захирал:</label>
        <select id="director" name="director" required>
            <option value="-" <?php if ($row['Director'] == '-') echo 'selected'; ?>>[Сонгоно уу]</option>
            <option value="Захирал" <?php if ($row['Director'] == 'Захирал') echo 'selected'; ?>>Захирал</option>
        </select><br>

        <button type="submit">Update</button>
    </form>
    <a href="place.php">Back to Place List</a>
</body>
</html>