<?php
  if (!isset ($_SESSION)) {
    session_start();
  };

  include_once ('connection/connection.php');

  $conn = connection(); 

  $sql = "SELECT * FROM student_list";  
  $students = $conn->query($sql) or die($conn->error);
  $row = $students->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    * {
      margin: 0;
      padding: 0;
    }

    body {
      gap: 20px;
      padding: 30px;
    }

    table, th, td {
      border: solid 1px;
      border-collapse: collapse;
      font-family: 'Segoe UI', Arial;
      padding: 10px;
    }

    th {
      font-size: 18px;
    }

    td {
      text-align: left;
      font-size: 16px;
    }
  </style>
</head>
<body>
  <?php
    if (isset ($_SESSION ['UserLogin'])) {
      echo "<p>Welcome user ".$_SESSION ['UserLogin']."!</p>";
    } else {
      echo "<p>Welcome Guess!</p>";
    }
  ?>
  <br>
  <?php 
    if (!isset ($_SESSION ['UserLogin'])) {
      echo '<a href="login.php">Login</a>';
    } else {
      echo '<a href="logout.php">Logout</a>';
    }
  ?>
  <br>
  <br>
  <a href="./add.php">Add Data</a>
  <br>
  <br>
  <form action="result.php" method="get">
    <input type="search" name="search_query">
    <input type="submit" value="submit">
  </form>
  <br>
  <table>
    <thead>
      <tr>
        <th></th>
        <th>
          First Name
        </th>
        <th>
          Last Name
        </th>
        <th>
          <p>View Details</p>
          <p>(Admin Only)</p>
        </th>
      </tr>
    </thead>
    <tbody>
      <?php if (isset($row)) {
      ?>
        <?php do { ?>
          <tr>
            <td>
              <?php echo $row ['id']; ?>
            </td>
            <td>
              <?php echo $row ['first_name']; ?>
            </td>
            <td>
              <?php echo $row ['last_name']; ?>
            </td>
            <td>
              <a href="./details.php?id=<?php echo $row ['id'] ?>">
                View
              </a>
            </td>
          </tr>
        <?php } while ($row = $students->fetch_assoc()); ?>
      <?php } else {?>
        <td>
          No student found.
        </td>
        <td>
          No student found.
        </td>
        <td>
          No student found.
        </td>
        <td>
          No student found.
        </td>
      <?php } ?>
    </tbody>
  </table>
</body>
</html>