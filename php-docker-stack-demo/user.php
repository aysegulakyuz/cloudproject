<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Table</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
include('./grades/gradeCalculation.php');
include('./conf.php');

$table_name = 'users';
$user_id = isset($_GET['id']) ? $_GET['id'] : null;
$status_check = true;
if (!empty($user_id)) {
  $grades_query = "SELECT midterm,final FROM grades WHERE student_id = $user_id";
  $grades_result = mysqli_query($connect, $grades_query);
  if ($grades_result) {
    while ($row = mysqli_fetch_assoc($grades_result)) {
      $midterm = $row['midterm'];
      $final = $row['final'];
      $durum = calculationGrade($midterm, $final);
      if ($durum === 'Failed') {
        echo "<script>alert('Since these are courses that the user failed, they cannot be deleted.');</script>";
        $status_check = false;
      }
    }
  }
}
// Silme işlemleri
if ($status_check) {
  if (!empty($user_id)) {
    $user_id = mysqli_real_escape_string($connect, $_GET['id']);
    $delete_query = "DELETE FROM users WHERE id = $user_id";
    $result = mysqli_query($connect, $delete_query);
  }
}
$query = "select * from $table_name";
$response = mysqli_query($connect, $query);

?>

<div class="primary-nav">
<button href="#" class="hamburger open-panel nav-toggle">
<span class="screen-reader-text">Menu</span>
</button>
<nav role="navigation" class="menu">
  <a href="#" class="logotype">Grade<span>System</span></a>
  <div class="overflow-container">
    <ul class="menu-dropdown">
      <li><a href="../user.php">Users</a><span class="icon"><i class="fa fa-dashboard"></i></span></li>
      <li><a href="../lessons/lesson.php">Lessons</a><span class="icon"><i class="fa fa-dashboard"></i></span></li>
      <li><a href="../grades/grade.php">Grades</a><span class="icon"><i class="fa fa-dashboard"></i></span></li>
    </ul>
  </div>
</nav>
</div>

<h1>
User 
<span class="yellow">Table</span>
</h1>
<table class="table-container">
<thead>
  <tr>
    <th><h1>ID</h1></th>
    <th><h1>Name</h1></th>
    <th><h1>Surname</h1></th>
    <th><h1>No</h1></th>
    <th><h1>Actions</h1></th>
  </tr>
</thead>
<tbody>
  <?php
  $num = mysqli_num_rows($response);
  if ($num > 0) {
    while ($row = mysqli_fetch_assoc($response)) {
      echo "<tr>";
      echo "<td>" . $row["id"] . "</td>";
      echo "<td>" . $row["name"] . "</td>";
      echo "<td>" . $row["surname"] . "</td>";
      echo "<td>" . $row["no"] . "</td>";
      echo "<td>
          <a class='action-btn' style='background-color: #9b2121;' href='user.php?id=" . $row['id'] . "'>Delete</a>
          <a class='action-btn' style='background-color: #21759b;' href='userUpdate.php?userId=" . $row['id'] . "'>Update</a>
          </td>";
    }
  }
  ?>
</tbody>
</table>
<?php
echo "<a class='add-btn' href='addUser.php'>Add User</a>";
?>
</body>
</html>

