<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR-Scan</title>
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
                <div class="border border-dark" style="height: 50vh;"></div>
            </div>
            <div class="col-4 border border-dark" style="height: 50vh;">
                <p class="text-center mt-5">customer Name: <b>faldo</b></p>
                <div class="d-flex flex-row justify-content-center align-items-center" style="height: 30vh;">
                    <button class="btn w-50 mr-2" style="color:#fff; background-color: #64549C; border-radius: 12px;">view&edit</button>
                    <button class="btn w-50" style="color:#fff; background-color: #64549C; border-radius: 12px;">In</button>
                </div>
            </div>
            <div class="col-4">
                <table class="table">
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
                  </table>
            </div>
        </div>
    </div>



    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>