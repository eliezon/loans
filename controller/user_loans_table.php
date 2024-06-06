<?php include_once '../controller/loans.php' ?>

<div class="loans" id="loans">
                    
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
            <th>Payable Months</th>
            <th>Status</th>
            <th>Note</th>
        </tr>
        </thead>
        
        <tbody>
        <?php
            if ($users_result->num_rows > 0) {
                $counter = 1;
                while ($row = $users_result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $counter . "</td>";
                    echo "<td>" . htmlspecialchars($row['date']) .  "</td>";
                    echo "<td>" . htmlspecialchars($row['transaction_id']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['amount']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['payable_months']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['status']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['note']) . "</td>";
                    echo "</tr>";
                    $counter++;
                }
            } else {
                echo "<tr><td colspan='8'>No loans found</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <p style="border-bottom:1px solid rgb(143, 143, 143); width:100%;margin-top:0"></p>
    
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

    <div class="loans-btn">
        <button onclick="showAddLoan()">New</button>
    </div>
    

    </div>
    