<?php 
 include('partials/menu.php');
 $conn = mysqli_connect("localhost","root","","foodics");
$username = $_SESSION['username'];
?>

<div class="main-content">
    <h1>Manage Order</h1> 
    <?php
    if(isset($_SESSION['update']))
    {
      echo $_SESSION['update'];
      unset($_SESSION['update']);
    }
    ?>
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
      
      <th>Address</th>
      <th>Actions</th>

  </tr>
    <?php
      $sql = "SELECT * FROM order1 ORDER BY id DESC";//display the letest order first
      
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
                    elseif($status=="Delivered") 
                    {
                      echo "<label >$status</label>";
                    }
                 
                   ?>
                </td>

                <td><?php  echo $date; ?></td>
                <th><?php  echo $total; ?></th>
                <th><?php  echo $username; ?></th>
                <th><?php  echo $contactno; ?></th>
               
                <th><?php  echo $address; ?></th>
            
            <td>

            <a href="update-order.php?id=<?php echo $id;?>" class="btn-secondary">update order</a>
      
            </td> 

          </tr>
          <?php
        }

      }

    ?> 
 
</table>
</div>


<?php include('partials/footer.php'); ?>