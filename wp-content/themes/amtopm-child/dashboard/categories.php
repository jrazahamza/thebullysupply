<?php
global $wpdb;

if(isset($_POST['submit'])){
    $name=$_POST['name']?$_POST['name']:'';
    $status=$_POST['status']?$_POST['status']:'';
    $home=$_POST['home']?$_POST['home']:'No';
       
    $category='';
    if(!empty($_FILES["image"]["type"])){
        $fileName = time().'_'.$_FILES['image']['name'];
        $sourcePath = $_FILES['image']['tmp_name'];
        $targetPath = "/home/hailogic/thebullysupply.com/wp-content/themes/amtopm-child/uploaded/category/".$fileName;
        if(move_uploaded_file($sourcePath,$targetPath)){
            $category = "/wp-content/themes/amtopm-child/uploaded/category/".$fileName;
        }
    }
    $query = " INSERT INTO `categories`(`image`, `name`, `home`, `status`) VALUES ('".$category."','".$name."','".$home."','".$status."') ";
    $wpdb->query($query);
    
}
  
if(isset($_POST['update'])){
    $id=$_POST['id'];
    $name=$_POST['name']?$_POST['name']:'';
    $status=$_POST['status']?$_POST['status']:'';
    $home=$_POST['home']?$_POST['home']:'No';
       
    $query = " UPDATE `categories` SET `name`='".$name."',`home`='".$home."',`status`='".$status."' WHERE `id`='".$id."' ";
    $wpdb->query($query);
    
    $category='';
    if(!empty($_FILES["image"]["type"])){
        $fileName = time().'_'.$_FILES['image']['name'];
        $sourcePath = $_FILES['image']['tmp_name'];
        $targetPath = "/home/hailogic/thebullysupply.com/wp-content/themes/amtopm-child/uploaded/category/".$fileName;
        if(move_uploaded_file($sourcePath,$targetPath)){
            $category = "/wp-content/themes/amtopm-child/uploaded/category/".$fileName;
        }
    }
    if($category!=''){
        $query = " UPDATE `categories` SET `image`='".$category."' WHERE `id`='".$id."' ";
        $wpdb->query($query);
    }
    
}
if(isset($_GET['category-delete'])){
    $query = "DELETE FROM `categories` WHERE id=".$_GET['category-delete'];
    $wpdb->query($query);
    header("Location: /wp-admin/admin.php?page=bully-categories");
}
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="/wp-content/themes/amtopm-child/dashboard/dashboardStyles.css" rel="stylesheet">
<script src="//cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js"></script>
<div class="mainheading">
    <h2>Categories</h2>
</div> 
<div class="maincontent zones">
    <div class="actionButtons">
        <button type="button" data-bs-toggle="modal" data-bs-target="#vendorsDetailed">Add Category</button>
    </div>
    <table id="dataTableID" class="table table-striped table-bordered vendors" cellspacing="0" width="100%">
    	<thead>
    	    <tr>
    			<th>#</th>
    			<th>Category</th>
    			<th>Home Page</th>
    			<th>Status</th>
    			<th>Action</th>
    		</tr>
    	</thead>
    	<tbody>
    	    <?php
    	            $i=1;
    	            $categories = $wpdb->get_results("SELECT * FROM `categories` order by id desc ");
    	            foreach($categories as $category){
    	    ?>
        		<tr>
        			<td><?php echo $i; ?></td> 
        			<td>
        			    <div class="user listings rehblti">
        			        <?php if($category->image!=''){ ?>
                                <img style="object-fit: contain;" src="<?php echo $category->image; ?>" alt="Category Image">
                            <?php }else{ ?>
                                <img style="object-fit: contain;" src="/wp-content/uploads/2024/05/images.png" alt="Category Image">
                            <?php } ?>
        			        <label><?php echo $category->name; ?></label>
        			    </div>
        			</td>
        			<td><?php if($category->home=='Yes'){ echo $category->home; }else{ echo "No"; } ?></td>
        			<td><?php if($category->status==1){ echo "Active"; }else{ echo "Inactive"; } ?></td>
        			<td>
        			    <a data-bs-toggle="modal" data-bs-target="#vendorsDetailed<?php echo $category->id; ?>"  class="detail"><i class="fa fa-pen"></i> Edit</a>
        			    <a href="/wp-admin/admin.php?page=bully-categories&category-delete=<?php echo $category->id; ?>" class="delete"><i class="fa fa-trash"></i> Delete</a>
        			</td>
        		</tr>
    		<?php
    		        $i++;
    	        }
    		?>
    	</tbody>
    </table>
</div>

<div class="modal fade" id="vendorsDetailed" tabindex="-1" aria-labelledby="vendorsDetailedLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <form method="post" enctype="multipart/form-data">
          <div class="modal-header">
            <h5 class="modal-title" id="vendorsDetailedLabel">Add Category</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p>
                <label>Name</label>
                <input type="text" name="name" value="" />
            </p>
            <p>
                <label>Is Visible on Home Page</label>
                <select name="home">
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
            </p>
            <p>
                <label>Status</label>
                <select name="status">
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </p>
            <div class="avatar-upload">
                <label>Profile</label>
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
        $categories = $wpdb->get_results("SELECT * FROM `categories` order by id desc ");
    	 foreach($categories as $category){
?>
<div class="modal fade" id="vendorsDetailed<?php echo $category->id; ?>" tabindex="-1" aria-labelledby="vendorsDetailedLabel<?php echo $category->id; ?>" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <form method="post" enctype="multipart/form-data">
          <input type="hidden" name="id" value="<?php echo $category->id; ?>" />    
          <div class="modal-header">
            <h5 class="modal-title" id="vendorsDetailedLabel<?php echo $account->id; ?>">Update Category</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p>
                <label>Name</label>
                <input type="text" name="name" value="<?php echo $category->name; ?>" />
            </p>
            <p>
                <label>Is Visible on Home Page</label>
                <select name="home">
                    <option <?php if($category->home=='Yes'){ echo "selected"; } ?> value="Yes">Yes</option>
                    <option <?php if($category->home=='No' || $category->home==''){ echo "selected"; } ?> value="No">No</option>
                </select>
            </p>
            <p>
                <label>Status</label>
                <select name="status">
                    <option <?php if($category->status=='1'){ echo "selected"; } ?> value="1">Active</option>
                    <option <?php if($category->status=='0' || $category->status==''){ echo "selected"; } ?> value="0">Inactive</option>
                </select>
            </p>
            <div class="avatar-upload">
                <label>Profile</label>
                <div class="avatar-edit">
                    <input type='file' id="imageUpload<?php echo $category->id; ?>" class="imageUpload" data-id="<?php echo $category->id; ?>" name="image" accept=".png, .jpg, .jpeg" />
                    <label for="imageUpload<?php echo $category->id; ?>"></label>
                </div>
                <div class="avatar-preview">
                    <?php if($category->image!=''){ ?>
                        <div id="imagePreview<?php echo $category->id; ?>" class="imagePreview" style="background-image: url('<?php echo $category->image; ?>');"></div>
                    <?php }else{ ?>
                        <div id="imagePreview<?php echo $category->id; ?>" class="imagePreview" style="background-image: url(/wp-content/uploads/2024/05/images.png);"></div>
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