<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "loan";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Assuming you have a user_id variable from the session or a request
$user_id = 1; // Replace this with the actual user_id

// Fetch all savings for the current user
$users_sql = "SELECT s_date, s_transaction_id, category, s_amount, current_amount, s_status FROM savings WHERE s_id = ?";
$stmt = $conn->prepare($users_sql);
$stmt->bind_param("i", $user_id);

if ($stmt->execute()) {
    $users_result = $stmt->get_result();
} else {
    echo "Failed to execute the SQL statement: " . $stmt->error;
}
$stmt->close();
$conn->close();
?>
