<?php
include 'db.php';
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $department = $_POST['department'];
    $fee = $_POST['fee'];
    $sql = "INSERT INTO users (name, email, department, fee, phone) VALUES ('$name', '$email', '$department', '$fee', '$phone')";
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h2>Add New Student</h2>
    <form action="" method="POST">
        <label for="name">Name:</label>
        <input type="text" name="name" required>
        <label for="email">Email:</label>
        <input type="email" name="email" required>
        
        <label for="department">Department:</label>
        <input type="text" name="department" required>
        <label for="fee">Fee:</label>
        <input type="number" name="fee" required>
        <label for="phone">Phone:</label>
        <input type="text" name="phone">
        <input type="submit" name="submit" value="Submit">
        <a href="index.php" class="back-link">Cancel</a>
    </form>
</div>
</body>
</html>
