<?php  require_once "../Database/DB.php";
include '../libraries/phpqrcode/qrlib.php';
/*if(!isset($_SESSION['user'])) 
{
    die('not allowd');
}*/

$id="ss001";

$sql="SELECT * FROM users WHERE id='$id'";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {

    
    $name=$row['fullname'];
    $age=$row['age'];
    $gender=$row['gender'];
    $purpose=$row['purpose'];
    $occupation = $row['occupation'];
    $phone = $row['phone'];

}

}

if(isset($_POST['submit'])){

    if(isset($_POST['name'])){


        $newname=$_POST['name'];

        if($name!=$newname){
            $sql = "UPDATE users SET fullname='$newname' WHERE id='$id'";

            if (mysqli_query($conn, $sql)) {
              echo "New record created successfully";
            } else {
              echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
    }

    if(isset($_POST['age'])){


        $newage=$_POST['age'];

        if($age!=$newage){
            $sql = "UPDATE users SET age='$newage' WHERE id='$id'";

            if (mysqli_query($conn, $sql)) {
              echo "New record created successfully";
            } else {
              echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
    }
    if(isset($_POST['purpose'])){


        $newpurpose=$_POST['purpose'];

        if($purpose!=$newpurpose){
            $sql = "UPDATE users SET purpose='$newpurpose' WHERE id='$id'";

            if (mysqli_query($conn, $sql)) {
              echo "New record created successfully";
            } else {
              echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
    }

    if(isset($_POST['phone'])){


        $newphone=$_POST['phone'];

        if($phone!=$newphone){
            $sql = "UPDATE users SET phone='$newphone' WHERE id='$id'";

            if (mysqli_query($conn, $sql)) {
              echo "New record created successfully";
            } else {
              echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
    }
    
    if(isset($_POST['occupation'])){


        $newoccupation=$_POST['occupation'];

        if($occupation!=$newoccupation){
            $sql = "UPDATE users SET occupation='$newoccupation' WHERE id='$id'";

            if (mysqli_query($conn, $sql)) {
              echo "New record created successfully";
            } else {
              echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
    }

    if(isset($_POST['gender'])){


        $newgender=$_POST['gender'];

        if($gender!=$newgender){
            $sql = "UPDATE users SET gender='$newgender' WHERE id='$id'";

            if (mysqli_query($conn, $sql)) {
              echo "New record created successfully";
            } else {
              echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
    }
}






/* $fname = "";
$lname = "";
$phone = "";
$gender = "";
$purpose = "";
$occupation = "";
$age = "";
$cash = "";
$wd = "";
$month = ""; */


















?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GYM</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
 

</head>
<body>
    <!-- <header>
        <nav class="navbar navbar-expand-lg bg-white border-bottom">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand ml-3" href="#">LOGO</a>
          
            <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
              <ul class="navbar-nav float-center mx-auto mt-2 mt-lg-0">
                <li class="nav-item border-bottom border-dark mr-4">
                  <a class="nav-link text-dark" href="register.php">Register</a>
                </li>
                <li class="nav-item mr-4">
                  <a class="nav-link text-dark" href="qr-scan.php">QR Scan</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-dark" href="basic-data.php">Basic Data</a>
                </li>
              </ul>
              <form class="form-inline my-2 my-lg-0">
                <button class="btn my-2 my-sm-0 w-100" style="color:#fff; background-color: #64549C; border-radius: 12px;" type="submit">Log out</button>
              </form>
            </div>
          </nav>
    </header> -->
    

    <div class="container mt-5">
        <div class="row justify-content-center">
            
            <div class="col-6">
                <div class="row">
                    <div class="col-6">
                        <h2>Edit Change</h2>
                    </div>
                </div>    
                   <form method="post" action="edit.php">
                        <div class="row">
                            <div class="col-7">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Full Name</label>
                                    <input type="text" class="form-control" name="name" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $name;?>">
                                </div>
                            </div>
                         

                        </div>
                        <div class="row">
                            <div class="col-7">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Phone number</label>
                                    <input type="number" class="form-control" name="phone" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $phone;?>">
                                </div>
                            </div>
                            <div class="col-5 d-flex justify-content-center flex-column">   
                                <label class="text-center" for="exampleInputEmail1">Gender</label>
                                <div class="d-flex justify-content-center">
                                    <div class="form-check form-check-inline">

                                        <input class="form-check-input" type="radio" name="gender" id="inlineRadio1" value="M" <?php if ($gender=="M") {
                                        ?> checked <?php    
                                        }?> >
                                        <label class="form-check-label" for="inlineRadio1">male</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="F" <?php if ($gender=="F") {
                                        ?> checked <?php    
                                        }?>>
                                        <label class="form-check-label" for="inlineRadio2">female</label>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <div class="row justify-content-start">
                            <div class="col-7">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Purpose</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="purpose" aria-describedby="emailHelp" value="<?php echo $purpose;?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-7">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Occopation</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="occupation" aria-describedby="emailHelp" value="<?php echo $occupation;?>">
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="row justify-content-center">
                                    <div class="col-8">
                                        <div class="form-group d-flex justify-content-center flex-column">
                                            <label class="text-center" for="exampleInputEmail1">Age</label>
                                            <input type="number" class="form-control" id="exampleInputEmail1" name="age" aria-describedby="emailHelp" value="<?php echo $age; ?>">
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-6">
                                <button type="submit" name="butt" class="btn w-100" style="color:#fff; background-color: #64549C; border-radius: 15px; height: 44px; width: 444px;">Save Change</button>
                            </div>
                        </div>
                        
                        
                    </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>