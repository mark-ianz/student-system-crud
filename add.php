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
  <style>
    h1 {
      font-size: 24px;
    }
    * {
      font-size: 20px;
    }
  </style>
</head>
<body>
  <h1>
    Add Students
  </h1>
  <form action="add.php" method="post">
    <label for="first-name">First Name</label>
    <input type="text" name="first-name"required>
    <br>
    <br>
    <label for="last-name">Last Name</label>
    <input type="text" name="last-name" required>
    <br>
    <br>
    <label for="gender">Gender</label>
    <select name="gender" required>
      <option value="Male">Male</option>
      <option value="Female">Female</option>
    </select>
    <br>
    <br>
    <label for="birthdate">
      Birthdate
    </label>
    <input type="date" name="birthdate" required>
    <br>
    <br>
    <label for="phone-number">
      Phone Number
    </label>
    <input type="number" maxlength="11" name="phone-number" placeholder="Phone Number" required>
    <br>
    <br>
    <input type="submit" value="Add" name="add-button">
  </form>
  <br>
  <br>
  <a href="index.php">
    View Data Table
  </a>
  <br>
  <?php
    if (!isset ($_SESSION ['UserLogin'])) {
      echo '<a href="login.php">Login</a>';
    } else {
      echo '<a href="logout.php">Logout</a>';
    }

    if (isset ($_POST ['add-button'])) {
      $fname = $_POST ["first-name"];
      $lname = $_POST ["last-name"];
      $gen = $_POST ["gender"];
      $bdate = $_POST ["birthdate"];
      $pnum = $_POST ["phone-number"];

      $sql = "INSERT INTO `student_list` (`id`, `first_name`, `last_name`, `gender`, `birth_day`, `phone_number`, `date_added`) 
        VALUES (NULL, '$fname', '$lname', '$gen', '$bdate', '$pnum', current_timestamp())";
      $conn->query($sql) or die ($conn->error);

      header("Location: index.php");
    };
  ?>
</body>
</html>