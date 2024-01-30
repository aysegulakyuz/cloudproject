<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>grade Table</title>
    <link rel="stylesheet" href="../style.css">
</head>
<style>
    
.login-page {
  width: 360px;
  padding: 3% 0 0;
  margin: auto;
}
.form {
  position: relative;
  z-index: 1;
  background: #FFFFFF;
  max-width: 360px;
  margin: 0 auto 100px;
  padding: 45px;
  text-align: center;
  box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
}
.form input, .form select{
  font-family: "Roboto", sans-serif;
  outline: 0;
  background: #f2f2f2;
  width: 100%;
  border: 0;
  margin: 0 0 15px;
  padding: 15px;
  box-sizing: border-box;
  font-size: 14px;
  color:black;
}
.form button {
  font-family: "Roboto", sans-serif;
  text-transform: uppercase;
  outline: 0;
  background: #4CAF50;
  width: 100%;
  border: 0;
  padding: 15px;
  color: #FFFFFF;
  font-size: 14px;
  -webkit-transition: all 0.3 ease;
  transition: all 0.3 ease;
  cursor: pointer;
}
.form button:hover,.form button:active,.form button:focus {
  background: #43A047;
  color: black;
}
.form .message {
  margin: 15px 0 0;
  color: #b3b3b3;
  font-size: 12px;
}
.form .message a {
  color: #4CAF50;
  text-decoration: none;
}
.form .register-form {
  display: none;
}
.container {
  position: relative;
  z-index: 13;
  max-width: 300px;
  margin: 0 auto;
}
.container:before, .container:after {
  content: "";
  display: block;
  clear: both;
}
.container .info {
  margin: 50px auto;
  text-align: center;
}
.container .info h1 {
  margin: 0 0 15px;
  padding: 0;
  font-size: 36px;
  font-weight: 300;
  color: #1a1a1a;
}
.container .info span {
  color: #4d4d4d;
  font-size: 12px;
}
.container .info span a {
  color: #000000;
  text-decoration: none;
}
.container .info span .fa {
  color: #EF3B3A;
}
.form select option {
  font-size: 15px;
}
</style>
<body>
<?php
include('../conf.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $grade_id = isset($_POST['id']) ? mysqli_real_escape_string($connect, $_POST['id']) : null;
  $student_id = isset($_POST['student_id']) ? mysqli_real_escape_string($connect, $_POST['student_id']) : null;
  $lesson_id = isset($_POST['lesson_id']) ? mysqli_real_escape_string($connect, $_POST['lesson_id']) : null;
  $midterm = isset($_POST['midterm']) ? mysqli_real_escape_string($connect, $_POST['midterm']) : null;
  $final = isset($_POST['final']) ? mysqli_real_escape_string($connect, $_POST['final']) : null;

  if (!empty($student_id)) {
    $update_query = "UPDATE grades SET student_id = '$student_id', lesson_id = '$lesson_id', midterm = '$midterm', final = '$final' WHERE id = $grade_id";
    $update_result = mysqli_query($connect, $update_query);
    if ($update_result) {
      echo '<script>';
      echo 'alert("Grade information has been updated!");';
      echo 'window.location.href = "grade.php";';
      echo '</script>';
    } else {
      echo '<script>alert("Update failed!");</script>';
    }
  }
}

// Öğrenci ve ders bilgilerini çek
$students_query = "SELECT id, name, surname FROM users";
$students_result = mysqli_query($connect, $students_query);

$lessons_query = "SELECT id, name FROM lessons";
$lessons_result = mysqli_query($connect, $lessons_query);
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
Update 
<span class="yellow">Grade</span>
</h1>
<div class="login-page">
  <div class="form">
    <form method="post" class="login-form">
    <?php
    $grade_id = isset($_GET['gradeId']) ? $_GET['gradeId'] : null;
    if (!empty($grade_id)) {
      $grade_id = mysqli_real_escape_string($connect, $_GET['gradeId']);
      $new_query = "SELECT * FROM grades WHERE id = $grade_id";
      $new_result = mysqli_query($connect, $new_query);
      if ($new_result) {
        while ($row = mysqli_fetch_assoc($new_result)) {
          echo '<input type="text" readonly name="id" value="' . $row['id'] . '"/>';
          echo '<select name="student_id">';
          mysqli_data_seek($students_result, 0);
          while ($student = mysqli_fetch_assoc($students_result)) {
            echo '<option value="' . $student['id'] . '"' . ($row['student_id'] == $student['id'] ? ' selected' : '') . '>' . $student['name'] .' '.$student['surname'] . '</option>';
          }
          echo '</select>';

          echo '<select name="lesson_id">';
          mysqli_data_seek($lessons_result, 0);
          while ($lesson = mysqli_fetch_assoc($lessons_result)) {
            echo '<option value="' . $lesson['id'] . '"' . ($row['lesson_id'] == $lesson['id'] ? ' selected' : '') . '>' . $lesson['name'] . '</option>';
          }
          echo '</select>';
          echo '<input type="text" name="midterm" value="' . $row['midterm'] . '"/>';
          echo '<input type="text" name="final" value="' . $row['final'] . '"/>';
        }
      }
    }
    ?>
    <button>Update</button>
    </form>
  </div>
</div>


</body>

</html>

