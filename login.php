<?php
  if (!isset ($_SESSION)) {
    session_start();
  };

  include_once ('connection/connection.php');

  $conn = connection(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <h1>Login Page</h1>
  <br>

  <form action="<?php $_SERVER ['PHP_SELF'] ?>" method="post">
    <label for="user_auth">
      Username or Email
    </label>
    <input type="text" name="user_auth" required>
    <br>
    <br>
    <label for="password">
      Password
    </label>
    <input type="password" name="password" required>
    <input type="submit" name="login" value="Login!">
  </form>
  
  <?php 
    if (isset ($_POST ['login'])) {
      $user_auth = $_POST ['user_auth'];
      $password = $_POST ['password'];

      $sql = "SELECT * FROM student_users
        WHERE username = '$user_auth' OR email = '$user_auth'";


      $user = $conn->query($sql) or die ($conn->error);

      $row = $user->fetch_assoc();
      $total = $user->num_rows;

      if (isset($row ['password'])) {
        if ($row ['username'] === $user_auth && password_verify($password, $row ['password'])) {
          $_SESSION ['UserLogin'] = $row ['username'];
          $_SESSION ['Password'] = $row ['password'];
          $_SESSION ['Email Address'] = $row ['email'];
          $_SESSION ['Access'] = $row ['access'];
          header("Location: index.php");
        } else {
          echo "<p>Incorrect username or password</p>";
        };
      } else {
        echo "<p>Incorrect username or password</p>";
      };
    }
  ?>
  <br>
  <br>
  <a href="./signup.php">Don't have an account?</a>
  <br>
  <a href="index.php">
    View Data Table
  </a>
</body>
</html>