<?php

 $servername = "localhost";
 $username = "id20306931_root";
 $password = "Abcde12345!@#$%";
 $database = "id20306931_photographyclub";

//create connection
$connection = new mysqli($servername, $username, $password, $database);

$name = "";
$matric = "";
$phone ="";
$course = "";
$year_study ="";
$errorMessage="";
$year_born="";
$age="";

if ($_SERVER['REQUEST_METHOD'] == 'GET'){    //GET data
    if (!isset($_GET["id"])){
        header("location: https://miniphp2023.000webhostapp.com/index.php");
        exit;
    }

    $id = $_GET['id'];

    $sql = "SELECT * FROM students WHERE id=$id";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    if (!$row){
        header("location: https://miniphp2023.000webhostapp.com/index.php");
     exit;
    }
    $name =$row["name"];
    $matric =$row["matric"];
    $phone =$row["phone"];
    $course =$row["course"];
    $year_study =$row["year_study"];
    $year_born =$row["year_born"];

}
else{

    $id =$_POST["id"];
    $name =$_POST["name"];
    $matric =$_POST["matric"];
    $phone =$_POST["phone"];
    $course =$_POST["course"];
    $year_study =$_POST["year_study"];
    $year_born =$_POST["year_born"];

    do{
        if (empty($id) || empty($name) || empty($matric) || empty($phone) || empty($course) || empty($year_study) || empty($year_born)){
            $errorMessage = "All field are required";
            break;
             }
             
        if (!is_numeric($year_study) || !is_numeric($year_born)){
            $errorMessage = "Year Must Be In Number";
            break;
        } 
        
        if ($year_born>date("Y") || $year_born<1900){
            $errorMessage = "Invalid year born, year born must be in between 1900 and ".date("Y");
            break;
        }
        
        //age calculation
        $age = date("Y")-$year_born;
             
        $sql = "UPDATE students SET name='$name',matric='$matric',phone='$phone',course='$course',year_study='$year_study' WHERE id = '$id'";
        
        $result = $connection->query($sql);

        if(!$result){
            $errorMessage = "Invalid Query: " . $connection->error;
            break;
        }

        else {
            header("location: https://miniphp2023.000webhostapp.com/index.php?msg=Member Edit Successfully");
        }
        }
    while(false);

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
        <h2>Edit Member</h2>

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


        <form method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class = "row mb-3">
                <label class = "col-sm-3 col-form-label">* Name</label>
                <div class = "col-sm-6">
                    <input type="text" class="form-control" name="name" value="<?php echo $name;?>">
                </div>    
            </div>
            <div class = "row mb-3">
                <label class = "col-sm-3 col-form-label">* Matric No</label>
                <div class = "col-sm-6">
                    <input type="text" class="form-control" name="matric" value="<?php echo $matric;?>">
                </div>    
            </div>
            <div class = "row mb-3">
                <label class = "col-sm-3 col-form-label">Phone</label>
                <div class = "col-sm-6">
                    <input type="text" class="form-control" name="phone" maxlength="15" value="<?php echo $phone;?>">
                </div>    
            </div>
                     <div class = "row mb-3">
                <label class = "col-sm-3 col-form-label">* Year Born</label>
                <div class = "col-sm-6">
                    <input type="text" class="form-control" name="year_born" maxlength="4" value="<?php echo $year_born;?>">
                </div>    
            </div>
            <div class = "row mb-3">
                <label class = "col-sm-3 col-form-label">* Course</label>
                <div class = "col-sm-6">
    <?php
    $sql = "SELECT * FROM courses";
    $r = $connection->query($sql);
  
    ?>
                    <select name="course" value="<?php echo $course;?>">
                    <option value="">- - - - - SELECT - - - - -</option>
                    <?php
                    while($row = $r->fetch_assoc()){
                        
                        ?>

                        <option value="<?php echo $row['course_name']?>"><?php echo $row['course_name']?></option>
                        <?php
                    }
                    ?>
                     </select>
                </div>    
            </div>
            <div class = "row mb-3">
                <label class = "col-sm-3 col-form-label">* Year Study</label>
                <div class = "col-sm-6">
                    <input type="text" class="form-control" name="year_study" maxlength="1" value="<?php echo $year_study;?>">
                </div>    
            </div>

            <div class = "row mb-3">
                <div class = "offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>  
                <div class = "offset-sm-3 col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="https://miniphp2023.000webhostapp.com/index.php" role="button">Cancel</a>
                </div> 
            </div>              
        </form>
    
    </div>
</body>
</html>