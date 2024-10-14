<?php ob_start();
if(session_status() === PHP_SESSION_NONE) {
    session_start();
}
include ('connection.php');
/* 
Template Name: my-shop
*/
if(!isset($_COOKIE["user_id"]) || $_COOKIE["user_id"]==0){ 
  header("location: /login/");
}

if(isset($_GET['userStatus'])){
    mysqli_query($con," UPDATE `listings` SET `userStatus`='".$_GET['userStatus']."' WHERE `id`='".$_GET['id']."' ");
    header("location: /my-shop/");
}

if(isset($_GET['status-change'])){
    mysqli_query($con," UPDATE `listings` SET `status`='".$_GET['status-change']."' WHERE `id`='".$_GET['id']."' ");
    header("location: /my-shop/");
}

if(isset($_GET['delete-listing'])){
    mysqli_query($con," DELETE FROM `listings` WHERE `id`='".$_GET['delete-listing']."' ");
    header("location: /my-shop/");
}
  
get_header();
?>
<section id="my-shop" class="my-shop template-common-class">
    <div class="container-fluid">
        <div class="row">
            <div class="template-pages-content">
                <!--=== SideBar-->
                <div class="template-sidebar">
                    <?php $activeSidebar="my-shop";  include ("custom-sidebar.php"); ?>
                </div>
                <!-- Start Template Page Content-->
                <div class="main-content-class">
                    <div class="inner-page-content">
                        <div class="template-page-title">
                            <h2>My Shop</h2>
                        </div>
                        <!--==== filters -->
                        <div class="filters-class">
                            
                            <div class="filters-item filters-item02">
                                <div class="search-class">
                                    <span class="search-icon"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                                    <path d="M15 15L19 19M1 9C1 11.1217 1.84285 13.1566 3.34315 14.6569C4.84344 16.1571 6.87827 17 9 17C11.1217 17 13.1566 16.1571 14.6569 14.6569C16.1571 13.1566 17 11.1217 17 9C17 6.87827 16.1571 4.84344 14.6569 3.34315C13.1566 1.84285 11.1217 1 9 1C6.87827 1 4.84344 1.84285 3.34315 3.34315C1.84285 4.84344 1 6.87827 1 9Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                    </svg></span>
                                    <input type="search" name="SearchListing" id="SearchListing" placeholder="SearchListing">
                                </div>
                            </div>
                            
                            <div class="filters-item filters-item03">
                                <div class="add-new-product-class">
                                    <a href="/create-listing/"><button type="button" name="AddNewProduct">Add New Product</button></a>
                                </div>
                            </div>
                            
                        </div>
                        <!--==== filters -->    
                        <!--Shop Page Tabs-->
                        <div class="shop-Page-tabs">
                            <ul>
                                <li class="<?php if(!isset($_GET['tab']) && !isset($_GET['tab-listing-status'])){ echo "active"; } if(isset($_GET['tab']) && $_GET['tab']=='pending'){ echo "active"; } ?>"><a href="/my-shop/?tab=pending">Pending</a></li>
                                <li class="<?php if(isset($_GET['tab']) && $_GET['tab']=='active'){ echo "active"; } ?>"><a href="/my-shop/?tab=active">Active</a></li>
                                <li class="<?php if(isset($_GET['tab']) && $_GET['tab']=='in complete'){ echo "active"; } ?>"><a href="/my-shop/?tab=in complete">In Complete</a></li>
                                <li class="<?php if(isset($_GET['tab']) && $_GET['tab']=='in active'){ echo "active"; } ?>"><a href="/my-shop/?tab=in active">In Active</a></li>
                                <li class="<?php if(isset($_GET['tab']) && $_GET['tab']=='sold out'){ echo "active"; } ?>"><a href="/my-shop/?tab=sold out">Sold Out</a></li>
                            </ul>
                        </div>
                        
                        <div class="shop-Page-action-button">
                            <ul>
                                <li class="<?php if(!isset($_GET['tab-listing-status'])){ echo "active"; } if(isset($_GET['tab-listing-status']) && $_GET['tab-listing-status']=='listed'){ echo "active"; } ?>"><a href="/my-shop/?tab-listing-status=listed">Listed</a></li>
                                <li class="<?php if(isset($_GET['tab-listing-status']) && $_GET['tab-listing-status']=='hold'){ echo "active"; } ?>"><a href="/my-shop/?tab-listing-status=hold">On Hold</a></li>
                            </ul>
                        </div>
                        
                        <?php
                            if(isset($_GET['tab'])){
                                if($_GET['tab']=='pending'){
                                    $tabListing='pending';
                                }
                                if($_GET['tab']=='active'){
                                    $tabListing='active';
                                }
                                if($_GET['tab']=='in complete'){
                                    $tabListing='in complete';
                                }
                                if($_GET['tab']=='in active'){
                                    $tabListing='in active';
                                }
                                if($_GET['tab']=='sold out'){
                                    $tabListing='sold out';
                                }
                            }else{
                                $tabListing='';
                            }
                            
                            if(isset($_GET['tab-listing-status'])){
                                if($_GET['tab-listing-status']=='listed'){
                                    $tabStatus='listed';
                                }
                                if($_GET['tab-listing-status']=='hold'){
                                    $tabStatus='hold';
                                }
                            }else{
                                $tabStatus='';
                            }
                        ?>
                        
                        <!--Shop Page Tabs-->
                        <!--Template Shop Page Table-->
                        <div class="my-shop-table-data">
                            <table class="table my-shop-table" id="SearchListingTable">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Type</th>
                                        <th scope="col">SKU</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Qty</th>
                                        <th scope="col">Stock</th>
                                        <th scope="col">End Time</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $i=1;
                                        if($tabListing!=''){
                                        $listings=mysqli_query($con,"SELECT * FROM `listings` where `status`='".$tabListing."' and `userID`='".$_COOKIE["user_id"]."' order by id desc ");      
                                        }
                                        if($tabStatus!=''){
                                        $listings=mysqli_query($con,"SELECT * FROM `listings` where `userStatus`='".$tabStatus."' and `userID`='".$_COOKIE["user_id"]."' order by id desc ");      
                                        }
                                        if($tabListing=='' && $tabStatus==''){
                                        $listings=mysqli_query($con,"SELECT * FROM `listings` where `status`='pending' and `userID`='".$_COOKIE["user_id"]."' order by id desc ");      
                                        }
                                        while($listing = mysqli_fetch_array($listings)){
                                            $types=mysqli_query($con,"SELECT * FROM `types` where `id`=".$listing["type"]." ");      
                                            $type = mysqli_fetch_array($types);
                                    ?>
                                    <tr>
                                        <td>    
                                            <span>
                                                <?php echo $i; ?>
                                            </span>
                                        </td>
                                        <td class="products-name">
                                            <?php echo $listing['title']; ?>
                                            <ul class="products-action">
                                                <li class="edit"><a href="/edit-listing/?id=<?php echo $listing['id']; ?>">Edit</a></li>
                                                <?php if($listing['status']=='in active'){ ?>
                                                <li class="deactivate active"><a href="/my-shop/?status-change=active&id=<?php echo $listing['id']; ?>">Active</a></li>
                                                <?php } if($listing['status']=='active'){ ?>
                                                <li class="deactivate"><a href="/my-shop/?status-change=in active&id=<?php echo $listing['id']; ?>">Deactivate</a></li>
                                                <?php } ?>
                                                <li class="delete"><a href="/my-shop/?delete-listing=<?php echo $listing['id']; ?>">Delete</a></li>
                                                <?php if($listing['userStatus']=='listed'){ ?>
                                                <li class="on-hold"><a href="/my-shop/?userStatus=hold&id=<?php echo $listing['id']; ?>">On Hold</a></li>
                                                <?php }else{ ?>
                                                <li class="on-listed"><a href="/my-shop/?userStatus=listed&id=<?php echo $listing['id']; ?>">On Listed</a></li>
                                                <?php } ?>
                                            </ul>
                                        </td>
                                        <td><?php if(isset($type['id'])){ echo $type['name']; } ?></td>
                                        <td><?php echo $listing['stockNumber']; ?></td>
                                        <td>$<?php echo $listing['price']; ?></td>
                                        <td><?php echo $listing['quantity']; ?></td>
                                        <td><?php echo $listing['stock']; ?></td>
                                        <td><?php echo date("F d, Y", strtotime($listing['end_at'])); ?></td>
                                        <td><?php echo ucfirst($listing['status']); ?></td>
                                    </tr>
                                    <?php $i++; } ?>
                                </tbody>
                            </table>
                        </div>
                        <!--Template Shop Page Table-->
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
<script>
jQuery(document).ready(function(){
    jQuery("#SearchListing").keyup(function(){
        _this = this;
          jQuery.each(jQuery("#SearchListingTable tbody tr"), function() {
             if(jQuery(this).text().toLowerCase().indexOf(jQuery(_this).val().toLowerCase()) === -1){
                 jQuery(this).hide();
               }else{
                 jQuery(this).show();
              }
          });
    });
});    
</script>