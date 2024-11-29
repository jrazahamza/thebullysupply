<style>
.pagination {
    margin-top: 20px;
    display: flex;
    justify-content: center;
}

.pagination a {
    margin: 0 5px;
    padding: 5px 10px;
    text-decoration: none;
    border: 1px solid #ccc;
    color: #333;
}

.pagination a.active {
    background-color: #007bff;
    color: white;
    border-color: #007bff;
}
.chosen-container{
    font-size: 15px !important;
}
.chosen-container-single .chosen-single{
	height: 35px !important;
}

</style>

<?php ob_start();
if(session_status() === PHP_SESSION_NONE) {
    session_start();
}
include ('connection.php');
/* 
Template Name: create-listing
*/ 
if(!isset($_COOKIE["user_id"]) || $_COOKIE["user_id"]==0){ 
  header("location: /login/");
}

if(isset($_POST['submit'])){
 
    $titleProduct=$_POST['titleProduct']?$_POST['titleProduct']:'';
	$category_level=isset($_POST['category_level'])?$_POST['category_level']:'';
    $category_id=$_POST['category_level'] == 3 ? $_POST['sub_category'] : $_POST['sub_sub_category'];
	$gender = ($_POST['gender'] && ($_POST['category_level'] == '1')) ? $_POST['gender'] : 0;
	$age = ($_POST['age'] && ($_POST['category_level'] == '1')) ? $_POST['age'] : 0;
    $description=$_POST['description']?$_POST['description']:'';
    $price=$_POST['price']?$_POST['price']:'';
	$state=$_POST['state']?$_POST['state']:'';
	$city=$_POST['city']?$_POST['city']:'';
    
    $fileUpload01 = '';
    if(!empty($_FILES["fileUpload01"]["type"])){
        $fileName = time().'_'.$_FILES['fileUpload01']['name'];
        $sourcePath = $_FILES['fileUpload01']['tmp_name'];
		$targetPath = "/www/wwwroot/thebullysupply.com/wp-content/themes/amtopm-child/uploaded/listing/".$fileName;
        if(move_uploaded_file($sourcePath,$targetPath)){
            $fileUpload01 = "/wp-content/themes/amtopm-child/uploaded/listing/".$fileName;
        }
    }	
    
    $fileUpload02 = '';
    if(!empty($_FILES["fileUpload02"]["type"])){
        $fileName = time().'_'.$_FILES['fileUpload02']['name'];
        $sourcePath = $_FILES['fileUpload02']['tmp_name'];
        $targetPath = "/www/wwwroot/thebullysupply.com/wp-content/themes/amtopm-child/uploaded/listing/".$fileName;
        if(move_uploaded_file($sourcePath,$targetPath)){
            $fileUpload02 = "/wp-content/themes/amtopm-child/uploaded/listing/".$fileName;
        }
    }
    
    $fileUpload03 = '';
    if(!empty($_FILES["fileUpload03"]["type"])){
        $fileName = time().'_'.$_FILES['fileUpload03']['name'];
        $sourcePath = $_FILES['fileUpload03']['tmp_name'];
        $targetPath = "/www/wwwroot/thebullysupply.com/wp-content/themes/amtopm-child/uploaded/listing/".$fileName;
        if(move_uploaded_file($sourcePath,$targetPath)){
            $fileUpload03 = "/wp-content/themes/amtopm-child/uploaded/listing/".$fileName;
        }
    }
    
    $fileUpload04 = '';
    if(!empty($_FILES["fileUpload04"]["type"])){
        $fileName = time().'_'.$_FILES['fileUpload04']['name'];
        $sourcePath = $_FILES['fileUpload04']['tmp_name'];
        $targetPath = "/www/wwwroot/thebullysupply.com/wp-content/themes/amtopm-child/uploaded/listing/".$fileName;
        if(move_uploaded_file($sourcePath,$targetPath)){
            $fileUpload04 = "/wp-content/themes/amtopm-child/uploaded/listing/".$fileName;
        }
    }
    
    $fileUpload05 = '';
    if(!empty($_FILES["fileUpload05"]["type"])){
        $fileName = time().'_'.$_FILES['fileUpload05']['name'];
        $sourcePath = $_FILES['fileUpload05']['tmp_name'];
        $targetPath = "/www/wwwroot/thebullysupply.com/wp-content/themes/amtopm-child/uploaded/listing/".$fileName; 
        if(move_uploaded_file($sourcePath,$targetPath)){
            $fileUpload05 = "/wp-content/themes/amtopm-child/uploaded/listing/".$fileName;
        }
    }
    
    $fileUpload06 = '';
    if(!empty($_FILES["fileUpload06"]["type"])){
        $fileName = time().'_'.$_FILES['fileUpload06']['name'];
        $sourcePath = $_FILES['fileUpload06']['tmp_name'];
        $targetPath = "/www/wwwroot/thebullysupply.com/wp-content/themes/amtopm-child/uploaded/listing/".$fileName;
        if(move_uploaded_file($sourcePath,$targetPath)){
            $fileUpload06 = "/wp-content/themes/amtopm-child/uploaded/listing/".$fileName;
        }
    }
     
    $insert=mysqli_query($con," INSERT INTO `listings`(`userID`, `title`, `category_level`, `category`, `gender`, `age`, `descriptions`, `price`, `state`, `city`, `gallery1`, `gallery2`, `gallery3`, `gallery4`, `gallery5`, `gallery6`, `status`, `userStatus`) 
    VALUES ('".$_COOKIE["user_id"]."','".$titleProduct."','".$category_level."','".$category_id."','".$gender."','".$age."','".$description."','".$price."','".$state."','".$city."','".$fileUpload01."','".$fileUpload02."','".$fileUpload03."','".$fileUpload04."','".$fileUpload05."','".$fileUpload06."','pending','listed') ");
    
	if ($insert) {
		header("location: /my-shop/");
// 		exit();
	} else {
		echo "Error in query: " . mysqli_error($con);
	}
    
}

get_header();
?>
<style>

.ruk-new-create-listing-sec .dashboard {
  flex-grow: 1;
  border: 1px solid #eaeaea;
  border-radius: 14px;
  margin: 32px 29px 0px 13px;
  padding-top: 40px;
  padding-left: 24px;
  padding-right: 36px;
 padding-bottom:40px;
}

.ruk-new-create-listing-sec .dashboard .container {
  margin-left: 24px;
}
.ruk-new-create-listing-sec .form {
  margin-top: 26px;
}

.ruk-new-create-listing-sec .form input {
  background-color: #f5f6fa;
}
.ruk-new-create-listing-sec .form textarea {
  background-color: #f5f6fa;
}
.ruk-new-create-listing-sec .form select {
  background-color: #f5f6fa;
}

.ruk-new-create-listing-sec .form button {
  background-color: #8b1339;
  color: #fff;
  font-size: 17px;
  font-weight: 600;
  border: none;
  border-radius: 61px;
  padding: 10px 30px;
  margin-top: 27px;
}

.ruk-new-create-listing-sec .file {
  display: flex;
  background-color: #f5f6fa;
  border: none;
  border-radius: 4px;
  justify-content: space-around;
}

.ruk-new-create-listing-sec .file-1 {
  padding: 30px 13px;
}
.ruk-new-create-listing-sec .file-1 input {
  display: none;
}

.ruk-new-create-listing-sec .file-1 label {
  padding: 23px 24px 22px 23px;
  border-radius: 6px;
  border: 1px dashed #003459;
  font-size: 6px;
  font-weight: 400;
  color: #000;
  /* display: flex;
  align-items: center;
  justify-content: center; */
  cursor: pointer;
}

.ruk-new-create-listing-sec {
/*     border: 1px solid; */
}
.ruk-new-create-listing-sec .create-listing-des {
    color: #39393A;
}
.ruk-new-create-listing-sec h1, p, input, label, select, option, textarea, button, a{
    font-family:Manrope !important;
}

.ruk-new-create-listing-sec label{    
  	color:#ADADAD;
  font-size:14px;
  width:100%;
}
.ruk-new-create-listing-sec label span{
    color:#FF0000;
}
.ruk-new-create-listing-sec input, select{
   height:42px; !important;
}
.ruk-new-create-listing-sec input[type=text], input[type=number], select, textarea{
	background-color:#F5F6FA !important;
    border-radius:5px !important;
    border:unset !important;
    font-size:12px !important;
}
.formValidationQuery .create-listing-submit {
    background-color: #8B1339 !important;
    border-radius:25px !important;
    padding:10px 20px !important;
}

div#uploadImagePreviewerShow, div#uploadImagePreviewerShow1, div#uploadImagePreviewerShow2, div#uploadImagePreviewerShow3, div#uploadImagePreviewerShow4, div#uploadImagePreviewerShow5, div#uploadImagePreviewerShow6 {
    background-position: center;
    background-size: 73% 50%;
    background-repeat: no-repeat;
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
                <div class="main-content-class">
					
					<div class="ruk-new-create-listing-sec">

						<div class="dashboard">
							<h1 class="create-listing-h">Create Listing</h1>
							<p class="create-listing-des">A few descriptive words to help buyers find your item.</p>
							<form id="create-listing-form" class="formValidationQuery" method="post" enctype="multipart/form-data">
							  <div class="row">
								<div class="col mb-4">
								  <label class="mb-2">Category <span>*</span></label>
								  <select id="top_category" name="category_level" class="form-select category_level" aria-label="Default select example" required>
									<option selected value="">Select Parent Category</option>
									<?php
										global $wpdb;
										$categories = $wpdb->get_results("SELECT id, name FROM `categories` WHERE category_level = 1");

										if (!empty($categories)) {
											foreach ($categories as $category) { ?>
										<option value="<?php echo esc_attr($category->id); ?>">
											<?php echo esc_html($category->name); ?>
										</option>
										<?php }
										}
									?>
								  </select>
									<span class="error" id="category1"></span>
								</div>

								  
								<div class="col mb-4">
								  <label class="mb-2">Sub Category <span>*</span></label>
								  	<select class="form-select sub-category" name="sub_category" aria-label="Default select example" required>
										<option>No Sub Category</option>
									</select>
									<span class="error" id="category2"></span>
								</div>
							  </div>

							  <div class="row">
								<div class="col mb-4">
								  <label class="mb-2">Sub SubCategory <span>*</span></label>
								  	<select class="form-select sub-sub-category" name="sub_sub_category" aria-label="Default select example">
										<option>No Sub SubCategory</option>
									</select>
									<span class="error" id="category3"></span>
								</div>
								<div class="col mb-4">
								  	<label class="mb-2">Product Name <span>*</span></label>
								 	<input type="text" class="form-control" id="StoreName" name="titleProduct" placeholder="The Bully Supply" required/>
									<span class="error" id="productName"></span>
								</div>
							  </div>

							  <div class="row">
								  
								  <div class="col mb-4">
								  <label class="mb-2">State <span>*</span></label>
									  <select id="state" class="form-control state" name="state" required>
										  <option value="">Select State</option>
										  <option value="AL">AL</option> <option value="AK">AK</option>
										  <option value="AZ">AZ</option> <option value="AR">AR</option>
										  <option value="CA">CA</option> <option value="CO">CO</option>
										  <option value="CT">CT</option> <option value="DE">DE</option>
										  <option value="FL">FL</option> <option value="GA">GA</option>
										  <option value="HI">HI</option> <option value="ID">ID</option>
										  <option value="IL">IL</option> <option value="IN">IN</option>
										  <option value="IA">IA</option> <option value="KS">KS</option>
										  <option value="KY">KY</option> <option value="LA">LA</option>
										  <option value="ME">ME</option> <option value="MD">MD</option>																					<option value="MA">MA</option> <option value="MI">MI</option>																					<option value="MN">MN</option> <option value="MS">MS</option>																					<option value="MO">MO</option> <option value="MT">MT</option>
										  <option value="NE">NE</option> <option value="NV">NV</option>
										  <option value="NH">NH</option> <option value="NJ">NJ</option>
										  <option value="NM">NM</option> <option value="NY">NY</option>
										  <option value="NC">NC</option> <option value="ND">ND</option>
										  <option value="OH">OH</option> <option value="OK">OK</option>
										  <option value="OR">OR</option> <option value="PA">PA</option>
										  <option value="RI">RI</option> <option value="SC">SC</option>
										  <option value="SD">SD</option> <option value="TN">TN</option>
										  <option value="TX">TX</option> <option value="UT">UT</option>																					<option value="VT">VT</option> <option value="VA">VA</option>
										  <option value="WA">WA</option> <option value="WV">WV</option>
										  <option value="WI">WI</option> <option value="WY">WY</option>																					<option value="DC">DC</option> <option value="AS">AS</option>
										  <option value="GU">GU</option> <option value="MP">MP</option>
										  <option value="PR">PR</option> <option value="VI">VI</option>
									  </select>
									  <span class="error" id="stateError"></span>
								  </div>
								  
								  
								<div class="col mb-4">
								  <label class="mb-2">Location <span>*</span></label>
								  <input type="text" class="form-control" id="city" name="city" placeholder="Enter City" />
									<span class="error" id="location"></span>
								</div>
								<div class="col mb-4">
								  <label class="mb-2">Price in USD <span>*</span></label>
								  <input type="text" name="price" class="form-control price" id="" placeholder="$ 36.99" required/>
									<span class="error" id="price"></span>
								</div>
							  </div>
							  <div class="row">
								<div class="col mb-4 gender_box">
								  <label class="mb-2">Gender <span>*</span></label>
									<select class="form-select gender_field" name="gender" aria-label="Default select example" required>
										<option selected value="">Select Gender</option>
										<option value="1">Male</option>
										<option value="2">Female</option>
								  	</select>
									<span class="error" id="gender"></span>
								</div>
								<div class="col mb-4 age_box">
								  <label class="mb-2">Age in Years <span>*</span></label>
								  <input type="number" class="form-control age_field"  name="age" id="" placeholder="The Bully Supply" required/>
									<span class="error" id="age"></span>
								</div>
							  </div>

							  <div class="row">
								<div class="col mb-4">
								  <label class="mb-2">Description <span>*</span></label>
								  <textarea class="form-control description_field" name="description" aria-label="With textarea" required></textarea>
									<span class="error" id="descriptionErrorSpan"></span>
								</div>
								<div class="col mb-4">
								  <label for="">Images</label>
								  <div class="file">
									<div class="file-1 file-upload-flex-block-item01" id="uploadImagePreviewerShow">
										<label for="file01" class="mb-2">Upload File</label>
										<input type="file" id="file01" name="fileUpload01" class="uploadImagePreviewer" accept=".png, .jpg, .jpeg, .gif" data-preview="uploadImagePreviewerShow"/>
									</div>

									<div class="file-1 file-upload-flex-block-item02" id="uploadImagePreviewerShow1">
										<label for="file02" class="mb-2">Upload File</label>
										<input type="file" id="file02" name="fileUpload02" class="uploadImagePreviewer" accept=".png, .jpg, .jpeg, .gif" data-preview="uploadImagePreviewerShow1"/>
									</div>

									<div class="file-1 file-upload-flex-block-item03" id="uploadImagePreviewerShow2">
										<label for="file03" class="mb-2">Upload File</label>
										<input type="file" id="file03" name="fileUpload03" class="uploadImagePreviewer" accept=".png, .jpg, .jpeg, .gif" data-preview="uploadImagePreviewerShow2"/>
									</div>

									<div class="file-1 file-upload-flex-block-item04" id="uploadImagePreviewerShow3">
										<label for="file04" class="mb-2">Upload File</label>
										<input type="file" id="file04" name="fileUpload04" class="uploadImagePreviewer" accept=".png, .jpg, .jpeg, .gif" data-preview="uploadImagePreviewerShow3"/>
									</div>

								  </div>
								</div>
							  </div>
							  <div class="row">
								<div class="col d-flex justify-content-end">
									 <input type="submit" name="submit" value="Post an Ad" class="Save create-listing-submit">
								</div>
							  </div>
							</form>
						  </div>
					</div>
					
                </div>
                <!-- End Template Page Content-->
            </div>
        </div>
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>	
	
jQuery(document).ready(function($) {
    var subCategoryWrapper = $('.sub-category');
    var subSubCategoryWrapper = $('.sub-sub-category');

    $('#top_category').on('change', function() {
        var parentCategoryId = $(this).val();
		
		console.log(parentCategoryId);
		
		var validCategories = [2, 3, 4];
		
		if (validCategories.includes(parseInt(parentCategoryId))) {
			
			$('.gender_box, .age_box').hide();
			$('.gender_field').val(0);
			$('.age_field').val(0);
		} else {
			$('.gender_box, .age_box').show();
		}
        
        subCategoryWrapper.empty().append('<option value="">Select Sub Category</option>');
        subSubCategoryWrapper.empty().append('<option value="">Select Sub SubCategory</option>');

        if (parentCategoryId) {
            fetchCategories(parentCategoryId, subCategoryWrapper);
        }
    });

    subCategoryWrapper.on('change', function() {
        var subCategoryId = $(this).val();        
        subSubCategoryWrapper.empty().append('<option value="">Select Sub SubCategory</option>');

        if (subCategoryId) {
            fetchCategories(subCategoryId, subSubCategoryWrapper);
        }
    });

    function fetchCategories(parentId, dropdown) {
        $.ajax({
            url: ajaxurl,
            type: 'POST',
            data: {
                action: 'get_categories_by_child',
                parent_id: parentId
            },
            success: function(response) {
                if (response.length > 0) {
                    $.each(response, function(index, category) {
                        dropdown.append('<option value="' + category.id + '">' + category.name + '</option>');
                    });
                } else {
                    console.log('No child categories available for the selected category');
                }
            },
            error: function(error) {
                console.error('Error fetching categories:', error);
            }
        });
    }
	
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
	
	// On form submit, validate each field
	$('form').on('submit', function(event) {
		let isValid = true;
		
		// Get the value of top_category
    	let category_level = $('.category_level').val();

		// Run validation checks for each field
		isValid &= validateField('.category_level', '#category1');
		isValid &= validateField('.sub-category', '#category2');
		
		if (category_level != '3') {
			console.log('run');
			isValid &= validateField('.sub-sub-category', '#category3');
		}
		if (category_level == '1') {
			console.log('run2');
			isValid &= validateField('.gender_field', '#gender');
			isValid &= validateField('.age_field', '#age');
		}
		
		isValid &= validateField('#StoreName', '#productName');
		isValid &= validateField('.state', '#stateError');
		isValid &= validateField('#city', '#location');
		isValid &= validateField('.price', '#price');
		isValid &= validateField('.description_field', '#descriptionErrorSpan');

		// Prevent form submission if validation fails
		if (!isValid) {
			event.preventDefault();
		}
	});
});

</script>

<?php
get_footer();
?>
