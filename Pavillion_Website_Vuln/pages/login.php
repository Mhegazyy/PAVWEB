<?php 

require('../config/db_connect.php');

//Error Handling
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);


//Defining Variables
$username = $password = '';
$err_username = $err_password = '';
$valid_username = $valid_password = false;

//Validation and Query
if (isset($_POST['login'])){

  // Validate username
  if (empty($_POST['username'])) {
      $err_username = 'Please enter your username.';
  } else {
      $username = htmlspecialchars($_POST['username']);
      $valid_username = true;
  }

  // Validate password
  if (empty($_POST['password'])) {
      $err_password = 'Please enter your password.';
  } else {
      $password = htmlspecialchars($_POST['password']);
      $valid_password = true;
  }

  if ($valid_username && $valid_password){
    $q = "SELECT * FROM users WHERE username='$username'";
    $res = mysqli_query($conn,$q);
    if (mysqli_num_rows($res) == 1){
      //Username Exists and will check for password
      $row = mysqli_fetch_assoc($res);

      if (password_verify($password, $row['PASSWORD'])) {
        session_start();
        $_SESSION['id'] = $row['id'];
        $_SESSION['timeout'] = time(); // Add this line to set the session timeout
    
        header("Location: dashboard.php");
        exit();
    } else {
        $err_password = 'Password is incorrect!';
    }
    }else{
      $err_username = 'Username does not exist!';
    }
  }
}
?>

<!DOCTYPE html>
<link rel="stylesheet" href="style.css?v=1">
<html>
  <head>
    <title>Pavillion Architects</title>
    <link href="https://fonts.cdnfonts.com/css/glober" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src ="../scripts/javascript.js"></script>
  </head>
  <body>
  <?php include("../templates/header_nav.php") ?>
    <div class = "reveal" id="content">
      <div class="container">
        <h2>Login</h2>
        <form action="login.php" method="post">
          <label for="username">Username:</label>
          <input type="text" id="username" name="username" value = <?php echo $username ?>>
          <div class = "danger"><p><?php echo $err_username ?></p></div>
          <br>
          <label for="password">Password:</label>
          <input type="password" id="password" name="password" value = <?php echo $password ?>>
          <div class = "danger"><p><?php echo $err_password ?></p></div>
          <br>
          <button type="submit" name = 'login'>Login</button>
        </form>
      </div>
    </div>
    <div id="footer">
        <p>&copy; 2023 Pavillion Architects. All rights reserved.</p>
      </div>
  </body>
</html>
