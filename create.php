<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "photographyclub";

//create connection
$connection = new mysqli($servername, $username, $password, $database);


$name = "";
$matric = "";
$phone ="";
$course = "";
$year_study ="";
$errorMessage="";

if( $_SERVER['REQUEST_METHOD'] =='POST' ){
    $name =$_POST["name"];
    $matric =$_POST["matric"];
    $phone =$_POST["phone"];
    $course =$_POST["course"];
    $year_study =$_POST["year_study"];
    
//check all field filled
    do{
        if (empty($name) || empty($matric) || empty($phone) || empty($course) || empty($year_study)){
            $errorMessage = "All field are required";
            break;
        }

        //check matric number duplicate
        $duplicate = "SELECT matric FROM students WHERE matric='$matric'";
        $dup = $connection->query($duplicate);
        if (mysqli_num_rows($dup)>0){
            $errorMessage = "Matric number alraedy exist";
            break;}
        
        //check year must integer
        if (!is_numeric($year_study)){
            $errorMessage = "Year must be in number";
            break;}

//add new member
        $sql = "INSERT INTO students(name, matric, phone, course, year_study)". "VALUES ('$name','$matric','$phone','$course','$year_study')";
        $result = $connection->query($sql);
        

        if (!$result){
                $errorMessage = "Invalid Query: ".$connection->error;
                break;
        }

        header("location: /photographyclub/index.php?msg=Member Added");
    
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
    <a class="btn" href = "/photographyclub/index.php"><p style="font-size:30px">Photography Club</p></a>
        <h2>New Member</h2>

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
                <label class = "col-sm-3 col-form-label">Name</label>
                <div class = "col-sm-6">
                    <input type="text" class="form-control" name="name" value="<?php echo $name;?>">
                </div>    
            </div>
            <div class = "row mb-3">
                <label class = "col-sm-3 col-form-label">Matric No</label>
                <div class = "col-sm-6">
                    <input type="text" class="form-control" name="matric" value="<?php echo $matric;?>">
                </div>    
            </div>
            <div class = "row mb-3">
                <label class = "col-sm-3 col-form-label">Phone</label>
                <div class = "col-sm-6">
                    <input type="text" class="form-control" name="phone" value="<?php echo $phone;?>">
                </div>    
            </div>
            <div class = "row mb-3">
                <label class = "col-sm-3 col-form-label">Course</label>
                <div class = "col-sm-6">
                    <input type="text" class="form-control" name="course" value="<?php echo $course;?>">
                </div>    
            </div>
            <div class = "row mb-3">
                <label class = "col-sm-3 col-form-label">Year Study</label>
                <div class = "col-sm-6">
                    <input type="text" class="form-control" name="year_study" value="<?php echo $year_study;?>">
                </div>    
            </div>

            <div class = "row mb-3">
                <div class = "offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>  
                <div class = "offset-sm-3 col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="/photographyclub/index.php" role="button">Cancel</a>
                </div> 
            </div>              
        </form>
    
    </div>
</body>
</html>