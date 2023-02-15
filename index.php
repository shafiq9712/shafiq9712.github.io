<?php
 $servername = "localhost";
 $username = "root";
 $password = "";
 $database = "photographyclub";

//create connection
 $connection = new mysqli($servername, $username, $password, $database);

 $sql = "SELECT * FROM students";
 $result = $connection->query($sql);
 if (!$result){
     die("Invalid query: " . $connection->connect_error);
 }
 $number=1;
 if($result=$connection->query($sql)){
     while($row = $result->fetch_assoc()){
         $id=$row['id'];
         $resetid= "UPDATE students SET id=$id=$number";
         //$reset=$connection->query($resetid);
         //$number++;
     }
     //Alter table
     $sql = "ALTER TABLE students AUTO_INCREMENT=1";
     $result = $connection->query($sql);
 }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Photography Club</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</head>
<body>
    <div class = "container my-5">
        <?php
        //display message
        if (isset($_GET['msg'])){
            $msg = $_GET['msg'];
            echo " <div class = 'alert alert-success alert-dismissible fade show' role='alert'>
            $msg
            <button type ='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
        }
        ?>
        <a class="btn" href = "/photographyclub/index.php"><p style="font-size:30px">Photography Club</p></a>
        <h2>List of Member</h2>
        <a class="btn btn-primary" href = "/photographyclub/create.php">New Member</a>
        <br>
        <table class = "table">
            <thread>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Matric No</th>
                    <th>Phone</th>
                    <th>Course</th>
                    <th>Year Study</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </thread>
            <tbody>
                <?php

                //check connection
                if ($connection->connect_error){
                    die("Connection Failed: " . $connection->connect_error);
                }

                //read all row from database table
                $sql = "SELECT * FROM students";
                $result = $connection->query($sql);
                
            
        
                //read data each row
                    while($row = $result->fetch_assoc()){
                 
                        echo "
                        <tr>
                            <td>$row[id]</td>
                            <td>$row[name]</td>
                            <td>$row[matric]</td>
                            <td>$row[phone]</td>
                            <td>$row[course]</td>
                            <td>$row[year_study]</td>
                            <td>$row[created_at]</td>
                            <td>
                                <a class = 'btn btn-primary btn-sm' href='/photographyclub/edit.php?id=$row[id]'>Edit</a>
                                <a class = 'btn btn-danger btn-sm' href='/photographyclub/delete.php?id=$row[id]'>Delete</a>
                            </td>
                        </tr>";
                    
                }
            
                ?>
                
            </tbody>      
        </table>
    </div>        
</body>
</html>