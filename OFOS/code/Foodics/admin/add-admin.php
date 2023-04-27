<?php include('partials/menu.php'); ?>

<div class="main-content"> 
<h1 class="text-center">Add Admin</h1>
    
    
<?php  
        $conn = mysqli_connect("localhost","root","","foodics");
        ?>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foodics</title>

    <!-- Link our CSS file -->
  <style>
    body  
{  
    margin: 0;  
    padding: 0;  
    background-color: #3CFFFF;  
    font-family: 'Arial';  
}  
.form{  
        width: 382px;  
        overflow: hidden;  
        margin: auto;  
        margin: 20 0 0 450px;  
        padding: 80px;  
        background: #23463f;  
        border-radius: 15px ;  
          
}  
h2{  
    text-align: center;  
    color: #277582;  
    padding: 20px;  
}  
label{  
    color: #08ffd1;  
    font-size: 17px;  
    padding-left: 8px;  
}  
#Pass{  
    width: 150px;  
    height: 30px;  
    border: none;  
    border-radius: 3px;  
    padding-left: 5px;  
      
}  
#log{  
    width: 300px;  
    height: 30px;  
    border: none;  
    border-radius: 17px;  
    padding-left: 7px;  
    color: blue;  
  
  
}  

    </style>
</head>
<body>
<h2>Register Now</h2><br>
    <div class="form"> 
      
    <form id="form" method="POST" action="">

          <fieldset> 

              <label><b>Firstname: </b>  </label>      
            <input type="text" name="firstname"  id="Pass"placeholder="Enter Firstname">    
            <br><br>    
             
            <label><b>Lastname: </b>  </label>      
            <input type="text" name="lasttname"  id="Pass" placeholder="Enter Lastname">    
            <br><br>    
             <label><b>Username: </b> </label>      
            <input type="text" name="username" id="Pass" placeholder="Enter username">    
            <br><br>   
            <label><b>Email: </b>  </label>      
            <input type="email" name="email"  id="Pass" placeholder="Enter Email">    
            <br><br>    
            <label><b>Contact no: </b>  </label>      
            <input type="text" name="contactno" id="Pass" placeholder="Enter Contactno">    
            <br><br> 
            <label><b>Password:</b>  </label>      
            <input type="password" name="password_1" id="Pass"  placeholder="Enter Password">    
            <br><br> 
            <label><b>Confirm password:</b>  </label>      
            <input type="password" name="password_2" id="Pass" placeholder="Confirm password">    
            <br><br> 
              <tr>
                  <td colspan="2">
                  <button type="submit" id="log"name="reg_user">  Submit</button>
              </td>
              </tr>
            
     </fieldset> 
      
    </form>
<?php

    require_once "conn.php";
    $conn=connection();

    
    if (isset($_POST['reg_user'])) {

        $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
        $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $contactno = mysqli_real_escape_string($conn, $_POST['contactno']);
        $password_1 =  mysqli_real_escape_string($conn, $_POST['password_1']);
        $password_2 = mysqli_real_escape_string($conn, $_POST['password_2']);
      
    if (empty($firstname)) {
            echo "firstname is required";
     }
     if (empty($lastname)) {
            echo "lastname is required";
     }
     if (empty($username)) {
            echo "please take your username";
         }
    
    if (empty($email)) 
        { echo "Email is required";
         }
    if (empty($contactno) == 10){
        echo  "phone must be  10";
     
    } 
        
    if (empty($password_1)>8) 
     { echo "Password must be grater than 8"; 
    }
    if ($password_1 == $password_2) {
        $sql1="INSERT INTO admininfo(firstname,lastname,username,PASSWORD,contactno,email) values('$firstname','$lastname','$username','$password_1','$contactno','$email')";
        if ($conn->query($sql1) === TRUE) {
    
            //create a session variable to display massege
            $_SESSION['add'] = "Admin Added Successfully" ;
            header("location:http://localhost/foodics/admin/manage-admin.php");
        } else {
          
              //create a session variable to display massege
              $_SESSION['add'] = "Failed to add admin" ;
              header("location:http://localhost/foodics/admin/manage-admin.php"); 
        }
  }

  }
    ?>

<?php include('partials/footer.php'); ?>