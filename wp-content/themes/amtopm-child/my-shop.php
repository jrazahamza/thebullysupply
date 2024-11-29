<?php ob_start();
if(session_status() === PHP_SESSION_NONE) {
    session_start();
}
include ('connection.php');
/* 
Template Name: my-shop
*/
if(!isset($_COOKIE["user_id"]) || $_COOKIE["user_id"]==0){ 
  header("location: /login/");
}

if(isset($_GET['userStatus'])){
    mysqli_query($con," UPDATE `listings` SET `userStatus`='".$_GET['userStatus']."' WHERE `id`='".$_GET['id']."' ");
    header("location: /my-shop/");
}

if(isset($_GET['status-change'])){
    mysqli_query($con," UPDATE `listings` SET `status`='".$_GET['status-change']."' WHERE `id`='".$_GET['id']."' ");
    header("location: /my-shop/");
}

if(isset($_GET['delete-listing'])){
    mysqli_query($con," DELETE FROM `listings` WHERE `id`='".$_GET['delete-listing']."' ");
    header("location: /my-shop/");
}
  
get_header();
?>
<style>

/* Dashboard */
.ruk-listing-new-section .spinner {
    border-top: 2px solid #0b1e3e;
    width: 30px !important;
    height: 30px !important;
    position: absolute;
    top: -40px !important;
    left: 0px;
}

.ruk-listing-new-section .footer .btn-group .prev{
    background-color:#E5F4FF !important;
    border-radius:8px 0px 0px 8px !important;    
}
.ruk-listing-new-section .footer .btn-group button.next{
    background-color:#E5F4FF !important;
    border-radius:0px 8px 8px 0px !important;
}

.ruk-listing-new-section .footer .btn-group button.active {
    border-radius: unset !important;
    background-color:#011f3d;
    color:#fff;
}
.ruk-listing-new-section .footer .btn-group button{
    background-color:#E5F4FF;   
}
.ruk-listing-new-section .dashboard {
  flex-grow: 1;
}

.ruk-listing-new-section .dashboard h1 {
  font-size: 28px;
  font-weight: 800;
  color: #202224;
  overflow: hidden;
}

.ruk-listing-new-section .filter-menu .btn-group {
  border: none;
  border-radius: 10px;
  background-color: #e5f4ff;
}
.ruk-listing-new-section .filter-menu .btn-group button {
  padding: 25px 32px;
  border: none;
  background-color: #e5f4ff;
  color: #202224;
  font-size: 14px;
  font-weight: 700;
}

.ruk-listing-new-section .filter-menu .dropdown-toggle::after {
  display: none;
}

.ruk-listing-new-section .filter-menu .btn-group button {
  border-right: 1px solid #0b1e3eab;
  border-radius: unset;
}

.ruk-listing-new-section .filter-menu .btn-group button:last-child {
  color: #bc253d;
  border-right: none;
}

.ruk-listing-new-section .btn-container {
  width: 100%;
  display: flex;
  justify-content: end;
}

.ruk-listing-new-section .btn-container button:first-child {
  width: 38px;
  height: 38px;
  border: 1px solid #003459;
  border-radius: 50%;
  background-color: #fff;
}

.ruk-listing-new-section .btn-container button:last-child {
  border: none;
  border-radius: 200px;
  background-color: #0b1e3e;
  padding-top: 13px;
  padding-right: 19px;
  padding-bottom: 12px;
  padding-left: 20px;
  font-size: 14px;
  font-weight: 500;
  color: #fff;
  margin-left: 3px;
}



.ruk-listing-new-section .table-border {
  border: 0.4px solid #dcdcdc;
  border-radius: 14px;
  padding: 0;
  margin-left: 13px;
  margin-right: 29px;
}


.ruk-listing-new-section .table tr .btn-group button {
  padding: 8px 13px 6px 13px;
  border-left: 1px solid #003459;
  border-right: none;
  border-top: 1px solid #003459;
  border-bottom: 1px solid #003459;
  background-color: #fff;
}
.ruk-listing-new-section .table tr .btn-group button:first-child {
  border-top-left-radius: 5px;
  border-bottom-left-radius: 5px;
}
.ruk-listing-new-section .table tr .btn-group button:last-child {
  border-right: 1px solid #003459;
  border-top-right-radius: 5px;
  border-bottom-right-radius: 5px;
}
.ruk-listing-new-section .table td {
  padding-top: 20px;
  padding-bottom: 15px;
}
.ruk-listing-new-section .table td {
  border: none !important;
}

.ruk-listing-new-section .table th{
  border-bottom:1px solid #d5d5d5 !important;
  border-top:none !important;
}
.ruk-listing-new-section .active {
  padding: 4px 13px;
  border-radius: 13px;
  border: 1px solid #00b69b;
  background-color: #00b69b45;
  font-size: 14px;
  font-weight: 700;
  color: #00b69b;
}
.ruk-listing-new-section .pending {
  padding: 4px 13px;
  border-radius: 13px;
  border: 1px solid #ffa500;
  background-color: #fcbe2d40;
  font-size: 14px;
  font-weight: 700;
  color: #ffa500;
}
.ruk-listing-new-section .rejected {
  padding: 4px 13px;
  border-radius: 13px;
  border: 1px solid #fd5454;
  background-color: #fd54544a;
  font-size: 14px;
  font-weight: 700;
  color: #fd5454;
}

.ruk-listing-new-section .footer {
  margin-top: 9px;
}
.ruk-listing-new-section .footer span {
  color: #202224;
  font-size: 14px;
  font-weight: 600;
}
.ruk-listing-new-section .footer .btn-group{
  float: inline-end;
  margin-right: 20px;
}
.ruk-listing-new-section .footer .btn-group button {
  padding-top: 3px;
  padding-bottom:3px;
  padding-right:9px;
  padding-left: 10px;
  border-top: 0.6px solid #0B1E3E ;
  border-bottom: 0.6px solid #0B1E3E ;
  border-left: 0.6px solid #0B1E3E ;
  border-right: 0.6px solid #0B1E3E ;
}
.ruk-listing-new-section .footer .btn-group button:first-child{
  border-right: none ;
  border-top-left-radius: 8px;
  border-bottom-left-radius: 8px;
}
.ruk-listing-new-section .footer .btn-group button:last-child {
  border-top-right-radius: 8px;
  border-bottom-right-radius: 8px;
}
.ruk-listing-new-section td, a, button, h1, span, th {
    font-family:manrope;
}
.my-shop-listing-right button a {
    color: #fff;
}

.ruk-listing-new-section .table th {
    font-weight: 900;
}

.ruk-listing-new-section .btn-group .fa {
    color: #003459;
}
.my-shop-filter-gr .fa-angle-down {
    margin-left: 18px;
}
.top-filter-row .filter-menu {
    display: flex;
    justify-content: space-between;
    align-items: center;
}
@media screen and (max-width: 1440px) {  	
.ruk-listing-new-section .filter-menu .btn-group button {
	padding: 25px 24px;
	}
}	
</style>
<section id="my-shop" class="my-shop template-common-class">
    <div class="container-fluid">
        <div class="row">
            <div class="template-pages-content">
                <!--=== SideBar-->
                <div class="template-sidebar">
                    <?php $activeSidebar="my-shop";  include ("custom-sidebar.php"); ?>
                </div>
                <!-- Start Template Page Content-->
                <div class="main-content-class">
					
					<div class="ruk-listing-new-section">
						
						      <div class="dashboard">
								<div class="container-fluid">
								  <h1 class="mt-5">My Listings</h1>
								  <div class="top-filter-row">
									<div class="filter-menu">
									  <div class="btn-group my-shop-filter-gr">
										<button>
											<i class="svg-icon tack">
											<svg xmlns="http://www.w3.org/2000/svg" width="22" height="25" fill="none"><path stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.75 10c5.385 0 9.75-2.015 9.75-4.5S16.135 1 10.75 1 1 3.015 1 5.5 5.365 10 10.75 10" clip-rule="evenodd"/><path stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M1 5.5a9.75 9.75 0 0 0 7.5 9.479v6.271a2.25 2.25 0 0 0 4.5 0v-6.271A9.75 9.75 0 0 0 20.5 5.5"/>
												</svg>
											</i>
										  </button>
										<button>Filter By</button>

										<div class="dropdown">
										  	<input type="text" id="datepicker" name="date" placeholder="Select a date">
										</div>

<!-- 										<div class="dropdown">
										 	<select class="category">
												<option value="">Select Category</option>
												<option value="active">Active</option>
												<option value="pending">Pending</option>
											</select>
										</div> -->
										<div class="dropdown">
											<select class="status">
												<option value="">Select Status</option>
												<option value="active">Active</option>
												<option value="pending">Pending</option>
											</select>
										</div>

									<button>
									 <i class="svg-icon reset-icon">
									<svg xmlns="http://www.w3.org/2000/svg" width="19" height="18" fill="none"><path fill="#BC253D" d="M9.75 3.75v-3L6 4.5l3.75 3.75v-3c2.483 0 4.5 2.018 4.5 4.5s-2.017 4.5-4.5 4.5a4.504 4.504 0 0 1-4.5-4.5h-1.5c0 3.315 2.685 6 6 6s6-2.685 6-6-2.685-6-6-6"/>
										</svg>
									   </i>
										<span class="reset-text">Reset Filter</span>
									  </button>
									  </div>
									<div class="my-shop-listing-right">
									  <div class="btn-container d-flex align-items-center">
										<button>
										  <i class="fa fa-download" aria-hidden="true"></i>
										</button>
										 <button><a href="/create-listing/">Add New Listing</a></button>
									  </div>
									</div>										
									</div>
								  </div>
								  <div class="row mt-5">
									<div class="col table-border" id="listings-container">
									  <table class="table">
										<thead>
										  <tr>
											<th scope="col">ID</th>
											<th scope="col">Name</th>
											<th scope="col">Price</th>
											<th scope="col">DATA</th>
											<th scope="col">Category</th>
											<th scope="col">Sub Category</th>
											<th scope="col">STATUS</th>
											<th scope="col"></th>
										  </tr>
										</thead>
										<tbody id="listings-data">
											<div id="loader" class="spinner" style="display: none;"></div>
										</tbody>
									  </table>
									</div>
									<div class="footer">
										<span>Showing 1-25 of 00</span>
										<div class="btn-group"></div>
									</div>
								  </div>
									
									
								</div>
							  </div>	
					</div>
                </div>
                <!-- End Template Page Content-->
            </div>
        </div>
    </div>
</section>
<?php
get_footer();
?>
<script>
jQuery(document).ready(function(){
    jQuery("#SearchListing").keyup(function(){
        _this = this;
          jQuery.each(jQuery("#SearchListingTable tbody tr"), function() {
             if(jQuery(this).text().toLowerCase().indexOf(jQuery(_this).val().toLowerCase()) === -1){
                 jQuery(this).hide();
               }else{
                 jQuery(this).show();
              }
          });
    });
});    
	
	
jQuery(document).ready(function ($) {
    const ajaxUrl = "<?php echo admin_url('admin-ajax.php'); ?>"; // WordPress AJAX URL
    const $listingsContainer = $("#listings-data");
    const $paginationContainer = $(".footer .btn-group");
    const $infoSpan = $(".footer span");
	const datepicker = $("#datepicker");
	const statusDropdown = $(".status"); // Status dropdown
	const resetButton = $(".reset-icon").closest("button");
    const $loader = $("#loader"); // Loader element
	
    const limit = 25; // Records per page
    let currentPage = 1;
	let debounceTimer;

    // Debounce Function
    function debounce(func, delay) {
        return function (...args) {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(() => func(...args), delay);
        };
    }

    // Fetch Listings Function
    function fetchListings(page = 1, date = "", status = "") {
        const data = {
            action: "fetch_listings",
            page: page,
            limit: limit,
			date: date,
			status: status,
        };

        // Show Loader
        $loader.show();

        $.post(ajaxUrl, data, function (result) {
            // Hide Loader
            $loader.hide();

            if (result.success) {
                console.log(result);
                renderListings(result.data.data);
                renderPagination(result.data.total, page, limit);
                updateInfoSpan(page, limit, result.data.total);
            } else {
                swal("Error fetching listings:", result.data);
            }
        }).fail(function (error) {
            // Hide Loader on error
            $loader.hide();
            swal("Error fetching listings:", error.responseText);
        });
    }

    // Render Listings in Table
    function renderListings(data) {
        $listingsContainer.empty(); // Clear existing data
        $.each(data, function (index, item) {
            const status = item.status === "active" ? "active" : item.status;
            const row = `
                <tr>
                    <td>${item.id}</td>
                    <td>${item.title}</td>
                    <td>$${parseFloat(item.price).toFixed(2)}</td>
                    <td>${new Date(item.created_at).toLocaleDateString()}</td>
                    <td>${item.parent_category_name || "N/A"}</td>
                    <td>${item.sub_category_name || "N/A"}</td>
                    <td><button class="${status}">${ucfirst(item.status)}</button></td>
                    <td>
                        <div class="btn-group">
                            <button><i class="fa fa-eye" aria-hidden="true"></i></button>
                            <button><a href="/edit-listing/?id=${item.id}"><i class="fa fa-pencil-square" aria-hidden="true"></i></a></button>
                            <button><a href="/my-shop/?delete-listing=${item.id}"><i class="fa fa-trash" aria-hidden="true"></i></a></button>
                        </div>
                    </td>
                </tr>
            `;
            $listingsContainer.append(row);
        });
    }

    // Render Pagination
    function renderPagination(total, currentPage, limit) {
        const totalPages = Math.ceil(total / limit);
        $paginationContainer.empty(); // Clear existing buttons

        if (currentPage > 1) {
            $paginationContainer.append(`
                <button data-page="${currentPage - 1}" class="prev"><i class="fa fa-angle-left" aria-hidden="true"></i></button>
            `);
        }

        for (let i = 1; i <= totalPages; i++) {
            $paginationContainer.append(`
                <button data-page="${i}" class="${i === currentPage ? "active" : ""}">${i}</button>
            `);
        }

        if (currentPage < totalPages) {
            $paginationContainer.append(`
                <button data-page="${currentPage + 1}" class="next"><i class="fa fa-angle-right" aria-hidden="true"></i></button>
            `);
        }

        // Add click event to buttons
        $paginationContainer.find("button").on("click", function () {
            const page = parseInt($(this).data("page"));
			const date = datepicker.val().trim();
			const status = statusDropdown.val().trim();
            fetchListings(page);
        });
    }

    // Update Info Span
    function updateInfoSpan(page, limit, total) {
        const start = (page - 1) * limit + 1;
        const end = Math.min(page * limit, total);
        $infoSpan.text(`Showing ${start}-${end} of ${total}`);
    }
	
	// Datepicker Change Listener with Debounce
    datepicker.on(
        "change",
        debounce(function () {
            const date = datepicker.val().trim();
			const status = statusDropdown.val().trim();
            fetchListings(1, date); // Search on first page
        }, 2000) // 2-second debounce
    );
	
	// Status Dropdown Change Listener
    statusDropdown.on("change", function () {
        const date = datepicker.val().trim();
        const status = $(this).val().trim();
        fetchListings(1, date, status); // Search on first page
    });
	
	// Reset Filters Function
    resetButton.on("click", function () {
        // Reset filters
        datepicker.val(""); // Clear datepicker value
        statusDropdown.val(""); // Reset status dropdown to default

        // Fetch listings without filters
        fetchListings(1, "", "");
    });
	
	datepicker.datepicker({
        dateFormat: 'mm/dd/yy',
        changeMonth: true,
        changeYear: true,
    });

    // Initial Fetch
    fetchListings(currentPage);
});




function ucfirst(str) {
    return str.charAt(0).toUpperCase() + str.slice(1);
}
</script>