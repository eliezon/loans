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