<style>
.pagination {
    margin-top: 20px;
    display: flex;
    justify-content: center;
}

.pagination a {
    margin: 0 5px;
    padding: 5px 10px;
    text-decoration: none;
    border: 1px solid #ccc;
    color: #333;
}

.pagination a.active {
    background-color: #007bff;
    color: white;
    border-color: #007bff;
}
.chosen-container{
    font-size: 15px !important;
}
.chosen-container-single .chosen-single{
	height: 35px !important;
}

</style>

<?php
global $wpdb;

$items_per_page = 25;
$current_page = isset($_GET['paged']) ? intval($_GET['paged']) : 1;
$offset = ($current_page - 1) * $items_per_page;

$total_items = $wpdb->get_var("SELECT COUNT(*) FROM `categories`");
$total_pages = ceil($total_items / $items_per_page);

if ($total_items > 0) {
    if ($total_items <= $items_per_page) {
        $categories = $wpdb->get_results("SELECT * FROM `categories` ORDER BY id DESC LIMIT $total_items");
    } else {
        $categories = $wpdb->get_results("SELECT * FROM `categories` ORDER BY id DESC LIMIT $offset, $items_per_page");
    }
} else {
    $categories = [];
}

if(isset($_POST['submit'])){
    $name=$_POST['name']?$_POST['name']:'';
	$category_level=$_POST['category_level']?$_POST['category_level']:'';
	$parent_id=isset($_POST['parent_id'])?$_POST['parent_id']:'';
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
    $query = " INSERT INTO `categories`(`image`, `name`, `category_level`, `parent_id`, `home`, `status`) VALUES ('".$category."','".$name."','".$category_level."','".$parent_id."','".$home."','".$status."') ";
    $wpdb->query($query);
	
    header("Location: " . $_SERVER['REQUEST_URI']);
    exit();
    
}
  
if(isset($_POST['update'])){
    $id=$_POST['id'];
    $name=$_POST['name']?$_POST['name']:'';
	$category_level=$_POST['category_level']?$_POST['category_level']:'';
	$parent_id=$_POST['parent_id']?$_POST['parent_id']:'';
    $status=$_POST['status']?$_POST['status']:'';
    $home=$_POST['home']?$_POST['home']:'No';
       
    $query = " UPDATE `categories` SET `name`='".$name."',`category_level`='".$category_level."',`name`='".$name."',`parent_id`='".$parent_id."',`status`='".$status."' WHERE `id`='".$id."' ";
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
	header("Location: " . $_SERVER['REQUEST_URI']);
    exit();
    
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
            <?php if (!empty($categories)) : ?>
                <?php
                $i = $offset + 1; // Adjust the row numbering based on pagination
                foreach ($categories as $category) {
                ?>
                    <tr>
                        <td><?php echo $i; ?></td> 
                        <td>
                            <div class="user listings rehblti">
                                <?php if ($category->image != '') { ?>
                                    <img style="object-fit: contain;" src="<?php echo $category->image; ?>" alt="Category Image">
                                <?php } else { ?>
                                    <img style="object-fit: contain;" src="/wp-content/uploads/2024/05/images.png" alt="Category Image">
                                <?php } ?>
                                <label><?php echo $category->name; ?></label>
                            </div>
                        </td>
                        <td><?php echo ($category->home == 'Yes') ? $category->home : "No"; ?></td>
                        <td><?php echo ($category->status == 1) ? "Active" : "Inactive"; ?></td>
                        <td>
                            <a data-bs-toggle="modal" data-bs-target="#vendorsDetailed<?php echo $category->id; ?>" class="detail"><i class="fa fa-pen"></i> Edit</a>
                            <a href="/wp-admin/admin.php?page=bully-categories&category-delete=<?php echo $category->id; ?>" class="delete"><i class="fa fa-trash"></i> Delete</a>
                        </td>
                    </tr>
                <?php
                    $i++;
                }
                ?>
            <?php else : ?>
                <tr>
                    <td colspan="5">No categories found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
	
	 <!-- Pagination Links -->
    <div class="pagination">
        <?php if ($total_pages > 1) : ?>
            <?php for ($page = 1; $page <= $total_pages; $page++) : ?>
                <a href="?page=bully-categories&paged=<?php echo $page; ?>" class="<?php echo ($page == $current_page) ? 'active' : ''; ?>">
                    <?php echo $page; ?>
                </a>
            <?php endfor; ?>
        <?php endif; ?>
    </div>
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
                <label>Category Level</label>
                <select name="category_level" id="categoryLevel">
					<option value="1">Parent Category</option>
					<option value="2">Level One</option>
					<option value="3">Level Two</option>
					<option value="4">Level Three</option>
					<option value="5">Level Four</option>
				</select>
            </p>
			<p id="parentCategoryWrapper" style="display: none;">
				<label>Parent Category</label>
				<select name="parent_id" id="parentCategory" style="width: 100%;">
					<option value="">Select Parent Category</option>
				</select>
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
                <label>Category Level</label>
                <select name="category_level" id="categoryLevel2">
                    <option value="1" <?php echo ($category->category_level == 1) ? 'selected' : ''; ?>>Parent Category</option>
                    <option value="2" <?php echo ($category->category_level == 2) ? 'selected' : ''; ?>>Level One</option>
                    <option value="3" <?php echo ($category->category_level == 3) ? 'selected' : ''; ?>>Level Two</option>
					<option value="4" <?php echo ($category->category_level == 4) ? 'selected' : ''; ?>>Level Three</option>
					<option value="5" <?php echo ($category->category_level == 5) ? 'selected' : ''; ?>>Level Four</option>
                </select>
            </p>            
			<p id="parentCategoryWrapper2">
				<label>Parent Category</label>
				<select name="parent_id" id="parentCategory2" style="width: 100%;">
					<option value="">Select Parent Category</option>
					<?php
					$parent_categories = $wpdb->get_results("SELECT * FROM `categories` WHERE category_level = ".($category->category_level - 1));

					if ($parent_categories) {
						foreach ($parent_categories as $parent) {
							$child_categories = $wpdb->get_results("SELECT * FROM `categories` WHERE parent_id = " . $parent->id);

							if ($child_categories) { ?>
								<optgroup label="<?php echo $parent->name; ?>">
									<?php foreach ($child_categories as $child) { ?>
										<option value="<?php echo $child->id; ?>" 
											<?php echo ($category->id == $child->id) ? 'selected' : ''; ?>>
											<?php echo $child->name; ?>
										</option>
									<?php } ?>
								</optgroup>
							<?php }
						}
					}
					?>
				</select>
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

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
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
	
	
	jQuery(document).ready(function($) {
    // Initialize Chosen on the select element
    $('#parentCategory').chosen();
	$('#parentCategory2').chosen();
    
    $('#categoryLevel').on('change', function() {
		console.log('call');
        var selectedLevel = $(this).val();
        var parentCategoryWrapper = $('#parentCategoryWrapper');
        var parentCategoryDropdown = $('#parentCategory');

        if (selectedLevel === '1') {
            parentCategoryWrapper.hide();
            parentCategoryDropdown.empty().trigger("chosen:updated");
        } else {
            parentCategoryWrapper.show();
            
            $.ajax({
                url: ajaxurl,
                type: 'POST',
                data: {
                    action: 'get_parent_categories',
                    category_level: selectedLevel
                },
                success: function(response) {
                    console.log(response);
                    parentCategoryDropdown.empty();
                    if (response.length > 0) {
                        $.each(response, function(index, parentCategoryGroup) {
                            if (parentCategoryGroup.top_level) {
                                parentCategoryDropdown.append(
                                    '<option value="' + parentCategoryGroup.id + '">' + parentCategoryGroup.name + '</option>'
                                );
                            } else {
                                var optgroup = $('<optgroup></optgroup>').attr('label', parentCategoryGroup.parent_name);

                                $.each(parentCategoryGroup.categories, function(i, category) {
                                    optgroup.append('<option value="' + category.id + '">' + category.name + '</option>');
                                });

                                parentCategoryDropdown.append(optgroup);
                            }
                        });
                    } else {
                        parentCategoryDropdown.append('<option value="">No categories available</option>');
                    }
                    parentCategoryDropdown.trigger("chosen:updated");
                },
                error: function(error) {
                    console.error('Error fetching categories:', error);
                }
            });
        }
    });
	
	
  	$('#categoryLevel2').on('change', function() {
        console.log('call2');
        var selectedLevel = $(this).val();
        var parentCategoryWrapper = $('#parentCategoryWrapper2');
        var parentCategoryDropdown = $('#parentCategory2');

        parentCategoryDropdown.empty().append('<option value="">Select Parent Category</option>');

        if (selectedLevel === '1') {
            parentCategoryWrapper.hide();
        } else {
            parentCategoryWrapper.show();

            $.ajax({
                url: ajaxurl,
                type: 'POST',
                data: {
                    action: 'get_parent_categories',
                    category_level: selectedLevel
                },
                success: function(response) {
                    console.log(response);
                    
                    if (response.length > 0) {
                        $.each(response, function(index, parentCategoryGroup) {
                            if (parentCategoryGroup.top_level) {
                                parentCategoryDropdown.append(
                                    '<option value="' + parentCategoryGroup.id + '">' + parentCategoryGroup.name + '</option>'
                                );
                            } else {
                                var optgroup = $('<optgroup></optgroup>').attr('label', parentCategoryGroup.parent_name);

                                $.each(parentCategoryGroup.categories, function(i, category) {
                                    optgroup.append('<option value="' + category.id + '">' + category.name + '</option>');
                                });

                                parentCategoryDropdown.append(optgroup);
                            }
                        });
                    } else {
                        parentCategoryDropdown.append('<option value="">No categories available</option>');
                    }
                    parentCategoryDropdown.trigger("chosen:updated");
                },
                error: function(error) {
                    console.error('Error fetching categories:', error);
                }
            });
        }
    });

});
</script>