<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foodics</title>

    <!-- Link our CSS file -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- Navbar Section Starts Here -->
    <section class="navbar">
        <div class="container">
            <div class="logo">
                <a href="#" title="Logo">
                    <img src="images/logo.png" alt="Restaurant Logo" class="img-responsive">
                </a>
            </div>
           

            <div class="menu text-right">
                <ul>
                    <li>
                    <a href="" onclick="showMessage()" >Home</a>
                                    <script type="text/javascript">
                                        function showMessage() {
                                        alert("you are not logged in");
                                         }
                                    </script> 
                    </li>
                    <li>
                    <a href="" onclick="showMessage()" >Categories</a>
                                    <script type="text/javascript">
                                        function showMessage() {
                                        alert("you are not logged in");
                                         }
                                    </script>
                    </li>
                    <li>
                    <a href="" onclick="showMessage()">Food</a>
                                    <script type="text/javascript">
                                        function showMessage() {
                                        alert("you are not logged in");
                                         }
                                    </script>
                    </li>
                    <li>
                    <a href="" onclick="showMessage()" >Contact</a>
                                    <script type="text/javascript">
                                        function showMessage() {
                                        alert("you are not logged in");
                                         }
                                    </script>
                    </li>
                    <li>
                        <a href="login.php" >Login</a>
                    </li>
                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Navbar Section Ends Here -->

    <?php  
        $conn = mysqli_connect("localhost","root","","foodics");
       
    ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="food-search.php" method="POST" enctype="multipart/form-data">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>
            </div>
           
     
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

   

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>


            <?php 
                //create sql query to display category from database
                $sql = "SELECT * FROM category WHERE active = 'yes' AND featured= 'yes' ";

                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);

                if($count>0)
                {
                    while($row = mysqli_fetch_assoc($res))
                    {
                        $id = $row['id'];
                        $title = $row['title'];
                        $imgname = $row['imgname'];
                        ?>
                            
                            <a href="category_id=<?php echo $id ;?>" onclick="showMessage()"></a>
                                    <script type="text/javascript">
                                        function showMessage() {
                                        alert("you are not logged in");
                                         }
                                    </script>
                                <div class="box-3 float-container">
                                    <?php
                                        
                                        if($imgname== "") 
                                            {
                                                echo "<div class = 'error'> failed to upload image.</div>";
                                            }
                                        else{
                                            ?>
                                             <img src="./images/category/<?php echo $row['imgname']; ?>"  alt="" class="img-responsive img-curve">
                                             <?php
                                         }    
                                   ?>
                                  <h3 class="float-text text-white"><?php echo $title; ?></h3>
                                </div>
                            </a>
                    <?php
                    }
                }
                else{
                    echo "<div class = 'error'>Category not added.</div>";
                }
                ?>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
                $sql1 = "SELECT * FROM food WHERE active='yes' AND featured ='yes'";

                $res1 = mysqli_query($conn, $sql1);
                $count1 = mysqli_num_rows($res1);

                if($count1>0)
                {
                    while($row = mysqli_fetch_assoc($res1))
                    {
                        $id = $row['id'];
                        $name = $row['name'];
                        $detail = $row['detail'];
                        $price = $row['price'];
                        $imgname = $row['imgname'];
                        ?>
                            <div class="food-menu-box">
                                <div class="food-menu-img">
                                    <?php
                                         if($imgname== "") 
                                           {
                                               echo "<div class = 'error'> failed to upload image.</div>";
                                            }
                                         else{
                                             ?>
                                                <img src="./images/food/<?php echo $row['imgname']; ?>"  alt="" class="img-responsive img-curve">
                                            <?php
                                          } 
                                    ?>
                                   
                                </div>

                                <div class="food-menu-desc">
                                    <h4><?php echo $name; ?></h4>
                                    <p class="food-price">RS.<?php echo $price; ?></p>
                                    <p class="food-detail">
                                        <?php echo $detail; ?>
                                    </p>
                                    <br>

                                    <a href="" onclick="showMessage()" class="btn btn-primary">Order Now</a>
                                    <script type="text/javascript">
                                        function showMessage() {
                                        alert("you are not logged in");
                                         }
                                    </script>
                                </div>
                            </div>
                                </div>
                            </a>
                    <?php
                    }
                }
                else{
                    echo "<div class = 'error'>Food not avaliable.</div>";
                }
                ?>

            <div class="clearfix"></div>

            

        </div>

        <p class="text-center">
            <a href="#">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->
    

   
    <?php include('partials-front/footer.php'); ?>