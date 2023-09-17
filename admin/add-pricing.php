<?php
session_start();
error_reporting(0);
include('includes/config.php'); // Include your database connection file

if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {
    if (isset($_POST['add_pricing'])) {
        $service_name = $_POST['service_name'];
        $price = $_POST['price'];

        // Database insertion code using prepared statement
        try {
            $dbh = new PDO("mysql:host=localhost;dbname=your_database", "your_username", "your_password");

            $sql = "INSERT INTO pricing (service_name, price) VALUES (:service_name, :price)";

            $stmt = $dbh->prepare($sql);

            // Bind parameters
            $stmt->bindParam(':service_name', $service_name, PDO::PARAM_STR);
            $stmt->bindParam(':price', $price, PDO::PARAM_STR);

            $stmt->execute();

            // Redirect to manage-pricing.php after insertion
            header("Location: manage-pricing.php");
            exit();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Add Pricing</title>
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
    <!-- Add your HTML form for adding pricing information here -->
    <form method="post">
        <label for="service_name">Service Name:</label>
        <input type="text" name="service_name" required>
        
        <label for="price">Price:</label>
        <input type="number" name="price" step="0.01" required>
        
        <button type="submit" name="add_pricing">Add Pricing</button>
    </form>
</body>
</html>
