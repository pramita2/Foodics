<?php include('partials/menu.php'); ?>

<div class="main-content"> 
    <h1> Update Category</h1>
    <br/> <br/>

    <?php
      require_once "conn.php";
      $conn=connection();
      
        if(isset($_GET['id']))
        {
            //echo "getting the data";
            $id = $_GET['id'];
            $sql = "SELECT *FROM category WHERE id=$id";

            $res = mysqli_query($conn, $sql);

            $count = mysqli_num_rows($res);
            if($count==1)
            {
                $row = mysqli_fetch_assoc($res);
                $title = $row['title'];
                $currentimage = $row['imgname'];
                $featured = $row['featured'];
                $active = $row['active'];
            }else{
                $_SESSION['no-category-found'] = "<div class = 'error'> Category not found.</div>";
                header("location:http://localhost/foodics/admin/manage-category.php");
            }
        }else
        {
            header("location:http://localhost/foodics/admin/manage-category.php");
        }
    
    ?>
    <form action="" method="POST" enctype="multipart/form-data">

            <table class="input-group">

                <tr>
                    <td>
                    <label>Title:</label>
                    </td>
                    <td>
                    <input type="text" name="title" value="<?php echo $title; ?>">
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
                                     <img src="../images/category/<?php echo $currentimage;?>" width="100px">
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
                    <label>Featured:</label>
                    </td>
                    <td>
                    <input <?php if($featured=="yes") {echo "checked";}?> type="radio" name="featured" value="yes">yes    
                    <input  <?php if($featured=="no") {echo "checked";} ?> type="radio" name="featured" value="no">No   
                    </td>
                </tr>
                <tr>
                    <td>
                    <label>Active:</label>
                    </td>
                    <td>
                    <input  <?php if($active=="yes") {echo "checked";} ?> type="radio" name="active" value="yes" >yes
                    <input <?php if($active=="no") {echo "checked";} ?> type="radio" name="active" value="no" >no
                    </td>
                </tr>
                <tr>
                    <td>
                      <input type ="hidden" name = "currentimage" value="<?php echo $currentimage;?>">
                      <input type ="hidden" name = "id" value ="<?php echo $id;?>">
                      <button type="submit" class="btn-secondary" name="submit">Update Category</button>
                   </td>
                </tr>

    </table>
    </form>

      <?php
        if(isset($_POST['submit']))
        {
           // echo " c";
           $id = $_POST['id'];
           $title = $_POST['title'];
           $currentimage = $_POST['currentimage'];
           $featured= $_POST['featured'];
           $active = $_POST['active'];

            if(isset($_FILES['image']['name'])){
            
                $imgname = $_FILES['image']['name'];

                if($imgname !="")
                {
                    //upload the new image and delete current image
                    $ext = end(explode('.', $imgname));
                    $imgname = "food_category_" .rand(000, 999).'.'.$ext;
    
                    $source_path = $_FILES['image']['tmp_name'];
                    $destination_path = "../images/category/".$imgname;
    
                    $upload = move_uploaded_file($source_path, $destination_path);
    
                    //check whether the image is uploaded or not
                    if($upload==FALSE)
                    {
                        $_SESSION['upload'] = "<div class = 'error'> failed to upload image.</div>";
                        header("location:http://localhost/foodics/admin/manage-category.php");
    
                        die();
                    }
                    if($currentimage!="")
                    {
                        $remove_path = "../images/category/".$currentimage;
                        $remove = unlink( $remove_path);

                        //check
                        if($remove ==FALSE)
                        {
                            $_SESSION['failed-remove'] = "<div class='error'>Failed to remove the current image</div>";
                            header("location:http://localhost/foodics/admin/manage-category.php");
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
                    $r = "UPDATE category SET title = '$title',  imgname= '$imgname', featured = '$featured', active= '$active' WHERE id ='$id' ";
                    $result = mysqli_query($conn, $r);
                

                if($result==TRUE)
                {
                    $_SESSION['update'] = "<div class = 'success'> Category update successfully.</div>";
                    header("location:http://localhost/foodics/admin/manage-category.php");
                }else
                {
                    $_SESSION['update'] = "<div class = 'error'> Failed to update Category.</div>";
                    header("location:http://localhost/foodics/admin/manage-category.php");
                } 
            }
   
            
         ?>
    </div>

<?php include('partials/footer.php'); ?>
