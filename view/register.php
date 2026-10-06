<?php 
require_once __DIR__ . "/../controller/StudentController.php"; 
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-5">
  <h2>Register New Student</h2>
  <form method="POST" action="../controller/StudentController.php">
    <div class="mb-3"><label>Name</label><input type="text" name="name" class="form-control" required></div>
    <div class="mb-3"><label>NRIC</label><input type="text" name="nric" class="form-control" required></div>
    <div class="mb-3"><label>Program</label><input type="text" name="program" class="form-control" required></div>
    <div class="mb-3"><label>Password</label><input type="password" name="password" class="form-control" required></div>
    <div class="mb-3"><label>Confirm Password</label><input type="password" name="confirm" class="form-control" required></div>
    <button type="submit" name="register" class="btn btn-success">Register</button>
  </form>
  <p class="mt-3">Already registered? <a href="login.php">Login here</a></p>
</div>
