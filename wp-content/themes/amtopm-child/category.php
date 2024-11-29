<?php ob_start();
if(session_status() === PHP_SESSION_NONE) {
    session_start();
}
include ('connection.php');
/* 
Template Name: category 
*/   

get_header();
?>
<style>
.show-block-important {
    display: block !important;
}
.pro-none{
  display:none !important;
}	
.selected-age-box{
	display: flex;
}
	
.filter-title i[class*=fa-], span[class*=fa-] {
    font-size: 12px;
}

.ruk-parent-gro .parent-gro:nth-child(1):after {
    content:'';
    width:310px;
    height:1px;
    background-color:#EBEEEF;
    position:absolute;
    
}	
	
.filter-content .parent-gro:nth-child(2):after {
    content:'';
    width:310px;
    height:1px;
    background-color:#EBEEEF;
    position:absolute;
    
}
.filter-content .parent-gro:nth-child(3):after {
    content:'';
    width:310px;
    height:1px;
    background-color:#EBEEEF;
    position:absolute;    
}
/* .filter-content .parent-gro:nth-child(4):after {
    content:'';
    width:310px;
    height:1px;
    background-color:#EBEEEF;
    position:absolute;
    
}
 */
.filter-content .filter-group:nth-child(3):after {
    content:'';
    width:310px;
    height:1px;
    background-color:#EBEEEF;
    position:absolute;
    
}

.filter-content .age:before {
    content:'';
    width:310px;
    height:1px;
    background-color:#EBEEEF;
    position:absolute;
    
}

.filter-content .filter-group:nth-child(2):after {
    content:'';
    width:310px;
    height:1px;
    background-color:#EBEEEF;
    position:absolute;   
}


.filter-content .age:before {
    content:'';
    width:310px;
    height:1px;
    background-color:#EBEEEF;
    position:absolute;
    
}

.filter-content .price:before {
    content:'';
    width:310px;
    height:1px;
    background-color:#EBEEEF;
    position:absolute;
    
}

.ruk-price-filter {
    text-align: left;
    width: 100%;
}

.ruk-price-filter label {
    font-weight: bold;
    color: #1a1a1a;
}

.slider-container {
    position: relative;
    margin-top: 10px;
}

.ruk-price-filter input[type="range"] {
    -webkit-appearance: none;
    appearance: none;
    width: 100%;
    position: absolute;
    top: 0;
    background: transparent;
}

.ruk-price-filter input[type="range"]::-webkit-slider-runnable-track {
    height: 2px;
    background: #e0e0e0;
}

.ruk-price-filter input[type="range"]::-webkit-slider-thumb {
    -webkit-appearance: none;
    appearance: none;
    height: 20px;
    width: 20px;
    background-color: #8B2336;
    border-radius: 50%;
    cursor: pointer;
	 margin-top:-10px;
	position:relative;
	z-index:999;
}

.ruk-price-filter .ruk-price-filter label.price {
   font-size: 18px !important;
   color: #000;
   font-weight: bold;
   padding: 10px 0;
}
.ruk-price-filter .ruk-price-filter label.age {
   font-size: 18px !important;
   color: #000;
   font-weight: bold;
   padding: 10px 0;
}	
.ruk-price-filter .price-values {
    display: flex;
    justify-content: space-between;
    margin-top: 25px;
    font-size: 12px;
    color: #9c9c9c;
}
.ruk-price-filter label.price {
    font-size: 16px !important;   
}
.ruk-price-filter label.age {
    font-size: 16px !important;
}
.ruk-price-filter .selected-text {
    font-size: 12px;
    color: #9c9c9c;
    margin-bottom: 8px;
}
.ruk-price-filter .ruk-price-filter .filter-age {
    margin-top: 26px !important;
}	

.select2-container--default .select2-selection--multiple {
    background-color: white;
    border: 1px solid #EAEAEA !important;
    border-radius: 5px;
    cursor: text;
    padding-bottom: 20px !important;
    padding-top: 11px !important;
    padding-right: 5px !important;
    padding-left: 10px !important;
    position: relative;
    width: 100%;
}
.ruk-left-sidebar-dropdown .select2-selection__rendered {
    margin-left: 0;
}

.select2-container--open .select2-dropdown--below {
     margin-left: 93px !important;
}
.c_text-sorting-column .cta-logad-more {
    text-align: center;
    margin:48px 0px;
}

.c_text-sorting-column .cta-load-more-btn {
    padding: 10px 30px;
    background-color: #0B1E3E;
    color: #fff;
    border: unset;
    border-radius:5px;
    font-family:Manrope;
    font-size:16px;
    font-weight:700
}	
@media only screen and (max-width: 1440px) {
 div.custom-category-page .h_product-card {
/*       max-width: 264px !important;	  */
	}
.ruk-filter-section {
    max-width: 280px;
}

.ruk-parent-gro .parent-gro:nth-child(1):after {
    content:'';
    width:240px;
    height:1px;
    background-color:#EBEEEF;
    position:absolute;
    
}
	
	
.filter-content .parent-gro:nth-child(2):after {
    content:'';
    width:240px;
    height:1px;
    background-color:#EBEEEF;
    position:absolute;
    
}
.filter-content .parent-gro:nth-child(3):after {
    content:'';
    width:240px;
    height:1px;
    background-color:#EBEEEF;
    position:absolute;    
}
/* .filter-content .parent-gro:nth-child(4):after {
    content:'';
    width:240px;
    height:1px;
    background-color:#EBEEEF;
    position:absolute;    
} */

.filter-content .filter-group:nth-child(3):after {
    content:'';
    width:240px;
    height:1px;
    background-color:#EBEEEF;
    position:absolute;
    
}

.filter-content .age:before {
    content:'';
    width:240px;
    height:1px;
    background-color:#EBEEEF;
    position:absolute;
    
}

.filter-content .filter-group:nth-child(2):after {
    content:'';
    width:240px;
    height:1px;
    background-color:#EBEEEF;
    position:absolute;   
}


.filter-content .age:before {
    content:'';
    width:240px;
    height:1px;
    background-color:#EBEEEF;
    position:absolute;
    
}

.filter-content .price:before {
    content:'';
    width:240px;
    height:1px;
    background-color:#EBEEEF;
    position:absolute;
    
}	
	
	
	
}

@media only screen and (max-width: 1366px) {
div.custom-category-page .h_product-card {
    vertical-align: top;
/*     width: 260px !important; */
  }
	
.ruk-filter-section {
    max-width: 260px;
}
	
}	
	
@media only screen and (max-width: 1280px) {
div.custom-category-page .h_product-card {
    vertical-align: top;
/*      width: 236px !important; */
/*     width: max(16vw, 285px); */
  }
	
.ruk-filter-section {
    max-width: 240px;
}

}
	
</style>
<div class="custom-category-page">
    <div class="c_mock-navigation">
        <div>Home > Dog > Small Dog</div>
    </div>

    <?php echo do_shortcode('[promotedBanner3]'); ?>
	<div class="container-footer">
	<div class="category-content">
<!-- 	start of ruk filter section -->
    <section class="c_filters-section ruk-filter-section">		
		
		<div class="filter-section">
			<h2>Filter</h2>
			<!-- Category / Type Filter -->
			<div class="filter-category">
<!-- 				<div class="filter-title filter-main-title">
					Category/Type 
				</div> -->
				<div class="filter-content filter-group-content">
					<!-- Bully Filter -->
					<div class="filter-group parent-gro">

						<div class="filter-content filter-group-content cta-left-filter-sec">
							<!-- Bullies Filter -->
							<div class="filter-group filter-group-main parent-gro main-dropdown">
								<div class="filter-content filter-group-content ruk-parent-gro">
									<!-- Categories Filter -->
									<?php
									$categories = $wpdb->get_results("SELECT * FROM `categories` ORDER BY id ASC");

									$category_hierarchy = [];
									foreach ($categories as $category) {
										$category_hierarchy[$category->parent_id][] = $category;
									}

									function render_categories($parent_id, $categories, $is_top_level = false) {
										if (!isset($categories[$parent_id])) {
											return;
										}

										echo '<div class="filter-group filter-group-categories parent-gro">';
										$category = get_category_name($parent_id);
										echo '<div class="filter-title parent-cta" onclick="toggleFilter(this)">';
										if(($parent_id > 0) && ($category->category_level > 1)){
		$search_selected_category = ((isset($_GET['search_sub_category']) && ($_GET['search_sub_category'] == $category->name)) ? 'checked' : '');
								echo '<span class="input-label"><input type="checkbox" '.$search_selected_category.' name="child_categories" value="' . $category->id . '">';
										}
										echo (($parent_id > 0) ? $category->name : 'Categories') .'</span>'. ' <i class="fa ' . ($is_top_level ? 'fa-chevron-up' : 'fa-chevron-down') . '" aria-hidden="true"></i>                                        </div>';
										echo '<div class="filter-content filter-group-content subsub-cta124" data-name="'.$category->id.'" style="display: ' . ($is_top_level || ($parent_id == 0) ? 'block' : 'none') . ';">';

										foreach ($categories[$parent_id] as $category) {
											if (isset($categories[$category->id])) {
												render_categories($category->id, $categories);
											} else {
		$search_selected_sub_sub_category = ((isset($_GET['search_sub_sub_category']) && ($_GET['search_sub_sub_category'] == $category->name)) ? 'checked' : '');
												
		echo '<input type="checkbox" '.$search_selected_sub_sub_category.' name="categories" value="' . $category->name.$category->parent_id . '" id="category-' . $category->id . '">';
												echo '<label for="category-' . $category->id . '">' . $category->name . '</label><br>';
											}
										}

										echo '</div></div>';
									}

									function get_category_name($id) {
										global $wpdb;
										if ($id > 0) {
											$category = $wpdb->get_row("SELECT * FROM `categories` WHERE id = $id");
											return $category ? $category : 'Unknown';
										}
										return 'Categories';
									}

									render_categories(0, $category_hierarchy);
									?>
								</div>
							</div>


							<!-- Location Filter -->
							<div class="filter-category location-filter">
								<div class="filter-title filter-main-title">Location</div>
								<div class="ruk-select-dropdown ruk-left-sidebar-dropdown">									
									<select id="state" name="state[]" class="ruk-state-select state2" multiple data-live-search="true">
										<option value="">Locations</option>
										<option value="AL">AL</option> <option value="AK">AK</option>
										<option value="AZ">AZ</option> <option value="AR">AR</option>
										<option value="CA">CA</option> <option value="CO">CO</option>
										<option value="CT">CT</option> <option value="DE">DE</option>
										<option value="FL">FL</option> <option value="GA">GA</option>
										<option value="HI">HI</option> <option value="ID">ID</option>
										<option value="IL">IL</option> <option value="IN">IN</option>
										<option value="IA">IA</option> <option value="KS">KS</option>
										<option value="KY">KY</option> <option value="LA">LA</option>
										<option value="ME">ME</option> <option value="MD">MD</option>
										<option value="MA">MA</option> <option value="MI">MI</option>
										<option value="MN">MN</option> <option value="MS">MS</option>
										<option value="MO">MO</option> <option value="MT">MT</option>
										<option value="NE">NE</option> <option value="NV">NV</option>
										<option value="NH">NH</option> <option value="NJ">NJ</option>
										<option value="NM">NM</option> <option value="NY">NY</option>
										<option value="NC">NC</option> <option value="ND">ND</option>
										<option value="OH">OH</option> <option value="OK">OK</option>
										<option value="OR">OR</option> <option value="PA">PA</option>
										<option value="RI">RI</option> <option value="SC">SC</option>
										<option value="SD">SD</option> <option value="TN">TN</option>
										<option value="TX">TX</option> <option value="UT">UT</option>
										<option value="VT">VT</option> <option value="VA">VA</option>
										<option value="WA">WA</option> <option value="WV">WV</option>
										<option value="WI">WI</option> <option value="WY">WY</option>
										<option value="DC">DC</option> <option value="AS">AS</option>
										<option value="GU">GU</option> <option value="MP">MP</option>
										<option value="PR">PR</option> <option value="VI">VI</option>
									</select>
                                </div>
        						<div class="filter-group selected_states" style="margin-top: 20px;"></div>
							</div>

							<!-- Gender Filter -->
							<div class="filter-category">
								<div class="filter-title filter-main-title">Gender</div>
								<div class="filter-group">
									<input type="checkbox" id="gender" name="gender" value="1">
									<label for="male">Male</label><br>
									<input type="checkbox" id="gender" name="gender" value="2">
									<label for="female">Female</label><br>
								</div>
							</div>


							<!-- Ratings Filter -->
							<div class="filter-category ratings">
								<div class="filter-title filter-main-title">Ratings</div>
								<div class="rating-stars">
									<i>&#9733;</i><i>&#9733;</i><i>&#9733;</i><i>&#9733;</i><i>&#9734;</i> <!-- 4 stars and 1 empty star -->
								</div>
							</div>

							<!-- Price Filter -->
<!-- 							<div class="filter-category price">
								<div class="filter-title filter-main-title">Price</div>
								<div class="slider-group">
									<div class="slider-label">
										<span id="min-price">$0</span>
										<span id="max-price">$10,000</span>
									</div>
									<input type="range" min="0" max="10000" value="5000" id="price-range">
									<div>
										Selected Price: <span id="selected-price">$5000</span>
									</div>
								</div>
							</div> -->


							<!-- Age Filter -->
<!-- 							<div class="filter-category age">
								<div class="filter-title filter-main-title">Age</div>
								<div class="slider-group">
									<div class="slider-label">
										<span>0 Years</span><span>80+ Years</span>
									</div>
									<input type="range" min="0" max="80" value="40" id="age-range">
									<div id="selected-age">Selected Age: 40 Years</div>
								</div>
							</div> -->
							
							<div class="ruk-price-filter filter-price">
								<label for="price" class="price">Price</label>
								<div class="slider-container">
									<input type="range" id="ruk-min-price" name="ruk-min-price" min="0" max="10000" step="100" value="0">
									<input type="range" id="ruk-max-price" name="ruk-max-price" min="0" max="10000" step="100" value="10000">
								</div>
								<div class="price-values ruk-price-value">
									<span id="ruk-min-price-label">$0</span>
									<span id="ruk-max-price-label">$10,000</span>
								</div>
								<div class="selected-text">
									Selected Price: <span id="selected-price">$0</span>
								</div>								
							</div>

							<div class="ruk-price-filter filter-age">
								<label for="price" class="age">Age</label>
								<div class="slider-container">
									<input type="range" id="ruk-min-age" name="ruk-min-age" min="0" max="100" step="5" value="0">
									<input type="range" id="ruk-max-age" name="ruk-max-age" min="0" max="100" step="5" value="100">
								</div>
								<div class="price-values ruk-age-value">
									<span id="ruk-min-age-label">5 Year</span>
									<span id="ruk-max-age-label">90 Year</span>
								</div>
								<div class="selected-age-box selected-text">
									Selected Age: <div id="selected-age"> 5 </div> Years
								</div>
							</div>
							
							
							
						</div>
					</div>
				</div>
			</div>
		</div>


	</section>
	<section class="m_c_filters-section">
			<div class="m_c_filters-row">
				<div class="m_c_filter-group">
					<label for="categories">Categories:</label>
					<select id="categories" name="categories">
						<option value="">Select Category</option>
						<?php
						$categories = mysqli_query($con, "SELECT * FROM `categories` WHERE `status`='1'");
						while ($category = mysqli_fetch_array($categories)) {
							echo "<option value='{$category['name']}'>{$category['name']}</option>";
						}
						?>
					</select>
				</div>
			</div>

		
        <div class="c_text-sorting-column">
            <div class="c_container">
				<div class="c_text-content">
					<h2>Explore Our Pets</h2>
					<!-- Add more text content here -->
				</div>
				<div class="c_sorting-dropdown">
					<label for="sorting">Sort By:</label>
					<select name="sorting" id="sorting">						
						<option value="name">Name</option>
						<option value="price">Price</option>
					</select>
				</div>
			</div>
            <div class="c_product-grid" id="main-product-gird"> 
                <?php
                    $listings=mysqli_query($con,"SELECT * FROM `listings` where `status`='active' order by id desc ");      
                    while($listing = mysqli_fetch_array($listings)){
                        $categories=mysqli_query($con,"SELECT * FROM `categories` where `id`=".$listing["category"]." ");      
                        $category = mysqli_fetch_array($categories);
                        $categoriesNames=array();
                        if($listing['category']!=''){
                            $categoriesList=explode(',',$listing['category']);
                            for($z=0;$z<count($categoriesList);$z++){
                                $categories=mysqli_query($con,"SELECT * FROM `categories` where `id`=".$categoriesList[$z]." ");      
                                $category = mysqli_fetch_array($categories);
                                if(@$category['id']){
                                    array_push($categoriesNames,$category['name'].$category['parent_id']);
                                }
                            }
                        }
                        $categoriesNames=implode(",",$categoriesNames);
                ?>
                <a href="/product-detail/?id=<?php echo @$listing['id']; ?>" class="h_product-card ruk-test" data-category="<?php echo @$categoriesNames; ?>" data-state="<?php echo @$listing['state']; ?>" data-stock="<?php echo @$listing['stock']; ?>" data-type="<?php echo @$category['name']; ?>" data-title="<?php echo @$listing['title']; ?>" data-price="<?php echo @$listing['price']; ?>" data-age="<?php echo @$listing['age']; ?>" data-gender="<?php echo @$listing['gender']; ?>">
                    <?php if($listing['gallery1']!=''){ ?>
                    <img src="<?php echo $listing['gallery1']; ?>" alt="<?php echo $listing['title']; ?>">
                    <?php }else{ ?>
                    <img src="/wp-content/uploads/2024/05/images.png" alt="<?php echo $listing['title']; ?>">
                    <?php } ?>
                    <h3><?php echo $listing['title']; ?></h3>
                    <div class="meta">Category: <?php echo @$category['name']; ?></div>
                    <div class="price">$<?php echo $listing['price']; ?></div>
                </a>
                <?php } ?>
            </div> 
<!-- 			<div class="cta-logad-more">
				<button class="cta-load-more-btn" id="load-more">Load More</button>
			</div> -->
        </div>
    </section>
	</div>
	</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<?php
get_footer();
?>
<script>
/* 
document.addEventListener('DOMContentLoaded', function () {
    const products = document.querySelectorAll('#main-product-gird .ruk-test');
    const loadMoreButton = document.getElementById('load-more');
    const initialProductsToShow = 9;
    const additionalProductsToShow = 6;
    let productsDisplayed = initialProductsToShow;

    if (products.length <= initialProductsToShow) {
        loadMoreButton.style.display = 'none';
    }

    products.forEach((product, index) => {
        if (index >= initialProductsToShow) {
            product.classList.add('pro-none');
              
        } else {

			product.classList.remove('pro-none')
        }
    });

    loadMoreButton.addEventListener('click', function () {		

        const nextProductsToShow = productsDisplayed + additionalProductsToShow;
        products.forEach((product, index) => {
            if (index < nextProductsToShow) {

				product.classList.remove('pro-none');
            }
        });

        productsDisplayed = nextProductsToShow;


        if (productsDisplayed >= products.length) {
            loadMoreButton.style.display = 'none'; // Hide button
        }
    });
});
*/
	
// 	price
const minPrice = document.getElementById('ruk-min-price');
const maxPrice = document.getElementById('ruk-max-price');
const minPriceLabel = document.getElementById('ruk-min-price-label');
const maxPriceLabel = document.getElementById('ruk-max-price-label');
var selectedPriceLabel = document.getElementById('selected-price');

minPrice.addEventListener('input', updatePriceLabels);
maxPrice.addEventListener('input', updatePriceLabels);

function updatePriceLabels() {
    let minValue = parseInt(minPrice.value);
    let maxValue = parseInt(maxPrice.value);

    // Ensure min value is never greater than max value
    if (minValue >= maxValue) {
        minValue = maxValue - 100;
        minPrice.value = minValue;
    }

    // Ensure max value is never less than min value
    if (maxValue <= minValue) {
        maxValue = minValue + 100;
        maxPrice.value = maxValue;
    }

    minPriceLabel.textContent = `$${minValue.toLocaleString()}`;
    maxPriceLabel.textContent = `$${maxValue.toLocaleString()}`;
    selectedPriceLabel.textContent = `$${minValue.toLocaleString()} - $${maxValue.toLocaleString()}`;
}
	
	
	
// 	age
const minAge = document.getElementById('ruk-min-age');
const maxAge = document.getElementById('ruk-max-age');
const minAgeLabel = document.getElementById('ruk-min-age-label');
const maxAgeLabel = document.getElementById('ruk-max-age-label');
const selectedAgeLabel = document.getElementById('selected-age');

minAge.addEventListener('input', updateAgeLabels);
maxAge.addEventListener('input', updateAgeLabels);

function updateAgeLabels() {
    let minValue = parseInt(minAge.value);
    let maxValue = parseInt(maxAge.value);

    // Ensure min value is never greater than max value
    if (minValue >= maxValue) {
        minValue = maxValue - 100;
        minAge.value = minValue;
    }

    // Ensure max value is never less than min value
    if (maxValue <= minValue) {
        maxValue = minValue + 100;
        maxAge.value = maxValue;
    }

    minAgeLabel.textContent = `${minValue.toLocaleString()}`;
    maxAgeLabel.textContent = `${maxValue.toLocaleString()}`;
	selectedAgeLabel.textContent = `${minValue.toLocaleString()} - ${maxValue.toLocaleString()}`;
}
	

	
function toggleFilter(element) {
    const content = element.nextElementSibling;
    const parent = element.parentElement;
    const icon = element.querySelector('i');

    if (content) {
        if (content.style.display === "block") {
            content.style.display = "none";
            icon.classList.remove("fa-chevron-up");
            icon.classList.add("fa-chevron-down");
        } else {
            content.style.display = "block";
            icon.classList.remove("fa-chevron-down");
            icon.classList.add("fa-chevron-up");
        }
    }
    parent.classList.toggle("collapsed");
}
	
	
	function toggleChildCategoriesOnReady() {
		$('input[name="child_categories"]').each(function() {
			var isChecked = $(this).is(':checked');
			if (isChecked) {
				let child_categories = $(this).closest('.filter-group-categories').find('input[name="categories"]').prop('checked', true);
					
				let parent = $(child_categories.closest('.filter-group-categories')).closest('.filter-group-content');
				let child = $(child_categories.closest('.filter-group-categories')).find('.filter-group-content');
				parent.addClass('show-block-important');
				child.addClass('show-block-important');
			}
		});
	}
	
	function checkSingleChildCategoriesOnReady() {
		$('input[name="categories"]').each(function() {
			var isChecked = $(this).is(':checked');
			if (isChecked) {
				$(this).prop('checked', true);
			}
		});
	}
	
jQuery(document).ready(function($) {
	
 	$('.state2').select2({
        placeholder: 'Locations',
        allowClear: true
    });
	
	const urlParams = new URLSearchParams(window.location.search);
    const paramSearch = urlParams.get('search');
    const paramState = urlParams.get('state');
	const paramSearchSubCategory = urlParams.get('search_sub_category');
	const paramSearchSubSubCategory = urlParams.get('search_sub_sub_category');
	
	const food_and_supplement = urlParams.get('search_food_and_supplement');
	const supplies_categories = urlParams.get('search_supplies_category');
	const care_services = urlParams.get('search_care_services');
	
	
	function toggleDropdownOnReady() {
		if (paramSearchSubCategory) {			
			let parentCategory = document.querySelector(`input[name="child_categories"][value="${paramSearchSubCategory}"]`);
			if (parentCategory) {
				parentCategory.checked = true;
				let parentToggleElement = parentCategory.closest('.filter-group-categories').querySelector('.filter-main-title');
				parentCategory.closest('.filter-group-categories').classList.add('parent-gro');
			
		let topParent = $($(parentCategory.closest('.filter-group-categories')).closest('.filter-group-content')).closest('.filter-group-content');
				let parent = $(parentCategory.closest('.filter-group-categories')).closest('.filter-group-content');
				let child = $(parentCategory.closest('.filter-group-categories')).find('.filter-group-content');

				topParent.addClass('show-block-important');
				parent.addClass('show-block-important');
				child.addClass('show-block-important');
	
			}
		}

		if (paramSearchSubSubCategory) {
			let childCategory = document.querySelector(`input[name="categories"][value="${paramSearchSubSubCategory}"]`);
			if (childCategory) {
				childCategory.checked = true;
				let childToggleElement = childCategory.closest('.filter-group-categories').querySelector('.filter-main-title');
				
		let topParent = $($(childCategory.closest('.filter-group-categories')).closest('.filter-group-content')).closest('.filter-group-content');
				let parent = $(childCategory.closest('.filter-group-categories')).closest('.filter-group-content');
				let child = $(childCategory.closest('.filter-group-categories')).find('.filter-group-content');

				topParent.addClass('show-block-important');
				parent.addClass('show-block-important');
				child.addClass('show-block-important');
			}
		}
		
		if (food_and_supplement) {
			const foodSupplementValues = ['category-47', 'category-48', 'category-49', 'category-50', 'category-51', 'category-52', 'category-53', 'category-54', 'category-55'];

			foodSupplementValues.forEach(categoryId => {
				let childCategory = document.querySelector(`input[name="categories"][id="${categoryId}"]`);

				if (childCategory) {
					childCategory.checked = true;
					let childToggleElement = childCategory.closest('.filter-group-categories').querySelector('.filter-main-title');
					
		let topParent = $($(childCategory.closest('.filter-group-categories')).closest('.filter-group-content')).closest('.filter-group-content');
					let parent = $(childCategory.closest('.filter-group-categories')).closest('.filter-group-content');
					let child = $(childCategory.closest('.filter-group-categories')).find('.filter-group-content');

					topParent.addClass('show-block-important');
					parent.addClass('show-block-important');
					child.addClass('show-block-important');
				}
			});
		}
		if (supplies_categories) {
			const suppliesCategoriesValues = ['38', '39', '40', '41', '42', '43', '44', '45', '46'];

			suppliesCategoriesValues.forEach(categoryId => {
				let childCategory = document.querySelector(`input[name="child_categories"][value="${categoryId}"]`);

				if (childCategory) {
					childCategory.checked = true;
					let childToggleElement = childCategory.closest('.filter-group-categories').querySelector('.filter-main-title');
					toggleFilter(childToggleElement);

					let subCategoryCheckboxes = childCategory.closest('.filter-group-categories').querySelectorAll(`input[name="categories"][value*="${categoryId}"]`);
					subCategoryCheckboxes.forEach(subCategoryCheckbox => {
						subCategoryCheckbox.checked = true;
						
		let topParent = $($(childCategory.closest('.filter-group-categories')).closest('.filter-group-content')).closest('.filter-group-content');
						let parent = $(childCategory.closest('.filter-group-categories')).closest('.filter-group-content');
						let child = $(childCategory.closest('.filter-group-categories')).find('.filter-group-content');

						topParent.addClass('show-block-important');
						parent.addClass('show-block-important');
						child.addClass('show-block-important');
					});

				}
			});
		}
		if (care_services) {
			const careServicesValues = ['56', '57', '58', '59'];

			careServicesValues.forEach(categoryId => {
				let childCategory = document.querySelector(`input[name="child_categories"][value="${categoryId}"]`);

				if (childCategory) {
					childCategory.checked = true;
					let childToggleElement = childCategory.closest('.filter-group-categories').querySelector('.filter-main-title');
					console.log('childToggleElement', childToggleElement);
					toggleFilter(childToggleElement);

					let subCategoryCheckboxes = childCategory.closest('.filter-group-categories').querySelectorAll(`input[name="categories"][value*="${categoryId}"]`);
					subCategoryCheckboxes.forEach(subCategoryCheckbox => {
						subCategoryCheckbox.checked = true;
						
		let topParent = $($(childCategory.closest('.filter-group-categories')).closest('.filter-group-content')).closest('.filter-group-content');
						let parent = $(childCategory.closest('.filter-group-categories')).closest('.filter-group-content');
						let child = $(childCategory.closest('.filter-group-categories')).find('.filter-group-content');

						topParent.addClass('show-block-important');
						parent.addClass('show-block-important');
						child.addClass('show-block-important');
					});
				}
			});
		}

	}
	
	function selectNestedCategories(parentCheckbox) {
		var isChecked = $(parentCheckbox).is(':checked');
		$(parentCheckbox).closest('.filter-group-categories').find('input[name="categories"]').prop('checked', isChecked);
		applyFilters();
	}
	
	if(urlParams){
		 if (paramState) {
			let statesArray = paramState.split(',');
			$('.state2').val(statesArray).trigger('change');
			$('.selected_states').empty();
			 
			statesArray.forEach(state => {
				var label = $('option[value="' + state + '"]').text();
				var checkboxHtml = `
					<input type="checkbox" class="state-checkbox" id="${state}" value="${state}" checked> 
					<label for="${state}">${label}</label><br>
				`;
				$('.selected_states').append(checkboxHtml);
			});
		}
		if (paramSearchSubCategory) {
			toggleChildCategoriesOnReady();
		}
		if (paramSearchSubSubCategory) {
			checkSingleChildCategoriesOnReady();
		}
		toggleDropdownOnReady();
	}
	
    $('.state2').on('select2:select select2:unselect', function () {
        var selectedValues = $(this).val() || [];
        $('.selected_states').empty(); // Clear the checkboxes

        selectedValues.forEach(function(value) {
            var label = $('option[value="' + value + '"]').text();
            var checkboxHtml = `
                <input type="checkbox" class="state-checkbox" id="${value}" value="${value}" checked> 
                <label for="${value}">${label}</label><br>
            `;
            $('.selected_states').append(checkboxHtml);
        });

        bindCheckboxChangeEvent();
    });

	
	function toggleFilter(element) {
		console.log('element', element);
		$(element).siblings('.filter-group-content').toggle();
	}

	$('input[name="child_categories"]').on('change', function() {
		selectNestedCategories(this);
	});
	
    // Filtering for all views
    function applyFilters(price) {
		console.log('run');        
		var minPrice = parseInt($('#ruk-min-price').val());
        var maxPrice = parseInt($('#ruk-max-price').val());
		var minAge = parseInt($('#ruk-min-age').val());
        var maxAge = parseInt($('#ruk-max-age').val());

		 var selectedGenders = $('input[name="gender"]:checked').map(function() {
			return $(this).val();
		}).get();

		var selectedCategories = $('input[name="categories"]:checked').map(function() {
			return $(this).val();
		}).get();
		
		var selectedStates = $('.state2').val() || [];

		$('.h_product-card').each(function() {
			var price = parseInt($(this).data('price'));
			var age = parseInt($(this).data('age'));
			var category = $(this).data('category');
			var state = $(this).data('state');
			var title = $(this).data('title');
			var gender = $(this).data('gender');
			
			var genderArray = gender ? gender.toString().split(',') : [];
			var genderMatches = selectedGenders.length === 0 || genderArray.some(function(g) {
				return selectedGenders.includes(g.trim());
			});

			var categoryArray = category.split(',');
			var matches = categoryArray.filter(function(item) {
				return selectedCategories.includes(item.trim());
			});
			
			var stateArray = state.split(',');
			var stateMatches = stateArray.filter(function(item) {
				return selectedStates.includes(item.trim());
			});

			if ( (minPrice == 0 || price >= minPrice) &&
                (maxPrice == 0 || price <= maxPrice) && 
				(minAge == 0 || age >= minAge) &&
                (maxAge == 0 || age <= maxAge) && (selectedCategories.length === 0 || matches.length > 0)  
				&& (selectedStates.length === 0 || stateMatches.length > 0)
				&& genderMatches 
				&& (paramSearch === null || title.toLowerCase().includes(paramSearch.toLowerCase()))) {
				$(this).show();
			} else {
				$(this).hide();
			}
		});
	}


    // Mobile view filtering
    const minPriceFilter = "0";
    const maxPriceFilter = $('#price-range').val();
    const categoriesFilter = document.getElementById('categories');

    function applyMobileFilters() {
        const minPrice = parseInt(minPriceFilter.value) || 0;
        const maxPrice = parseInt(maxPriceFilter.value) || Infinity;
        const selectedCategory = categoriesFilter.value;

        $('.h_product-card').each(function() {
            const price = parseInt($(this).data('price'));
            const category = $(this).data('category');
			
			var productGender = $(this).data('gender');			
	
            const categoryArray = category.split(',');
            const matchesCategory = categoryArray.includes(selectedCategory);

            if ((price >= minPrice) && (selectedCategory === "" || matchesCategory)) {
                $(this).show(); // Show matching products
            } else {
                $(this).hide(); // Hide non-matching products
            }
        });
    }

    categoriesFilter.addEventListener('change', applyMobileFilters);

    // Sorting
    $('#sorting').on('change', function(){
        var sortBy = $(this).val();
        var list = $('#main-product-gird');

        if(sortBy === 'name') {
            var sortedList = list.children('a').sort(function(a, b) {
                return $(a).data('title').localeCompare($(b).data('title'));
            });
        } else if(sortBy === 'price') {
            var sortedList = list.children('a').sort(function(a, b) {
                return parseFloat($(a).data('price')) - parseFloat($(b).data('price'));
            });
        }

        list.empty().append(sortedList);
    });

    // Listen for filter changes
	$('.filter-group-main input[type="checkbox"], #ruk-min-price, #ruk-max-price, #ruk-min-age, #ruk-max-age, #gender, .state2').change(applyFilters);


    // Apply filters initially
    applyFilters();
//     applyMobileFilters();
});
	
	// Separate function to bind checkbox change event
function bindCheckboxChangeEvent() {
    $('.state-checkbox').off('change').on('change', function() {
        var selectedStates = [];
        $('.state-checkbox:checked').each(function() {
            selectedStates.push($(this).val());
        });
        $('.state2').val(selectedStates).trigger('change');
    });
}

<?php
        if(isset($_GET['category'])){
    ?>
// 	jQuery('div.custom-category-page .c_filters-section input[name="categories"][value="Breeders"]').prop('checked', true).trigger('change');
<?php } ?>

</script>