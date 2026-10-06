<?php
class StudentModel {
    private $conn;
    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function register($name, $nric, $program, $password) {
        $stmt = $this->conn->prepare("INSERT INTO students (name,nric,program,password) VALUES (?,?,?,?)");
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bind_param("ssss", $name, $nric, $program, $hash);
        return $stmt->execute();
    }

    public function login($nric, $password) {
        $stmt = $this->conn->prepare("SELECT * FROM students WHERE nric=?");
        $stmt->bind_param("s", $nric);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        if ($row && password_verify($password, $row['password'])) {
            return $row;
        }
        return false;
    }

    public function getStudent($id) {
        $stmt = $this->conn->prepare("SELECT * FROM students WHERE id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function updatePassword($id, $old, $new) {
        $student = $this->getStudent($id);
        if (!password_verify($old, $student['password'])) return false;
        $hash = password_hash($new, PASSWORD_DEFAULT);
        $stmt = $this->conn->prepare("UPDATE students SET password=? WHERE id=?");
        $stmt->bind_param("si", $hash, $id);
        return $stmt->execute();
    }

    public function updateStudent($id, $name, $nric, $program, $marks) {
        $stmt = $this->conn->prepare("UPDATE students SET name=?, nric=?, program=?, marks=? WHERE id=?");
        $stmt->bind_param("sssii", $name, $nric, $program, $marks, $id);
        return $stmt->execute();
    }

    public function deleteStudent($id) {
        $stmt = $this->conn->prepare("DELETE FROM students WHERE id=?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function getAllStudents() {
        $result = $this->conn->query("SELECT * FROM students");
        return $result->fetch_all(MYSQLI_ASSOC);


    }
    public function updateProfilePic($id, $filename) {
        $stmt = $this->conn->prepare("UPDATE students SET profile_pic=? WHERE id=?");
        $stmt->bind_param("si", $filename, $id);
        return $stmt->execute();
    }
}
?>
