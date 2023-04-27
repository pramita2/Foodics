
<?php
         $conn = mysqli_connect("localhost","root","","foodics");
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
        <li><a href="login.php">Login</a></li>
        
</ul> 
    
</div>
    <!--Menu Section End -->
   
     <!--Main Section Sart -->
     <div class="main-content">
       <h1>Dashboard </h1>
                
        <br > <br>

       <div class="col-4 text-center">
        <?php
            $sql ="SELECT * FROM category";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
        ?>
           <h1><?php echo $count; ?></h1>
           <br />
           Categories
</div>
<div class="col-4 text-center">
        <?php
            $sql1 ="SELECT * FROM food";
            $res1 = mysqli_query($conn, $sql1);
            $count1 = mysqli_num_rows($res1);
        ?>
           <h1><?php echo $count1; ?></h1>
           <br />
           Foods
</div>
<div class="col-4 text-center">
        <?php
            $sql2 ="SELECT * FROM order1";
            $res2 = mysqli_query($conn, $sql2);
            $count2 = mysqli_num_rows($res2);
        ?>
           <h1><?php echo $count2; ?></h1>
           <br />
           Total orders
</div>
<div class="col-4 text-center">
     <?php
     //aggregate function in sql
            $sql3 ="SELECT SUM(total) AS Total FROM order1 WHERE status='Delivered'";
            $res3 = mysqli_query($conn, $sql3);
            $row3 = mysqli_fetch_assoc($res3);
           
            //create total revenue
            $total_revenue = $row3['Total'];
        ?>
           <h1><?php echo $total_revenue; ?></h1>
           <br />
           Revenue Generated
</div>
<div class="clearfix"></div>

</div>
    <!--Main Section End -->



    <?php include('partials/footer.php'); ?>