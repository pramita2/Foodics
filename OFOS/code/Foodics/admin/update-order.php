<?php include('partials/menu.php'); ?>
<div class="main-content"> 
    <h1> Update Order </h1>
    <br/> <br/>

    <?php
         $conn = mysqli_connect("localhost","root","","foodics");
         //get the id of selected admin
           if(isset($_GET['id'])){
            $id=$_GET['id'];
            // cerate sql query to get the detail
            $sql="SELECT * FROM order1 WHERE id=$id";

            //execute the query
            $res= mysqli_query($conn,$sql);
            $count = mysqli_num_rows($res);
                //check whether we have data or not
                //check whether the data is avaliable or not
                if($count==1){
                    // get the detail
                
                   $row=mysqli_fetch_assoc($res);

                   $food = $row['food'];
                   $price = $row['price'];
                   $qty = $row['qty'];
                   $status = $row['status'];
                   $username = $row['username'];
                   $contactno = $row['contactno'];
                   $email = $row['email'];
                   $address = $row['address'];
                }
                else{
               
                    header("location:http://localhost/foodics/admin/manage-order.php"); 
                }
            }
        ?>
    <form method="post" action="" >
            <table class="input-group">

                <tr>
                <td>Food name:</td>
                     <td> <b><?php echo $food; ?></b></td>
            </tr>
            <tr>
                <td> Price:</td>
                <td> <b>RS.<?php echo $price; ?></b></td>
            </tr>
            <tr>
                <td> Qty:</td>
               <td>
                <input type ="number" name = "qty" value = "<?php echo $qty; ?>">
             </td>
            </tr>
            <tr>
                <td> Status:</td>
               <td>
                 <select name= "status">
                 <option <?php if($status =="ordered"){echo "selected";} ?> value= "ordered">Ordered </option>
                  <option <?php if($status =="On delivery"){echo "selected";} ?> value= "On delivery">On delivery </option>
                  <option <?php if($status =="Delivered"){echo "selected";} ?> value= "Delivered">Delivered </option>
                  
        </select>
             </td>
            </tr>
            <tr>
                <td>
                <label> customer name:</label>
                </td><td>
                <input type="text" name="username" value="<?php echo $username; ?>">
                </td>   
            </tr>
            <tr>
                <td>
                <label> Contact:</label>
                </td><td>
                <input type="text" name="contact" value="<?php echo $contactno; ?>">
                </td>
            </tr>
            <tr>
                <td>
                <label> Email:</label>
                </td><td>
                <input type="text" name="email" value="<?php echo $email; ?>">
                </td>
            </tr>
            <tr>
                <td>
                <label>Address:</label>
                </td><td>
                    <textarea name = "address" cols= "30" rows="5" ><?php echo $address; ?> </textarea> 
                </td>
            </tr>
            <tr>
                <td >
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="hidden" name="price" value="<?php echo $price; ?>">
                <input type ="submit" name = "submit" value = "update order" class="btn-secondary" >
             </td>
            </tr>
     </table>
    </form>
        <?php
            if(isset($_POST['submit']))
            {
                $id = $_POST['id'];
                $price = $_POST['price'];
                $qty = $_POST['qty'];
                $total = $price * $qty;
                
                $status = $_POST['status'];
                $username = $row['fullname'];
                 $contactno = $row['contactno'];
                $email = $_POST['email'];
                $address = $_POST['address'];

                $sql1 = "UPDATE order1 SET qty ='$qty',total = '$total', status = '$status', username = '$username',  contactno = '$contactno',email = '$email',address = '$address'
                  WHERE id ='$id' ";
                $res1 = mysqli_query($conn, $sql1);
                 if($res1==true)
                 {
                    $_SESSION['update'] = "<div class = 'success'> Order update successfully.</div>";
                    header("location:http://localhost/foodics/admin/manage-order.php");
                }else
                {
                    $_SESSION['update'] = "<div class = 'error'> Failed to update Order.</div>";
                    header("location:http://localhost/foodics/admin/manage-order.php");
                } 
            }

        ?>


    </div>
<?php include('partials/footer.php'); ?>