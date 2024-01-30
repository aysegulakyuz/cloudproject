<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>lesson Table</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<?php
include('../grades/gradeCalculation.php');
include('../conf.php');
$table_name = 'lessons';
$lesson_id = isset($_GET['id']) ? $_GET['id'] : null;
$status_check = true;
if (!empty($lesson_id)) {
  $grades_query = "SELECT midterm,final FROM grades WHERE lesson_id = $lesson_id";
  $grades_result = mysqli_query($connect, $grades_query);
  if ($grades_result) {
    while ($row = mysqli_fetch_assoc($grades_result)) {
      $midterm = $row['midterm'];
      $final = $row['final'];
      $durum = calculationGrade($midterm, $final);
      if ($durum === 'Failed') {
        echo "<script>alert('It cannot be deleted because it is a user who failed the course.');</script>";
        $status_check = false;
      }
    }
  }
}
// Silme işlemleri
if ($status_check) {
if (!empty($lesson_id)) {
  $lesson_id = mysqli_real_escape_string($connect, $_GET['id']);
  $delete_query = "DELETE FROM lessons WHERE id = $lesson_id";
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
Lessons 
<span class="yellow">Table</span>
</h1>
<table class="table-container">
<thead>
  <tr>
    <th><h1>ID</h1></th>
    <th><h1>Lesson</h1></th>
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
          echo "<td>
          <a class='action-btn' style='background-color: #9b2121;' href='lesson.php?id=".$row['id']."'>Delete</a>
          <a class='action-btn' style='background-color: #21759b;' href='lessonUpdate.php?lessonId=".$row['id']."'>Update</a>
          </td>";
      }
  }
  ?>
</tbody>
</table>
<?php
          echo "<a class='add-btn' href='addlesson.php'>Add Lesson</a>";
  ?>
</body>
</html>

