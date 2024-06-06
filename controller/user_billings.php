<?php
// Connect to the database
include '../model/mydatabase.php';
$conn = $database->connect();
// Fetch user loans and associated user name from the database
$sql = "
    SELECT 
        billings.b_id,
        billings.b_date,
        CONCAT(users.f_name, ' ', users.l_name) AS full_name, 
        users.acc_type AS acc_type,
        users.profile_img AS profile_img,
        loans.transaction_id AS transaction_id,
        loans.amount AS loaned_amount, 
        billings.interest, 
        billings.penalty, 
        billings.received_amount, 
        billings.amount_to_pay, 
        billings.due_date,
        billings.b_status
    FROM billings
    JOIN loans ON billings.l_id = loans.l_id
    JOIN users ON loans.id = users.id
    WHERE YEAR(billings.b_date) = ? AND MONTH(billings.b_date) = ?";

if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("ii", $selected_year, $selected_month); // Assuming $selected_year and $selected_month are obtained from the frontend
    if ($stmt->execute()) {
        // Rest of the code remains the same
    } else {
        echo "Failed to execute the SQL statement.";
    }
    $stmt->close();
} else {
    echo "Failed to prepare the SQL statement.";
}
    

// Fetch all loans with user names for the manage users section
$users_sql = "
    SELECT 
        billings.b_id,
        billings.b_date,
        CONCAT(users.f_name, ' ', users.l_name) AS full_name,
        users.acc_type AS acc_type,
        users.profile_img AS profile_img,
        loans.transaction_id AS transaction_id,
        loans.amount AS loaned_amount, 
        billings.interest, 
        billings.penalty, 
        billings.received_amount, 
        billings.amount_to_pay, 
        billings.due_date,
        billings.b_status
    FROM billings 
    JOIN loans ON billings.l_id = loans.l_id
    JOIN users ON loans.id = users.id";

$users_result = $conn->query($users_sql);

$conn->close();
?>