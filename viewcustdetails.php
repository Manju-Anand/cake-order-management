<?php
// Include your database connection file
include "includes/connection.php";

// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve recordId from the POST request
    $recordId = $_POST['recordId'];

    // Validate and sanitize the recordId (you should customize this based on your requirements)

    // Example validation: Ensure recordId is a number
    if (!is_numeric($recordId)) {
        die('Error: Invalid record ID.');
    }

    // Perform database query to fetch data
    $sql = "SELECT * FROM customers WHERE id = ?";
    $stmt = $connection->prepare($sql);
    
    // Bind parameter
    $stmt->bind_param('i', $recordId);

    // Execute the statement
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Check if a row is fetched
    if ($row = $result->fetch_assoc()) {
        // Return data as JSON
        header('Content-Type: application/json');
        echo json_encode($row);
    } else {
        // No matching record found
        echo 'Error: No data found for the given record ID.';
    }

    // Close the statement
    $stmt->close();
    
    // Close the database connection
    $connection->close();
} else {
    // If the request is not a POST request, return an error
    die('Error: Invalid request method.');
}
?>
