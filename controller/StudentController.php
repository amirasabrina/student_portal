<?php 
require_once __DIR__ . "/../db.php"; 
require_once __DIR__ . "/../model/StudentModel.php"; 

session_start(); 
 
$model = new StudentModel($conn); 
 
// Register 
if (isset($_POST['register'])) { 
    if ($_POST['password'] === $_POST['confirm']) { 
        $model->register(
            $_POST['name'], 
            $_POST['nric'], 
            $_POST['program'], 
            $_POST['password']
        ); 
        
        header("Location: ../view/login.php"); 
        exit();
    } else { 
        echo "Passwords do not match!"; 
    } 
} 
 
// Login 
if (isset($_POST['login'])) { 
    $user = $model->login($_POST['nric'], $_POST['password']); 
    
    if ($user) { 
        $_SESSION['id'] = $user['id']; 
        $_SESSION['student_id'] = $user['id'];
        
        header("Location: ../view/profile.php"); 
        exit();
    } else { 
        echo "Invalid credentials!"; 
    } 
} 
 
// Update Password 
if (isset($_POST['update_password'])) { 
    if ($_POST['new'] === $_POST['confirm']) { 
        
        if ($model->updatePassword(
            $_SESSION['id'], 
            $_POST['old'], 
            $_POST['new']
        )) { 
            echo "Password updated successfully!"; 
        } else { 
            echo "Password update failed!"; 
        } 
        
    } else { 
        echo "New passwords do not match!"; 
    } 
} 
 
// Update Student 
if (isset($_POST['update_student'])) { 
    
    $model->updateStudent(
        $_POST['id'], 
        $_POST['name'], 
        $_POST['nric'], 
        $_POST['program'], 
        $_POST['marks']
    ); 
    
    header("Location: ../view/student_list.php"); 
    exit();
} 
 
// Delete Student 
if (isset($_POST['delete_student'])) { 
    
    $model->deleteStudent($_POST['id']); 
    
    header("Location: ../view/student_list.php"); 
    exit();
}


// Upload Profile Picture
if (isset($_POST['upload_profile_pic'])) {

    if (!isset($_SESSION['id'])) {
        header("Location: ../view/login.php");
        exit();
    }

    if (isset($_FILES['profile_pic'])) {

        $student_id = $_SESSION['id'];
        $file = $_FILES['profile_pic'];

        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];

        // Get file extension
        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        // Allowed file formats
        $allowed = ['jpg', 'jpeg', 'png'];

        if (in_array($fileExt, $allowed)) {

            if ($fileError === 0) {

                // Maximum file size: 2MB
                if ($fileSize <= 2 * 1024 * 1024) {

                    // Secure file renaming using uniqid
                    $fileNameNew = uniqid('', true) . "." . $fileExt;

                    $fileDestination = __DIR__ . "/../view/uploads/" . $fileNameNew;

                    // Create uploads folder if it does not exist
                    if (!is_dir(__DIR__ . "/../view/uploads")) {
                        mkdir(__DIR__ . "/../view/uploads", 0777, true);
                    }

                    // Upload the file
                    if (move_uploaded_file($fileTmpName, $fileDestination)) {

                        // Update database through the model
                        $model->updateProfilePic(
                            $student_id,
                            $fileNameNew
                        );

                        header("Location: ../view/profile.php?upload=success");
                        exit();

                    } else {

                        echo "Failed to upload profile picture.";

                    }

                } else {

                    echo "File size is too large. The maximum size is 2MB.";

                }

            } else {

                echo "An error occurred while uploading the file.";

            }

        } else {

            echo "Invalid file format. Only .jpg, .jpeg, and .png files are allowed.";

        }
    }
}

?>