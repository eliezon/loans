function showViewInfo(user) {
    // Set profile image source
    document.getElementById('viewProfile').src = user.profile_img || '';
    // Set form values
    document.getElementById('userId').value = user.id || '';
    document.getElementById('viewFname').value = user.f_name || '';
    document.getElementById('viewLname').value = user.l_name || '';
    document.getElementById('viewEmail').value = user.email || '';
    document.getElementById('viewPhone').value = user.phone || '';
    document.getElementById('viewAddress').value = user.address || '';
    document.getElementById('viewBirthdate').value = user.birthdate || '';
    document.getElementById('viewAge').value = user.age || '';
    document.getElementById('viewBankName').value = user.bank_name || '';
    document.getElementById('viewBankAccount').value = user.bank_account || '';
    document.getElementById('viewCardHolder').value = user.card_holder || '';
    document.getElementById('viewTinNumber').value = user.tin_number || '';
    document.getElementById('viewCompanyWorking').value = user.company_working || '';
    document.getElementById('viewCompanyName').value = user.company_name || '';
    document.getElementById('viewCompanyAddress').value = user.company_address || '';
    document.getElementById('viewCompanyContact').value = user.company_contact || '';
    document.getElementById('viewPosition').value = user.position || '';
    document.getElementById('viewPOB').src = user.proof_of_billing || '';
    document.getElementById('viewValidID').src = user.valid_id || '';
    document.getElementById('viewCOE').src = user.coe || '';
    document.getElementById('viewRegistrationStatus').value = user.registration_status || 'N/A';
   
    document.getElementById('viewFullName').innerText = `${user.f_name || ''} ${user.l_name || ''}`;

    // Set status radio button
    if (user.status === 'Active') {
        document.querySelector('input[name="status"][value="Active"]').checked = true;
    } else if (user.status === 'Disabled') {
        document.querySelector('input[name="status"][value="Disabled"]').checked = true;
    } else {
        document.querySelector('input[name="status"]').checked = false;
    }

    if (user.acc_type === 'Basic') {
        document.querySelector('input[name="account_type"][value="Basic"]').checked = true;
    } else if (user.acc_type === 'Premium') {
        document.querySelector('input[name="account_type"][value="Premium"]').checked = true;
    }

    if (user.gender === 'Male') {
        document.querySelector('input[name="gender"][value="Male"]').checked = true;
    } else if (user.gender === 'Female') {
        document.querySelector('input[name="gender"][value="Female"]').checked = true;
    }

    var selectTag = document.getElementById('viewRegistrationStatus');
    var blockEmail = document.getElementById('block_email');
    var viewEmail = document.getElementById('email');
    var stat = document.getElementById('stat');
    var vs = document.getElementById('gago');
    var vs1 = document.getElementById('gago1');
    var ha = document.getElementById('ha');
    var updatebtn = document.getElementById('update-btn');

    if (user.registration_status === 'Approved') {
        selectTag.style.display = 'none';
        blockEmail.style.display = 'none';
        vs.style.display = 'block';
        vs1.style.display = 'block';
        ha.style.display = 'none';
        updatebtn.style.display = 'block';
    } 
    
    if (user.registration_status === 'Pending') {
        selectTag.style.display = 'block';
        blockEmail.style.display = 'none';
        vs.style.display = 'none';
        vs1.style.display = 'none';
        ha.style.display = 'block';
        updatebtn.style.display = 'block';
      
    } 
    if (user.registration_status === 'Rejected') {
        selectTag.style.display = 'none';
        blockEmail.style.display = 'none';
        vs.style.display = 'none';
        vs1.style.display = 'none';
        ha.style.display = 'none';
        updatebtn.style.display = 'none';
    } 
    document.getElementById('viewRegistrationStatus').addEventListener('change', function() {
    var selectValue = this.value;
    var blockEmail = document.getElementById('block_email');
    if (selectValue === 'Approved') {
        blockEmail.style.display = 'none';
    }
    else if (selectValue === 'Pending') {
        blockEmail.style.display = 'none';
    } else {
        blockEmail.style.display = 'flex'; // or 'block', depending on the initial display style
    }
});


    var view = document.getElementById('view_info');
    view.style.display = "flex";
    setTimeout(function() {
        view.style.opacity = "1";
    }, 10);

    // Attach event listeners to images to open them in a large view modal
    document.getElementById('viewProfile').onclick = function() { openImageModal(this); };
    document.getElementById('viewPOB').onclick = function() { openImageModal(this); };
    document.getElementById('viewValidID').onclick = function() { openImageModal(this); };
    document.getElementById('viewCOE').onclick = function() { openImageModal(this); };
}

function closeViewInfo() {
    var view = document.getElementById('view_info');
    view.style.opacity = "0";
    setTimeout(function() {
        view.style.display = "none";
    }, 500);
}

function calculateAge() {
    const birthdate = new Date(document.getElementById('viewBirthdate').value);
    const today = new Date();
    let age = today.getFullYear() - birthdate.getFullYear();
    const month = today.getMonth() - birthdate.getMonth();
    if (month < 0 || (month === 0 && today.getDate() < birthdate.getDate())) {
        age--;
    }
    document.getElementById('viewAge').value = age;
}

function openImageModal(img) {
    var modal = document.getElementById("imageModal");
    var modalImg = document.getElementById("imageInModal");
    var captionText = document.getElementById("caption");

    modal.style.display = "flex";
    modalImg.src = img.src;
    captionText.innerHTML = img.alt;

    var span = document.getElementsByClassName("close")[1]; // Get the second close button for the image modal
    span.onclick = function() { 
        modal.style.display = "none";
    }
}

function closeImageModal() {
    var modal = document.getElementById("imageModal");
    modal.style.display = "none";
}