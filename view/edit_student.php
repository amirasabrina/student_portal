<?php
include("../controller/StudentController.php");
$id = $_GET['id'];
$student = $model->getStudent($id);
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-5">
  <h2>Edit Student</h2>
  <form method="POST" action="../controller/StudentController.php">
    <input type="hidden" name="id" value="<?= $student['id'] ?>">
    <div class="mb-3">
      <label>Name</label>
      <input type="text" name="name" class="form-control" value="<?= $student['name'] ?>" required>
    </div>
    <div class="mb-3">
      <label>NRIC</label>
      <input type="text" name="nric" class="form-control" value="<?= $student['nric'] ?>" required>
    </div>
    <div class="mb-3">
      <label>Program</label>
      <input type="text" name="program" class="form-control" value="<?= $student['program'] ?>" required>
    </div>
    <div class="mb-3">
      <label>Marks</label>
      <input type="number" name="marks" class="form-control" value="<?= $student['marks'] ?>" required>
    </div>
    <button type="submit" name="update_student" class="btn btn-primary">Update</button>
    <a href="student_list.php" class="btn btn-secondary">Back</a>
  </form>
</div>
