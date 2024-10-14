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
    $typeProduct=$_POST['typeProduct']?$_POST['typeProduct']:'';
    $categories=$_POST['categories']?implode(",",$_POST['categories']):'';
    $description=$_POST['description']?$_POST['description']:'';
    $price=$_POST['price']?$_POST['price']:'';
    $quantity=$_POST['quantity']?$_POST['quantity']:'';
    $stock=$_POST['stock']?$_POST['stock']:'';
    $weight=$_POST['weight']?$_POST['weight']:'';
    $expireAt=$_POST['expireAt']?$_POST['expireAt']:'';
    $sku=$_POST['sku']?$_POST['sku']:'';
    
    $fileUpload01 = '';
    if(!empty($_FILES["fileUpload01"]["type"])){
        $fileName = time().'_'.$_FILES['fileUpload01']['name'];
        $sourcePath = $_FILES['fileUpload01']['tmp_name'];
        $targetPath = "/var/www/html/wordpress/wp-content/themes/amtopm-child/uploaded/listing/".$fileName;
        if(move_uploaded_file($sourcePath,$targetPath)){
            $fileUpload01 = "/wp-content/themes/amtopm-child/uploaded/listing/".$fileName;
        }
    }
    
    $fileUpload02 = '';
    if(!empty($_FILES["fileUpload02"]["type"])){
        $fileName = time().'_'.$_FILES['fileUpload02']['name'];
        $sourcePath = $_FILES['fileUpload02']['tmp_name'];
        $targetPath = "/var/www/html/wordpress/wp-content/themes/amtopm-child/uploaded/listing/".$fileName;
        if(move_uploaded_file($sourcePath,$targetPath)){
            $fileUpload02 = "/wp-content/themes/amtopm-child/uploaded/listing/".$fileName;
        }
    }
    
    $fileUpload03 = '';
    if(!empty($_FILES["fileUpload03"]["type"])){
        $fileName = time().'_'.$_FILES['fileUpload03']['name'];
        $sourcePath = $_FILES['fileUpload03']['tmp_name'];
        $targetPath = "/var/www/html/wordpress/wp-content/themes/amtopm-child/uploaded/listing/".$fileName;
        if(move_uploaded_file($sourcePath,$targetPath)){
            $fileUpload03 = "/wp-content/themes/amtopm-child/uploaded/listing/".$fileName;
        }
    }
    
    $fileUpload04 = '';
    if(!empty($_FILES["fileUpload04"]["type"])){
        $fileName = time().'_'.$_FILES['fileUpload04']['name'];
        $sourcePath = $_FILES['fileUpload04']['tmp_name'];
        $targetPath = "/var/www/html/wordpress/wp-content/themes/amtopm-child/uploaded/listing/".$fileName;
        if(move_uploaded_file($sourcePath,$targetPath)){
            $fileUpload04 = "/wp-content/themes/amtopm-child/uploaded/listing/".$fileName;
        }
    }
    
    $fileUpload05 = '';
    if(!empty($_FILES["fileUpload05"]["type"])){
        $fileName = time().'_'.$_FILES['fileUpload05']['name'];
        $sourcePath = $_FILES['fileUpload05']['tmp_name'];
        $targetPath = "/var/www/html/wordpress/wp-content/themes/amtopm-child/uploaded/listing/".$fileName; 
        if(move_uploaded_file($sourcePath,$targetPath)){
            $fileUpload05 = "/wp-content/themes/amtopm-child/uploaded/listing/".$fileName;
        }
    }
    
    $fileUpload06 = '';
    if(!empty($_FILES["fileUpload06"]["type"])){
        $fileName = time().'_'.$_FILES['fileUpload06']['name'];
        $sourcePath = $_FILES['fileUpload06']['tmp_name'];
        $targetPath = "/var/www/html/wordpress/wp-content/themes/amtopm-child/uploaded/listing/".$fileName;
        if(move_uploaded_file($sourcePath,$targetPath)){
            $fileUpload06 = "/wp-content/themes/amtopm-child/uploaded/listing/".$fileName;
        }
    }
     
    $insert=mysqli_query($con," INSERT INTO `listings`(`userID`, `title`, `type`, `category`, `descriptions`, `price`, `quantity`, `stock`, `stockNumber`, `weight`, `gallery1`, `gallery2`, `gallery3`, `gallery4`, `gallery5`, `gallery6`, `end_at`, `status`, `userStatus`) 
    VALUES ('".$_COOKIE["user_id"]."','".$titleProduct."','".$typeProduct."','".$categories."','".$description."','".$price."','".$quantity."','".$stock."','".$sku."','".$weight."','".$fileUpload01."','".$fileUpload02."','".$fileUpload03."','".$fileUpload04."','".$fileUpload05."','".$fileUpload06."','".$expireAt."','pending','listed') ");
    
    if($insert){
        header("location: /my-shop/");
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
                    <?php $activeSidebar="create-listing"; include "custom-sidebar.php"; ?>
                </div>
                <!-- Start Template Page Content-->
                <div class="main-content-class">
                    <div class="inner-page-content">
                        <div class="template-page-title">
                            <h2>Create Listing</h2>
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
                                              <input type="text" id="StoreName" name="titleProduct" placeholder="The Bully Supply" required maxlength="50"/>
                                              <label class="template-label-bottom">Max 50 characters</label>
                                            </div>
                                            <div class="flex-block-item flex-block-item02">
                                                  <label class="template-label" for="TitleProduct">Type of your Product</label>
                                                  <select name="typeProduct" required>
                                                      <option selected disabled value="">Select Option</option>
                                                      <?php
                                                            $types=mysqli_query($con,"SELECT * FROM `types` where `status`='1' ");      
                                                            while($type = mysqli_fetch_array($types)){
                                                      ?>
                                                      <option value="<?php echo $type['id']; ?>"><?php echo $type['name']; ?></option>
                                                      <?php } ?>
                                                  </select>
                                                  <label class="template-label-bottom">Max 50 characters</label>
                                            </div>
                                            <div class="flex-block-item flex-block-item03">
                                                  <h5>Category</h5>
                                                  <p>Please click the arrow to expand the category and select the sub category in which your product matches. This will be helpful for the customers to reach your product easily</p>
                                                  <div class="form-checkbox">
                                                      <ul>
                                                        <?php
                                                            $categories=mysqli_query($con,"SELECT * FROM `categories` where `status`='1' ");      
                                                            while($category = mysqli_fetch_array($categories)){
                                                                $listingCount=0;
                                                                $listings=mysqli_query($con,"SELECT * FROM `listings` ");      
                                                                while($listing = mysqli_fetch_array($listings)){
                                                                    $listingArray=explode(",",$listing['category']);
                                                                    if(in_array($category['id'], $listingArray)){
                                                                        $listingCount++;
                                                                    }
                                                                }
                                                        ?>
                                                        <li><span class="form-check-box"><input type="checkbox" id="categories" name="categories[]" value="<?php echo $category['id']; ?>" class="check-box-class"/></span><label for="categories" class="inner-form-check-box-label"><?php echo $category['name']; ?>(<?php echo $listingCount; ?>)</label></li>
                                                        <?php } ?>
                                                      </ul>
                                                    </div>
                                                    <div class="Description-class">
                                                        <label class="template-label">Description</label>
                                                        <textarea name="description" required placeholder="Welcome to our premier dog emporium, where tails wag and hearts melt! Step into a world of canine delight at our dog store, where we cater to every breed, size, and personality. Our store is a haven for all things dog-related, curated with care to ensure your furry friend receives only the best."></textarea>
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
                                    
                                         <div class="flex-block flex-block02">
                                             
                                            <div class="flex-block-item flex-block-item01">
                                              <label class="template-label" for="price">Price</label>
                                               <p>Please enter only number with maximum 2 decimal places. Kindly dont use comma or dollar symbol. Eg. 4200 or 50.25.</p>
                                               <div class="width-class">
                                                    <input type="number" id="price" name="price" placeholder="price" required />
                                               </div>
                                              <label class="template-label-bottom">Must be in <strong>USD</strong></label>
                                            </div>
                                            <div class="flex-block-item flex-block-item02">   
                                                <div class="inner-form-flex-block">
                                                    <div class="inner-form-flex-block-item inner-form-flex-block-item01">
                                                        <label class="template-label" for="quantity">Quantity</label>
                                                        <input type="number" id="quantity" name="quantity" required />
                                                    </div>
                                                    
                                                    <div class="inner-form-flex-block-item inner-form-flex-block-item02">
                                                        <select name="stock" required>
                                                              <option value="" selected disabled>Select Option</option>
                                                              <option value="Instock">Instock</option>
                                                              <option value="Out of Stock">Out of Stock</option>
                                                        </select>
                                                    </div>
                                                    
                                                </div>
                                                <div class="flex-block-item flex-block-item03">
                                                  <label class="template-label" for="weight">Weight</label>
                                                  <p>Please enter only unit weight. Dont type lbs in the box.</p>
                                                  <input type="number" id="weight" name="weight" required />
                                                  <label class="template-label-bottom">Must be in <strong>LBS</strong></label>
                                                </div>
                                                <div class="flex-block-item flex-block-item03">
                                                  <label class="template-label" for="sku">SKU</label>
                                                  <input type="text" id="sku" name="sku" required />
                                                </div>
                                                <div class="flex-block-item flex-block-item03">
                                                  <label class="template-label" for="expireAt">Expire At</label>
                                                  <input type="date" id="expireAt" name="expireAt" required />
                                                </div>
                                            </div>

                                      </div>
                                </div>
                            </div>   
                            
                            <div class="create-listing-block-item create-listing-block-item03 same-width-class">
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
                                            <div class="file-upload-flex-block-item file-upload-flex-block-item01" id="uploadImagePreviewerShow">
                                                <input type="file" name="fileUpload01" class="file-upload-input uploadImagePreviewer" data-preview="uploadImagePreviewerShow" accept="image/png, image/gif, image/jpeg" />
                                                <div class="inner-file-upload-label">
                                                    <span class="upload-icon"><img src="/wp-content/uploads/2024/05/Vector-3.png" alt="Upload Image"></span>
                                                    <label class="inner-file-label">Drag or Upload Photo</label>
                                                </div>
                                            </div>
                                             <div class="file-upload-flex-block-item file-upload-flex-block-item02" id="uploadImagePreviewerShow1">
                                                <input type="file" name="fileUpload02" class="file-upload-input uploadImagePreviewer" data-preview="uploadImagePreviewerShow1" accept="image/png, image/gif, image/jpeg" />
                                                <div class="inner-file-upload-label">
                                                    <span class="upload-icon"><img src="/wp-content/uploads/2024/05/Vector-3.png" alt="Upload Image"></span>
                                                    <label class="inner-file-label">Drag or Upload Photo</label>
                                                </div>
                                            </div>
                                             <div class="file-upload-flex-block-item file-upload-flex-block-item03" id="uploadImagePreviewerShow2">
                                                <input type="file" name="fileUpload03" class="file-upload-input uploadImagePreviewer" data-preview="uploadImagePreviewerShow2" accept="image/png, image/gif, image/jpeg" />
                                                <div class="inner-file-upload-label">
                                                    <span class="upload-icon"><img src="/wp-content/uploads/2024/05/Vector-3.png" alt="Upload Image"></span>
                                                    <label class="inner-file-label">Drag or Upload Photo</label>
                                                </div>
                                            </div>
                                            
                                            <div class="file-upload-flex-block-item file-upload-flex-block-item04" id="uploadImagePreviewerShow3">
                                                <input type="file" name="fileUpload04" class="file-upload-input uploadImagePreviewer" data-preview="uploadImagePreviewerShow3" accept="image/png, image/gif, image/jpeg" />
                                                <div class="inner-file-upload-label">
                                                    <span class="upload-icon"><img src="/wp-content/uploads/2024/05/Vector-3.png" alt="Upload Image"></span>
                                                    <label class="inner-file-label">Drag or Upload Photo</label>
                                                </div>
                                            </div>
                                             <div class="file-upload-flex-block-item file-upload-flex-block-item05" id="uploadImagePreviewerShow4">
                                                <input type="file" name="fileUpload05" class="file-upload-input uploadImagePreviewer" data-preview="uploadImagePreviewerShow4" accept="image/png, image/gif, image/jpeg" />
                                                <div class="inner-file-upload-label">
                                                    <span class="upload-icon"><img src="/wp-content/uploads/2024/05/Vector-3.png" alt="Upload Image"></span>
                                                    <label class="inner-file-label">Drag or Upload Photo</label>
                                                </div>
                                            </div>
                                             <div class="file-upload-flex-block-item file-upload-flex-block-item06" id="uploadImagePreviewerShow5">
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
<?php
get_footer();
?>
