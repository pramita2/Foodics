<?php include('partials-front/menu.php'); ?>

<?php  
        $conn = mysqli_connect("localhost","root","","foodics");
    ?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php
                $sql = "SELECT *FROM category WHERE active ='yes'";

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
                           <a href="category-foods.php?category_id=<?php echo $id ;?>">
                                <div class="box-3 float-container">

                                    <?php
                                        if($imgname =="")
                                        {
                                            echo "<div class='error'> Image not found.</div>";
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
                    echo "<div class='error'> Category not found.</div>";
                }
            ?>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->



    
    <?php include('partials-front/footer.php'); ?>