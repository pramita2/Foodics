
<?php $conn = mysqli_connect("localhost","root","","foodics");  ?>
<?php 
session_start();
include('partials-front/menu.php');

$username = $_SESSION['username'];
$sq = "SELECT * FROM userinfo WHERE username = '$username' ";
$res1 = mysqli_query($conn, $sq);
$row = mysqli_fetch_assoc($res1);
$contactno = $row['contactno'];
$email = $row['email'];
?>

<?php
      
        if(isset($_GET['food_id']))
        {
            $food_id = $_GET['food_id'];

            $sql = "SELECT * FROM food WHERE id=$food_id";

            $res = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($res);
            $name = $row['name'];
            $price = $row['price'];
            $imgname = $row['imgname'];
        }
?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form  method="POST" action=" " class="order" enctype="multipart/form-data">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                        <?php

                         if($imgname== "") 
                         {
                             echo "<div class = 'error'> failed to upload image.</div>";
                         }
                     else{
                         ?>
                          <img src="./images/food/<?php echo $row['imgname']; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                          <?php
                      }    
                ?>
                         
                        
                    </div>
    
                    <div class="food-menu-desc">
                       <h4><?php echo $name; ?></h4>
                        <input type="hidden"  value="food" >

                        <p class="food-price">RS.<?php echo $price; ?></p>
                        <input type="hidden"  value="price">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>
      
                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="" class="input-responsive" required></textarea>
                   
                    <a href="" onclick="showMessage()" class="btn btn-primary"> 
                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary"></a>
                     <script type="text/javascript">
                         function showMessage() {
                                 alert("Food ordered successfilly.");
                                  }
                       </script>
                </fieldset>

            </form>
            <?php
        
         
                //if(isset($_POST['submit']))
                if(!empty($_POST))
                {
        
                    $qty = $_POST['qty'];
                    //$total = $price * $qty;
                    $status = "ordered"; //Ordered, od Delivery, Delivery, Cancelled
                    $total = $qty * $price;
                    $customer_address = $_POST['address'];
                    
                    //save the order into database
                    $r =  mysqli_query($conn, "insert into order1 (food,price,qty,status,total,username,contactno,email,address)
		            values ('$name','$price','$qty','$status','$total','$username','$contactno','$email','$customer_address')");
                    if ($r)
                    {
                        $_SESSION['order'] = 'yes';
                      
                        header("Location:index.php");
                    } else{
                        echo("Error description: " . mysqli_error($conn));
                    }
                }
            ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>