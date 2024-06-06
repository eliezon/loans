<?php
include "../model/database.php";

// Connect to the database
$conn = $database->connect();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all necessary fields are set
    if (isset($_POST["billing_id"]) && isset($_POST["status"])) {
        // Sanitize the input data
        $billing_id = intval($_POST["billing_id"]); // Ensure it's an integer
        $status = $conn->real_escape_string($_POST["status"]); // Escape the status input

        // Prepare the update query
        $sql = "UPDATE billings SET b_status = ? WHERE b_id = ?";
        $stmt = $conn->prepare($sql);
        
        // Bind parameters
        $stmt->bind_param("si", $status, $billing_id);
        
        // Execute the update query
        if ($stmt->execute()) {
            echo "Billing status updated successfully.";
        } else {
            echo "Error updating billing status: " . $conn->error;
        }

        // Close the database connection
        $stmt->close();
        $conn->close();
    } else {
        echo "Missing parameters.";
    }
} else {
    echo "Invalid request.";
}
?>
