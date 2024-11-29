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

<style>

.pd_images-sec {
/*     border: 1px solid; */
    display:flex;
    flex-direction:row-reverse;
    justify-content:space-between;
    max-width:690px;
}

.pd_images-sec .pd_horizontal-gallery {
    /* border: 1px solid red; */
    max-width:105px;
    display:flex;
    flex-direction:column;
    justify-content:center;
	margin-right:10px;
}
.pd_images-sec .pd_horizontal-gallery>img {
    margin: 8px 0px !important;
    
}	
.pd_images-sec .pd_horizontal-gallery img{
    width:104px;
}
.pd_images-sec .pd_product-image {
    width: 562px;
    height: 543px;
    border:1px solid #e0e0e0;
	border-radius:5px;
}

.pd_product-details .pd_left-column .vendor-card {
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    padding: 15px;
    display: flex;
    align-items: center;
    gap: 15px;
	max-width: 690px;
	margin-top:17px;
  }

.pd_product-details .pd_left-column .vendor-card img {
   width: 119px;
    height: 119px;
    border-radius: 10%;
    border: 2px solid #b21747;
    object-fit: cover; 
	}

.pd_product-details .pd_left-column .vendor-details {
    flex-grow: 1;
  }

.pd_product-details .pd_left-column .vendor-details h5 {
    margin: 0;
    font-size: 1rem;
    font-weight: 600;
  }

.pd_product-details .pd_left-column .vendor-details p {
    margin: 0;
    color: #6c757d;
    font-size: 0.875rem;
  }

.pd_product-details .pd_left-column .contact-button {
    background-color: #012c4b;
    color: #fff;
    border-radius: 25px;
    padding: 5px 15px;
    font-size: 0.875rem;
  }

.pd_product-details .pd_left-column .rating {
    display: flex;
    align-items: center;
    gap: 5px;
    color: #ffcc00;
    font-size: 1rem;
    font-weight: bold;
  }

.pd_product-details .pd_left-column .bully-certified {
    display: flex;
    align-items: center;
    font-size: 0.875rem;
    color: #6c757d;
	background-color:transparent;
  }
	.pd_product-details .pd_left-column .bully-certified img{
		border:none;
	}
.pd_product-details .pd_left-column .bully-certified img {
    width: 20px;
    height: 20px;
    margin-right: 5px;
  }
	
.pd_buttons .pd_share .ruk-fb {
    background-color: #0B1E3E;
    color: #fff;
    padding: 9px 13px 6px 13px;
    border-radius:25px;
}	
.product-detail-page .pd_right-column .pro-detail-des p {
    color: #808080;
}
.ruk-dog-pro-detail .fa-angle-up.slick-arrow {
    /* border: 1px solid red; */
    width: 30px;
    height:30px;
    border-radius:25px;
    z-index:2;
    position:absolute;
    left:30px;
    color:#0B1E3E;
    font-weight:bold;
    background-color:#EBEDF0;
    padding-top:2px;
    font-size:20px;
}
.ruk-dog-pro-detail .fa-angle-down.slick-arrow {
      width: 30px;
      height:30px;
      border-radius:25px;
      color:#0B1E3E;
    font-weight:bold;
    background-color:#EBEDF0;
  padding-top:4px;
  position:absolute;
  top:90%;
  left:30px;
  font-size:20px;
}	
@media only screen and (max-width: 1440px) {
.product-detail-page {
    padding-top: 14px;
}
.product-detail-page .pd_button2 {
    padding: 10px 30px;
    margin-right: 10px;
    border-radius: 50px;
    font-size: 16px;
    background-color: #003459;
    color: #fff;
    text-decoration: none;
    height: 43px;
}	
.product-detail-page .pd_share {
     margin-top: 0px;
}
	
.product-detail-page .pd_price {
    margin-bottom: 12px;
}
.product-detail-page .pd_product-title {
    line-height: 10px;
	}
.product-detail-page .pd_left-column .pd_product-image img {
	max-height: 500px;
}
.pd_images-sec .pd_product-image {
    width: 562px;
    height: 500px;
}
	
}	

@media screen and (max-width: 425px) {
.pd_images-sec .pd_horizontal-gallery {
    /* border: 1px solid red; */
    max-width: 100% !important;
 }
  .pd_images-sec {    
    display: flex;
    flex-direction: column !important;
  }
  .ruk-dog-pro-detail .fa-angle-up.slick-arrow {
    left: 100% !important;
  }
.ruk-dog-pro-detail .fa-angle-down.slick-arrow {
  left: 0 !important;
  }
   .product-detail-page .pd_left-column .pd_product-image img {
        max-height: 333px !important;
    }
  .pd_images-sec .pd_product-image {
        width: 335px !important;
        height: 348px !important;
    }
  .pd_product-details .pd_left-column .vendor-card img {
    width: 60px !important;
    height: 60px !important;
  }
      .product-detail-page .pd_button2 {
        padding: 4px 10px !important;
        margin-right: 10px;
        border-radius: 50px;
        font-size: 10px !important;
        background-color: #003459;
        color: #fff;
        text-decoration: none;
        height: 24px !important;
    }
  .pd_product-details .pd_left-column .vendor-details h5{
  	font-size:12px !importnt;
  }
  .pd_product-details .pd_left-column .vendor-details p {
    font-size: 8px !important;
    }
  .product-detail-page .pd_product-title {
        line-height: 20px !important;
    }
} 	
	
</style>

    <!-- Slick Slider CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>


<div class="product-detail-page">
	<div class="container-footer">		
    <section class="pd_product-details">
        <div class="pd_left-column">
			<div class="pd_images-sec">				
				<div class="pd_product-image">
					<?php if($listing['gallery1']!=''){ ?>
						<img class="productDescriptionMainImage" src="<?php echo $listing['gallery1']; ?>" alt="<?php echo $listing['title']; ?>">
					<?php } ?>
				</div>
				<div class="pd_horizontal-gallery ruk-dog-pro-detail">
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
			</div>	
			  <div class="vendor-card d-flex align-items-center">
				  <img src="/wp-content/uploads/2024/10/34624378.png" alt="Vendor Image">
				  <div class="vendor-details">
					<h5>John Doe Store</h5>
					<p>Member since July 2021</p>
					<a href="/product-chat/?id=<?php echo $listing['id']; ?>" target="_blank" class="pd_button2">Chat With Us</a>
				  </div>
				  <div class="text-end">
					<div class="rating">
					  <i class="bi bi-star-fill"></i>
					  <span>4.3</span>
					  <small class="text-muted">(490)</small>
					</div>
					<div class="bully-certified mt-1">
					  <img src="/wp-content/uploads/2024/10/certified.png" alt="Certified Badge">
					  <span>Bully Certified</span>
					</div>
				  </div>
				</div>
<!--             <div class="pd_headings">
                <h3 class="pd_heading1">100% Health Guarantee for Dog</h3>
                <h3 class="pd_heading2">100% Guarantee Dog Identification</h3>
            </div> -->
<!--             <div class="pd_share">
                <button class="pd_share-button">Share</button>
                <div class="pd_social-icons"> 
                    <a href="https://www.facebook.com/sharer/sharer.php?u=https://bully.cloudstandly.com/product-detail/?id=<?php echo $listing['id']; ?>" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                    <a href="https://twitter.com/intent/tweet?url=https://bully.cloudstandly.com/product-detail/?id=<?php echo $listing['id']; ?>" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                    <a href="https://www.instagram.com/?url=https://bully.cloudstandly.com/product-detail/?id=<?php echo $listing['id']; ?>" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                    <a href="https://www.youtube.com/?url=https://bully.cloudstandly.com/product-detail/?id=<?php echo $listing['id']; ?>" target="_blank"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>
                </div>
            </div> -->
        </div>
        <div class="pd_right-column">
            <div class="pd_navigation-indicator">
                Home > Dogs > <?php echo $listing['title']; ?>
            </div>
            <h2 class="pd_product-title"><?php echo $listing['title']; ?></h2>
            <div class="pd_price">$<?php echo $listing['price']; ?></div>
						
			<hr>
            <div class="pd_buttons">
<!--                 <button type="button" class="pd_button1" style="cursor:pointer;">Contact Us</button> -->
					<button type="button" class="contact-button btn pd_button1" style="cursor:pointer;">Inquire</button>
				
				<div class="pd_share">
					<button class="pd_share-button">Share item:</button>
					<div class="pd_social-icons"> 
						<a href="https://www.facebook.com/sharer/sharer.php?u=https://bully.cloudstandly.com/product-detail/?id=<?php echo $listing['id']; ?>" target="_blank"><i class="fa fa-facebook ruk-fb" aria-hidden="true"></i></a>
						<a href="https://twitter.com/intent/tweet?url=https://bully.cloudstandly.com/product-detail/?id=<?php echo $listing['id']; ?>" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>
						<a href="https://www.instagram.com/?url=https://bully.cloudstandly.com/product-detail/?id=<?php echo $listing['id']; ?>" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a>
						<a href="https://www.youtube.com/?url=https://bully.cloudstandly.com/product-detail/?id=<?php echo $listing['id']; ?>" target="_blank"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>
					</div>
            	</div>				
            </div>
			<hr>
			<div class="pro-detail-des">
				<p><?php echo $listing['descriptions']; ?></p>
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
                    <td>Category:</td>
                     <td>
                        <?php
						 	$child_category = mysqli_query($con,"SELECT * FROM categories where id='".$listing['category']."'");
						  	$child_category1 = mysqli_fetch_assoc($child_category);
						 
							$top_category = mysqli_query($con,"SELECT * FROM categories where id='".$child_category1['parent_id']."'");
                            $single_category = mysqli_fetch_assoc($top_category);
						 
						 	echo $single_category['name'];
                        ?>
                    </td>
                </tr>
				<tr>
					<td>Sub Category:</td>
					<td>
						<?php
                            $sub_category = mysqli_query($con,"SELECT * FROM categories where id='".$listing['category']."'");
						 	$single_sub_category = mysqli_fetch_assoc($sub_category);
							echo $single_sub_category['name'];
                        ?>
					</td>
				</tr>
				<?php if(isset($listing['gender']) && ($listing['gender'] > 0)){ ?>
					<tr>
						<td>Gender:</td>
						<td>
							<?php
								if($listing['gender'] == '1'){
									echo 'Male';
								}
								if($listing['gender'] == '2'){
									echo 'Female';
								}
							?>
						</td>
					</tr>
				<?php } ?>
				<?php if(isset($listing['gender']) && $listing['gender'] > 0){ ?>
					<tr>
						<td>Age:</td>
						<td><?php echo $listing['age']; ?></td>
					</tr>
				<?php } ?>
				<tr>
					<td>Location:</td> 
					<td><?php echo isset($listing['city']) ? $listing['city'] : '--'; ?></td>
				</tr>				
<!--                 <tr>
                    <td>Additional Information:</td>
                    <td><?php echo $listing['descriptions']; ?></td>
                </tr> -->
            </table>
        </div>
    </section>
    
	 <section class="pd_next-section">
		<div class="see-more-heading">
        <h1 class="pd_subheading">Our lovely costumers </h1>
		<a href="#" class="see-more-all-btn">See All</a>
		</div>
        <div class="h_product-grid pro-detail-gallery">
        	<div class="gallery-img">
			 <img src="/wp-content/uploads/2024/10/pro-detail-g1.png" alt="gallery-img"> 
			</div>
        	<div class="gallery-img">
			 <img src="/wp-content/uploads/2024/10/pro-detail-g2.png" alt="gallery-img"> 
			</div>
        	<div class="gallery-img">
			 <img src="/wp-content/uploads/2024/10/pro-detail-g3.png" alt="gallery-img"> 
			</div>
        	<div class="gallery-img">
			 <img src="/wp-content/uploads/2024/10/pro-detail-g4.png" alt="gallery-img"> 
			</div>				
        </div>
    </section>	
		
		
		
    <section class="pd_next-section">
		<div class="see-more-heading">
        <h1 class="pd_subheading">See More Puppies</h1>
		<a href="#" class="see-more-all-btn">See All</a>
		</div>
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
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

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
	
	
$(document).ready(function(){	
        $('.ruk-dog-pro-detail').slick({
            centerMode: true,			
            centerPadding: '60px',
            slidesToShow: 3,
            slidesToScroll: 1,
            autoplay: false,
            autoplaySpeed: 2000,
            arrows: true,
			nextArrow: '<i class="fa fa-angle-down"></i>',
		    prevArrow: '<i class="fa fa-angle-up"></i>',
			dots: false,
			vertical: true,
			 responsive: [                
				{
                    breakpoint: 1124,
                    settings: {
                        slidesToShow: 3
                    }
                },
                {
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 2,
						vertical: false 
                    }
                },
                
                {
                    breakpoint: 576,
                    settings: {
                        slidesToShow: 2,
						 vertical: false 
                    }
                }
            ]
        });
	
	
    });	




	
	
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
