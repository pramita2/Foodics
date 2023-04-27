<?php 
include('partials-front/menu.php');

$conn = mysqli_connect("localhost","root","","foodics");
session_start();
$username = $_SESSION['username'];


?>
    <h1>Your Order Detail</h1> 
 <table class="tbl-full">
    <tr>
      <th>Id</th>
      <th>Food</th>
      <th>Price</th>
      <th>Qty</th>
      <th>Status</th>
      <th>Date</th>
      <th>Total</th>
      <th>Username</th>
      <th>Contact</th>
      <th>Email</th>
      <th>Address</th>
      <th>Actions</th>

  </tr>
    <?php
    
      $sql = "SELECT * FROM order1 where username = '$username' ORDER BY id DESC";//display the letest order first
      
      $res = mysqli_query($conn, $sql);
      $count = mysqli_num_rows($res);
      $sn = 1;

      if($count>0)
      {
        while($row = mysqli_fetch_assoc($res))
        {
          $id = $row['id'];
          $food = $row['food'];
          $price = $row['price'];
          $qty = $row['qty'];
          $status = $row['status'];
          $date = $row['date'];
          $total = $row['total'];
          $username = $row['username'];
          $contactno = $row['contactno'];
          $email = $row['email'];
          $address = $row['address'];
         
          ?>
             <tr>
                <td><?php  echo $sn++; ?></td>
                <td><?php  echo $food; ?> </td>
                <td><?php  echo $price; ?></td>
                <td><?php  echo $qty; ?></td>

                <td>
                  <?php 
                    if($status=="ordered") 
                    {
                      echo "<label>$status</label>";
                    }
                    elseif($status=="On delivery") 
                    {
                      echo "<label >$status</label>";
                    }
                    elseif($status==" Delivered") 
                    {
                      echo "<label >$status</label>";
                    }
                    elseif($status=="Cancelled") 
                    {
                      echo "<label >$status</label>";
                    }
                   ?>
                </td>

                <td><?php  echo $date; ?></td>
                <th><?php  echo $total; ?></th>
                <th><?php  echo $username; ?></th>
                <th><?php  echo $contactno; ?></th>
                <th><?php  echo $email; ?></th>
                <th><?php  echo $address; ?></th>
            
            <td>

             <a href="canel.php?id=<?php echo $id;?>" type="submit" class="log">cancel order
            </a>
             

            </td> 

          </tr> 
          <br />   <br /> 
          <?php
        }

      }

    ?> 


  
</table>

<?php include('partials-front/footer.php'); ?>