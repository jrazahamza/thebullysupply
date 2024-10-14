<?php
global $wpdb;

if(isset($_POST['submit'])){
    $type='';
    $startDate='';
    $endDate='';
    $name=$_POST['name']?$_POST['name']:'';
    $title=$_POST['title']?$_POST['title']:'';
    $button=$_POST['button']?$_POST['button']:'';
    $link=$_POST['link']?$_POST['link']:'';
    $status=$_POST['status']?$_POST['status']:'0';
    $position=$_POST['position']?$_POST['position']:'';
    
    $bannerImage = '';   
    if(!empty($_FILES["image"]["type"])){
        $fileName = time().'_'.$_FILES['image']['name'];
        $sourcePath = $_FILES['image']['tmp_name'];
        $targetPath = "/home/cloudstandly/public_html/bully.cloudstandly.com/wp-content/themes/amtopm-child/uploaded/banner/".$fileName;
        if(move_uploaded_file($sourcePath,$targetPath)){
            $bannerImage = "/wp-content/themes/amtopm-child/uploaded/banner/".$fileName;
        }
    }
    
    $query = " INSERT INTO `bannerPromotion`(`userID`, `type`, `startDate`, `endDate`, `banner`, `name`, `title`, `button`, `link`, `position`, `status`)
    VALUES ('1','".$type."','".$startDate."','".$endDate."','".$bannerImage."','".$name."','".$title."','".$button."','".$link."','".$position."','".$status."') ";
    $wpdb->query($query);
    
}
  
if(isset($_POST['update'])){
    $id=$_POST['id'];
    $type='';
    $startDate='';
    $endDate='';
    $name=$_POST['name']?$_POST['name']:'';
    $title=$_POST['title']?$_POST['title']:'';
    $button=$_POST['button']?$_POST['button']:'';
    $link=$_POST['link']?$_POST['link']:'';
    $status=$_POST['status']?$_POST['status']:'0';
    $position=$_POST['position']?$_POST['position']:'';
       
    $query = " UPDATE `bannerPromotion` SET `type`='".$type."',`startDate`='".$startDate."',`endDate`='".$endDate."',`name`='".$name."',`title`='".$title."',`button`='".$button."',
    `link`='".$link."',`position`='".$position."',`status`='".$status."' WHERE `id`='".$id."' ";
    $wpdb->query($query);
    
    $bannerImage = '';   
    if(!empty($_FILES["image"]["type"])){
        $fileName = time().'_'.$_FILES['image']['name'];
        $sourcePath = $_FILES['image']['tmp_name'];
        $targetPath = "/home/cloudstandly/public_html/bully.cloudstandly.com/wp-content/themes/amtopm-child/uploaded/banner/".$fileName;
        if(move_uploaded_file($sourcePath,$targetPath)){
            $bannerImage = "/wp-content/themes/amtopm-child/uploaded/banner/".$fileName;
        }
    }
    
    if($bannerImage!=''){
        $query = " UPDATE `bannerPromotion` SET `banner`='".$bannerImage."' WHERE `id`='".$id."' ";
        $wpdb->query($query);
    }
    
}
if(isset($_GET['banner-delete'])){
    $query = "DELETE FROM `bannerPromotion` WHERE id=".$_GET['banner-delete'];
    $wpdb->query($query);
    header("Location: /wp-admin/admin.php?page=bully-banner-promotions");
}
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="/wp-content/themes/amtopm-child/dashboard/dashboardStyles.css" rel="stylesheet">
<script src="//cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js"></script>
<div class="mainheading">
    <h2>Banner Promotions</h2>
</div> 
<div class="maincontent zones">
    <div class="actionButtons">
        <button type="button" data-bs-toggle="modal" data-bs-target="#vendorsDetailed">Add Banner</button>
    </div>
    <table id="dataTableID" class="table table-striped table-bordered vendors" cellspacing="0" width="100%">
    	<thead>
    	    <tr>
    			<th>#</th>
    			<th scope="col">Banner</th>
                <th scope="col">Name</th>
                <th scope="col">Title</th>
                <th scope="col">Button Text</th>
                <th scope="col">Button Link</th>
                <th scope="col">Position</th>
                <th scope="col">Status</th>
    			<th>Action</th>
    		</tr>
    	</thead>
    	<tbody>
    	    <?php
    	        $i=1;
                $bannerPromotions= $wpdb->get_results("SELECT * FROM `bannerPromotion` "); 
                foreach($bannerPromotions as $bannerPromotion){
                    $productPromotion=$wpdb->get_row($wpdb->prepare("SELECT * FROM `productPromotion` where `id`='".$bannerPromotion->type."' "));
            ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td style="vertical-align:middle;">
                    <?php if($bannerPromotion->banner!=''){ ?>
                    <img src="<?php echo $bannerPromotion->banner; ?>" style="width:150px;" alt="Banner">
                    <?php } ?>
                </td>
                <td style="vertical-align:middle;"><?php echo $bannerPromotion->name; ?></td>
                <td style="vertical-align:middle;"><?php echo $bannerPromotion->title; ?></td>
                <td style="vertical-align:middle;"><?php echo $bannerPromotion->button; ?></td>
                <td style="vertical-align:middle;"><?php echo $bannerPromotion->link; ?></td>
                <td style="vertical-align:middle;"><?php echo $bannerPromotion->position; ?></td>
                <td style="vertical-align:middle;">
                    <?php if($bannerPromotion->status==1){ ?>
                    Active
                    <?php }else{ ?>
                    Inactive
                    <?php } ?>
                </td>
                <td>
    			    <a data-bs-toggle="modal" data-bs-target="#vendorsDetailed<?php echo $bannerPromotion->id; ?>"  class="detail"><i class="fa fa-pen"></i> Edit</a>
    			    <a href="/wp-admin/admin.php?page=bully-banner-promotions&banner-delete=<?php echo $bannerPromotion->id; ?>" class="delete"><i class="fa fa-trash"></i> Delete</a>
    			</td>
            </tr>
            <?php $i++; } ?>
    	</tbody>
    </table>
</div>

<div class="modal fade" id="vendorsDetailed" tabindex="-1" aria-labelledby="vendorsDetailedLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <form method="post" enctype="multipart/form-data">
          <div class="modal-header">
            <h5 class="modal-title" id="vendorsDetailedLabel">Add Banner</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p class="two">
                <label>Name</label>
                <input type="text" name="name" value="" />
            </p>
            <p class="two">
                <label>Title</label>
                <input type="text" name="title" value="" />
            </p>
            <p class="two">
                <label>Button</label>
                <input type="text" name="button" value="" />
            </p>
            <p class="two">
                <label>Link</label>
                <input type="text" name="link" value="" />
            </p>
            <p class="two">
                <label>Position</label>
                <select name="position">
                    <option value="Home Top">Home Top</option>
                    <option value="Home Bottom">Home Bottom</option>
                    <option value="Category Page">Category Page</option>
                </select>
            </p>
            <p class="two">
                <label>Status</label>
                <select name="status">
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </p>
            <div class="avatar-upload">
                <label>Banner</label>
                <div class="avatar-edit">
                    <input type='file' id="imageUpload0" class="imageUpload" data-id="0" name="image" accept=".png, .jpg, .jpeg" />
                    <label for="imageUpload0"></label>
                </div>
                <div class="avatar-preview">
                        <div id="imagePreview0" class="imagePreview" style="background-image: url(/wp-content/uploads/2024/05/images.png);"></div>
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
    $bannerPromotions= $wpdb->get_results("SELECT * FROM `bannerPromotion` "); 
    foreach($bannerPromotions as $bannerPromotion){
        $productPromotion=$wpdb->get_row($wpdb->prepare("SELECT * FROM `productPromotion` where `id`='".$bannerPromotion->type."' "));
?>
<div class="modal fade" id="vendorsDetailed<?php echo $bannerPromotion->id; ?>" tabindex="-1" aria-labelledby="vendorsDetailedLabel<?php echo $bannerPromotion->id; ?>" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <form method="post" enctype="multipart/form-data">
          <input type="hidden" name="id" value="<?php echo $bannerPromotion->id; ?>" />    
          <div class="modal-header">
            <h5 class="modal-title" id="vendorsDetailedLabel<?php echo $bannerPromotion->id; ?>">Update Banner</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p class="two">
                <label>Name</label>
                <input type="text" name="name" value="<?php echo $bannerPromotion->name; ?>" />
            </p>
            <p class="two">
                <label>Title</label>
                <input type="text" name="title" value="<?php echo $bannerPromotion->title; ?>" />
            </p>
            <p class="two">
                <label>Button</label>
                <input type="text" name="button" value="<?php echo $bannerPromotion->button; ?>" />
            </p>
            <p class="two">
                <label>Link</label>
                <input type="text" name="link" value="<?php echo $bannerPromotion->link; ?>" />
            </p>
            <p class="two">
                <label>Position</label>
                <select name="position">
                    <option <?php if($bannerPromotion->position=='Home Top'){ echo "selected"; } ?> value="Home Top">Home Top</option>
                    <option <?php if($bannerPromotion->position=='Home Bottom'){ echo "selected"; } ?> value="Home Bottom">Home Bottom</option>
                    <option <?php if($bannerPromotion->position=='Category Page'){ echo "selected"; } ?> value="Category Page">Category Page</option>
                </select>
            </p>
            <p class="two">
                <label>Status</label>
                <select name="status">
                    <option <?php if($bannerPromotion->status=='1'){ echo "selected"; } ?> value="1">Active</option>
                    <option <?php if($bannerPromotion->status=='0'){ echo "selected"; } ?> value="0">Inactive</option>
                </select>
            </p>
            <div class="avatar-upload">
                <label>Profile</label>
                <div class="avatar-edit">
                    <input type='file' id="imageUpload<?php echo $bannerPromotion->id; ?>" class="imageUpload" data-id="<?php echo $bannerPromotion->id; ?>" name="image" accept=".png, .jpg, .jpeg" />
                    <label for="imageUpload<?php echo $bannerPromotion->id; ?>"></label>
                </div>
                <div class="avatar-preview">
                    <?php if($bannerPromotion->banner!=''){ ?>
                        <div id="imagePreview<?php echo $bannerPromotion->id; ?>" class="imagePreview" style="background-image: url('<?php echo $bannerPromotion->banner; ?>');"></div>
                    <?php }else{ ?>
                        <div id="imagePreview<?php echo $bannerPromotion->id; ?>" class="imagePreview" style="background-image: url(/wp-content/uploads/2024/05/images.png);"></div>
                    <?php } ?>
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" name="update" class="btn btn-primary">Save</button>
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
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            jQuery('#imagePreview'+id).css('background-image', 'url('+e.target.result +')');
            jQuery('#imagePreview'+id).hide();
            jQuery('#imagePreview'+id).fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
jQuery("input.imageUpload").change(function() {
    var id=jQuery(this).attr('data-id');
    if(jQuery(this).val()!=''){
        readURL(this,id);   
    }else{
        jQuery('#imagePreview'+id).css('background-image', 'url(/wp-content/uploads/2024/05/images.png)');
    }
});    
</script>