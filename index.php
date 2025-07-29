<?php
$stmt = null;
$error = null;

$host = 'localhost';
$dbname = 'student_db';
$user = 'root';
$pass = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // ดึงข้อมูลนักเรียน
    $stmt = $conn->prepare("SELECT * FROM students");
    $stmt->execute();
} catch (PDOException $e) {
    $error = "เกิดข้อผิดพลาด: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>รายชื่อนักเรียน</title>
</head>
<body>

<h2>รายชื่อนักเรียน</h2>

<?php if ($error): ?>
    <p><?php echo $error; ?></p>
<?php elseif ($stmt): ?>
    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>ProfileImage</th>
            <th>StudentID</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Class</th>
            <th>Manage</th>
        </tr>
        <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><img src="uploads/<?php echo $row['profile_image']; ?>" width="50" height="50"></td>
                <td><?php echo $row['student_id']; ?></td>
                <td><?php echo $row['full_name']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['class']; ?></td>
                <td>
                    <a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a> |
                    <a href="delete.php?id=<?php echo $row['id']; ?>" onclick="return confirm('ลบข้อมูลนี้?');">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
<?php else: ?>
    <p>ไม่มีข้อมูลนักเรียน</p>
<?php endif; ?>

<a href="add.php">เพิ่มผู้ใช้</a>

</body>
</html>
