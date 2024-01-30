<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>grade Table</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<?php
include('gradeCalculation.php');
include('../conf.php');

$table_name = 'grades';
$grade_id = isset($_GET['id']) ? $_GET['id'] : null;

// Silme işlemleri
if (!empty($grade_id)) {
    $grade_id = mysqli_real_escape_string($connect, $_GET['id']);
    $delete_query = "DELETE FROM grades WHERE id = $grade_id";
    $result = mysqli_query($connect, $delete_query);
}
$query = "SELECT grades.*, users.name AS student_name, users.surname AS student_surname, lessons.name AS lesson_name
FROM grades
JOIN users ON grades.student_id = users.id
JOIN lessons ON grades.lesson_id = lessons.id;";
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
Grades 
<span class="yellow">Table</span>
</h1>
<table class="table-container">
<thead>
  <tr>
    <th><h1>ID</h1></th>
    <th><h1>Student</h1></th>
    <th><h1>Lesson</h1></th>
    <th><h1>Midterm</h1></th>
    <th><h1>Final</h1></th>
    <th><h1>Actions</h1></th>
    <th><h1>Status</h1></th>
  </tr>
</thead>
<tbody>
  <?php
  $num = mysqli_num_rows($response);
  if ($num > 0) {
      while ($row = mysqli_fetch_assoc($response)) {
        $grade_result = calculationGrade($row["midterm"] ,$row["final"] );
          echo "<tr>";
          echo "<td>" . $row["id"] . "</td>";
          echo "<td>" . $row["student_name"] ." ".$row["student_surname"] ."</td>";
          echo "<td>" . $row["lesson_name"] . "</td>";
          echo "<td>" . $row["midterm"] . "</td>";
          echo "<td>" . $row["final"] . "</td>";
          echo "<td>
          <a class='action-btn' style='background-color: #9b2121;' href='grade.php?id=".$row['id']."'>Delete</a>
          <a class='action-btn' style='background-color: #21759b;' href='gradeUpdate.php?gradeId=".$row['id']."'>Update</a>
          </td>";
          echo "<td>
          <a class='action-btn' style='background-color: #21759b;' href='#'>$grade_result</a>
          </td>";
      }
  }
  ?>
</tbody>
</table>
<?php
          echo "<a class='add-btn' href='addgrade.php'>Add Grade</a>";
  ?>
</body>
</html>

