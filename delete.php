<?php
   
   $servername = "localhost";
   $username = "root";
   $password = "";
   $database = "photographyclub";
//create connection
   $connection = new mysqli($servername, $username, $password, $database);
  
if (isset($_GET["id"])){
    $id = $_GET['id'];

    $sql = "DELETE FROM students WHERE id = $id";
    $result = $connection->query($sql);

    if ($result){
        header("location: /photographyclub/index.php?msg=Member Deleted Successfully");   
    }
}



?>