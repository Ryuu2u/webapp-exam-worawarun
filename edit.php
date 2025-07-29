<?php
$host = 'localhost';
$dbname = 'student_db';
$user = 'root';
$pass = '';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM students WHERE id = ?");
$stmt->execute([$id]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="th">
<body>
    <h2>แก้ไขผู้ใช้</h2>
   <form action="db.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $row['id'] ?>">
        <p>Student ID: <input type="text" name="student_id" value="<?= $row['student_id'] ?>"></p>
        <p>Full Name: <input type="text" name="full_name" value="<?= $row['full_name'] ?>"></p>
        <p>Email: <input type="email" name="email" value="<?= $row['email'] ?>"></p>
        <p>Class: <input type="text" name="class" value="<?= $row['class'] ?>"></p>
        <p>Change Image: <input type="file" name="profile_image"></p>
        <p><input type="submit" value="บันทึก"> <a href="index.php">ยกเลิก</a></p>
    </form>
</body>
</html>
