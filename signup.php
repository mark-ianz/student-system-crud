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
  <h1>
    Signup Page
  </h1>
  <form action="<?php $_SERVER ['PHP_SELF'] ?>" method="post">
    <label for="email">Email</label>
    <input type="email" name="email" required>
    <br>
    <br>
    <label for="username">
      Username
    </label>
    <input type="text" name="username" required>
    <br>
    <br>
    <label for="password">
      Password
    </label>
    <input type="password" name="password" required>
    <input type="submit" name="signup" value="Signup">
  </form>
  <?php
    try {
      if (isset($_POST ['signup'])) {
        $email = $_POST ['email'];
        $username = $_POST ['username'];
        $password = password_hash($_POST ['password'], PASSWORD_DEFAULT);
  
        $sql = "INSERT INTO `student_users` (`id`, `username`, `password`, `email`, `access`) 
          VALUES (NULL, '$username', '$password', '$email', NULL);";
  
        $conn->query($sql) or die ($conn->error);
        header("Location: ./login.php");
      }
    } catch (mysqli_sql_exception) {
      echo "<p>Username is already taken.</p>";
    };
  ?>
  <br>
  <a href="./login.php">Already have an account?</a>
</body>
</html>