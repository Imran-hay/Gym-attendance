<?php  require_once "../Database/DB.php";
use function PHPSTORM_META\type;
require "../libraries/vendor/autoload.php";

use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Csv;
use PhpOffice\PhpSpreadsheet\Writer\Xls;


use PhpOffice\PhpSpreadsheet\Spreadsheet;


$l = 0;
$term = '';
$results = '';
$arr = array();$arr2 = array();$arr3 = array();$arr4 = array();$arr5 = array();$arr6 = array();$arr7 = array();
$arr8 = array();$arr9 = array(); $arr10 = array();  $arr11 = array(); $arrn = "";

$a1 = array();
$a2 = array();
$a3 = array();
$a4 = array();
$a5 = array();
$counter = 0;
$counter2 = 0;
$values = '';
if(isset( $_GET['search_term']))
{
    $term = $_GET['search_term'];
    //$string = "The price is $19.99, and the quantity is 10.";


   


    $search_term = filter_input(INPUT_GET, "$term", FILTER_SANITIZE_STRING);

// Create a new mysqli object and connect to the database


// Prepare the SQL statement using a prepared statement
//$stmt = $conn->prepare('SELECT * from users WHERE fullname LIKE ? LIMIT 10');

/*$stmt = $conn->prepare("SELECT users.fullname, users.phone,users.purpose,
users.age,users.gender,users.occupation,plan.cash,plan.workingdays,plan.RegistrationDate
FROM users
JOIN plan ON users.id=plan.id
WHERE users.fullname LIKE ? LIMIT 10

");*/

$stmt = $conn->prepare("SELECT *
FROM users
JOIN plan ON users.id=plan.id
WHERE users.fullname LIKE ? LIMIT 10

");
$term = "%$term%"; // Add the percent signs to the search term
$stmt->bind_param('s', $term);
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    array_push($arr,$row['fullname']);
    array_push($arr2,$row['phone']);
    array_push($arr3,$row['purpose']);
    array_push($arr4,$row['age']);
    array_push($arr5,$row['gender']);
    array_push($arr6,$row['cash']);
    array_push($arr7,$row['occupation']);
    array_push($arr8,$row['workingdays']);
    array_push($arr9,$row['RegistrationDate']);
    array_push($arr10,$row['month']);
    array_push($arr11,$row['id']);
    preg_match('/\d+/', $row['id'], $matches);
    $arrn= $arrn. $matches[0] . " ";
    //echo ($matches[0] . " ");


    $counter++;
    
 
   
   


  }

  echo $arrn;
 

/*$sql = "SELECT * from users WHERE fullname LIKE '$term' LIMIT 10";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    array_push($arr,$row['fullname']);
    echo $row['fullname'];
  }
} else {
  //echo "<h1>id not found</h1>";
}*/







// Fetch the results and output them as a JSON-encoded string
//$results = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
//echo json_encode($results);



}

else{
  $sql = "SELECT *
  FROM users
  JOIN plan ON users.id=plan.id
  LIMIT 10";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      array_push($arr,$row['fullname']);
      array_push($arr2,$row['phone']);
      array_push($arr3,$row['purpose']);
      array_push($arr4,$row['age']);
      array_push($arr5,$row['gender']);
      array_push($arr6,$row['cash']);
      array_push($arr7,$row['occupation']);
      array_push($arr8,$row['workingdays']);
      array_push($arr9,$row['RegistrationDate']);
      array_push($arr10,$row['month']);
      array_push($arr11,$row['id']);
      preg_match('/\d+/', $row['id'], $matches);
      $arrn= $arrn. $matches[0] . " ";
      //echo ($matches[0] . " ");
  
  
      $counter++;
      
      
      //echo $row['fullname'];
    }
  } else {
    //echo "<h1>id not found</h1>";
  }

}
if(isset($_POST['butt2']))
{
  
$date = $_POST['date'];
//echo  $_POST['date'];
$ds = strval($date);
$cDate = date('Y-m-d', strtotime($date));
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Write the headers to the spreadsheet
$headers = array('ID', 'Name', 'TimeIN', 'TimeOut');
$sheet->fromArray($headers, NULL, 'A1');
$x =1;

$sql = "SELECT * FROM  table_attendance";
$result = mysqli_query($conn, $sql);


// Write the data to the spreadsheet
$row = 2;
while ($data = $result->fetch_assoc()) {
    if($data['LOGDATE'] == $date)
    {
        $sheet->setCellValue('A'.$row, $data['ID']); array_push($a1,$data['ID']);
        $sheet->setCellValue('B'.$row, $data['ATTENDANT_NAME']); array_push($a2,$data['ATTENDANT_NAME']);
        $sheet->setCellValue('C'.$row, $data['TIMEIN']); array_push($a3,$data['TIMEIN']);
        $sheet->setCellValue('d'.$row, $data['TIMEOUT']); array_push($a4,$data['TIMEOUT']);
        $row++;
    }

    }


// Create a new CSV writer and save the spreadsheet to a file
$writer = new Csv($spreadsheet);
$writer->setDelimiter(',');
$writer->setEnclosure('"');
$writer->setLineEnding("\r\n");
$writer->setSheetIndex(0);
//$writer->save("$date" . ".csv");
$path = "../Attendance/" . $date . ".csv";
$writer->save($path);






}

else{
  $sql = "SELECT * FROM  table_attendance";
$result = mysqli_query($conn, $sql);
$date = date('Y-m-d');


// Write the data to the spreadsheet

while ($data = $result->fetch_assoc()) {
    if($data['LOGDATE'] == $date)
    {
        array_push($a1,$data['ID']);
       array_push($a2,$data['ATTENDANT_NAME']);
         array_push($a3,$data['TIMEIN']);
       array_push($a4,$data['TIMEOUT']);
       
    }

    }


}

$purpose = '';
$min = '';
$max = '';
$sex = '';
$status = '';
if(isset($_POST['filter']))
{
  $arr = array();$arr2 = array();$arr3 = array();$arr4 = array();$arr5 = array();$arr6 = array();
  $arr7 = array();$arr8 = array();$arr9 = array();$arr10 = array();$arr11 = array();
  $purpose = $_POST['purpose'];
  $min = $_POST['min'];
  $max = $_POST['max'];
  $sex = $_POST['sex'];
  $status = $_POST['status'];

  if($status == 'Active')
  {
    $sq= "SELECT *
    FROM users
    JOIN plan ON users.id=plan.id
   
  ";  
$res = $conn->query($sq);

// if($row['age'] >= $min && $row['age'] <= $max && $row['purpose'] == $purpose && $row['sex'] == $sex  )
if ($res->num_rows > 0) {

  // output data of each row
  while($row = $res->fetch_assoc()) {
      if($row['age'] >= $min && $row['age'] <= $max  && $row['purpose'] == $purpose&& $row['gender'] == $sex)
      {
      
        if($row['workingdays'] >3)
        {
          
          array_push($arr,$row['fullname']);
          array_push($arr2,$row['phone']);
          array_push($arr3,$row['purpose']);
          array_push($arr4,$row['age']);
          array_push($arr5,$row['gender']);
          array_push($arr6,$row['cash']);
          array_push($arr7,$row['occupation']);
          array_push($arr8,$row['workingdays']);
          array_push($arr9,$row['RegistrationDate']);
          array_push($arr10,$row['month']);
          array_push($arr11,$row['id']);

        }
         
      }
  
      }
    }

   

   

  }
   ////////////////////////////////////////////////////

   if($status == 'Expiring')
   {
     $sq= "SELECT *
     FROM users
     JOIN plan ON users.id=plan.id
    
   ";  
 $res = $conn->query($sq);
 
 // if($row['age'] >= $min && $row['age'] <= $max && $row['purpose'] == $purpose && $row['sex'] == $sex  )
 if ($res->num_rows > 0) {
 
   // output data of each row
   while($row = $res->fetch_assoc()) {
       if($row['age'] >= $min && $row['age'] <= $max  && $row['purpose'] == $purpose&& $row['gender'] == $sex)
       {
       
         if($row['workingdays'] <3 && $row['workingdays'] >0  )
         {
           
           array_push($arr,$row['fullname']);
           array_push($arr2,$row['phone']);
           array_push($arr3,$row['purpose']);
           array_push($arr4,$row['age']);
           array_push($arr5,$row['gender']);
           array_push($arr6,$row['cash']);
           array_push($arr7,$row['occupation']);
           array_push($arr8,$row['workingdays']);
           array_push($arr9,$row['RegistrationDate']);
           array_push($arr10,$row['month']);
           array_push($arr11,$row['id']);
 
         }
          
       }
   
       }
     }
 
    
 
    
 
   }


     ////////////////////////////////////////////////////

     if($status == 'Inactive')
     {
       $sq= "SELECT *
       FROM users
       JOIN plan ON users.id=plan.id
      
     ";  
   $res = $conn->query($sq);
   
   // if($row['age'] >= $min && $row['age'] <= $max && $row['purpose'] == $purpose && $row['sex'] == $sex  )
   if ($res->num_rows > 0) {
   
     // output data of each row
     while($row = $res->fetch_assoc()) {
         if($row['age'] >= $min && $row['age'] <= $max  && $row['purpose'] == $purpose&& $row['gender'] == $sex)
         {
    
           if($row['workingdays']==0  )
           {
             
             array_push($arr,$row['fullname']);
             array_push($arr2,$row['phone']);
             array_push($arr3,$row['purpose']);
             array_push($arr4,$row['age']);
             array_push($arr5,$row['gender']);
             array_push($arr6,$row['cash']);
             array_push($arr7,$row['occupation']);
             array_push($arr8,$row['workingdays']);
             array_push($arr9,$row['RegistrationDate']);
             array_push($arr10,$row['month']);
             array_push($arr11,$row['id']);
   
           }
            
         }
     
         }
       }
   
      
   
      
   
     }
  

 


 
 


}



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Basic Data</title>
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
                <li class="nav-item mr-4">
                  <a class="nav-link text-dark" href="register.php">Register</a>
                </li>
                <li class="nav-item mr-4">
                  <a class="nav-link text-dark" href="qr-scan.php">QR Scan</a>
                </li>
                <li class="nav-item border-bottom border-dark">
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
  <div class="row justify-content-start">
    <div class="col-2">
      <button class="btn my-2 my-sm-0 w-100" onclick="client()" style="color:#fff; background-color: #64549C; border-radius: 12px;">All clients</button>    
    </div>
    <div class="col-2">
      <button class="btn my-2 my-sm-0 w-100" onclick="attendance()" style="color: #64549C; border:0.5px #64549C solid; background-color: #fff; border-radius: 12px;">Attendance</button>    
    </div>
  </div>
</div>

<div class="container-fluid mt-5 bg-light" id="client">
  <div class="row justify-content-between pt-3">
    <div class="col-auto d-flex flex-row">
      <form  id="f1" name="f1">
        <div class="form-group d-flex flex-row">
          <input type="text" class="form-control rounded-left" style="border-right: none;"  placeholder="Search by name..." name="search_term" id="search_term" >
          <button type="submit" onclick="clickme()" class="btn bg-white rounded-right" name="butt" style="border: 1px solid #ced4da; border-left: none; border-radius: .25rem;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
          </svg></button>
     
         
         
        </div>  
      </form>
      <div class="ml-3">
        <button data-toggle="collapse" data-target="#filter" class="btn bg-white pt-2" style="width: 40px; height: 38px; border: 1px solid #ced4da; border-radius: .25rem;">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-funnel-fill" viewBox="0 0 16 16">
            <path d="M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.128.334L10 8.692V13.5a.5.5 0 0 1-.342.474l-3 1A.5.5 0 0 1 6 14.5V8.692L1.628 3.834A.5.5 0 0 1 1.5 3.5v-2z"/>
          </svg>
        </button>

   

        <div id="filter" class="collapse">

       
         <!-- <form action="basic-data.php" class="mt-2"  method="get">
            <div class="form-group">
              <label for="sel1">Purpose</label>
              <select class="form-control" id="sel1">
                <option>Body bulider</option>
                <option>Health care</option>
                <option>Phsical</option>
                <option>Body Weight</option>
              </select>
            </div>
            <div class="form-group d-flex flex-row">
                <label for="sel1" class="mr-2">Age</label>
                <input type="number" class="form-control mr-2" placeholder="min">
                <input type="number" class="form-control" name="" id="" placeholder="max">
            </div>
            <div class="form-group">
              <label for="sel1">Sex</label>
              <select class="form-control" id="sel1">
                <option>Male</option>
                <option>Female</option>
              </select>
            </div>
            <div class="form-group">
              <label for="sel1">Status</label>
              <select class="form-control" id="sel1">
                <option>Active</option>
                <option>Expiring</option>
                <option>Inactive</option>
              </select>
            </div>
            
            <button type="submit" name="filter" class="btn mb-2" style="color:#fff; background-color: #64549C; border-radius: 15px; height: 44px; width: 444px;">filter</button>
           
          </form>-->

            <form action="basic-data.php" class="mt-2"  method="post">
              <select class="form-control" id="sel1" name="purpose">
                <option value="Body bulider">Body bulider</option>
                <option>Health care</option>
                <option>Phsical</option>
                <option>Body Weight</option>
              </select>
                <input type="number" class="form-control mr-2" placeholder="min" name="min">
                <input type="number" class="form-control" name="max" id="" placeholder="max">
          
              <select class="form-control" id="sel1" name="sex">
                <option value="M">M</option>
                <option value="F">F</option>
              </select>
          
              <select class="form-control" id="sel1" name="status">
                <option>Active</option>
                <option>Expiring</option>
                <option>Inactive</option>
              </select>
       
            
            <button type="submit" name="filter" class="btn mb-2" style="color:#fff; background-color: #64549C; border-radius: 15px; height: 44px; width: 444px;">filter</button>
           
          </form>

        </div>
     
      </div>
    </div>  
    <div class="col-2">
    <button class="btn my-2 my-sm-0 w-100" style="color:#fff; background-color: #64549C; border-radius: 12px;">Downloads</button>    
    
    </div>
  </div>  
  <table class="table table table-striped table-light">

    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Phone Number</th>
        <th scope="col">Purpose</th>
        <th scope="col">Age</th>
        <th scope="col">Sex</th>
        <th scope="col">Deposite</th>
        <th scope="col">Occopation</th>
        <th scope="col">Status</th>
        <th scope="col">Days Left</th>
      </tr>
    </thead>
    <tbody>
      <?php

      ///////////////////////////////
   
      /////////////////////////////
     $l = count($arr);
      if(isset( $_GET['search_term']))
      {
        $da =0;
       

      for($i = 0 ; $i < $l; $i++)
      {
        $date_start = $arr9[$i]; 
        $today = date("Y-m-d");
        $interval = "$arr10[$i]". " " . "month"; 
        $dt = new DateTime($date_start);
        $dt->modify('+' . $interval);
        $new_date = $dt->format('Y-m-d');


       

      echo "<tr>";
      echo "<th scope='row'>$i</th>";
      echo "<form id='$i'   name='myForm' method='post' action='popup.php?ID=" . urlencode($arr11[$i]) . "'>";
      echo "<td id='$arr11[$i]'>$arr[$i]</td>";
      echo "</form>";
      echo "<td>$arr2[$i]</td>";
      echo "<td>$arr3[$i]</td>";
      echo "<td>$arr4[$i]</td>";
      echo "<td>$arr5[$i]</td>";
      echo "<td>$arr6[$i]</td>";
      echo "<td>$arr7[$i]</td>";
     
      if($arr8[$i] > 0)
      {
       // echo "<td>active</td>";
       $date1Timestamp = strtotime($today);
       $date2Timestamp = strtotime($new_date);
       
       if ($date1Timestamp < $date2Timestamp) {
        echo "<td>active</td>";
        $da = 1;
       } elseif ($date1Timestamp > $date2Timestamp) {
        echo "<td>Inactive</td>";
       } else {
        echo "<td>Inactive</td>";
       }
      

      }

      else{
        echo "<td>Inactive</td>";

      }
      if($da == 0)
      {
        echo "<td><small>0 days left</small></td>";

      }
      else
      {
        echo "<td><small>$arr8[$i] left</small></td>";

      }
     
      
    echo "</tr>";


      }
    }
    else{
      for($i = 0 ; $i < $l ; $i++)
      {
        $da =0;
       

        for($i = 0 ; $i < $l ; $i++)
        {
          $date_start = $arr9[$i]; 
          $today = date("Y-m-d");
          $interval = "$arr10[$i]". " " . "month"; 
          $dt = new DateTime($date_start);
          $dt->modify('+' . $interval);
          $new_date = $dt->format('Y-m-d');
  
  
         
  
        echo "<tr>";
        echo "<th scope='row'>$i</th>";
        echo "<form id='$i'   name='myForm' method='post' action='popup.php?ID=" . urlencode($arr11[$i]) . "'>";
        echo "<td id='$arr11[$i]'>$arr[$i]</td>";
        echo "</form>";
        echo "<td>$arr2[$i]</td>";
        echo "<td>$arr3[$i]</td>";
        echo "<td>$arr4[$i]</td>";
        echo "<td>$arr5[$i]</td>";
        echo "<td>$arr6[$i]</td>";
        echo "<td>$arr7[$i]</td>";
       
        if($arr8[$i] > 0)
        {
         // echo "<td>active</td>";
         $date1Timestamp = strtotime($today);
         $date2Timestamp = strtotime($new_date);
         
         if ($date1Timestamp < $date2Timestamp) {
          echo "<td>active</td>";
          $da = 1;
         } elseif ($date1Timestamp > $date2Timestamp) {
          echo "<td>Inactive</td>";
         } else {
          echo "<td>Inactive</td>";
         }
        
  
        }
  
        else{
          echo "<td>Inactive</td>";
  
        }
        if($da == 0)
        {
          echo "<td><small>0 days left</small></td>";
  
        }
        else
        {
          echo "<td><small>$arr8[$i] left</small></td>";
  
        }
       
        
      echo "</tr>";
  
  
        }

      }
    }

    
      

      ?>
    
 
     
    </tbody>
  </table>
</div>

<div class="container-fluid mt-5 bg-light" style="display: none;" id="attend">
  <div class="row justify-content-between pt-3">
    <div class="col-2">
      <form action="" method="post">
        <div class="form-group">
          <input type="date" class="form-control" name="date" id="">
          <button name="butt2">Print</button>
        </div>  
      </form>
    </div>  
    <div class="col-2">
    <button class="btn my-2 my-sm-0 w-100" style="color:#fff; background-color: #64549C; border-radius: 12px;">Downloads</button>    
    
    </div>
  </div>  
  <table class="table table table-striped table-light">

    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">ID</th>
        <th scope="col">Name</th>
        <th scope="col">Time Entered</th>
        <th scope="col">Time exited</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $l = count($a1);

      for($i = 0 ; $i < $l ; $i++)
      {
        $x = 'f'. $i;
        echo $x;
        $y = 'a'.$i;
       
        echo "<tr>";
        echo "<th scope='row'>$i</th>";
        echo "<form id='$x'   name='myForm' method='post' action='popup.php?ID=" . urlencode($a1[$i]) . "'>";
        echo "<td id='$y'>$a1[$i]</td>";
        echo "</form>";
        echo "<td>$a2[$i]</td>";
        echo "<td>$a3[$i]</td>";
        echo "<td>$a4[$i]</td>";
        echo "</tr>";

      }
   
      

      ?>
     
       
      
        
      
    
    
    </tbody>
  </table>
</div>

<div>


</div>


<script>

 function attendance(){
    var a=document.getElementById("attend");
    var c=document.getElementById("client");

    a.style.display="block";
    c.style.display="none";
  }
  function client(){
    var a=document.getElementById("attend");
    var c=document.getElementById("client");

    a.style.display="none";
    c.style.display="block";
  }
  function clickme()
  {
   
     // Get a reference to the text field and the form
     var textField = document.getElementById("search_term");
    var form = document.getElementById("f1");
    document.getElementById('f1').action = 'basic-data.php?term=' + encodeURIComponent(textField); 

    // Listen for the keydown event on the text field
    //textField.addEventListener("input", function(event) {
        // Submit the form
        form.submit();

   
   // }
   // );

  }

  

  const counter = "<?php echo $counter ?>";
  const ids = "<?php echo $arrn ?>";
  //window.alert(ids);
  var arr = ids.split(' ');



  for(let i = 1 ; i <= counter; i++)
  {
   var c = i-1;
   var c1 = parseInt(arr[i-1]);
    const myForm = document.getElementById(c);
    const clickableBlock = document.getElementById('SS'+c1);
   // window.alert('SS'+c1);
  clickableBlock.addEventListener('click', function() {
    //myForm.action = 'action.php';
    myForm.submit();
  });


  }

  ///////////////////////////////////////////////

  const counter2 = "<?php echo $counter2 ?>";

 // window.alert(counter2);



  for(let j = 1 ; j <= counter2; j++)
  {
   var c = j-1;
  
    const myForm2 = document.getElementById('f'+c);
    const clickableBlock2 = document.getElementById('a'+c);
   //window.alert('f'+c);
  clickableBlock2.addEventListener('click', function() {
    //myForm.action = 'action.php';
    myForm2.submit();
  });


  }
  
  
</script>







    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>