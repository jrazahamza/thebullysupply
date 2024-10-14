<?php
global $wpdb;

if(isset($_POST['submit'])){
    $name=$_POST['name']?$_POST['name']:'';
    $option=$_POST['option']?$_POST['option']:'';
    $type=$_POST['type']?$_POST['type']:'';
    $price=$_POST['price']?$_POST['price']:'';
    $status=$_POST['status']?$_POST['status']:'';
       
    $query = " INSERT INTO `productPromotion`(`name`, `option`, `type`, `price`, `status`) VALUES ('".$name."','".$option."','".$type."','".$price."','".$status."') ";
    $wpdb->query($query);
    
}
  
if(isset($_POST['update'])){
    $id=$_POST['id'];
    $name=$_POST['name']?$_POST['name']:'';
    $option=$_POST['option']?$_POST['option']:'';
    $type=$_POST['type']?$_POST['type']:'';
    $price=$_POST['price']?$_POST['price']:'';
    $status=$_POST['status']?$_POST['status']:'';
       
    $query = " UPDATE `productPromotion` SET `name`='".$name."',`option`='".$option."',`type`='".$type."',`price`='".$price."',`status`='".$status."' WHERE `id`='".$id."' ";
    $wpdb->query($query);
    
}
if(isset($_GET['setting-delete'])){
    $query = "DELETE FROM `productPromotion` WHERE id=".$_GET['setting-delete'];
    $wpdb->query($query);
    header("Location: /wp-admin/admin.php?page=bully-promotions-setting");
}
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="/wp-content/themes/amtopm-child/dashboard/dashboardStyles.css" rel="stylesheet">
<script src="//cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js"></script>
<div class="mainheading">
    <h2>Promotions Setting</h2>
</div> 
<div class="maincontent zones">
    <div class="actionButtons">
        <button type="button" data-bs-toggle="modal" data-bs-target="#vendorsDetailed">Add Promotion</button>
    </div>
    <table id="dataTableID" class="table table-striped table-bordered vendors" cellspacing="0" width="100%">
    	<thead>
    	    <tr>
    			<th>#</th>
    			<th>Name</th>
    			<th>Type</th>
    			<th>Place</th>
    			<th>Price</th>
    			<th>Status</th>
    			<th>Action</th>
    		</tr>
    	</thead>
    	<tbody>
    	    <?php
    	            $i=1;
    	            $productPromotions = $wpdb->get_results("SELECT * FROM `productPromotion` order by id desc ");
    	            foreach($productPromotions as $productPromotion){
    	    ?>
        		<tr>
        			<td><?php echo $i; ?></td>
        			<td><?php echo $productPromotion->name; ?></td>
        			<td><?php echo ucfirst($productPromotion->option); ?></td>
        			<td><?php echo ucfirst($productPromotion->type); ?></td>
        			<td><?php echo '$'.$productPromotion->price; ?></td>
        			<td><?php if($productPromotion->status==1){ echo "Active"; }else{ echo "Inactive"; } ?></td>
        			<td>
        			    <a data-bs-toggle="modal" data-bs-target="#vendorsDetailed<?php echo $productPromotion->id; ?>"  class="detail"><i class="fa fa-pen"></i> Edit</a>
        			    <a href="/wp-admin/admin.php?page=bully-promotions-setting&setting-delete=<?php echo $productPromotion->id; ?>" class="delete"><i class="fa fa-trash"></i> Delete</a>
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
            <h5 class="modal-title" id="vendorsDetailedLabel">Add Promotion</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p>
                <label>Name</label>
                <input type="text" name="name" value="" required />
            </p>
            <p>
                <label>Type</label>
                <select name="option" required>
                    <option value="daily">Daily</option>
                    <option value="weekly">Weekly</option>
                    <option value="monthly">Monthly</option>
                    <option value="yearly">Yearly</option>
                </select>
            </p>
            <p>
                <label>Place</label>
                <select name="type" required>
                    <option value="banner">Banner</option>
                    <option value="store">Store</option>
                    <option value="leader">Leader</option>
                </select>
            </p>
            <p>
                <label>Price</label>
                <input type="number" name="price" min=1 required value="" />
            </p>
            <p>
                <label>Status</label>
                <select name="status" required>
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
    $productPromotions = $wpdb->get_results("SELECT * FROM `productPromotion` order by id desc ");
    foreach($productPromotions as $productPromotion){
?>
<div class="modal fade" id="vendorsDetailed<?php echo $productPromotion->id; ?>" tabindex="-1" aria-labelledby="vendorsDetailedLabel<?php echo $productPromotion->id; ?>" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <form method="post" enctype="multipart/form-data">
          <input type="hidden" name="id" value="<?php echo $productPromotion->id; ?>" />    
          <div class="modal-header">
            <h5 class="modal-title" id="vendorsDetailedLabel<?php echo $productPromotion->id; ?>">Update Promotion</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p>
                <label>Name</label>
                <input type="text" name="name" value="<?php echo $productPromotion->name; ?>" required />
            </p>
            <p>
                <label>Type</label>
                <select name="option" required>
                    <option <?php if($productPromotion->option=='daily'){ echo "selected"; } ?> value="daily">Daily</option>
                    <option <?php if($productPromotion->option=='weekly'){ echo "selected"; } ?> value="weekly">Weekly</option>
                    <option <?php if($productPromotion->option=='monthly'){ echo "selected"; } ?> value="monthly">Monthly</option>
                    <option <?php if($productPromotion->option=='yearly'){ echo "selected"; } ?> value="yearly">Yearly</option>
                </select>
            </p>
            <p>
                <label>Place</label>
                <select name="type" required>
                    <option <?php if($productPromotion->type=='banner'){ echo "selected"; } ?> value="banner">Banner</option>
                    <option <?php if($productPromotion->type=='store'){ echo "selected"; } ?> value="store">Store</option>
                    <option <?php if($productPromotion->type=='leader'){ echo "selected"; } ?> value="leader">Leader</option>
                </select>
            </p>
            <p>
                <label>Price</label>
                <input type="number" name="price" min=1 required value="<?php echo $productPromotion->price; ?>" />
            </p>
            <p>
                <label>Status</label>
                <select name="status" required>
                    <option <?php if($productPromotion->status=='1'){ echo "selected"; } ?> value="1">Active</option>
                    <option <?php if($productPromotion->status=='0' || $productPromotion->status==''){ echo "selected"; } ?> value="0">Inactive</option>
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