<?php
$host = 'localhost';
$dbname = 'student_db';
$user = 'root';
$pass = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // ลบข้อมูล
        $stmt = $conn->prepare("DELETE FROM students WHERE id = ?");
        $stmt->execute([$id]);

        // กลับไปหน้า index
        header("Location: index.php");
        exit;
    } else {
        echo "ไม่พบรหัสนักเรียน (ID)";
    }
} catch (PDOException $e) {
    echo "เกิดข้อผิดพลาด: " . $e->getMessage();
}
