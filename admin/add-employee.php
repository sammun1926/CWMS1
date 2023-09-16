<?php
session_start();
error_reporting(0);
include('includes/config.php');

if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {
    if (isset($_POST['add_employee'])) {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $phone_number = $_POST['phone_number'];
        // $hire_date = $_POST['hire_date'];
        // $job_title = $_POST['job_title'];
        // $salary = $_POST['salary'];
        // $address = $_POST['address'];

        // Database insertion code using prepared statement
        try {
            $dbh = new PDO("mysql:host=localhost;dbname=cwms", "admin", "Test@123");

            $sql = "INSERT INTO employees (first_name, last_name, email, phone_number, hire_date, job_title, salary, address)
                    VALUES (:first_name, :last_name, :email, :phone_number, :hire_date, :job_title, :salary, :address)";

            $stmt = $dbh->prepare($sql);

            
            $stmt->bindParam(':first_name', $first_name, PDO::PARAM_STR);
            $stmt->bindParam(':last_name', $last_name, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':phone_number', $phone_number, PDO::PARAM_STR);
            $stmt->bindParam(':hire_date', $hire_date, PDO::PARAM_STR);
            $stmt->bindParam(':job_title', $job_title, PDO::PARAM_STR);
            $stmt->bindParam(':salary', $salary, PDO::PARAM_STR);
            $stmt->bindParam(':address', $address, PDO::PARAM_STR);

            $stmt->execute();

            // Redirect to the manage-employee.php page after insertion
            header("Location: manage-employee.php");
            exit;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Add Employee</title>
    <link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link rel="stylesheet" href="css/morris.css" type="text/css"/>
<link href="css/font-awesome.css" rel="stylesheet"> 
<script src="js/jquery-2.1.4.min.js"></script>
<link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet' type='text/css'/>
<link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="css/icon-font.min.css" type='text/css' />
    <!-- Add your CSS and JavaScript includes here -->
</head>
<body>
    <div class="page-container">
        <!-- Add your header and breadcrumb code here -->
        <div class="left-content">
            <div class="mother-grid-inner">
                <!-- Include your header content here -->
            </div>
        </div>

        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard.php">Home</a><i class="fa fa-angle-right"></i>Add Employee</li>
        </ol>

        <!-- Add Employee Form -->
        <div class="grid-form">
            <div class="grid-form1">
                <h3>Add Employee</h3>
                <div class="tab-content">
                    <div class="tab-pane active" id="horizontal-form">
                        <form class="form-horizontal" name="add_employee" method="post" enctype="multipart/form-data">
                            <!-- Add your form fields here -->

                            <div class="row">
                                <div class="col-sm-8 col-sm-offset-2">
                                    <button type="submit" name="add_employee" class="btn-primary btn">Add Employee</button>
                                    <button type="reset" class="btn-inverse btn">Reset</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add your footer and JavaScript includes here -->
    </div>
</body>
</html>
