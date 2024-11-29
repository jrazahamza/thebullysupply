<?php ob_start();
if(session_status() === PHP_SESSION_NONE) {
    session_start();
}
include ('connection.php');
/* 
Template Name: create-listing
*/ 
// if(!isset($_COOKIE["user_id"]) || $_COOKIE["user_id"]==0){ 
//   header("location: /");
// }

if(isset($_POST['submit'])){
 
    $title=$_POST['title']?$_POST['title']:'';
	
	$category_level=$_POST['category_level']?$_POST['category_level']:'';
    $category_id=$_POST['category_id']?$_POST['category_id']:0;
	$category_id=$_POST['category_level'] == 3 ? $_POST['sub_category'] : $_POST['sub_sub_category'];
	$gender = ($_POST['gender'] && ($_POST['category_level'] == '1')) ? $_POST['gender'] : 0;
	$age = ($_POST['age'] && ($_POST['category_level'] == '1')) ? $_POST['age'] : 0;
    $description=$_POST['description']?$_POST['description']:'';
    $price=$_POST['price']?$_POST['price']:'';
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
     
    $insert=mysqli_query($con," INSERT INTO `listings`(`userID`, `title`, `category_level`,`category`, `gender`, `age`, `descriptions`, `price`, `city`, `gallery1`, `gallery2`, `gallery3`, `gallery4`, `gallery5`, `gallery6`, `status`, `userStatus`) 
    VALUES ('".$_COOKIE["user_id"]."','".$title."','".$category_level."','".$category_id."','".$gender."','".$age."','".$description."','".$price."', '".$city."','".$fileUpload01."','".$fileUpload02."','".$fileUpload03."','".$fileUpload04."','".$fileUpload05."','".$fileUpload06."','pending','listed') ");	
	
    
    if ($insert) {
		
		header("Location: /post-an-ad/?message=success");
		exit();
	} else {
		echo "Error in query: " . mysqli_error($con);
	}
    
}

get_header();
?>


<style>
	* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: Manrope;
}

/* POST AN AD */
.post-and-add-section{
  width: 1405px;
 margin:56px auto;
	border:1px solid #B9B9B9;
	border-radius:10px;
}
.post-an-ad {
  padding: 70px 30px;
}

.form-dog-house {
  display: flex;
  justify-content: space-between;
}
.post-an-ad .form-dog-house h1 {
  font-size: 40px;
  font-weight: 800;
  color: #121212;
}

.form {
  width: 48%;
  margin-top: 48px;
}
.form .category label {
  font-size: 14px;
  font-weight: 600;
  color: #adadad;
}
.form .category input {
  width: 100%;
  height: 50px;
  border: none;
  border-radius: 200px;
  background-color: #f5f6fa;
  font-size: 14px;
  font-weight: 400;
  color: #202224;
  padding-left: 36px;
  margin-top: 11px;
  margin-bottom: 26px;
}

.form .sub-divs {
  display: flex;
  gap: 18px;
}

.sub-divs .sub-divs-category label {
  font-size: 14px;
  font-weight: 600;
  color: #adadad;
}
.sub-divs .sub-divs-category {
    width: 100%;
}
.sub-divs .sub-divs-category input {
  width: 98%;
  height: 50px;
  border: none;
  border-radius: 200px;
  background-color: #f5f6fa;
  font-size: 14px;
  font-weight: 400;
  color: #202224;
  padding-left: 36px;
  margin-top: 11px;
  margin-bottom: 26px;
}

.form .description textarea {
  border-radius: 20px;
  background-color: #f5f6fa;
  margin-top: 11px;
  padding-top: 20px;
  padding-left:20px;
}

.form .upload-img-btn {
  border: 1px solid #003459;
  border-radius: 61px;
  padding: 15px 30px;
  margin-top: 25px;
  color: #003459;
  background-color: #ffffff;
}

.form .check {
  margin-top: 25px;
}
.form .check input {
  border: 1px solid #003459;
}

.form .check label {
  font-size: 16px;
  font-weight: 400;
  color: #787070;
}

.form .post-btn {
  border: none;
  border-radius: 61px;
  padding: 15px 30px;
  color: #ffffff;
  background-color: #8b1339 !important;
  margin-top: 25px;
}
.post-an-ad h1 {
    font-size: 24px;
    font-weight: 800;
}
.post-an-ad .ruk-top-cta {
  appearance: none; 
  -webkit-appearance: none; 
  -moz-appearance: none; 
  background-image: url(/wp-content/uploads/2024/11/Group-1321316319-1.png); 
  background-repeat: no-repeat;
  background-position: right 20px center;  
  height: 50px;
    padding: 0px 20px;
    background-color: #F5F6FA;
    border-radius: 200px;
    font-size: 14px;
    font-family: 'Manrope' !important;
	margin-bottom:24px;
}

.post-an-ad .dynamic-category-dropdown{
  appearance: none; 
  -webkit-appearance: none; 
  -moz-appearance: none; 
  background-image: url(/wp-content/uploads/2024/11/Group-1321316319-1.png); 
  background-repeat: no-repeat;
  background-position: right 20px center;  
  height: 50px;
    padding: 0px 20px;
    background-color: #F5F6FA;
    border-radius: 200px;
    font-size: 14px;
    font-family: 'Manrope' !important;
	margin-bottom:24px;
}
.post-an-ad .gender_field{
    appearance: none; 
  -webkit-appearance: none; 
  -moz-appearance: none; 
  background-image: url(/wp-content/uploads/2024/11/Group-1321316319-1.png); 
  background-repeat: no-repeat;
  background-position: right 20px center;  
  height: 50px;
  width:100% !important;
    padding: 0px 20px;
    background-color: #F5F6FA;
    border-radius: 200px;
    font-size: 14px;
    font-family: 'Manrope' !important;
}
.formValidationQuery input, textarea {
    font-size: 14px !important;
    font-family: 'Manrope' !important;
    color:#000 !important;
}	
/* Do House */

.dog-house {
  width: 45%;
  margin-top:48px;
}

.dog-house .dog-house-container {
  width: 479px;
/*   height: 636px; */
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  /* background-color: #787070; */
	text-align:center;
	align-items:center;
}

.dog-house .dog-house-container img {
  width: 100px;
  height: 100px;
}

.dog-house p {
  font-size: 16px;
  font-weight: 500;
  color: #080808;
  padding-bottom:0px;
  margin:14px 0px;
}

.dog-house .check-mark {
  display: flex;
  align-items: center;
  padding-left: 36px;
  margin-top: 10px;
}
.dog-house .check-mark img {
  width: 22px;
  height: 22px;
  margin-right: 9px;
}

.dog-house .check-mark span {
  font-size: 12px;
  font-weight: 400;
  color: #787070;
}
/* multiple file uplade code	 */
	
.file-upload-flex-block-item input[type=file] {
    margin-top:24px;
    
}

.file-upload-flex-block-item .inner-file-upload-label {
    margin-top: 24px;
}

.formValidationQuery #uploadImagePreviewerShow01 {
    //border: 1px solid red;
    padding-top:240px;
    margin-top:60px;
    width:360px
}
.formValidationQuery #uploadImagePreviewerShow02 {
    //border: 1px solid red;
    padding-top:240px;
    margin-top:60px;
    width:360px
}
.formValidationQuery #uploadImagePreviewerShow03 {
    //border: 1px solid red;
    padding-top:240px;
    margin-top:60px;
    width:360px
}
.formValidationQuery #uploadImagePreviewerShow04 {
    //border: 1px solid red;
    padding-top:240px;
    margin-top:60px;
    width:360px
}
.formValidationQuery #uploadImagePreviewerShow05 {
    //border: 1px solid red;
    padding-top:240px;
    margin-top:60px;
    width:360px
}
.formValidationQuery #uploadImagePreviewerShow06 {
    //border: 1px solid red;
    padding-top:240px;
    margin-top:60px;
    width:360px
}

.formValidationQuery .uploadImagePreviewer {
    border: 2px solid blue;
    margin-top:-290px !important;
}

.formValidationQuery .file-upload-flex-block-item {
    border: 1px solid;
    width: 170%;
    display: flex;
    flex-wrap: wrap;
}
.post-and-add-section h1, p, input, label, textarea, button {
    font-family: 'Manrope' !important;
}	
/*  new image upload section	 */
.ruk-dev-new-file-upload-sec {
    margin-top: 24px;
}
.ruk-dev-new-file-upload-sec .file {
  display: flex;
  background-color: #f5f6fa;
  border: none;
  border-radius: 20px;
  justify-content: space-around;
}

.ruk-dev-new-file-upload-sec .file-1 {
  padding: 24px 6px;
}
.ruk-dev-new-file-upload-sec .file-1 input {
  display: none;
}

.ruk-dev-new-file-upload-sec .file-1 label {
  padding: 10px 8px 10px 8px;
  border-radius: 6px;
  border: 1px dashed #003459;
  font-size: 10px;
  font-weight: 400;
  color: #000;
  cursor: pointer;
}
/* new code for file upload preview	 */
.formValidationQuery #uploadImagePreviewerShow01 {
    max-width: 66px;
}

.imagepreview {
   max-width: 66px !important;
    max-height: 35px !important;
    overflow: hidden !important;
/*     margin-top: -44px; */
    margin-left: 1px;
    border-radius: 5px;
	position: relative;
    top: -44px;
}
.imagepreview02 {
    max-width: 66px !important;
    max-height: 35px !important;
    overflow: hidden !important;
    margin-top: -44px;
    margin-left: 4px;
    border-radius: 5px;
    position: absolute;
    left: 20.5%;
}	
@media only screen and (max-width: 1440px) {
.ruk-post-an-container {
        max-width: 88vw;
        margin: 0 autop;
}
.imagepreview {

	position: relative;
    top: -70px;
}	
}	
</style>
<div class="post-an-add">

  <!-- POST AN AD SECTION-->
  <div class="wrapper post-and-add-section ruk-post-an-container">
    <div class="post-an-ad">
      <h1>POST AN ADD</h1>
      <div class="form-dog-house">
		  
        <!-- Form Section -->
        <div class="form">
		<?php 
		  	if (isset($_GET['message']) && $_GET['message'] === 'success'){
				echo "<span class='success-msg post-n-add' style='color: green;'>Post N Add Added Successfully</span>";
			}
		?>
		   <form class="formValidationQuery" method="POST" enctype="multipart/form-data">
			<div class="sub-divs">
				<div class="flex-block-item flex-block-item02 category">
					<label class="template-label" for="top_category">Category</label>	
				<select id="top_category" name="category_level" class="ruk-top-cta category_level" aria-label="Default select example" required>
						 <option selected value="">Select Parent Category</option>
						 <?php
						 global $wpdb;
						 $categories = $wpdb->get_results("SELECT id, name FROM `categories` WHERE category_level = 1");

						 if (!empty($categories)) {
							 foreach ($categories as $category) { ?>
							 <option value="<?php echo esc_attr($category->id); ?>">
								 <?php echo esc_html($category->name); ?>
							 </option>
						 <?php } } ?>
					</select>
					<span class="error" id="topCategoryError"></span>
				</div>
				
				<div class="flex-block-item flex-block-item02 category">
					<label class="template-label" for="top_category">Sub Category</label>
					<select class="ruk-top-cta sub-category" name="sub_category" aria-label="Default select example" required>
						<option>No Sub Category</option>
					</select>
					<span class="error" id="subCategoryError"></span>
				</div>
			</div>

		    <div class="category">
				<div class="flex-block-item flex-block-item02 category">
					<label class="template-label" for="top_category">Sub SubCategory</label>
					<select class="ruk-top-cta sub-sub-category" name="sub_sub_category" aria-label="Default select example">
						<option>No Sub SubCategory</option>
					</select>
					<span class="error" id="subSubCategoryError"></span>
				</div>
			</div>
			   
            <div class="category">
              <label for="sub-sub-category">Title Of Ad*</label><br />
              <input type="text" placeholder="The Bully Supply" id="title" name="title" required/>
				<span class="error" id="titleError"></span>
            </div>
            <div class="sub-divs">
              <div class="sub-divs-category">
                <label for="sub-sub-category">Location*</label><br />
                <input type="text" placeholder="Missouri USA" id="city" name="city" required/>
				  <span class="error" id="cityError"></span>
              </div>
              <div class="sub-divs-category">
                <label for="sub-sub-category">Price*in USD</label><br />
                <input type="number" placeholder="399.99" id="price" name="price" required/>
				  <span class="error" id="priceError"></span>
              </div>
            </div>  
			   
			   
            <div class="sub-divs gender_box">
              <div class="sub-divs-category">
                <label for="sub-sub-category">Gender*</label><br />
				  <select id="gender" name="gender" class="gender_field" style="width: 100%;" required>
					  <option value="">Select Gender</option>
					  <option value="1">Male</option>
					  <option value="2">Female</option>
				  </select>
				  <span class="error" id="genderError"></span>
              </div>
              <div class="sub-divs-category age_box">
                <label for="sub-sub-category">Age in Years</label><br />
                <input type="text" placeholder="2" id="age" name="age" class="age_field"/>
				  <span class="error" id="ageError"></span>
              </div>
            </div>
            <div class="category description">
              <label for="sub-sub-category">Description</label><br />
              <textarea name="descriptions" id="descriptions" rows="5" cols="90" required>Type Here</textarea>
				<span class="error" id="descriptionError"></span>
            </div>

				<div class="ruk-dev-new-file-upload-sec">
				  <label for="">Images</label>
				  <div class="file">
					<div class="file-1">
					  <label for="file1" class="mb-2">Upload File</label>
					  <input type="file" class="uploadImagePreviewer01" id="file1" name="fileUpload01" data-preview="uploadImagePreviewerShow01" accept="image/png, image/gif, image/jpeg" />
					  <div class="imagepreview" id="imagepreviewshow01">
						  <apn class="imag-box" id="uploadImagePreviewerShow01"> </apn>
					  </div>
					</div>
					<div class="file-1">
					  <label for="file2" class="mb-2">Upload File</label>
					  <input type="file" class="uploadImagePreviewer02" id="file2" name="fileUpload02" data-preview="uploadImagePreviewerShow02" accept="image/png, image/gif, image/jpeg" />
					  <div class="imagepreview" id="imagepreviewshow02">
						  <apn class="imag-box" id="uploadImagePreviewerShow02"> </apn>
					  </div>
					</div>
					<div class="file-1">
					  <label for="file3" class="mb-2">Upload File</label>
					  <input type="file" class="uploadImagePreviewer03" id="file3" name="fileUpload03" data-preview="uploadImagePreviewerShow03" accept="image/png, image/gif, image/jpeg" />
					  <div class="imagepreview" id="imagepreviewshow03">
						  <apn class="imag-box" id="uploadImagePreviewerShow03"> </apn>
					  </div>
					</div>

					<div class="file-1">
					  <label for="file4" class="mb-2">Upload File</label>
					  <input type="file" class="uploadImagePreviewer04" id="file4" name="fileUpload04" data-preview="uploadImagePreviewerShow04" accept="image/png, image/gif, image/jpeg" />
					  <div class="imagepreview" id="imagepreviewshow04">
						  <apn class="imag-box" id="uploadImagePreviewerShow04"> </apn>
					  </div>
					</div>

					<div class="file-1">
					  <label for="file5" class="mb-2">Upload File</label>
					  <input type="file" class="uploadImagePreviewer05" id="file5" name="fileUpload05" data-preview="uploadImagePreviewerShow05" accept="image/png, image/gif, image/jpeg" />
					  <div class="imagepreview" id="imagepreviewshow05">
						  <apn class="imag-box" id="uploadImagePreviewerShow05"> </apn>
					  </div>
					</div>
					  
					<div class="file-1">
					  <label for="file6" class="mb-2">Upload File</label>
					  <input type="file" class="uploadImagePreviewer06" id="file6" name="fileUpload06" data-preview="uploadImagePreviewerShow06" accept="image/png, image/gif, image/jpeg" />
					  <div class="imagepreview" id="imagepreviewshow06">
						  <apn class="imag-box" id="uploadImagePreviewerShow06"> </apn>
					  </div>
					</div>
					  
				  </div>
				</div>
            <button class="post-btn" type="submit" name="submit">Post an Ad</button>
          </form>
        </div>

        <!-- Do House -->
        <div class="dog-house">
          <div class="dog-house-container">
            <img src="/wp-content/uploads/2024/09/Group-1321316123.png" alt="" />
            <p>
              Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
              eiusmod tempor incididunt ut labore et dolore magna aliqua............
            </p>
            <div class="check-mark-container">
              <div class="check-mark">
                <img src="/wp-content/uploads/2024/09/Group.svg" alt="" />
                <span>Lorem ipsum dolor sit amet, consectetur adipiscing </span>
              </div>
              <div class="check-mark">
                <img src="/wp-content/uploads/2024/09/Group.svg" alt="" />
                <span>Lorem ipsum dolor sit amet, consectetur adipiscing </span>
              </div>
              <div class="check-mark">
                <img src="/wp-content/uploads/2024/09/Group.svg" alt="" />
                <span>Lorem ipsum dolor sit amet, consectetur adipiscing </span>
              </div>
              <div class="check-mark">
                <img src="/wp-content/uploads/2024/09/Group.svg" alt="" />
                <span>Lorem ipsum dolor sit amet, consectetur adipiscing </span>
              </div>
            </div>
          </div>
        </div>
		  
		  
		  
      </div>
    </div>
  </div>


</div>


<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>	
function handleFileChange(event) {
  const file = event.target.files[0];
  const previewId = event.target.getAttribute("data-preview");
  const previewContainer = document.getElementById(previewId);

  if (file && file.type.startsWith("image/")) {
    const reader = new FileReader();

    reader.onload = function(e) {
      const img = new Image();
      img.src = e.target.result;

      img.onload = function() {
        const canvas = document.createElement("canvas");
        const context = canvas.getContext("2d");

        // Set canvas size
        canvas.width = 66;
        canvas.height = 42;

        // Draw and resize the image onto the canvas
        context.drawImage(img, 0, 0, 60, 60);

        const resizedImageUrl = canvas.toDataURL("image/png");
        previewContainer.innerHTML = "";

        const previewImage = document.createElement("img");
        previewImage.src = resizedImageUrl;
        previewImage.style.width = "66px";
        previewImage.style.height = "42px";
        previewImage.style.objectFit = "cover";

        previewContainer.appendChild(previewImage);
      };
    };

    reader.readAsDataURL(file);
  }
}

// Attach event listeners
["file1", "file2", "file3", "file4", "file5", "file6"].forEach(id => {
  document.getElementById(id).addEventListener("change", handleFileChange);
});
	
</script>

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
		
		console.log(selector, value);

		return isValid;
	}
	
	// On form submit, validate each field
	$('form').on('submit', function(event) {
		let isValid = true; 
		
		// Get the value of top_category
    	let category_level = $('.category_level').val();

		// Run validation checks for each field
		isValid &= validateField('.category_level', '#topCategoryError');
		isValid &= validateField('.sub-category', '#subCategoryError');
		
		if (category_level != '3') {
			console.log('run');
			isValid &= validateField('.sub-sub-category', '#subSubCategoryError');
		}
		if (category_level == '1') {
			console.log('run2');
			isValid &= validateField('.gender_field', '#genderError');
			isValid &= validateField('.age_field', '#ageError');
		}
		
		isValid &= validateField('#title', '#titleError');
		isValid &= validateField('#city', '#cityError');
		isValid &= validateField('#price', '#priceError');
		isValid &= validateField('#descriptions', '#descriptionError');
		
		console.log(isValid);

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
