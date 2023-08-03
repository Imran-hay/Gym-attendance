<?php //require 'id.php'; 
require_once '../Database/DB.php';
session_start();

  //echo "<h1>$id</h1>";
  $name = "";
  $age= "";
  $gender = "";
  $purpose= "";
  $occupation= "";
  $message = "";
  $id = "";
  if(isset($_POST['text']))
  {
    $id = $_POST['text'];
     $_SESSION["ID"]=$id;

    $sql = "SELECT * FROM users WHERE id='$id'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
      // output data of each row
      //echo "getname";
      while($row = $result->fetch_assoc()) {
         $name = $row["fullname"];
            $age= $row["age"];
         $gender = $row["gender"];
         $purpose= $row["purpose"];
         $occupation= $row["occupation"];

      }
    } else {
      echo "<h1>id not found</h1>";
      header('Location:qr-scan.php');
    }
    ////////////////////////////////////////////////

    $sql5 = "SELECT * FROM plan WHERE id='$id'";
    $result5 = $conn->query($sql5);
    
    if ($result5->num_rows > 0) {
      // output data of each row
      
      while($row5 = $result5->fetch_assoc()) {
         $days = $row5["workingdays"];
         $month = $row5["month"];
         $rd = $row5["RegistrationDate"];
      }
    } else {
      echo "<h1>id not found</h1>";
      header('Location:qr-scan.php');
    }
    
    
    ///////////////////////////////////////////////////////////
    $date_start = $rd; 
    $today = date("Y-m-d");
    $interval = "$month". " " . "month"; 
    $dt = new DateTime($date_start);
    $dt->modify('+' . $interval);
    $new_date = $dt->format('Y-m-d');
    //echo $new_date; // Output: 2023-08-20
    
    ///////////////////////////////////////////////////////
   // echo "<h1>$days</h1>";
    if($days == 0)
    {
      $message = "subscription ended";
      
    }
    //////////////////////////////////////////////////////////
    else if($today == $new_date)
    {
      $message = "subscription expired";

    }

    ///////////////////////////////////////////////////////////
  
    else{

    
    $date = date('Y-m-d');
    $time = date('h:i:sa');
    $sql2 = "SELECT * FROM table_attendance WHERE ID='$id' AND LOGDATE='$date' AND STATUS='0'";
    $query2 = $conn->query($sql2);
    if($query2->num_rows>0){
      $udate = $days;
     // $udate = $udate -1;
      //$message = $udate;
        $message = $udate." working Days left";
     
        $sql3 = "UPDATE table_attendance SET TIMEOUT=NOW(), STATUS='1' WHERE ID='$id' AND LOGDATE='$date'";
        $query3 = $conn->query($sql3);
       
       
        ////
        $sql31 = "INSERT INTO recent 
        VALUES ('$id')";

if ($conn->query($sql31) === TRUE) {
  //echo "New record created successfully";
} else {
  echo "Error: " . $sql31 . "<br>" . $conn->error;
}

        ///
        
    }else{
     
        $sq4 = "INSERT INTO table_attendance(ID,ATTENDANT_NAME,TIMEIN,LOGDATE,STATUS) VALUES('$id','$name',NOW(),'$date','0')";
        if($conn->query($sq4) ===TRUE){
        
          $sql41 = "INSERT INTO recent 
          VALUES ('$id')";
           $days = $days-1;
           
  
  if ($conn->query($sql41) === TRUE) {
 
    $sql411 = "UPDATE plan SET workingdays=$days WHERE id = '$id'";
   

if ($conn->query($sql411) === TRUE) {
  //echo "Record updated successfully";
    $message = $days." working Days left";
  //$message = $days;
} else {
  //echo "Error updating record" . $conn->error;
}
 $message = $days." working Days left";
    //$message = $days;
  } else {
    echo "Error: " . $sql41 . "<br>" . $conn->error;
  }
  
           
        }else{
            $_SESSION['error'] = $conn->error;
        }
    }

  
 


////////


  }
}
if(isset($_POST['add']))
  {
    $id=$_SESSION["ID"];
   
  
  $day_left=0;  
  $month_left=0;  
  $sql9 = "SELECT * FROM plan WHERE id='$id' AND flag='1'";
  $result9 = $conn->query($sql9);
  
  if ($result9->num_rows > 0) {
  // output data of each row
  
  while($row9 = $result9->fetch_assoc()) {
  
   $day_left=(int)$day_left+(int)$row9['workingdays'];
   $month_left=(int)$month_left+(int)$row9['month'];
  }
  
  }
  $sql6 = "UPDATE `plan` SET `workingdays`='0',`month`='0',`flag`='0' WHERE id='$id'";
  
  if ($conn->query($sql6) === TRUE) {
  
   $cashs = $_POST["cash"];
   $wds = (int)$_POST['wd']+$day_left;
   $months = (int)$_POST['month']+$month_left;
   $today = date('Y-m-d');
     /////////////////////////////////////////////////////////////////////////
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
   //$file_name2 = $fname."-" . $lname . "_" . date("Y-m-d");
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
 
     ///////////////////////////////////////////////////////////////////////////
     $sql3 = "INSERT INTO `plan`(`cash`, `workingdays`, `month`, `id`, `RegistrationDate`, `flag`,`recepit`)
     VALUES ('$cashs', '$wds', '$months', '$id', '$today','1','$file_contents')";
  if ($conn->query($sql3) === TRUE) {
  
  
  //echo "New record created successfully";
  header('location:qr-scan.php');
  } else {
  echo "Error: " . $sql3 . "<br>" . $conn->error;
  }
  
  } else {
  echo "Error: " . $sql3 . "<br>" . $conn->error;
  }
  
  
  
   
  
  
  }


 




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR-Scan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script type="text/javascript" src="../libraries/js/adapter.min.js"></script>
    <script type="text/javascript" src="../libraries/js/vue.min.js"></script>
    <script type="text/javascript" src="../libraries/js/instascan.min.js"></script>

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
                <li class="nav-item mr-4">
                  <a class="nav-link text-dark" href="register.php">Register</a>
                </li>
                <li class="nav-item border-bottom border-dark mr-4">
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

    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-4">
                <div class="border border-dark" style="height: 50vh;">

                <video id="preview" width="100%" height="100%"></video>
              
              </div>
            </div>
             <?php /* if(!empty($id)){ */ ?>  
            <div class="col-4 border border-dark">
                <form method="post" action="qr-scan.php" name="f1" id="f1">
                  <input type="text" name="text" id="text" readonly="" style="display: none;" value="<?php echo $id ?>" placeholder="Scan qrcode" class="form-control">
                </form>


           
                <div class="row py-2 bg-light justify-content-around">
                  <div class="col-7 d-flex flex-row align-items-center">
                    <div class="d-flex justify-content-center align-items-center mr-2" style="background-color: bisque; height: 75px; width: 75px; border-radius: 50%; color: black;"><h4>MM</h4></div>
                    <div><h2 style="font-size: 1.2rem;"> <?php echo $name;?></h2></div>
                  </div>
                  <div class="col-4 d-flex flex-row align-items-center">
                    <button class="btn btn-dark mr-2" style="height: 35px; width: 64px;">ID</button>
                    <form name='myForm' method='post' action='edit.php'>
                        <button class="btn btn-primary" type="submit" style="height: 35px; width: 64px;">Edit</button>
                    </form>
                  </div>
                </div>

                <div class="row px-2 border py-5">
                    <div class="col-6">

                        <div class="row">
                            <div class="col-12 p-0 pb-3">
                                <span class="d-block" style="font-size: .8rem;">Full Name</span>
                                <span class="d-block" style="font-size: 1rem;"><?php echo $name;?> </span>
                            </div>
                            <div class="col-6 p-0">
                                
                                <div class="pb-3">
                                    <span class="d-block" style="font-size: .8rem;">Age</span>
                                    <span class="d-block" style="font-size: 1rem;"><?php echo $age;?></span>
                                </div>
                                <div class="pb-3">
                                    <span class="d-block" style="font-size: .8rem;">Gender</h6>
                                    <span class="d-block" style="font-size: 1rem;"><?php echo $gender;?></span>
                                </div>
                            </div>
                            <div class="col-6 p-0">
                                <div class="pb-3">
                                    <span class="d-block" style="font-size: .8rem;">Purpose</span>
                                    <span class="d-block" style="font-size: 1rem;"><?php echo $purpose;?></span>
                                </div>
                                <div class="pb-3">
                                    <span class="d-block" style="font-size: .8rem;">Occopation</span>
                                    <span class="d-block" style="font-size: 1rem;"><?php echo $occupation;?></span>
                                </div>
                            </div>   
                        </div>

                    </div>

                    <div class="col-6 pt-2">
                    <div class="row">
                            <div class="col-12">
                                <h4 class="text-success text-right"><?php echo $message;?></h4>
                            </div>
                        </div>
                        <div class="row border pb-2">
                            <form action="" method="post">
                            <div class="col-12 mb-2">
                                <small id="emailHelp" class="form-text text-muted">Payment Plan(Subscription Package)</small>
                            </div>
                           <div class="col-12 d-flex flex-row">
                                <div class="form-group d-flex flex-row justify-content-start">
                                    <input type="number" class="form-control mr-2 w-50" id="exampleInputEmail1" name="cash" aria-describedby="emailHelp">
                                    <small class="text-center mr-2" for="exampleInputEmail1">amount</small>
                                    <img class="mt-1" src="../images/solar_dollar-bold.png" alt="" height="16px" width="16px">
                                </div>
                                <div>
                                    
                                </div>
                           </div>
                           <div class="col-12">
                                <div class="form-group d-flex flex-row justify-content-start">
                                    <input type="number" class="form-control mr-2 w-50" id="exampleInputEmail1" name="wd" aria-describedby="emailHelp">
                                    <small class="text-center" for="exampleInputEmail1">workout Days</small>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group d-flex flex-row justify-content-start">
                                    <input type="number" class="form-control mr-2 w-50" id="exampleInputEmail1" name="month" aria-describedby="emailHelp">
                                    <small class="text-center" for="exampleInputEmail1">Month</small>
                                </div>
                            </div> 
                            <div class="col-12">
                                <div class="form-group d-flex flex-row justify-content-start">
                                    <input type="file" class="form-control mr-2 w-50" id="file" name="file" aria-describedby="emailHelp">
                                    <small class="text-center" for="exampleInputEmail1">Recepit</small>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-6">
                                    <button type="submit" name="add" class="btn w-100" style="color:#fff; background-color: #64549C; border-radius: 15px; height: 44px; width: 444px;">Extend</button>
                                </div>
                            </div>           
                        </div>
                        </form>
                    </div>

                
        </div>
            
            </div>
            <?php /* } */ ?>
            <div class="col-4">
               <!-- <table class="table">
                    <thead class="table-active">
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Recent</th>
                        <th scope="col" class="text-center" colspan="2">Date</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                      <tr class="table-light">
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                      </tr>
                      <tr class="table-light">
                        <th scope="row">2</th>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>@fat</td>
                      </tr>
                      <tr class="table-light">
                        <th scope="row">3</th>
                        <td>Larry</td>
                        <td>the Bird</td>
                        <td>@twitter</td>
                      </tr>
                    
                      <tr class="table-light">
                        <th scope="row">4</th>
                        <td>First</td>
                        <td>Last</td>
                        <td>Handle</td>
                      </tr>
                    
                      <tr class="table-light">
                        <th scope="row">5</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                      </tr>
                      <tr class="table-light">
                        <th scope="row">6</th>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>@fat</td>
                      </tr>
                      <tr class="table-light">
                        <th scope="row">7</th>
                        <td>Larry</td>
                        <td>the Bird</td>
                        <td>@twitter</td>
                      </tr>
                      <tr class="table-light">
                        <th scope="row">8</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                      </tr>
                      <tr class="table-light">
                        <th scope="row">9</th>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>@fat</td>
                      </tr>
                      <tr class="table-light">
                        <th scope="row">10</th>
                        <td>Larry</td>
                        <td>the Bird</td>
                        <td>@twitter</td>
                      </tr>
                    </tbody>
                  </table> -->
                  <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>ATTENDANT ID</td>
                            <td>TIMEIN</td>
                            <td>TIME OUT</td>
                            <td>LOGDAY</td>
                            <!--<td>STATUS</td>-->
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                          
                          
                          if($conn->connect_error){
                              die("connection failed" .$conn->connect_error);
                          }
                          $sql7 = "SELECT ID, ATTENDANT_NAME,TIMEIN,TIMEOUT,LOGDATE,STATUS FROM table_attendance WHERE DATE(LOGDATE)=CURDATE()";
                          $query7 = $conn->query($sql7);
                          while($row7 = $query7->fetch_assoc()){
                            ?>
                            <tr>
                                <td><?php echo $row7['ID']?></td>
                                <td><?php echo $row7['ATTENDANT_NAME']?></td>
                                <td><?php echo $row7['TIMEIN']?></td>
                                <td><?php echo $row7['TIMEOUT']?></td>
                                <td><?php echo $row7['LOGDATE']?></td>
                                <!--<td><?php echo $row7['STATUS']?></td>-->
                            </tr>
                            <?php
                          }
                            ?> 
                          
                        
                    </tbody>
                </table>

            </div>
        </div>
    </div>

    

    <script>
        let scanner = new Instascan.Scanner({video: document.getElementById('preview')});
        var myData = "";
        Instascan.Camera.getCameras().then(function(cameras){
            if(cameras.length > 0){
                scanner.start(cameras[0]);
            }else{
                alert('no camera found');
            }
        }).catch(function(e){
            console.error(e); 
        });
        scanner.addListener('scan',function(c){
            document.getElementById('text').value=c;
           
            var myData = c;

           // document.getElementById('f1').action = 'qr-scan.php?query=' + encodeURIComponent(myData); 
            var form = document.getElementById('f1');
            form.submit();

            ///////////////////////
        


        });


        function s()
        {
          var xhr = new XMLHttpRequest();
           

           // Set up the request
           xhr.open('GET', 'id.php?id=' + encodeURIComponent(myData), true);
           
           
           // Set up a callback function to handle the response
           xhr.onreadystatechange = function() {
            
             if (xhr.readyState === XMLHttpRequest.DONE) {
             
               if (xhr.status === 200) {
                
                 console.log('Response from id.php:', xhr.responseText);
               } else {
               
                 console.error('Error:', xhr.status);
               }
             }
           };
           
           // Send the request
             
           xhr.send();
        }

        

      

     
    

      

    </script>



    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>