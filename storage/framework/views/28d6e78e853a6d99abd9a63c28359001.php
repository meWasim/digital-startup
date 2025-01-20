<div class="container-fluid">
    <div class="row">
        <div class="home-ban blue-bg-mt pt-md-5 pt-3">
            <div class="banner-txt w-100 pt-md-5">
                <h2 class="w-100 text-center">Domain Booking</h2>
                <div class="d-flex flex-wrap justify-content-center">
                    <div class="col-md-5 col-sm-5 dmn-srch">
                        <div class="input-group pt-md-5 pt-3">
                            <!--<form id="myForm" onsubmit="return validateForm()">-->
                            <input type="text" class="form-control search-fild"
                                placeholder="Search your domain name here "
                                id="searchnthsk">
                            <div class="input-group-append">
                                <button class="btn btn-secondary" type="button"
                                    onclick="validateForm()">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                            <!--</form>-->
                            <script>
                                function validateForm() {
                                    var searchnthsk = document.getElementById("searchnthsk").value;
                                    if (searchnthsk === "") {
                                        alert("Search field cannot be empty!");
                                        return false; // Prevent form submission
                                    }
                                    var redirectUrl = "domain-list.php?domain=" + encodeURIComponent(searchnthsk);
                                    window.location.href = redirectUrl;
                                }
                            </script>
                        </div>
                        <ul
                            class="domain w-100 d-block text-md-left text-center pl-0 pt-md-4 pt-2">
                            <li>.com</li>
                            <li>.in</li>
                            <li>.net</li>
                            <li>.co.in</li>
                            <li>.co</li>
                            <li><a href="price-list.php">View Price List >></a></li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<?php /**PATH C:\Users\Wasim Ansari\OneDrive\Desktop\freework\digitalStartups\resources\views/layouts/partials/domain.blade.php ENDPATH**/ ?>