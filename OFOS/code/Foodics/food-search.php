<?php include('partials-front/menu.php'); ?>
<?php  
        $conn = mysqli_connect("localhost","root","","foodics");
    ?>
    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            <?php
                  $search = $_POST['search'];
            ?>
            
            <h2>Foods on Your Search <a href="#" class="text-white">"<?php echo $search; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
              

                $sql = "SELECT * FROM food WHERE name LIKE '%$search%' OR detail LIKE '%$search%'";

                $res = mysqli_query($conn, $sql);

                $count = mysqli_num_rows($res);

                if($count>0)
                    {
                        while($row = mysqli_fetch_assoc($res))
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
                                                echo "<div class='error'> Image not avaliable</div>";
                                            }
                                            else{
                                                ?>
                                                       <img src="./images/food/<?php echo $row['imgname']; ?>"  alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                                <?php
                                            }                                                                                             
                                        ?>
                                    </div>

                                    <div class="food-menu-desc">
                                        <h4><?php echo $name; ?></h4>
                                        <p class="food-price">R.S.<?php echo $price; ?></p>
                                        <p class="food-detail">
                                            <?php echo $detail; ?>
                                        </p>
                                        <br>

                                        <a href="#" class="btn btn-primary">Order Now</a>
                                    </div>
                                </div>
                       <?php

                        }

                    }
                    else{
                        echo "<div class= 'error'> Food not found</div>";
                    }
            ?>



            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    

     
    <?php include('partials-front/footer.php'); ?>