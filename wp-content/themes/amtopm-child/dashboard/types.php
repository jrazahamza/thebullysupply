<?php
global $wpdb;

if(isset($_POST['submit'])){
    $name=$_POST['name']?$_POST['name']:'';
    $status=$_POST['status']?$_POST['status']:'';
       
    $query = " INSERT INTO `types`(`name`, `status`) VALUES ('".$name."','".$status."') ";
    $wpdb->query($query);
    
}
  
if(isset($_POST['update'])){
    $id=$_POST['id'];
    $name=$_POST['name']?$_POST['name']:'';
    $status=$_POST['status']?$_POST['status']:'';
       
    $query = " UPDATE `types` SET `name`='".$name."',`status`='".$status."' WHERE `id`='".$id."' ";
    $wpdb->query($query);
    
}
if(isset($_GET['types-delete'])){
    $query = "DELETE FROM `types` WHERE id=".$_GET['types-delete'];
    $wpdb->query($query);
    header("Location: /wp-admin/admin.php?page=bully-types");
}
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="/wp-content/themes/amtopm-child/dashboard/dashboardStyles.css" rel="stylesheet">
<script src="//cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js"></script>
<div class="mainheading">
    <h2>Types</h2>
</div> 
<div class="maincontent zones">
    <div class="actionButtons">
        <button type="button" data-bs-toggle="modal" data-bs-target="#vendorsDetailed">Add Type</button>
    </div>
    <table id="dataTableID" class="table table-striped table-bordered vendors" cellspacing="0" width="100%">
    	<thead>
    	    <tr>
    			<th>#</th>
    			<th>Type</th>
    			<th>Status</th>
    			<th>Action</th>
    		</tr>
    	</thead>
    	<tbody>
    	    <?php
    	            $i=1;
    	            $types = $wpdb->get_results("SELECT * FROM `types` order by id desc ");
    	            foreach($types as $type){
    	    ?>
        		<tr>
        			<td><?php echo $i; ?></td>
        			<td><?php echo $type->name; ?>
        			</td>
        			<td><?php if($type->status==1){ echo "Active"; }else{ echo "Inactive"; } ?></td>
        			<td>
        			    <a data-bs-toggle="modal" data-bs-target="#vendorsDetailed<?php echo $type->id; ?>"  class="detail"><i class="fa fa-pen"></i> Edit</a>
        			    <a href="/wp-admin/admin.php?page=bully-types&types-delete=<?php echo $type->id; ?>" class="delete"><i class="fa fa-trash"></i> Delete</a>
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
            <h5 class="modal-title" id="vendorsDetailedLabel">Add Type</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p>
                <label>Name</label>
                <input type="text" name="name" value="" />
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
        $types = $wpdb->get_results("SELECT * FROM `types` order by id desc ");
    	 foreach($types as $type){
?>
<div class="modal fade" id="vendorsDetailed<?php echo $type->id; ?>" tabindex="-1" aria-labelledby="vendorsDetailedLabel<?php echo $type->id; ?>" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <form method="post" enctype="multipart/form-data">
          <input type="hidden" name="id" value="<?php echo $type->id; ?>" />    
          <div class="modal-header">
            <h5 class="modal-title" id="vendorsDetailedLabel<?php echo $type->id; ?>">Update Type</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p>
                <label>Name</label>
                <input type="text" name="name" value="<?php echo $type->name; ?>" />
            </p>
            <p>
                <label>Status</label>
                <select name="status">
                    <option <?php if($type->status=='1'){ echo "selected"; } ?> value="1">Active</option>
                    <option <?php if($type->status=='0' || $type->status==''){ echo "selected"; } ?> value="0">Inactive</option>
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