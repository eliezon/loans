<?php
include "../model/database.php";

// Set the default timezone to the Philippines
date_default_timezone_set('Asia/Manila');

// Connect to the database
$conn = $database->connect();

// Get the transaction ID, new status, and note from the POST data
$transaction_id = isset($_POST['transaction_id']) ? $_POST['transaction_id'] : '';
$status = isset($_POST['status']) ? $_POST['status'] : '';
$note = isset($_POST['note']) ? $_POST['note'] : 'None'; // Set default note value

if (empty($transaction_id) || empty($status)) {
    echo "Invalid request.";
    exit;
}

// Start transaction
$conn->begin_transaction();

try {
    // Update the loan status and note in the database
    $sql = "UPDATE loans SET status = ?, note = ? WHERE transaction_id = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("sss", $status, $note, $transaction_id);
        if ($stmt->execute()) {
            $stmt->close(); // Close the statement after execution
            
            if ($status == 'Approved') {
                // Fetch the loan details to insert into the billing table
                $loan_sql = "SELECT l_id, id, date, amount, payable_months FROM loans WHERE transaction_id = ?";
                if ($loan_stmt = $conn->prepare($loan_sql)) {
                    $loan_stmt->bind_param("s", $transaction_id);
                    $loan_stmt->execute();
                    $loan_stmt->bind_result($l_id, $user_id, $date, $amount, $payable_months);
                    if ($loan_stmt->fetch()) {
                        $loan_stmt->close(); // Close the loan statement after fetching data
                        
                        // Check if a billing record already exists for this loan
                        $check_billing_sql = "SELECT COUNT(*) FROM billings WHERE l_id = ?";
                        if ($check_stmt = $conn->prepare($check_billing_sql)) {
                            $check_stmt->bind_param("i", $l_id);
                            $check_stmt->execute();
                            $check_stmt->bind_result($billing_count);
                            $check_stmt->fetch();
                            $check_stmt->close();

                            if ($billing_count > 0) {
                                throw new Exception("Billing record already exists for this loan.");
                            }
                        } else {
                            throw new Exception("Failed to prepare billing check SQL statement.");
                        }

                        $interest = $amount * 0.03;
                        $penalty = 0; // Penalty is 2% of loaned amount
                        // $penalty = $amount * 0.02; // Penalty is 2% of loaned amount
                        $received_amount = $amount - $interest;
                        $amount_to_pay = $amount + $penalty; // Total amount to pay
                        $due_date = date('Y-m-d', strtotime($date. ' + ' . $payable_months . ' months'));
                        $b_date = date('Y-m-d');
                        $b_status = 'N/A';

                        // Insert into billing table
                        $billing_sql = "INSERT INTO billings (id, l_id, b_date, loaned_amount, interest, penalty, received_amount, amount_to_pay, due_date, b_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                        if ($billing_stmt = $conn->prepare($billing_sql)) {
                            $billing_stmt->bind_param("iissdddsss", $user_id, $l_id, $b_date, $amount, $interest, $penalty, $received_amount, $amount_to_pay, $due_date, $b_status);
                            if ($billing_stmt->execute()) {
                                $billing_stmt->close(); // Close the billing statement after execution
                                
                                // Commit transaction if everything is successful
                                $conn->commit();
                                echo "Loan status updated and billing record created successfully.";
                                header("Location: ../view/admin_dashboard.php");
                                exit;
                            } else {
                                $billing_stmt->close(); // Ensure statement is closed even if an error occurs
                                throw new Exception("Failed to insert billing record.");
                            }
                        } else {
                            throw new Exception("Failed to prepare billing SQL statement.");
                        }
                    } else {
                        $loan_stmt->close(); // Ensure statement is closed even if an error occurs
                        throw new Exception("Failed to fetch loan details.");
                    }
                } else {
                    throw new Exception("Failed to prepare loan details SQL statement.");
                }
            } else {
                // Commit transaction if loan status is not approved
                $conn->commit();
                echo "Loan status updated successfully.";
                header("Location: ../view/admin_dashboard.php");
                exit;
            }
        } else {
            $stmt->close(); // Ensure statement is closed even if an error occurs
            throw new Exception("Failed to update loan status.");
        }
    } else {
        throw new Exception("Failed to prepare loan status update SQL statement.");
    }
} catch (Exception $e) {
    // Rollback transaction if any query fails
    $conn->rollback();
    echo $e->getMessage();
}

$conn->close();
?>
