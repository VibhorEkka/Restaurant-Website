<?php
include('files/db.php'); // Include your database connection file

if (isset($_GET['sno'])) {
    $sno = $_GET['sno'];

    // Fetch the current data for the specified record
    $sql = "SELECT * FROM `booking` WHERE `s.no` = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $sno);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row) {
        $name = $row['name'];
        $phone = $row['phone'];
        $date = $row['date'];
        $time = $row['time'];
        $persons = $row['persons'];
        $email = $row['email'];
    } else {
        echo "Record not found.";
        exit();
    }

    $stmt->close();
} else {
    echo "No record specified to update.";
    exit();
}

// Handle form submission to update the data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $persons = $_POST['persons'];
    $email = $_POST['email'];

    // Prepare the SQL update statement
    $sql = "UPDATE `booking` SET `name` = ?, `phone` = ?, `date` = ?, `time` = ?, `persons` = ?, `email` = ? WHERE `s.no` = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssssisi', $name, $phone, $date, $time, $persons, $email, $sno);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect to adminpanel.php after successful update
        header("Location: adminpanel.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Booking</title>
    <!-- Bootstrap CSS -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Update Booking</h2>
        <form action="update.php?sno=<?php echo $sno; ?>" method="post">
            <div class="mb-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text" id="name" name="name" class="form-control" value="<?php echo $name; ?>" required>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone No.:</label>
                <input type="text" id="phone" name="phone" class="form-control" value="<?php echo $phone; ?>" required>
            </div>
            <div class="mb-3">
                <label for="date" class="form-label">Date:</label>
                <input type="date" id="date" name="date" class="form-control" value="<?php echo $date; ?>" required>
            </div>
            <div class="mb-3">
                <label for="time" class="form-label">Time:</label>
                <input type="time" id="time" name="time" class="form-control" value="<?php echo $time; ?>" required>
            </div>
            <div class="mb-3">
                <label for="persons" class="form-label">Persons:</label>
                <input type="number" id="persons" name="persons" class="form-control" value="<?php echo $persons; ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" id="email" name="email" class="form-control" value="<?php echo $email; ?>" required>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
    <!-- Bootstrap JS and dependencies -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>