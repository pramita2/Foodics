<?php include('partials/menu.php'); ?>

<div class="main-content">
<h1 class="text-center">Add Category </h1>
 
    <br >
    <?php
        if(isset($_SESSION['add'])){
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if(isset($_SESSION['upload'])){
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
    ?>
     <br > <br >
    <form method="post" action="" enctype="multipart/form-data">
  <table class="input-group">

      <tr>
          <td>
          <label>Title:</label>
         </td><td>
          <input type="text" name="title" value="" placeholder="category title">
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
      <button type="submit" class="btn-secondary" name="submit">Add Category</button>
      </td>
      </tr>

</table>
</form>
    <?php
    require_once "conn.php";
    $conn=connection();

    
        if(!empty($_POST)){
        $title = $_POST['title'];
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
                    $imgname = "food_category_" .rand(000, 999).'.'.$ext;

                    $source_path = $_FILES['image']['tmp_name'];
                    $destination_path = "../images/category/".$imgname;

                    $upload = move_uploaded_file($source_path, $destination_path);

                    //check whether the image is uploaded or not
                    if($upload==FALSE)
                    {
                        $_SESSION['upload'] = "<div class = 'error'> failed to upload image.</div>";
                        header("location:http://localhost/foodics/admin/add-category.php");

                        die();
                    }
                }
            }    

        else{
                $imgname="";
        }

        $sql ="INSERT INTO category(title,imgname,featured,active) values('$title','$imgname','$featured','$active')";

        $res = mysqli_query($conn,$sql);
        if($res==TRUE)
        {
                $_SESSION['add']= "<div class='success'> category added successfully.</div>";
                header("location:http://localhost/foodics/admin/manage-category.php");
        }else{
            $_SESSION['add']= "<div class='error'>  Failde to add category.</div>";
            header("location:http://localhost/foodics/admin/add-category.php");

        }
    }    

 ?>
</div>

<?php include('partials/footer.php'); ?>