<?php
include('files/db.php'); // Include your database connection file

if (isset($_GET['sno'])) {
    $sno = $_GET['sno'];

    // Prepare the SQL delete statement
    $sql = "DELETE FROM `booking` WHERE `s.no` = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $sno);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect to adminpanel.php after successful deletion
        header("Location: adminpanel.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo "No record specified to delete.";
}
?>