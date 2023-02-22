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
$year_born ="";
$course = "";
$year_study ="";
$errorMessage ="";
$id ="";
$age ="";

if( $_SERVER['REQUEST_METHOD'] =='POST' ){
    $name =$_POST["name"];
    $matric =$_POST["matric"];
    $year_born =$_POST["year_born"];
    $phone =$_POST["phone"];
    $course =$_POST["course"];
    $year_study =$_POST["year_study"];
    

//check all field filled
    do{
        if (empty($name) || empty($matric) || empty($year_born) || empty($course) ||empty($year_study) ){
            $errorMessage = "'*' This Field Is Required";
            break;
        }

        //check duplicate matric number
        $duplicate = "SELECT matric FROM students WHERE matric='$matric'";
        $dup = $connection->query($duplicate);
        if (mysqli_num_rows($dup)>0){
            $errorMessage = "Matric number alraedy exist";
            break;}
        
        if(!is_numeric($year_study))
        {
            $errorMessage = "Year Study Must Be In Number";
            break;
        }
        //year set between 1990 to current year
        //$current_year = 2023;
        if($year_born>date("Y") || $year_born<1990)
        {
            $errorMessage = "Invalid year must be between 1990 and ".date("Y");
            break;
        }

        //age calculation
        $age = date("Y") - $year_born;

         //add new member
        $sql = "INSERT INTO students(name, matric, phone, year_born, age, course, year_study)". "VALUES ('$name','$matric','$phone', '$year_born', '$age', '$course','$year_study')";
        $result = $connection->query($sql);
        
        if (!$result){
                $errorMessage = "Invalid Query: ".$connection->error;
                break;
        }
        
        header("location: https://miniphp2023.000webhostapp.com/index.php?msg=Member Added");
        
    

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
                        <button type="submit" class="btn btn-outline-primary">Submit</button>
                    </div>  
                    <div class = "offset-sm-3 col-sm-3 d-grid">
                        <a class="btn btn-outline-primary" href="https://miniphp2023.000webhostapp.com/index.php" role="button">Cancel</a>
                    </div> 
                </div>              
            </form>
    
    </div>
</body>
</html>