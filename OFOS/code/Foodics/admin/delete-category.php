<?php
    $conn = mysqli_connect("localhost","root","","foodics");
    //include connn.php file here
    include('conn.php');

    if(isset($_GET['id']) AND isset($_GET['imgname']))
    {
        //echo "get value and delete";
        $id = $_GET['id'];
        $imgname =$_GET['imgname'];

        if($imgname!="")
        {
            //image is avaliable then remove it.
            $path = "../images/category/".$imgname;

            $remove = unlink($path);
               // failed to remove the image then
            if($remove==FALSE)
            {
                //create session veriable to display massage 
                $_SESSION['remove'] = "<div class='error'>Failed to remove category</div>";
                //redirect to manage category page
                header("location:http://localhost/foodics/admin/manage-category.php");
                die();
            }
        }
        //sql query for delete database
            $sql = "DELETE FROM category WHERE id=$id";

            $res = mysqli_query($conn, $sql);
            if($res==TRUE)
            {
                $_SESSION['delete'] = "<div class='success'>Category Delete successfully</div>";
                //redirect to manage category page
                header("location:http://localhost/foodics/admin/manage-category.php");
          }
            }else{
                $_SESSION['delete'] = "<div class='error'> Failed Delete Category </div>";
                //redirect to manage category page
                header("location:http://localhost/foodics/admin/manage-category.php");

            }
      
?>