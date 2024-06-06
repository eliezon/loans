<?php include_once '../controller/fetch_admin_savings.php'; ?>
<div class="admin_savings" id="admin_savings">
                    
    <div>
        <p style="font-size:40px;margin-top:0">Savings Transactions</p>
    </div>
        

    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Date</th>
                <th>Transaction ID</th>
                <th>Category</th>
                <th>Amount</th>
                <th>Current amount</th>
                <th>Status</th>
                <th>Action</th>
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
                        echo "<td>" . $row['s_date'] . "</td>";
                        echo "<td>" . $row['s_transaction_id'] . "</td>";
                        echo "<td>" . $row['category'] . "</td>";
                        echo "<td>" . $row['s_amount'] . "</td>";
                        echo "<td>" . $row['current_amount'] . "</td>";
                        echo "<td>" . $row['s_status'] . "</td>";
                        echo "<td><select style='font-size:15px'>
                        <option>Completed</option>
                        <option>Rejected</option>
                        <option>Failed</option>
                        </select></td>";
                        echo "</tr>";
                        $counter++;
                    }
                    
                } else {
                    echo "<tr><td colspan='9'>No savings found</td></tr>";
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
    