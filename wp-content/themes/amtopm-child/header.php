<?php

// include(get_template_directory() . "/auth.php");

include ('connection.php');
$subSubSiteUrl = get_site_url();

// login
// $youremail = '';
// $password = '';
// $errorMessage = '';

// if (isset($_POST['login'])) {
// 	$successMessage = '';
// 	$errorMessageLogin = '';
	
//     $youremail = $_POST['youremail'];
//     $password = $_POST['password'];
// 	$toPostnAdd = $_POST['toPostnAdd'];
	
//     $check = mysqli_query($con, "SELECT * FROM `account` WHERE (`username`='" . $youremail . "' OR `email`='" . $youremail . "') AND `password`='" . $password . "'");
	
//     $checkResult = mysqli_fetch_array($check);
	
// 	 if (!$check) {
// 		 $errorMessageLogin = "Error in query: " . mysqli_error($con);
// 		 echo "<p style='color: red;'>$errorMessageLogin</p>";
// 		 return;
// 	 }

//     if ($checkResult['id']) {
//         if ($checkResult['status'] == '1') {
//             setcookie("user_id", $checkResult['id'], time() + (86400 * 30), "/");
//             setcookie("user_role", $checkResult['role'], time() + (86400 * 30), "/");
			
// 			set_custom_session_variables("auth", $checkResult);

//             if (!empty($_POST["remember"])) {
//                 setcookie("youremail", $_POST["youremail"], time() + (86400 * 30), "/");
//                 setcookie("password", $_POST["password"], time() + (86400 * 30), "/");
//             } else {
//                 setcookie("youremail", "", time() - 3600, "/");
//                 setcookie("password", "", time() - 3600, "/");
//             }

// 			if($toPostnAdd == 'sell'){
// 	            header('Location: /post-an-ad/');				
// 			}
// 			else{
// 				header('Location: /dashboard/');
// 			}

//         } else {
//             $errorMessageLogin = "Your account is inactive. Kindly contact admin to activate your account!";
//         }
//     } else {
//         $errorMessageLogin = "Invalid login credentials!";
//     }
// }

?>

<style>
	.formError{
		color: red;
		font-size: 13px;
		padding: 5px;
		float: left;
		font-weight: bold;
		padding-bottom: 20px;
	}
.category-item.has-children a p{
/* 	display: none; */
	color: #000 !important;
	padding: 5px 20px;
	font-size: 10px;
	line-height: 1.4;
	list-style: none !important;
	text-decoration: none !important;
	margin: 0 !important;
}
.categories-list li{
	margin: 0 !important;
}
.bully-sticky{
    position: fixed !important;
    top: 0;
    left: 0;
    width: 100%;
	background-color:#fff;
	z-index:9;
}	
.spinner {
    width: 16px;
    height: 16px;
    border: 2px solid rgba(255, 255, 255, 0.5);
    border-top: 2px solid white;
    border-radius: 50%;
    animation: spin 1s linear infinite;
    display: inline-block;
    margin-left: 5px;
	vertical-align: sub;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
.loading {
    border: 4px solid #ffff;
    border-radius: 50%;
    border-top: 4px solid #3498db;
    width: 16px;
    height: 16px;
    -webkit-animation: spin 2s linear infinite;
    animation: spin 2s linear infinite;
    position: absolute;
    right: 200px;
    z-index: 999;
}
	/* ruk register page */

/* Modal Popup Styling */
.ruk-register-form .modal {
    display: none; /* Hidden by default */
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent background */
    justify-content: center;
    align-items: center;
}

.ruk-register-form .modal-content {
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    width: 100%;
    max-width: 600px;
    position: relative;
}

.ruk-register-form .close {
    position: absolute;
    top: 10px;
    right: 20px;
    font-size: 24px;
    cursor: pointer;
}

/* Rest of the styles for form (as before) */


.ruk-register-form .container {
    width: 100%;
    text-align: center;
}

.ruk-register-form .logo img {
    width: 150px;
    margin-bottom: 20px;
}

.ruk-register-form h2 {
    font-size: 28px;
    color: #333;
}

.ruk-register-form .description {
    font-size: 16px;
    color: #666;
    margin-bottom: 20px;
}

.ruk-register-form .register-form .form-group {
    position: relative;
    margin-bottom: 15px;
}

.ruk-register-form .register-form input {
    width: 100%;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 14px;
}

.ruk-register-form .register-form input::placeholder {
    color: #999;
}

.ruk-register-form .toggle-password {
    position: absolute;
    right: 15px;
    top: 50%;
    transform: translateY(-50%);
    cursor: pointer;
    font-size: 18px;
    color: #999;
}

.ruk-register-form .btn {
    width: 100%;
    padding: 12px;
    background-color: #002855;
    color: #fff;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.ruk-register-form .btn:hover {
    background-color: #00509e;
}

.ruk-register-form .or-divider {
    margin: 20px 0;
    color: #999;
    font-size: 14px;
    position: relative;
}

.ruk-register-form .or-divider::before, .or-divider::after {
    content: "";
    position: absolute;
    width: 40%;
    height: 1px;
    background-color: #ccc;
    top: 50%;
}

.ruk-register-form .or-divider::before {
    left: 0;
}

.ruk-register-form .or-divider::after {
    right: 0;
}

.ruk-register-form .social-buttons {
    display: flex;
    justify-content: space-between;
}

.ruk-register-form .social-btn {
    width: 30%;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 14px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.ruk-register-form .social-btn.google {
	border:1px solid #4D4D4D;
	border-radius:3px;
}

.ruk-register-form .social-btn.facebook {
	border:1px solid #4D4D4D;
	border-radius:3px;
}

.ruk-register-form .social-btn.apple {
	border:1px solid #4D4D4D;
	border-radius:3px;
}

.ruk-register-form .social-btn:hover {
    opacity: 0.8;
}

.ruk-register-form .footer-text {
    margin-top: 20px;
    font-size: 14px;
}

.ruk-register-form .footer-text a {
    color: #00509e;
    text-decoration: none;
}

.ruk-register-form .footer-text a:hover {
    text-decoration: underline;
}
.ruk-register-form .register-form  .btn {
    width:142px;
    padding:14px 0px !important;
    border-radius:35px;
    background-color:#0B1E3E;
}

/* end of ruk register page */

/* ruk mega menu section */
.all-categories .fa-angle-down {
    margin-top: 5px;
}
/* top search sec	 */
.search-container .select2-selection--single {
    border: unset !important;
 }

.select2-container--open .select2-dropdown--below {
    width: 182px !important;
}
	
.select2-container--default .select2-results>.select2-results__options {
    max-height: 300px !important;
    overflow-y: auto;
}	
.select2-results__options .select2-results__option {
    padding-left: 15px;
    font-size: 12px;
    line-height: 15px
}
.select2-container--open .select2-dropdown {
    left: -70px !important;
    top: 6px !important;
}
.select2-container--default .select2-search--dropdown .select2-search__field {
    border-bottom: 1px solid #000 !important;
    border-radius: 0px !important;
}	
/* Hide the default arrow */
.ruk-select-dropdown .select2-container--default .select2-selection--single .select2-selection__arrow b {
    display: none;
}

/* Add Font Awesome icon */
.ruk-select-dropdown .select2-container--default .select2-selection--single .select2-selection__arrow::before {
    content: "\f107"; /* Unicode for Font Awesome down arrow in v4 */
    font-family: "FontAwesome";
    font-size: 16px; /* Adjust the icon size as needed */
    color: #080808; /* Set the icon color */
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%); /* Center the icon */
}
	
@media only screen and (max-width: 1440px) {

  .site-branding-search .logo img {
    width: 105px !important;
    margin-top: -6px;
}
  .search-container {
    margin-left: 80px;
}
  .site-branding-search {
    background-color: #0B1E3E;
    height: 68px !important;
    color: #fff;
}
  
  .search-container {
    height: 30px;
}
  .search-container input[type="text"] {
    font-size: 10px !important;
  }


.search-container .ruk-select {
  font-size: 12px !important;
  }

.search-container .search-button svg {
    
    width:18px;
}
.ruk-select-dropdown {
    margin-right: 6px;
}
  .search-container .ruk-select {
    max-width: 130px;
}
  .ruk-custom-main-nav .all-categories {
     font-size: 12px !important;
 }
  .ruk-custom-top-nav .nav-link {
    font-size: 13px;
}
 .ruk-custom-main-nav .all-categories {
    padding: 6px 5px !important;
}
.ruk-custom-main-nav .fa-heart-o {
    margin-top: 5px;
}
.ruk-custom-main-nav .fa-bell {
    margin-top: 5px;
}
.ruk-custom-main-nav .nav-link{
    font-size:13px;
	font-weight:bold;
}
.custom-header .navbar {
    padding: 0.5px !important;
}
.ruk-select-dropdown {
    margin-right: 6px !important;
}	
 .search-container .ruk-select {
    padding: 8px 4px;
    max-width: 125px !important;
}
.search-button svg {
     width: 18px;
}
.ruk-custom-top-nav .dropdown-toggle small {
    font-size: 9px !important;
}
.ruk-custom-top-header .ruk-custom-top-nav {
    margin-top:2px !important;
}
.select2-container--open .select2-dropdown {
    left: -82px !important;
    top: 6px !important;
}
.select2-container--default .select2-selection--single .select2-selection__placeholder {
    color: #000000 !important;
    font-size: 11px;
}
	
}	
		
	
@-webkit-keyframes spin {
    0% { -webkit-transform: rotate(0deg); }
    100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
</style>
<?php

if(isset($_GET["user-action"]) && $_GET["user-action"]=='logout'){ 
	setcookie("user_id",0, time() + (86400 * 30), "/");
	setcookie("user_role",0, time() + (86400 * 30), "/");
   session_destroy();
   header("location: /");
}
?>



<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<?php
	
	$nectar_options = get_nectar_theme_options();
	
	nectar_meta_viewport();
	
	// Shortcut icon fallback.
	if ( ! empty( $nectar_options['favicon'] ) && ! empty( $nectar_options['favicon']['url'] ) ) {
		echo '<link rel="shortcut icon" href="'. esc_url( nectar_options_img( $nectar_options['favicon'] ) ) .'" />';
	}
	
	wp_head();
	
?>

	
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
<!-- 	bootstrap -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">	
<!-- Manrope -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>
<?php

// $nectar_header_options = nectar_get_header_variables();

?>
	
<body <?php body_class(); ?> <?php nectar_body_attributes(); ?> id="ruk-body">	
	
<?php echo "<!-- Custom Header Loaded -->"; ?>

<header class="custom-header">
	<div class="site-branding-search">		
		<div class="container-ruk">
			<div class="row ruk-custom-top-header">
				<div class="col-lg-1 col-md-1 logo">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
						<img src="/wp-content/uploads/2024/10/footer-logoo.png" alt="Site Logo">
					</a>
				</div>
				<div class="col-lg-8 col-md-9 search-sec-top">
					 <div class="search-container">
						 
						 
						<!-- Search Input -->
								<input 
								   type="text" 
								   id="search-input" 
								   placeholder="Find Bully, Supplies and more...." 
								   autocomplete="off"
								   value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>"
								   />
						 	<div class="loading" style="display: none;"></div>
							<div id="suggestions-dropdown" class="suggestions-dropdown"></div>
							
						 
						 	<!-- Locations Dropdown -->
		<div class="ruk-select-dropdown">						 
			<select id="state" class="ruk-select ruk-state-select state1" name="state" data-live-search="true">
					<option value="">Locations</option>
					<option value="AL" <?php echo (isset($_GET['state']) && ($_GET['state'] == "AL")) ? 'selected' : ''; ?>>Alabama</option>
					<option value="AK" <?php echo (isset($_GET['state']) && ($_GET['state'] == "AK")) ? 'selected' : ''; ?>>Alaska</option>
					<option value="AZ" <?php echo (isset($_GET['state']) && ($_GET['state'] == "AZ")) ? 'selected' : ''; ?>>Arizona</option>
					<option value="AR" <?php echo (isset($_GET['state']) && ($_GET['state'] == "AR")) ? 'selected' : ''; ?>>Arkansas</option>
					<option value="CA" <?php echo (isset($_GET['state']) && ($_GET['state'] == "CA")) ? 'selected' : ''; ?>>California</option>
					<option value="CO" <?php echo (isset($_GET['state']) && ($_GET['state'] == "CO")) ? 'selected' : ''; ?>>Colorado</option>
					<option value="CT" <?php echo (isset($_GET['state']) && ($_GET['state'] == "CT")) ? 'selected' : ''; ?>>Connecticut</option>
					<option value="DE" <?php echo (isset($_GET['state']) && ($_GET['state'] == "DE")) ? 'selected' : ''; ?>>Delaware</option>
					<option value="FL" <?php echo (isset($_GET['state']) && ($_GET['state'] == "FL")) ? 'selected' : ''; ?>>Florida</option>
					<option value="GA" <?php echo (isset($_GET['state']) && ($_GET['state'] == "GA")) ? 'selected' : ''; ?>>Georgia</option>
					<option value="HI" <?php echo (isset($_GET['state']) && ($_GET['state'] == "HI")) ? 'selected' : ''; ?>>Hawaii</option>
					<option value="ID" <?php echo (isset($_GET['state']) && ($_GET['state'] == "ID")) ? 'selected' : ''; ?>>Idaho</option>
					<option value="IL" <?php echo (isset($_GET['state']) && ($_GET['state'] == "IL")) ? 'selected' : ''; ?>>Illinois</option>
					<option value="IN" <?php echo (isset($_GET['state']) && ($_GET['state'] == "IN")) ? 'selected' : ''; ?>>Indiana</option>
					<option value="IA" <?php echo (isset($_GET['state']) && ($_GET['state'] == "IA")) ? 'selected' : ''; ?>>Iowa</option>
					<option value="KS" <?php echo (isset($_GET['state']) && ($_GET['state'] == "KS")) ? 'selected' : ''; ?>>Kansas</option>
					<option value="KY" <?php echo (isset($_GET['state']) && ($_GET['state'] == "KY")) ? 'selected' : ''; ?>>Kentucky</option>
					<option value="LA" <?php echo (isset($_GET['state']) && ($_GET['state'] == "LA")) ? 'selected' : ''; ?>>Louisiana</option>
					<option value="ME" <?php echo (isset($_GET['state']) && ($_GET['state'] == "ME")) ? 'selected' : ''; ?>>Maine</option>
					<option value="MD" <?php echo (isset($_GET['state']) && ($_GET['state'] == "MD")) ? 'selected' : ''; ?>>Maryland</option>
				<option value="MA" <?php echo (isset($_GET['state']) && ($_GET['state'] == "MA")) ? 'selected' : ''; ?>>Massachusetts</option>
					<option value="MA" <?php echo (isset($_GET['state']) && ($_GET['state'] == "MI")) ? 'selected' : ''; ?>>Michigan</option>
					<option value="MN" <?php echo (isset($_GET['state']) && ($_GET['state'] == "MN")) ? 'selected' : ''; ?>>Minnesota</option>
					<option value="MS" <?php echo (isset($_GET['state']) && ($_GET['state'] == "MS")) ? 'selected' : ''; ?>>Mississippi</option>
					<option value="MO" <?php echo (isset($_GET['state']) && ($_GET['state'] == "MO")) ? 'selected' : ''; ?>>Missouri</option>
					<option value="MT" <?php echo (isset($_GET['state']) && ($_GET['state'] == "MT")) ? 'selected' : ''; ?>>Montana</option>
					<option value="NE" <?php echo (isset($_GET['state']) && ($_GET['state'] == "NE")) ? 'selected' : ''; ?>>Nebraska</option>
					<option value="NV" <?php echo (isset($_GET['state']) && ($_GET['state'] == "NV")) ? 'selected' : ''; ?>>Nevada</option>
				<option value="NH" <?php echo (isset($_GET['state']) && ($_GET['state'] == "NH")) ? 'selected' : ''; ?>>New Hampshire</option>
					<option value="NJ" <?php echo (isset($_GET['state']) && ($_GET['state'] == "NJ")) ? 'selected' : ''; ?>>New Jersey</option>
					<option value="NM" <?php echo (isset($_GET['state']) && ($_GET['state'] == "NM")) ? 'selected' : ''; ?>>New Mexico</option>
					<option value="NY" <?php echo (isset($_GET['state']) && ($_GET['state'] == "NY")) ? 'selected' : ''; ?>>New York</option>
				<option value="NC" <?php echo (isset($_GET['state']) && ($_GET['state'] == "NC")) ? 'selected' : ''; ?>>North Carolina</option>
				<option value="ND" <?php echo (isset($_GET['state']) && ($_GET['state'] == "ND")) ? 'selected' : ''; ?>>North Dakota</option>
					<option value="OH" <?php echo (isset($_GET['state']) && ($_GET['state'] == "OH")) ? 'selected' : ''; ?>>Ohio</option>
					<option value="OK" <?php echo (isset($_GET['state']) && ($_GET['state'] == "OK")) ? 'selected' : ''; ?>>Oklahoma</option>
					<option value="OR" <?php echo (isset($_GET['state']) && ($_GET['state'] == "OR")) ? 'selected' : ''; ?>>Oregon</option>
				<option value="PA" <?php echo (isset($_GET['state']) && ($_GET['state'] == "PA")) ? 'selected' : ''; ?>>Pennsylvania</option>
				<option value="RI" <?php echo (isset($_GET['state']) && ($_GET['state'] == "RI")) ? 'selected' : ''; ?>>Rhode Island</option>
				<option value="SC" <?php echo (isset($_GET['state']) && ($_GET['state'] == "SC")) ? 'selected' : ''; ?>>South Carolina</option>
				<option value="SD" <?php echo (isset($_GET['state']) && ($_GET['state'] == "SD")) ? 'selected' : ''; ?>>South Dakota</option>
				<option value="TN" <?php echo (isset($_GET['state']) && ($_GET['state'] == "TN")) ? 'selected' : ''; ?>>Tennessee</option>
				<option value="TX" <?php echo (isset($_GET['state']) && ($_GET['state'] == "TX")) ? 'selected' : ''; ?>>Texas</option>
				<option value="UT" <?php echo (isset($_GET['state']) && ($_GET['state'] == "UT")) ? 'selected' : ''; ?>>Utah</option>
				<option value="VT" <?php echo (isset($_GET['state']) && ($_GET['state'] == "VT")) ? 'selected' : ''; ?>>Vermont</option>
				<option value="VA" <?php echo (isset($_GET['state']) && ($_GET['state'] == "VA")) ? 'selected' : ''; ?>>Virginia</option>
				<option value="WA" <?php echo (isset($_GET['state']) && ($_GET['state'] == "WA")) ? 'selected' : ''; ?>>Washington</option>
				<option value="WV" <?php echo (isset($_GET['state']) && ($_GET['state'] == "WV")) ? 'selected' : ''; ?>>West Virginia</option>
				<option value="WI" <?php echo (isset($_GET['state']) && ($_GET['state'] == "WI")) ? 'selected' : ''; ?>>Wisconsin</option>
				<option value="WY" <?php echo (isset($_GET['state']) && ($_GET['state'] == "WY")) ? 'selected' : ''; ?>>Wyoming</option>
		        <option value="DC" <?php echo (isset($_GET['state']) && ($_GET['state'] == "DC")) ? 'selected' : ''; ?>>District of Columbia</option>
				<option value="AS" <?php echo (isset($_GET['state']) && ($_GET['state'] == "AS")) ? 'selected' : ''; ?>>American Samoa</option>
				<option value="GU" <?php echo (isset($_GET['state']) && ($_GET['state'] == "GU")) ? 'selected' : ''; ?>>Guam</option>
            	<option value="MP" <?php echo (isset($_GET['state']) && ($_GET['state'] == "MP")) ? 'selected' : ''; ?>>Northern Mariana Islands</option>
				<option value="PR" <?php echo (isset($_GET['state']) && ($_GET['state'] == "PR")) ? 'selected' : ''; ?>>Puerto Rico</option>
	        	<option value="VI" <?php echo (isset($_GET['state']) && ($_GET['state'] == "VI")) ? 'selected' : ''; ?>>Virgin Islands, U.S.</option>
			</select>
		</div> 						 
						 
			

						 
	<!-- new dropdown -->
	
						 
<!-- 
 				<div class="bully-dropdown">
					<button class="dropdown-toggle" onclick="bullytoggleDropdown()" id="selectedCountryButton">
						<img src="https://flagcdn.com/w320/pk.png" alt="Pakistan Flag" class="flag-icon" id="selectedCountryFlag">
						<span id="selectedCountryName">Pakistan</span>
						<span class="arrow">&#9662;</span>
					</button>
					<div class="bully-dropdown-content" id="bullyDropdownContent">
						<input type="text" placeholder="Search..." class="search-box" oninput="filterCountries()">
						<ul id="country-list">
							<li>
								<input type="radio" name="country" value="Albania" onclick="selectCountry('Albania', 'https://flagcdn.com/w320/al.png')">
								<img src="https://flagcdn.com/w320/al.png" alt="Albania Flag" class="flag-icon">
								Albania
							</li>
							<li>
								<input type="radio" name="country" value="Algeria" onclick="selectCountry('Algeria', 'https://flagcdn.com/w320/dz.png')">
								<img src="https://flagcdn.com/w320/dz.png" alt="Algeria Flag" class="flag-icon">
								Algeria
							</li>
							<li>
								<input type="radio" name="country" value="Andorra" onclick="selectCountry('Andorra', 'https://flagcdn.com/w320/ad.png')">
								<img src="https://flagcdn.com/w320/ad.png" alt="Andorra Flag" class="flag-icon">
								Andorra
							</li>
									  <li>
								<input type="radio" name="country" value="Albania" onclick="selectCountry('Albania', 'https://flagcdn.com/w320/al.png')">
								<img src="https://flagcdn.com/w320/al.png" alt="Albania Flag" class="flag-icon">
								Albania
							</li>
							<li>
								<input type="radio" name="country" value="Algeria" onclick="selectCountry('Algeria', 'https://flagcdn.com/w320/dz.png')">
								<img src="https://flagcdn.com/w320/dz.png" alt="Algeria Flag" class="flag-icon">
								Algeria
							</li>
							<li>
								<input type="radio" name="country" value="Andorra" onclick="selectCountry('Andorra', 'https://flagcdn.com/w320/ad.png')">
								<img src="https://flagcdn.com/w320/ad.png" alt="Andorra Flag" class="flag-icon">
								Andorra
							</li>
							<li>
								<input type="radio" name="country" value="Albania" onclick="selectCountry('Albania', 'https://flagcdn.com/w320/al.png')">
								<img src="https://flagcdn.com/w320/al.png" alt="Albania Flag" class="flag-icon">
								Albania
							</li>
							<li>
								<input type="radio" name="country" value="Algeria" onclick="selectCountry('Algeria', 'https://flagcdn.com/w320/dz.png')">
								<img src="https://flagcdn.com/w320/dz.png" alt="Algeria Flag" class="flag-icon">
								Algeria
							</li>
							<li>
								<input type="radio" name="country" value="Andorra" onclick="selectCountry('Andorra', 'https://flagcdn.com/w320/ad.png')">
								<img src="https://flagcdn.com/w320/ad.png" alt="Andorra Flag" class="flag-icon">
								Andorra
							</li>          
						</ul>
					</div>
				</div>
 -->
						 
						<!-- Search Button -->
						<button class="search-button">
							<svg width="19" height="18" viewBox="0 0 19 18" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M17.8301 16.4698L14.5084 13.175C15.7977 11.5673 16.4222 9.52668 16.2532 7.47275C16.0843 5.41882 15.1348 3.50768 13.6 2.1323C12.0653 0.75692 10.0619 0.021842 8.00179 0.0782135C5.94169 0.134585 3.98149 0.978121 2.52424 2.43537C1.06699 3.89262 0.223452 5.85283 0.167081 7.91292C0.110709 9.97301 0.845787 11.9764 2.22117 13.5112C3.59655 15.0459 5.50769 15.9954 7.56161 16.1644C9.61554 16.3333 11.6561 15.7089 13.2638 14.4195L16.5587 17.7144C16.6419 17.7983 16.741 17.8649 16.8501 17.9104C16.9592 17.9558 17.0762 17.9792 17.1944 17.9792C17.3126 17.9792 17.4296 17.9558 17.5387 17.9104C17.6478 17.8649 17.7469 17.7983 17.8301 17.7144C17.9915 17.5474 18.0817 17.3243 18.0817 17.0921C18.0817 16.8599 17.9915 16.6368 17.8301 16.4698ZM8.24092 14.4195C7.00133 14.4195 5.78959 14.0519 4.75891 13.3632C3.72824 12.6746 2.92492 11.6957 2.45055 10.5505C1.97619 9.40527 1.85207 8.1451 2.0939 6.92933C2.33573 5.71357 2.93265 4.59682 3.80916 3.7203C4.68568 2.84378 5.80243 2.24686 7.0182 2.00503C8.23396 1.7632 9.49414 1.88732 10.6394 2.36169C11.7846 2.83605 12.7634 3.63937 13.4521 4.67004C14.1408 5.70072 14.5084 6.91247 14.5084 8.15205C14.5084 9.81428 13.848 11.4084 12.6727 12.5838C11.4973 13.7592 9.90314 14.4195 8.24092 14.4195Z" fill="#191919"/>
							</svg>

						</button>
						 
<!-- 						<div id="loading-indicator" style="display: none;">Loading...</div> -->
					</div>
				</div>
			
				
				
				<div class="col-lg-3 col-md-2 top-right-nav">
					<nav class="navbar navbar-expand-lg navbar-light">
					 <ul class="navbar-nav me-auto mb-2 mb-lg-0 ruk-custom-top-nav">
<!-- 						 
						 <li class="nav-item">
				<a id="open-modal" class="nav-link" href="#">
			<svg xmlns="http://www.w3.org/2000/svg" width="29" height="29" viewBox="0 0 29 29" fill="none"><path d="M14.4002 17.9996C18.3766 17.9996 21.6002 14.7761 21.6002 10.7996C21.6002 6.82316 18.3766 3.59961 14.4002 3.59961C10.4237 3.59961 7.2002 6.82316 7.2002 10.7996C7.2002 14.7761 10.4237 17.9996 14.4002 17.9996Z" stroke="white" stroke-width="1.8" stroke-miterlimit="10"></path><path d="M3.4873 24.2991C4.59311 22.3833 6.18374 20.7925 8.0993 19.6864C10.0149 18.5803 12.1878 17.998 14.3998 17.998C16.6118 17.998 18.7847 18.5803 20.7003 19.6864C22.6159 20.7925 24.2065 22.3833 25.3123 24.2991" stroke="white" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"></path></svg></a>
						</li> -->
						 
						<li class="nav-item">
						  <a class="nav-link"  href="/blog/">Blogs</a>
						</li>
						<li class="nav-item">
						  <a class="nav-link" href="/about-us/">About</a>
						</li>
						<li class="nav-item">
							<a id="" class="nav-link" href="#">Help</a>
						</li>					 
						<li class="nav-item dropdown">
						  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							  <small>Hello</small><br>
							<?php echo get_custom_session_variables('auth') ? get_custom_session_variables('auth')['firstname'] : 'Sign in'; ?>
						  </a>
						  <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
							<li class="nav-item sign-in-user"><a id="open-modal" class="nav-link" href="#">Sign In</a></li>
							<li class="nav-item sign-up-user"><a class="nav-link" href="#">Sign Up</a></li>
						  </ul>
						</li>
					  </ul>	
					</nav>
				</div>
			</div>
		</div>
	</div>
	<div class="navbar navbar-sticky-sec">
		<div class="container-ruk">	
		<nav class="navbar navbar-expand-lg navbar-light w-100 ruk-custom-main-nav">
		  <div class="container-fluid">
			  
			  
<!-- 			<a class="navbar-brand all-categories" href="#">All Categories &nbsp;&nbsp;<i class="fa fa-caret-down" aria-hidden="true"></i></a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
			  <span class="navbar-toggler-icon"></span>
			</button> -->
			  
			  
			  <!-- All Categories Dropdown -->
			  <div class="all-categories-menu">
				  <a class="navbar-brand all-categories header-all-categories" href="#">All Categories &nbsp;&nbsp;<i class="fa fa-angle-down" aria-hidden="true"></i></a>
				  <div class="categories-dropdown header-categories-dropdown" style="display: none;">
					  <ul class="categories-list">
						  <?php
						  global $wpdb;
						  $categories = $wpdb->get_results("SELECT id, name FROM `categories` WHERE category_level = 1");
						  if (!empty($categories)) {
							  foreach ($categories as $category) { ?>
						  <li class="category-item has-children <?php echo esc_attr(sanitize_title($category->name)); ?>">
							  <a href="#" class="cta-links">
								  <?php echo esc_html($category->name); ?>
								  <p class="cta-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.</p>
							  </a>
							  <?php
									$subCategories = $wpdb->get_results("SELECT id, name FROM `categories` WHERE parent_id = ".$category->id);
									if (!empty($subCategories)) { ?>
							  <ul class="sub-menu">
								  <?php foreach ($subCategories as $subCategory) { 
								  	$subCategoryParam = urlencode($subCategory->name);
						         	$subSiteUrl = get_site_url();?>
								  <li class="sub-category-item sub-has-children <?php echo esc_attr(sanitize_title($subCategory->name)); ?>">
									  <a href="<?php echo esc_url($subSiteUrl . '/category/?search_sub_category=' . $subCategoryParam); ?>"><?php echo esc_html($subCategory->name); ?></a>
									  <?php
								$subSubCategories = $wpdb->get_results("SELECT id, name FROM `categories` WHERE parent_id = ".$subCategory->id);
								if (!empty($subSubCategories)) { ?>
									  <ul class="sub-sub-menu">
										  <?php foreach ($subSubCategories as $subSubCategory) { 
												$subSubCategoryParam = urlencode($subSubCategory->name);
												$subSubSiteUrl = get_site_url();?>
										  <li class="sub-sub-li <?php echo esc_attr(sanitize_title($subSubCategory->name)); ?>">
											  <a href="<?php echo esc_url($subSubSiteUrl . '/category/?search_sub_sub_category=' . $subSubCategoryParam); ?>"><?php echo esc_html($subSubCategory->name); ?></a>
										  </li>
										  <?php } ?>
									  </ul>
									  <?php } ?>
								  </li>
								  <?php } ?>
							  </ul>
							  <?php } ?>
						  </li>
						  <?php }
						  } ?>
					  </ul>
				  </div>
			  </div>
			  
			  
			<div class="collapse navbar-collapse" id="navbarText">
				<div class="d-flex w-100 justify-content-between thebully-main-nav">
					
				  <div class="col-lg-3 col-md-3 top-right-nav">
					<nav class="navbar navbar-expand-lg navbar-light">
					 <ul class="navbar-nav me-auto mb-2 mb-lg-0 ruk-custom-top-nav">
						 <?php
						 $bullyCategories = $wpdb->get_results("SELECT * FROM `categories` WHERE parent_id = 1");
						 if (!empty($bullyCategories)) { ?>
						 <?php foreach ($bullyCategories as $bullyCategory) { 
						         $categoryParam = urlencode($bullyCategory->name);
						         $siteUrl = get_site_url(); ?>
							<li class="nav-item">
							  <a class="nav-link" href="<?php echo esc_url($siteUrl . '/category/?search_sub_category=' . $categoryParam); ?>"><?php echo esc_html($bullyCategory->name); ?></a>
							</li>
						 <?php }
						}?>
					  </ul>	
					</nav>
				</div>
					
				  <ul class="navbar-nav ms-auto mb-2 mb-lg-0 d-flex align-items-center">
					<li class="nav-item">
					  <a class="nav-link" href="#" id="sellLink">Sell</a>
					</li>
					<li class="nav-item">
					  <a class="nav-link" href="#"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
					</li>
					<li class="nav-item">
					  <a class="nav-link" href="#"><i class="fa fa-bell" aria-hidden="true"></i></a>
					</li>
				  </ul>
				</div>
			  </div>
		  </div>
		</nav>
		</div>
	</div>
</header>

<!-- login & register popup	 -->
<section class="ruk-register-form">
    <div id="register-modal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
			
			<!-- Modal Popup for Register Form -->
            <div class="container" id="signup-container" style="display: none;">
                <div class="logo">
                    <img src="/wp-content/uploads/2024/11/image-43.png" alt="The Bally Supply Logo">
                </div>
                <h2>Sign Up</h2>
                <p class="description">Ready to become part of the exclusive club? Fill in the details below, and let the journey begin!</p>
				
				<span class="error-msg register-error-msg"><?php echo $errorMessageSignup; ?></span>
				<span class="success-msg register-success-msg"></span>
                
         
				<form name="signup" class="register-form" method="POST" enctype="multipart/form-data">
					<div class="form-group">
						<input type="text" id="fullname" name="fullname" placeholder="Full Name" required>
						<span class="formError" id="fullnameError"></span>
					</div>
					<div class="form-group">
						<input type="email" id="email" name="email" placeholder="Email Address" required>
						<span class="formError" id="emailError"></span>
					</div>
					<div class="form-group">
						<input type="password" id="password" name="password" placeholder="Password" required>
						<span class="formError" id="passwordError"></span>
						<span class="toggle-password" onclick="togglePassword('password')">
							<i class="fa fa-eye-slash" aria-hidden="true"></i>
						</span>						
					</div>
					<div class="form-group">
						<input type="password" id="confirm-password" name="confirmPassword" placeholder="Confirm Password" required>
						<span class="formError" id="confirmPasswordError"></span>
						<span class="toggle-password" onclick="togglePassword('confirm-password')">
							<i class="fa fa-eye-slash" aria-hidden="true"></i>
						</span>						
					</div>
					<button type="submit" name="signup" class="btn" id="signup-btn">
						<span>Sign Up</span>
						<span class="spinner" style="display: none;"></span>
					</button>
				</form>


                <div class="or-divider">or</div>

                <div class="social-buttons">
                    <button class="social-btn google"><img src="/wp-content/uploads/2024/10/google-icon-1.png" alt="google"/></button>
                    <button class="social-btn facebook"><img src="/wp-content/uploads/2024/10/facebook-icon-1.png" alt="facebook"/></button>
                    <button class="social-btn apple"><img src="/wp-content/uploads/2024/10/app-icon-1.png" alt="apple"/></button>
                </div>

                <p class="footer-text">
                    Already have an account? <a href="#" id="show-login">Sign in</a>
                </p>
            </div>
			
			
			<div class="container" id="login-container">
				<div class="logo">
					<img src="/wp-content/uploads/2024/11/image-43.png" alt="The Bally Supply Logo">
				</div>
				<h2>Sign In</h2>
				<p class="description">Ready to become part of the exclusive club? Fill in the details below, and let the journey begin!</p>

				<span class="error-msg login-error-msg" style="color: red;"></span>
				<span class="success-msg login-success-msg" style="color: green;"></span>

				<form name="login" method="post" action="" class="formValidationQuery login-form">
					<input type="hidden" id="toPostnAdd" name="toPostnAdd" value="" />
					<div class="form-group">
						<input type="email" id="youremail" name="youremail" placeholder="Email Address" value="<?php if (isset($_COOKIE['youremail'])) { echo $_COOKIE['youremail']; } ?>" required />
						<span class="formError" id="youremailError"></span>
					</div>
					<div class="form-group">
						<input type="password" id="loginPassword" name="password" placeholder="Password" value="<?php if (isset($_COOKIE['password'])) { echo $_COOKIE['password']; } ?>" required />
						<span class="toggle-password" onclick="togglePassword('loginPassword')">
							<i class="fa fa-eye-slash" aria-hidden="true"></i>
						</span>
						<span class="formError" id="loginPasswordError"></span>
					</div>
					<button type="submit" name="login" class="btn" id="login-btn">
						<span>Sign In</span>
						<span class="spinner" style="display: none;"></span>
					</button>
				</form>

				<div class="or-divider">or</div>

				<div class="social-buttons">
					<button class="social-btn google"><img src="/wp-content/uploads/2024/10/google-icon-1.png" alt="google"/></button>
					<button class="social-btn facebook"><img src="/wp-content/uploads/2024/10/facebook-icon-1.png" alt="facebook"/></button>
					<button class="social-btn apple"><img src="/wp-content/uploads/2024/10/app-icon-1.png" alt="apple"/></button>
				</div>

				<p class="footer-text">
					Don't have an account? <a href="#" id="show-signup">Register</a>
				</p>
			</div>

        </div>
    </div>
</section>
<!-- login & register popup	 -->
	
	
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
	
	
	
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
	
<script>
	
document.addEventListener("DOMContentLoaded", function () {
    const loginForm = document.querySelector(".login-form");
    const loginBtn = document.getElementById("login-btn");
    const spinner = loginBtn.querySelector(".spinner");
    const errorMsg = document.querySelector(".login-error-msg");
    const successMsg = document.querySelector(".login-success-msg");
    const ajaxUrl = "<?php echo admin_url('admin-ajax.php'); ?>";

    loginForm.addEventListener("submit", function (e) {
        e.preventDefault();
		
	    loginBtn.disabled = true;
    	spinner.style.display = "inline-block";

        const formData = new FormData(loginForm);
        formData.append("action", "user_login");

        // Clear messages
        errorMsg.textContent = "";
        successMsg.textContent = "";

        // Show loading spinner
        spinner.style.display = "inline-block";

        fetch(ajaxUrl, {
            method: "POST",
            body: formData,
        })
            .then((response) => response.json())
            .then((result) => {
                spinner.style.display = "none";
			
				console.log('result', result);

                if (result.success) {
                    successMsg.textContent = "Login successful!...";
                    setTimeout(() => {
                        window.location.href = result.data.redirect;
                    }, 1500);
                } else {
                    errorMsg.textContent = result.data.message;
                }
			
				 // Re-enable the button
				loginBtn.disabled = false;
            })
            .catch((error) => {
                spinner.style.display = "none";
                errorMsg.textContent = "An error occurred. Please try again.";
                console.error("Login error:", error);
				loginBtn.disabled = false;
            });
    });
});

	
// navigation bar stiky
$(window).scroll(function(){	       
	if($(this).scrollTop() > 86){
		$('.navbar-sticky-sec').addClass('bully-sticky')
	} else{
		$('.navbar-sticky-sec').removeClass('bully-sticky')
	}
});
// login & register popup

// Function to toggle password visibility
	function togglePassword(fieldId) {		
		var input = document.getElementById(fieldId);
		if (input.type === "password") {
			input.type = "text";
		} else {
			input.type = "password";
		}
	}
		

$('#sellLink').on('click', function(e) {
    e.preventDefault();
	
	console.log('call');

    $.ajax({
        url: '<?php echo get_stylesheet_directory_uri(); ?>/check_auth.php',
        type: 'POST',
        success: function(response) {
            console.log('Server response:', response);

			if (response == 'no') {

				  console.log('run:', response);
				// Show the modal and display the register form
				document.getElementById('register-modal').style.display = "flex";
				document.getElementById('login-container').style.display = "block";
				document.getElementById('signup-container').style.display = "noe";
				
				
				$('#toPostnAdd').val('sell');

				// Display alert message
				document.getElementById('alert-message').innerText = "Please login an account first.";
			} else if (response === 'redirect') {
				// Redirect to the 'post an ad' page
				window.location.href = '/post-an-ad/';
			}
        }
    });
});

	
// Close modal when the close button is clicked
$('.close').on('click', function() {
    $('#register-modal').hide();
    $('#register-alert').hide(); // Hide alert when modal is closed
});
	
	
	// Modal functionality
	const modal = document.getElementById("register-modal");
	const openModal = document.getElementById("open-modal");
	const closeModal = document.querySelector(".close");

	// Open the modal when 'Register' link is clicked
	openModal.addEventListener("click", function(e) {
		e.preventDefault();
		console.log('open modal');
		modal.style.display = "flex";  // Show modal as flex
	});

	// Close the modal when 'x' is clicked
	closeModal.addEventListener("click", function() {
		modal.style.display = "none";
	});

	// Close the modal if clicking outside the content area
	window.addEventListener("click", function(e) {
		if (e.target === modal) {
			modal.style.display = "none";
		}
	});	



	document.getElementById('signup-container').style.display = 'none';
	document.getElementById('login-container').style.display = 'block';

	document.getElementById('show-login').addEventListener('click', function(event) {
		event.preventDefault();
		document.getElementById('signup-container').style.display = 'none';
		document.getElementById('login-container').style.display = 'block';
	});

	document.getElementById('show-signup').addEventListener('click', function(event) {
		event.preventDefault();
		document.getElementById('login-container').style.display = 'none';
		document.getElementById('signup-container').style.display = 'block';
	});

// login & register popup
	
function bullytoggleDropdown() {
	const bullyDropdownContent = document.getElementById('bullyDropdownContent');
    bullyDropdownContent.style.display = bullyDropdownContent.style.display === 'block' ? 'none' : 'block';
}

// Function to update the selected country
function selectCountry(countryName, countryFlagUrl) {
    document.getElementById('selectedCountryName').textContent = countryName;
    document.getElementById('selectedCountryFlag').src = countryFlagUrl;
    toggleDropdown(); // Close dropdown after selection
}

// Close dropdown if clicking outside of it
window.onclick = function(event) {
    const dropdown = document.querySelector('.bully-dropdown');
	
    if ((dropdown != null) && (!dropdown.contains(event.target))) {
        document.getElementById('bullyDropdownContent').style.display = 'none';
    }
}	
	
// Select the "All Categories" link and the dropdown menu
const allCategoriesLink = document.querySelector('.header-all-categories');
const categoriesDropdown = document.querySelector('.header-categories-dropdown');

// Function to show and hide menus
function showMenu(menu) {
  menu.style.display = 'block';
}

//.bully .sub-menu
 	
function hideMenu(menu) {
  menu.style.display = 'none';
}

// Toggle the dropdown when clicking "All Categories"
allCategoriesLink.addEventListener('click', (e) => {
  e.preventDefault();
  const isDropdownVisible = categoriesDropdown.style.display === 'block';
  if (isDropdownVisible) {
    hideMenu(categoriesDropdown);
  } else {
    showMenu(categoriesDropdown);
	
    // Only show sub-menu and sub-sub-menu for the first category
    const firstCategoryItem = categoriesDropdown.querySelector('.category-item');
    if (firstCategoryItem) {
      const firstSubMenu = firstCategoryItem.querySelector('.sub-menu');
      if (firstSubMenu) {
        showMenu(firstSubMenu);

        // Show sub-sub-menu items within the first sub-menu
        firstSubMenu.querySelectorAll('.sub-sub-menu').forEach(subSubMenu => {
          showMenu(subSubMenu);
        });
      }
    }	  	  	  
	  
  }
});

// Close the mega menu when clicking outside of it
document.addEventListener('click', (e) => {
  if (!categoriesDropdown.contains(e.target) && e.target !== allCategoriesLink) {
    hideMenu(categoriesDropdown);
  }
});	

const categoryItems = document.querySelectorAll('.category-item');

// Show sub-menu for the first category item with both sub and sub-sub categories
const firstCategoryItem = categoryItems[0];
const remainingCategoryItems = Array.from(categoryItems).slice(1); // Get all except the first

if (firstCategoryItem) {
  const firstChildMenu = firstCategoryItem.querySelector('.sub-menu');

  // Handle first category with sub and sub-sub-menus
  firstCategoryItem.addEventListener('mouseenter', () => {
    if (firstChildMenu) showMenu(firstChildMenu);
  });

  firstCategoryItem.addEventListener('mouseleave', (event) => {
    if (firstChildMenu && !firstCategoryItem.contains(event.relatedTarget)) {
      hideMenu(firstChildMenu);
    }
  });

  // Handle sub-sub-menu for first category's sub-category items
  const firstSubCategoryItems = firstCategoryItem.querySelectorAll('.sub-category-item');
  firstSubCategoryItems.forEach(subCategory => {
    const subChildMenu = subCategory.querySelector('.sub-sub-menu');
    
    subCategory.addEventListener('mouseenter', () => {
      if (subChildMenu) showMenu(subChildMenu);
    });

    subCategory.addEventListener('mouseleave', (event) => {
      if (subChildMenu && !subCategory.contains(event.relatedTarget)) {
        hideMenu(subChildMenu);
      }
    });
  });
}

// For remaining categories, only display sub-menus
remainingCategoryItems.forEach(category => {
  const childMenu = category.querySelector('.sub-menu');
  
  category.addEventListener('mouseenter', () => {
    if (childMenu) showMenu(childMenu);
  });

  category.addEventListener('mouseleave', (event) => {
    if (childMenu && !category.contains(event.relatedTarget)) {
      hideMenu(childMenu);
    }
  });
});

// Functions to show and hide menus
function showMenu(menu) {
  menu.style.display = 'block';
}

function hideMenu(menu) {
  menu.style.display = 'none';
}
	
	
	
// Helper function to validate input fields with custom error messages
function validateField(selector, errorSelector, customErrorMessage) {
    let value = $(selector).val().trim();
    let errorField = $(errorSelector);
    let isValid = true;

    if (value === '' || value === null) {
        errorField.text(customErrorMessage);  // Show custom error message
        isValid = false;
    } else {
        errorField.text('');
    }

    return isValid;
}

// Validate the password and confirm password match
function validatePasswords() {
    const password = $('#password').val().trim();
    const confirmPassword = $('#confirm-password').val().trim();
    const errorField = $('#confirmPasswordError');
    let isValid = true;

    if (password !== confirmPassword) {
        errorField.text('Password and Confirm Password do not match.');
        isValid = false;
    } else {
        errorField.text('');
    }

    // Validate password length (at least 8 characters)
    if (password.length < 8) {
        $('#passwordError').text('Password must be at least 8 characters long.');
        isValid = false;
    } else {
        $('#passwordError').text('');
    }

    return isValid;
}

jQuery(document).ready(function ($) {
    $('#signup-btn').on('click', function (event) {
        event.preventDefault();

        const signUpBtn = $('#signup-btn');
        const spinner = signUpBtn.find('.spinner');
        let isValid = true;
		

        isValid = validateField('#fullname', '#fullnameError', 'Enter your name') && isValid;
        isValid = validateField('#email', '#emailError', 'Enter a valid email') && isValid;
        isValid = validatePasswords() && isValid;

        if (!isValid) return false;

        spinner.show();
		signUpBtn.disabled = true;
        $.ajax({
            type: 'POST',
            url: ajax_object.ajax_url,
            data: {
                action: 'handle_registration',
                nonce: ajax_object.nonce,
                fullname: $('#fullname').val(),
                email: $('#email').val(),
                password: $('#password').val(),
                confirmPassword: $('#confirm-password').val()
            },
            dataType: 'json',
            success: function (response) {
                spinner.hide();

                if (response.success) {
					 $('.register-form')[0].reset();
					signUpBtn.disabled = false;
					
					swal({
						title: 'Registration Successful',
						text: response.data.successMessage,
						icon: 'success',
					}).then(() => {
						window.location.href = response.data.redirect;
					});
                } else {
					swal({
						title: 'Registration Failed',
						text: response.data.errorMessage,
						icon: 'error',
					});
					signUpBtn.disabled = false;
                }
            },
            error: function () {
                spinner.hide();
                swal('Something went wrong!', 'Please try again later.', 'error');
				signUpBtn.disabled = false;
            }
        });
    });
});


	
jQuery(document).ready(function($) {
		
	setTimeout(function() {
        $('.state1').select2({
            placeholder: 'Locations',
            allowClear: true
        });
    }, 100);
	
	const urlParams = new URLSearchParams(window.location.search);
    const search = urlParams.get('search');
    const state = urlParams.get('state');
	
	if(urlParams && search && state){
	   fetchSuggestions(search, state);
	}
	
	  let previousSuggestions = [];

    // Trigger search suggestions on input
    $('#search-input').on('input', function() {
        const search = $(this).val();
        const state = $('select[name="state"]').val();

        if (search.length > 0) {
            showLoadingIndicator();
            fetchSuggestions(search, state);
        } else {
            hideSuggestions();
        }
    });

    $('#search-input').on('click', function() {
        if (previousSuggestions.length > 0) {
            showSuggestions(previousSuggestions);
        }
    });

     function fetchSuggestions(search, state) {
        $.ajax({
            url: ajax_object.ajax_url, 
            method: 'POST',
            data: {
                action: 'search_products',
                search: search,
                state: state, 
                nonce: ajax_object.nonce 
            },
            success: function(response) {
                hideLoadingIndicator();
                if (response.success) {
                    previousSuggestions = response.data;
                    showSuggestions(response.data);
                } else {
                    hideSuggestions();
                }
            },
            error: function() {
                hideLoadingIndicator();
                hideSuggestions();
            }
        });
    }

    function showLoadingIndicator() {
        $('.loading').show();
    }

    function hideLoadingIndicator() {
        $('.loading').hide();
    }
	
 	function showSuggestions(products) {
        const suggestionsDropdown = $('#suggestions-dropdown');
        suggestionsDropdown.empty();

        products.forEach(product => {
            const item = $('<div class="suggestion-item"></div>').text(product.title);
            item.on('click', function() {
                $('#search-input').val(product.title);
                suggestionsDropdown.hide();
            });

            suggestionsDropdown.append(item);
        });

        suggestionsDropdown.show();
    }


    function hideSuggestions() {
        $('#suggestions-dropdown').hide().empty();
    }
	
    $(document).on('click', function(event) {
        if (!$(event.target).closest('#search-input, #suggestions-dropdown').length) {
            hideSuggestions();
        }
    });

    $('#search-input, #suggestions-dropdown').on('click', function(event) {
        event.stopPropagation();
    });
	
	$('.search-button').on('click', function() {

		const state = $('select[name="state"]').val();
		const s = $('#search-input').val();
		const search = encodeURIComponent(s);
		const stateParam = state ? `&state=${state}` : '';

		window.location.href = `/category?search=${search}${stateParam}`;
    });
	
	$('.category-item > a').on('click', function(event) {
		event.preventDefault();
		$('.category-item > a p').hide();
		$(this).find('p').show();
	});
});

</script>