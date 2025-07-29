<?php
$host = 'localhost';
$dbname = 'student_db';
$user = 'root';
$pass = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $id = $_POST['id'] ?? null;
    $student_id = $_POST['student_id'];
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $class = $_POST['class'];

    $imageName = 'default.png';
    if (!empty($_FILES['profile_image']['name'])) {
        $imageName = basename($_FILES['profile_image']['name']);
        move_uploaded_file($_FILES['profile_image']['tmp_name'], "uploads/" . $imageName);
    }

    if ($id) {
        if (!empty($_FILES['profile_image']['name'])) {
            $stmt = $conn->prepare("UPDATE students SET student_id=?, full_name=?, email=?, class=?, profile_image=? WHERE id=?");
            $stmt->execute([$student_id, $full_name, $email, $class, $imageName, $id]);
        } else {
            $stmt = $conn->prepare("UPDATE students SET student_id=?, full_name=?, email=?, class=? WHERE id=?");
            $stmt->execute([$student_id, $full_name, $email, $class, $id]);
        }
    } else {
        $stmt = $conn->prepare("INSERT INTO students (student_id, full_name, email, class, profile_image)
                                VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$student_id, $full_name, $email, $class, $imageName]);
    }

    header("Location: index.php");
    exit;
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
