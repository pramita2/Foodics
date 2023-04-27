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
.login{  
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
}  
#Uname{  
    width: 300px;  
    height: 30px;  
    border: none;  
    border-radius: 3px;  
    padding-left: 8px;  
}  
#Pass{  
    width: 300px;  
    height: 30px;  
    border: none;  
    border-radius: 3px;  
    padding-left: 8px;  
      
}  
#log{  
    width: 300px;  
    height: 30px;  
    border: none;  
    border-radius: 17px;  
    padding-left: 7px;  
    color: blue;  
  
  
}  
span{  
    color: white;  
    font-size: 17px;  
}  
  a{  
      float: right;  
      background-color: grey;  
  } 
    </style>
</head>
    <h2>Login Page</h2><br>
    <div class="login"> 
      
    <form id="login" method="POST" action="">
    
      <fieldset> 
             
              <label><b>Username: 
            </b>    
            </label>      
            <input type="text" name="username" id="Uname" placeholder="Enter username">    
            <br><br>    
            <label><b>Password:     
              </b>    
              </label>    
              <input type="Password" name="password" id="Pass" placeholder="Enter Password">    
            <br><br>
            <button type="submit" id="log">log in</button>       
            <br><br>    

          <span >You don't have account <a href="form.php" >Click here</a>For create new account.</span>
       
       </fieldset> 
        </form>  
    </div>   
</div> 
<?php
  session_start();

  if(!empty($_POST)){
   
    
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
      // if(isset($username) && isset($password)){
        $sql1="select * from userinfo where username='$username' and password='$password'";
        $result = $conn->query($sql1);
        $count = mysqli_num_rows($result);
          if ($count==1) 
          {
              $_SESSION['log'] = 'yes';
              $_SESSION['username'] =  $username;
              header("Location:index.php");
          } else{
            echo "incorrect username or password";
          }
  }
  ?>



  