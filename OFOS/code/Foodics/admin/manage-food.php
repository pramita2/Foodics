<?php include('partials/menu.php'); ?>
<?php
                      
     $conn = mysqli_connect("localhost","root","","foodics");
    ?>

<div class="main-content">
    <h1>Manage Food</h1>

    <br /> <br /> 

<!--Button to add admin-->

    <a href="add-food.php" class="btn-primary">Add Food</a>

<br />  <br /> 
    <?php
      if(isset($_SESSION['add']))
      {
          echo $_SESSION['add'];
          unset($_SESSION['add']);
      }

      if(isset($_SESSION['delete'])){
        echo $_SESSION['delete'];
        unset($_SESSION['delete']);
    }
        if(isset($_SESSION['upload'])){
          echo $_SESSION['upload'];
          unset($_SESSION['upload']);
    }
    if(isset( $_SESSION['update']))
      {
        echo $_SESSION['update'];
        unset ($_SESSION['update']);
      }
     
    ?>
    <table class="tbl-full">
        <tr>
          <th>S.N</th>
          <th>Name</th>
          <th>Price</th>
          <th>Image</th>
          <th>Featured</th>
          <th>Active</th>
          <th>Actions</th>

      </tr>
        <?php
          $sql = "SELECT *FROM food";

          $res = mysqli_query($conn,$sql);

          $count = mysqli_num_rows($res);
          $sn=1;

          if($count>0)
          {
              while($row= mysqli_fetch_assoc($res))
              {
                $id = $row['id'];
                $name = $row['name'];
                $price = $row['price'];
                $imgname = $row['imgname'];
                $featured = $row['featured'];
                $active = $row['active'];

                ?>
                <tr>
                    <td><?php echo $sn++; ?></td>
                    <td><?php echo $name; ?> </td>
                    <td><?php echo $price; ?></td>

                    <td>
                      <?php 
                        if($imgname== "")
                        {
                          echo "<div class = 'error'> Image not Added </div>";

                        }
                        else{
                          
                            ?>
                             <img src="../images/food/<?php echo $imgname;?>" width="100px">
                              <?php
                        }
                      ?>
                    </td>
                    <td><?php echo $featured; ?></td>
                    <td><?php echo $active; ?></td>
                    <td>
                    <a href="update-food.php?id=<?php echo $id;?>" class="btn-secondary">Update Food</a>
                  
                     <a href="delete-food.php?id=<?php echo $id; ?> &imgname=<?php echo $imgname; ?>" class="btn-denger">Delete Food</a>
                     
                    </td> 

                  </tr> 
                <?php
              }
          }
          else{
              echo "<tr><td colspan= '7' class='error'> Food not Added yet.</td> </tr>";
          }
        ?>
    
</table>
</div>

<?php include('partials/footer.php'); ?>