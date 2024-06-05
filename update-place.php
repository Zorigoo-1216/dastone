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
        <meta charset="utf-8" />
        <title>Dastone - Admin & Dashboard Template</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">
        <!-- jvectormap -->
        <link href="plugins/jvectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet">
        <!-- App css -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/metismenu.min.css" rel="stylesheet" type="text/css" />
        <link href="plugins/daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/form.place.css" rel="stylesheet" type="text/css" />
    </head>

    <body class="">
        <!-- Left Sidenav -->
        <div class="left-sidenav">
            <!-- LOGO -->
            <div class="brand">
                <a href="index.php" class="logo">
                    <span>
                        <img src="assets/images/logo-sm.png" alt="logo-small" class="logo-sm">
                    </span>
                    <span>
                        <img src="assets/images/logo.png" alt="logo-large" class="logo-lg logo-light">
                        <img src="assets/images/logo-dark.png" alt="logo-large" class="logo-lg logo-dark">
                    </span>
                </a>
            </div>
            <!--end logo-->
            <div class="menu-content h-100" data-simplebar>
                <ul class="metismenu left-sidenav-menu">
                    <li>
                        <a href="javascript: void(0);"> <i data-feather="work" class="align-self-center menu-icon"></i><span>Хүний нөөц</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li class="nav-item"><a class="nav-link" href="place.php"><i class="ti-control-record"></i>Газар нэгж</a></li>
                            <li class="nav-item"><a class="nav-link" href="#.php"><i class="ti-control-record"></i>Албан тушаал</a></li> 
                            <li class="nav-item"><a class="nav-link" href="#.php"><i class="ti-control-record"></i>Ажилтны бүртгэл</a></li> 
                        </ul>
                    </li>
                    <hr class="hr-dashed hr-menu">                           
                </ul>
            </div>
        </div>
        <!-- end left-sidenav-->
        
        <div class="page-wrapper">
            <!-- Top Bar Start -->
            <div class="topbar">            
                <!-- Navbar -->
                <nav class="navbar-custom">   
                    <ul class="list-unstyled topbar-nav mb-0">                        
                        <h4 class="page-title" style="margin: 10px; ">Газар нэгжийн бүртгэл</h4>
                            <button class=" btn btn-sm btn-soft-primary" onclick="showForm()" style="margin: 10px; margin-top: 30px;">+ Шинээр бүртгэх</button>
                                <!-- Form container -->
                                <div class="form-container-update" style='position: absolute; top: 100px; left: 100px; z-index: 1; background-color: white' id="formContainerUpdate">
                                <form method="POST">
                                    <label for="unitName" class="form-check-label">Газар нэгжийн нэршил:</label>
                                    <input type="text" id="unitName" name="unitName" class="form-check-input" value="<?php echo $row['UnitName']; ?>" required><br>
                                    
                                    <label for="status" class="form-check-label">Төлөв:</label>
                                    <select id="status" name="status" required>
                                        <option value="Идэвхитэй" <?php if ($row['Status'] == 'Идэвхитэй') echo 'selected'; ?>>Идэвхитэй</option>
                                        <option value="Идэвхгүй" <?php if ($row['Status'] == 'Идэвхгүй') echo 'selected'; ?>>Идэвхгүй</option>
                                    </select><br>

                                    <label for="order" class="form-check-label">Эрэмбэ:</label>
                                    <input type="text" class="form-check-input"  id="order" name="order" value="<?php echo $row['Order']; ?>"><br>

                                    <label class="form-check-label" for="parentUnit">Эцэг газар нэгж:</label>
                                    <select id="parentUnit" name="parentUnit" required>
                                        <option value="Төлөвлөлт удирдах зөвлөл-1" <?php if ($row['ParentUnit'] == 'Төлөвлөлт удирдах зөвлөл-1') echo 'selected'; ?>>Төлөвлөлт удирдах зөвлөл-1</option>
                                        <option value="Төлөвлөлт удирдах зөвлөл-2" <?php if ($row['ParentUnit'] == 'Төлөвлөлт удирдах зөвлөл-2') echo 'selected'; ?>>Төлөвлөлт удирдах зөвлөл-2</option>
                                    </select><br>

                                    <label class="form-check-label" for="director">Захирал:</label>
                                    <select id="director" name="director" required>
                                        <option value="-" <?php if ($row['Director'] == '-') echo 'selected'; ?>>[Сонгоно уу]</option>
                                        <option value="Захирал" <?php if ($row['Director'] == 'Захирал') echo 'selected'; ?>>Захирал</option>
                                    </select><br>

                                    <button class="btn btn-primary" type="submit">Засах</button>
                                    <button class="btn btn-danger" href="place.php">Буцах</button>
                                </form>
                                </div>  
                              
                                <?php
                                    include 'db_conn.php'; // Include the database connection file

                                        // Select query to retrieve data from the 'place' table
                                    $sql = "SELECT * FROM place";

                                        // Execute the query
                                    $result = mysqli_query($conn, $sql);

                                        // Check if there are any rows returned
                                    if (mysqli_num_rows($result) > 0) {
                                            // Output data of each row in a table
                                            echo"<div class='card-body'>";
                                            echo"<div class='table-rep-plugin'>";
                                            echo"<div class='table-responsive mb-0' data-pattern='priority-columns'>";
                                        echo "<table id='tech-companies-1' class='table table-striped mb-0'>
                                                <thead>        
                                                <tr>
                                                    <th>Нэр</th>
                                                    <th>Захирал</th>
                                                    <th>Төлөв</th>
                                                    <th>Эрэмбэ</th>
                                                    <th>Зассан</th>
                                                    <th>Үйлдэл</th>
                                                </tr>
                                                </thead>";
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    echo "<tbody>
                                                        <tr>
                                                            <th><span class='co-name'>".$row["UnitName"]."</span></th>
                                                            <th>".$row["Director"]."</th>
                                                            <th>".$row["Status"]."</th>
                                                            <th>".$row["Order"]."</th>
                                                            <th>".$row["Date"]."</th>
                                                            <th>
                                                            <a class='btn btn-success' href='update-place.php?id=".$row["id"]."'>Засах</a> 
                                                            <a class='btn btn-danger' href='delete-place.php?id=".$row["id"]."' onclick='return confirm(\"Та үнэхээр УСТГАХ уу?\")'>Устгах</a>
                                                            </th>
                                                        </tr>
                                                    </tbody>";
                                                }
                                        echo "</table>";
                                        echo "</div>";

                                        echo "</div>";
                                        echo "</div>";
                                    } else {
                                        echo "0 results";
                                    }

                                    // Free result set
                                    mysqli_free_result($result);

                                    // Close connection
                                    mysqli_close($conn);
                                ?>                  
                    </ul>
                </nav>
                <!-- end navbar-->
            </div>
            <!-- Top Bar End -->
        </div>
        <!-- end page-wrapper -->

        <!-- jQuery  -->
        <script src="assets/js/form.place.js"></script>
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/metismenu.min.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/feather.min.js"></script>
        <script src="assets/js/simplebar.min.js"></script>
        <script src="assets/js/moment.js"></script>
        <script src="plugins/daterangepicker/daterangepicker.js"></script>
        <script src="plugins/apex-charts/apexcharts.min.js"></script>
        <script src="plugins/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>
        <script src="plugins/jvectormap/jquery-jvectormap-us-aea-en.js"></script>
        <script src="assets/pages/jquery.analytics_dashboard.init.js"></script>

        <!-- App js -->
        <script src="assets/js/app.js"></script>   
    </body>
</html>