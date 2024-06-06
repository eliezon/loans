<!-- manage_users.php -->
<?php 
include_once '../controller/users.php';
include_once '../model/clean_up.php';

// Run cleanup function on page load
deleteExpiredRegistrations(); 
?>
<div class="manage_users" id="manage_users">
    <p style="font-size:40px;margin-top:0">List of Users</p>
   
    
    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Account Type</th>
                <th>Fullname</th>
                <th>Loans</th>
                <th>Savings</th>
                <th>Billings</th>
                <th>Status</th>
                <th>Option</th>
            </tr>
        </thead>
        <tbody>
        <?php
            if (count($Users) > 0) {
                $counter = 1;
                foreach ($Users as $row) {
                    // Check if the user_type is not "Admin"
                    if ($row['user_type'] !== 'Admin') {
                        echo "<tr>";
                        echo "<td>" . $counter . "</td>";
                        echo "<td>" . htmlspecialchars($row['acc_type']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['f_name'] . " " . $row['l_name']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['total_loans'] > 0 ? $row['total_loans'] : '0') . "</td>";
                        echo "<td>0</td>";
                        echo "<td>Billings</td>";
                        echo "<td>" . htmlspecialchars($row['registration_status'] ?? 'N/A') . "</td>";
                        echo "<td><a href='#' onclick='showViewInfo(" . json_encode($row) . ")'>View</a></td>";  
                        echo "</tr>";
                        $counter++; 
                    }
                }
            } else {
                echo "<tr><td colspan='9'>No users found</td></tr>";
            }
        ?>

        </tbody>
    </table>

    <p style="border-bottom:1px solid rgb(143, 143, 143); width:100%;margin-top:0"></p>
    <p class="hr"></p>
    <div style="display:flex;justify-content:space-between;align-items:center">
        <div class="user-table-btn">
            <p class="entries">Showing 1 to <?php echo count($Users) -1 ; ?> of <?php echo count($Users) -1; ?> entries</p>
        </div>
        <div class="pages">
            <button>Prev</button>
            <p>1</p>
            <button>Next</button>
        </div>
    </div>
</div>



<!-- Modal for viewing user details -->
<div id="view_info" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeViewInfo()">&times;</span>

        <div style="width:100%;padding-bottom:95px;background-color:#105f77;position:absolute;left:0;top:40px"></div>

        <form id="updateUserForm" method="POST" action="../controller/update_user.php" enctype="multipart/form-data">
            <!-- Container for profile image and full name -->
            <div class="profile-container">
                <!-- Image to trigger file selection -->
                <img src="" id="viewProfile"  style="width:130px;height:130px; cursor: pointer;" onclick="document.getElementById('insert_profile').click();">
                <!-- Full name display -->
                <div class="full-name" style="z-index:10">
                    <h1 id="viewFullName" style="z-index:10"></h1>

                    <div style="display:flex;align-items:center;gap:20px" class="abc">
                        <label for="" style="display:flex;gap:5px;align-items:center" id="gago" style="color:white">
                        <input type="radio" id="viewStatusActive" name="status" value="Active"> Active
                        </label>
                        <label for="" style="display:flex;gap:5px;align-items:center" id="gago1" style="color:white">
                        <input type="radio" id="viewStatusDisable" name="status" value="Disabled"> Disabled
                        </label>
                    </div>

                </div>
            </div>

            <div style="display:flex;justify-content:center;gap:20px">
                <div style="display:flex;flex-direction:column;width:100%">
                    <input type="hidden" id="userId" name="userId">
                    <div style="display:flex; gap:10px;align-items:center" class="blabla">
                        <p for=""><strong>Account Type:</strong></p>
                        <label for="" style="display:flex;align-items:center;gap:10px">
                            <input type="radio" id="viewAccTypeBasic" value="Basic" name="account_type">Basic
                        </label>
                        <label for="" style="display:flex;align-items:center;gap:10px">
                            <input type="radio" id="viewAccTypePremium" value="Premium" name="account_type">Premium
                        </label>
                    </div>
                    <label for="">First Name</label>
                    <input type="text" id="viewFname" name="f_name">
                    <label for="">Last Name</label>
                    <input type="text" id="viewLname" name="l_name">
                    <label for="">Email</label>
                    <input type="email" id="viewEmail" name="email">
                    <label for="">Phone</label>
                    <input type="text" id="viewPhone" name="phone">
                    <label for="">Address</label>
                    <input type="text" id="viewAddress" name="address">
                    <label for="">Birthdate</label>
                    <input type="date" id="viewBirthdate" name="birthdate" oninput="calculateAge()">
                    <label for="">Age</label>
                    <input type="text" id="viewAge" name="age" readonly>
                </div>
                <div style="display:flex;flex-direction:column;width:100%">
                    <div style="display:flex; gap:10px;align-items:center" class="blabla">
                        <p><strong>Gender:</strong></p>
                        <label style="display:flex;align-items:center;gap:10px">
                            <input type="radio" id="viewGenderMale" value="Male" name="gender">Male
                        </label>
                        <label style="display:flex;align-items:center;gap:10px">
                            <input type="radio" id="viewGenderFemale" value="Female" name="gender">Female
                        </label>
                    </div>
                    <label for="">Bank Name</label>
                    <input type="text" id="viewBankName" name="bank_name">
                    <label for="">Bank Account</label>
                    <input type="text" id="viewBankAccount" name="bank_account">
                    <label for="">Card Holder</label>
                    <input type="text" id="viewCardHolder" name="card_holder">
                    <label for="">Tin Number</label>
                    <input type="text" id="viewTinNumber" name="tin_number">
                    <label for="">Company Working With</label>
                    <input type="text" id="viewCompanyWorking" name="company_working">
                    <label for="">Company Name</label>
                    <input type="text" id="viewCompanyName" name="company_name">
                    <label for="">Company Address</label>
                    <input type="text" id="viewCompanyAddress" name="company_address">
                </div>
                <div style="display:flex;flex-direction:column;width:100%;padding-top:50px">
                    <label for="">Company Contact</label>
                    <input type="text" id="viewCompanyContact" name="company_contact">
                    <label for="">Position</label>
                    <input type="text" id="viewPosition" name="position">
                    <br>
                    <div style="display:flex">
                        <div>
                            <label for="">Proof of Billing</label>
                            <img src="" id="viewPOB" style="width:110px;height:110px; cursor: pointer">
                        </div>
                        <div>
                            <label for="">Valid ID</label>
                            <img src="" id="viewValidID" style="width:110px;height:110px; cursor: pointer">
                        </div>
                    </div>
                    <br>
                    <div style="display:flex;flex-direction:column;justify-content:center">
                        <label for="">Certificate of Employment</label>
                        <img src="" id="viewCOE" style="width:110px;height:110px; cursor: pointer"> 
                    </div>
                </div>
            </div>
            <div style="display:flex;align-items:center;gap:20px;margin-top:10px">
                <p id="ha"><strong>Registration:</strong></p>
                <select id="viewRegistrationStatus" name="registration_status" style="width:200px;padding:5px;font-size:15px">
                <option value="Approved" <?php echo ($row['registration_status'] === 'Approved') ? 'selected' : ''; ?>>Approve</option>
                <option value="Rejected" <?php echo ($row['registration_status'] === 'Rejected') ? 'selected' : ''; ?>>Reject</option>
                <option value="Pending" <?php echo ($row['registration_status'] === 'Pending') ? 'selected' : ''; ?>>Pending</option>
            </select>
            <label for="" id="block_email" style="display:none;align-items:center;gap:5px"><input type="checkbox" name="block_email" value="Blocked"> Block Email?</label>
            

            </div>

 
                <button class="update-btn" id="update-btn" type="submit">Update</button>
        </form>
    </div>  
</div>


<!-- Image Modal for large view -->
<div id="imageModal" class="modal">
    <button onclick="closeImageModal()">&#10006</button>
    <img class="modal-content" id="imageInModal">
</div>


<script src="../view/manage_users.js"></script>

<style>
    .abc label {
        color:white;
    }
    #blockUserModal {
    display: none;
}

/* .modal-content label {
    font-weight:550;
    color:rgb(60,60,60);
} */
.update-btn:hover {
    background-color:#1d748f;
}
  .update-btn {
    width:150px;
    float:right;
    position:absolute;
    right:20px;
    bottom:30px;
    border:none;
    background-color:#105f77;
    padding:10px;
    color:white;
    border-radius:5px;
    cursor: pointer;
}
#viewProfile {
    border-radius:50%;
    z-index: 1;
    border:5px solid white;
}
.profile-container {
    display: flex;
    align-items: center;
    gap: 20px;
}
.full-name {
    flex-grow: 1;
}
.full-name h1 {
    margin: 0;
    color: white;
}
form {
    display:flex;
    flex-direction:column;
    width: 100%;
}
.modal-content input,.model-content select {
    padding: 5px 10px;
    font-size:15px;
    border-radius:5px;
    border:1px solid rgb(90,90,90);
    margin:5px 0 10px 0;
}
input:focus,select:focus {
    outline: 1px solid #105f77;
}
.blabla input:focus,#block_email:focus {
    border:none;
    outline:0;
}

.modal-content input[type="radio"]:focus {
    outline:0;
}
.modal {
    display: none;
    position: fixed;
    justify-content:center;
    align-items:center;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgb(0,0,0);
    background-color: rgba(0,0,0,0.7);
    transition: opacity 0.5s;
}
.modal-content {
    background-color: #fefefe;
    padding: 20px;
    border: 1px solid #888;
    width: 1000px;
    border-radius:10px;
    position:relative;
}
.close {
    color: rgb(120,120,120);
    font-size: 28px;
    padding:0 8px;
    position: absolute;
    top:5px;
    right:5px;
}
.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
    padding:0 8px;
}
/* The image modal */
#imageModal {
    display: none;
    position: fixed;
    z-index: 2;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgb(0, 0, 0);
    background-color: rgba(0, 0, 0, 0.9);
}

/* Modal Content (image) */
#imageInModal {
    display: block;
    width: 70%;
    max-width: 600px;
}


/* Add Animation - Zoom in the Modal */
#imageInModal, #caption {
    animation-name: zoom;
    animation-duration: 0.3s;
}

@keyframes zoom {
    from {opacity: 0}
    to {opacity: 1}
}

/* The Close Button */
#imageModal .close {
    position: absolute;
    top: 15px;
    right: 35px;
    color: #f1f1f1;
    font-size: 40px;
    transition: 0.3s;
    padding: 0 10px;
}

#imageModal button {
    background-color: transparent;
    color:white;
    font-size:20px;
    border:none;
    position:absolute;
    top:20px;
    right:20px;
    cursor:pointer;
}


</style>
