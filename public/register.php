<?php  require_once "../Database/DB.php";
include '../libraries/phpqrcode/qrlib.php';
/*if(!isset($_SESSION['user'])) 
{
    die('not allowd');
}*/


$output = "";
$sql = "SELECT COUNT(*) as count FROM users";
$result = mysqli_query($conn, $sql);
if (!$result) {
  die("Error: " . mysqli_error($conn));
}
$row = mysqli_fetch_assoc($result);
$count = $row['count'] + 1;

$fname = "";
$lname = "";
$phone = "";
$gender = "";
$purpose = "";
$occupation = "";
$age = "";
$cash = "";
$wd = "";
$month = "";

if(isset($_POST['butt']))
{
    $id = "SS" . $count;
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $purpose = $_POST['purpose'];
    $occupation = $_POST['occupation'];
    $age = $_POST['age'];
    $cash = $_POST["cash"];
    $wd = $_POST['wd'];
    $month = $_POST['month'];

   // enter data to the users

   $sql2 = "INSERT INTO users 
VALUES ('$id', '$fname', '$lname','$age','$gender','$purpose', '$occupation', '$phone')";

if ($conn->query($sql2) === TRUE) {
  //echo "New record created successfully";
} else {
  echo "Error: " . $sql2 . "<br>" . $conn->error;
}


   //insert to plan

   $sql3 = "INSERT INTO plan 
   VALUES ('$cash', '$wd', '$month', '$id')";
   
   if ($conn->query($sql3) === TRUE) {
     //echo "New record created successfully";
   } else {
     echo "Error: " . $sql3 . "<br>" . $conn->error;
   }


   $data = $id;

// The file path to save the QR code image
$filename = "../Images/qrcodes/$id.png";

// Generate the QR code image
QRcode::png($data, $filename);

$output = "user created successfully <br> their id is $id. <br> Qrcode is saved in Images folder";

// Output the QR code image to the browser
//header('Content-Type: image/png');
//readfile($filename);


}










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
    <header>
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
    </header>
    

    <div class="container mt-5">
        <div class="row justify-content-between">
            <div class="col-5">
                <img src="../Images/register.png" style=" width:100%; height: auto;" alt="" srcset="">
            </div>
            <div class="col-6">
                <div class="row">
                    <div class="col-6">
                        <h2>registeration</h2>
                    </div>
                </div>    
                   <form method="post" action="register.php">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">First Name</label>
                                    <input type="text" class="form-control" name="fname" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter First Name">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Last Name</label>
                                    <input type="text" class="form-control" name="lname" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Last Name">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-7">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Phone number</label>
                                    <input type="number" class="form-control" name="phone" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Phone number">
                                </div>
                            </div>
                            <div class="col-5 d-flex justify-content-center flex-column">   
                                <label class="text-center" for="exampleInputEmail1">Gender</label>
                                <div class="d-flex justify-content-center">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="inlineRadio1" value="M">
                                        <label class="form-check-label" for="inlineRadio1">male</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="F">
                                        <label class="form-check-label" for="inlineRadio2">female</label>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <div class="row justify-content-start">
                            <div class="col-7">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Purpose</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="purpose" aria-describedby="emailHelp" placeholder="Enter Purpose">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-7">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Occopation</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="occupation" aria-describedby="emailHelp" placeholder="What is your Occopation">
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="row justify-content-center">
                                    <div class="col-8">
                                        <div class="form-group d-flex justify-content-center flex-column">
                                            <label class="text-center" for="exampleInputEmail1">Age</label>
                                            <input type="number" class="form-control" id="exampleInputEmail1" name="age" aria-describedby="emailHelp" placeholder="Enter Age">
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>

                        <div class="row">
                           <div class="col-12 mb-2">
                            <small id="emailHelp" class="form-text text-muted">Payment Plan(Subscription Package)</small>
                           </div>
                           <div class="col-4 d-flex flex-row">
                                <div class="form-group d-flex flex-column justify-content-center">
                                    <input type="number" class="form-control" id="exampleInputEmail1" name="cash" aria-describedby="emailHelp">
                                    <label class="text-center" for="exampleInputEmail1">cash</label>
                                </div>
                                <div>
                                    <img src="solar_dollar-bold.png" alt="">
                                </div>
                           </div>
                           <div class="col-4">
                            <div class="form-group d-flex flex-column justify-content-center">
                                <input type="number" class="form-control" id="exampleInputEmail1" name="wd" aria-describedby="emailHelp">
                                <label class="text-center" for="exampleInputEmail1">workout Days</label>
                            </div>
                       </div>
                       <div class="col-4">
                        <div class="form-group d-flex flex-column justify-content-center">
                            <input type="number" class="form-control" id="exampleInputEmail1" name="month" aria-describedby="emailHelp">
                            <label class="text-center" for="exampleInputEmail1">Month</label>
                        </div>
                   </div> 
                        </div>
                       
                        <div class="row justify-content-center">
                            <div class="col-6">
                                <button type="submit" name="butt" class="btn w-100" style="color:#fff; background-color: #64549C; border-radius: 15px; height: 44px; width: 444px;">Rigester</button>
                            </div>
                        </div>
                        <h3 style="color: #64549C;" ><?php echo $output ?></h3>
                        
                    </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>