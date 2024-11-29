<?php
/**
 * Template Name: Account Setting
 * Description: A custom template for the Account Setting page
 */
get_header();
?>


<style>

/* Dashboard */

.dashboard {
  flex-grow: 1;
  margin-top: 27px;
  border: 0.3px solid #eaeaea;
  border-radius: 14px;
  padding: 40px 36px 0px 24px;
}

.profile-info {
  margin-bottom: 34px;
}
.profile-info > h2 {
  font-size: 28px;
  font-weight: 800;
  line-height: normal;
}

.profile-info > p {
  font-size: 16px;
  font-weight: 400;
  color: #39393a;
}

/* Form */

form {
  display: flex;
  gap: 37px;
}
form label {
  font-size: 14px;
  font-weight: 600;
  color: #adadad;
}

.form-right {
  width: 100%;
}
.city-state {
  display: flex;
  gap: 12px;
}
.form-left {
  width: 100%;
}

.form-group {
  width: 100%;
  margin-bottom: 22px;
}
form input,
textarea,
select {
  width: 100%;
  height: 42px;
  padding-left: 16px;
  border: 0.6px solid #d5d5d5;
  border-radius: 4px;
  background-color: #f5f6fa;
}

.form-group textarea {
  height: 139px;
}
.form-btn-container {
  height: 165px;
  display: flex;
  justify-content: flex-end;
}

form .save-btn {
  font-size: 14px;
  font-weight: 500;
  padding: 10px 30px;
  color: #fff;
  border-radius: 61px;
  border: none;
  background-color: #8b1339;
  align-self: flex-end;
  margin-top: 25px;
}

</style>
	   
<section id="create-listing" class="create-listing template-common-class">
    <div class="container-fluid">
        <div class="row">
            <div class="template-pages-content">
                <!--=== SideBar-->
                <div class="template-sidebar">
                    <?php $activeSidebar="create-listing"; include "custom-sidebar.php"; ?>
                </div>
                <!-- Start Template Page Content-->
				<div class="dashboard">

				  <div class="profile-info">
					<h2>Account Settings</h2>
					<p>
						A few descriptive words to help buyers find your item.
					</p>
					<div class="profile-info-img">
					  <img src="./imgs/profile-info-img.png" alt="" />
					</div>
				  </div>

				  <form action="#">
					<div class="form-left">
						<div class="form-group">
							<label for="name">Name*</label>
							<input type="text" name="name" id="name" placeholder="The Bully Supply">
						</div>
						<div class="form-group">
							<label for="name">Number*</label>
							<input type="text" name="number" id="number" placeholder="XXXXXX">
						</div>
						<div class="form-group">
							<label for="email">Email*</label>
							<input type="email" name="email" id="email" placeholder="John@gmail.com">
						</div>
						<div class="form-group">
							<label for="textarea">Description</label>
							<textarea name="textarea" id="textarea" placeholder="Type Here"></textarea>
						</div>
					</div>
					<div class="form-right">
						<div class="form-group">
							<label for="country">Country*</label>
							<input type="text" name="country" id="country" placeholder="The Bully Supply">
						</div>
						<div class="city-state">
							<div class="form-group">
								<label for="city">City*</label>
								<input type="text" name="city" id="city" placeholder="Houston">
							</div>
							<div class="form-group">
								<label for="name">State*</label>
								<input type="text" name="state" id="state" placeholder="Tx">
							</div>
						</div>
						<div class="form-group">
							<label for="name">Street Address</label>
							<input type="text" name="address" id="address" placeholder="123 Street cts">
						</div>
						<div class="form-btn-container">
							<button class="save-btn ">Save</button>
						</div>
					</div>
				</form>

			  </div>
                <!-- End Template Page Content-->
            </div>
        </div>
    </div>
	
</section>





<?php get_footer(); ?>
