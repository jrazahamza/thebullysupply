<?php
global $wpdb;
  
if(isset($_POST['submit'])){
    $id=$_POST['id'];
    $firstname=$_POST['firstname']?$_POST['firstname']:'';
    $lastname=$_POST['lastname']?$_POST['lastname']:'';
    $contact=$_POST['contact']?$_POST['contact']:'';
    $state=$_POST['state']?$_POST['state']:'';
    $status=$_POST['status']?$_POST['status']:'';
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
    $addressStatus=$_POST['addressStatus']?$_POST['addressStatus']:'';
    
    $query = " UPDATE `account` SET `contact`='".$contact."',`firstname`='".$firstname."',`lastname`='".$lastname."',`state`='".$state."',`status`='".$status."' WHERE `id`='".$id."' ";
    $wpdb->query($query);
    
    $profile='';
    if(!empty($_FILES["profile"]["type"])){
        $fileName = time().'_'.$_FILES['profile']['name'];
        $sourcePath = $_FILES['profile']['tmp_name'];
        $targetPath = "/home/cloudstandly/public_html/bully.cloudstandly.com/wp-content/themes/amtopm-child/uploaded/profile/".$fileName;
        if(move_uploaded_file($sourcePath,$targetPath)){
            $profile = "/wp-content/themes/amtopm-child/uploaded/profile/".$fileName;
        }
    }
    if($profile!=''){
        $query = " UPDATE `account` SET `profile`='".$profile."' WHERE `id`='".$id."' ";
        $wpdb->query($query);
    }
    
    $query = " UPDATE `address` SET `street`='".$streetAddress."',`city`='".$city."',`state`='".$stateProvince."',`postal`='".$zippostalCode."',`country`='".$country."',`shipStreet`='".$bstreetAddress."',`shipCity`='".$bcity."',
    `shipState`='".$bstateProvince."',`shipPostal`='".$bzippostalCode."',`shipCountry`='".$bcountry."',`status`='".$addressStatus."' WHERE `userID`='".$id."' ";
    $wpdb->query($query);
    
}
if(isset($_GET['vendor-delete'])){
    $query = "DELETE FROM `account` WHERE id=".$_GET['vendor-delete'];
    $wpdb->query($query);
    header("Location: /wp-admin/admin.php?page=bully-vendors");
}
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="/wp-content/themes/amtopm-child/dashboard/dashboardStyles.css" rel="stylesheet">
<script src="//cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js"></script>
<div class="mainheading">
    <h2>Vendors</h2>
</div> 
<div class="maincontent zones">
    <table id="dataTableID" class="table table-striped table-bordered vendors" cellspacing="0" width="100%">
    	<thead>
    	    <tr>
    			<th>#</th>
    			<th>Vendor</th>
    			<th>Username/Email</th>
    			<th>Phone Number</th>
    			<th>Newsletter</th>
    			<th>State</th>
    			<th>Billing Address</th>
    			<th>Shipping Address</th>
    			<th>Status</th>
    			<th>Action</th>
    		</tr>
    	</thead>
    	<tbody>
    	    <?php
    	            $i=1;
    	            $accounts = $wpdb->get_results("SELECT * FROM `account` order by id desc ");
    	            foreach($accounts as $account){
    	                $address=$wpdb->get_row($wpdb->prepare("SELECT * FROM `address` WHERE userID=".$account->id));
            ?>
        		<tr>
        			<td><?php echo $i; ?></td>
        			<td>
        			    <div class="user">
        			        <?php if(isset($account->profile) && $account->profile!=''){ ?>
                                <img src="<?php echo $account->profile; ?>" alt="Profile Image">
                            <?php }else{ ?>
                                <img src="/wp-content/uploads/2024/05/profile.jpg" alt="Profile Image">
                            <?php } ?>
        			        <label><?php echo $account->firstname.' '.$account->lastname; ?></label>
        			    </div>
        			</td>
        			<td><?php echo $account->username; ?><br><?php echo $account->email; ?></td>
        			<td><?php echo $account->contact; ?></td>
        			<td><?php if($account->newsletter=='Yes'){ echo 'Subscribed'; }else{ echo 'Not Subscribed'; } ?></td>
        			<td><?php echo $account->state; ?></td>
        			<td>
        			<?php if(isset($address) && $address->street!=''){ ?>
                        <?php echo $address->street; ?>, <?php echo $address->city; ?>, <?php echo $address->state; ?> <?php echo $address->postal; ?>, <?php echo $address->country; ?>
                    <?php } ?>
        			</td>
        			<td>
        			<?php if(isset($address) && $address->shipStreet!=''){ ?>
                        <?php echo $address->shipStreet; ?>, <?php echo $address->shipCity; ?>, <?php echo $address->shipState; ?> <?php echo $address->shipPostal; ?>, <?php echo $address->shipCountry; ?>
                    <?php } ?>
        			</td>
        			<td><?php if($account->status==1){ echo "Active"; }else{ echo "Inactive"; } ?></td>
        			<td>
        			    <a data-bs-toggle="modal" data-bs-target="#vendorsDetailed<?php echo $account->id; ?>"  class="detail"><i class="fa fa-eye"></i> Detail</a>
        			    <a href="/wp-admin/admin.php?page=bully-vendors&vendor-delete=<?php echo $account->id; ?>" class="delete"><i class="fa fa-trash"></i> Delete</a>
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
        $accounts = $wpdb->get_results("SELECT * FROM `account` ");
        foreach($accounts as $account){
            $address=$wpdb->get_row($wpdb->prepare("SELECT * FROM `address` WHERE userID=".$account->id));
?>
<div class="modal fade" id="vendorsDetailed<?php echo $account->id; ?>" tabindex="-1" aria-labelledby="vendorsDetailedLabel<?php echo $account->id; ?>" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <form method="post">
          <input type="hidden" name="id" value="<?php echo $account->id; ?>" />    
          <div class="modal-header">
            <h5 class="modal-title" id="vendorsDetailedLabel<?php echo $account->id; ?>">Vendor Detail</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <h4>Account Detail</h4>  
            <p class="two">
                <label>First Name</label>
                <input type="text" name="firstname" value="<?php echo $account->firstname; ?>" />
            </p>
            <p class="two">
                <label>Last Name</label>
                <input type="text" name="lastname" value="<?php echo $account->lastname; ?>" />
            </p>
            <p class="two">
                <label>Phone Number</label>
                <input type="text" name="contact" value="<?php echo $account->contact; ?>" />
            </p>
            <p class="two">
                <label>State</label>
                <input type="text" name="state" value="<?php echo $account->state; ?>" />
            </p>
            <p class="two">
                <label>Status</label>
                <select name="status">
                    <option <?php if($account->status=='1'){ echo "selected"; } ?> value="1">Active</option>
                    <option <?php if($account->status=='0' || $account->status==''){ echo "selected"; } ?> value="0">Inactive</option>
                </select>
            </p>
            <div class="avatar-upload">
                <label>Profile</label>
                <div class="avatar-edit">
                    <input type='file' id="imageUpload<?php echo $account->id; ?>" class="imageUpload" data-id="<?php echo $account->id; ?>" name="profile" accept=".png, .jpg, .jpeg" />
                    <label for="imageUpload<?php echo $account->id; ?>"></label>
                </div>
                <div class="avatar-preview">
                    <?php if($account->profile!=''){ ?>
                        <div id="imagePreview<?php echo $account->id; ?>" class="imagePreview" style="background-image: url('<?php echo $account->profile; ?>');"></div>
                    <?php }else{ ?>
                        <div id="imagePreview<?php echo $account->id; ?>" class="imagePreview" style="background-image: url(/wp-content/uploads/2024/05/profile.jpg);"></div>
                    <?php } ?>
                </div>
            </div>
            <h4>Addresses</h4>
            <div class="flex-class-popup-item-left">
                <h5>Billing Address</h5>
                    <p>
                        <label>Street Address</label>
                        <textarea name="streetAddress" id="street-address" placeholder="Type your street address here"><?php echo $address->street; ?></textarea>
                    </p>
                    <p class="two">
                        <label>City</label>
                        <input type="text" name="city" id="City" placeholder="Type your city here" value="<?php  echo $address->city;  ?>"/>
                    </p>
                    <p class="two">
                        <label>State/Province</label>
                        <input type="text" name="stateProvince" id="state-province" placeholder="Type your State/Province here" value="<?php  echo $address->state; ?>"/>
                    </p>
                    <p class="two">
                        <label>Zip/Postal Code</label>
                        <input type="number" name="zippostalCode" id="zip-postal-code" placeholder="Type your zip/postal code here" value="<?php  echo $address->postal; ?>"/>
                    </p>
                    <p class="two">
                        <label>Country</label>
                        <select id="country" name="country">
                            <option value="" >Select your country</option>
                            <option <?php if($address->country=='canada'){ echo "selected"; } ?> value="canada">Canada</option>
                            <option <?php if($address->country=='usa'){ echo "selected"; } ?> value="usa">United States</option>
                            <option <?php if($address->country=='mexico'){ echo "selected"; } ?> value="mexico">Mexico</option>
                            <option <?php if($address->country=='uk'){ echo "selected"; } ?> value="uk">United Kingdom</option>
                            <option <?php if($address->country=='germany'){ echo "selected"; } ?> value="germany">Germany</option>
                            <option <?php if($address->country=='france'){ echo "selected"; } ?> value="france">France</option>
                            <option <?php if($address->country=='japan'){ echo "selected"; } ?> value="japan">Japan</option>
                            <option <?php if($address->country=='australia'){ echo "selected"; } ?> value="australia">Australia</option>
                        </select>
                    </p>
                </div>
            <div class="flex-class-popup-item-right">
                <h5>Shipping Address</h5>
                    <p>
                        <label>Street Address</label>
                        <textarea name="bstreetAddress" id="street-address" placeholder="Type your street address here"><?php  echo $address->shipStreet; ?></textarea>
                    </p>
                    <p class="two">
                        <label>City</label>
                        <input type="text" name="bcity" id="City" placeholder="Type your city here" value="<?php  echo $address->shipCity; ?>" />
                    </p>
                    <p class="two">
                        <label>State/Province</label>
                        <input type="text" name="bstateProvince" id="state-province" placeholder="Type your State/Province here" value="<?php  echo $address->shipState; ?>"/>
                    </p>
                    <p class="two">
                        <label>Zip/Postal Code</label>
                        <input type="number" name="bzippostalCode" id="zip-postal-code" placeholder="Type your zip/postal code here" value="<?php  echo $address->shipPostal; ?>"/>
                    </p>
                    <p class="two">
                        <label>Country</label>
                        <select id="country" name="bcountry">
                            <option value="" >Select your country</option>
                            <option <?php if($address->shipCountry=='canada'){ echo "selected"; } ?> value="canada">Canada</option>
                            <option <?php if($address->shipCountry=='usa'){ echo "selected"; } ?> value="usa">United States</option>
                            <option <?php if($address->shipCountry=='mexico'){ echo "selected"; } ?> value="mexico">Mexico</option>
                            <option <?php if($address->shipCountry=='uk'){ echo "selected"; } ?> value="uk">United Kingdom</option>
                            <option <?php if($address->shipCountry=='germany'){ echo "selected"; } ?> value="germany">Germany</option>
                            <option <?php if($address->shipCountry=='france'){ echo "selected"; } ?> value="france">France</option>
                            <option <?php if($address->shipCountry=='japan'){ echo "selected"; } ?> value="japan">Japan</option>
                            <option <?php if($address->shipCountry=='australia'){ echo "selected"; } ?> value="australia">Australia</option>
                        </select>
                    </p>
                </div>
                <p class="two">
                <label>Address Status</label>
                <select name="addressStatus">
                    <option <?php if($address->status=='1'){ echo "selected"; } ?> value="1">Active</option>
                    <option <?php if($address->status=='0' || $address->status==''){ echo "selected"; } ?> value="0">Inactive</option>
                </select>
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