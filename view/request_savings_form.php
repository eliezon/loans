<div class="add-savings" id="add-savings" style="">
    <div>
        <form action="../controller/insert_savings.php" id="loanForm" method="post">
            <h2>Savings Deposit and Withdrawal</h2>
            <button type="button" onclick="closeAddSavings()" class="close" id="close_request">✖</button>

            <input type="hidden" name="transaction_id" id="transaction_id">

            <label for="loanAmount">Amount</label>
            <input type="number" id="withdrawAmount" name="withdrawAmount">

            <!-- <label for="loanAmount">Current Amount</label>
            <input type="number" id="cuurentAmount" name="currentAmount"> -->

            <br><br>
            <label for="category">Category</label>
             
            <div style="display:flex; justify-content:start;gap:10px;margin-top:10px">

                <label for="" style="display:flex;align-items:center"><input type="radio" name="category">Withdrawal</label>

                <label for="" style="display:flex;align-items:center"><input type="radio" name="category">Deposit</label>

            </div>

            <div id="loanAmountError" class="error" style="color:red"></div>
            <br>
            <button type="button" onclick="validateAndSubmit()" class="submit">Submit</button>
          
        </form>


    </div>
</div>

<script>
    // Function to generate a random numeric transaction ID
    function generateTransactionId() {
        const timestamp = Date.now(); // Get current timestamp
        const randomId = Math.floor(1000 + Math.random() * 9000); // Generate a random 4-digit number
        return timestamp.toString() + randomId.toString(); // Concatenate timestamp and random number
    }

    // Function to validate loan amount and submit the form
    function validateAndSubmit() {
        // Validate loan amount
        if (validateLoanAmount()) {
            // Generate the transaction ID
            const transactionId = generateTransactionId();

            // Set the generated transaction ID to the hidden input field
            document.getElementById('transaction_id').value = transactionId;

            // Submit the form
            document.getElementById('loanForm').submit();
        }
    }

    // Function to validate loan amount
    function validateLoanAmount() {
        const loanAmount = document.getElementById('loanAmount').value;
        const loanAmountError = document.getElementById('loanAmountError');

        if (loanAmount === '') {
            loanAmountError.innerHTML = 'Amount is required.';
            return false;
        } else if (loanAmount < 500 || loanAmount > 10000) {
            loanAmountError.innerHTML = 'Amount must be between 500 and 5000.';
            return false;
        } else {
            loanAmountError.innerHTML = ''; // Clear error message
            return true;
        }
    }
</script>
