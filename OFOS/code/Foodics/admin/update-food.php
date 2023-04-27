<?php include('partials/menu.php'); ?>

<div class="main-content"> 
    <h1>Update Food</h1>
    <br/> <br/>

   
    <?php
    ob_start();
      require_once "conn.php";
      $conn=connection();

      if(isset($_GET['id']))
      {
          //echo "getting the data";
          $id = $_GET['id'];
          $sql1 = "SELECT * FROM food WHERE id=$id";

          $res1 = mysqli_query($conn, $sql1);

         // $count = mysqli_num_rows($res1);
          //if($count==1)
        
              $row1 = mysqli_fetch_assoc($res1);

              $name = $row1['name'];
              $detail= $row1['detail'];
              $price= $row1['price'];
              $currentimage = $row1['imgname'];
              $currentcategory = $row1['category_id'];
              $featured = $row1['featured'];
              $active = $row1['active'];
          
                }else
                    {
                        header("location:http://localhost/foodics/admin/manage-food.php");
                        ob_end_flush();
                    }
              ?>
    
  
    <form action="" method="POST" enctype="multipart/form-data">

            <table class="input-group">

            <tr>
                <td>
                <label> Name:</label>
                </td><td>
                <input type="text" name="name" value="<?php echo $name; ?>" placeholder="Food name">
                </td>
            </tr>
            <tr>
                <td>
                <label>Detail:</label>
                </td><td>
                    <textarea name = "detail" cols= "30" rows="5" value="<?php echo $detail; ?>" ></textarea> 
                </td>
            </tr>
            
            <tr>
                <td>
                <label> Price:</label>
                </td><td>
                <input type="number" name="price" value="<?php echo $price; ?>" >     
                </td>
            </tr>
            <tr>
                    <td>
                    <label>current Image:</label>
                        </td>
                        <td>
                           <?php
                            if( $currentimage != "")
                            {
                                ?>
                                     <img src="../images/food/<?php echo $currentimage;?>" width="100px">
                                <?php
                            }else
                            {
                                echo "<div class='error' >Image not added.</div>";
                            }
                           ?>
                    </td>
                </tr>
                <tr>
                <td>
                    <label>New Image:</label>
                    </td>
                        <td>
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
                                $category_id = $row['id'];
                                $category_title = $row['title'];
                               
                                  // echo  "<option value=' $category_id'> $category_title</option>";
                                  ?>
                                  <option <?php if($currentcategory== $category_id) {echo "selected";} ?>value="<?php echo $category_id ?>" ><?php echo $category_title; ?></option>
                              <?php
                            }
                        }else
                        {
                            
                               echo "<option value='1' >No category Avaliable.</option>";
                            
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
                    <input <?php if($featured=="yes") {echo "checked";}?> type="radio" name="featured" value="yes">yes    
                    <input  <?php if($featured=="no") {echo "checked";} ?> type="radio" name="featured" value="no">No      
                    </td>
                </tr>
                <tr>
                    <td>
                    <label>Active:</label>
                    </td><td>
                    <input  <?php if($active=="yes") {echo "checked";} ?> type="radio" name="active" value="yes" >yes
                    <input <?php if($active=="no") {echo "checked";} ?> type="radio" name="active" value="no" >no
                    </td>
              </tr>
            <tr>
                    <td>
                      <input type ="hidden" name = "currentimage" value="<?php echo $currentimage;?>">
                      <input type ="hidden" name = "id" value ="<?php echo $id;?>">
                      <button type="submit" class="btn-secondary" name="submit">Update</button>
                   </td>
                </tr>

    </table>
    </form>

      <?php
        if(isset($_POST['submit']))
        {
           // echo " c";
           $id = $_POST['id'];
           $name = $_POST['name'];
           $detail = $_POST['detail'];
           $price = $_POST['price'];
           $currentimage = $_POST['currentimage'];
           $category = $_POST['category'];
           $featured= $_POST['featured'];
           $active = $_POST['active'];

            if(isset($_FILES['image']['name'])){
            
                $imgname = $_FILES['image']['name'];

                if($imgname !="")
                {
                    //upload the new image and delete current image
                    $ext = explode('.', $imgname);
                    $file_extension = end($ext);
                    //$imgname = "food_category_" .rand(000, 999).'.'.$ext;
    
                    $source_path = $_FILES['image']['tmp_name'];
                    $destination_path = "../images/food/".$imgname;
    
                    $upload = move_uploaded_file($source_path, $destination_path);
    
                    //check whether the image is uploaded or not
                    if($upload==FALSE)
                    {
                        $_SESSION['upload'] = "<div class = 'error'> failed to upload image.</div>";
                        header("location:http://localhost/foodics/admin/manage-food.php");
    
                        die();
                    }
                    if($currentimage!="")
                    {
                        $remove_path = "../images/food/".$currentimage;
                        $remove = unlink( $remove_path);

                        //check
                        if($remove ==FALSE)
                        {
                            $_SESSION['failed-remove'] = "<div class='error'>Failed to remove the current image</div>";
                            header("location:http://localhost/foodics/admin/manage-food.php");
                            die();
                        }
                    }  
                }
                else{
                    $imgname = $currentimage;
                }
            }else
            {
                $imgname = $currentimage;
                    }
                    $r = "UPDATE food SET name = '$name',detail = '$detail',price= $price, imgname= '$imgname', category_id= '$category',featured = '$featured', active= '$active' WHERE id ='$id' ";
                        $result = mysqli_query($conn, $r);

                if($result==TRUE)
                {
                    $_SESSION['update'] = "<div class = 'success'> food update successfully.</div>";
                   // header("location:http://localhost/foodics/admin/manage-food.php");
                   header("Location:manage-food.php");
                   ob_end_flush();
                }else
                {
                    $_SESSION['update'] = "<div class = 'error'> Failed to update food.</div>";
                    header("location:http://localhost/foodics/admin/manage-food.php");
                } 
            }
   
            
         ?>
    </div>

<?php include('partials/footer.php'); ?>