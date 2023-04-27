
<?php include('partials/menu.php'); ?>

     <!--Main Section Sart -->
     <div class="main-content">
       <h1>Manage Admin </h1>
       <br /> <br /> 
        <?php 
          if(isset($_SESSION['add'])) //checking whether the session is set set or not
            {
              echo $_SESSION['add']; //displaying session massege
              unset($_SESSION['add']);//removing session massege
            }
            if(isset($_SESSION['delete'])){
              echo $_SESSION['delete'];
              unset($_SESSION['delete']);
            }
            if(isset($_SESSION['user-not-found'])){
              echo $_SESSION['user-not-found'];
              unset($_SESSION['user-not-found']);
            }
           
          
          ?>
           <br /> <br /> 
       <!--Button to add admin-->
     <a href="add-admin.php" class="btn-primary">Add Admin</a>
       <br />   <br /> 
        <table class="tbl-full">
         <tr>
           <th>id</th>
           <th>Firstname</th>
           <th>Lastname</th>
           <th>Email</th>
           <th>Contactno</th>
           <th>Username</th>
           <th>Actions</th>

        </tr>
            <?php 
          
              $conn = mysqli_connect("localhost","root","","foodics");
              //query to get all admin .
               $sql ="SELECT * FROM admininfo";
               //execute the query
               $res = mysqli_query($conn, $sql);

               //check whether  the query is execyuted of not
               if($res==TRUE)
               {
                 //count rows to check whether we have data in database or not
                 $count = mysqli_num_rows($res); //function to get all the rows in database

                 $sn = 1; //create a veriable and assign the value 

                 //check the number of rows
                 if($count>0)
                 {
                   //we have data in database
                   while($rows = mysqli_fetch_assoc($res))
                   {

                     //get individual data
                     $id=$rows['id'];
                     $firstname=$rows['firstname'];
                     $lastname=$rows['lastname'];
                     $email=$rows['email'];
                     $contactno=$rows['contactno'];
                     $username=$rows['username'];
                     //display the values in our table

                     ?>
                      <tr>
                        <td> <?php  echo $sn++; ?></td>
                        <td><?php  echo $firstname; ?> </td>
                        <td><?php  echo $lastname; ?></td>
                        <td><?php  echo $email; ?></td>
                        <td><?php  echo $contactno; ?></td>
                        <td><?php  echo $username; ?></td>
                        <td>
                    
                          <a href="update-admin.php?id=<?php echo $id;?>" class="btn-secondary">Update Admin</a>
                          <a href="delete-admin.php?id=<?php echo $id;?>" class="btn-denger">Delete Admin</a>
                          
                         
                          
                        </td> 

                      </tr> 
                     <?php


                   }
                 }
                 else{
                   //we do not have data in database
                 }
               }
            ?>
       
    
      </table>

    <!--Main Section End -->


    <?php include('partials/footer.php'); ?>