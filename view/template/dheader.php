<div class="dtop">
    <div class="dtop-left">
        <h4>LOAN MANAGEMENT SYSTEM</h4>

        <button onclick="toggleSidebar()" id="sidebar-btn">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1);transform: ;msFilter:;"><path d="M4 6h16v2H4zm0 5h16v2H4zm0 5h16v2H4z"></path></svg>
        </button>
    </div>

    <div class="dtop-right">
        <input type="search" id="transactionSearch" placeholder="Search by Transaction ID">
        <i class='bx bxs-bell'></i>
        <button class="profile" id="profile">
            <img src="<?php echo htmlspecialchars($profile_img); ?>" alt="" class="profile_img">
        </button>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add an event listener to the search input field
        document.getElementById('transactionSearch').addEventListener('input', function() {
            // Get the search query
            const searchQuery = this.value.trim();

            // Make an AJAX request to fetch transactions based on the search query
            // Update the displayed transactions with the results
            // You'll need to implement this AJAX request based on your backend structure
            // Example AJAX request:
            // fetchTransactions(searchQuery);
        });

        // Function to fetch transactions based on the search query
        function fetchTransactions(searchQuery) {
            // Example AJAX request using Fetch API
            fetch('fetch_transactions.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ searchQuery: searchQuery }),
            })
            .then(response => response.json())
            .then(data => {
                // Update the displayed transactions with the fetched data
                console.log(data); // Example: Log the fetched data to the console
            })
            .catch(error => console.error('Error fetching transactions:', error));
        }
    });
</script>

<style>
    .dtop-left button {
        background: transparent;
        border: none;
    }
</style>
