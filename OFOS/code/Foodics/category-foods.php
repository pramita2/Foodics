<?php include('partials-front/menu.php'); ?>
<?php  
        $conn = mysqli_connect("localhost","root","","foodics");
?>
<?php
        if(isset($_GET['category_id']))
        {
            $category_id = $_GET['category_id'];

            $sql = "SELECT title FROM category WHERE id=$category_id ";

            $res = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($res);

            $category_title = $row['title'];

        }
        else{
            echo "Category not found.";
        }
    ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on <a href="#" class="text-white">"<?php echo $category_title; ?>" </a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            <?php
                $sql2 = "SELECT *FROM food WHERE category_id=$category_id";

                $res2 = mysqli_query($conn, $sql2);

                $count2 = mysqli_num_rows($res2);

                if($count2>0)
                {
                    while($row1 = mysqli_fetch_assoc($res2))
                    {
                        $id = $row1['id'];
                        $name = $row1['name'];
                        $detail = $row1['detail'];
                        $price = $row1['price'];
                        $imgname = $row1['imgname'];

                        ?>
                         <div class="food-menu-box">
                          <div class="food-menu-img">

                            <?php
                                if($imgname=="")
                                {
                                    echo "<div class='error'> Image not avaliable.</div>";
                                }else
                                {
                                    ?>
                                            <img src="./images/food/<?php echo $imgname; ?>"  alt="" class="img-responsive img-curve">
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
                                    <br><br>      
                                  
                                </div>
                            </div>


                        <?php
                    }
                }
                else{
                    echo "<div class= 'error'> Food not Avaliable.</div>";
                }

            ?>


            <div class="clearfix"></div>
        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

  
    <?php include('partials-front/footer.php'); ?>