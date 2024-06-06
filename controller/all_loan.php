<?php
// Connect to the database
$conn = $database->connect();

// Fetch user loans and associated user name from the database
$sql = "
SELECT 
    loans.l_id, 
    loans.id AS id,
    loans.date, 
    loans.transaction_id, 
    loans.amount, 
    loans.status, 
    loans.note,
    CONCAT(users.f_name, ' ', users.l_name) AS full_name, 
    users.acc_type, 
    users.email, 
    users.phone, 
    users.address, 
    users.birthdate,
    users.gender,
    users.age,
    users.bank_name,
    users.bank_account,
    users.card_holder,
    users.tin_number,
    users.company_working,
    users.company_name,
    users.company_address,
    users.company_contact,
    users.position,
    users.money_earnings,
    users.proof_of_billing,
    users.valid_id,
    users.coe,
    users.profile_img
FROM loans 
JOIN users ON loans.id = users.id";

$users_result = $conn->query($sql);

$conn->close();
?>
