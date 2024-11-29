<?php
global $wpdb;
  
if(isset($_POST['submit'])){
    $id=$_POST['id'];
    $titleProduct=$_POST['titleProduct']?$_POST['titleProduct']:'';
    $typeProduct=$_POST['typeProduct']?$_POST['typeProduct']:'';
//     $categories=$_POST['categories']?implode(",",$_POST['categories']):'';
    $description=$_POST['description']?$_POST['description']:'';
    $price=$_POST['price']?$_POST['price']:'';
    $status=$_POST['status']?$_POST['status']:'pending';
    
    $fileUpload01 = '';
    if(!empty($_FILES["fileUpload01"]["type"])){
        $fileName = time().'_'.$_FILES['fileUpload01']['name'];
        $sourcePath = $_FILES['fileUpload01']['tmp_name'];
        $targetPath = "/var/www/html/wordpress/wp-content/themes/amtopm-child/uploaded/listing/".$fileName;
        if(move_uploaded_file($sourcePath,$targetPath)){
            $fileUpload01 = "/wp-content/themes/amtopm-child/uploaded/listing/".$fileName;
            $query = " UPDATE `listings` SET `gallery1`='".$fileUpload01."' WHERE `id`='".$id."' ";
            $wpdb->query($query);
        }
    }
    
    $fileUpload02 = '';
    if(!empty($_FILES["fileUpload02"]["type"])){
        $fileName = time().'_'.$_FILES['fileUpload02']['name'];
        $sourcePath = $_FILES['fileUpload02']['tmp_name'];
        $targetPath = "/var/www/html/wordpress/wp-content/themes/amtopm-child/uploaded/listing/".$fileName;
        if(move_uploaded_file($sourcePath,$targetPath)){
            $fileUpload02 = "/wp-content/themes/amtopm-child/uploaded/listing/".$fileName;
            $query = " UPDATE `listings` SET `gallery2`='".$fileUpload02."' WHERE `id`='".$id."' ";
            $wpdb->query($query);
        }
    }
    
    $fileUpload03 = '';
    if(!empty($_FILES["fileUpload03"]["type"])){
        $fileName = time().'_'.$_FILES['fileUpload03']['name'];
        $sourcePath = $_FILES['fileUpload03']['tmp_name'];
        $targetPath = "/var/www/html/wordpress/wp-content/themes/amtopm-child/uploaded/listing/".$fileName;
        if(move_uploaded_file($sourcePath,$targetPath)){
            $fileUpload03 = "/wp-content/themes/amtopm-child/uploaded/listing/".$fileName;
            $query = " UPDATE `listings` SET `gallery3`='".$fileUpload03."' WHERE `id`='".$id."' ";
            $wpdb->query($query);
        }
    }
    
    $fileUpload04 = '';
    if(!empty($_FILES["fileUpload04"]["type"])){
        $fileName = time().'_'.$_FILES['fileUpload04']['name'];
        $sourcePath = $_FILES['fileUpload04']['tmp_name'];
        $targetPath = "/var/www/html/wordpress/wp-content/themes/amtopm-child/uploaded/listing/".$fileName;
        if(move_uploaded_file($sourcePath,$targetPath)){
            $fileUpload04 = "/wp-content/themes/amtopm-child/uploaded/listing/".$fileName;
            $query = " UPDATE `listings` SET `gallery4`='".$fileUpload04."' WHERE `id`='".$id."' ";
            $wpdb->query($query);
        }
    }
    
    $fileUpload05 = '';
    if(!empty($_FILES["fileUpload05"]["type"])){
        $fileName = time().'_'.$_FILES['fileUpload05']['name'];
        $sourcePath = $_FILES['fileUpload05']['tmp_name'];
        $targetPath = "/var/www/html/wordpress/wp-content/themes/amtopm-child/uploaded/listing/".$fileName;
        if(move_uploaded_file($sourcePath,$targetPath)){
            $fileUpload05 = "/wp-content/themes/amtopm-child/uploaded/listing/".$fileName;
            $query = " UPDATE `listings` SET `gallery5`='".$fileUpload05."' WHERE `id`='".$id."' ";
            $wpdb->query($query);
        }
    }
    
    $fileUpload06 = '';
    if(!empty($_FILES["fileUpload06"]["type"])){
        $fileName = time().'_'.$_FILES['fileUpload06']['name'];
        $sourcePath = $_FILES['fileUpload06']['tmp_name'];
        $targetPath = "/var/www/html/wordpress/wp-content/themes/amtopm-child/uploaded/listing/".$fileName;
        if(move_uploaded_file($sourcePath,$targetPath)){
            $fileUpload06 = "/wp-content/themes/amtopm-child/uploaded/listing/".$fileName;
            $query = " UPDATE `listings` SET `gallery6`='".$fileUpload06."' WHERE `id`='".$id."' ";
            $wpdb->query($query);
        }
    }
     
    $query = " UPDATE `listings` SET `title`='".$titleProduct."',`descriptions`='".$description."',`price`='".$price."',
     `status`='".$status."' WHERE `id`='".$id."' ";
    $wpdb->query($query);
}
if(isset($_GET['list-delete'])){
    $query = "DELETE FROM `listings` WHERE id=".$_GET['list-delete'];
    $wpdb->query($query);
    header("Location: /wp-admin/admin.php?page=bully-listings");
}
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="/wp-content/themes/amtopm-child/dashboard/dashboardStyles.css" rel="stylesheet">
<script src="//cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js"></script>
<div class="mainheading">
    <h2>Listings</h2>
</div> 
<div class="maincontent zones">
    <table id="dataTableID" class="table table-striped table-bordered vendors" cellspacing="0" width="100%">
    	<thead>
    	    <tr>
    			<th>#</th>
                <th>Title</th>
                <th>Price</th>
                <th>Status</th>
    			<th>Action</th>
    		</tr>
    	</thead>
    	<tbody>
    	    <?php
    	            $i=1;
    	            $listings = $wpdb->get_results("SELECT * FROM `listings` order by id desc ");
    	            foreach($listings as $listing){
    	                $type=$wpdb->get_row($wpdb->prepare("SELECT * FROM `types` WHERE id=".$listing->type." "));
            ?>
    		<tr>
                <td>    
                    <span>
                        <?php echo $i; ?>
                    </span>
                </td>
                <td class="products-name">
                    <div class="user listings">
        			    <?php if($listing->gallery1!=''){ ?>
                            <img class="productDescriptionMainSingle" src="<?php echo $listing->gallery1; ?>" alt="<?php echo $listing->title; ?>">
                        <?php }elseif($listing->gallery2!=''){ ?>
                            <img class="productDescriptionMainSingle" src="<?php echo $listing->gallery2; ?>" alt="<?php echo $listing->title; ?>">
                        <?php }elseif($listing->gallery3!=''){ ?>
                            <img class="productDescriptionMainSingle" src="<?php echo $listing->gallery3; ?>" alt="<?php echo $listing->title; ?>">
                        <?php } ?>
    			        <label><?php echo $listing->title; ?></label>
    			    </div>
                </td>
                <td><?php if(isset($type->id)){ echo $type->name; } ?></td>
                <td>$<?php echo $listing->price; ?></td>
                <td><?php echo ucfirst($listing->status); ?></td>
    			<td>
    			    <a data-bs-toggle="modal" data-bs-target="#vendorsDetailed<?php echo $listing->id; ?>"  class="detail"><i class="fa fa-eye"></i> Detail</a>
    			    <a href="/wp-admin/admin.php?page=bully-listings&list-delete=<?php echo $listing->id; ?>" class="delete"><i class="fa fa-trash"></i> Delete</a>
    			</td>
            </tr>
            <?php $i++; } ?>
    	</tbody>
    </table>
</div>

<?php
    $listings = $wpdb->get_results("SELECT * FROM `listings` order by id desc ");
    foreach($listings as $listing){
?>
<div class="modal fade listingPopup" id="vendorsDetailed<?php echo $listing->id; ?>" tabindex="-1" aria-labelledby="vendorsDetailedLabel<?php echo $listing->id; ?>" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <form id="create-listing-form" class="formValidationQuery" method="POST" enctype="multipart/form-data">
          <input type="hidden" name="id" value="<?php echo $listing->id; ?>" />    
          <div class="modal-header">
            <h5 class="modal-title" id="vendorsDetailedLabel<?php echo $listing->id; ?>">Listing Detail</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
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
                              <input type="text" id="StoreName" name="titleProduct" value="<?php echo $listing->title; ?>" placeholder="The Bully Supply" required maxlength="50"/>
                              <label class="template-label-bottom">Max 50 characters</label>
                            </div>
<!--                             <div class="flex-block-item flex-block-item02">
                                  <label class="template-label" for="TitleProduct">Type of your Product</label>
                                  <select name="typeProduct" required>
                                      <option value="">Select Option</option>
                                      <?php
                                            $listTypes = $wpdb->get_results("SELECT * FROM `types` where `status`='1' ");
                                            foreach($listTypes as $listType){
                                      ?>
                                      <option <?php if($listType->id==$listing->type){ echo "selected"; } ?> value="<?php echo $listType->id; ?>"><?php echo $listType->name; ?></option>
                                      <?php } ?>
                                  </select>
                                  <label class="template-label-bottom">Max 50 characters</label>
                            </div> -->
                            <div class="flex-block-item flex-block-item03">
                                  <h5>Category</h5>
                                  <p>Please click the arrow to expand the category and select the sub category in which your product matches. This will be helpful for the customers to reach your product easily</p>
<!--                                   <div class="form-checkbox">
                                      <ul>
                                        <?php
                                            $categories = $wpdb->get_results("SELECT * FROM `categories` where `status`='1' ");
                                            foreach($categories as $category){    
                                                
                                                $listingCount=0;
                                                
                                                $insideListings = $wpdb->get_results("SELECT * FROM `listings` ");
                                                foreach($insideListings as $insideListing){  
                                                    $listingArray=explode(",",$insideListing->category);
                                                    if(in_array($category->id, $listingArray)){
                                                        $listingCount++;
                                                    }
                                                }
                                        ?>
                                        <li><span class="form-check-box"><input type="checkbox" id="categories" <?php if(in_array($category->id, explode(",",$listing->category))){ echo "checked"; } ?> name="categories[]" value="<?php echo $category->id; ?>" class="check-box-class"/></span><label for="categories" class="inner-form-check-box-label"><?php echo $category->name; ?>(<?php echo $listingCount; ?>)</label></li>
                                        <?php } ?>
                                      </ul>
                                    </div> -->
                                    <div class="Description-class">
                                        <label class="template-label">Description</label>
                                        <textarea name="description" required placeholder="Welcome to our premier dog emporium, where tails wag and hearts melt! Step into a world of canine delight at our dog store, where we cater to every breed, size, and personality. Our store is a haven for all things dog-related, curated with care to ensure your furry friend receives only the best."><?php echo $listing->descriptions; ?></textarea>
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
                                            <input type="number" id="price" name="price" placeholder="price" value="<?php echo $listing->price; ?>" required />
                                       </div>
                                      <label class="template-label-bottom">Must be in <strong>USD</strong></label>
                                    </div>
                                    <div class="flex-block-item flex-block-item02">   
                                        <div class="flex-block-item flex-block-item03">
                                          <label class="template-label" for="status">Status</label>
                                          <select name="status" required>
                                              <option value="" selected disabled>Select Status</option>
                                              <option <?php if($listing->status=='pending'){ echo "selected"; } ?> value="pending">Pending</option>
                                              <option <?php if($listing->status=='active'){ echo "selected"; } ?> value="active">Active</option>
                                              <option <?php if($listing->status=='in active'){ echo "selected"; } ?> value="in active">In Active</option>
                                              <option <?php if($listing->status=='in complete'){ echo "selected"; } ?> value="in complete">In Complete</option>
                                              <option <?php if($listing->status=='sold out'){ echo "selected"; } ?> value="sold out">Sold Out</option>
                                          </select>
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
                                    <div class="file-upload-flex-block-item file-upload-flex-block-item01  <?php if($listing->gallery1!=''){ echo "show"; } ?>" id="uploadImagePreviewerShow" <?php if($listing->gallery1!=''){ ?> style="background-image:url('<?php echo $listing->gallery1; ?>');" <?php } ?>>
                                        <input type="file" name="fileUpload01" class="file-upload-input uploadImagePreviewer" data-preview="uploadImagePreviewerShow" accept="image/png, image/gif, image/jpeg" />
                                        <div class="inner-file-upload-label">
                                            <span class="upload-icon"><img src="/wp-content/uploads/2024/05/Vector-3.png" alt="Upload Image"></span>
                                            <label class="inner-file-label">Drag or Upload Photo</label>
                                        </div>
                                    </div>
                                     <div class="file-upload-flex-block-item file-upload-flex-block-item02  <?php if($listing->gallery2!=''){ echo "show"; } ?>" id="uploadImagePreviewerShow1" <?php if($listing->gallery2!=''){ ?> style="background-image:url('<?php echo $listing->gallery2; ?>');" <?php } ?>>
                                        <input type="file" name="fileUpload02" class="file-upload-input uploadImagePreviewer" data-preview="uploadImagePreviewerShow1" accept="image/png, image/gif, image/jpeg" />
                                        <div class="inner-file-upload-label">
                                            <span class="upload-icon"><img src="/wp-content/uploads/2024/05/Vector-3.png" alt="Upload Image"></span>
                                            <label class="inner-file-label">Drag or Upload Photo</label>
                                        </div>
                                    </div>
                                     <div class="file-upload-flex-block-item file-upload-flex-block-item03  <?php if($listing->gallery3!=''){ echo "show"; } ?>" id="uploadImagePreviewerShow2" <?php if($listing->gallery3!=''){ ?> style="background-image:url('<?php echo $listing->gallery3; ?>');" <?php } ?>>
                                        <input type="file" name="fileUpload03" class="file-upload-input uploadImagePreviewer" data-preview="uploadImagePreviewerShow2" accept="image/png, image/gif, image/jpeg" />
                                        <div class="inner-file-upload-label">
                                            <span class="upload-icon"><img src="/wp-content/uploads/2024/05/Vector-3.png" alt="Upload Image"></span>
                                            <label class="inner-file-label">Drag or Upload Photo</label>
                                        </div>
                                    </div>
                                    
                                    <div class="file-upload-flex-block-item file-upload-flex-block-item04  <?php if($listing->gallery4!=''){ echo "show"; } ?>" id="uploadImagePreviewerShow3" <?php if($listing->gallery4!=''){ ?> style="background-image:url('<?php echo $listing->gallery4; ?>');" <?php } ?>>
                                        <input type="file" name="fileUpload04" class="file-upload-input uploadImagePreviewer" data-preview="uploadImagePreviewerShow3" accept="image/png, image/gif, image/jpeg" />
                                        <div class="inner-file-upload-label">
                                            <span class="upload-icon"><img src="/wp-content/uploads/2024/05/Vector-3.png" alt="Upload Image"></span>
                                            <label class="inner-file-label">Drag or Upload Photo</label>
                                        </div>
                                    </div>
                                     <div class="file-upload-flex-block-item file-upload-flex-block-item05  <?php if($listing->gallery5!=''){ echo "show"; } ?>" id="uploadImagePreviewerShow4" <?php if($listing->gallery5!=''){ ?> style="background-image:url('<?php echo $listing->gallery5; ?>');" <?php } ?>>
                                        <input type="file" name="fileUpload05" class="file-upload-input uploadImagePreviewer" data-preview="uploadImagePreviewerShow4" accept="image/png, image/gif, image/jpeg" />
                                        <div class="inner-file-upload-label">
                                            <span class="upload-icon"><img src="/wp-content/uploads/2024/05/Vector-3.png" alt="Upload Image"></span>
                                            <label class="inner-file-label">Drag or Upload Photo</label>
                                        </div>
                                    </div>
                                     <div class="file-upload-flex-block-item file-upload-flex-block-item06  <?php if($listing->gallery6!=''){ echo "show"; } ?>" id="uploadImagePreviewerShow5" <?php if($listing->gallery6!=''){ ?> style="background-image:url('<?php echo $listing->gallery6; ?>');" <?php } ?>>
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
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" name="submit" class="btn btn-primary">Save</button>
          </div>
        </form>
    </div>
  </div>
</div>
<?php
    }
?>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
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
