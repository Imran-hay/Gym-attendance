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
      <form action="" method="post">
        <div class="form-group d-flex flex-row">
          <input type="text" class="form-control rounded-left" style="border-right: none;" name="name" placeholder="Search by name..." id="">
          <button type="submit" class="btn bg-white rounded-right" style="border: 1px solid #ced4da; border-left: none; border-radius: .25rem;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
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
          
          <form action="" class="mt-2" method="post">
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
            <button type="submit" class="btn mb-2" style="color:#fff; background-color: #64549C; border-radius: 15px; height: 44px; width: 444px;">filter</button>
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
      <tr>
        <th scope="row">1</th>
        <td>Mark</td>
        <td>0912332241</td>
        <td>bodyBulder</td>
        <td>24</td>
        <td>M</td>
        <td>$500</td>
        <td>Art</td>
        <td>active</td>
        <td><small>12 days left</small></td>
        
      </tr>
      <tr>
        <th scope="row">2</th>
        <td>Mark</td>
        <td>0912332241</td>
        <td>bodyBulder</td>
        <td>24</td>
        <td>M</td>
        <td>$500</td>
        <td>Art</td>
        <td>active</td>
        <td><small>12 days left</small></td>
      </tr>
      <tr>
        <th scope="row">3</th>
        <td>Mark</td>
        <td>0912332241</td>
        <td>bodyBulder</td>
        <td>24</td>
        <td>M</td>
        <td>$500</td>
        <td>Art</td>
        <td>active</td>
        <td><small>12 days left</small></td>
      </tr>
    </tbody>
  </table>
</div>

<div class="container-fluid mt-5 bg-light" style="display: none;" id="attend">
  <div class="row justify-content-between pt-3">
    <div class="col-2">
      <form action="" method="post">
        <div class="form-group">
          <input type="date" class="form-control" name="name" placeholder="Search by name..." id="">
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
        <th scope="col">Name</th>
        <th scope="col">Today</th>
        <th scope="col">Yesterday</th>
        <th scope="col">B Yesterday</th>
        <th scope="col">BB Yesterday</th>
        <th scope="col">BBB Yesterday</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row">1</th>
        <td>Mark</td>
        <td>
          <span>10:30 IN</span>
          <span>12:00 OUT</span>
        </td>
        <td>
          <span>10:30 IN</span>
          <span>12:00 OUT</span>
        </td>
        <td>
          <span>10:30 IN</span>
          <span>12:00 OUT</span>
        </td>
        <td>
          <span>10:30 IN</span>
          <span>12:00 OUT</span>
        </td>
        <td>
          <span>10:30 IN</span>
          <span>12:00 OUT</span>
        </td>

        
      </tr>
      <tr>
        <th scope="row">2</th>
        <td>Mark</td>
        <td>
          <span>10:30 IN</span>
          <span>12:00 OUT</span>
        </td>
        <td>
          <span>10:30 IN</span>
          <span>12:00 OUT</span>
        </td>
        <td>
          <span>10:30 IN</span>
          <span>12:00 OUT</span>
        </td>
        <td>
          <span>10:30 IN</span>
          <span>12:00 OUT</span>
        </td>
        <td>
          <span>10:30 IN</span>
          <span>12:00 OUT</span>
        </td>
     
      </tr>
      <tr>
        <th scope="row">3</th>
        <td>Mark</td>
        <td>
          <span>10:30 IN</span>
          <span>12:00 OUT</span>
        </td>
        <td>
          <span>10:30 IN</span>
          <span>12:00 OUT</span>
        </td>
        <td>
          <span>10:30 IN</span>
          <span>12:00 OUT</span>
        </td>
        <td>
          <span>10:30 IN</span>
          <span>12:00 OUT</span>
        </td>
        <td>
          <span>10:30 IN</span>
          <span>12:00 OUT</span>
        </td>
        
      </tr>
    </tbody>
  </table>
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

</script>




    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>