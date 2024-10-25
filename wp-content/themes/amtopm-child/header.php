<style>
.loading {
    border: 4px solid #ffff;
    border-radius: 50%;
    border-top: 4px solid #3498db;
    width: 25px;
    height: 25px;
    -webkit-animation: spin 2s linear infinite;
    animation: spin 2s linear infinite;
    position: absolute;
    right: 245px;
    z-index: 999;
}

@-webkit-keyframes spin {
    0% { -webkit-transform: rotate(0deg); }
    100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
</style>
<?php
if(isset($_GET["user-action"]) && $_GET["user-action"]=='logout'){ 
	setcookie("user_id",0, time() + (86400 * 30), "/");
	setcookie("user_role",0, time() + (86400 * 30), "/");
   session_destroy();
   header("location: /login/");
}
?>



<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<?php
	
	$nectar_options = get_nectar_theme_options();
	
	nectar_meta_viewport();
	
	// Shortcut icon fallback.
	if ( ! empty( $nectar_options['favicon'] ) && ! empty( $nectar_options['favicon']['url'] ) ) {
		echo '<link rel="shortcut icon" href="'. esc_url( nectar_options_img( $nectar_options['favicon'] ) ) .'" />';
	}
	
	wp_head();
	
?>

	
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
<!-- 	bootstrap -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">	
	
</head>
<?php

// $nectar_header_options = nectar_get_header_variables();

?>
	
<body <?php body_class(); ?> <?php nectar_body_attributes(); ?> id="ruk-body">	
	
<?php echo "<!-- Custom Header Loaded -->"; ?>

<header class="custom-header">
	<div class="site-branding-search">		
		<div class="container-ruk">
			<div class="row">
				<div class="col-lg-2 col-md-2 logo">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
						<img src="/wp-content/uploads/2024/10/footer-logoo.png" alt="Site Logo">
					</a>
				</div>
				<div class="col-lg-7 col-md-7 search-sec-top">
					 <div class="search-container">
						 
						 
						<!-- Search Input -->
								<input 
								   type="text" 
								   id="search-input" 
								   placeholder="Find Bully, Supplies and more...." 
								   autocomplete="off"
								   value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>"
								   />
						 	<div class="loading" style="display: none;"></div>
							<div id="suggestions-dropdown" class="suggestions-dropdown"></div>

				<!-- Locations Dropdown -->
				<select class="ruk-select" name="state">
					<option value="">Locations</option>
					<option value="AL" <?php echo (isset($_GET['state']) && ($_GET['state'] == "AL")) ? 'selected' : ''; ?>>AL|Alabama</option>
					<option value="AK" <?php echo (isset($_GET['state']) && ($_GET['state'] == "AK")) ? 'selected' : ''; ?>>AK|Alaska</option>
					<option value="AZ" <?php echo (isset($_GET['state']) && ($_GET['state'] == "AZ")) ? 'selected' : ''; ?>>AZ|Arizona</option>
					<option value="AR" <?php echo (isset($_GET['state']) && ($_GET['state'] == "AR")) ? 'selected' : ''; ?>>AR|Arkansas</option>
					<option value="CA" <?php echo (isset($_GET['state']) && ($_GET['state'] == "CA")) ? 'selected' : ''; ?>>CA|California</option>
					<option value="CO" <?php echo (isset($_GET['state']) && ($_GET['state'] == "CO")) ? 'selected' : ''; ?>>CO|Colorado</option>
					<option value="CT" <?php echo (isset($_GET['state']) && ($_GET['state'] == "CT")) ? 'selected' : ''; ?>>CT|Connecticut</option>
					<option value="DE" <?php echo (isset($_GET['state']) && ($_GET['state'] == "DE")) ? 'selected' : ''; ?>>DE|Delaware</option>
					<option value="FL" <?php echo (isset($_GET['state']) && ($_GET['state'] == "FL")) ? 'selected' : ''; ?>>FL|Florida</option>
					<option value="GA" <?php echo (isset($_GET['state']) && ($_GET['state'] == "GA")) ? 'selected' : ''; ?>>GA|Georgia</option>
					<option value="HI" <?php echo (isset($_GET['state']) && ($_GET['state'] == "HI")) ? 'selected' : ''; ?>>HI|Hawaii</option>
					<option value="ID" <?php echo (isset($_GET['state']) && ($_GET['state'] == "ID")) ? 'selected' : ''; ?>>ID|Idaho</option>
					<option value="IL" <?php echo (isset($_GET['state']) && ($_GET['state'] == "IL")) ? 'selected' : ''; ?>>IL|Illinois</option>
					<option value="IN" <?php echo (isset($_GET['state']) && ($_GET['state'] == "IN")) ? 'selected' : ''; ?>>IN|Indiana</option>
					<option value="IA" <?php echo (isset($_GET['state']) && ($_GET['state'] == "IA")) ? 'selected' : ''; ?>>IA|Iowa</option>
					<option value="KS" <?php echo (isset($_GET['state']) && ($_GET['state'] == "KS")) ? 'selected' : ''; ?>>KS|Kansas</option>
					<option value="KY" <?php echo (isset($_GET['state']) && ($_GET['state'] == "KY")) ? 'selected' : ''; ?>>KY|Kentucky</option>
					<option value="LA" <?php echo (isset($_GET['state']) && ($_GET['state'] == "LA")) ? 'selected' : ''; ?>>LA|Louisiana</option>
					<option value="ME" <?php echo (isset($_GET['state']) && ($_GET['state'] == "ME")) ? 'selected' : ''; ?>>ME|Maine</option>
					<option value="MD" <?php echo (isset($_GET['state']) && ($_GET['state'] == "MD")) ? 'selected' : ''; ?>>MD|Maryland</option>
				<option value="MA" <?php echo (isset($_GET['state']) && ($_GET['state'] == "MA")) ? 'selected' : ''; ?>>MA|Massachusetts</option>
					<option value="MA" <?php echo (isset($_GET['state']) && ($_GET['state'] == "MI")) ? 'selected' : ''; ?>>MI|Michigan</option>
					<option value="MN" <?php echo (isset($_GET['state']) && ($_GET['state'] == "MN")) ? 'selected' : ''; ?>>MN|Minnesota</option>
					<option value="MS" <?php echo (isset($_GET['state']) && ($_GET['state'] == "MS")) ? 'selected' : ''; ?>>MS|Mississippi</option>
					<option value="MO" <?php echo (isset($_GET['state']) && ($_GET['state'] == "MO")) ? 'selected' : ''; ?>>MO|Missouri</option>
					<option value="MT" <?php echo (isset($_GET['state']) && ($_GET['state'] == "MT")) ? 'selected' : ''; ?>>MT|Montana</option>
					<option value="NE" <?php echo (isset($_GET['state']) && ($_GET['state'] == "NE")) ? 'selected' : ''; ?>>NE|Nebraska</option>
					<option value="NV" <?php echo (isset($_GET['state']) && ($_GET['state'] == "NV")) ? 'selected' : ''; ?>>NV|Nevada</option>
				<option value="NH" <?php echo (isset($_GET['state']) && ($_GET['state'] == "NH")) ? 'selected' : ''; ?>>NH|New Hampshire</option>
					<option value="NJ" <?php echo (isset($_GET['state']) && ($_GET['state'] == "NJ")) ? 'selected' : ''; ?>>NJ|New Jersey</option>
					<option value="NM" <?php echo (isset($_GET['state']) && ($_GET['state'] == "NM")) ? 'selected' : ''; ?>>NM|New Mexico</option>
					<option value="NY" <?php echo (isset($_GET['state']) && ($_GET['state'] == "NY")) ? 'selected' : ''; ?>>NY|New York</option>
				<option value="NC" <?php echo (isset($_GET['state']) && ($_GET['state'] == "NC")) ? 'selected' : ''; ?>>NC|North Carolina</option>
				<option value="ND" <?php echo (isset($_GET['state']) && ($_GET['state'] == "ND")) ? 'selected' : ''; ?>>ND|North Dakota</option>
					<option value="OH" <?php echo (isset($_GET['state']) && ($_GET['state'] == "OH")) ? 'selected' : ''; ?>>OH|Ohio</option>
					<option value="OK" <?php echo (isset($_GET['state']) && ($_GET['state'] == "OK")) ? 'selected' : ''; ?>>OK|Oklahoma</option>
					<option value="OR" <?php echo (isset($_GET['state']) && ($_GET['state'] == "OR")) ? 'selected' : ''; ?>>OR|Oregon</option>
				<option value="PA" <?php echo (isset($_GET['state']) && ($_GET['state'] == "PA")) ? 'selected' : ''; ?>>PA|Pennsylvania</option>
				<option value="RI" <?php echo (isset($_GET['state']) && ($_GET['state'] == "RI")) ? 'selected' : ''; ?>>RI|Rhode Island</option>
				<option value="SC" <?php echo (isset($_GET['state']) && ($_GET['state'] == "SC")) ? 'selected' : ''; ?>>SC|South Carolina</option>
				<option value="SD" <?php echo (isset($_GET['state']) && ($_GET['state'] == "SD")) ? 'selected' : ''; ?>>SD|South Dakota</option>
				<option value="TN" <?php echo (isset($_GET['state']) && ($_GET['state'] == "TN")) ? 'selected' : ''; ?>>TN|Tennessee</option>
				<option value="TX" <?php echo (isset($_GET['state']) && ($_GET['state'] == "TX")) ? 'selected' : ''; ?>>TX|Texas</option>
				<option value="UT" <?php echo (isset($_GET['state']) && ($_GET['state'] == "UT")) ? 'selected' : ''; ?>>UT|Utah</option>
				<option value="VT" <?php echo (isset($_GET['state']) && ($_GET['state'] == "VT")) ? 'selected' : ''; ?>>VT|Vermont</option>
				<option value="VA" <?php echo (isset($_GET['state']) && ($_GET['state'] == "VA")) ? 'selected' : ''; ?>>VA|Virginia</option>
				<option value="WA" <?php echo (isset($_GET['state']) && ($_GET['state'] == "WA")) ? 'selected' : ''; ?>>WA|Washington</option>
				<option value="WV" <?php echo (isset($_GET['state']) && ($_GET['state'] == "WV")) ? 'selected' : ''; ?>>WV|West Virginia</option>
				<option value="WI" <?php echo (isset($_GET['state']) && ($_GET['state'] == "WI")) ? 'selected' : ''; ?>>WI|Wisconsin</option>
				<option value="WY" <?php echo (isset($_GET['state']) && ($_GET['state'] == "WY")) ? 'selected' : ''; ?>>WY|Wyoming</option>
		<option value="DC" <?php echo (isset($_GET['state']) && ($_GET['state'] == "DC")) ? 'selected' : ''; ?>>DC|District of Columbia</option>
				<option value="AS" <?php echo (isset($_GET['state']) && ($_GET['state'] == "AS")) ? 'selected' : ''; ?>>AS|American Samoa</option>
				<option value="GU" <?php echo (isset($_GET['state']) && ($_GET['state'] == "GU")) ? 'selected' : ''; ?>>GU|Guam</option>
	<option value="MP" <?php echo (isset($_GET['state']) && ($_GET['state'] == "MP")) ? 'selected' : ''; ?>>MP|Northern Mariana Islands</option>
				<option value="PR" <?php echo (isset($_GET['state']) && ($_GET['state'] == "PR")) ? 'selected' : ''; ?>>PR|Puerto Rico</option>
		<option value="VI" <?php echo (isset($_GET['state']) && ($_GET['state'] == "VI")) ? 'selected' : ''; ?>>VI|Virgin Islands, U.S.</option>
						 </select>

						<!-- Search Button -->
						<button class="search-button">
							<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M16.75 10.75A6 6 0 1110.75 4a6 6 0 016 6z" />
							</svg>
						</button>
						 
<!-- 						<div id="loading-indicator" style="display: none;">Loading...</div> -->
					</div>
				</div>
				
				
			
				
				
				<div class="col-lg-3 col-md-3 top-right-nav">
					<nav class="navbar navbar-expand-lg navbar-light">
					 <ul class="navbar-nav me-auto mb-2 mb-lg-0 ruk-custom-top-nav">
						<li class="nav-item">
						  <a class="nav-link"  href="#">Blogs</a>
						</li>
						<li class="nav-item">
						  <a class="nav-link" href="#">About</a>
						</li>
						<li class="nav-item">
						  <a class="nav-link" href="#">Help</a>
						</li>
						<li class="nav-item dropdown">
						  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							  <small>Hello</small><br>
							  Sign in
						  </a>
						  <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
							<li><a class="dropdown-item" href="#">Action</a></li>
						  </ul>
						</li>
					  </ul>	
					</nav>
				</div>
			</div>
		</div>
	</div>
	<div class="navbar">
		<div class="container-ruk">	
		<nav class="navbar navbar-expand-lg navbar-light w-100 ruk-custom-main-nav">
		  <div class="container-fluid">
			  
			  
<!-- 			<a class="navbar-brand all-categories" href="#">All Categories &nbsp;&nbsp;<i class="fa fa-caret-down" aria-hidden="true"></i></a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
			  <span class="navbar-toggler-icon"></span>
			</button> -->
			  
			  
			  <!-- All Categories Dropdown -->
			  <div class="all-categories-menu">
				  <a class="navbar-brand all-categories" href="#">All Categories &nbsp;&nbsp;<i class="fa fa-caret-down" aria-hidden="true"></i></a>
				  <div class="categories-dropdown" style="display: none;">
					  <ul class="categories-list">
						  <?php
						  global $wpdb;
						  $categories = $wpdb->get_results("SELECT id, name FROM `categories` WHERE category_level = 1");
						  if (!empty($categories)) {
							  foreach ($categories as $category) { ?>
						  <li class="category-item has-children">
							  <a href="#"><?php echo esc_html($category->name); ?></a>
							  <?php
									$subCategories = $wpdb->get_results("SELECT id, name FROM `categories` WHERE parent_id = ".$category->id);
									if (!empty($subCategories)) { ?>
							  <ul class="sub-menu">
								  <?php foreach ($subCategories as $subCategory) { ?>
								  <li class="sub-category-item sub-has-children">
									  <a href="#"><?php echo esc_html($subCategory->name); ?></a>
									  <?php
								$subSubCategories = $wpdb->get_results("SELECT id, name FROM `categories` WHERE parent_id = ".$subCategory->id);
								if (!empty($subSubCategories)) { ?>
									  <ul class="sub-sub-menu">
										  <?php foreach ($subSubCategories as $subSubCategory) { ?>
										  <li>
											  <a href="#"><?php echo esc_html($subSubCategory->name); ?></a>
										  </li>
										  <?php } ?>
									  </ul>
									  <?php } ?>
								  </li>
								  <?php } ?>
							  </ul>
							  <?php } ?>
						  </li>
						  <?php }
						  } ?>
					  </ul>
				  </div>
			  </div>
			  
			  
			<div class="collapse navbar-collapse" id="navbarText">
				<div class="d-flex w-100 justify-content-between thebully-main-nav">
					
				  <div class="col-lg-3 col-md-3 top-right-nav">
					<nav class="navbar navbar-expand-lg navbar-light">
					 <ul class="navbar-nav me-auto mb-2 mb-lg-0 ruk-custom-top-nav">
						 <?php
						 $bullyCategories = $wpdb->get_results("SELECT id, name FROM `categories` WHERE parent_id = 1");
						 if (!empty($bullyCategories)) { ?>
						 <?php foreach ($bullyCategories as $bullyCategory) { ?>
							<li class="nav-item">
							  <a class="nav-link" href="#"><?php echo esc_html($bullyCategory->name); ?></a>
							</li>
						 <?php }
						}?>
					  </ul>	
					</nav>
				</div>
					
				  <ul class="navbar-nav ms-auto mb-2 mb-lg-0 d-flex align-items-center">
					<li class="nav-item">
					  <a class="nav-link" href="#">Sell</a>
					</li>
					<li class="nav-item">
					  <a class="nav-link" href="#"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
					</li>
					<li class="nav-item">
					  <a class="nav-link" href="#"><i class="fa fa-bell" aria-hidden="true"></i></a>
					</li>
				  </ul>
				</div>
			  </div>
		  </div>
		</nav>
		</div>
	</div>
</header>
	
<script>
	// Select the "All Categories" link and the dropdown menu
const allCategoriesLink = document.querySelector('.all-categories');
const categoriesDropdown = document.querySelector('.categories-dropdown');

// Function to show and hide menus
function showMenu(menu) {
  menu.style.display = 'block';
}

function hideMenu(menu) {
  menu.style.display = 'none';
}

// Toggle the dropdown when clicking "All Categories"
allCategoriesLink.addEventListener('click', (e) => {
  e.preventDefault();
  const isDropdownVisible = categoriesDropdown.style.display === 'block';
  if (isDropdownVisible) {
    hideMenu(categoriesDropdown);
  } else {
    showMenu(categoriesDropdown);
  }
});

// Handle the child and sub-child menus
const categoryItems = document.querySelectorAll('.category-item');
const subCategoryItems = document.querySelectorAll('.sub-category-item');

// Show sub-menu when hovering over category item
categoryItems.forEach(category => {
  const childMenu = category.querySelector('.sub-menu');
  
  category.addEventListener('mouseenter', () => {
    if (childMenu) showMenu(childMenu);
  });

  category.addEventListener('mouseleave', (event) => {
    if (childMenu && !category.contains(event.relatedTarget)) {
      hideMenu(childMenu);
    }
  });
});

// Show sub-sub-menu when hovering over sub-category item
subCategoryItems.forEach(subCategory => {
  const subChildMenu = subCategory.querySelector('.sub-sub-menu');

  subCategory.addEventListener('mouseenter', () => {
    if (subChildMenu) showMenu(subChildMenu);
  });

  subCategory.addEventListener('mouseleave', (event) => {
    if (subChildMenu && !subCategory.contains(event.relatedTarget)) {
      hideMenu(subChildMenu);
    }
  });
});

	
	
jQuery(document).ready(function($) {
	
	const urlParams = new URLSearchParams(window.location.search);
    const search = urlParams.get('search');
    const state = urlParams.get('state');
	
	if(urlParams && search && state){
	   fetchSuggestions(search, state);
	}
	
	  let previousSuggestions = [];

    // Trigger search suggestions on input
    $('#search-input').on('input', function() {
        const search = $(this).val();
        const state = $('select[name="state"]').val();

        if (search.length > 0) {
            showLoadingIndicator();
            fetchSuggestions(search, state);
        } else {
            hideSuggestions();
        }
    });

    $('#search-input').on('click', function() {
        if (previousSuggestions.length > 0) {
            showSuggestions(previousSuggestions);
        }
    });

     function fetchSuggestions(search, state) {
        $.ajax({
            url: ajax_object.ajax_url, 
            method: 'POST',
            data: {
                action: 'search_products',
                search: search,
                state: state, 
                nonce: ajax_object.nonce 
            },
            success: function(response) {
                hideLoadingIndicator();
                if (response.success) {
                    previousSuggestions = response.data;
                    showSuggestions(response.data);
                } else {
                    hideSuggestions();
                }
            },
            error: function() {
                hideLoadingIndicator();
                hideSuggestions();
            }
        });
    }

    function showLoadingIndicator() {
        $('.loading').show();
    }

    function hideLoadingIndicator() {
        $('.loading').hide();
    }
	
 	function showSuggestions(products) {
        const suggestionsDropdown = $('#suggestions-dropdown');
        suggestionsDropdown.empty();

        products.forEach(product => {
            const item = $('<div class="suggestion-item"></div>').text(product.title);
            item.on('click', function() {
                $('#search-input').val(product.title);
                suggestionsDropdown.hide();
            });

            suggestionsDropdown.append(item);
        });

        suggestionsDropdown.show();
    }


    function hideSuggestions() {
        $('#suggestions-dropdown').hide().empty();
    }
	
    $(document).on('click', function(event) {
        if (!$(event.target).closest('#search-input, #suggestions-dropdown').length) {
            hideSuggestions();
        }
    });

    $('#search-input, #suggestions-dropdown').on('click', function(event) {
        event.stopPropagation();
    });
	
	$('.search-button').on('click', function() {

		const state = $('select[name="state"]').val();
		const s = $('#search-input').val();
		const search = encodeURIComponent(s);
		const stateParam = state ? `&state=${state}` : '';

		window.location.href = `/category?search=${search}${stateParam}`;
    });
});


</script>