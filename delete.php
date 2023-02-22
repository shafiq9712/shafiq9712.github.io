<?php
   
 $servername = "localhost";
 $username = "id20306931_root";
 $password = "Abcde12345!@#$%";
 $database = "id20306931_photographyclub";
//create connection
   $connection = new mysqli($servername, $username, $password, $database);
  
if (isset($_GET["id"])){
    $id = $_GET['id'];

    $sql = "DELETE FROM students WHERE id = $id";
    $result = $connection->query($sql);

    if ($result){
        header("location: https://miniphp2023.000webhostapp.com/index.php?msg=Member Deleted Successfully");   
    }
}



?>