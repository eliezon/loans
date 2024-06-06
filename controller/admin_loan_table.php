<?php include_once '../controller/all_loan.php'; ?>
<div class="admin_loans" id="admin_loans">
    <div>
        <p style="font-size:40px;margin-top:0">Loan Transactions</p>
    </div>
    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Date</th>
                <th>Transaction ID</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Note</th>
                <th>Option</th>
            </tr>
        </thead>
        <tbody>
            <?php
                if ($users_result->num_rows > 0) {
                    $counter = 1;
                    while ($row = $users_result->fetch_assoc()) {
                        $row = array_map('htmlspecialchars', $row);
                        echo "<tr>";
                        echo "<td>" . $counter . "</td>";
                        echo "<td>" . $row['date'] . "</td>";
                        echo "<td>" . $row['transaction_id'] . "</td>";
                        echo "<td>" . $row['amount'] . "</td>";
                        echo "<td>" . $row['status'] . "</td>";
                        echo "<td>" . $row['note'] . "</td>";
                        echo "<td><a href='#' onclick='showInfo(" . json_encode($row) . ")'>View</a></td>";  
                        echo "</tr>";
                        $counter++;
                    }
                    
                } else {
                    echo "<tr><td colspan='7'>No users found</td></tr>";
                }
            ?>
        </tbody>
    </table>
    <p style="border-bottom:1px solid rgb(143, 143, 143); width:100%;margin-top:0"></p>
    <p class="hr"></p>
    <div style="display:flex;justify-content:space-between;align-items:center">
        <div class="user-table-btn">
            <?php 
                // Count the number of rows in $users_result
                $rowCount = $users_result->num_rows;
                echo "<p class='entries'>Showing 1 to $rowCount of $rowCount entries</p>";
            ?>
        </div>
        <div class="pages">
            <button>Prev</button>
            <p>1</p>
            <button>Next</button>
        </div>
    </div>
</div>

<div id="userModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <div style="width:100%;padding-bottom:95px;background-color:#105f77;position:absolute;left:0;top:40px"></div>
        <div style="display:flex;align-items:center;gap:20px">
            <img id="modalProfileImg" style="z-index:20"/>
            <h1 id="modalName" style="color:white;z-index:20"></h1>
        </div>
        <div style="display:flex;gap:50px">
            <div>
                <p>Account Type: <span id="modalAccType"></span></p>
                <p>Email: <span id="modalEmail"></span></p>
                <p>Phone: <span id="modalPhone"></span></p>
                <p>Address: <span id="modalAddress"></span></p>
                <p>Birthdate: <span id="modalBirthdate"></span></p>
                <p>Gender: <span id="modalGender"></span></p>
                <p>Age: <span id="modalAge"></span></p>
            </div>
            <div>
                <p>Bank Name: <span id="modalBankName"></span></p>
                <p>Bank Account: <span id="modalBankAccount"></span></p>
                <p>Card Holder: <span id="modalCardHolder"></span></p>
                <p>TIN Number: <span id="modalTinNumber"></span></p>
                <p>Company Working: <span id="modalCompanyWorking"></span></p>
            </div>
            <div>
                <p>Company Name: <span id="modalCompanyName"></span></p>
                <p>Company Address: <span id="modalCompanyAddress"></span></p>
                <p>Company Contact: <span id="modalCompanyContact"></span></p>
                <p>Position: <span id="modalPosition"></span></p>
                <p>Money Earnings: <span id="modalMoneyEarnings"></span></p>
            </div>
        </div>
        <br><br>
        <div style="display:flex;gap:50px" class="asdasd">
            <div>
                <img id="modalProofOfBilling" class="clickable-image"/>
                <p><span>Proof of Billing</span></p>
            </div>
            <div>
                <img id="modalValidId" class="clickable-image"/>
                <p><span>Valid ID</span></p>
            </div>
            <div>
                <img id="modalCoe" class="clickable-image"/>
                <p><span>COE</span></p>
            </div>
        </div>
        <form id="loanStatusForm" action="../controller/update_loan_status.php" method="post">
            <input type="hidden" name="transaction_id" id="modalTransactionId">
            <input type="hidden" name="note" id="note" value="None">
            <div style="display:flex;justify-content:end" class="uhaha">
                <button type="submit" name="status" value="Rejected">Reject</button>
                <button type="submit" name="status" value="Approved">Approve</button>
            </div>
        </form>
        <div id="rejectModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>Reject Loan</h2>
                <form id="rejectForm" action="../controller/update_loan_status.php" method="post">
                    <input type="hidden" name="transaction_id" id="rejectTransactionId">
                    <textarea name="note" id="rejectNote" placeholder="Enter rejection note..." rows="4" required></textarea>
                    <input type="hidden" name="status" value="Rejected">
                    <button type="submit">Reject</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="imageModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <img id="imageModalContent" style="width: 100%;" />
    </div>
</div>

<script>
    function showRejectModal(transactionId) {
        document.getElementById("rejectTransactionId").value = transactionId;
        var rejectModal = document.getElementById('rejectModal');
        rejectModal.style.display = "block";

        var span = document.getElementsByClassName("close")[1];
        span.onclick = function() {
            rejectModal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == rejectModal) {
                rejectModal.style.display = "none";
            }
        }
    }

    function showInfo(user) {
        document.getElementById('modalAccType').innerText = user.acc_type;
        document.getElementById('modalName').innerText = user.full_name;
        document.getElementById('modalEmail').innerText = user.email;
        document.getElementById('modalPhone').innerText = user.phone;
        document.getElementById('modalAddress').innerText = user.address;
        document.getElementById('modalBirthdate').innerText = user.birthdate;
        document.getElementById('modalGender').innerText = user.gender;
        document.getElementById('modalAge').innerText = user.age;
        document.getElementById('modalBankName').innerText = user.bank_name;
        document.getElementById('modalBankAccount').innerText = user.bank_account;
        document.getElementById('modalCardHolder').innerText = user.card_holder;
        document.getElementById('modalTinNumber').innerText = user.tin_number;
        document.getElementById('modalCompanyWorking').innerText = user.company_working;
        document.getElementById('modalCompanyName').innerText = user.company_name;
        document.getElementById('modalCompanyAddress').innerText = user.company_address;
        document.getElementById('modalCompanyContact').innerText = user.company_contact;
        document.getElementById('modalPosition').innerText = user.position;
        document.getElementById('modalMoneyEarnings').innerText = user.money_earnings;
        document.getElementById('modalProofOfBilling').src = user.proof_of_billing;
        document.getElementById('modalValidId').src = user.valid_id;
        document.getElementById('modalCoe').src = user.coe;
        document.getElementById('modalProfileImg').src = user.profile_img;

        // Set the transaction_id in the hidden input field
        document.getElementById('modalTransactionId').value = user.transaction_id;

        // Show or hide buttons based on loan status
        const approveButton = document.querySelector('button[name="status"][value="Approved"]');
        const rejectButton = document.querySelector('button[name="status"][value="Rejected"]');
        if (user.status === 'Approved' || user.status === 'Rejected') {
            approveButton.style.display = 'none';
            rejectButton.style.display = 'none';
        } else {
            approveButton.style.display = 'inline-block';
            rejectButton.style.display = 'inline-block';
        }

        var modal = document.getElementById('userModal');
        modal.style.display = "flex";

        var span = document.getElementsByClassName("close")[0];
        span.onclick = function() {
            modal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    }

    function showImageModal(src) {
        var imageModal = document.getElementById('imageModal');
        var imageModalContent = document.getElementById('imageModalContent');
        imageModalContent.src = src;
        imageModal.style.display = "flex";
      

        var span = document.getElementsByClassName("close")[2];
        span.onclick = function() {
            imageModal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == imageModal) {
                imageModal.style.display = "none";
            }
        }
    }

    document.querySelectorAll('.clickable-image').forEach(image => {
        image.onclick = function() {
            showImageModal(this.src);
        };
    });
</script>

<link rel="stylesheet" href="../view/admin_loan_table.css">
