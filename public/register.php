<?php  require_once "../Database/DB.php";
include '../libraries/phpqrcode/qrlib.php';
session_start();
/*if(!isset($_SESSION['user'])) 
{
    die('not allowd');
}*/


$output = "";
$p = false;
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
    $fullname = $fname . " " . $lname;

    $_SESSION['id'] = $id;

    $file_name = $_FILES['file']['name'];
    $file_type = $_FILES['file']['type'];
    $file_size = $_FILES['file']['size'];
    $file_tmp_name = $_FILES['file']['tmp_name'];
    $file_error = $_FILES['file']['error'];

    $escaped_name = $conn->real_escape_string($file_name);
$escaped_type = $conn->real_escape_string($file_type);
$escaped_size = $conn->real_escape_string($file_size);

if ($file_error !== UPLOAD_ERR_OK) {
    die("Upload failed with error code $file_error");
}
$max_file_size = 2 * 1024 * 1024; // 2MB in bytes
if ($file_size > $max_file_size) {
    die("File size is too large. Maximum file size is 2MB.");
}


   // enter data to the users

   $sql2 = "INSERT INTO users (id,fullname,age,gender,purpose,occupation,phone)
VALUES ('$id', '$fullname','$age','$gender','$purpose', '$occupation', '$phone')";

if ($conn->query($sql2) === TRUE) {
  

    $dir_path = "../Recepits/$id";

    // Check if the directory already exists
    if (!file_exists($dir_path)) {
        // Create the directory with read, write, and execute permissions for the owner
        mkdir($dir_path, 0700);
       //echo "Directory created successfully!";
    } else {
       //echo "Directory already exists!";
    }


   $upload_dir = "../Recepits/$id/";
$file_name2 = $fname."-" . $lname . "_" . date("Y-m-d");
$upload_path = $upload_dir . $file_name;

if (file_exists($upload_path)) {
    die("File already exists. Please choose a different filename.");
}
if (move_uploaded_file($file_tmp_name, $upload_path)) {
    //echo "File saved locally and uploaded to database!";
} else {
    //echo "Failed to save file locally!";
}

$file_contents = file_get_contents($upload_path);
$file_contents = mysqli_real_escape_string($conn, $file_contents);



////////////////////////////////////////////


   //insert to plan
   $today = date('Y-m-d');
   $sql3 = "INSERT INTO plan 
   VALUES ('$cash', '$wd', '$month', '$id', '$today',1,'$file_contents')";
   
   if ($conn->query($sql3) === TRUE) {
    
   $data = $id;

   // The file path to save the QR code image
   $filename = "../Images/qrcodes/$id.png";
   
   // Generate the QR code image
   QRcode::png($data, $filename);
   
   $output = "user created successfully <br> their id is $id. <br> Qrcode is saved in Images folder";
   
   // Output the QR code image to the browser
   //header('Content-Type: image/png');
   //readfile($filename);
   
   $image_data = file_get_contents("../Images/qrcodes/$id.png");
   
   // Escape special characters in the image data
   $image_data = mysqli_real_escape_string($conn, $image_data);
   
   $sql4 = "INSERT INTO qrcode 
   VALUES ('$image_data', '$id')";
   
   if ($conn->query($sql4) === TRUE) {
    $output = "user created successfully <br> their id is $id. <br> Qrcode is saved in Images folder";
   
   } else {
     echo "Error: " . $sql4 . "<br>" . $conn->error;
   }
    
  

   } else {
     echo "Error: " . $sql3 . "<br>" . $conn->error;
   }

  
} else {
  echo "Error: " . $sql2 . "<br>" . $conn->error;
}
//////////////////////////////////////////////






}

if(isset($_POST['bu']))
{
    $p = true;
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
                <li class="nav-item mr-4">
                  <a class="nav-link text-dark" href="basic-data.php">Basic Data</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-dark" href="report.php">Report</a>
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
            <?php
            if($p ==false)
            {
                echo "<div class='col-5'>";
                echo "<img src='../Images/register.png' style='width:100%; height:auto;' alt='' srcset=''>";
            echo "</div>";

            }
            else{
                echo "<h1>Camera Capture</h1>";
                echo "<video id='video' width='100%' height='auto'></video>";
                echo "<br>";
                echo "<button id='capture-btn'>Capture</button>";
                echo "<br>";
                echo "<canvas id='canvas'></canvas>";
                echo "<br>";
                echo "<img id='preview'>";
                echo "<br>";
                echo "<form method='post' enctype='multipart/form-data'>";
                    echo "<input type='hidden' name='action' value='upload'>";
                    echo "<input type='hidden' name='image_data' id='image-data'>";
                    echo "<input type='submit' value='Upload;>";
                echo "</form>";
               

            }
        
            ?>
            <div class="col-6">
                <div class="row">
                    <div class="col-6">
                        <h2>registeration</h2>
                    </div>
                </div>    
                   <form method="post" action="register.php" enctype="multipart/form-data">
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

                   <div class="col-5">
                        <div class="form-group d-flex flex-column justify-content-center">
                            <input type="file" class="form-control" style="width: 240px;" id="file" name="file"  aria-describedby="emailHelp">
                            <label class="text-center" for="exampleInputEmail1">Recepit</label>
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

                    <form method="POST" action="image.php">
                        <button name="bu">Take A Picture</button>

                    </form>

        
            </div>
        </div>
    </div>
 

   

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>