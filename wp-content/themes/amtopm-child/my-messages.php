<?php ob_start();
if(session_status() === PHP_SESSION_NONE) {
    session_start();
}
include ('connection.php');
/* 
Template Name: my-messages
*/ 
if(!isset($_COOKIE["user_id"]) || $_COOKIE["user_id"]==0){ 
   header("location: /login/");
}
if(isset($_GET['mark'])){
    mysqli_query($con," UPDATE `message` SET `read`='1' WHERE `id`='".$_GET['id']."' ");
    header("location: /my-messages/");
}

// if (isset($_GET['action']) && $_GET['action'] === 'fetch_data') {
//     global $wpdb;
//     $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
//     $limit = 25; // Number of records per page
//     $offset = ($page - 1) * $limit;

//     // Query to get the contact requests with pagination
//     $contactRequests = $wpdb->get_results("SELECT * FROM `contactRequest` ORDER BY id DESC LIMIT $offset, $limit");

//     $data = [];
//     foreach ($contactRequests as $contactRequest) {
//         $listing = $wpdb->get_row($wpdb->prepare("SELECT * FROM `listings` WHERE `id` = %d AND `userID` = %d", $contactRequest->product, $_COOKIE["user_id"]));

//         if ($listing) {
//             $data[] = [
//                 'product_img' => esc_url($listing->gallery1),
//                 'product_title' => esc_html($listing->title),
//                 'customer_name' => esc_html($contactRequest->firstName . ' ' . $contactRequest->lastName),
//                 'contact_number' => esc_html($contactRequest->phoneNumber),
//                 'date' => date("F d, Y", strtotime($contactRequest->created_at)),
//                 'email' => esc_html($contactRequest->emailAddress),
//                 'address' => esc_html($contactRequest->address),
//                 'description' => esc_html($contactRequest->description),
//             ];
//         }
//     }

//     // Get the total number of records for pagination
//     $totalRequests = $wpdb->get_var("SELECT COUNT(*) FROM `contactRequest`");
//     $totalPages = ceil($totalRequests / $limit);

//     echo json_encode(['data' => $data, 'totalPages' => $totalPages]);
//     exit;
// }
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
  padding: 25px 28px;
  border: none;
  background-color: #e5f4ff;
  color: #202224;
  font-size: 14px;
  font-weight: 700;
}

.ruk-listing-new-section .filter-menu .btn-group button {
  border-right: 1px solid #0b1e3eab;
  border-radius:unset;
}

.ruk-listing-new-section .filter-menu .btn-group button:last-child {
  color: #bc253d;
  border-right: none;
}

.ruk-listing-new-section .btn-container {
  width: 80%;
  display: flex;
  justify-content: end;
}

.ruk-listing-new-section .filter-menu .dropdown-toggle::after {
  display: none;
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
.email-pro-img {
    width: 60px !important;
}
.ruk-listing-new-section .table td {
  border: none !important;
}

.ruk-listing-new-section .table th{
  border-bottom:1px solid #d5d5d5 !important;
  border-top:none !important;
}
.my-messages .fa-angle-down {
    margin-left: 18px;
}
#dataContainer .email-pro-img {
    height: 47px !important;
    width: 44px;
    object-fit:cover;
   
}	
	
@media screen and (max-width: 1280px) {

.ruk-listing-new-section .table-border .table tr td {   
  max-width:110px;
  //border:1px solid red !important;
  overflow-x:hidden;
}
  
  
  
}  	
</style>

<section id="my-messages" class="my-messages template-common-class">
    <div class="container-fluid">
        <div class="row">
            <div class="template-pages-content">
                <!--=== SideBar-->
                <div class="template-sidebar">
                    <?php $activeSidebar="my-messages";  include "custom-sidebar.php"; ?>
                </div>
                <!-- Start Template Page Content-->
                <div class="main-content-class">
					
					
						<div class="ruk-listing-new-section">
						  <div class="dashboard">
							<div class="container-fluid">
							  <h1 class="mt-5">My Listings</h1>
							  <div class="row mt-4 align-items-center">
								<div class="col-10 filter-menu">
								  <div class="btn-group">
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

									<div class="dropdown">
									  <input
											type="text"
											id="searchInput"
											placeholder="Search by first name"
										/>
									</div>
									<button>
									 <i class="svg-icon reset-icon">
									<svg xmlns="http://www.w3.org/2000/svg" width="19" height="18" fill="none"><path fill="#BC253D" d="M9.75 3.75v-3L6 4.5l3.75 3.75v-3c2.483 0 4.5 2.018 4.5 4.5s-2.017 4.5-4.5 4.5a4.504 4.504 0 0 1-4.5-4.5h-1.5c0 3.315 2.685 6 6 6s6-2.685 6-6-2.685-6-6-6"/>
										</svg>
									   </i>
										<span class="reset-text">Reset Filter</span>
									  </button>
								  </div>
								</div>
								<div class="col-2">
								  <div class="btn-container d-flex align-items-center">
									<div class="all-email-download-icon">
									  <i class="fa fa-download" aria-hidden="true"></i>
									</div>
								  </div>
								</div>
							  	</div>
									<div class="row mt-5">
										<div class="col table-border">
											<table class="table">
												<thead>
													<tr>
														<th scope="col">Product Image</th>
														<th scope="col">Product Title</th>
														<th scope="col">Customer Name</th>
														<th scope="col">Contact Number</th>
														<th scope="col">Date</th>
														<th scope="col">Email</th>
														<th scope="col">Address</th>
														<th scope="col">Description</th>
														<th scope="col"></th>
													</tr>
												</thead>
												<tbody id="messages-data">
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
	
jQuery(document).ready(function ($) {
    const ajaxUrl = "<?php echo admin_url('admin-ajax.php'); ?>";
    const messagesContainer = $("#messages-data");
    const paginationContainer = $(".footer .btn-group");
    const infoSpan = $(".footer span");
    const loader = $("#loader");
    const searchInput = $("#searchInput");
    const datepicker = $("#datepicker");
	const resetButton = $(".reset-icon").closest("button");

    const limit = 25;
    let currentPage = 1;
    let debounceTimer;

    // Debounce Function
    function debounce(func, delay) {
        return function (...args) {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(() => func(...args), delay);
        };
    }

    // Fetch Messages
    function fetchMessages(page = 1, searchQuery = "", date = "") {
        const data = {
            action: "fetch_messages",
            page: page,
            limit: limit,
            search: searchQuery,
            date: date,
        };

        loader.show();

        $.post(ajaxUrl, data, function (response) {
            loader.hide();

            if (response.success) {
                renderMessages(response.data.data);
                renderPagination(response.data.total, page, limit);
                updateInfoSpan(page, limit, response.data.total);
            } else {
                console.error("Error fetching messages:", response.data);
            }
        }).fail(function (error) {
            loader.hide();
            console.error("Error fetching messages:", error);
        });
    }

    // Render Messages in Table
    function renderMessages(data) {
        messagesContainer.empty(); // Clear existing data
        data.forEach(function (item) {
            const row = `
                <tr>
                    <td><img src="${item.product_img}" alt="${item.product_title}" style="width: 50px; height: 50px; object-fit: cover;"></td>
                    <td>${item.product_title}</td>
                    <td>${item.customer_name}</td>
                    <td>${item.contact_number}</td>
                    <td>${item.date}</td>
                    <td>${item.email}</td>
                    <td>${item.address}</td>
                    <td>${item.description}</td>
                </tr>
            `;
            messagesContainer.append(row);
        });
    }

    // Render Pagination Buttons
    function renderPagination(total, currentPage, limit) {
        const totalPages = Math.ceil(total / limit);
        paginationContainer.empty();

        if (currentPage > 1) {
            paginationContainer.append(`
                <button data-page="${currentPage - 1}" class="prev"><i class="fa fa-angle-left" aria-hidden="true"></i></button>
            `);
        }

        for (let i = 1; i <= totalPages; i++) {
            paginationContainer.append(`
                <button data-page="${i}" class="${i === currentPage ? "active" : ""}">${i}</button>
            `);
        }

        if (currentPage < totalPages) {
            paginationContainer.append(`
                <button data-page="${currentPage + 1}" class="next"><i class="fa fa-angle-right" aria-hidden="true"></i></button>
            `);
        }

        // Add Click Events
        paginationContainer.find("button").off("click").on("click", function () {
            const page = $(this).data("page");
            const query = searchInput.val().trim();
            const date = datepicker.val().trim();
            fetchMessages(page, query, date);
        });
    }

    // Update Pagination Info
    function updateInfoSpan(page, limit, total) {
        const start = (page - 1) * limit + 1;
        const end = Math.min(page * limit, total);
        infoSpan.text(`Showing ${start}-${end} of ${total}`);
    }

    // Input Event Listener with Debounce
    searchInput.on(
        "input",
        debounce(function () {
            const query = searchInput.val().trim();
            const date = datepicker.val().trim();
            fetchMessages(1, query, date); // Search on first page
        }, 2000) // 2-second debounce
    );

    // Datepicker Change Listener with Debounce
    datepicker.on(
        "change",
        debounce(function () {
            const date = datepicker.val().trim();
            const query = searchInput.val().trim();
            fetchMessages(1, query, date); // Search on first page
        }, 2000) // 2-second debounce
    );
	
	// Reset Filters Function
    resetButton.on("click", function () {
        // Reset filters
        datepicker.val(""); // Clear datepicker value
        statusDropdown.val(""); // Reset status dropdown to default

        // Fetch listings without filters
        fetchListings(1, "", "");
    });

    // Initialize Datepicker
    datepicker.datepicker({
        dateFormat: 'mm/dd/yy',
        changeMonth: true,
        changeYear: true,
    });

    // Initial Fetch
    fetchMessages(currentPage);
});



</script>