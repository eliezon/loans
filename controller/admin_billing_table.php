<?php include_once '../controller/user_billings.php'; ?>
<div class="admin_billing" id="admin_billing">
    <div>
        <p style="font-size:40px;margin-top:0">Billing Summary</p>

        <select name="year" id="year" style="font-size:15px;width:100px;padding:7px" onchange="fetchBillings()">
            <option value="">Year</option>
            <?php
            $currentYear = date("Y");
            $startYear = $currentYear - 100;
            for ($i = $currentYear; $i >= $startYear; $i--) {
                $selected = ($i == 2024) ? "selected" : ""; // Check if current year matches 2024
                echo '<option value="' . $i . '" ' . $selected . '>' . $i . '</option>';
            }
            ?>
        </select>

        <select name="month" id="month" style="font-size:15px;width:100px;padding:7px" onchange="fetchBillings()">
            <option value="">Month</option>
            <?php
            for ($i = 1; $i <= 12; $i++) {
                $selected = ($i == 6) ? "selected" : ""; // Check if current month is June
                echo '<option value="' . $i . '" ' . $selected . '>' . date("F", mktime(0, 0, 0, $i, 1)) . '</option>';
            }
            ?>
        </select>
    </div>
    <br>
    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Date Generated</th>
                <!-- <th>Transaction ID</th> -->
                <th>Option</th>
            </tr>
        </thead>
        <tbody>
        <?php
        if ($users_result->num_rows > 0) {
            $counter = 1;
            while ($row = $users_result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $counter . "</td>";
                echo "<td>" . htmlspecialchars($row['b_date']) . "</td>";
                echo "<td><a href='#' onclick='viewBilling(".json_encode($row).")'>View</a></td>";
                echo "</tr>";
                $counter++;
            }
        } else {
            echo "<tr><td colspan='12'>No bills to pay</td></tr>";
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

<!-- Modal -->
<div id="billingModal" class="modal">
  <div class="modal-content" id="mcontent">

    <span class="close" onclick="closeBillingSummary()">&times;</span>
    <div id="billingModalBody">
      <!-- Billing information displayed here -->
    </div>
    <div id="billingAction">
      <form id="billingForm" action="../controller/update_billing_status.php" method="post">
        <input type="hidden" name="billing_id" id="billing_id"><br>
        <label for="status">Update Status:</label>
        <select name="status" id="status" style="padding:7px; font-size:15px;margin-top:5px">
          <option value="Overdue">Overdue</option>
          <option value="Completed">Completed</option>
        </select>
        <button type="submit" style="font-size:15px;margin-top:10px;padding:7px;background-color:#105f77;color:white;cursor:pointer;border:none;z-index:10" id="billing-btn">Update</button>
      </form>
    </div>
  </div>
</div>

<script>
// Get the modal
var modal = document.getElementById("billingModal");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

function viewBilling(billingData) {
  var modalBody = document.getElementById("billingModalBody");
  modalBody.innerHTML = "";
  modalBody.innerHTML += "<img src='" + billingData['profile_img'] + "' class='zxc'>";
  modalBody.innerHTML += "<p>Full Name: <span>" + billingData['full_name'] + "</span></p>";
  modalBody.innerHTML += "<p>Transaction ID: <span>" + billingData['transaction_id'] + "</span></p>";
  modalBody.innerHTML += "<p>Account Type:<span> " + billingData['acc_type'] + "</span></p>";
  modalBody.innerHTML += "<p>Loaned Amount:<span> " + billingData['loaned_amount'] + "</span></p>";
  modalBody.innerHTML += "<p>Received Amount:<span> " + billingData['received_amount'] + "</span></p>";
  modalBody.innerHTML += "<p>Interest:<span> " + billingData['interest'] + "</span></p>";
  modalBody.innerHTML += "<p>Penalty:<span> " + billingData['penalty'] + "</span></p>";
  modalBody.innerHTML += "<p>Amount to Pay:<span> " + billingData['amount_to_pay'] + "</span></p>";
  modalBody.innerHTML += "<p>Due Date:<span> " + billingData['due_date'] + "</span></p>";
  modalBody.innerHTML += "<p>Billing Status:<span> " + billingData['b_status'] + "</span></p>";

  // Populate the hidden input field with billing_id
  document.getElementById("billing_id").value = billingData['b_id'];

  // Show or hide the select tag based on billing status
  var billingAction = document.getElementById("billingAction");
  if (billingData['b_status'] === 'Completed' || billingData['b_status'] === 'Overdue') {
    billingAction.style.display = 'none';
  } else {
    billingAction.style.display = 'block';
  }

  modal.style.display = "flex";
}

function closeBillingSummary() {
    modal.style.display = "none";
}

// JavaScript function to fetch billings based on selected year and month
function fetchBillings() {
    var year = document.getElementById("year").value;
    var month = document.getElementById("month").value;
    
    // AJAX request to fetch billings based on selected year and month
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.getElementById("admin_billing").innerHTML = xhr.responseText;
        }
    };
    xhr.open("GET", "../controller/user_billings.php?year=" + year + "&month=" + month, true);
    xhr.send();
}
</script>

<style>
  #billingModal p {
    display:flex;
    justify-content:space-between;
    border-bottom: 1px solid rgb(210,210,210);
  }

    #billing-btn:hover {
        background-color:#1d748f;
    }
.zxc {
    border-radius:50%;
    width: 100px;
    height:100px;
}
.modal {
  display: none;
  position: fixed;
  z-index: 1;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgba(0, 0, 0, 0.4);
  justify-content: center;
  align-items: center;
}


.modal-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  border-radius: 5px;
  width: 80%;
}
#mcontent {
    width: 400px;
}

.close {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}
</style>

<div id="billingModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <div id="billingModalBody"></div>
  </div>
</div>
