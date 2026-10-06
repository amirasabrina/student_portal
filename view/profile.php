<?php
require_once __DIR__ . "/../controller/StudentController.php";

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}

$student = $model->getStudent($_SESSION['id']);
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-5">

  <!-- Profile Picture Upload -->

    <h4 class="mt-4">Profile Picture</h4>

    <?php if (!empty($student['profile_pic'])): ?>

        <div class="mb-3">
            <img 
                src="uploads/<?= htmlspecialchars($student['profile_pic']) ?>"
                alt="Profile Picture"
                width="150"
                height="150"
                style="object-fit: cover; border-radius: 50%;"
            >
        </div>

    <?php else: ?>

        <p>No profile picture uploaded.</p>

    <?php endif; ?>


    <form 
        action="../controller/StudentController.php" 
        method="POST" 
        enctype="multipart/form-data"
        class="mb-4"
    >

    <h2>My Profile</h2>

    <table class="table table-striped">
        <tr>
            <td>Name</td>
            <td><?= htmlspecialchars($student['name']) ?></td>
        </tr>

        <tr>
            <td>NRIC</td>
            <td><?= htmlspecialchars($student['nric']) ?></td>
        </tr>

        <tr>
            <td>Program</td>
            <td><?= htmlspecialchars($student['program']) ?></td>
        </tr>

        <tr>
            <td>Marks</td>
            <td><?= htmlspecialchars($student['marks']) ?></td>
        </tr>
    </table>
    
     <div class="mb-3">
            <label for="profile_pic" class="form-label">
                Choose Profile Picture
            </label>

            <input 
                type="file" 
                name="profile_pic" 
                id="profile_pic"
                class="form-control"
                accept=".jpg,.jpeg,.png"
                required
            >

            <small class="text-muted">
                Allowed formats: JPG, JPEG, PNG. Maximum size: 2MB.
            </small>
        </div>


        <button 
            type="submit" 
            name="upload_profile_pic" 
            class="btn btn-primary"
        >
            Upload Profile Picture
        </button>

    </form>


    <a href="change_password.php" class="btn btn-warning">
        Change Password
    </a>

    <a href="student_list.php" class="btn btn-info">
        View All Students
    </a>

</div>
```
