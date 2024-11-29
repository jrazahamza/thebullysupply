<?php ob_start();
if(session_status() === PHP_SESSION_NONE) {
    session_start();
}
include ('connection.php');
/*
Template Name: profile-information
*/
if(!isset($_COOKIE["user_id"]) || $_COOKIE["user_id"]==0){ 
   header("location: /login/");
}

if(isset($_POST['manageAddressSubmit'])){
    $streetAddress=$_POST['streetAddress']?$_POST['streetAddress']:'';
    $city=$_POST['city']?$_POST['city']:'';
    $stateProvince=$_POST['stateProvince']?$_POST['stateProvince']:'';
    $zippostalCode=$_POST['zippostalCode']?$_POST['zippostalCode']:'';
    $country=$_POST['country']?$_POST['country']:'';
    $bstreetAddress=$_POST['bstreetAddress']?$_POST['bstreetAddress']:'';
    $bcity=$_POST['bcity']?$_POST['bcity']:'';
    $bstateProvince=$_POST['bstateProvince']?$_POST['bstateProvince']:'';
    $bzippostalCode=$_POST['bzippostalCode']?$_POST['bzippostalCode']:'';
    $bcountry=$_POST['bcountry']?$_POST['bcountry']:'';
    mysqli_query($con," UPDATE `address` SET `street`='".$streetAddress."',`city`='".$city."',`state`='".$stateProvince."',`postal`='".$zippostalCode."',`country`='".$country."',`shipStreet`='".$bstreetAddress."',
    `shipCity`='".$bcity."',`shipState`='".$bstateProvince."',`shipPostal`='".$bzippostalCode."',`shipCountry`='".$bcountry."' WHERE `userID`='".$_COOKIE["user_id"]."' ");
}

// if(isset($_POST['manageInformationSubmit'])){
//     $firstName=$_POST['firstName']?$_POST['firstName']:'';
//     $lastName=$_POST['lastName']?$_POST['lastName']:'';
//     $phoneNumber=$_POST['phoneNumber']?$_POST['phoneNumber']:'';
//     $state=$_POST['state']?$_POST['state']:'';
// 	$city=$_POST['city']?$_POST['city']:'';
//     $result = mysqli_query($con," UPDATE `account` SET `contact`='".$phoneNumber."',`firstname`='".$firstName."',`lastname`='".$lastName."',`state`='".$state."',`city`='".$city."' WHERE `id`=".$_COOKIE["user_id"]." ");
// 	if ($result) {
//         $successMessage = "Profile updated successfully!";
//     }
// }

if(isset($_POST['manageProfileSubmit'])){
    $state=$_POST['state']?$_POST['state']:'';
    $profile = '';
    if(!empty($_FILES["profilePhoto"]["type"])){
        $fileName = time().'_'.$_FILES['profilePhoto']['name'];
        $sourcePath = $_FILES['profilePhoto']['tmp_name'];
        $targetPath = "/home/cloudstandly/public_html/bully.cloudstandly.com/wp-content/themes/amtopm-child/uploaded/profile/".$fileName;
        if(move_uploaded_file($sourcePath,$targetPath)){
            $profile = "/wp-content/themes/amtopm-child/uploaded/profile/".$fileName;
        }
    }
    
    mysqli_query($con," UPDATE `account` SET `state`='".$state."' WHERE `id`=".$_COOKIE["user_id"]." ");
    if($profile!=''){
        mysqli_query($con," UPDATE `account` SET `profile`='".$profile."' WHERE `id`=".$_COOKIE["user_id"]." ");
    }
    
}

get_header();

$accounts=mysqli_query($con,"SELECT * FROM `account` where `id`='".$_COOKIE["user_id"]."' ");      
$account = mysqli_fetch_array($accounts);

$addresses=mysqli_query($con,"SELECT * FROM `address` where `userID`='".$_COOKIE["user_id"]."' ");      
$address = mysqli_fetch_array($addresses);

?>
<style>

.ruk-the-bully-deshboard.dashboard-menu h1 {
  font-size: 32px;
  font-weight: 700;
  color: #202224;
}
.ruk-the-bully-deshboard .activity-cards {
  display: flex;
  gap: 30px;
  margin-top: 27px;
}
.ruk-the-bully-deshboard .activity-cards .activity-card {
  border: none;
  border-radius: 14px;
  box-shadow: 6px 6px 54px 0px rgba(0, 0, 0, 5%);
  padding: 16px;
  display: flex;
  flex-direction: column;
  gap: 29px;
width: 25%;	
}

.ruk-the-bully-deshboard .activity-card-headings-img {
  display: flex;
  gap: 63px;
}

.ruk-the-bully-deshboard .activity-card-headings-img .activity-card-headings h3 {
  font-size: 28px;
  font-weight: 700;
  color: #202224;
}
.ruk-the-bully-deshboard .activity-card-headings-img .activity-card-headings span {
  font-size: 16px;
  font-weight: 600;
  color: #202224;
}
.ruk-the-bully-deshboard .activity-card img {
  width: 60px;
  height: 60px;
}

.ruk-the-bully-deshboard .activity-card p img {
  width: 24px;
  height: 24px;
}

.ruk-the-bully-deshboard .activity-card p {
  font-size: 16px;
  font-weight: 600;
  color: #606060;
}

.ruk-the-bully-deshboard .activity-card p span {
  color: #00b69b;
}


.ruk-the-bully-deshboard .dashboard-menu-inbox-user {
    display: flex;
    justify-content: space-between;
}
.ruk-the-bully-deshboard .inbox {
  width: 48%;
  padding: 16px;
  border: 0.3px solid #EAEAEA;
  border-radius: 14px;
}

.ruk-the-bully-deshboard .inbox .inbox-heading {
  display: flex;
  align-items: center;
  justify-content: space-between;
}
.ruk-the-bully-deshboard .inbox .inbox-heading h2 {
  font-size: 28px;
  font-weight: 700;
  color: #202224;
}
.ruk-the-bully-deshboard .inbox .inbox-heading button {
  padding: 9px 28px;
  font-size: 12px;
  font-weight: 500;
  color: #ffff;
  background-color: #003459;
  border: none;
  border-radius: 4px;
  margin-left: 10px;
}

.ruk-the-bully-deshboard .inbox-profiles .inbox-profile-user {
  display: flex;
  align-items: center;
  gap: 13px;
  margin-top: 27px;
}
.ruk-the-bully-deshboard .inbox-profiles .inbox-profile-user .user-headings {
  flex: 1;
}
.ruk-the-bully-deshboard .inbox-profiles .inbox-profile-user .user-headings h2 {
  font-size: 14px;
  font-weight: 700;
  line-height: 0.4;
  color: #202224;
}
.ruk-the-bully-deshboard .inbox-profiles .inbox-profile-user .user-headings span {
  font-size: 12px;
  font-weight: 400;
  color: #258c60;
}

.ruk-the-bully-deshboard .inbox-profiles .inbox-profile-user .user-msg-seen {
  display: flex;
  flex-direction: column;
}
.ruk-the-bully-deshboard .inbox-profiles .inbox-profile-user .user-msg-seen img {
  width: 14px;
  height: 16px;
  align-self: flex-end;
}

/* User */

.ruk-the-bully-deshboard .user {
  border: 0.3px solid #EAEAEA;
  border-radius: 14px;
  padding: 29px 16px;
  width: 48%;
  height: 464px;
}

.ruk-the-bully-deshboard .user .user-img-headings-btn {
  display: flex;
  align-items: center;
  gap: 13px;
}
.ruk-the-bully-deshboard .user-img-headings-btn .user-img img {
  width: 60px;
  height: 60px;
}
.ruk-the-bully-deshboard .user-headings p {
    padding: 0;
}	
.ruk-the-bully-deshboard .user-img-headings-btn .user-headings {
  flex: 1;
}
.ruk-the-bully-deshboard .user-img-headings-btn .user-headings p {
  margin: 0;
  font-size: 21px;
  font-weight: 700;
  color: #404040;
}
.ruk-the-bully-deshboard .user-img-headings-btn .user-headings span {
  font-size: 18px;
  font-weight: 600;
  color: #565656;
}

.ruk-the-bully-deshboard .user-img-headings-btn .user-btn button {
  padding: 9px 41px;
  border: none;
  border-radius: 4px;
  font-size: 12px;
  font-weight: 500;
  color: #ffff;
  background-color: #003459;
}

.formValidationQuery input, select{
    border:unset !Important;
    background-color:#F5F6FA !important;
}
.formValidationQuery .store {
    display: flex;
    flex-direction: column;
	width:50%;
}
	.formValidationQuery .store .error {
		padding: 2px;
	}
.formValidationQuery .city {
    display: flex;
    flex-direction: column;
	width:50%;
}

.formValidationQuery .store-state {
    display: flex;
    flex-direction: column;
}

/* Form */

.ruk-the-bully-deshboard .user .store-city {
  margin-top: 20px;
  display: flex;
  gap: 18px;
  margin-bottom:-14px;
}

.ruk-the-bully-deshboard .user form .store-city label {
  font-size: 14px;
  font-weight: 600;
  color: #adadad;
}
.ruk-the-bully-deshboard .user form .store-city input {
  width: 100%;
  height: 42px;
  margin-top: 4px;
  padding: 11px 0 12px 16px;
  background-color: #f5f6fa;
  border: 0.6px solid #d5d5d5;
  border-radius: 4px;
  font-size: 14px;
  font-weight: 400;
  color: #202224;
}

.formValidationQuery label, input {
    padding: 0px;
    margin: 0px;
}
.ruk-the-bully-deshboard .user form .street-address,
.message {
  margin-top: 13px;
}
.ruk-the-bully-deshboard .user form label {
  font-size: 14px;
  font-weight: 600;
  color: #adadad;
}
.ruk-the-bully-deshboard .user form input,
textarea {
  width: 100%;
  margin-top: 11px;
  padding: 11px 0 12px 16px;
  background-color: #f5f6fa;
  border: 0.6px solid #d5d5d5;
  border-radius: 4px;
  font-size: 14px;
  font-weight: 400;
  color: #202224;
}
/* my-listing  */
.ruk-the-bully-deshboard .my-listing {
  width: 100%;
  height: 400px;
  border: 0.3px solid #EAEAEA;
  border-radius: 14px;
  margin-top: 23px;
  padding: 32px 16px 0 16px;
}

.ruk-the-bully-deshboard .my-listing .heading {
  display: flex;
}
.ruk-the-bully-deshboard .heading h2 {
  font-size: 28px;
  font-weight: 700;
  color: #202224;
  flex-grow: 1;
}
.ruk-the-bully-deshboard .heading button {
  padding: 9px 28px;
  border: none;
  border-radius: 4px;
  background-color: #003459;
  color: #ffff;
  font-size: 12px;
  font-weight: 500;
}

.ruk-the-bully-deshboard .my-list {
  margin-top: 35px;
}
.ruk-the-bully-deshboard .my-list .product-headings {
  width: 96%;
  height: 48px;
  border: none;
  border-radius: 12px;
  background-color: #e5f4ff;
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 0 30px;
  font-size: 14px;
  font-weight: 700;
  color: #202224;
}

.ruk-the-bully-deshboard .product-list {
  margin: 24px 50px 20px 20px;
  max-height: 200px;
  overflow-y: auto;
}

.ruk-the-bully-deshboard .product-list .product {
  display: flex;
  align-items: center;
  justify-content: space-between;
  font-size: 14px;
  font-weight: 600;
  color: #202224;
}

.ruk-the-bully-deshboard .product-list .product .product-img img {
  width: 36px;
  height: 36px;
  margin-right: 16px;
}
.ruk-the-bully-deshboard .product-list .product .product-badge {
  border: 1px solid #00b69b;
  border-radius: 13px;
  padding: 4px 14px;
  font-size: 14px;
  font-weight: 700;
  background-color: #00b69b45;
  color: #00b69b;
}

.ruk-the-bully-deshboard .product-list hr {
  border: 0.4 solid #979797;
}


	
</style>
<section id="profile-information" class="profile-information template-common-class">
    <div class="container-fluid">
        <div class="row">
            <div class="template-pages-content">
                <!--=== SideBar-->
                <div class="template-sidebar">
                    <?php $activeSidebar="dashboard"; include "custom-sidebar.php"; ?>
                </div>
				
                <!-- Start Template Page Content-->
                <div class="main-content-class">
				  <div class="ruk-the-bully-deshboard">
					
					<div class="thebully-vender-ruk-deshboard-content">
				     <h1>Dashboard</h1>
					  <div class="activity-cards">
						<div class="activity-card">
						  <div class="activity-card-headings-img">
							<div class="activity-card-headings">
							  <span>Active Listings</span>
							  <h4>36</h4>
							</div>
							<div class="activity-card-img">
							  <img src="/wp-content/uploads/2024/11/Icon1.png" alt="" />
							</div>
						  </div>
						  <p>
							<img src="/wp-content/uploads/2024/11/ic-trending-up-24px.png" alt="" /> <span>8.5%</span> Up from
							last month
						  </p>
						</div>
						<div class="activity-card">
						  <div class="activity-card-headings-img">
							<div class="activity-card-headings">
							  <span>Unread Messages</span>
							  <h4>102</h4>
							</div>
							<div class="activity-card-img">
							  <img src="/wp-content/uploads/2024/11/Icon2.png" alt="" />
							</div>
						  </div>
						  <p>
							<img src="/wp-content/uploads/2024/11/ic-trending-up-24px.png" alt="" /> <span>1.3%</span> Up from
							past week
						  </p>
						</div>
						<div class="activity-card">
						  <div class="activity-card-headings-img">
							<div class="activity-card-headings">
							  <span>Listings Viewed</span>
							  <h2>890</h2>
							</div>
							<div class="activity-card-img">
							  <img src="/wp-content/uploads/2024/11/Icon3.png" alt="" />
							</div>
						  </div>
						  <p>
							<img src="/wp-content/uploads/2024/11/ic-trending-down-24px.png" alt="" /> <span>4.3%</span> Down from
							yesterday
						  </p>
						</div>
						<div class="activity-card">
						  <div class="activity-card-headings-img">
							<div class="activity-card-headings">
							  <span>Shop Visit</span>
							  <h4>2040</h4>
							</div>
							<div class="activity-card-img">
							  <img src="/wp-content/uploads/2024/11/Icon4.png" alt="" />
							</div>
						  </div>
						  <p>
							<img src="/wp-content/uploads/2024/11/ic-trending-up-24px.png" alt="" /> <span>1.8%</span> Up from
							yesterday
						  </p>
						</div>
					  </div>
				</div>
				
					<div class="dashboard-menu-inbox-user">
						<div class="inbox">
						  <div class="inbox-heading">
							<h2>Inbox</h2>
							<div class="icon-button">
							  <img src="./imgs/trash.png" alt="" />
							   <i class="fa fa-trash-o" aria-hidden="true"></i>
							  <button>View All</button>
							</div>
						  </div>
						  <div class="inbox-profiles">
							<div class="inbox-profile-user">
							  <div class="user-img">
								<img src="/wp-content/uploads/2024/11/1000004118.png" alt="" />
							  </div>
							  <div class="user-headings">
								<h2>Killan James</h2>
								<span>Typing...</span>
							  </div>
							  <div class="user-msg-seen">
								<span>4:30 PM</span>
								<img src="./imgs/2.png" alt="" />
							  </div>
							</div>
							<div class="inbox-profile-user">
							  <div class="user-img">
								<img src="/wp-content/uploads/2024/11/1000004118.png" alt="" />
							  </div>
							  <div class="user-headings">
								<h2>Killan James</h2>
								<span>Typing...</span>
							  </div>
							  <div class="user-msg-seen">
								<span>4:30 PM</span>
								<img src="./imgs/2.png" alt="" />
							  </div>
							</div>
							<div class="inbox-profile-user">
							  <div class="user-img">
								<img src="/wp-content/uploads/2024/11/1000004118.png" alt="" />
							  </div>
							  <div class="user-headings">
								<h2>Killan James</h2>
								<span>Typing...</span>
							  </div>
							  <div class="user-msg-seen">
								<span>4:30 PM</span>
								<img src="./imgs/2.png" alt="" />
							  </div>
							</div>
							<div class="inbox-profile-user">
							  <div class="user-img">
								<img src="/wp-content/uploads/2024/11/1000004118.png" alt="" />
							  </div>
							  <div class="user-headings">
								<h2>Killan James</h2>
								<span>Typing...</span>
							  </div>
							  <div class="user-msg-seen">
								<span>4:30 PM</span>
								<img src="./imgs/2.png" alt="" />
							  </div>
							</div>
							<div class="inbox-profile-user">
							  <div class="user-img">
								<img src="/wp-content/uploads/2024/11/1000004118.png" alt="" />
							  </div>
							  <div class="user-headings">
								<h2>Killan James</h2>
								<span>Typing...</span>
							  </div>
							  <div class="user-msg-seen">
								<span>4:30 PM</span>
								<img src="./imgs/2.png" alt="" />
							  </div>
							</div>
						  </div>
						</div>
						<div class="user">
							<?php if (isset($successMessage)): ?>
								<div id="successMessage" class="success-message">
									<?php echo $successMessage; ?>
								</div>
							<?php endif; ?>
							<form id="userForm" class="billing-address-and-shipping-address formValidationQuery" method="post">
							  <div class="user-img-headings-btn">
								<div class="user-img">
								  <img src="<?php echo $account['profile'] ? ($subSubSiteUrl.''.$account['profile']) : ''; ?>" alt="" />
								</div>
								<div class="user-headings">
									<p>
										<?php echo $account['firstname'] ?? ''; ?>
									</p>
									<p>
									  <span>
									  <?php echo $account['role'] ?? ''; ?>
									  </span>
									</p>
								</div>
								<div class="user-btn">
								  	<button type="submit" name="manageInformationSubmit" value="Save" id="manageInformationSubmit">
									  Save
									  <span class="spinner" style="display: none;"></span>
									</button>

								</div>
							  </div>

								<div class="store-city first-last-name">
									<div class="store">
										<label for="store">First Name</label>
										<input type="text" name="firstName" id="firstName" value="<?php echo $account['firstname']; ?>" placeholder="Kevin" required/>
										<span class="error" id="firstNameError"></span>
									</div>
									<div class="city">
										<label for="city">Last Name</label>
										<input type="text" name="lastName" id="lastName" value="<?php echo $account['lastname']; ?>" placeholder="Klien" required/>
										<span class="error" id="lastNameError"></span>
									</div>
								</div>
								<div class="street-address">
									<label for="store">Phone Number</label>
									<input type="text" name="phoneNumber" id="phoneNumber" value="<?php echo $account['contact']; ?>" placeholder="123 Street cts" required/>
									<span class="error" id="phoneNumberError"></span>
								</div>
								<div class="store-city store-state">
									<label for="message">State</label>
									<select id="state" class="form-control" name="state" required>
										<option value="">Select State</option>
										<option value="AL" <?php if($account['state']=='AL'){ echo "selected"; } ?>>AL</option> 
										<option value="AK" <?php if($account['state']=='AK'){ echo "selected"; } ?>>AK</option>
										<option value="AZ" <?php if($account['state']=='AZ'){ echo "selected"; } ?>>AZ</option> 
										<option value="AR" <?php if($account['state']=='AR'){ echo "selected"; } ?>>AR</option>
										<option value="CA" <?php if($account['state']=='CA'){ echo "selected"; } ?>>CA</option> 
										<option value="CO" <?php if($account['state']=='CO'){ echo "selected"; } ?>>CO</option>
										<option value="CT" <?php if($account['state']=='CT'){ echo "selected"; } ?>>CT</option> 
										<option value="DE" <?php if($account['state']=='DE'){ echo "selected"; } ?>>DE</option>
										<option value="FL" <?php if($account['state']=='FL'){ echo "selected"; } ?>>FL</option> 
										<option value="GA" <?php if($account['state']=='GA'){ echo "selected"; } ?>>GA</option>
										<option value="HI" <?php if($account['state']=='HI'){ echo "selected"; } ?>>HI</option> 
										<option value="ID" <?php if($account['state']=='ID'){ echo "selected"; } ?>>ID</option>
										<option value="IL" <?php if($account['state']=='IL'){ echo "selected"; } ?>>IL</option> 
										<option value="IN" <?php if($account['state']=='IN'){ echo "selected"; } ?>>IN</option>
										<option value="IA" <?php if($account['state']=='IA'){ echo "selected"; } ?>>IA</option> 
										<option value="KS" <?php if($account['state']=='KS'){ echo "selected"; } ?>>KS</option>
										<option value="KY" <?php if($account['state']=='KY'){ echo "selected"; } ?>>KY</option> 
										<option value="LA" <?php if($account['state']=='LA'){ echo "selected"; } ?>>LA</option>
										<option value="ME" <?php if($account['state']=='ME'){ echo "selected"; } ?>>ME</option> 
										<option value="MD" <?php if($account['state']=='MD'){ echo "selected"; } ?>>MD</option>															<option value="MA" <?php if($account['state']=='MA'){ echo "selected"; } ?>>MA</option> 
										<option value="MI" <?php if($account['state']=='MI'){ echo "selected"; } ?>>MI</option>															<option value="MN" <?php if($account['state']=='MN'){ echo "selected"; } ?>>MN</option> 
										<option value="MS" <?php if($account['state']=='MS'){ echo "selected"; } ?>>MS</option>															<option value="MO" <?php if($account['state']=='MO'){ echo "selected"; } ?>>MO</option> 
										<option value="MT" <?php if($account['state']=='MT'){ echo "selected"; } ?>>MT</option>
										<option value="NE" <?php if($account['state']=='NE'){ echo "selected"; } ?>>NE</option> 
										<option value="NV" <?php if($account['state']=='NV'){ echo "selected"; } ?>>NV</option>
										<option value="NH" <?php if($account['state']=='NH'){ echo "selected"; } ?>>NH</option> 
										<option value="NJ" <?php if($account['state']=='NJ'){ echo "selected"; } ?>>NJ</option>
										<option value="NM" <?php if($account['state']=='NM'){ echo "selected"; } ?>>NM</option> 
										<option value="NY" <?php if($account['state']=='NY'){ echo "selected"; } ?>>NY</option>
										<option value="NC" <?php if($account['state']=='NC'){ echo "selected"; } ?>>NC</option> 
										<option value="ND" <?php if($account['state']=='ND'){ echo "selected"; } ?>>ND</option>
										<option value="OH" <?php if($account['state']=='OH'){ echo "selected"; } ?>>OH</option> 
										<option value="OK" <?php if($account['state']=='OK'){ echo "selected"; } ?>>OK</option>
										<option value="OR" <?php if($account['state']=='OR'){ echo "selected"; } ?>>OR</option> 
										<option value="PA" <?php if($account['state']=='PA'){ echo "selected"; } ?>>PA</option>
										<option value="RI" <?php if($account['state']=='RI'){ echo "selected"; } ?>>RI</option> 
										<option value="SC" <?php if($account['state']=='SC'){ echo "selected"; } ?>>SC</option>
										<option value="SD" <?php if($account['state']=='SD'){ echo "selected"; } ?>>SD</option> 
										<option value="TN" <?php if($account['state']=='TN'){ echo "selected"; } ?>>TN</option>
										<option value="TX" <?php if($account['state']=='TX'){ echo "selected"; } ?>>TX</option> 
										<option value="UT" <?php if($account['state']=='UT'){ echo "selected"; } ?>>UT</option>															<option value="VT" <?php if($account['state']=='VT'){ echo "selected"; } ?>>VT</option> 
										<option value="VA" <?php if($account['state']=='VA'){ echo "selected"; } ?>>VA</option>
										<option value="WA" <?php if($account['state']=='WA'){ echo "selected"; } ?>>WA</option> 
										<option value="WV" <?php if($account['state']=='WV'){ echo "selected"; } ?>>WV</option>
										<option value="WI" <?php if($account['state']=='WI'){ echo "selected"; } ?>>WI</option> 
										<option value="WY" <?php if($account['state']=='WY'){ echo "selected"; } ?>>WY</option>															<option value="DC" <?php if($account['state']=='DC'){ echo "selected"; } ?>>DC</option> 
										<option value="AS" <?php if($account['state']=='AS'){ echo "selected"; } ?>>AS</option>
										<option value="GU" <?php if($account['state']=='GU'){ echo "selected"; } ?>>GU</option> 
										<option value="MP" <?php if($account['state']=='MP'){ echo "selected"; } ?>>MP</option>
										<option value="PR" <?php if($account['state']=='PR'){ echo "selected"; } ?>>PR</option> 
										<option value="VI" <?php if($account['state']=='VI'){ echo "selected"; } ?>>VI</option>
									  </select>
								</div>
								
								<div class="street-address">
									<label for="store">City</label>
									<input type="text" name="city" id="city" value="<?php echo $account['city']; ?>" placeholder="enter city" required/>
								</div>
						  	</form>	
						</div>
					  </div>

					  <div class="my-listing">
						<div class="heading">
						  <h2>My Listings</h2>
						  <button>View All</button>
						</div>
						<div class="my-list">
						  <div class="product-headings">
							<span>Product Name</span>
							<span>Category</span>
							<span>Date - Time</span>
							<span>SKU</span>
							<span>Amount</span>
							<span>Status</span>
						  </div>
						  <div class="product-list">
							<?php
                              $i=1;
							  $listings=mysqli_query($con,"SELECT * FROM `listings` where `userID`='".$_COOKIE["user_id"]."' order by id desc ");
							  while($listing = mysqli_fetch_array($listings)){
						$category = mysqli_query($con, "SELECT * FROM `categories` WHERE `id` = " . intval($listing["category"]) . " LIMIT 1");
								$category_data = mysqli_fetch_assoc($category);
                            ?>
								<div class="product">
								  <div class="product-img">
									<img src="<?php echo !empty($listing['gallery1']) ? $listing['gallery1'] : 'https://thebullysupply.com/wp-content/uploads/2024/11/No_Image_Available.jpg'; ?>" alt="">
									<span><?php echo $listing['title']; ?></span>
								  </div>
								  <span><?php echo $category_data['name']; ?></span>
								  <span><?php echo $formatted_date = date('d.m.Y - h.i A', strtotime($listing['created_at'])); ?></span>

								  <span>423</span>
								  <span><?php echo "$" . number_format($listing['price'], 2); ?></span>
								  <span class="<?php echo ($listing['status'] == 'active') ? 'product-badge' : $listing['status']; ?>">Approved</span>
								</div>
							  	<hr>
							  <?php } ?>
						  </div>
						</div>
					  </div>
					</div>
<!-- 					end ruk new code -->
					
				</div>
              </div>
			
            </div>
        </div>
</section>

<?php
get_footer();
?>

<div class="popup-class" id="manageAddressModelPopup" style="display:none;">
    <div class="inner-popup">
        <div class="popup-title">
            <h3>Manage Addresses <i class="fa fa-times closeModel"></i></h3>
            <form class="billing-address-and-shipping-address formValidationQuery1" method="post" id="billing-address">
            <div class="flex-class-popup">
                <div class="flex-class-popup-item flex-class-popup-item-left">
                    <h4>Billing Address</h4>
                        <div class="input-blocks input-block01">
                            <label for="street-address">Street Address<span>*</span></label>
                            <textarea name="streetAddress" id="street-address" placeholder="Type your street address here" required><?php echo $address['street']; ?></textarea>
                        </div>
                        <div class="input-blocks input-block02">
                            <label for="City">City<span>*</span></label>
                            <input type="text" name="city" id="City" placeholder="Type your city here" value="<?php echo $address['city']; ?>" required/>
                        </div>
                        <div class="input-blocks input-block03">
                            <label for="state-province">State/Province<span>*</span></label>
                            <input type="text" name="stateProvince" id="state-province" placeholder="Type your State/Province here" value="<?php echo $address['state']; ?>" required/>
                        </div>
                        <div class="input-blocks input-block04">
                            <label for="zip-postal-code">Zip/Postal Code<span>*</span></label>
                            <input type="number" name="zippostalCode" id="zip-postal-code" placeholder="Type your zip/postal code here" value="<?php echo $address['postal']; ?>" required/>
                        </div>
                        <div class="input-blocks input-block04">
                            <label for="country">Country<span>*</span></label>
                            <select id="country" name="country" required>
                                <option value="" >Select your country</option>
                                <option <?php if($address['country']=='canada'){ echo "selected"; } ?> value="canada">Canada</option>
                                <option <?php if($address['country']=='usa'){ echo "selected"; } ?> value="usa">United States</option>
                                <option <?php if($address['country']=='mexico'){ echo "selected"; } ?> value="mexico">Mexico</option>
                                <option <?php if($address['country']=='uk'){ echo "selected"; } ?> value="uk">United Kingdom</option>
                                <option <?php if($address['country']=='germany'){ echo "selected"; } ?> value="germany">Germany</option>
                                <option <?php if($address['country']=='france'){ echo "selected"; } ?> value="france">France</option>
                                <option <?php if($address['country']=='japan'){ echo "selected"; } ?> value="japan">Japan</option>
                                <option <?php if($address['country']=='australia'){ echo "selected"; } ?> value="australia">Australia</option>
                            </select>
                        </div>
                    </div>
                <div class="flex-class-popup-item flex-class-popup-item-right">
                    <h4>Shipping Address</h4>
                        <div class="input-blocks input-block01">
                            <label for="street-address">Street Address<span>*</span></label>
                            <textarea name="bstreetAddress" id="street-address" placeholder="Type your street address here" required><?php echo $address['shipStreet']; ?></textarea>
                        </div>
                        <div class="input-blocks input-block02">
                            <label for="City">City<span>*</span></label>
                            <input type="text" name="bcity" id="City" placeholder="Type your city here" required value="<?php echo $address['shipCity']; ?>" />
                        </div>
                        <div class="input-blocks input-block03">
                            <label for="state-province">State/Province<span>*</span></label>
                            <input type="text" name="bstateProvince" id="state-province" placeholder="Type your State/Province here" value="<?php echo $address['shipState']; ?>" required/>
                        </div>
                        <div class="input-blocks input-block04">
                            <label for="zip-postal-code">Zip/Postal Code<span>*</span></label>
                            <input type="number" name="bzippostalCode" id="zip-postal-code" placeholder="Type your zip/postal code here" value="<?php echo $address['shipPostal']; ?>" required/>
                        </div>
                        <div class="input-blocks input-block04">
                            <label for="country">Country<span>*</span></label>
                            <select id="country" name="bcountry" required>
                                <option value="" >Select your country</option>
                                <option <?php if($address['shipCountry']=='canada'){ echo "selected"; } ?> value="canada">Canada</option>
                                <option <?php if($address['shipCountry']=='usa'){ echo "selected"; } ?> value="usa">United States</option>
                                <option <?php if($address['shipCountry']=='mexico'){ echo "selected"; } ?> value="mexico">Mexico</option>
                                <option <?php if($address['shipCountry']=='uk'){ echo "selected"; } ?> value="uk">United Kingdom</option>
                                <option <?php if($address['shipCountry']=='germany'){ echo "selected"; } ?> value="germany">Germany</option>
                                <option <?php if($address['shipCountry']=='france'){ echo "selected"; } ?> value="france">France</option>
                                <option <?php if($address['shipCountry']=='japan'){ echo "selected"; } ?> value="japan">Japan</option>
                                <option <?php if($address['shipCountry']=='australia'){ echo "selected"; } ?> value="australia">Australia</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="right-button">
                <input type="submit" name="manageAddressSubmit" value="Save"/>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="popup-class" id="manageInformationModelPopup" style="display:none;">
    <div class="inner-popup">
        <div class="popup-title">
            <h3>Information Detail <i class="fa fa-times closeModel"></i></h3>
            <form class="billing-address-and-shipping-address formValidationQuery" method="post" id="billing-address">
            <div class="flex-class-popup">
                <div class="flex-class-popup-item flex-class-popup-item-left">
                        <div class="input-blocks input-block01">
                            <label for="firstName">First Name<span>*</span></label>
                            <input type="text" name="firstName" id="firstName" value="<?php echo $account['firstname']; ?>" placeholder="Albert" required>
                        </div>
                        <div class="input-blocks input-block01">
                            <label for="lastName">Last Name<span>*</span></label>
                            <input type="text" name="lastName" id="lastName" value="<?php echo $account['lastname']; ?>" placeholder="John" required>
                        </div>
                        <div class="input-blocks input-block02">
                            <label for="phoneNumber">Phone Number<span>*</span></label>
                            <input type="tel" name="phoneNumber" id="phoneNumber" value="<?php echo $account['contact']; ?>" placeholder="1234567890" required/>
                        </div>
                        <br>
                        <div class="input-blocks input-block03 checkbox">
                            <label for="newsLetter">News Letter</label>
                            <input type="checkbox" name="newsLetter" <?php if($account['newsletter']=='Yes'){ echo "checked"; } ?> id="newsLetter" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="right-button">
                <input type="submit" name="manageInformationSubmit" value="Save"/>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="popup-class" id="manageProfileModelPopup" style="display:none;">
    <div class="inner-popup">
        <div class="popup-title">
            <h3>Profile Detail <i class="fa fa-times closeModel"></i></h3>
            <form class="billing-address-and-shipping-address formValidationQuery2" method="post" id="billing-address" enctype="multipart/form-data">
            <div class="flex-class-popup">
                <div class="flex-class-popup-item flex-class-popup-item-left">
                        <div class="flex-block-item flex-block-item03">
                            <div class="flex-block-item flex-block-item01">
                                <div class="file-upload">
                                    <label class="template-label" for="profile-Photo">Profile Photo</label>
                                    <div class="Profile-Photo-uploade <?php if($account['profile']!=''){ echo "show"; } ?>" id="uploadImagePreviewerShow" <?php if($account['profile']!=''){ ?> style="background-image:url(<?php echo $account['profile']; ?>);" <?php } ?> >
                                        <input type="file" name="profilePhoto" class="uploadImagePreviewer" data-preview="uploadImagePreviewerShow" id="profile-Photo" style="cursor:pointer;" accept="image/png, image/gif, image/jpeg">
                                        <div class="file-inner-content">
                                            <span class="uploade-icon"><img src="/wp-content/uploads/2024/05/Vector-3.png"></span>
                                            <label class="upload-label">Drag or Upload Your Avatar</label>
                                        </div>
                                    </div>
                                    <label class="template-label-bottom">Image must be at least 150 pixels wide and 110 pixels tall.</label>
                                </div>
                            </div>
                        </div>
                        <div class="input-blocks input-block02">
                            <label for="state">State<span>*</span></label>
                            <input type="text" name="state" id="state" placeholder="Type your state here" value="<?php echo $account['state']; ?>" required/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="right-button">
                <input type="submit" name="manageProfileSubmit" value="Save"/>
            </div>
            </form>
        </div>
    </div>
</div>

<script>
	
	
jQuery(document).ready(function ($) {
	
	// Helper function to validate both input and select fields
	function validateField(selector, errorSelector) {
		let value = $(selector).val();
		value = value ? value.trim() : '';
		let errorField = $(errorSelector);
		let isValid = true;

		if (value === '') {
			errorField.text('This field is required');
			isValid = false;
		} else {
			errorField.text('');
		}

		return isValid;
	}
	
    $('#userForm').on('submit', function (e) {
        e.preventDefault(); // Prevent default form submission

		const updateProfile = $('#manageInformationSubmit');
        const spinner = updateProfile.find('.spinner');
		let isValid = true;								
		
		isValid &= validateField('#firstName', '#firstNameError');
		isValid &= validateField('#lastName', '#lastNameError');
		isValid &= validateField('#phoneNumber', '#phoneNumberError');
		
		if (!isValid) {
			return false;
		}
		
        const formData = $(this).serialize();
		spinner.show();
        $.ajax({
            url: ajaxurl,
            type: 'POST',
            data: {
                action: 'manage_information_submit',
                formData: formData,
            },
            success: function (response) {
                if (response.success) {
					swal({
						title: 'Profile Updated Successful',
						text: response.data.message,
						icon: 'success',
					}).then(() => {
						location.reload();
					});
                } else {
					swal({
						title: 'Profile Updation Failed',
						text: response.data.message,
						icon: 'error',
					});
                }
				spinner.hide();
            },
            error: function () {
                swal('An error occurred. Please try again.');
				spinner.hide();
            },
        });
    });
});	
	
	
    jQuery(document).on('click','.openAddressManageModel',function(){
        jQuery('#manageAddressModelPopup').show();
    });
    jQuery(document).on('click','.openInformationManageModel',function(){
        jQuery('#manageInformationModelPopup').show();
    });
    jQuery(document).on('click','.openProfileManageModel',function(){
        jQuery('#manageProfileModelPopup').show();
    });
    jQuery(document).on('click','h3 i.closeModel',function(){
        jQuery('#manageAddressModelPopup').hide();
        jQuery('#manageInformationModelPopup').hide();
        jQuery('#manageProfileModelPopup').hide();
    });
</script>
<script>
    jQuery(".formValidationQuery").validate();
    jQuery(".formValidationQuery1").validate();
    jQuery(".formValidationQuery2").validate();
    
    function readURL(input,id) {
      if(input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
          jQuery('#'+id).attr('style', 'background-image:url('+e.target.result+')');
          jQuery('#'+id).hide();
          jQuery('#'+id).fadeIn(650);
          jQuery('#'+id).addClass('show');
        }
        reader.readAsDataURL(input.files[0]);
      }
    }
    
    jQuery(".uploadImagePreviewer").change(function() {
      var id=jQuery(this).attr('data-preview')
      if(jQuery(this).val()!=''){
        readURL(this,id);
      }else{
        jQuery('#'+id).removeClass('show');  
        jQuery('#'+id).removeAttr('style');  
      }
    });
</script>