<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>เพิ่มผู้ใช้</title>
</head>
<body>
    <h2>เพิ่มผู้ใช้</h2>
    <form action="db.php" method="post" enctype="multipart/form-data">
        <p>Student ID: <input type="text" name="student_id" required></p>
        <p>Full Name: <input type="text" name="full_name" required></p>
        <p>Email: <input type="email" name="email" required></p>
        <p>Class: <input type="text" name="class" required></p>
        <p>Profile Image: <input type="file" name="profile_image"></p>
        <p><input type="submit" value="บันทึก"></p>
    </form>
    <p><a href="index.php">← กลับ</a></p>
</body>
</html>
