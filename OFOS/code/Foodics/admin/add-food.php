<?php include('partials/menu.php'); ?>

<div class="main-content">
<h1 class="text-center">Add Food </h1>
<br > <br >
<?php
                      
      $conn = mysqli_connect("localhost","root","","foodics");
       ?>

    <?php
        if(isset($_SESSION['upload']))
        {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
    ?>
     <br >
    <form method="post" action="" enctype="multipart/form-data">
          <table class="input-group">

            <tr>
                <td>
                <label> Name:</label>
                </td><td>
                <input type="text" name="name" value="" placeholder="Food name">
                </td>
            </tr>
            <tr>
                <td>
                <label>Detail:</label>
                </td><td>
                    <textarea name = "detail" cols= "30" rows="5" placeholder="description of the food"></textarea> 
                </td>
            </tr>
            
            <tr>
                <td>
                <label> Price:</label>
                </td><td>
                <input type="number" name="price" >     
                </td>
            </tr>
            <tr>
            <td>
                <label>Select Image:</label>
                </td><td>
                <input type="file" name="image">
                </td>
                </tr>
             <tr>
                <td>
                <label>Category:</label>
                </td><td>
                <select name="category" >
                <?php
                      
                        //display category from database
                        //1.active category
                        $sql = "SELECT* FROM category WHERE active='yes'";

                        $res = mysqli_query($conn, $sql);

                        $count = mysqli_num_rows($res);
                        if($count>0)
                        {
                            while($row= mysqli_fetch_assoc($res)){
                                $id = $row['id'];
                                $title = $row['title'];
                                ?>
                                    <option value="<?php echo $id ?>" ><?php echo $title; ?></option>
                                <?php
                            }
                        }else
                        {
                            ?>
                                <option value="1" >No category Found</option>
                            <?php
                        }
                        //2.display on dropdown
                    ?>
                </select>

                </td>
                </tr>
                <tr>
                 <td>
                    <label>Featured:</label>
                    </td><td>
                    <input type="radio" name="featured" value="yes">yes    
                        
                    <input type="radio" name="featured" value="no">No   
                    </td>
                </tr>
                <tr>
                    <td>
                    <label>Active:</label>
                    </td><td>
                    <input type="radio" name="active" value="yes" >yes
                    <input type="radio" name="active" value="no" >no
                    </td>
              </tr>
            <tr>
                <td colspan="2">
                 <button type="submit" class="btn-secondary" name="submit">Add Food</button>
            </td>
            </tr>

        </table>
    </form>
    <?php
        
         require_once "conn.php";
         $conn=connection();
     
         
         if(!empty($_POST)){
     
             $name= mysqli_real_escape_string($conn, $_POST['name']);
             $detail = mysqli_real_escape_string($conn, $_POST['detail']);
             $price = mysqli_real_escape_string($conn, $_POST['price']);
             $category = mysqli_real_escape_string($conn, $_POST['category']);
      
         
            
             //for radio input
     
             if(isset($_POST['featured'])){
                 $featured = $_POST['featured'];
             }else{
                 $featured = "no";
             }
     
             if(isset($_POST['active'])){
                 $active = $_POST['active']; 
             }else{
                 $active = "no";
             }
     
             //print_r($_FILES['image']);
     
             //die();
             if(isset($_FILES['image']['name'])){
                     //img name upload need source path and destination
                     $imgname = $_FILES['image']['name'];
                     
                     if($imgname != "") 
                     {
                             //Auto rename the image
                         $ext = end(explode('.',$imgname));
                         $imgname = "food_name_" .rand(000, 999).'.'.$ext;
     
                         $source_path = $_FILES['image']['tmp_name'];
                         $destination_path = "../images/food/".$imgname;
     
                         $upload = move_uploaded_file($source_path, $destination_path);
     
                         //check whether the image is uploaded or not
                         if($upload==FALSE)
                         {
                             $_SESSION['upload'] = "<div class = 'error'> failed to upload image.</div>";
                             header("location:http://localhost/foodics/admin/add-food.php");
     
                             die();
                         }
                     }
                 }    
     
             else{
                     $imgname="";
             }
             $sql1="INSERT INTO food(name,detail,price,imgname,category_id,featured,active) values('$name','$detail',$price,'$imgname','$category','$featured','$active')";
             if ($conn->query($sql1) === TRUE) {
         
                 //create a session variable to display massege
                 $_SESSION['add'] =  "<div class='success'> Food added successfully.</div>";
                 header("location:http://localhost/foodics/admin/manage-food.php");
             } else {
               
                   //create a session variable to display massege
                   $_SESSION['add'] = "<div class='error'>  Failed to add food.</div>";
                   header("location:http://localhost/foodics/admin/manage-food.php"); 
             }
       }
     
      
      ?>
</div>
<?php include('partials/footer.php'); ?>