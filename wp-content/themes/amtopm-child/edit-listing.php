<?php ob_start();
if(session_status() === PHP_SESSION_NONE) {
    session_start();
}
include ('connection.php');
/* 
Template Name: edit-listing
*/ 
if(!isset($_COOKIE["user_id"]) || $_COOKIE["user_id"]==0){ 
  header("location: /login/");
}

$editListings=mysqli_query($con,"SELECT * FROM `listings` where `id`=".$_GET['id']." and `userID`='".$_COOKIE["user_id"]."' ");      
$editListing = mysqli_fetch_array($editListings);
if(!isset($editListing['id'])){
    header("location: /my-shop/");
}

if(isset($_POST['submit'])){
 
    $titleProduct=$_POST['titleProduct']?$_POST['titleProduct']:'';
//     $typeProduct=$_POST['typeProduct']?$_POST['typeProduct']:'';
	$category_level=$_POST['category_level']?$_POST['category_level']:'';
    $category_id=$_POST['category_id']?$_POST['category_id']:'';
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
            mysqli_query($con," UPDATE `listings` SET `gallery1`='".$fileUpload01."' WHERE `id`='".$_GET['id']."' ");
        }
    }
    
    $fileUpload02 = '';
    if(!empty($_FILES["fileUpload02"]["type"])){
        $fileName = time().'_'.$_FILES['fileUpload02']['name'];
        $sourcePath = $_FILES['fileUpload02']['tmp_name'];
        $targetPath = "/www/wwwroot/thebullysupply.com/wp-content/themes/amtopm-child/uploaded/listing/".$fileName;
        if(move_uploaded_file($sourcePath,$targetPath)){
            $fileUpload02 = "/wp-content/themes/amtopm-child/uploaded/listing/".$fileName;
            mysqli_query($con," UPDATE `listings` SET `gallery2`='".$fileUpload02."' WHERE `id`='".$_GET['id']."' ");
        }
    }
    
    $fileUpload03 = '';
    if(!empty($_FILES["fileUpload03"]["type"])){
        $fileName = time().'_'.$_FILES['fileUpload03']['name'];
        $sourcePath = $_FILES['fileUpload03']['tmp_name'];
        $targetPath = "/www/wwwroot/thebullysupply.com/wp-content/themes/amtopm-child/uploaded/listing/".$fileName;
        if(move_uploaded_file($sourcePath,$targetPath)){
            $fileUpload03 = "/wp-content/themes/amtopm-child/uploaded/listing/".$fileName;
            mysqli_query($con," UPDATE `listings` SET `gallery3`='".$fileUpload03."' WHERE `id`='".$_GET['id']."' ");
        }
    }
    
    $fileUpload04 = '';
    if(!empty($_FILES["fileUpload04"]["type"])){
        $fileName = time().'_'.$_FILES['fileUpload04']['name'];
        $sourcePath = $_FILES['fileUpload04']['tmp_name'];
        $targetPath = "/www/wwwroot/thebullysupply.com/wp-content/themes/amtopm-child/uploaded/listing/".$fileName;
        if(move_uploaded_file($sourcePath,$targetPath)){
            $fileUpload04 = "/wp-content/themes/amtopm-child/uploaded/listing/".$fileName;
            mysqli_query($con," UPDATE `listings` SET `gallery4`='".$fileUpload04."' WHERE `id`='".$_GET['id']."' ");
        }
    }
    
    $fileUpload05 = '';
    if(!empty($_FILES["fileUpload05"]["type"])){
        $fileName = time().'_'.$_FILES['fileUpload05']['name'];
        $sourcePath = $_FILES['fileUpload05']['tmp_name'];
        $targetPath = "/www/wwwroot/thebullysupply.com/wp-content/themes/amtopm-child/uploaded/listing/".$fileName;
        if(move_uploaded_file($sourcePath,$targetPath)){
            $fileUpload05 = "/wp-content/themes/amtopm-child/uploaded/listing/".$fileName;
            mysqli_query($con," UPDATE `listings` SET `gallery5`='".$fileUpload05."' WHERE `id`='".$_GET['id']."' ");
        }
    }
    
    $fileUpload06 = '';
    if(!empty($_FILES["fileUpload06"]["type"])){
        $fileName = time().'_'.$_FILES['fileUpload06']['name'];
        $sourcePath = $_FILES['fileUpload06']['tmp_name'];
        $targetPath = "/www/wwwroot/thebullysupply.com/wp-content/themes/amtopm-child/uploaded/listing/".$fileName;
        if(move_uploaded_file($sourcePath,$targetPath)){
            $fileUpload06 = "/wp-content/themes/amtopm-child/uploaded/listing/".$fileName;
            mysqli_query($con," UPDATE `listings` SET `gallery6`='".$fileUpload06."' WHERE `id`='".$_GET['id']."' ");
        }
    }
     
    $update=mysqli_query($con," UPDATE `listings` SET `title`='".$titleProduct."',`category_level`='".$category_level."',`category`='".$category_id."',`gender`='".$gender."',`age`='".$age."',`descriptions`='".$description."',`price`='".$price."',
    `state`='".$state."',`city`='".$city."', `gallery1`='".$fileUpload01."', `gallery2`='".$fileUpload02."', `gallery3`='".$fileUpload03."', `gallery4`='".$fileUpload04."', `gallery5`='".$fileUpload05."', `gallery6`='".$fileUpload06."' WHERE `id`='".$_GET['id']."' ");
	
	
	if ($update) {
		header("location: /my-shop/");
// 		exit();
	} else {
		echo "Error in query: " . mysqli_error($con);
	}
    
}

get_header();
?>
<section id="create-listing" class="create-listing template-common-class">
    <div class="container-fluid">
        <div class="row">
            <div class="template-pages-content">
                <!--=== SideBar-->
                <div class="template-sidebar">
                    <?php $activeSidebar="my-shop"; include "custom-sidebar.php"; ?>
                </div>
                <!-- Start Template Page Content-->
                <div class="main-content-class">
                    <div class="inner-page-content">
                        <div class="template-page-title">
                            <h2>Update Listing</h2>
                        </div>
                        <div class="create-listing-block create-listing-block01">
                        <form id="create-listing-form" class="formValidationQuery" method="POST" enctype="multipart/form-data">
                            
                            <div class="create-listing-block-item create-listing-block-item01 same-width-class">
                                <div class="create-listing-block-item-left-side-content">
                                    <h1>1</h1>
                                    <h4>PRODUCT INFO</h4>
                                    <p>A few descriptive words to help buyers find your item.</p>
                                </div>
                            <div class="create-listing-block-item-right-side-content">
                                    <h3>The Basics</h3>
                                    <p>Product name, product description</p>
                                        <div class="flex-block flex-block01">
                                            <div class="flex-block-item flex-block-item01">
                                              <label class="template-label" for="TitleProduct">Title of your Product</label>
                                              <input type="text" id="StoreName" name="titleProduct" value="<?php echo $editListing['title']; ?>" placeholder="The Bully Supply" required maxlength="50"/>
                                              <label class="template-label-bottom">Max 50 characters</label>
                                            </div>
                                           	<div class="flex-block-item flex-block-item02">
												<label class="template-label" for="Category Level">Category</label>
												<select id="top_category" name="category_level" style="width: 100%;">
													<option value="">Select Parent Category</option>
													<?php
													global $wpdb;
													$categories = $wpdb->get_results("SELECT id, name FROM `categories` WHERE category_level = 1");

													if (!empty($categories)) {
														foreach ($categories as $category) { ?>
															<option value="<?php echo esc_attr($category->id); ?>" <?php echo ($editListing['category_level'] == $category->id) ? 'selected' : ''; ?>>
																<?php echo esc_html($category->name); ?>
															</option>
														<?php }
													}
													?>
												</select>
											</div>
											
											<div id="categoryDropdownsWrapper"></div>

											<!-- Hidden input to store the selected category ID from the database (set this value dynamically) -->
											<input type="hidden" id="selectedCategoryId" value="<?php echo esc_attr($storedCategoryId); ?>" />
											
											
                                            <div class="flex-block-item flex-block-item03">
                                                  <h5>Category</h5>
                                                  <p>Please click the arrow to expand the category and select the sub category in which your product matches. This will be helpful for the customers to reach your product easily</p>
                                                  
					<p id="parentCategoryWrapper2">
						<label>Parent Category</label>
						<select name="category_id" id="parentCategory2" style="width: 100%;">
							<option value="">Select Category</option>
							<?php
							// Fetch the parent category details based on the category ID from the listing
							$parent_categories = $wpdb->get_results("SELECT * FROM `categories` WHERE id = " . intval($editListing['category']));

							if ($parent_categories) {
								foreach ($parent_categories as $parent) {
									// Fetch child categories based on the parent ID
							$child_categories = $wpdb->get_results("SELECT * FROM `categories` WHERE parent_id = " . intval($parent->parent_id));

									if ($child_categories) { ?>
										<?php foreach ($child_categories as $child) { ?>
										<option value="<?php echo $child->id; ?>" 
												<?php echo ($editListing['category'] == $child->id) ? 'selected' : ''; ?>>
											<?php echo $child->name; ?>
										</option>
										<?php } ?>
									<?php }
								}
							}
							?>
						</select>
					</p>
												
                                                    <div class="Description-class">
                                                        <label class="template-label">Description</label>
                                                        <textarea name="description" required placeholder="Welcome to our premier dog emporium, where tails wag and hearts melt! Step into a world of canine delight at our dog store, where we cater to every breed, size, and personality. Our store is a haven for all things dog-related, curated with care to ensure your furry friend receives only the best."><?php echo $editListing['descriptions']; ?></textarea>
                                                    </div>
                                              </div>
                                          </div>
                                    </div>
                                    </div>
                            <div class="create-listing-block-item create-listing-block-item02 same-width-class">
                                <div class="create-listing-block-item-left-side-content">
                                    <h1>2</h1>
                                    <h4>Prices</h4>
                                </div> 
                                <div class="create-listing-block-item-right-side-content">
                                    <h3>The Logistics</h3>
                                    <p>Product price, weight, quantity</p>
									
										<div class="flex-block-item flex-block-item01 gender_box">
											 <label class="template-label">Gender</label>
											 <select id="top_category" name="gender" class="gender_field" style="width: 100%;" required>
												 <option value="">Select Gender</option>
												 <option value="1" <?php echo ($editListing['gender'] == 1) ? 'selected' : ''; ?>>Male</option>
												 <option value="2" <?php echo ($editListing['gender'] == 2) ? 'selected' : ''; ?>>Female</option>
											 </select>
										</div>

										<div class="flex-block-item flex-block-item02 age_box">
											<label class="template-label">Age</label>
											<input type="text" id="age" name="age" class="age_field" placeholder="Enter Age" maxlength="2" value="<?php echo $editListing['age']; ?>" required/>
										</div>
                                    
                                         <div class="flex-block flex-block02">
                                             
                                            <div class="flex-block-item flex-block-item02">
                                              <label class="template-label" for="price">Price</label>
                                               <p>Please enter only number with maximum 2 decimal places. Kindly dont use comma or dollar symbol. Eg. 4200 or 50.25.</p>
                                               <div class="width-class">
                                                    <input type="number" id="price" name="price" placeholder="price" value="<?php echo $editListing['price']; ?>" required />
                                               </div>
                                              <label class="template-label-bottom">Must be in <strong>USD</strong></label>
                                            </div>
                                            
                                      </div>
                                </div>
                            </div>
							
							
							<div class="create-listing-block-item create-listing-block-item02 same-width-class">
                                <div class="create-listing-block-item-left-side-content">
                                    <h1>3</h1>
                                    <h4>Location</h4>
                                </div> 
                                <div class="create-listing-block-item-right-side-content">
                                    <h3>The Locations</h3>
                                    <p>Select Location</p>
                                    
									<div class="flex-block flex-block02">
										<div class="flex-block-item flex-block-item01">
											<label class="template-label">State</label>
											<select id="state" name="state" style="width: 100%;" required>
												<option value="">Select State</option>
												<option value="AL" <?php if($editListing['state']=='AL'){ echo "selected"; } ?>>AL</option> 
												<option value="AK" <?php if($editListing['state']=='AK'){ echo "selected"; } ?>>AK</option>
												<option value="AZ" <?php if($editListing['state']=='AZ'){ echo "selected"; } ?>>AZ</option> 
												<option value="AR" <?php if($editListing['state']=='AR'){ echo "selected"; } ?>>AR</option>
												<option value="CA" <?php if($editListing['state']=='CA'){ echo "selected"; } ?>>CA</option> 
												<option value="CO" <?php if($editListing['state']=='CO'){ echo "selected"; } ?>>CO</option>
												<option value="CT" <?php if($editListing['state']=='CT'){ echo "selected"; } ?>>CT</option> 
												<option value="DE" <?php if($editListing['state']=='DE'){ echo "selected"; } ?>>DE</option>
												<option value="FL" <?php if($editListing['state']=='FL'){ echo "selected"; } ?>>FL</option> 
												<option value="GA" <?php if($editListing['state']=='GA'){ echo "selected"; } ?>>GA</option>
												<option value="HI" <?php if($editListing['state']=='HI'){ echo "selected"; } ?>>HI</option> 
												<option value="ID" <?php if($editListing['state']=='ID'){ echo "selected"; } ?>>ID</option>
												<option value="IL" <?php if($editListing['state']=='IL'){ echo "selected"; } ?>>IL</option> 
												<option value="IN" <?php if($editListing['state']=='IN'){ echo "selected"; } ?>>IN</option>
												<option value="IA" <?php if($editListing['state']=='IA'){ echo "selected"; } ?>>IA</option> 
												<option value="KS" <?php if($editListing['state']=='KS'){ echo "selected"; } ?>>KS</option>
												<option value="KY" <?php if($editListing['state']=='KY'){ echo "selected"; } ?>>KY</option> 
												<option value="LA" <?php if($editListing['state']=='LA'){ echo "selected"; } ?>>LA</option>
												<option value="ME" <?php if($editListing['state']=='ME'){ echo "selected"; } ?>>ME</option> 
												<option value="MD" <?php if($editListing['state']=='MD'){ echo "selected"; } ?>>MD</option>														<option value="MA" <?php if($editListing['state']=='MA'){ echo "selected"; } ?>>MA</option> 
												<option value="MI" <?php if($editListing['state']=='MI'){ echo "selected"; } ?>>MI</option>														<option value="MN" <?php if($editListing['state']=='MN'){ echo "selected"; } ?>>MN</option> 
												<option value="MS" <?php if($editListing['state']=='MS'){ echo "selected"; } ?>>MS</option>														<option value="MO" <?php if($editListing['state']=='MO'){ echo "selected"; } ?>>MO</option> 
												<option value="MT" <?php if($editListing['state']=='MT'){ echo "selected"; } ?>>MT</option>
												<option value="NE" <?php if($editListing['state']=='NE'){ echo "selected"; } ?>>NE</option> 
												<option value="NV" <?php if($editListing['state']=='NV'){ echo "selected"; } ?>>NV</option>
												<option value="NH" <?php if($editListing['state']=='NH'){ echo "selected"; } ?>>NH</option> 
												<option value="NJ" <?php if($editListing['state']=='NJ'){ echo "selected"; } ?>>NJ</option>
												<option value="NM" <?php if($editListing['state']=='NM'){ echo "selected"; } ?>>NM</option> 
												<option value="NY" <?php if($editListing['state']=='NY'){ echo "selected"; } ?>>NY</option>
												<option value="NC" <?php if($editListing['state']=='NC'){ echo "selected"; } ?>>NC</option> 
												<option value="ND" <?php if($editListing['state']=='ND'){ echo "selected"; } ?>>ND</option>
												<option value="OH" <?php if($editListing['state']=='OH'){ echo "selected"; } ?>>OH</option> 
												<option value="OK" <?php if($editListing['state']=='OK'){ echo "selected"; } ?>>OK</option>
												<option value="OR" <?php if($editListing['state']=='OR'){ echo "selected"; } ?>>OR</option> 
												<option value="PA" <?php if($editListing['state']=='PA'){ echo "selected"; } ?>>PA</option>
												<option value="RI" <?php if($editListing['state']=='RI'){ echo "selected"; } ?>>RI</option> 
												<option value="SC" <?php if($editListing['state']=='SC'){ echo "selected"; } ?>>SC</option>
												<option value="SD" <?php if($editListing['state']=='SD'){ echo "selected"; } ?>>SD</option> 
												<option value="TN" <?php if($editListing['state']=='TN'){ echo "selected"; } ?>>TN</option>
												<option value="TX" <?php if($editListing['state']=='TX'){ echo "selected"; } ?>>TX</option> 
												<option value="UT" <?php if($editListing['state']=='UT'){ echo "selected"; } ?>>UT</option>														<option value="VT" <?php if($editListing['state']=='VT'){ echo "selected"; } ?>>VT</option> 
												<option value="VA" <?php if($editListing['state']=='VA'){ echo "selected"; } ?>>VA</option>
												<option value="WA" <?php if($editListing['state']=='WA'){ echo "selected"; } ?>>WA</option> 
												<option value="WV" <?php if($editListing['state']=='WV'){ echo "selected"; } ?>>WV</option>
												<option value="WI" <?php if($editListing['state']=='WI'){ echo "selected"; } ?>>WI</option> 
												<option value="WY" <?php if($editListing['state']=='WY'){ echo "selected"; } ?>>WY</option>														<option value="DC" <?php if($editListing['state']=='DC'){ echo "selected"; } ?>>DC</option> 
												<option value="AS" <?php if($editListing['state']=='AS'){ echo "selected"; } ?>>AS</option>
												<option value="GU" <?php if($editListing['state']=='GU'){ echo "selected"; } ?>>GU</option> 
												<option value="MP" <?php if($editListing['state']=='MP'){ echo "selected"; } ?>>MP</option>
												<option value="PR" <?php if($editListing['state']=='PR'){ echo "selected"; } ?>>PR</option> 
												<option value="VI" <?php if($editListing['state']=='VI'){ echo "selected"; } ?>>VI</option>
											</select>
										</div>

										<div class="flex-block-item flex-block-item02">
											<label class="template-label">City</label>
											<input type="text" id="city" name="city" placeholder="Enter City" value="<?php echo $editListing['city']; ?>" required/>
										</div>
                                      </div>
                                </div>
                            </div>
							
                            
                            <div class="create-listing-block-item create-listing-block-item06 same-width-class">
                                <div class="create-listing-block-item-left-side-content">
                                    <h1>3</h1>
                                    <h4>The Gallery</h4>
                                </div> 
                                <div class="create-listing-block-item-right-side-content">
                                    <h3>The Gallery</h3>
                                    <p>Product photos.</p>
                                    <div class="files-upload-warpper">
                                        <label class="file-upload-label">Profile Photo</label>
                                        <div class="file-upload-flex-block">
                                            <div class="file-upload-flex-block-item file-upload-flex-block-item01  <?php if($editListing['gallery1']!=''){ echo "show"; } ?>" id="uploadImagePreviewerShow" <?php if($editListing['gallery1']!=''){ ?> style="background-image:url(<?php echo $editListing['gallery1']; ?>);" <?php } ?>>
                                                <input type="file" name="fileUpload01" class="file-upload-input uploadImagePreviewer" data-preview="uploadImagePreviewerShow" accept="image/png, image/gif, image/jpeg" />
                                                <div class="inner-file-upload-label">
                                                    <span class="upload-icon"><img src="/wp-content/uploads/2024/05/Vector-3.png" alt="Upload Image"></span>
                                                    <label class="inner-file-label">Drag or Upload Photo</label>
                                                </div>
                                            </div>
                                             <div class="file-upload-flex-block-item file-upload-flex-block-item02  <?php if($editListing['gallery2']!=''){ echo "show"; } ?>" id="uploadImagePreviewerShow1" <?php if($editListing['gallery2']!=''){ ?> style="background-image:url(<?php echo $editListing['gallery2']; ?>);" <?php } ?>>
                                                <input type="file" name="fileUpload02" class="file-upload-input uploadImagePreviewer" data-preview="uploadImagePreviewerShow1" accept="image/png, image/gif, image/jpeg" />
                                                <div class="inner-file-upload-label">
                                                    <span class="upload-icon"><img src="/wp-content/uploads/2024/05/Vector-3.png" alt="Upload Image"></span>
                                                    <label class="inner-file-label">Drag or Upload Photo</label>
                                                </div>
                                            </div>
                                             <div class="file-upload-flex-block-item file-upload-flex-block-item03  <?php if($editListing['gallery3']!=''){ echo "show"; } ?>" id="uploadImagePreviewerShow2" <?php if($editListing['gallery3']!=''){ ?> style="background-image:url(<?php echo $editListing['gallery3']; ?>);" <?php } ?>>
                                                <input type="file" name="fileUpload03" class="file-upload-input uploadImagePreviewer" data-preview="uploadImagePreviewerShow2" accept="image/png, image/gif, image/jpeg" />
                                                <div class="inner-file-upload-label">
                                                    <span class="upload-icon"><img src="/wp-content/uploads/2024/05/Vector-3.png" alt="Upload Image"></span>
                                                    <label class="inner-file-label">Drag or Upload Photo</label>
                                                </div>
                                            </div>
                                            
                                            <div class="file-upload-flex-block-item file-upload-flex-block-item04  <?php if($editListing['gallery4']!=''){ echo "show"; } ?>" id="uploadImagePreviewerShow3" <?php if($editListing['gallery4']!=''){ ?> style="background-image:url(<?php echo $editListing['gallery4']; ?>);" <?php } ?>>
                                                <input type="file" name="fileUpload04" class="file-upload-input uploadImagePreviewer" data-preview="uploadImagePreviewerShow3" accept="image/png, image/gif, image/jpeg" />
                                                <div class="inner-file-upload-label">
                                                    <span class="upload-icon"><img src="/wp-content/uploads/2024/05/Vector-3.png" alt="Upload Image"></span>
                                                    <label class="inner-file-label">Drag or Upload Photo</label>
                                                </div>
                                            </div>
                                             <div class="file-upload-flex-block-item file-upload-flex-block-item05  <?php if($editListing['gallery5']!=''){ echo "show"; } ?>" id="uploadImagePreviewerShow4" <?php if($editListing['gallery5']!=''){ ?> style="background-image:url(<?php echo $editListing['gallery5']; ?>);" <?php } ?>>
                                                <input type="file" name="fileUpload05" class="file-upload-input uploadImagePreviewer" data-preview="uploadImagePreviewerShow4" accept="image/png, image/gif, image/jpeg" />
                                                <div class="inner-file-upload-label">
                                                    <span class="upload-icon"><img src="/wp-content/uploads/2024/05/Vector-3.png" alt="Upload Image"></span>
                                                    <label class="inner-file-label">Drag or Upload Photo</label>
                                                </div>
                                            </div>
                                             <div class="file-upload-flex-block-item file-upload-flex-block-item06  <?php if($editListing['gallery6']!=''){ echo "show"; } ?>" id="uploadImagePreviewerShow5" <?php if($editListing['gallery6']!=''){ ?> style="background-image:url(<?php echo $editListing['gallery6']; ?>);" <?php } ?>>
                                                <input type="file" name="fileUpload06" class="file-upload-input uploadImagePreviewer" data-preview="uploadImagePreviewerShow5" accept="image/png, image/gif, image/jpeg" />
                                                <div class="inner-file-upload-label">
                                                    <span class="upload-icon"><img src="/wp-content/uploads/2024/05/Vector-3.png" alt="Upload Image"></span>
                                                    <label class="inner-file-label">Drag or Upload Photo</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="upload-decc">Please upload 1-3 images to represent your listing.Your image must be a PNG or JPEG, up to 1MB. For better visibility, please upload image size with same height and width. Eg. 500x500px, 600x600px</p>    
                                </div>
                            </div>
                                <!--====== Template Form Button-->
                                <div class="template-form-button">
                                    <input type="submit" name="submit" value="Save" class="Save">
                                </div>
                                <!--====== Template Form Button-->
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
    var categoryDropdownsWrapper = $('#categoryDropdownsWrapper');
    var selectedCategoryId = $('#selectedCategoryId').val(); // Ensure this element exists and has the correct value

    // Load the hierarchy on page load if there's a selected category ID
    if (selectedCategoryId) {
        loadCategoryHierarchy(selectedCategoryId);
    }

    $('#top_category').on('change', function() {
        var topCategory = $(this).val();
        categoryDropdownsWrapper.empty(); // Clear existing dropdowns
		var validCategories = [2, 3, 4];
		
        if (topCategory) {
			if (validCategories.includes(parseInt(topCategory))) {
				$('.gender_box, .age_box').hide();
			} else {
				$('.gender_box, .age_box').show();
			}
			
            createDropdown(topCategory);
        }
    });
	

    function loadCategoryHierarchy(selectedId) {
        $.ajax({
            url: ajaxurl,
            type: 'POST',
            data: {
                action: 'get_category_hierarchy',
                category_id: selectedId
            },
            success: function(response) {
                if (response.length > 0) {
                    var parentId = null;
                    response.forEach(function(category, index) {
                        if (index === 0) {
                            $('#top_category').val(category.id).trigger('change');
                            parentId = category.id;
                        } else {
                            createDropdown(parentId, category.id);
                            parentId = category.id;
                        }
                    });
                }
            },
            error: function(error) {
                console.error('Error loading category hierarchy:', error);
            }
        });
    }

    function createDropdown(parentId, selectedId = null) {
        $.ajax({
            url: ajaxurl,
            type: 'POST',
            data: {
                action: 'get_categories_by_child',
                parent_id: parentId
            },
            success: function(response) {
                if (response.length > 0) {
                    var label = $('<label></label>').addClass('template-label').text(parentId === 0 ? 'Top Level Category' : 'Child Categories');
                    var dropdown = $('<select name="category_id"></select>').addClass('dynamic-category-dropdown').css('width', '100%');
                    dropdown.append('<option value="">Select Category</option>');

                    $.each(response, function(index, category) {
                        var isSelected = (selectedId && selectedId == category.id) ? 'selected' : '';
                        dropdown.append('<option value="' + category.id + '" ' + isSelected + '>' + category.name + '</option>');
                    });

                    categoryDropdownsWrapper.append(label);
                    categoryDropdownsWrapper.append(dropdown);

                    dropdown.on('change', function() {
                        var selectedId = $(this).val();
                        $(this).nextAll('.dynamic-category-dropdown').remove();

                        if (selectedId) {
                            createDropdown(selectedId);
                        }
                    });

                    if (selectedId) {
                        dropdown.trigger('change');
                    }
                } else {
                    console.log('No child categories available for the selected parent');
                }
            },
            error: function(error) {
                console.error('Error fetching categories:', error);
            }
        });
    }
});
	
</script>

<?php
get_footer();
?>
