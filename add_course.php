<?php
 $servername = "localhost";
 $username = "id20306931_root";
 $password = "Abcde12345!@#$%";
 $database = "id20306931_photographyclub";

//create connection
$connection = new mysqli($servername, $username, $password, $database);

$course_id="";
$course_name="";
$department="";
$errorMessage="";

if( $_SERVER['REQUEST_METHOD'] =='POST' ){
    $course_name =$_POST["course_name"];
    $department =$_POST["department"];

    do{
        if (empty($course_name) || empty($department) ){
            $errorMessage = "'*' This Field Is Required";
            break;
        }

        $duplicate = "SELECT course_name FROM courses WHERE course_name='$course_name'";
        $dup = $connection->query($duplicate);
        if (mysqli_num_rows($dup)>0){
            $errorMessage = "Course alraedy exist";
            break;}

        //add new member
        $sql = "INSERT INTO courses(course_name, department)". "VALUES ('$course_name','$department')";
        $result = $connection->query($sql);
          
        if (!$result){
            $errorMessage = "Invalid Query: ".$connection->error;
            break;
          }
          
        header("location: https://miniphp2023.000webhostapp.com/course.php?msg=Course Added");

    } while(false);

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
        <h2>New Course</h2>

        <?php
        if (!empty($errorMessage)){
            echo " 
            <div class = 'alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>$errorMessage</strong>
                <button type ='button' class='btn-close' data-bs-dismiss=alert aria-label='Close'></button>
            </div>
             ";
        }
      
        ?>
        
        <form method = "post">
            <div class = "row mb-3">
                <label class = "col-sm-3 col-form-label">* Course</label>
                <div class = "col-sm-6">
                    <input type="text" class="form-control" name="course_name" value="<?php echo $course_name;?>">
                </div>    
            </div>
            <div class = "row mb-3">
                <label class = "col-sm-3 col-form-label">* Department</label>
                <div class = "col-sm-6">
                    <input type="text" class="form-control" name="department" value="<?php echo $department;?>">
                </div>    
            </div>
            <div class = "row mb-3">
                <div class = "offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-outline-primary" >Submit</button>
                </div>  
                <div class = "offset-sm-3 col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="https://miniphp2023.000webhostapp.com/course.php" role="button">Cancel</a>
                </div> 
            </div>      

        </form>   
    
    </div>
</body>
</html>