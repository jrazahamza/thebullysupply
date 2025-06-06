<?php 

add_action( 'wp_enqueue_scripts', 'salient_child_enqueue_styles', 100);

function salient_child_enqueue_styles() {
		
		$nectar_theme_version = nectar_get_theme_version();
		wp_enqueue_style( 'salient-child-style', get_stylesheet_directory_uri() . '/style.css', '', $nectar_theme_version );
		
    if ( is_rtl() ) {
   		wp_enqueue_style(  'salient-rtl',  get_template_directory_uri(). '/rtl.css', array(), '1', 'screen' );
		}
}
add_action( 'woocommerce_after_shop_loop_item', 'woo_show_excerpt_shop_page', 5 );
function woo_show_excerpt_shop_page() {
    global $product;
 
    echo "<p>".$product->post->post_excerpt."</p>";
}


// ============
function my_theme_enqueue_styles() {
    wp_register_style('my-custom-style', get_stylesheet_directory_uri() . '/custom.css', array(), '1.0', 'all');
    wp_enqueue_style('my-custom-style');
}
add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles');

// ============
// register main menu
function register_top_nav_menu() {
    register_nav_menus( array(
        'top-nav' => __( 'Top Navigation' ),
    ) );
}
add_action( 'init', 'register_top_nav_menu' );


function enqueue_slick_slider() {
    wp_enqueue_style('slick-css', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css');
    wp_enqueue_style('slick-theme-css', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css');
    wp_enqueue_script('slick-js', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'enqueue_slick_slider');





// Remove default sorting options and add custom ones
function custom_woocommerce_catalog_orderby( $orderby ) {
    // Remove default sorting options
    unset($orderby['popularity']);
    unset($orderby['rating']);

    // Add custom sorting options
    $orderby['date'] = __('Sort by latest', 'woocommerce');
    $orderby['price'] = __('Sort by price: low to high', 'woocommerce');
    $orderby['price-desc'] = __('Sort by price: high to low', 'woocommerce');

    return $orderby;
}
add_filter( 'woocommerce_catalog_orderby', 'custom_woocommerce_catalog_orderby', 20 );

// Adjust product query based on selected sorting option
function custom_wc_get_catalog_ordering_args( $args ) {
    if ( isset( $_GET['orderby'] ) ) {
        switch( $_GET['orderby'] ) {
            case 'price':
                $args['orderby']  = 'meta_value_num';
                $args['order']    = 'ASC';
                $args['meta_key'] = '_price';
                break;
            case 'price-desc':
                $args['orderby']  = 'meta_value_num';
                $args['order']    = 'DESC';
                $args['meta_key'] = '_price';
                break;
            default:
                $args['orderby'] = sanitize_text_field( $_GET['orderby'] );
                break;
        }
    }
    return $args;
}
add_filter( 'woocommerce_get_catalog_ordering_args', 'custom_wc_get_catalog_ordering_args', 20 );

// Set default sorting option
function custom_wc_default_catalog_orderby( $sortby ) {
    return 'date'; // Default sorting option
}
add_filter( 'woocommerce_default_catalog_orderby', 'custom_wc_default_catalog_orderby', 20 );

// Custom shortcode to display sorting dropdown without button and clear
function custom_sorting_dropdown_shortcode() {
    ob_start();
    ?>
    <form class="woocommerce-ordering" method="get">
        <select name="orderby" class="orderby filled fill_inited" aria-label="Shop order">
            <option value="popularity">Sort by</option>
            <option value="rating">Sort by average rating</option>
            <option value="date" selected="selected">Sort by latest</option>
            <option value="price">Sort by price: low to high</option>
            <option value="price-desc">Sort by price: high to low</option>
        </select>
    </form>
    <?php
    return ob_get_clean();
}
add_shortcode( 'custom_sorting_dropdown', 'custom_sorting_dropdown_shortcode' );

// Add breadcrumbs above product title
function custom_product_filter_shortcode() {
    // Get filter parameters from the GET request
    $gender = isset($_GET['gender']) ? $_GET['gender'] : '';
    $color = isset($_GET['color']) ? $_GET['color'] : '';
    $breed = isset($_GET['breed']) ? $_GET['breed'] : '';
    $priceMin = isset($_GET['min-price']) ? $_GET['min-price']!='' ? $_GET['min-price'] : 0 : 0;
    $priceMax = isset($_GET['max-price']) ? $_GET['max-price']!='' ? $_GET['max-price'] : 1000000 : 1000000; 

    // Check if any filter parameters are present
    $filters_exist = !empty($gender) || !empty($color) || !empty($breed);

    // Check if all filter parameters are empty
    $all_filters_empty = empty($gender) && empty($color) && empty($breed);

    // Query categories based on the presence of filter parameters
    $args = array(
        'taxonomy' => 'product_cat',
        'hide_empty' => false,
    );
    
    ?>
    <div id="category-list">
        <div class="topSide">
            <h3>Explore Our Pets</h3>
        </div>
    <?php

    if ($all_filters_empty) {
        // If all filters are empty, fetch all categories without applying any filtering
        $categories = get_terms($args);
        if (is_wp_error($categories)) {

        } else {

            foreach ($categories as $category) {
                if ($category->slug != 'uncategorized') {
                    $category_image = get_term_meta($category->term_id, 'thumbnail_id', true);
                    $category_image_url = wp_get_attachment_url($category_image);
                    echo '<div class="category" data-category="' . $category->slug . '">';
                    if (!empty($category_image_url)) {
                        echo '<a href="' . get_term_link($category) . '"><img src="' . $category_image_url . '" alt="' . $category->name . '"></a>';
                    }
                    echo '<span><a href="' . get_term_link($category) . '">' . $category->name . '</a></span></div>';
                }
            }
        }

    } else {
        // If any filter parameter is present, apply filtering
        $categories = get_terms($args);
        ob_start();
        ?>
        
            <?php
            $categories_found = false; // Flag to check if any categories with matching products are found
            foreach ($categories as $category) {
                if ($category->slug != 'uncategorized') {
                    // Query products within each category based on the filter parameters
                    
                    
                    $category_products = new WP_Query(array(
                        'post_type' => 'product',
                        'tax_query' => array(
                            'relation' => 'AND',
                            array(
                                'taxonomy' => 'product_cat',
                                'field' => 'slug',
                                'terms' => $category->slug,
                            ),
                        ),
                        'meta_query' => array( // Meta query for price filtering
                            'relation' => 'AND',
                            array(
                                'key' => '_price',
                                'value' => array($priceMin, $priceMax),
                                'type' => 'numeric',
                                'compare' => 'BETWEEN'
                            ),
                            array(
                                'relation' => 'OR',
                                array(
                                    'key' => 'gender', // ACF field key for gender
                                    'value' => $gender,
                                    'compare' => '='
                                ),
                                array(
                                    'key' => 'color', // ACF field key for color
                                    'value' => $color,
                                    'compare' => '='
                                ),
                                array(
                                    'key' => 'breed', // ACF field key for breed
                                    'value' => $breed,
                                    'compare' => '='
                                )
                            )
                        ),
                    ));
                    
                    if ($category_products->have_posts()) {
                        $categories_found = true;
                        $category_image = get_term_meta($category->term_id, 'thumbnail_id', true);
                        $category_image_url = wp_get_attachment_url($category_image);
                        echo '<div class="category" data-category="' . $category->slug . '">';
                        if (!empty($category_image_url)) {
                            echo '<a href="' . get_term_link($category) . '"><img src="' . $category_image_url . '" alt="' . $category->name . '"></a>';
                        }
                        echo '<span><a href="' . get_term_link($category) . '">' . $category->name . '</a></span></div>';
                    }

                    // Restore original post data
                    wp_reset_postdata();
                } 
            }

            // If no categories with matching products are found, display a message
            if (!$categories_found && $filters_exist) {
                echo '<p>No categories found matching the filter criteria.</p>';
            }
            ?>
        <?php
        return ob_get_clean();
    }
    ?>
    </div>
    <?php
}
add_shortcode('product_filter_custom', 'custom_product_filter_shortcode');

add_action( 'woocommerce_register_form', 'custom_woocommerce_register_form', 0 );
function custom_woocommerce_register_form() {
    ?>
    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
        <label for="phone"><?php _e( 'Contact Number', 'woocommerce' ); ?> <span class="required">*</span></label>
        <input type="tel" class="woocommerce-Input woocommerce-Input--phone input-text" name="phone" id="phone" value="<?php if ( ! empty( $_POST['phone'] ) ) esc_attr_e( $_POST['phone'] ); ?>" />
    </p>
    <?php
}

add_action( 'woocommerce_register_form', 'custom_woocommerce_register_confirm_password', 1 );
function custom_woocommerce_register_confirm_password() {
    ?>
    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
        <label for="password-confirm"><?php _e( 'Confirm Password', 'woocommerce' ); ?> <span class="required">*</span></label>
        <input type="password" class="woocommerce-Input woocommerce-Input--password input-text" name="password_confirm" id="password-confirm" />
    </p>
    <?php
}

add_action( 'woocommerce_register_post', 'custom_woocommerce_validate_registration', 10, 3 );
function custom_woocommerce_validate_registration( $username, $email, $errors ) {
    if ( empty( $_POST['phone'] ) ) {
        $errors->add( 'phone_error', __( 'Please enter your phone number.', 'woocommerce' ) );
    }

    if ( empty( $_POST['password_confirm'] ) || $_POST['password_confirm'] !== $_POST['password'] ) {
        $errors->add( 'password_confirm_error', __( 'Passwords do not match.', 'woocommerce' ) );
    }
}

add_action( 'woocommerce_created_customer', 'custom_woocommerce_save_phone_number' );
function custom_woocommerce_save_phone_number( $customer_id ) {
    if ( isset( $_POST['phone'] ) ) {
        update_user_meta( $customer_id, 'phone', sanitize_text_field( $_POST['phone'] ) );
    }
}

function promotedProducts_func() {
    include ('connection.php');
    $i=0;
    $html='<div class="c_product-grid-home ruk-home-pro" id="main-product-gird">';
        $productPromotions=mysqli_query($con,"SELECT * FROM `productPromotionStore` where `status`='1' order by id desc ");      
        while($productPromotion = mysqli_fetch_array($productPromotions)){
            $listings=mysqli_query($con,"SELECT * FROM `listings` where `status`='active' and `id`=".$productPromotion['product']." order by id desc ");      
            $listing = mysqli_fetch_array($listings);
            
            $productPromotionChecks=mysqli_query($con,"SELECT * FROM `productPromotion` where `id`=".$productPromotion['promotion']." ");      
            $productPromotionCheck = mysqli_fetch_array($productPromotionChecks);
            
            $days=(int)$productPromotion['duration'];
            if($productPromotionCheck['option']=='weekly'){
                $days=(int)$productPromotion['duration']*7;
            }
            if($productPromotionCheck['option']=='monthly'){
                $days=(int)$productPromotion['duration']*30;
            }
            if($productPromotionCheck['option']=='yearly'){
                $days=(int)$productPromotion['duration']*365;
            }
            
            $start_datetime = new DateTime($productPromotion['startDate']);
            $end_datetime = new DateTime($productPromotion['endDate']);
            
            $start_datetime_adding = new DateTime($productPromotion['startDate']);
            $start_datetime_adding->modify("+".$days." days");
            
            if ($start_datetime_adding < $end_datetime) {
                $end_datetime = $start_datetime_adding;
            }
        
            $current_date = new DateTime();
            
            if($current_date >= $start_datetime && $current_date <= $end_datetime){
            
                if($listing['id'] && $i<8){
                    $categories=mysqli_query($con,"SELECT * FROM `categories` where `id`=".$listing["category"]." ");      
                    $category = mysqli_fetch_array($categories);
                        $html.='<a href="/product-detail/?id='.$listing['id'].'" class="h_product-card">';
                        if($listing['gallery1']!=''){
                        $html.='<img src="'.$listing['gallery1'].'" alt="'.$listing['title'].'">';
                        }else{
                        $html.='<img src="/wp-content/uploads/2024/05/images.png" alt="'.$listing['title'].'">';
                        }
                        $html.='<h3>'.$listing['title'].'</h3>';
                        $html.='<div class="meta">Type: '.$category['name'].' | SKU: '.$listing['stockNumber'].'</div>';
                        $html.='<div class="price">$'.$listing['price'].'</div>';
                        $html.='</a>';
                }
                $i++;
            }
        }
    $html.='</div>';
    return $html;
}
add_shortcode('promotedProducts', 'promotedProducts_func');

function promotedProducts_func2() {
    include ('connection.php');
    $i=0;
    $html='<div class="c_product-grid-home" id="main-product-gird">';
        $productPromotions=mysqli_query($con,"SELECT * FROM `productPromotionStore` where `status`='1' order by id desc ");      
        while($productPromotion = mysqli_fetch_array($productPromotions)){
            $listings=mysqli_query($con,"SELECT * FROM `listings` where `status`='active' and `id`=".$productPromotion['product']." order by id desc ");      
            $listing = mysqli_fetch_array($listings);
            
            $productPromotionChecks=mysqli_query($con,"SELECT * FROM `productPromotion` where `id`=".$productPromotion['promotion']." ");      
            $productPromotionCheck = mysqli_fetch_array($productPromotionChecks);
            
            $days=(int)$productPromotion['duration'];
            if($productPromotionCheck['option']=='weekly'){
                $days=(int)$productPromotion['duration']*7;
            }
            if($productPromotionCheck['option']=='monthly'){
                $days=(int)$productPromotion['duration']*30;
            }
            if($productPromotionCheck['option']=='yearly'){
                $days=(int)$productPromotion['duration']*365;
            }
            
            $start_datetime = new DateTime($productPromotion['startDate']);
            $end_datetime = new DateTime($productPromotion['endDate']);
            
            $start_datetime_adding = new DateTime($productPromotion['startDate']);
            $start_datetime_adding->modify("+".$days." days");
            
            if ($start_datetime_adding < $end_datetime) {
                $end_datetime = $start_datetime_adding;
            }
        
            $current_date = new DateTime();
            
            if($current_date >= $start_datetime && $current_date <= $end_datetime){
            
                if($listing['id'] && $i>7 && $i<16){
                    $categories=mysqli_query($con,"SELECT * FROM `categories` where `id`=".$listing["category"]." ");      
                    $category = mysqli_fetch_array($categories);
                        $html.='<a href="/product-detail/?id='.$listing['id'].'" class="h_product-card">';
                        if($listing['gallery1']!=''){
                        $html.='<img src="'.$listing['gallery1'].'" alt="'.$listing['title'].'">';
                        }else{
                        $html.='<img src="/wp-content/uploads/2024/05/images.png" alt="'.$listing['title'].'">';
                        }
                        $html.='<h3>'.$listing['title'].'</h3>';
                        $html.='<div class="meta">Type: '.$category['name'].' | SKU: '.$listing['stockNumber'].'</div>';
                        $html.='<div class="price">$'.$listing['price'].'</div>';
                        $html.='</a>';
                }
                $i++;
            }
        }
    $html.='</div>';
    return $html;
}
add_shortcode('promotedProducts2', 'promotedProducts_func2');

function promotedBanner_func() {
    include ('connection.php');
    $i=0;
    $html='<div class="bannerSliders">';
        $bannerPromotions=mysqli_query($con,"SELECT * FROM `bannerPromotion` where `position`='Home Top' and `status`='1' order by id desc ");      
        $bannerPromotion = mysqli_fetch_array($bannerPromotions);
            
            // $start_datetime = new DateTime($bannerPromotion['startDate']);
            // $end_datetime = new DateTime($bannerPromotion['endDate']);
            
            // $current_date = new DateTime();
            
            // if($current_date >= $start_datetime && $current_date <= $end_datetime){
            
            //     if($bannerPromotion['banner']!='' && $i<2){
                    $html.='<div class="items-slide">';
                        $html.='<section class="h_boxed-banner_2" style="background-image: url('.$bannerPromotion['banner'].');">';
                            $html.='<div class="h_boxed-banner-content">';
                                $html.='<div class="h_boxed-banner-text">';
                                    $html.='<h2>'.$bannerPromotion['name'].'</h2>';
                                    $html.='<h3>'.$bannerPromotion['title'].'</h3>';
                                $html.='</div>';
                                $html.='<div class="h_boxed-banner-buttons">';
                                    $html.='<a href="'.$bannerPromotion['link'].'" class="h_banner_button h_button-2">'.$bannerPromotion['button'].'</a>';
                                $html.='</div>';
                            $html.='</div>';
                        $html.='</section>';
                    $html.='</div>';
            //     }
            //     $i++;
            // }
       
    $html.='</div>';
    return $html;
}
add_shortcode('promotedBanner', 'promotedBanner_func');

function promotedBanner_func2() {
    include ('connection.php');
    $i=0;
    $html='<div class="bannerSliders">';
        $bannerPromotions=mysqli_query($con,"SELECT * FROM `bannerPromotion` where `position`='Home Bottom' and `status`='1' order by id desc ");
        if (mysqli_num_rows($bannerPromotions) > 0) {      
            $bannerPromotion = mysqli_fetch_array($bannerPromotions);
            
            // $start_datetime = new DateTime($bannerPromotion['startDate']);
            // $end_datetime = new DateTime($bannerPromotion['endDate']);
            
            // $current_date = new DateTime();
            
            // if($current_date >= $start_datetime && $current_date <= $end_datetime){
            
            //     if($bannerPromotion['banner']!='' && $i>2 && $i<6){
                    $html.='<div class="items-slide">';
                        $html.='<section class="h_boxed-banner_2" style="background-image: url('.$bannerPromotion['banner'].');">';
                            $html.='<div class="h_boxed-banner-content">';
                                $html.='<div class="h_boxed-banner-text">';
                                    $html.='<h2>'.$bannerPromotion['name'].'</h2>';
                                    $html.='<h3>'.$bannerPromotion['title'].'</h3>';
                                $html.='</div>';
                                $html.='<div class="h_boxed-banner-buttons">';
                                    $html.='<a href="'.$bannerPromotion['link'].'" class="h_banner_button h_button-2">'.$bannerPromotion['button'].'</a>';
                                $html.='</div>';
                            $html.='</div>';
                        $html.='</section>';
                    $html.='</div>';
            //     }
            //     $i++;
            // }
       
    }
    $html.='</div>';
    return $html;
}
add_shortcode('promotedBanner2', 'promotedBanner_func2');

function promotedBanner_func3() {
    include ('connection.php');
    $html='<div class="bannerSliders categoryPage">';
        $bannerPromotions=mysqli_query($con,"SELECT * FROM `bannerPromotion` where `position`='Category Page' and `status`='1' order by id desc ");      
        $bannerPromotion = mysqli_fetch_array($bannerPromotions);
            
            // $start_datetime = new DateTime($bannerPromotion['startDate']);
            // $end_datetime = new DateTime($bannerPromotion['endDate']);
            
            // $current_date = new DateTime();
            
            // if($current_date >= $start_datetime && $current_date <= $end_datetime){ 
            
                if($bannerPromotion['banner']!=''){
                    $html.='<div class="items-slide">';
                        $html.='<section class="h_boxed-banner_2" style="background-image: url('.$bannerPromotion['banner'].');">';
                            $html.='<div class="h_boxed-banner-content">';
                                $html.='<div class="h_boxed-banner-text">';
                                    $html.='<h2>'.$bannerPromotion['name'].'</h2>';
                                    $html.='<h3>'.$bannerPromotion['title'].'</h3>';
                                $html.='</div>';
                                $html.='<div class="h_boxed-banner-buttons">';
                                    $html.='<a href="'.$bannerPromotion['link'].'" class="h_banner_button h_button-2">'.$bannerPromotion['button'].'</a>';
                                $html.='</div>';
                            $html.='</div>';
                        $html.='</section>';
                    $html.='</div>';
                }
            // }
        
    $html.='</div>';
    return $html;
}
add_shortcode('promotedBanner3', 'promotedBanner_func3');

// slick slider 

// function enqueue_slick_slider_assets() {
    
//     wp_enqueue_script('jquery');

//     wp_enqueue_style('slick-css', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css');
//     wp_enqueue_style('slick-theme-css', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css');

//     wp_enqueue_script('slick-js', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array('jquery'), null, true);
// }

// add_action('wp_enqueue_scripts', 'enqueue_slick_slider_assets');


function categories_show_func() {
    include ('connection.php');
    $html='<div class="categoriesSlider">';
        $categories=mysqli_query($con,"SELECT * FROM `categories` where `home`='Yes' and `status`='1' ");      
        while($category = mysqli_fetch_array($categories)){
            
            $html.='<div class="items-slide">';
			 $html.='<div class="flip-slide">';
                $html.='<a href="/category/?category='.$category['name'].'">';
                    if($category['image']!=''){
                        $html.='<img src="'.$category['image'].'" alt="'.$category['name'].'">';
                    }else{
                        $html.='<img src="/wp-content/uploads/2024/05/images.png" alt="'.$category['name'].'">';
                    }
                    $html.=$category['name'];
                $html.='</a>';
            $html.='</div>';
            $html.='</div>';			
            
        }
    $html.='</div>';
    return $html;
}
add_shortcode('categories_show', 'categories_show_func');


add_action("admin_menu", "rattLattServices");
function rattLattServices() {
    add_menu_page("bully-vendors", "Bully", "publish_posts", "bully-vendors", "bully_vendors", "dashicons-pets", 1);
    add_submenu_page("bully-vendors", "Vendors", "Vendors", "publish_posts", "bully-vendors", "bully_vendors");
    add_submenu_page("bully-vendors", "Listings", "Listings", "publish_posts", "bully-listings", "bully_listings");
    add_submenu_page("bully-vendors", "Categories", "Categories", "publish_posts", "bully-categories", "bully_categories");
    add_submenu_page("bully-vendors", "Types", "Types", "publish_posts", "bully-types", "bully_types");
    add_submenu_page("bully-vendors", "Shops", "Shops", "publish_posts", "bully-shops", "bully_shops");
    add_submenu_page("bully-vendors", "Contact Requests", "Contact Requests", "publish_posts", "bully-contact-requests", "bully_contactRequests");
    add_submenu_page("bully-vendors", "Banner Promotions", "Banner Promotions", "publish_posts", "bully-banner-promotions", "bully_bannerPromotions");
    add_submenu_page("bully-vendors", "Product Promtions", "Product Promtions", "publish_posts", "bully-product-promtions", "bully_productPromtions");
    add_submenu_page("bully-vendors", "Promotions Setting", "Promotions Setting", "publish_posts", "bully-promotions-setting", "bully_promotionsSetting");
}

function bully_vendors(){
    include(get_stylesheet_directory().'/dashboard/vendors.php');
}

function bully_listings(){
    include(get_stylesheet_directory().'/dashboard/listings.php');
}

function bully_categories(){
    include(get_stylesheet_directory().'/dashboard/categories.php');
}

function bully_types(){
    include(get_stylesheet_directory().'/dashboard/types.php');
}

function bully_shops(){
    include(get_stylesheet_directory().'/dashboard/shops.php');
}

function bully_contactRequests(){
    include(get_stylesheet_directory().'/dashboard/contactRequests.php');
}

function bully_bannerPromotions(){
    include(get_stylesheet_directory().'/dashboard/bannerPromotions.php');
}

function bully_productPromtions(){
    include(get_stylesheet_directory().'/dashboard/productPromtions.php');
}

function bully_promotionsSetting(){
    include(get_stylesheet_directory().'/dashboard/promotionsSetting.php');
}

function enqueue_fira_sans_extra_condensed() {
    wp_enqueue_style( 'fira-sans-extra-condensed', 'https://fonts.googleapis.com/css2?family=Fira+Sans+Extra+Condensed:wght@400;700&display=swap', false );
}
add_action( 'wp_enqueue_scripts', 'enqueue_fira_sans_extra_condensed' );


// sub categories

function my_enqueue_scripts() {
    wp_enqueue_script('jquery');
    wp_enqueue_script('my-script', get_template_directory_uri() . '/js/my-script.js', array('jquery'), null, true);

    $ajaxurl = admin_url('admin-ajax.php');
    $inline_script = "var ajaxurl = '$ajaxurl';";
    wp_add_inline_script('my-script', $inline_script);
}
add_action('wp_enqueue_scripts', 'my_enqueue_scripts');


add_action('wp_ajax_get_parent_categories', 'get_parent_categories');
add_action('wp_ajax_nopriv_get_parent_categories', 'get_parent_categories');

function get_parent_categories() {
    global $wpdb;
    $level = intval($_POST['category_level']) - 1;

    $response = [];

    if ($level == 1) {
        $results = $wpdb->get_results(
            "SELECT id, name, parent_id FROM categories WHERE category_level = " . ($level)
        );

        if (!empty($results)) {
            foreach ($results as $category) {
                $response[] = [
                    'id' => $category->id,
                    'name' => $category->name,
                    'parent_id' => $category->parent_id,
                    'top_level' => true
                ];
            }
        }

    } else {
        $categories = $wpdb->get_results(
            $wpdb->prepare("SELECT id, name, parent_id FROM categories WHERE category_level = %d", $level)
        );

        if (!empty($categories)) {
            foreach ($categories as $category) {
                $parent = $wpdb->get_row(
                    $wpdb->prepare("SELECT id, name FROM categories WHERE id = %d", $category->parent_id)
                );

                if ($parent) {
                    $parent_name = $parent->name;

                    if (!isset($response[$parent_name])) {
                        $response[$parent_name] = [
                            'parent_name' => $parent_name,
                            'categories' => [],
                            'top_level' => false
                        ];
                    }

                    $response[$parent_name]['categories'][] = [
                        'id' => $category->id,
                        'name' => $category->name,
                    ];
                }
            }
            $response = array_values($response);
        }
    }
    wp_send_json($response);
    wp_die();
}


add_action('wp_ajax_get_categories_by_child', 'get_categories_by_child');
add_action('wp_ajax_nopriv_get_categories_by_child', 'get_categories_by_child');

function get_categories_by_child() {
    global $wpdb;
    $parent_id = intval($_POST['parent_id']);

    $response = [];

    $categories = $wpdb->get_results(
        $wpdb->prepare("SELECT id, name FROM categories WHERE parent_id = %d", $parent_id)
    );

    if (!empty($categories)) {
        foreach ($categories as $category) {
            $response[] = [
                'id' => $category->id,
                'name' => $category->name
            ];
        }
    }

    wp_send_json($response);
    wp_die();
}


// search products
function enqueue_custom_scripts() {
    wp_enqueue_script('jquery');
    wp_enqueue_script('my-script', get_template_directory_uri() . '/js/my-script.js', array('jquery'), null, true);

    wp_localize_script('my-script', 'ajax_object', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce'    => wp_create_nonce('search_products_nonce') // Use if you want to add nonce
    ));
}
add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');

function search_products_ajax_handler() {
    // Verify nonce for security
    check_ajax_referer('search_products_nonce', 'nonce');

    global $wpdb;
    $search_query = sanitize_text_field($_POST['search']); // Clean the search search
    $state = sanitize_text_field($_POST['state']); // Clean the state value

    $sql = "SELECT * FROM listings WHERE title LIKE %s";
    $params = array('%' . $wpdb->esc_like($search_query) . '%');

    if (!empty($state)) {
        $sql .= " AND state = %s";
        $params[] = $state;
    }

    $sql .= " LIMIT 10";
    $products = $wpdb->get_results($wpdb->prepare($sql, $params));

    if (!empty($products)) {
        wp_send_json_success($products);
    } else {
        wp_send_json_error('No products found');
    }
}

add_action('wp_ajax_search_products', 'search_products_ajax_handler');
add_action('wp_ajax_nopriv_search_products', 'search_products_ajax_handler');

// page custom template assign to page

function auto_assign_template_by_slug($template) {
    if (is_page('contact-us')) { // Replace 'contact-us' with your page slug
        $new_template = locate_template('template-contact-us.php'); // Replace with your template file
        if ($new_template) {
            return $new_template;
        }
    }
	else if (is_page('about-us')) { // Replace 'contact-us' with your page slug
        $new_template = locate_template('about-us.php'); // Replace with your template file
        if ($new_template) {
            return $new_template;
        }
    }
	else if (is_page('blog')) { // Replace 'contact-us' with your page slug
        $new_template = locate_template('template-blog.php'); // Replace with your template file
        if ($new_template) {
            return $new_template;
        }
    }	
	else if (is_page('home-2')) { // Replace 'contact-us' with your page slug
        $new_template = locate_template('template-home.php'); // Replace with your template file
        if ($new_template) {
            return $new_template;
        }
    }
   else if (is_page('account-settings')) { // Replace 'contact-us' with your page slug
        $new_template = locate_template('account-settings.php'); // Replace with your template file
        if ($new_template) {
            return $new_template;
        }
    }
  else if (is_singular('post')) {
        // Specify your custom template file for blog detail
        $new_template = locate_template('blog-detail.php'); // Replace 'template-blog-detail.php' with your custom template filename
        
        if (!empty($new_template)) {
            return $new_template;
        }
    }

    return $template;
}
add_filter('template_include', 'auto_assign_template_by_slug');



// search products

function enqueue_sweetalert() {
    wp_enqueue_script( 'sweetalert', 'https://cdn.jsdelivr.net/npm/sweetalert2@11', array( 'jquery' ), null, true );
}
add_action( 'wp_enqueue_scripts', 'enqueue_sweetalert' );



// my custom session
function start_php_session() {
    if (!session_id()) {
        session_start();
    }
}
add_action('init', 'start_php_session');

// Set custom session variables
function set_custom_session_variables($session_name, $val) {
    if (session_id()) {
        $_SESSION[$session_name] = $val;
    }
}

// Retrieve custom session variables
function get_custom_session_variables($session_name) {
    if (session_id() && isset($_SESSION[$session_name])) {
        return $_SESSION[$session_name];
    }
    return null;
}

function unset_custom_session_variable($session_name) {
    if (session_id() && isset($_SESSION[$session_name])) {
        unset($_SESSION[$session_name]);
    }
}
// my custom session



// registration

// Enqueue JavaScript for the form submission
function enqueue_registration_script() {
    wp_enqueue_script('jquery');
    wp_enqueue_script('registration-script', get_stylesheet_directory_uri() . '/js/registration-script.js', array('jquery'), null, true);

    // Localize script to pass AJAX URL and nonce
    wp_localize_script('registration-script', 'ajax_object', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce'    => wp_create_nonce('registration_nonce')
    ));
}
add_action('wp_enqueue_scripts', 'enqueue_registration_script');

// AJAX handler for registration form
function handle_registration() {
    check_ajax_referer('registration_nonce', 'nonce');

    global $wpdb;
    $username = sanitize_text_field($_POST['fullname']);
    $useremail = sanitize_email($_POST['email']);
    $password = sanitize_text_field($_POST['password']);
    $confirmPassword = sanitize_text_field($_POST['confirmPassword']);
    $errorMessage = '';

    // Validate passwords
    if ($password !== $confirmPassword) {
        wp_send_json_error(['errorMessage' => 'Password and confirm password do not match!']);
        return;
    }

    // Check if username or email already exists
    $username_exists = $wpdb->get_var($wpdb->prepare("SELECT id FROM `account` WHERE `username` = %s", $username));
    if ($username_exists) {
        wp_send_json_error(['errorMessage' => 'The username already exists. Please try another unique username!']);
        return;
    }

    $email_exists = $wpdb->get_var($wpdb->prepare("SELECT id FROM `account` WHERE `email` = %s", $useremail));
    if ($email_exists) {
        wp_send_json_error(['errorMessage' => 'The email already exists. Please try another email address!']);
        return;
    }

    // Insert the new user
    $insert = $wpdb->insert('account', array(
        'firstname' => $username,
        'email' => $useremail,
        'password' => $password,
        'status' => 1,
        'role' => 'vendor'
    ));

    if ($insert) {
        $userID = $wpdb->insert_id;

        // Additional insertions for related tables
        $wpdb->insert('address', array('userID' => $userID, 'status' => 1));
        $wpdb->insert('shop', array('userID' => $userID, 'status' => 1));

        setcookie("user_id", $userID, time() + (86400 * 30), "/");
        setcookie("user_role", 'vendor', time() + (86400 * 30), "/");
		
		$_SESSION['auth'] = [
			'firstname' => $username,
			'email' => $useremail,
		];

         	$redirect_url = '/' ;
            wp_send_json_success(['redirect' => $redirect_url]);
    } else {
        wp_send_json_error(['errorMessage' => 'Registration failed. Please try again later.']);
    }
}

add_action('wp_ajax_handle_registration', 'handle_registration');
add_action('wp_ajax_nopriv_handle_registration', 'handle_registration');


// listing

// Handle AJAX request for fetching listings
// AJAX Action Hooks
add_action('wp_ajax_fetch_listings', 'fetch_listings_data');
add_action('wp_ajax_nopriv_fetch_listings', 'fetch_listings_data');

function fetch_listings_data() {
    global $wpdb;

    $limit = isset($_POST['limit']) ? intval($_POST['limit']) : 10;
    $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $date = isset($_POST['date']) ? sanitize_text_field($_POST['date']) : "";
    $status = isset($_POST['status']) ? sanitize_text_field($_POST['status']) : "";
    $offset = ($page - 1) * $limit;

    $user_id = $_COOKIE["user_id"];
    if (!$user_id) {
        wp_send_json_error(['message' => 'User not logged in'], 401);
    }

    // Dynamic WHERE conditions
    $conditions = ["l.userID = %d"];
    $params = [$user_id];

    if (!empty($date)) {
        $conditions[] = "DATE(l.created_at) = %s";
        $params[] = date("Y-m-d", strtotime($date));
    }

    if (!empty($status)) {
        $conditions[] = "l.status = %s";
        $params[] = $status;
    }

    $whereClause = "WHERE " . implode(" AND ", $conditions);

    // Fetch listings
    $query = "SELECT l.id, l.title, l.price, l.created_at, l.status,
                     parent_category.name as parent_category_name,
                     child_category.name as sub_category_name
              FROM listings l
              LEFT JOIN categories child_category ON l.category = child_category.id
              LEFT JOIN categories parent_category ON child_category.parent_id = parent_category.id
              $whereClause
              ORDER BY l.id DESC
              LIMIT %d OFFSET %d";
    array_push($params, $limit, $offset);

    $results = $wpdb->get_results($wpdb->prepare($query, ...$params), ARRAY_A);

    // Get total listings count
    $totalQuery = "SELECT COUNT(*) FROM listings l $whereClause";
    $total = $wpdb->get_var($wpdb->prepare($totalQuery, ...array_slice($params, 0, count($params) - 2)));

    // Response
    $response = [
        'data' => $results,
        'total' => $total,
        'page' => $page,
        'limit' => $limit,
    ];

    wp_send_json_success($response);
}




// message listing

add_action('wp_ajax_fetch_filtered_listings', 'fetch_filtered_listings_data');
add_action('wp_ajax_nopriv_fetch_filtered_listings', 'fetch_filtered_listings_data');

function fetch_filtered_listings_data() {
    global $wpdb;

    $limit = isset($_POST['limit']) ? intval($_POST['limit']) : 10;
    $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $date = isset($_POST['date']) ? sanitize_text_field($_POST['date']) : "";
    $category_id = isset($_POST['category_id']) ? intval($_POST['category_id']) : 0;
    $status = isset($_POST['status']) ? sanitize_text_field($_POST['status']) : "";

    $offset = ($page - 1) * $limit;
    $user_id = $_COOKIE["user_id"];

    if (!$user_id) {
        wp_send_json_error(['message' => 'User not logged in'], 401);
    }

    // Build WHERE conditions dynamically
    $conditions = ["l.userID = %d"];
    $params = [$user_id];

    if (!empty($date)) {
        $conditions[] = "DATE(l.created_at) = %s";
        $params[] = date("Y-m-d", strtotime($date));
    }

    if (!empty($category_id)) {
        $conditions[] = "l.category_id = %d";
        $params[] = $category_id;
    }

    if (!empty($status)) {
        $conditions[] = "l.status = %s";
        $params[] = $status;
    }

    $whereClause = "WHERE " . implode(" AND ", $conditions);

    // Fetch filtered listings
    $query = "SELECT l.id, l.title, l.price, l.created_at, l.status,
                     parent_category.name AS parent_category_name,
                     child_category.name AS sub_category_name
              FROM listings l
              LEFT JOIN categories child_category ON l.category_id = child_category.id
              LEFT JOIN categories parent_category ON child_category.parent_id = parent_category.id
              $whereClause
              ORDER BY l.id DESC
              LIMIT %d OFFSET %d";
    array_push($params, $limit, $offset);

    $results = $wpdb->get_results($wpdb->prepare($query, ...$params), ARRAY_A);

    // Get total filtered listings count for pagination
    $totalQuery = "SELECT COUNT(*) FROM listings l $whereClause";
    $total = $wpdb->get_var($wpdb->prepare($totalQuery, ...array_slice($params, 0, count($params) - 2)));

    $response = [
        'data' => $results,
        'total' => $total,
        'page' => $page,
        'limit' => $limit,
    ];

    wp_send_json_success($response);
}







// login

add_action('wp_ajax_user_login', 'user_login_handler');
add_action('wp_ajax_nopriv_user_login', 'user_login_handler');

function user_login_handler() {
    global $wpdb;

    $youremail = isset($_POST['youremail']) ? sanitize_text_field($_POST['youremail']) : '';
    $password = isset($_POST['password']) ? sanitize_text_field($_POST['password']) : '';
    $toPostnAdd = isset($_POST['toPostnAdd']) ? sanitize_text_field($_POST['toPostnAdd']) : '';

    if (!$youremail || !$password) {
        wp_send_json_error(['message' => 'Email and password are required!']);
    }

    $user = $wpdb->get_row(
        $wpdb->prepare(
            "SELECT * FROM `account` WHERE (`username` = %s OR `email` = %s) AND `password` = %s",
            $youremail,
            $youremail,
            $password
        )
    );

    if ($user) {
        if ($user->status == '1') {
            setcookie("user_id", $user->id, time() + (86400 * 30), "/");
            setcookie("user_role", $user->role, time() + (86400 * 30), "/");
			
			$_SESSION['auth'] = [
                'username' => $user->username,
				'email' => $user->email,
				'contact' => $user->contact,
				'firstname' => $user->firstname,
				'lastname' => $user->lastname,
				'profile' => $user->profile,
            ];
			
            if (!empty($_POST["remember"])) {
                setcookie("youremail", $youremail, time() + (86400 * 30), "/");
                setcookie("password", $password, time() + (86400 * 30), "/");
            } else {
                setcookie("youremail", "", time() - 3600, "/");
                setcookie("password", "", time() - 3600, "/");
            }

            $redirect_url = $toPostnAdd === 'sell' ? '/post-an-ad/' : '/dashboard/';
            wp_send_json_success(['redirect' => $redirect_url]);
        } else {
            wp_send_json_error(['message' => 'Your account is inactive. Kindly contact admin to activate your account!']);
        }
    } else {
        wp_send_json_error(['message' => 'Invalid login credentials!']);
    }
}


// update profile
// Add action for form submission handling
// Register AJAX handler for logged-in users
add_action('wp_ajax_manage_information_submit', 'handle_manage_information_submit');

// Register AJAX handler for non-logged-in users (if needed)
add_action('wp_ajax_nopriv_manage_information_submit', 'handle_manage_information_submit');

function handle_manage_information_submit() {
    // Parse form data
    parse_str($_POST['formData'], $formData);

    global $wpdb;

    // Sanitize and retrieve form data
    $firstName = sanitize_text_field($formData['firstName'] ?? '');
    $lastName = sanitize_text_field($formData['lastName'] ?? '');
    $phoneNumber = sanitize_text_field($formData['phoneNumber'] ?? '');
    $state = sanitize_text_field($formData['state'] ?? '');
    $city = sanitize_text_field($formData['city'] ?? '');

    // Get current user ID
    $user_id = $_COOKIE['user_id'] ?? 0;

    if ($user_id) {
        // Update user information in the database
        $result = $wpdb->update(
            'account',
            [
                'contact' => $phoneNumber,
                'firstname' => $firstName,
                'lastname' => $lastName,
                'state' => $state,
                'city' => $city,
            ],
            ['id' => $user_id],
            ['%s', '%s', '%s', '%s', '%s'],
            ['%d']
        );

        if ($result !== false) {
			 $_SESSION['auth'] = array_merge($_SESSION['auth'], [
				'city' => $city,
				'state' => $state,
				'contact' => $phoneNumber,
				'firstname' => $firstName,
				'lastname' => $lastName,
			]);
            wp_send_json_success(['message' => 'Profile updated successfully!']);
        } else {
            wp_send_json_error(['message' => 'Failed to update profile.']);
        }
    } else {
        wp_send_json_error(['message' => 'Invalid user ID.']);
    }

    wp_die(); // Properly terminate AJAX request
}


// jquery date picker

function enqueue_jquery_ui_datepicker() {
    wp_enqueue_script('jquery-ui-datepicker');
    wp_enqueue_style('jquery-ui-css', 'https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css');
}
add_action('wp_enqueue_scripts', 'enqueue_jquery_ui_datepicker');
?>