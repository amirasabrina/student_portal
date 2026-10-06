<?php 
require_once __DIR__ . "/../controller/StudentController.php"; 
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-5">
  <h2>Student Login</h2>
  <form method="POST" action="../controller/StudentController.php">
    <div class="mb-3"><label>NRIC</label><input type="text" name="nric" class="form-control" required></div>
    <div class="mb-3"><label>Password</label><input type="password" name="password" class="form-control" required></div>
    <button type="submit" name="login" class="btn btn-primary">Login</button>
  </form>
  <p class="mt-3">Don't have an account? <a href="register.php">Register here</a></p>
</div>
