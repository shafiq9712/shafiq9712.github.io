<?php
 $servername = "localhost";
 $username = "id20306931_root";
 $password = "Abcde12345!@#$%";
 $database = "id20306931_photographyclub";

//create connection
 $connection = new mysqli($servername, $username, $password, $database);

 $sql = "SELECT * FROM courses";
 $result = $connection->query($sql);

 if (!$result){
    die("Invalid query: " . $connection->connect_error);
}
$number=1;
if($result=$connection->query($sql)){
     while($row = $result->fetch_assoc()){
         $course_id=$row['course_id'];
         $resetid= "UPDATE courses SET course_id=$course_id=$number";
        
     }
     //Alter table
     $sql = "ALTER TABLE courses AUTO_INCREMENT=1";
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
        <a class="btn" href = "https://miniphp2023.000webhostapp.com/index.php"><p style="font-size:30px">Photography Club</p></a>
        <h2>List of Courses</h2>
        <a class="btn btn-primary" href = "https://miniphp2023.000webhostapp.com/add_course.php">Add Course</a>
        <br>
        <table class = "table">
            <thread>
                <tr>
                    <th>ID</th>
                    <th>Course</th>
                    <th>Department</th>
                </tr>
            </thread>
            <tbody>
                <?php

                //check connection
                if ($connection->connect_error){
                    die("Connection Failed: " . $connection->connect_error);
                }

                //read all row from database table
                $sql = "SELECT * FROM courses";
                $result = $connection->query($sql);
                
            
        
                //read data each row
                    while($row = $result->fetch_assoc()){
                 
                        echo "
                        <tr>
                            <td>$row[course_id]</td>
                            <td>$row[course_name]</td>
                            <td>$row[department]</td>
           
                        </tr>";
                    
                }
            
                ?>
                
            </tbody>      
        </table>
        <a class = 'btn btn-danger' href='https://miniphp2023.000webhostapp.com/index.php'>Back</a>
    </div>        
</body>
</html>