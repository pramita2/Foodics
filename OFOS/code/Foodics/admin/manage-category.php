<?php include('partials/menu.php'); ?>

<div class="main-content">
    <h1>Manage Category</h1>

    <br /> <br /> 
    <?php
         if(isset($_SESSION['add'])){
            echo $_SESSION['add'];
            unset($_SESSION['add']);
         }
         if(isset($_SESSION['remove'])){
             echo $_SESSION['remove'];
             unset($_SESSION['remove']);
        }
        if(isset($_SESSION['delete'])){
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }
        if(isset($_SESSION['no-category-found'])){
            echo $_SESSION['no-category-found'];
            unset ($_SESSION['no-category-found']);
        }
        if(isset( $_SESSION['update']))
        {
           echo $_SESSION['update'];
          unset ($_SESSION['update']);
         }
         if(isset( $_SESSION['upload']))
         {
            echo $_SESSION['upload'];
           unset ($_SESSION['upload']);
          }
         if(isset($_SESSION['failed-remove'])) 
         {
          echo $_SESSION['failed-remove'];
          unset ($_SESSION['failed-remove']);
         }
    ?>
<br /> <br /> 
<!--Button to add admin-->

        <a href="add-category.php" class="btn-primary">Add Category</a>
        <br /> <br/>
        <table class="tbl-full">
          <tr>
            <th>id</th>
            <th>Title</th>
            <th>Image</th>
            <th>Featured</th>
            <th>Active</th>
            <th>Actions</th>

          </tr>
          <?php

           $conn = mysqli_connect("localhost","root","","foodics");


            $sql = "SELECT * FROM category";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);

            $sn=1;
            if($count>0)
            {
              while($row = mysqli_fetch_assoc($res))
              {
                $id = $row['id'];
                $title = $row['title'];
                $imgname = $row['imgname'];
                $featured = $row['featured'];
                $active = $row['active'];

                ?>
                  <tr>
                    <td><?php echo $sn++;?></td>
                    <td><?php echo $title; ?> 
                  </td>

                    <td>
                      <?php 
                        if($imgname!="")
                        {
                          ?>
                           <img src="../images/category/<?php echo $imgname;?>" width="100px">
                          <?php
                         
                         
                        }else{
                          echo "<div class ='error'>Image not added</div>";
                        }
                      ?>
                    
                    </td>

                    <td><?php echo $featured; ?></td>
                    <td><?php echo $active; ?></td>
                    
                    <td>
                    <a href="update-category.php?id=<?php echo $id;?>" class="btn-secondary">Update Category</a>
                  <a href="delete-category.php?id=<?php echo $id;?>&imgname=<?php echo $imgname; ?>" class="btn-denger">Delete Category</a>
                    </td> 
                  </tr> 
             <?php
             }
           }
           else
            {

            }
            ?>    
     
</table>

</div>

<?php include('partials/footer.php'); ?>
