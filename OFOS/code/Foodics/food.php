<?php include('partials-front/menu.php'); ?>
    
<?php  
        $conn = mysqli_connect("localhost","root","","foodics");
    ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



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

                                    
                                    <a href="order.php?food_id=<?php echo  $id; ?>" class="btn btn-primary">Order Now</a>
                                </div>
                            </div>
                    <?php
                    }
                }
                else{
                    echo "<div class = 'error'>Food not avaliable.</div>";
                }
                ?>

            <div class="clearfix"></div>


        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->


    
    <?php include('partials-front/footer.php'); ?>