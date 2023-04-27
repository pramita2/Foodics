<?php
     $conn = mysqli_connect("localhost","root","","foodics");
     if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sql = "delete from order1 where id = $id";
        $result = mysqli_query($conn, $sql);
        if($result){
            header("location:index.php");
        }
        else{
            echo "failed";
        }
     }
 ?>