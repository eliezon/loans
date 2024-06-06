<?php


// Check if user is not logged in
if (!isset($_SESSION["id"])) {
    // Redirect user to login page
    header("location: login_page.php");
    exit;
}

include_once '../model/database.php';

// Connect to the database
$conn = $database->connect();

// Get the user ID from session
$user_id = $_SESSION['id'];

// Fetch user billing data from the database
$sql =  "SELECT b.b_id, b.b_date, l.transaction_id, b.loaned_amount, b.interest, b.penalty, b.received_amount, b.amount_to_pay, b.due_date, b.b_status 
FROM billings b
INNER JOIN loans l ON b.l_id = l.l_id
WHERE l.id = ?";


if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("i", $user_id);
    if ($stmt->execute()) {
        $stmt->store_result();
        if ($stmt->num_rows == 1) {
            $stmt->bind_result($b_id, $b_date, $transaction_id, $loaned_amount, $interest, $penalty, $received_amount, $amount_to_pay, $due_date, $b_status);
          
        }
    } else {
        echo "Failed to execute the SQL statement.";
    }
    $stmt->close();
} else {
    echo "Failed to prepare the SQL statement.";
}



// Fetch all loans for the current user
$users_sql ="SELECT b.b_id, b.b_date, l.transaction_id, b.loaned_amount, b.interest, b.penalty, b.received_amount, b.amount_to_pay, b.due_date, b.b_status 
FROM billings b
INNER JOIN loans l ON b.l_id = l.l_id
WHERE l.id = ?";
$stmt = $conn->prepare($users_sql);
$stmt->bind_param("i", $user_id); // Assuming user_id is an integer, adjust the type accordingly
if ($stmt->execute()) {
    $users_result = $stmt->get_result();
    // Further processing of the result
} else {
    echo "Failed to execute the SQL statement: " . $stmt->error;
}
$stmt->close();

$conn->close();
?>