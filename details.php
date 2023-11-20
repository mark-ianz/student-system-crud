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

  if (isset($_SESSION ['Access']) && $_SESSION ['Access'] === "admin") {
    echo "<p>Welcome admin ".$_SESSION ['UserLogin'].'!</p>';
  } else {
    header("Location: index.php");
  };
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
    Student Information
  </h1>
  <div>
    <p>
      <b>
        ID: 
      </b><?php echo $row ['id'];?>
    </p>
    <p>
      <b>
        First Name: 
      </b><?php echo $row ['first_name'];?>
    </p>
    <p>
      <b>
        Last Name: 
      </b><?php echo $row ['last_name'];?>
    </p>
    <p>
      <b>
        Gender: 
      </b><?php echo $row ['gender'];?>
    </p>
    <p>
      <b>
        Birthday: 
      </b><?php echo $row ['birth_day'];?>
    </p>
    <p>
      <b>
        Phone Number: 
      </b><?php echo $row ['phone_number'];?>
    </p>
    <p>
      <b>
        Date Added: 
      </b><?php echo $row ['date_added'];?>
    </p>
  </div>
  <form action="delete.php" method="post">
    <a href="./index.php">
      Go back
    </a>
    <br>
    <a href="edit.php?id=<?php echo $row ['id'] ?>">
      Edit
    </a>
    <br>
    <button type="submit" name="delete-button">
      Delete
    </button>
    <input type="hidden" name="id" value="<?php echo $row['id']?>">
  </form>
</body>
</html>