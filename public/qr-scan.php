<?php //require 'id.php'; 
require_once '../Database/DB.php';


  //echo "<h1>$id</h1>";
  $name = "";
  $message = "";
  $id = "";
  if(isset($_POST['text']))
  {
    $id = $_POST['text'];

    $sql = "SELECT * FROM users WHERE id='$id'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
      // output data of each row
      echo "getname";
      while($row = $result->fetch_assoc()) {
         $name = $row["fullname"];
      }
    } else {
      //echo "<h1>id not found</h1>";
    }
    ////////////////////////////////////////////////

    $sql5 = "SELECT * FROM plan WHERE id='$id'";
    $result5 = $conn->query($sql5);
    
    if ($result5->num_rows > 0) {
      // output data of each row
      echo "getday";
      while($row5 = $result5->fetch_assoc()) {
         $days = $row5["workingdays"];
         $month = $row5["month"];
         $rd = $row5["RegistrationDate"];
      }
    } else {
      //echo "<h1>id not found</h1>";
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
    echo "<h1>$days</h1>";
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
      $message = $udate;
     
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
  $message = $days;
} else {
  //echo "Error updating record" . $conn->error;
}
    $message = $days;
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

    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-4">
                <div class="border border-dark" style="height: 50vh;">

                <video id="preview" width="100%" height="100%"></video>
              
              </div>
            </div>
            <div class="col-4 border border-dark" style="height: 50vh;">
                <p class="text-center mt-5">customer ID: <b><?php echo $id ?></b></p>
                <p class="text-center mt-5">customer Name: <b><?php echo $name ?></b></p>
                <p class="text-center mt-5" style="color: #64549C;">Days Remaining: <b><?php echo $message ?></b></p>
                <form method="post" action="qr-scan.php" name="f1" id="f1">
                <input type="text" name="text" id="text" readonly="" value="<?php echo $id ?>" placeholder="Scan qrcode" class="form-control">
                </form>
                <div class="d-flex flex-row justify-content-center align-items-center" style="height: 30vh;">
                    <button class="btn w-50 mr-2" style="color:#fff; background-color: #64549C; border-radius: 12px;">view&edit</button>
                    <button class="btn w-50" style="color:#fff; background-color: #64549C; border-radius: 12px;">In</button>
                </div>
            </div>
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