<?php 

$conn = mysqli_connect("localhost","root","","foodics");
//include connn.php file here
include('conn.php');

//get the id of admin to be deleted
echo  $id = $_GET['id'];

//create SQL query to delete admimn
$sql = "DELETE FROM admininfo WHERE id=$id";

//execute the query
$res = mysqli_query($conn, $sql);
//check whether the query executed successfully or not
if($res==TRUE){
  
      //create session veriable to display massage 
      $_SESSION['delete'] = "<div class='success'>Admin Delete successfully</div>";
      //redirect to manage admin page
      header("location:http://localhost/foodics/admin/manage-admin.php");
}
else{
   //faild to delete admin

  $_SESSION['delete'] = "<div class ='error'>Faild to Delete Admin</div> ";
  header("location:http://localhost/foodics/admin/manage-admin.php");

}



?>

