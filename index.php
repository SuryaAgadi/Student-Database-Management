<?php
include 'db.php';
// Handle Create Submission
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $department = $_POST['department'];
    $fee = $_POST['fee'];
    $phone = $_POST['phone'];
    $sql = "INSERT INTO users (name, email, department, fee, phone) VALUES ('$name', '$email', '$department', '$fee', '$phone')";
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h2>Student Management System</h2>
    <!-- Add Student Form -->
    <div class="form-container">
        <h3>Add Student</h3>
        <form action="" method="POST">
            <div class="form-row">
                <div class="form-group">
                    <input type="text" name="name" placeholder="Name" required>
                </div>
                <div class="form-group">
                    <input type="email" name="email" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <input type="text" name="department" placeholder="Department" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <input type="number" name="fee" placeholder="Fee" required>
                </div>
                <div class="form-group">
                     <input type="text" name="phone" placeholder="Phone">
                </div>
                <!-- Empty div for alignment if needed, or button expands -->
                <div class="form-group" style="flex: 0 0 auto;">
                    <input type="submit" name="submit" value="Submit" class="btn-submit">
                </div>
            </div>
        </form>
    </div>
    <!-- Search Bar -->
    <div class="search-container">
        <form action="" method="GET" class="search-form">
            <input type="text" name="search" class="search-input" placeholder="Search by Name or Email..." value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
            <button type="submit" class="btn-search">Search</button>
            <?php if(isset($_GET['search'])): ?>
                <a href="index.php" class="btn" style="background:#6c757d; color:white; text-decoration:none; padding:8px 16px; border-radius:4px;">Clear</a>
            <?php endif; ?>
        </form>
    </div>
    <!-- Student List Table -->
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Dept</th>
                <th>Fee</th>
                <th>Phone</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $search = isset($_GET['search']) ? $_GET['search'] : '';
            if ($search) {
                $sql = "SELECT * FROM users WHERE name LIKE '%$search%' OR email LIKE '%$search%' OR department LIKE '%$search%'";
            } else {
                $sql = "SELECT * FROM users";
            }
            
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>" . $row["id"] . "</td>
                        <td>" . $row["name"] . "</td>
                        <td>" . $row["email"] . "</td>
                        <td>" . $row["department"] . "</td>
                        <td>" . $row["fee"] . "</td>
                        <td>" . $row["phone"] . "</td>
                        <td>
                            <a href='update.php?id=" . $row["id"] . "' class='btn btn-edit'>Edit</a>
                            <a href='delete.php?id=" . $row["id"] . "' class='btn btn-delete' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                        </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='7' style='text-align:center'>No records found</td></tr>";
            }
            $conn->close();
            ?>
        </tbody>
    </table>
</div>
</body>
</html>