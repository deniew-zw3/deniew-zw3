<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the ID from the POST request
    $id = $_POST['id'];

    // Prepare the SQL statement to delete the record
    $stmt = $conn->prepare("DELETE FROM deniew3ite WHERE id = ?");
    
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }

    $stmt->bind_param("i", $id);

    // Execute the query
    if ($stmt->execute()) {
        // Redirect to the main page with a success parameter
        header("Location: index.php?deleted=1");
        exit(); // Ensure the script stops executing after redirect
    } else {
        die('Execute failed: ' . htmlspecialchars($stmt->error));
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    // If not a POST request, redirect back to the main page
    header("Location: index.php");
    exit(); // Ensure the script stops executing after redirect
}
?>
