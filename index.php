<?php require_once "./Database/DB.php";

session_start();

function sanitize($input) {
  // Trim any leading or trailing whitespace from the input
  $input = trim($input);

  // Convert any special characters to HTML entities
  $input = htmlentities($input, ENT_QUOTES, "UTF-8");

  // Return the sanitized input
  return $input;
}

$user = "";
$pass= "";

if(isset($_POST['butt']))
{
   $user = sanitize($_POST['user']);
   $pass =sanitize( $_POST['pass']);
  
   $sql = "SELECT * FROM Admin";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {

    if($row['username'] == $user && md5($pass) == $row['pass'])
    {
      echo "<h1>Access Granted</h1>";
      $_SESSION['user'] = $user;

       
    }

    else
    {
        echo "<h1>wrong username or password</h1>";
    }
    
  }
} else {
  echo "Credentials not found";
}


}



?>

<!DOCTYPE html>
<html>

<head>
  <title>Login</title>
<link href="./styles/styles.css" rel="stylesheet">


</head>

<body class="body">

<div class="login-box">

    <form method="post" action="index.php">
      <div class="user-box">
        <input type="text" name="user" required="">
        <label>Username</label>
      </div>
      <div class="user-box">
        <input type="password" name="pass" required="">
        <label>Password</label>
      </div>
      <button name="butt">
             Login
        <span></span>
      </button>
    </form>
  </div>

</body>


</html>


