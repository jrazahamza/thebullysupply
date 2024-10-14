<?php
global $wpdb;
  
if(isset($_POST['submit'])){
    $id=$_POST['id'];
    $name=$_POST['name']?$_POST['name']:'';
    $email=$_POST['email']?$_POST['email']:'';
    $phone=$_POST['phone']?$_POST['phone']:'';
    $company=$_POST['company']?$_POST['company']:'';
    $street=$_POST['street']?$_POST['street']:'';
    $city=$_POST['city']?$_POST['city']:'';
    $state=$_POST['state']?$_POST['state']:'';
    $status=$_POST['status']?$_POST['status']:'0';
    $description=$_POST['description']?$_POST['description']:'';
            
    $query = " UPDATE `shop` SET `name`='".$name."',`email`='".$email."',`phone`='".$phone."',`company`='".$company."',`description`='".$description."',`street`='".$street."',`city`='".$city."',`state`='".$state."',`status`='".$status."' WHERE `id`='".$id."' ";
    $wpdb->query($query);
    
    $profile='';
    if(!empty($_FILES["profile"]["type"])){
        $fileName = time().'_'.$_FILES['profile']['name'];
        $sourcePath = $_FILES['profile']['tmp_name'];
        $targetPath = "/home/cloudstandly/public_html/bully.cloudstandly.com/wp-content/themes/amtopm-child/uploaded/store/".$fileName;
        if(move_uploaded_file($sourcePath,$targetPath)){
            $profile = "/wp-content/themes/amtopm-child/uploaded/store/".$fileName;
        }
    }
    if($profile!=''){
        $query = " UPDATE `shop` SET `profile`='".$profile."' WHERE `id`='".$id."' ";
        $wpdb->query($query);
    }
    
}
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="/wp-content/themes/amtopm-child/dashboard/dashboardStyles.css" rel="stylesheet">
<script src="//cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js"></script>
<div class="mainheading">
    <h2>Shops</h2>
</div> 
<div class="maincontent zones">
    <table id="dataTableID" class="table table-striped table-bordered vendors" cellspacing="0" width="100%">
    	<thead>
    	    <tr>
    			<th>#</th>
    			<th>Shop Name</th>
    			<th>Vendor</th>
    			<th>Email</th>
    			<th>Phone</th>
    			<th>Company</th>
    			<th>Address</th>
    			<th>Status</th>
    			<th>Action</th>
    		</tr>
    	</thead>
    	<tbody>
    	    <?php
    	            $i=1;
    	            $shops = $wpdb->get_results("SELECT * FROM `shop` order by id desc ");
    	            foreach($shops as $shop){
    	                $account=$wpdb->get_row($wpdb->prepare("SELECT * FROM `account` WHERE id=".$shop->userID));
            ?>
        		<tr>
        			<td><?php echo $i; ?></td>
        			<td>
        			    <div class="user listings">
        			        <?php if($shop->profile!=''){ ?>
                                <img src="<?php echo $shop->profile; ?>" alt="Profile Image">
                            <?php }else{ ?>
                                <img src="/wp-content/uploads/2024/05/images.png" alt="Profile Image">
                            <?php } ?>
        			        <label><?php echo $shop->name; ?></label>
        			    </div>
        			</td>
        			<td><?php if($account->firstname!='' && $account->lastname!=''){ echo $account->firstname.' '.$account->lastname; }else{ echo $account->username; } ?></td>
        			<td><?php echo $shop->email; ?></td>
        			<td><?php echo $shop->phone; ?></td>
        			<td><?php echo $shop->company; ?></td>
        			<td><?php echo $shop->street; if($shop->city!=''){ echo ', '.$shop->city; } if($shop->state!=''){ echo ', '.$shop->state; } ?></td>
        			<td><?php if($shop->status==1){ echo "Active"; }else{ echo "Inactive"; } ?></td>
        			<td>
        			    <a data-bs-toggle="modal" data-bs-target="#vendorsDetailed<?php echo $shop->id; ?>"  class="detail"><i class="fa fa-eye"></i> Detail</a>
        			</td>
        		</tr>
    		<?php
    		        $i++;
    	        }
    		?>
    	</tbody>
    </table>
</div>

<?php
        $shops = $wpdb->get_results("SELECT * FROM `shop` order by id desc ");
        foreach($shops as $shop){
            $account=$wpdb->get_row($wpdb->prepare("SELECT * FROM `account` WHERE id=".$shop->userID));
?>
<div class="modal fade" id="vendorsDetailed<?php echo $shop->id; ?>" tabindex="-1" aria-labelledby="vendorsDetailedLabel<?php echo $shop->id; ?>" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <form method="post" enctype="multipart/form-data">
          <input type="hidden" name="id" value="<?php echo $shop->id; ?>" />    
          <div class="modal-header">
            <h5 class="modal-title" id="vendorsDetailedLabel<?php echo $shop->id; ?>">Shop Detail</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p class="two">
                <label>Name</label>
                <input type="text" name="name" value="<?php echo $shop->name; ?>" />
            </p>
            <p class="two">
                <label>Email</label>
                <input type="email" name="email" value="<?php echo $shop->email; ?>" />
            </p>
            <p class="two">
                <label>Phone Number</label>
                <input type="tel" name="phone" value="<?php echo $shop->phone; ?>" />
            </p>
            <p class="two">
                <label>Company</label>
                <input type="text" name="company" value="<?php echo $shop->company; ?>" />
            </p>
            <p class="two">
                <label>Street</label>
                <input type="text" name="street" value="<?php echo $shop->street; ?>" />
            </p>
            <p class="two">
                <label>City</label>
                <input type="text" name="city" value="<?php echo $shop->city; ?>" />
            </p>
            <p class="two">
                <label>State</label>
                <input type="text" name="state" value="<?php echo $shop->state; ?>" />
            </p>
            <p class="two">
                <label>Status</label>
                <select name="status">
                    <option <?php if($shop->status=='1'){ echo "selected"; } ?> value="1">Active</option>
                    <option <?php if($shop->status=='0' || $shop->status==''){ echo "selected"; } ?> value="0">Inactive</option>
                </select>
            </p>
            <div class="avatar-upload">
                <label>Shop Image</label>
                <div class="avatar-edit">
                    <input type='file' id="imageUpload<?php echo $shop->id; ?>" class="imageUpload" data-id="<?php echo $shop->id; ?>" name="profile" accept=".png, .jpg, .jpeg" />
                    <label for="imageUpload<?php echo $shop->id; ?>"></label>
                </div>
                <div class="avatar-preview">
                    <?php if($shop->profile!=''){ ?>
                        <div id="imagePreview<?php echo $shop->id; ?>" class="imagePreview" style="background-image: url('<?php echo $shop->profile; ?>');"></div>
                    <?php }else{ ?>
                        <div id="imagePreview<?php echo $shop->id; ?>" class="imagePreview" style="background-image: url(/wp-content/uploads/2024/05/profile.jpg);"></div>
                    <?php } ?>
                </div>
            </div>
            <p>
                <label>Description</label>
                <textarea name="description"><?php echo $shop->description; ?></textarea>
            </p>
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
        jQuery('#imagePreview'+id).css('background-image', 'url(/wp-content/uploads/2024/05/profile.jpg)');
    }
});    
</script>