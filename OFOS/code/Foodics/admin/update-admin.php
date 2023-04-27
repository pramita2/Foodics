<?php include('partials/menu.php'); ?>

<div class= "main content">
        <h1> Update Admin </h1>
        <br> <br>
        <?php
         $conn = mysqli_connect("localhost","root","","foodics");
         //get the id of selected admin
           
            $id=$_GET['id'];
            // cerate sql query to get the detail
            $sql="SELECT * FROM admininfo WHERE id=$id";

            //execute the query
            $res= mysqli_query($conn,$sql);
            //check whether the query is execited or not
            if($res==TRUE)
            {
                //check whether the data is avaliable or not
                $count = mysqli_num_rows($res);
                //check whether we have data or not
                if($count==1){
                    // get the detail
                
                   $row=mysqli_fetch_assoc($res);

                   $firstname = $row['firstname'];
                   $lastname = $row['lastname'];
                   $username = $row['username'];
                   $email = $row['email'];
                   $contactno = $row['contactno'];
                   $password = $row['password'];
                }
                else{
               
                    header("location:http://localhost/foodics/admin/manage-admin.php"); 
                }
            }
            ?>
        <form action="" method="POST" >

        <table class="input-group">
      <tr>
          <td>
          <label>Firstname:</label>
          <input type="text" name="firstname" value="<?php echo $firstname; ?>">
          </td>
      </tr>
      <tr>
          <td>
         <label>Lastname:</label>
        <input type="text" name="lastname" value="<?php echo $lastname; ?>">
        </td>
      </tr>
      <tr>
          <td>
        <label>Username:</label>
        <input type="text" name="username" value="<?php echo $username; ?>">
        </td>
      </tr>
      <tr>
          <td>
            <label>Email:</label>
            <input type="email" name="email" value="<?php echo $email; ?>">
            </td>
      </tr>
      <tr>
          <td>
            <label>Contact no:</label>
            <input type="text" name="contactno" value="<?php echo $contactno; ?>">
            </td>
      </tr>
      <tr>
          <td>
            <label>Password:</label>
            <input type="text" name="password" value="<?php echo $password; ?>">
            </td>
      </tr>
      <tr>
          <td colspan="2">
          <input type="hidden" name="id" value="<?php echo $id; ?>">
      <button type="submit" class="btn-secondary" name="reg_user">Update Admin</button>
      </td>
      </tr>
    </table>
    </form>
</div>
<?php
if(isset($_POST)){
    if(!empty($_POST)){
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $contactno = $_POST['contactno'];
        $password = $_POST['password'];
        $r = "UPDATE admininfo SET firstname = '$firstname', lastname = '$lastname', username = '$username', email = '$email', contactno = '$contactno',
        password = '$password' WHERE id ='$id' ";
        $result = mysqli_query($conn, $r);
        if($result){
            header("location:manage-admin.php");
        } 
    }
}
?>


<?php include('partials/footer.php'); ?>