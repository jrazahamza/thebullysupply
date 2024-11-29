<?php
/**
 * Template Name: Home
 * Description: A custom template for the home page
 */
get_header();

include ('connection.php');


// Custom query arguments to fetch blog posts
$args = array(
    'post_type' => 'post',       // Fetch only blog posts
    'posts_per_page' => 4,      // Number of posts per page
    'orderby' => 'date',         // Order by date
    'order' => 'DESC',           // Order in descending order
);

// The custom query
$custom_query = new WP_Query($args);
$subSiteUrl = get_site_url();
?>
<style>
@font-face {
  font-family: 'Novaklasse';
  src: url('/wp-content/themes/amtopm-child/fonts/novaklasse-semibold.otf');
  font-weight: normal;
  font-style: normal;
}
/* main banner section */
.bully-main-banner {    
    background-color: #011b34;
    color: #fff;
    display:flex;
    justify-content:space-between;
}
.slick-track{
/* 	width: 100% !important; */
/* 	transform: translate3d(30px, 0px, 0px) !important; */
}
.slick-track{
	margin-left: 0 !important;
}
.scape-line {
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
    width: 100%;
}
.bully-main-banner .main-banner-signle-img {
    width:31vw;
}
.ruk-bull-banner-3 .main-banner-signle-img {
    width:55vw;
}
	
.bully-main-banner .main-banner-signle-img img {
    height: 100%;
	width: 100%;
}
.small-de-img {
    display: none;
}
@media screen and (max-width: 1024px) {  
.bully-main-banner .main-banner-content {
  width: 50vw;
 }
 .ruk-bull-banner-3 {
        height: 240px;
 }    
.ruk-bull-banner-3 {
    display: flex;
    align-items: center;
}
.bully-main-banner .main-banner-heading {
  font-size: 25px !important;
  }  
.small-de-img {
    display: inline;
}  
.lage-de-img {
    display: none;
}
.bully-main-banner .banner-content {
        width: 100% !important;
  } 
  .bully-main-banner .main-banner-content {
        width: 100% !important;
    	margin-left: 0px !important;
    }
}  

@media screen and (max-width: 425px) {  
.ruk-bull-banner-3 {
    display: flex;
    flex-direction: column-reverse;
    align-items: center;
    height: 300px !important;
}

.bully-main-banner .main-banner-heading {
  font-size: 25px !important;
  text-align: center;
  margin-top: 20px;
  }  
.small-de-img {
    display: inline;
}  
.lage-de-img {
    display: none;
}
.bully-main-banner .banner-content {
        width: 100% !important;
  		display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
  } 
  .bully-main-banner .main-banner-content {
        width: 100% !important;
    	margin-left: 0px !important;
    }
 .ruk-bull-banner-3 .banner-link {
    display: none;
  }
  
  
  
}  
	
.bully-main-banner .main-banner-content {
    width: 70vw;
    display: flex;
    align-items: center;
	margin-left:28px;
}
.bully-main-banner .main-banner-heading {
    color: #fff;
    font-size: 36px;
    width:100%;
    font-family: Novaklasse;
}
.banner-content .bully-banner-text{
		font-size:12px;
}
.cta-heading-dve {
    margin-top: 20px;
}	
/* end of main banner sec	 */
.ruk-bully-container{
  width:1405px;
  margin:0 auto;
}
/* category list */
.category-card-row {
    display: grid;
	grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
	gap:24px;
}

.category-card-row .category-card a {
    margin-bottom:-18px;
}	
#sb_instagram #sbi_images {
    display: grid;
    width: 100%;
    padding: 0 !important;
}	
@media screen and (min-width: 1441px) {
/* category list */
.category-card-row {
    display: grid;
	grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
	gap:24px;
}
	
	
}  

@media screen and (max-width: 425px) {  
.category-card-row {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(170px, 1fr)) !important;
	gap: 12px;
 }
.category-title {
    font-weight: 600;       
    font-size: 16px !important;
  }  
}  	
	
.cta-heading {
    font-size: 17px;
    font-family: Manrope !important;
    margin-top: 24px;
    margin-bottom:20px;
	font-weight:700;
}	
.category-card {
/*     background-color: #001F3F; */
    border-radius: 5px;
    padding: 40px 20px;
    color: white;
    text-align: center;
    position: relative;
    overflow: hidden;    
    height: 180px;
	background-image: url(/wp-content/uploads/2024/11/Food-And-Supplements.png);
    background-repeat: no-repeat;
    background-size: cover;
	display:flex;
	justify-content:center;
	align-items:flex-end;
}
.category-title {
    font-weight: 700;
    z-index: 2;
    position: relative;
    top: 71%;
    color: #fff;
    font-size: 22px;
    font-family: Novaklasse !important;
/*     width: 50%; */
    text-align: center;
	padding:0px 5px;
}

/* .circle-overlay {
    position: absolute;
    bottom: -30px;
    right: -30px;
    width: 150px;
    height: 150px;
    border-radius: 50%;
    z-index: 1;
}
 */
.red {
    background-color: #A83457; /* Red shade */
}

.blue {
    background-color: #003366; /* Blue shade */
}

/* end of category list */


/* dog listing  */
.ruk-dogs-list-sec{
  margin:40px 0px 0px 0px;
}
.dog-listing-heading{
  display:flex;
  justify-content:space-between;
  align-items:flex-start;
	
}
.dog-listing-heading{	
	margin-bottom:15px;
}		
.dog-listing-heading h2 {
    font-size: 17px;
    font-family: 'Manrope';
	font-weight:800;
}
.dog-listing-heading a{
	color:#0B1E3E;
	font-family:'Manrope';
	font-size:12px;

}
.ruk-dog-card-row{
  display:flex;
  justify-content:space-between;
  margin-top:10px;
}
.ruk-dog-card-row .dog-card {
    max-width: 303px;
	height: auto;
    border:1px solid #EAEAEA;
  	border-radius:5px;
}
.ruk-dog-card-row .dog-card img {
    object-fit: cover;
    height: 180px !important;	
/*     padding: 10px; */
}
.box-link{
    list-style: none;
    text-decoration: none;
    color: black;
}
.ruk-dog-card-row .col-md-3 {
    margin: 0px;
    padding: 0px;
    gap:0px;
}
.ruk-dog-card-row {
    width: 100%;
    margin: 0;
}	
.dog-card img {
    width: 100%;
    height: auto;
}
.dog-card-body {
    padding: 14px 12px 4 12;
	text-align: left;
}
.dog-title {
    font-size: 15px;
    font-weight: 700;
    margin-bottom: 0px;
	font-family:Manrope;
}

.dog-category {
    color: #555;
    font-size: 12px;
	padding:0px;
	font-family:Manrope;
	margin-bottom:0px;
}

.dog-price {
    font-size: 15px;
    font-weight: bold;
    padding: 0px;
    margin-top: 5px;
    color: #8B1339;
	font-family:Manrope;
}
.slick-slider-1 .slick-next:before,.slick-slider-1 .slick-prev:before{
    color: #fffefe;
    padding: 20px 0px;
    background-color: #00000063;
}
.ruk-dog-card-row .slick-list{
    padding:0px 80px 0px 0px !important;
}

.ruk-dog-card-row .fa-angle-left.slick-arrow {
    position: absolute;
    top: 35%;
    left: 0%;
    z-index: 99;
      border: 1px solid #EAEAEA;
    padding: 20px 6px;
    background-color:#ffffffd9;
	width:24px;
}

.ruk-dog-card-row .fa-angle-right.slick-arrow {
    position: absolute;
    top: 35%;
    right: 10px;
      border: 1px solid #EAEAEA;
    padding: 20px 6px;
    background-color:#ffffffd9;
	width:24px;
}
.ruk-dog-card-row .slick-slide > div {
  margin: 0 10px;
}
.ruk-dog-card-row .slick-list {
  margin: 0 -10px;
}
.slick-slider .slick-slide {
  padding: 0 10px !important;
}
/* end of slick slider */
/* end of dog listing */
/* 	shop banner  */
	
.shops-section {
/*     gap: 19px; */
	 margin-top: 40px;
}
/* the slides */
.shops-section .slick-slide {
      margin: 0 20px !important;
  }

  /* the parent */
.shops-section .slick-list {
      margin: 0 -20px !important;
  }	
	
.shops-section h2 {
    font-size: 18px;
    font-family: 'Manrope';
    color: #121212;
}
.shop {
    border-radius: 5px;
    color: #fff;
    padding: 0;
    padding-left: 25px;
	background-image:url('/wp-content/uploads/2024/11/1321316307.png');
	background-repeat:no-repeat;
	background-size:cover;
	height:231px !important;
	display:flex;
	background-position: center center;
}
@media screen and (max-width: 1440px) {
	.shop {
		height: 182px !important;
}
}
@media screen and (max-width: 1366px) {
.shop {
		padding-left: 0px !important;
}
.shop-heading p {
 margin-right:36px;	
}	
}  

	
.ruk-col.shop {
    width: 32%;
}
.shop-center-banner {
	background-image:url('/wp-content/uploads/2024/11/1321316308.png') !important;
	background-repeat:no-repeat;
	background-size:cover;
	height:190px;
	display:flex;
	background-position: center center;
}	
.show-heading h2 {
    font-size: 17px;
    font-family: 'Manrope';
    font-weight: 700;
	margin-bottom:20px;
}
.shop-heading {
/*     width: 206px !important;	 */
	width: 178px !important;
	padding-left:0px !important;
	
}
@media screen and (max-width: 1366px) {
.shops-section .shop-card-content {
    margin-left: 12px;
}
} 

.shop-heading h1{
    font-size: 25px;
    font-weight: 700;
}
.shop-heading p {
    font-size: 11px;
    font-weight: 400;
    color: #E0E4E8;
	line-height:16px;
	
}
.shop-banner-listing {
    display: flex;
    justify-content: space-between;
}	
.shop-card-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
	height:100%;
}

.shop-heading h1 {
    color: #fff;
    font-family:Novaklasse;
    font-size:19px;
  line-height: 24px;
}

.shop-img img{
margin-bottom:-9px;
}
.shop-center-banner .shop-img img {
    margin-top:4px;
}
	
/* 	end of shop banner */
/* banner 3 */
.ruk-bull-banner-3 {
    background-image: url(https://thebullysupply2.hailogics.com/wp-content/uploads/2024/11/Layer-0546458.jpg) !important;
    background-size:cover;
    background-repeat:no-repeat;
    background-position:center center;
	margin-top:40px;
	height:390px;
}	
@media only screen and (max-width: 1440px) {
.ruk-bull-banner-3 {
     height: 340px;
	}
}
.banner-content .banner-link {
    padding: 4px 18px;
    color:#fff;
    background-color: #8f1739 !important;
    border-radius:5px;
    border-bottom:1px solid #fff;
	font-size:11px;
}	
/* bully banner 4	 */
	
.bully-care-and-service {
  gap: 19px;
  margin-top: 40px;
  display: flex;
/*   margin-bottom: 40px; */
}

@media screen and (max-width: 1024px) {  
.bully-care-and-service {
      flex-direction: column;
  }
.bully-care-and-service .bully-dog {
    width: 100%;
    height: 310px;
}
.bully-care-and-service .bully-dog1 {
    width: 100%;
    height: 310px;
}  
}
.bully-dog {
  color: #fff;
  padding-right: 0;
  border-radius: 5px;
  background-image: url(https://thebullysupply2.hailogics.com/wp-content/uploads/2024/11/Care-And-Services-Banner-1.png);
  background-size: cover;
  background-repeat: no-repeat;
  background-position: right center;
	flex-grow: 1;
  display: flex;
  justify-content: flex-start;
  align-items: center;
}

.bully-dog-heading {
  padding-left: 48px;
  border-radius: 5px;
	width:338px;
}
.bully-dog-heading h1 {
  font-size: 33px;
  font-weight: 600;
	line-height: 52px;
}
.bully-dog-heading p {
  font-size: 12px;
  font-weight: 500;
  color: #E0E4E8;
  max-width: 240px;
	font-family:Manrope;
}

.bully-care-and-service{
  width:100%;
}

.bully-dog {
    width: 56%;
    height:360px;
}

.bully-dog1 {
    width: 44%;
    height: 360px;
}
.bully-dog-heading h1 {
    font-size: 36px;
    font-family: Novaklasse;
    font-weight: 600;
    color: #fff;
	line-height:46px;
}	
.bully-dog1 {
  color: #fff;
  border-radius: 5px;
  padding-right: 0;
  background-image: url(https://thebullysupply2.hailogics.com/wp-content/uploads/2024/11/Group-1321316314.png);
  background-repeat: no-repeat;
  background-size: cover;
  background-position: right center;	
  display: flex;
  align-items: center;
  flex-shrink: 99;
}

.bully-dog-heading1 {
    padding-left: 18px;
    border-radius: 5px;
	width:270px;
}
.bully-dog-heading1 h1 {
font-size: 36px;
    font-family: Novaklasse;
    font-weight: 600;
    /* max-width: 212px; */
    color: #fff;	
}
.bully-dog-heading1 p {
font-size: 12px;
font-weight: 500;
font-family: 'Manrope';
color: #E0E4E8;
max-width: 240px;
}

.bully-dog-img1 img {
border-radius: 5px;
}
/* 	end of bully banner 4 */	
/* bully blog section	 */
.thebully-blog-page {
    margin-top: 40px;
}
.bully-blog-main-heading .buly-heading {
    font-size: 17px;
    font-family: 'Manrope';
    font-weight: 800;
	text-transform:uppercase;
}	
.blog-post-dev {
    border: 1px solid #EAEAEA;
/* 	max-width: 24%; */
	padding: 0;
    border-radius: 5px;
}
	

.list-blog-post {
    display: grid;
	grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
	gap:20px;
}
/* .list-blog-post > div:not(:first-child) {
    margin-left:16px;
} */

.bully-main-banner .safari-height {
	height: 50vh !important; /* Adjust for Safari */			
}	
.bully-home-top-banner .small-screen{
 display:none;
}
@media screen and (max-width: 1024px) {
.bully-main-banner .safari-height {
        max-height: 26vh !important;
 }

}  


@media screen and (max-width: 425px) {
.bully-home-top-banner {
    display: flex;
    flex-direction: column-reverse;
}  
.bully-home-top-banner .small-screen{
 display:inline;
  width: 284px !important;
}  
.large-screen{
  display:none;
  }
.bully-home-top-banner .banner-content {
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
    align-items: flex-start;
    margin-left:20px;
}

.bully-home-top-banner .main-banner-heading {
  text-align: left !important;
  padding-right: 80px;
}
.bully-home-top-banner .bully-banner-text {
    padding-right: 50px;
}
  
}  
	
@media screen and (max-width: 1440px) {
	.bully-main-banner .safari-height {
		height: 48vh !important; /* Adjust for Safari */
	}
	.bully-main-banner .banner-content {
    width: 64vw;
	}	
}
@media screen and (min-width: 1560px) {
.list-blog-post {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(290px, 1fr));
	gap:20px;
} 
}  	
.blog-post-dev .img-dv img {
    width: 100% !important;
    
}	
.thebully-blog-page .blog-post-dev .blog-content {
    padding: 16px 9px;
}
.thebully-blog-page .blog-post-dev .blog-post-img{
    min-width: 100%;
    border-radius:5px 5px 0px 0px;
  height: 220px;
}
.blog-post-dev .post-tile {
    color: #000;
    font-size: 14px;
    font-weight: bold;
	font-family:Manrope !important; 
}
.blog-content .blog-post-heading {
    font-size: 16px;
    font-family:Manrope !important; 
   color:#00171F; 
}	
.blog-post-dev .blo-post-description {
    display: none;
}
.blog-post-dev .blog-content p {
    color: #686868;
    font-size:11px;
	line-height:17px;
    padding: 0;
    margin: 0px;
	font-family:Manrope;
}	
	
.list-blog-post {
/*     display: flex; */
/*     justify-content: space-between; */
}	
/* 	end of bully blog post */	
/* instagram-feed-sec */
.instagram-feed-sec {
    margin-top: 40px;
}	

.bully-q-mark small{
    padding:1px 4px;
    margin:0px;
    border-radius:25px;
    background-color:#000;
    color:#fff;
    font-size:10px;
}
.bully-q-mark small{
  position: relative;
  display: inline-block;
  cursor: pointer;
  top: -3px;	
}
.bully-q-mark .tooltip {
  visibility: hidden;
/*   background-color: #fff; */
 background-image:url(/wp-content/uploads/2024/11/1321316327aaw.png);
  border-right:1px solid #eaeaea;
	background-repeat:no-repeat;
	background-size:cover;
  color: #000;
  text-align: center;
  padding: 5px;
  border-radius: 3px;
  position: absolute;
  bottom: -6px; /* Position above the element */
  left: 160px;
  transform: translateX(-50%);
  white-space: nowrap;
  z-index: 10;
  opacity: 0;
  transition: opacity 0.3s;
  width:296px;
  height:48px;
}
.bully-q-mark .tooltip p{
  color:#667479;
  font-size:10px;
  line-height: 18px;
}
.bully-q-mark small:hover .tooltip {
  visibility: visible;
  opacity: 1;
}	
.thebully-blog-page .blog-post-dev .blog-post-img {
    min-width: 100%;
    border-radius: 10px 10px 0px 0px;
    height: 162px;
    object-fit: cover;
    object-position: 100% 2%;
}	
@media only screen and (max-width: 1440px) {
  .ruk-bully-container{
  max-width:84vw;
    margin:0 autop;
  }
}	
</style>
    <!-- Slick Slider CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
	<!-- 	fonts	 -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
	<section class="bully-main-banner bully-home-top-banner">
	<div class="main-banner-signle-img safari-height">	
	<img src="/wp-content/uploads/2024/11/main-home-banner.png" class="large-screen" alt=""/> 
	<img src="/wp-content/uploads/2024/11/Website-Main-Banner-Optionh-2-1.png" class="small-screen" alt=""/> 	
	</div>				
	<div class="main-banner-content">	
		<div class="banner-content">
			<h1 class="main-banner-heading">Ready To Give A Bully A Forever Home?</h1>
			<p class="bully-banner-text">Join our community of proud bully parents and find you new best friend!</p>
		</div>
	</div>					
	</section>

    <!-- Category Section -->
     <section class="ruk-bully-container">
		 <div class="cta-heading-dve">			 
             <h2 class="cta-heading">Explore Popular Categories</h2>			 
		 </div>
        <div class="category-card-row">
            <div class="ruk-col-md-3">
                <div class="category-card">
                    <div class="circle-overlay red"></div>
					<a href="<?php echo esc_url($subSiteUrl . '/category/?search_sub_category=Bullies'); ?>"><h3 class="category-title"> Bullies</h3></a>
                </div>
            </div>
            <div class="ruk-col-md-3">
                <div class="category-card">
                    <div class="circle-overlay blue"></div>
                    <a href="<?php echo esc_url($subSiteUrl . '/category/?search_supplies_category=supplies_categories'); ?>"><h3 class="category-title">Supplies</h3></a>
                </div>
            </div>
            <div class="ruk-col-md-3">
                <div class="category-card">
                    <div class="circle-overlay red"></div>
                    <a href="<?php echo esc_url($subSiteUrl . '/category/?search_care_services=care_services'); ?>"><h3 class="category-title">Care & Services</h3></a>
                </div>
            </div>
            <div class="ruk-col-md-3">
                <div class="category-card">
                    <div class="circle-overlay blue"></div>
                    <a href="<?php echo esc_url($subSiteUrl . '/category/?search_food_and_supplement=food_and_supplement'); ?>"><h3 class="category-title">Food & Supplements</h3></a>
                </div>
            </div>
        </div>
    </section>

    <!-- Dog Listings Section 1-->
     <section class="ruk-dogs-list-sec">
       <div class="ruk-bully-container">
       <div class="dog-listing-heading remo-ex-space">
			   <h2 class="text-uppercase fw-bold">Take a Look at Some of Our Bullies <span class="bully-q-mark"><small>? <div class="tooltip"><p>Lorem Ipsum is simply dummy text of the printing and <br>typesetting industry. Lorem Ipsum has been the</p></div></small> </span></h2> 	
            <a href="<?php echo esc_url($subSiteUrl . '/category/?search_sub_category=Bullies'); ?>" class="text-dark text-decoration-none fw-semibold">See All</a>
        </div>
     
        <div class="row g-4 ruk-dog-card-row">
            <!-- Dog Card 1 -->
			<?php

			$bullies_categories = mysqli_query($con, "SELECT id FROM `categories` WHERE `status` = '1' AND `parent_id` = '33' ORDER BY id DESC");

			   // Initialize an empty array to store the IDs
			   $bullies_category_ids = [];

			   // Fetch the IDs and store them in the array
			   while ($row = mysqli_fetch_assoc($bullies_categories)) {
				   $bullies_category_ids[] = $row['id'];
			   }
			
				if(count($bullies_category_ids)>0){
					$category_ids = implode(',', $bullies_category_ids);

					$listings = mysqli_query($con, "SELECT a.*, b.name AS category, a.price 
														FROM listings a 
														LEFT JOIN categories b ON a.category = b.id 
														WHERE a.status = 'active' 
														AND a.category IN ($category_ids) 
														ORDER BY RAND() 
														LIMIT 20");
					while ($listing = mysqli_fetch_array($listings)) {?>
						<div class="dog-list-col">
							<a href="/product-detail/?id=<?php echo @$listing['id']; ?>" class="box-link">
								<div class="dog-card">
								<img src="<?php echo !empty($listing['gallery1']) ? $listing['gallery1'] : 'https://thebullysupply.com/wp-content/uploads/2024/11/No_Image_Available.jpg'; ?>" alt="<?= htmlspecialchars($listing['title']); ?>" class="img-fluid rounded">

									<div class="dog-card-body">
										<h3 class="dog-title scape-line"><?= htmlspecialchars($listing['title']); ?></h3>
										<p class="dog-category scape-line">Category: <?= htmlspecialchars($listing['category']); ?></p>
										<p class="dog-price">$<?= htmlspecialchars(number_format($listing['price'], 2)); ?></p>
									</div>
								</div>
							</a>
						</div>
					<?php }} ?>
         	</div>
        </div>
    </section>

<!-- Dog Listings Section 2-->
 	<section class="ruk-dogs-list-sec remo-ex-space3">
       <div class="ruk-bully-container">
       <div class="dog-listing-heading remo-ex-space">
            <h2 class="text-uppercase fw-bold">Take a look at some of our featured products <span class="bully-q-mark"><small>? <div class="tooltip"><p>Lorem Ipsum is simply dummy text of the printing and <br>typesetting industry. Lorem Ipsum has been the</p></div></small> </span></h2>
        </div>
     
        	<div class="row g-4 ruk-dog-card-row">
				
			<?php

				$promotion_listings = mysqli_query($con, "SELECT a.id as productID, a.gallery1 as gallery1, a.title as productTitle, 
											a.price as productPrice, a.category as categoryID, b.*
										FROM listings a 
										LEFT JOIN productPromotionStore b ON a.id = b.product 
										WHERE a.status = 'active' AND b.paid = 1 AND b.status = 1 
										ORDER BY RAND() 
										LIMIT 20");
				while ($promotion_listing = mysqli_fetch_array($promotion_listings)) {
					
					$promotion_listing_category = mysqli_query($con, "SELECT name FROM categories WHERE id = '".$promotion_listing['categoryID']."'");
					
					 $cate = mysqli_fetch_assoc($promotion_listing_category);       
				?>
            	<div class="col-md-3">
					<a href="/product-detail/?id=<?php echo @$promotion_listing['productID']; ?>" class="box-link">
						<div class="dog-card">
							<img src="<?php echo !empty($promotion_listing['gallery1']) ? $promotion_listing['gallery1'] : 'https://thebullysupply.com/wp-content/uploads/2024/11/No_Image_Available.jpg'; ?>" alt="<?= htmlspecialchars($promotion_listing['productTitle']); ?>" class="img-fluid rounded">
							<div class="dog-card-body">
								<h3 class="dog-title scape-line"><?= $promotion_listing['productTitle'] ? htmlspecialchars($promotion_listing['productTitle']) : '- -'; ?></h3>
								<p class="dog-category scape-line">Category: <?= $cate['name'] ? htmlspecialchars($cate['name']) : '- -'; ?></p>
								<p class="dog-price">$<?= $promotion_listing['productPrice'] ? htmlspecialchars(number_format($promotion_listing['productPrice'], 2)) : '0'; ?></p>
							</div>
						</div>
					</a>
            	</div>
            <?php } ?>	
          </div>
        </div>
    </section>


<!-- Dog Listings Section 3-->
     <section class="ruk-dogs-list-sec">
       <div class="ruk-bully-container">
       <div class="dog-listing-heading remo-ex-space2">
            <h2 class="text-uppercase fw-bold">Take a look at some of our Breeders <span class="bully-q-mark"><small>? <div class="tooltip"><p>Lorem Ipsum is simply dummy text of the printing and <br>typesetting industry. Lorem Ipsum has been the</p></div></small> </span></h2>
            <a href="<?php echo esc_url($subSiteUrl . '/category/?search_sub_category=Breeders'); ?>" class="text-dark text-decoration-none fw-semibold">See All</a>
        </div>
     
        <div class="row g-4 ruk-dog-card-row">
            <!-- Dog Card 1 -->
			
			<?php
			$breeders_categories = mysqli_query($con, "SELECT id FROM `categories` WHERE `status` = '1' AND `parent_id` = '36' ORDER BY id DESC");

			// Initialize an empty array to store the IDs
			$breeders_category_ids = [];

			// Fetch the IDs and store them in the array
			while ($row = mysqli_fetch_assoc($breeders_categories)) {
				$breeders_category_ids[] = $row['id'];
			}

			if(count($breeders_category_ids)>0){
				$category_ids1 = implode(',', $breeders_category_ids);

				$listings1 = mysqli_query($con, "SELECT a.*, b.name AS category, a.price 
										FROM listings a 
										LEFT JOIN categories b ON a.category = b.id 
										WHERE a.status = 'active' AND a.category IN ($category_ids1)
										ORDER BY RAND() 
										LIMIT 20");
				while ($listing1 = mysqli_fetch_array($listings1)) {?>

					<div class="col-md-6">
						<a href="/product-detail/?id=<?php echo @$listing1['id']; ?>" class="box-link">
							<div class="dog-card">
								<img src="<?php echo !empty($listing1['gallery1']) ? $listing1['gallery1'] : 'https://thebullysupply.com/wp-content/uploads/2024/11/No_Image_Available.jpg'; ?>" alt="<?= htmlspecialchars($listing1['title']); ?>" class="img-fluid rounded">
								<div class="dog-card-body">
									<h3 class="dog-title scape-line"><?= htmlspecialchars($listing1['title']); ?></h3>
									<p class="dog-category scape-line">Category: <?= htmlspecialchars($listing1['category']); ?></p>
									<p class="dog-price">$<?= htmlspecialchars(number_format($listing1['price'], 2)); ?></p>
								</div>
							</div>
						</a>
					</div>
				<?php }} ?>			
          </div>
        </div>
    </section>


    <!-- Shop Section -->
	<div class="ruk-bully-container">
	   <div class="row shops-section">
		   <div class="show-heading">
        	<h2>SHOPS <span class="bully-q-mark"><small>? <div class="tooltip"><p>Lorem Ipsum is simply dummy text of the printing and <br>typesetting industry. Lorem Ipsum has been the</p></div></small> </span></h2>
	     </div>
		  <div class="shop-banner-listing">			  
        <div class="ruk-col shop">
          <div class="shop-card-content">
            <div class="shop-heading">
              <h1>Exciting News</h1>
              <p>
                More food stores are joining the pack! Stay tuned for fresh
                choices
              </p>
            </div>
<!--             <div class="col shop-img">
              <img src="https://thebullysupply2.hailogics.com/wp-content/uploads/2024/11/dog-food.png" alt="" />
            </div> -->
          </div>
        </div>

        <div class="ruk-col shop shop-center-banner">
          <div class="shop-card-content">
            <div class="shop-heading">
              <h1>Welcome To The Bully Supply Store!</h1>
              <p>
 				Sniff out the perfect food for your pup’s happy, healthy life!
              </p>
            </div>
<!--             <div class="col shop-img">
              <img src="https://thebullysupply2.hailogics.com/wp-content/uploads/2024/11/dog-food-shop.png" alt="" />
            </div> -->
          </div>
        </div>
			  
        <div class="ruk-col shop">
          <div class="shop-card-content">
            <div class="shop-heading">
              <h1>Want The Spotlight?</h1>
              <p>
                Feature your store here for the ultimate bully community
                exposure!
              </p>
            </div>
<!--             <div class="col shop-img">
              <img src="https://thebullysupply2.hailogics.com/wp-content/uploads/2024/11/dog-food.png" alt="" />
            </div> -->
          </div>
        </div>
			  
		</div>
      </div>
	</div>
<!-- 	end of shop sec -->


<!-- Dog Listings Section 3-->
     <section class="ruk-dogs-list-sec">
       <div class="ruk-bully-container">
       <div class="dog-listing-heading">
            <h2 class="text-uppercase fw-bold">Recently added <span class="bully-q-mark"><small>? <div class="tooltip"><p>Lorem Ipsum is simply dummy text of the printing and <br>typesetting industry. Lorem Ipsum has been the </p></div></small> </span></h2>
        </div>
     
        <div class="row g-4 ruk-dog-card-row">
            <!-- Dog Card 1 -->
			
			<?php
				$listings2 = mysqli_query($con, "SELECT a.*, b.name AS category, a.price 
													FROM listings a 
													LEFT JOIN categories b ON a.category = b.id 
													WHERE a.status = 'active' 
													AND a.created_at >= NOW() - INTERVAL 1 WEEK 
													ORDER BY RAND() 
													LIMIT 20");
				while ($listing2 = mysqli_fetch_array($listings2)) {?>
			
					<div class="col-md-6">
						<a href="/product-detail/?id=<?php echo @$listing2['id']; ?>" class="box-link">
							<div class="dog-card">
								<img src="<?php echo !empty($listing2['gallery1']) ? $listing2['gallery1'] : 'https://thebullysupply.com/wp-content/uploads/2024/11/No_Image_Available.jpg'; ?>" alt="<?= htmlspecialchars($listing2['title']); ?>" class="img-fluid rounded">
								<div class="dog-card-body">
									<h3 class="dog-title scape-line"><?= htmlspecialchars($listing2['title']); ?></h3>
									<p class="dog-category scape-line">Category: <?= htmlspecialchars($listing2['category']); ?></p>
									<p class="dog-price">$<?= htmlspecialchars(number_format($listing2['price'], 2)); ?></p>
								</div>
							</div>
						</a>
					</div>
			<?php } ?>			
          </div>
        </div>
    </section>



<!-- banner 3 -->
<div class="ruk-bully-container">	
	<section class="bully-main-banner ruk-bull-banner-3">
		<div class="main-banner-signle-img">	
		<img src="/wp-content/uploads/2024/11/Background544456-1.jpg" class="lage-de-img" alt=""/> 
		<img src="/wp-content/uploads/2024/11/Main-Banner-441-2.png" class="small-de-img" alt=""/> 	
		</div>				
		<div class="main-banner-content">	
			<div class="banner-content">
				<h1 class="main-banner-heading">Want Top Spot?</h1>
				<p class="bully-banner-text">Lead The Pack & Feature your product Here!</p>
				<a href="#" class="banner-link">Get Featured</a>
			</div>
		</div>					
	</section>		
</div>


<!-- Dog Listings Section 3-->
     <section class="ruk-dogs-list-sec">
       <div class="ruk-bully-container">
       <div class="dog-listing-heading">
            <h2 class="text-uppercase fw-bold">Take a look at some of our Supplies <span class="bully-q-mark"><small>? <div class="tooltip"><p>Lorem Ipsum is simply dummy text of the printing and <br>typesetting industry. Lorem Ipsum has been the </p></div></small></span></h2>
            <a href="<?php echo esc_url($subSiteUrl . '/category/?search_supplies_category=supplies_categories'); ?>" class="text-dark text-decoration-none fw-semibold">See All</a>
        </div>
     
        <div class="row g-4 ruk-dog-card-row">
            <!-- Dog Card 1 -->
			<?php
			$supplies_categories = mysqli_query($con, "SELECT id FROM `categories` WHERE `status` = '1' AND `parent_id` IN (38, 39, 40, 41, 42, 43, 44, 45, 46) ORDER BY id DESC");

				// Initialize an empty array to store the IDs
				$supplies_category_ids = [];

				// Fetch the IDs and store them in the array
				while ($row = mysqli_fetch_assoc($supplies_categories)) {
					$supplies_category_ids[] = $row['id'];
				}

				if(count($supplies_category_ids)>0){
					$category_ids3 = implode(',', $supplies_category_ids);

					$listings3 = mysqli_query($con, "SELECT a.*, b.name AS category, a.price 
											FROM listings a 
											LEFT JOIN categories b ON a.category = b.id 
											WHERE a.status = 'active' AND a.category IN ($category_ids3)
											ORDER BY RAND() 
											LIMIT 20");
					while ($listing3 = mysqli_fetch_array($listings3)) {?>
						<div class="col-md-6">
							<a href="/product-detail/?id=<?php echo @$listing3['id']; ?>" class="box-link">
								<div class="dog-card">
									<img src="<?php echo !empty($listing3['gallery1']) ? $listing3['gallery1'] : 'https://thebullysupply.com/wp-content/uploads/2024/11/No_Image_Available.jpg'; ?>" alt="<?= htmlspecialchars($listing3['title']); ?>" class="img-fluid rounded">
									<div class="dog-card-body">
										<h3 class="dog-title scape-line"><?= htmlspecialchars($listing3['title']); ?></h3>
										<p class="dog-category scape-line">Category: <?= htmlspecialchars($listing3['category']); ?></p>
										<p class="dog-price">$<?= htmlspecialchars(number_format($listing3['price'], 2)); ?></p>
									</div>
								</div>
							</a>
						</div>
				<?php }} ?>			
          </div>
        </div>
    </section>


<!-- Dog Listings Section 3-->
     <section class="ruk-dogs-list-sec">
       <div class="ruk-bully-container">
       <div class="dog-listing-heading">
            <h2 class="text-uppercase fw-bold">Care And services <span class="bully-q-mark"><small>? <div class="tooltip"><p>Lorem Ipsum is simply dummy text of the printing and <br>typesetting industry. Lorem Ipsum has been the</p></div></small> </span></h2>
            <a href="<?php echo esc_url($subSiteUrl . '/category/?search_care_services=care_services'); ?>" class="text-dark text-decoration-none fw-semibold">See All</a>
        </div>
     
        <div class="row g-4 ruk-dog-card-row">
            <!-- Dog Card 1 -->
			<?php
			$care_categories = mysqli_query($con, "SELECT id FROM `categories` WHERE `status` = '1' AND `parent_id` IN (56, 57, 58, 59) ORDER BY id DESC");

					// Initialize an empty array to store the IDs
					$care_category_ids = [];

					// Fetch the IDs and store them in the array
					while ($row = mysqli_fetch_assoc($care_categories)) {
						$care_category_ids[] = $row['id'];
					}

				if(count($care_category_ids)>0){
					$category_ids4 = implode(',', $care_category_ids);

					$listings4 = mysqli_query($con, "SELECT a.*, b.name AS category, a.price 
											FROM listings a 
											LEFT JOIN categories b ON a.category = b.id 
											WHERE a.status = 'active' AND a.category IN ($category_ids4)
											ORDER BY RAND() 
											LIMIT 20");
					while ($listing4 = mysqli_fetch_array($listings4)) {?>
						<div class="col-md-6">
							<a href="/product-detail/?id=<?php echo @$listing4['id']; ?>" class="box-link">
								<div class="dog-card">
									<img src="<?php echo !empty($listing4['gallery1']) ? $listing4['gallery1'] : 'https://thebullysupply.com/wp-content/uploads/2024/11/No_Image_Available.jpg'; ?>" alt="<?= htmlspecialchars($listing4['title']); ?>" class="img-fluid rounded">
									<div class="dog-card-body">
										<h3 class="dog-title scape-line"><?= htmlspecialchars($listing4['title']); ?></h3>
										<p class="dog-category scape-line">Category: <?= htmlspecialchars($listing4['category']); ?></p>
										<p class="dog-price">$<?= htmlspecialchars(number_format($listing4['price'], 2)); ?></p>
									</div>
								</div>
							</a>
						</div>
				<?php }} ?>			
          </div>
        </div>
    </section>

	<div class="ruk-bully-container">
		<div class="bully-care-and-service">
			<div class="bully-dog">
			  <div class="bully-dog-heading">
				<h1>Care You Can Count On!</h1>
				<p>
				  Explore top grooming, Training and Health services for your Bully
				</p>
			  </div>
<!-- 			  <div class="bully-dog-img">
				<img src="https://thebullysupply2.hailogics.com/wp-content/uploads/2024/11/bully-dog.png" alt="" />
			  </div> -->
			</div>

			<div class="bully-dog1">
			  <div class="bully-dog-heading1">
				<h1>Give A Bully A Loving Home</h1>
				<p>
				  They Will return the love unconditionally. Adopt today and make
				  the difference.
				</p>
			  </div>
<!-- 			  <div class="bully-dog-img1">
				<img src="https://thebullysupply2.hailogics.com/wp-content/uploads/2024/11/dog-strips.png" alt="" />
			  </div> -->
			</div>
		</div>

	</div>

<!-- <div class="ruk-dog-card-test">
  <div>your content 1</div>
  <div>your content 2</div>
  <div>your content 3</div>
	<div>your content 4</div>
  <div>your content 5</div>
  <div>your content 6</div>
	<div>your content 7</div>
  <div>your content 8</div>
  <div>your content 9</div>
</div>
		 -->

<!-- Dog Listings Section 3-->
     <section class="ruk-dogs-list-sec">
       <div class="ruk-bully-container">
       <div class="dog-listing-heading">
            <h2 class="text-uppercase fw-bold">Food And Supplements <span class="bully-q-mark"><small>? <div class="tooltip"><p>Lorem Ipsum is simply dummy text of the printing and <br>typesetting industry. Lorem Ipsum has been the</p></div></small></span></h2>
            <a href="<?php echo esc_url($subSiteUrl . '/category/?search_food_and_supplement=food_and_supplement'); ?>" class="text-dark text-decoration-none fw-semibold">See All</a>
        </div>
     
        <div class="row g-4 ruk-dog-card-row">
            <!-- Dog Card 1 -->
			<?php
			$food_categories = mysqli_query($con, "SELECT id FROM `categories` WHERE `status` = '1' AND `parent_id` = '3' ORDER BY id DESC");

					// Initialize an empty array to store the IDs
					$food_category_ids = [];

					// Fetch the IDs and store them in the array
					while ($row = mysqli_fetch_assoc($food_categories)) {
						$food_category_ids[] = $row['id'];
					}

				if(count($food_category_ids)>0){
					$category_ids5 = implode(',', $food_category_ids);

					$listings5 = mysqli_query($con, "SELECT a.*, b.name AS category, a.price 
											FROM listings a 
											LEFT JOIN categories b ON a.category = b.id 
											WHERE a.status = 'active' AND a.category IN ($category_ids5)
											ORDER BY RAND() 
											LIMIT 20");
					while ($listing5 = mysqli_fetch_array($listings5)) {?>
					<div class="col-md-6">
						<a href="/product-detail/?id=<?php echo @$listing5['id']; ?>" class="box-link">
							<div class="dog-card">
								<img src="<?php echo !empty($listing5['gallery1']) ? $listing5['gallery1'] : 'https://thebullysupply.com/wp-content/uploads/2024/11/No_Image_Available.jpg'; ?>" alt="Pomeranian White" class="img-fluid rounded">
								<div class="dog-card-body">
									<h3 class="dog-title scape-line"><?= htmlspecialchars($listing5['title']); ?></h3>
									<p class="dog-category scape-line">Category: <?= htmlspecialchars($listing5['category']); ?></p>
									<p class="dog-price">$<?= htmlspecialchars(number_format($listing5['price'], 2)); ?></p>
								</div>
							</div>
						</a>
					</div>
				<?php }} ?>			
          </div>
        </div>
    </section>

	<section class="instagram-feed-sec">
	<div class="ruk-bully-container">
		 <div class="dog-listing-heading">
            <h2 class="text-uppercase fw-bold">Follow Us On Instagram</h2>
        </div>
		<div class="instagram-row">
       <?php
		// Add this code where you want the Instagram feed to be displayed
		echo do_shortcode('[instagram-feed feed=1]');
		?>
		</div>
		</div>
	</section>



<section class="thebully-blog-page">
	<div class="ruk-bully-container">
		<div class="bully-blog-main-heading">
			<h2 class="buly-heading">Useful pet knowledge <span class="bully-q-mark"><small>? <div class="tooltip"><p>Lorem Ipsum is simply dummy text of the printing and <br>typesetting industry. Lorem Ipsum has been the </p></div></small></span></h2>
		</div>
		<?php if ($custom_query->have_posts()) : ?>
        <div class="list-blog-post">
			 <?php while ($custom_query->have_posts()) : $custom_query->the_post(); ?>
            <!-- blog post -->
            <div class="blog-post-dev">
              <div class="img-dv">
			   <?php if (has_post_thumbnail()) : ?>
						<a href="<?php the_permalink(); ?>">
							<?php the_post_thumbnail('medium', ['class' => 'blog-post-img']); ?>
						</a>
					<?php endif; ?>
				  
				</div>
              <div class="blog-content">
                <h2 class="blog-post-heading"> <a href="<?php the_permalink(); ?>" class="post-tile"><?php the_title(); ?></a></h2>
				  <p><?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?></p>
<!--                 <a href="#" class="btn btn-custom mt-3">Learn More</a> -->
                </div>
            </div>
			<?php endwhile; ?>

			
			<!-- Pagination -->
			<nav aria-label="Page navigation example">
				<ul class="pagination justify-content-center">
					<?php
// 					$pagination_links = paginate_links(array(
// 						'total' => $custom_query->max_num_pages,
// 						'type' => 'array', // Return an array of links
// 						'prev_text' => 'Previous',
// 						'next_text' => 'Next'
// 					));

// 					if ($pagination_links) {
// 						foreach ($pagination_links as $link) {
// 							// Add 'active' class for the current page link
// 							$active_class = strpos($link, 'current') !== false ? 'active' : '';
// 							echo '<li class="page-item ' . $active_class . '">' . str_replace('page-numbers', 'page-link', $link) . '</li>';
// 						}
// 					}
					?>
				</ul>
			</nav>
			
			
        </div>		
		<?php else : ?>
			<p class="text-center">No posts found.</p>
		<?php endif; ?>
	</div>
</section>
 <!-- jQuery and Slick Slider JavaScript -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

<script>
//document.querySelector('.page-id-615').innerHTML = document.querySelector('.page-id-615').innerHTML.replace(/&nbsp;/g, ' ');

$(document).ready(function(){	
        $('.ruk-dog-card-row').slick({
            centerMode: true,
            centerPadding: '60px',
            slidesToShow: 4,
            slidesToScroll: 1,
            autoplay: false,
            autoplaySpeed: 2000,
            arrows: true,
			nextArrow: '<i class="fa fa-angle-right"></i>',
		    prevArrow: '<i class="fa fa-angle-left"></i>',
			dots: false,
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
                        slidesToShow: 2
                    }
                },
                
                {
                    breakpoint: 576,
                    settings: {
                        slidesToShow: 1
                    }
                }
            ]
        });
	
	   $('.shop-banner-listing').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 2000,
            arrows: false,
			dots: false,
			 responsive: [                
				{
                    breakpoint: 1124,
                    settings: {
                        slidesToShow: 2
                    }
                },				 
                {
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 2
                    }
                },
                {
                    breakpoint: 576,
                    settings: {
                        slidesToShow: 1
                    }
                }
            ]
        });

	
		
    });	
	
	
</script>
<?php get_footer(); ?>
