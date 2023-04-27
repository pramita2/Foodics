<?php
session_start();
if (!isset($_SESSION['log'])) {
    header('location:admin.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foodics-Admin page</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
    <!--Menu Section Sart -->
    <div class="menu text-center">
        
    <ul>
         <li><a href="admin.php">Home</a></li>
         <li><a href="manage-admin.php">Admin</a></li>
        <li><a href="manage-category.php">Category</a></li>
        <li><a href="manage-food.php">Food</a></li>
        <li><a href="manage-order.php">Order</a></li>
        <li><a href="logout.php">Logout</a></li>
        
</ul> 
    
</div>