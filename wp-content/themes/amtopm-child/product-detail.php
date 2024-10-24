<?php ob_start();

if(session_status() === PHP_SESSION_NONE) {
    session_start();
}
include ('connection.php');
/* 
Template Name: product detailed
*/ 

if(isset($_GET['id'])){
    $listings=mysqli_query($con,"SELECT * FROM `listings` where `id`=".$_GET['id']." ");      
    $listing = mysqli_fetch_array($listings);
    if(!isset($listing['id'])){
        header("location: /category/");
    }
}else{
   header("location: /category/"); 
}

$contactSend='';

if(isset($_POST['submit'])){
    $id=$_POST['id'];
    $firstName=$_POST['firstName'];
    $lastName=$_POST['lastName'];
    $emailAddress=$_POST['emailAddress'];
    $phoneNumber=$_POST['phoneNumber'];
    $address=$_POST['address'];
    $description=$_POST['description']?$_POST['description']:'';
    mysqli_query($con," INSERT INTO `contactRequest`(`product`, `firstName`, `lastName`, `emailAddress`, `phoneNumber`, `address`, `description`, `userIP`, `status`) 
    VALUES ('".$id."','".$firstName."','".$lastName."','".$emailAddress."','".$phoneNumber."','".$address."','".$description."','".$_SERVER['REMOTE_ADDR']."','0') ");  
    $contactSend='send';
}

get_header();
?>
<div class="product-detail-page">
    <section class="pd_product-details">
        <div class="pd_left-column">
            <div class="pd_product-image">
                <?php if($listing['gallery1']!=''){ ?>
                    <img class="productDescriptionMainImage" src="<?php echo $listing['gallery1']; ?>" alt="<?php echo $listing['title']; ?>">
                <?php } ?>
            </div>
            <div class="pd_horizontal-gallery">
                <?php if($listing['gallery1']!=''){ ?>
                    <img class="productDescriptionMainSingle" src="<?php echo $listing['gallery1']; ?>" alt="<?php echo $listing['title']; ?>">
                <?php } ?>
                <?php if($listing['gallery2']!=''){ ?>
                    <img class="productDescriptionMainSingle" src="<?php echo $listing['gallery2']; ?>" alt="<?php echo $listing['title']; ?>">
                <?php } ?>
                <?php if($listing['gallery3']!=''){ ?>
                    <img class="productDescriptionMainSingle" src="<?php echo $listing['gallery3']; ?>" alt="<?php echo $listing['title']; ?>">
                <?php } ?>
                <?php if($listing['gallery4']!=''){ ?>
                    <img class="productDescriptionMainSingle" src="<?php echo $listing['gallery4']; ?>" alt="<?php echo $listing['title']; ?>">
                <?php } ?>
                <?php if($listing['gallery5']!=''){ ?>
                    <img class="productDescriptionMainSingle" src="<?php echo $listing['gallery5']; ?>" alt="<?php echo $listing['title']; ?>">
                <?php } ?>
                <?php if($listing['gallery6']!=''){ ?>
                    <img class="productDescriptionMainSingle" src="<?php echo $listing['gallery6']; ?>" alt="<?php echo $listing['title']; ?>">
                <?php } ?>
            </div>
            <div class="pd_headings">
                <h3 class="pd_heading1">100% Health Guarantee for Dog</h3>
                <h3 class="pd_heading2">100% Guarantee Dog Identification</h3>
            </div>
            <div class="pd_share">
                <button class="pd_share-button">Share</button>
                <div class="pd_social-icons"> 
                    <a href="https://www.facebook.com/sharer/sharer.php?u=https://bully.cloudstandly.com/product-detail/?id=<?php echo $listing['id']; ?>" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                    <a href="https://twitter.com/intent/tweet?url=https://bully.cloudstandly.com/product-detail/?id=<?php echo $listing['id']; ?>" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                    <a href="https://www.instagram.com/?url=https://bully.cloudstandly.com/product-detail/?id=<?php echo $listing['id']; ?>" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                    <a href="https://www.youtube.com/?url=https://bully.cloudstandly.com/product-detail/?id=<?php echo $listing['id']; ?>" target="_blank"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>
                </div>
            </div>
        </div>
        <div class="pd_right-column">
            <div class="pd_navigation-indicator">
                Home > Dogs > <?php echo $listing['title']; ?>
            </div>
            <div class="pd_sku-number">SKU: <?php echo $listing['stockNumber']; ?></div>
            <h2 class="pd_product-title"><?php echo $listing['title']; ?></h2>
            <div class="pd_price">$<?php echo $listing['price']; ?></div>
            <div class="pd_buttons">
                <button type="button" class="pd_button1" style="cursor:pointer;">Contact Us</button>
                <a href="/product-chat/?id=<?php echo $listing['id']; ?>" target="_blank" class="pd_button2">Chat With Us</a>
            </div>
            <table class="pd_product-info">
                <?php
                    $shops=mysqli_query($con,"SELECT * FROM `shop` where `userID`='".$listing['userID']."' ");      
                    $shop = mysqli_fetch_array($shops);
                ?>
                <?php if(isset($shop['id']) && $shop['name']!=''){ ?>
                <tr>
                    <td>Shop:</td>
                    <td><?php echo $shop['name']; ?></td>
                </tr>
                <?php } ?>
                <?php if(isset($shop['id']) && $shop['street']!=''){ ?>
                <tr>
                    <td>Address:</td>
                    <td><?php if($shop['street']!=''){ echo $shop['street']; } if($shop['city']!=''){ echo ", ".$shop['city']; } if($shop['state']!=''){ echo ", ".$shop['state']; }  ?></td>
                </tr>
                <?php } ?>
                <tr>
                    <td>SKU:</td>
                    <td>#<?php echo $listing['stockNumber']; ?></td>
                </tr>
                <tr>
                    <td>Category:</td>
                     <td>
                        <?php
                            $showCategories=array();
                            $categoryListing=explode(",",$listing['category']);
                            $categories=mysqli_query($con,"SELECT * FROM categories ");      
                            while($category = mysqli_fetch_array($categories)){
                                if(in_array($category['id'], $categoryListing)){ 
                                    array_push($showCategories,$category['name']);
                                }
                            }
                            echo isset($showCategories) ? implode(", ",$showCategories) : '--';
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Weight:</td>
                    <td><?php echo $listing['weight']; ?></td>
                </tr>
                <tr>
                    <td>stock:</td>
                    <td><?php echo $listing['stock']; ?></td>
                </tr>
                <tr>
                    <td>End At:</td>
                    <td><?php echo date("F d, Y", strtotime($listing['end_at'])); ?></td>
                </tr>
                <tr>
                    <td>Additional Information:</td>
                    <td><?php echo $listing['descriptions']; ?></td>
                </tr>
            </table>
        </div>
    </section>
    
    <section class="pd_next-section">
        <h2 class="pd_heading">What's New?</h2>
        <h1 class="pd_subheading">See More Puppies</h1>
        <div class="h_product-grid">
            <?php
                $i=0;
                $listingMores=mysqli_query($con,"SELECT * FROM `listings` where `status`='active' order by id desc ");      
                while($listingMore = mysqli_fetch_array($listingMores)){
                  if($i<4){    
                    $typeMores=mysqli_query($con,"SELECT * FROM `types` where `id`=".$listingMore["type"]." ");      
                    $typeMore = mysqli_fetch_array($typeMores);
            ?>
            <a href="/product-detail/?id=<?php echo $listingMore['id']; ?>">
            <div class="h_product-card">
                <?php if($listingMore['gallery1']!=''){ ?>
                <img src="<?php echo $listingMore['gallery1']; ?>" alt="<?php echo $listingMore['title']; ?>">
                <?php }else{ ?>
                <img src="/wp-content/uploads/2024/05/images.png" alt="<?php echo $listingMore['title']; ?>">
                <?php } ?>
                <h3><?php echo $listingMore['title']; ?></h3>
                <div class="meta">Type: <?php echo $typeMore['name']; ?> | SKU: <?php echo $listingMore['stockNumber']; ?></div>
                <div class="price">$<?php echo $listingMore['price']; ?></div>
            </div>
            </a>
            <?php $i++; } } ?>
        </div>
    </section>
</div>
<?php
get_footer();
?>

<div class="popup-class" id="contactUsPopup" style="display:none;">
    <div class="inner-popup">
        <div class="popup-title">
            <h3>Contact Us <i class="fa fa-times closeModel"></i></h3>
            <form class="billing-address-and-shipping-address formValidationQuery" method="post" id="billing-address">
                <input type="hidden" name="id" value="<?php echo $listing['id']; ?>" />
            <div class="flex-class-popup">
                <div class="flex-class-popup-item flex-class-popup-item-left">
                        <div class="leftSide">
                            <div class="input-blocks input-block01">
                                <label for="firstName">First Name<span>*</span></label>
                                <input type="text" name="firstName" id="firstName" value="" required>
                            </div>
                            <div class="input-blocks input-block01">
                                <label for="lastName">Last Name<span>*</span></label>
                                <input type="text" name="lastName" id="lastName" value="" required>
                            </div>
                            <div class="input-blocks input-block02">
                                <label for="emailAddress">Email<span>*</span></label>
                                <input type="email" name="emailAddress" id="emailAddress" value="" required/>
                            </div>
                        </div>
                        <div class="rightSide">
                            <div class="input-blocks input-block01">
                                <label for="phoneNumber">Phone Number<span>*</span></label>
                                <input type="tel" name="phoneNumber" id="phoneNumber" value="" required>
                            </div>
                            <div class="input-blocks input-block01">
                                <label for="address">Address<span>*</span></label>
                                <input type="text" name="address" id="address" value="" required>
                            </div>
                        </div>
                        <div class="input-blocks input-block02">
                            <label for="description">Description</label>
                            <textarea name="description"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="right-button">
                <input type="submit" name="submit" value="Send Request"/>
            </div>
            </form>
        </div>
    </div> 
</div>

<script>
    jQuery(document).on('click','.productDescriptionMainSingle',function(){
         jQuery('.productDescriptionMainImage').attr('src',jQuery(this).attr('src'));
    });
    jQuery(document).on('click','.pd_button1',function(){
         jQuery('#contactUsPopup').show();
    });
    jQuery(document).on('click','.closeModel',function(){
         jQuery('#contactUsPopup').hide();
    });
<?php if($contactSend=='send'){ ?>
swal('Contact request send successful');
<?php } ?>
</script>
