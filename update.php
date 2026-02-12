<?php
include 'db.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM users WHERE id=$id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name = $row['name'];
        $email = $row['email'];
        $department = $row['department'];
        $fee = $row['fee'];
        $phone = $row['phone'];
    } else {
        header("Location: index.php");
        exit();
    }
}
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $department = $_POST['department'];
    $fee = $_POST['fee'];
    $phone = $_POST['phone'];
    $sql = "UPDATE users SET name='$name', email='$email', department='$department', fee='$fee', phone='$phone' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Student</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Specific override for update page to center form */
        .form-container { width: 50%; margin: 20px auto; padding: 20px; border: 1px solid #ddd; border-radius: 8px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: 500; }
        .btn-submit { background-color: var(--primary-color); color: white; width: 100%; }
        .btn-submit:hover { opacity: 0.9; }
    </style>
</head>
<body>
<div class="container">
    <h2>Update Student</h2>
    <div class="form-container">
        <form action="" method="POST">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" value="<?php echo $name; ?>" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="<?php echo $email; ?>" required>
            </div>
            <div class="form-group">
                <label>Department</label>
                <input type="text" name="department" value="<?php echo $department; ?>" required>
            </div>
            <div class="form-group">
                <label>Fee</label>
                <input type="number" name="fee" value="<?php echo $fee; ?>" required>
            </div>
             <div class="form-group">
                <label>Phone</label>
                <input type="text" name="phone" value="<?php echo $phone; ?>">
            </div>
            <input type="submit" name="update" value="Update" class="btn-submit">
            <a href="index.php" style="display:block; text-align:center; margin-top:10px; text-decoration:none; color:#333;">Cancel</a>
        </form>
    </div>
</div>
</body>
</html>
