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
          $path = "../images/food/".$imgname;

          $remove = unlink($path);
             // failed to remove the image then
          if($remove==FALSE)
          {
              //create session veriable to display massage 
              $_SESSION['upload'] = "<div class='error'>Failed to remove image</div>";
              //redirect to manage food page
              header("location:http://localhost/foodics/admin/manage-food.php");
              die();
          }
      }
      //sql query for delete database
          $sql = "DELETE FROM food WHERE id=$id";

          $res = mysqli_query($conn, $sql);
          if($res==TRUE)
            {
                $_SESSION['delete'] = "<div class='success'>Food Delete successfully</div>";
                //redirect to manage food page
                header("location:http://localhost/foodics/admin/manage-food.php");
            }
            }else{
                $_SESSION['delete'] = "<div class='error'> Failed to Delete Food </div>";
                //redirect to manage food page
                header("location:http://localhost/foodics/admin/manage-food.php");

            }

?>