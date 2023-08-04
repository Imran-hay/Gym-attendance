<?php  require_once "../Database/DB.php";
include '../libraries/phpqrcode/qrlib.php'; ?>

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
                <li class="nav-item mr-4">
                  <a class="nav-link text-dark" href="basic-data.php">Basic Data</a>
                </li>
                <li class="nav-item border-bottom border-dark">
                  <a class="nav-link text-dark" href="report.php">Report</a>
                </li>
              </ul>
              <form class="form-inline my-2 my-lg-0">
                <button class="btn my-2 my-sm-0 w-100" style="color:#fff; background-color: #64549C; border-radius: 12px;" type="submit">Log out</button>
              </form>
            </div>
          </nav>
    </header>
    <main>
      <div>
        <?php
      $sql = "SELECT * from users WHERE DATE(Registered_at) = DATE(NOW())";
      if ($result = mysqli_query($conn, $sql)) {
      // Return the number of rows in result set
      $rowcount = mysqli_num_rows( $result );
      // Display result
          printf("Total number of new registered user is :  %d\n", $rowcount);
          echo "<br>";
      }
      $sql1 = "SELECT * FROM `table_attendance` WHERE DATE(LOGDATE) = DATE(NOW())";
      if ($result1 = mysqli_query($conn, $sql1)) {
      // Return the number of rows in result set
      $rowcount1 = mysqli_num_rows( $result1 );
      // Display result
          printf("Total number of users today is :  %d\n", $rowcount1);
          echo "<br>";
      }
      $sql2 = "SELECT SUM(cash) FROM `plan` WHERE DATE(RegistrationDate) = DATE(NOW())";
      if ($result2 = mysqli_query($conn, $sql2)) {
        while($row2 = mysqli_fetch_array($result2)){
          echo " Todays Total cost is: ". $row2['SUM(cash)'];
          echo "<br>";
      }
      // Return the number of rows in result set
      // $rowcount1 = mysqli_num_rows( $result1 );
      // Display result
          // printf("Total number of users today is :  %d\n", $rowcount1);
      }

 ?>
      </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>