<?php require_once __DIR__ . "/../controller/StudentController.php"; ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-5">
  <h2>Update Password</h2>
  <form method="POST" action="../controller/StudentController.php">
    <div class="mb-3"><label>Old Password</label><input type="password" name="old" class="form-control" required></div>
    <div class="mb-3"><label>New Password</label><input type="password" name="new" class="form-control" required></div>
    <div class="mb-3"><label>Confirm Password</label><input type="password" name="confirm" class="form-control" required></div>
    <button type="submit" name="update_password" class="btn btn-primary">Update Password</button>
  </form>
</div>
