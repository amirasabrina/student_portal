<?php
include("../controller/StudentController.php");
$students = $model->getAllStudents();
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-5">
  <h2>Student List</h2>
  <table class="table table-bordered">
    <thead class="table-dark">
      <tr>
        <th>ID</th><th>Name</th><th>NRIC</th><th>Program</th><th>Marks</th><th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($students as $s): ?>
      <tr>
        <td><?= $s['id'] ?></td>
        <td><?= $s['name'] ?></td>
        <td><?= $s['nric'] ?></td>
        <td><?= $s['program'] ?></td>
        <td><?= $s['marks'] ?></td>
        <td>
          <a href="edit_student.php?id=<?= $s['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
          <form method="POST" action="../controller/StudentController.php" style="display:inline;">
            <input type="hidden" name="id" value="<?= $s['id'] ?>">
            <button type="submit" name="delete_student" class="btn btn-danger btn-sm"
              onclick="return confirm('Are you sure you want to delete this student?');">
              Delete
            </button>
          </form>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
