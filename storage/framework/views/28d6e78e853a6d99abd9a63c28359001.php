<div class="container-fluid">
    <div class="row">
        <div class="home-ban blue-bg-mt pt-md-5 pt-3">
            <div class="banner-txt w-100 pt-md-5">
                <h2 class="w-100 text-center">Domain Booking</h2>
                <div class="d-flex flex-wrap justify-content-center">
                    <div class="col-md-5 col-sm-5 dmn-srch">
                        <div class="input-group pt-md-5 pt-3">
                            <input type="text" class="form-control search-fild"
                                placeholder="Search your domain name here" id="searchnthsk">
                            <div class="input-group-append">
                                <button class="btn btn-secondary" type="button" onclick="validateForm()">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CSRF Token -->
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

<!-- SweetAlert JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

<script>
    function validateForm() {
        const searchField = document.getElementById("searchnthsk");
        const query = searchField.value.trim();

        // Validate search field
        if (!query) {
            Swal.fire({
                icon: 'warning',
                title: 'Validation Error',
                text: 'Search field cannot be empty!',
            });
            return;
        }

        // Show loading message using SweetAlert
        Swal.fire({
            title: 'Fetching Domain Status...',
            text: 'Please wait while we check the domain status.',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        // Get CSRF token from meta tag
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // Call API and handle response
        fetch(`/api/domain-status?domain=${encodeURIComponent(query)}`, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                },
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                // Close the loading message
                Swal.close();

                // Check if data contains domains
                if (data.domains && Object.keys(data.domains).length > 0) {
                    // Create card-style rows for domain results
                    let domainRows = '';
                    Object.values(data.domains).forEach(domain => {
                        const statusText = domain.status.toLowerCase() === 'available' ? 'Available' :
                            'DOMAIN TAKEN';
                        const color = domain.status.toLowerCase() === 'available' ? 'green' : 'red';
                        const actionButton = `
            <a href="https://www.godaddy.com/domains/searchresults.aspx?domain=${encodeURIComponent(domain.name)}"
                target="_blank"
                style="color: white; text-decoration: none; padding: 10px 20px; border-radius: 5px; background-color: ${domain.status.toLowerCase() === 'available' ? 'green' : 'blue'}; display: inline-block;">
                Buy
            </a>`;

                        domainRows += `
        <div style="border: 1px solid #ddd; padding: 15px; margin-bottom: 10px; border-radius: 8px; background: #f9f9f9;">
            <p style="font-size: 16px; margin: 0 0 8px;"><strong>Domain:</strong> ${domain.name}</p>
            <p style="font-size: 14px; margin: 0 0 8px;"><strong>Status:</strong> <span style="color: ${color};">${statusText}</span></p>
            <p style="margin: 0;"><strong>Action:</strong> ${actionButton}</p>
        </div>`;
                    });

                    // Show results in SweetAlert with optimized design and increased width
                    Swal.fire({
                        title: '<h3 style="margin-bottom: 15px;">Domain Status Results</h3>',
                        html: `
        <div style="max-height: 500px; overflow-y: auto; text-align: left;"> <!-- Scrollable for long lists -->
            ${domainRows}
        </div>
        `,
                        showCloseButton: true,
                        customClass: {
                            popup: 'wide-popup',
                        },
                    });

                    // Add custom CSS for wider popup
                    const customStyle = document.createElement('style');
                    customStyle.innerHTML = `
        .wide-popup {
            width: 80% !important; /* Increase popup width */
            max-width: 900px; /* Restrict to a max width */
        }
        .swal2-html-container {
            text-align: left; /* Align content to the left */
            font-family: Arial, sans-serif; /* Improve font readability */
            font-size: 14px;
        }
        .swal2-popup {
            padding: 20px; /* Add extra padding */
            border-radius: 10px; /* Round the corners */
        }
    `;
                    document.head.appendChild(customStyle);
                } else {
                    Swal.fire({
                        icon: 'info',
                        title: 'No Results',
                        text: 'No domain status information found for the given input.',
                    });
                }

            })
            .catch(error => {
                // Close the loading message and show error
                Swal.close();
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: error.message || 'An error occurred while fetching domain status.',
                });
                console.error("Error fetching domain status:", error);
            });
    }
</script>

<!-- Add custom CSS for styling -->
<style>
    .table {
        width: 100%;
        margin-top: 15px;
        border-collapse: collapse;
    }

    .table th,
    .table td {
        padding: 10px;
        text-align: left;
    }

    .table th {
        background-color: #f1f1f1;
    }

    .table td {
        border: 1px solid #ddd;
    }

    .btn-success {
        background-color: green;
        border-color: green;
    }

    .btn-primary {
        background-color: red;
        border-color: red;
    }

    .btn {
        padding: 5px 10px;
        color: white;
        text-transform: uppercase;
        text-align: center;
        border-radius: 3px;
        display: inline-block;
        font-size: 14px;
    }
</style>
<?php /**PATH C:\Users\Wasim Ansari\OneDrive\Desktop\freework\digitalStartups\resources\views/layouts/partials/domain.blade.php ENDPATH**/ ?>