<?php
global $wpdb;

if(isset($_POST['submit'])){
    $product=$_POST['product']?$_POST['product']:'';
    $promotion=$_POST['promotion']?$_POST['promotion']:'';
    $duration=$_POST['duration']?$_POST['duration']:'';
    $startDate=$_POST['startDate']?$_POST['startDate']:'';
    $endDate=$_POST['endDate']?$_POST['endDate']:'';
    $payment=$_POST['payment']?$_POST['payment']:'0';
    $status=$_POST['status']?$_POST['status']:'0';
    
    $query = " INSERT INTO `leaderBoardPromotion`(`userID`, `product`, `promotion`, `duration`, `startDate`, `endDate`, `paid`, `status`) 
    VALUES ('1','".$product."','".$promotion."','".$duration."','".$startDate."','".$endDate."','".$payment."','".$status."') ";
    $wpdb->query($query);
    
}
  
if(isset($_POST['update'])){
    $id=$_POST['id'];
    $product=$_POST['product']?$_POST['product']:'';
    $promotion=$_POST['promotion']?$_POST['promotion']:'';
    $duration=$_POST['duration']?$_POST['duration']:'';
    $startDate=$_POST['startDate']?$_POST['startDate']:'';
    $endDate=$_POST['endDate']?$_POST['endDate']:'';
    $payment=$_POST['payment']?$_POST['payment']:'0';
    $status=$_POST['status']?$_POST['status']:'0';
       
    $query = " UPDATE `leaderBoardPromotion` SET `product`='".$product."',`promotion`='".$promotion."',`duration`='".$duration."',`startDate`='".$startDate."',`endDate`='".$endDate."',
    `paid`='".$payment."',`status`='".$status."' WHERE `id`='".$id."' ";
    $wpdb->query($query);
    
}
if(isset($_GET['productPromotionStore-delete'])){
    $query = "DELETE FROM `leaderBoardPromotion` WHERE id=".$_GET['productPromotionStore-delete'];
    $wpdb->query($query);
    header("Location: /wp-admin/admin.php?page=bully-leaderboard-promotions");
}
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="/wp-content/themes/amtopm-child/dashboard/dashboardStyles.css" rel="stylesheet">
<script src="//cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js"></script>
<div class="mainheading">
    <h2>Leaderboard Promotions</h2>
</div> 
<div class="maincontent zones">
    <div class="actionButtons">
        <button type="button" data-bs-toggle="modal" data-bs-target="#vendorsDetailed">Add Leaderboard</button>
    </div>
    <table id="dataTableID" class="table table-striped table-bordered vendors" cellspacing="0" width="100%">
    	<thead>
    	    <tr>
    			<th>#</th>
    			<th>Vendor</th>
    			<th>Product Name</th>
    			<th>Start Date</th>
    			<th>End Date</th>
    			<th>Duration</th>
    			<th>Amount</th>
    			<th>Status</th>
    			<th>Payment</th>
    			<th>Action</th>
    		</tr>
    	</thead>
    	<tbody>
    	    <?php
    	            $i=1;
    	            $productPromotionStores = $wpdb->get_results("SELECT * FROM `leaderBoardPromotion` order by id desc ");
    	            foreach($productPromotionStores as $productPromotionStore){
    	                $product=$wpdb->get_row($wpdb->prepare("SELECT * FROM `listings` where `id`='".$productPromotionStore->product."' "));
                        $productPromotion=$wpdb->get_row($wpdb->prepare("SELECT * FROM `productPromotion` where `id`='".$productPromotionStore->promotion."' ")); 
                        $account=$wpdb->get_row($wpdb->prepare("SELECT * FROM `account` WHERE id=".$productPromotionStore->userID));
            ?>
        		<tr>
        			<td><?php echo $i; ?></td>
        			<td><?php if($account->firstname!='' && $account->lastname!=''){ echo $account->firstname.' '.$account->lastname; }else{ echo $account->username; } ?></td>
        			<td><?php if(isset($product->id)){ echo $product->title; } ?></td>
                    <td><?php if($productPromotionStore->startDate!=''){ echo date("F d, Y", strtotime($productPromotionStore->startDate)); } ?></td>
                    <td><?php if($productPromotionStore->endDate!=''){ echo date("F d, Y", strtotime($productPromotionStore->endDate)); } ?></td>
                    <td><?php echo $productPromotionStore->duration; ?> <?php if(isset($productPromotion->id)){ 
                        if($productPromotion->option=='daily'){
                            echo "days";
                        }
                        if($productPromotion->option=='weekly'){
                            echo "weeks";
                        }
                        if($productPromotion->option=='monthly'){
                            echo "months";
                        }
                        if($productPromotion->option=='yearly'){
                            echo "years";
                        }
                    } ?></td>
                    <td><?php if(isset($productPromotion->id)){ echo "$".$productPromotion->price; } ?></td>
                    <td>
                    <?php
                        $start_date = $productPromotionStore->startDate;
                        $end_date = $productPromotionStore->endDate;
                        $current_date = date("Y-m-d");
                        if(($start_date=='' && $end_date=='') || (strtotime($current_date) >= strtotime($start_date) && strtotime($current_date) <= strtotime($end_date))) {
                            if($productPromotionStore->status==0){ 
                                echo "Pending";
                            }elseif($productPromotionStore->status==1){
                                echo "<span style='color:green;'>Active</span>"; 
                            }else{
                                echo "<span style='color:red;'>Rejected</span>";
                            }
                        } else {
                            echo "<span style='color:red;'>Expired</span>";
                        }
                    ?>
                    </td>
                    <td>
                        <?php if($productPromotionStore->paid==1){ ?>
                        <a class="paid">Paid</a>
                        <?php }else{ ?>
                        <a style="cursor:pointer;" class="unpaid paypalButtonPayNow">Unpaid</a>
                        <?php } ?>
                    </td>
        			<td>
        			    <a data-bs-toggle="modal" data-bs-target="#vendorsDetailed<?php echo $productPromotionStore->id; ?>"  class="detail"><i class="fa fa-pen"></i> Edit</a>
        			    <a href="/wp-admin/admin.php?page=bully-leaderboard-promotions&productPromotionStore-delete=<?php echo $productPromotionStore->id; ?>" class="delete"><i class="fa fa-trash"></i> Delete</a>
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
            <h5 class="modal-title" id="vendorsDetailedLabel">Add Leaderboard</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p>
                <label>Product</label>
                <select name="product" required>
                    <option value="">Select Product</option>
                    <?php
                        $listings = $wpdb->get_results("SELECT * FROM `listings` order by id desc ");
        	            foreach($listings as $listing){
                    ?>
                    <option value="<?php echo $listing->id; ?>"><?php echo $listing->title; ?></option>
                    <?php } ?>
                </select>
            </p>
            <p>
                <label>Promotion</label>
                <select name="promotion" required>
                    <option value="">Choose a Promotion</option>
                    <?php
                        $productPromotions = $wpdb->get_results(" SELECT * FROM `productPromotion` where `type`='store' and  `status`='1'  ");
        	            foreach($productPromotions as $productPromotion){
                    ?>
                    <option value="<?php echo $productPromotion->id; ?>"><?php echo $productPromotion->name; ?></option>
                    <?php } ?>
                </select>
            </p>
            <p>
                <label>Days/Weeks/Months</label>
                <input type="number" min=1 name="duration" value="" required />
            </p>
            <p>
                <label>Start Date</label>
                <input type="date" name="startDate" value="" required />
            </p>
            <p>
                <label>End Date</label>
                <input type="date" name="endDate" value="" required />
            </p>
            <p>
                <label>Payment</label>
                <select name="payment">
                    <option value="1">Is Paid</option>
                    <option value="0">Not Paid</option>
                </select>
            </p>
            <p>
                <label>Status</label>
                <select name="status">
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
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
    $productPromotionStores = $wpdb->get_results("SELECT * FROM `leaderBoardPromotion` order by id desc ");
    foreach($productPromotionStores as $productPromotionStore){
?>
<div class="modal fade" id="vendorsDetailed<?php echo $productPromotionStore->id; ?>" tabindex="-1" aria-labelledby="vendorsDetailedLabel<?php echo $productPromotionStore->id; ?>" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <form method="post" enctype="multipart/form-data">
          <input type="hidden" name="id" value="<?php echo $productPromotionStore->id; ?>" />    
          <div class="modal-header">
            <h5 class="modal-title" id="vendorsDetailedLabel<?php echo $productPromotionStore->id; ?>">Update Leaderboard</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
                <p>
                    <label>Product</label>
                    <select name="product" required>
                        <option value="">Select Product</option>
                        <?php
                            $listings = $wpdb->get_results("SELECT * FROM `listings` order by id desc ");
            	            foreach($listings as $listing){
                        ?>
                        <option <?php if($productPromotionStore->product==$listing->id){ echo "selected"; } ?> value="<?php echo $listing->id; ?>"><?php echo $listing->title; ?></option>
                        <?php } ?>
                    </select>
                </p>
                <p>
                    <label>Promotion</label>
                    <select name="promotion" required>
                        <option value="">Choose a Promotion</option>
                        <?php
                            $productPromotions = $wpdb->get_results(" SELECT * FROM `productPromotion` where `type`='store' and  `status`='1'  ");
            	            foreach($productPromotions as $productPromotion){
                        ?>
                        <option <?php if($productPromotionStore->promotion==$productPromotion->id){ echo "selected"; } ?> value="<?php echo $productPromotion->id; ?>"><?php echo $productPromotion->name; ?></option>
                        <?php } ?>
                    </select>
                </p>
                <p>
                    <label>Days/Weeks/Months</label>
                    <input type="number" min=1 name="duration" value="<?php echo $productPromotionStore->duration; ?>" required />
                </p>
                <p>
                    <label>Start Date</label>
                    <input type="date" name="startDate" value="<?php echo $productPromotionStore->startDate; ?>" required />
                </p>
                <p>
                    <label>End Date</label>
                    <input type="date" name="endDate" value="<?php echo $productPromotionStore->endDate; ?>" required />
                </p>
                <p>
                    <label>Payment</label>
                    <select name="payment">
                        <option <?php if($productPromotionStore->paid=='1'){ echo "selected"; } ?> value="1">Is Paid</option>
                        <option <?php if($productPromotionStore->paid=='0' || $productPromotionStore->paid==''){ echo "selected"; } ?> value="0">Not Paid</option>
                    </select>
                </p>
                <p>
                    <label>Status</label>
                    <select name="status">
                        <option <?php if($productPromotionStore->status=='1'){ echo "selected"; } ?> value="1">Active</option>
                        <option <?php if($productPromotionStore->status=='0' || $productPromotionStore->status==''){ echo "selected"; } ?> value="0">Inactive</option>
                    </select>
                </p>
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