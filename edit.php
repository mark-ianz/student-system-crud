<?php
  if (!isset ($_SESSION)) {
    session_start();
  };

  include_once ('connection/connection.php');

  $conn = connection(); 

  $id = $_GET ['id'];

  $sql = "SELECT * FROM student_list WHERE id = $id";  
  $students = $conn->query($sql) or die($conn->error);
  $row = $students->fetch_assoc();

  if (!(isset($_SESSION ['Access']) && $_SESSION ['Access'] === "admin")) {
    header("Location: index.php");
  } 
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
    Edit Information for <?php echo $row ['first_name'].' '.$row ['last_name'] ?>
  </h1>
  <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
    <label for="first-name">First Name</label>
    <input type="text" name="first-name"required value="<?php echo $row['first_name'] ?>">
    <br>
    <br>
    <label for="last-name">Last Name</label>
    <input type="text" name="last-name" required value="<?php echo $row['last_name'] ?>">
    <br>
    <br>
    <label for="gender">Gender</label>
    <select name="gender" required>
      <option value="Male" <?php if($row ['gender'] === "Male") echo "selected"; ?>>Male</option>
      <option value="Female" <?php if($row ['gender'] === "Female") echo "selected"; ?>>Female</option>
    </select>
    <br>
    <br>
    <label for="birthdate">
      Birthdate
    </label>
    <input type="date" name="birthdate" required value="<?php echo $row['birth_day'] ?>">
    <br>
    <br>
    <label for="phone-number">
      Phone Number
    </label>
    <input type="number" maxlength="11" name="phone-number" placeholder="Phone Number" required value="<?php echo $row['phone_number'] ?>">
    <br>
    <br>
    <input type="submit" value="Update! " name="update-button">
  </form>
  <br>
  <br>
  <a href="details.php?id=<?php echo $id ?>">
    Go Back
  </a>
  <br>
  <a href="index.php">
    View Data Table
  </a>
  <br>
  <?php
    if (isset ($_POST ['update-button'])) {
      $fname = $_POST ["first-name"];
      $lname = $_POST ["last-name"];
      $gen = $_POST ["gender"];
      $bdate = $_POST ["birthdate"];
      $pnum = $_POST ["phone-number"];

      $sql = "UPDATE `student_list` SET `first_name` = '$fname', `last_name` = '$lname', `gender` = '$gen', `birth_day` = '$bdate', 
        `phone_number` = '$pnum' WHERE `student_list`.`id` = $id";
      $conn->query($sql) or die ($conn->error);

      header("Location: details.php?id=".$id);
    };
  ?>
</body>
</html>