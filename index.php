<?php
 $servername = "localhost";
 $username = "id20306931_root";
 $password = "Abcde12345!@#$%";
 $database = "id20306931_photographyclub";

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
        <a class="btn" href = "https://miniphp2023.000webhostapp.com/index.php"><p style="font-size:30px">Photography Club</p></a>
        <h2>List of Member</h2>
        <a class="btn btn-primary" href = "https://miniphp2023.000webhostapp.com/create.php">New Member</a>
        <a class="btn btn-primary" href = "https://miniphp2023.000webhostapp.com/course.php">Courses</a>
        <br>
        <br>
        <div>
            <form action =""; method="GET">
                <div class ="row">
                    <div class="col-md-4">
                        <div class="input-group mb-3">
                        <select name="option" class="form-control">
                            <option value="default" <?php if(isset($_GET['option']) && $_GET['option'] =="default"){echo "selected";}?>>- Sort (default) -</option>
                            <option value="asc_name" <?php if(isset($_GET['option']) && $_GET['option'] =="asc_name"){echo "selected";}?>>Ascending Name</option>
                            <option value="desc_name" <?php if(isset($_GET['option']) && $_GET['option'] =="desc_name"){echo "selected";}?>>Descending Name</option>
                            <option value="asc_course" <?php if(isset($_GET['option']) && $_GET['option'] =="asc_course"){echo "selected";}?>>Ascending Course</option>
                            <option value="desc_course" <?php if(isset($_GET['option']) && $_GET['option'] =="desc_course"){echo "selected";}?>>Descending Course</option>
                            <option value="asc_ystudy" <?php if(isset($_GET['option']) && $_GET['option'] =="asc_ystudy"){echo "selected";}?>>Ascending Year Study</option>
                            <option value="desc_ystudy" <?php if(isset($_GET['option']) && $_GET['option'] =="desc_ystudy"){echo "selected";}?>>Descending Year Study</option>
                        </select>
                        <button type="submit" class="input-group-text btn btn-primary" id="basic-addon2">Sort</button>
                    
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <table class = "table">
            <thread>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Matric No</th>
                    <th>Age</th>
                    <th>Phone</th>
                    <th>Course</th>
                    <th>Year Study</th>
                    <th>Created At</th>
                    <th>Action</th>
                    
                </tr>
            </thread>
            <tbody>
                <?php
            //read all row from database table
            //read data by sorting
  if(isset($_GET['option'])){

                if($_GET['option'] == "default")
            {
                $sql = "SELECT * FROM students ORDER BY created_at ASC";
                $result = $connection->query($sql);
            }
            elseif($_GET['option'] == "asc_name")
            
            {
                $sql = "SELECT * FROM students ORDER BY name ASC";
                $result = $connection->query($sql);
            }
            elseif($_GET['option'] == "desc_name")
            {
                $sql = "SELECT * FROM students ORDER BY name DESC";
                $result = $connection->query($sql);
            }
            elseif($_GET['option'] == "asc_course")
            {
                $sql = "SELECT * FROM students ORDER BY course ASC";
                $result = $connection->query($sql);
            }
            elseif($_GET['option'] == "desc_course")
            {
                $sql = "SELECT * FROM students ORDER BY course DESC";
                $result = $connection->query($sql);
            }
            elseif($_GET['option'] == "asc_ystudy")
            {
                $sql = "SELECT * FROM students ORDER BY year_study ASC";
                $result = $connection->query($sql);
            }
            elseif($_GET['option'] == "desc_ystudy")
            {
                $sql = "SELECT * FROM students ORDER BY year_study DESC";
                $result = $connection->query($sql);
            }

    }
    else{
                $sql = "SELECT * FROM students ORDER BY created_at ASC";
                $result = $connection->query($sql);
        }  
            //read data each row
            while($row = $result->fetch_assoc()){
                 
                        echo "
                            <tr>
                                <td>$row[id]</td>
                                <td>$row[name]</td>
                                <td>$row[matric]</td>
                                <td>$row[age]</td>
                                <td>$row[phone]</td>
                                <td>$row[course]</td>
                                <td>$row[year_study]</td>
                                <td>$row[created_at]</td>
                                <td>
                                <a class = 'btn btn-primary btn-sm' href='https://miniphp2023.000webhostapp.com/edit.php?id=$row[id]'>Edit</a>
                                <a class = 'btn btn-danger btn-sm' href='https://miniphp2023.000webhostapp.com/delete.php?id=$row[id]'>Delete</a>
                            </td>
                        </tr>";
                    
                }
            
                ?>
                
            </tbody>      
        </table>
    </div>        
</body>
</html>