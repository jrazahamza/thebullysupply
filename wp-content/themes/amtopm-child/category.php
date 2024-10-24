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
<div class="custom-category-page">
    <div class="c_mock-navigation">
        <div>Home > Dog > Small Dog</div>
    </div>

    <?php echo do_shortcode('[promotedBanner3]'); ?>

<!-- 	start of ruk filter section -->
    <section class="c_filters-section ruk-filter-section">		
		
		<div class="filter-section">
			<h2>Filter</h2>
			<!-- Category / Type Filter -->
			<div class="filter-category">
				<div class="filter-title filter-main-title">
					Category/Type 
				</div>
				<div class="filter-content">
					<!-- Bully Filter -->
					<div class="filter-group parent-gro">

						<div class="filter-content">
							<!-- Bullies Filter -->
							<div class="filter-group parent-gro">
								<div class="filter-content">
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

										echo '<div class="filter-group parent-gro">';
										$category = get_category_name($parent_id);
										echo '<div class="filter-title parent-cta" onclick="toggleFilter(this)">';
										if($parent_id > 0){
											echo '<input type="checkbox" name="categories" value="' . $category->name . '">';
										}
										echo (($parent_id > 0) ? $category->name : 'Categories') . ' <i class="fa ' . ($is_top_level ? 'fa-chevron-up' : 'fa-chevron-down') . '" aria-hidden="true"></i></div>';
										echo '<div class="filter-content" style="display: ' . ($is_top_level ? 'block' : 'none') . ';">';

										foreach ($categories[$parent_id] as $category) {
											if (isset($categories[$category->id])) {
												render_categories($category->id, $categories);
											} else {
												echo '<input type="checkbox" name="categories" value="' . $category->name . '" id="category-' . $category->id . '">';
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
							<div class="filter-category">
								<div class="filter-title filter-main-title">Location</div>
        						<select id="state" name="state[]" class="selectpicker" multiple data-live-search="true">
									<option value="">Select State</option>
									<option value="AL">AL</option> <option value="AK">AK</option>
									<option value="AZ">AZ</option> <option value="AR">AR</option>
									<option value="CA">CA</option> <option value="CO">CO</option>
									<option value="CT">CT</option> <option value="DE">DE</option>
									<option value="FL">FL</option> <option value="GA">GA</option>
									<option value="HI">HI</option> <option value="ID">ID</option>
									<option value="IL">IL</option> <option value="IN">IN</option>
									<option value="IA">IA</option> <option value="KS">KS</option>
									<option value="KY">KY</option> <option value="LA">LA</option>
									<option value="ME">ME</option> <option value="MD">MD</option>																					<option value="MA">MA</option> <option value="MI">MI</option>																					<option value="MN">MN</option> <option value="MS">MS</option>																					<option value="MO">MO</option> <option value="MT">MT</option>
									<option value="NE">NE</option> <option value="NV">NV</option>
									<option value="NH">NH</option> <option value="NJ">NJ</option>
									<option value="NM">NM</option> <option value="NY">NY</option>
									<option value="NC">NC</option> <option value="ND">ND</option>
									<option value="OH">OH</option> <option value="OK">OK</option>
									<option value="OR">OR</option> <option value="PA">PA</option>
									<option value="RI">RI</option> <option value="SC">SC</option>
									<option value="SD">SD</option> <option value="TN">TN</option>
									<option value="TX">TX</option> <option value="UT">UT</option>																					<option value="VT">VT</option> <option value="VA">VA</option>
									<option value="WA">WA</option> <option value="WV">WV</option>
									<option value="WI">WI</option> <option value="WY">WY</option>																					<option value="DC">DC</option> <option value="AS">AS</option>
									<option value="GU">GU</option> <option value="MP">MP</option>
									<option value="PR">PR</option> <option value="VI">VI</option>
								</select>
        						<div class="filter-group selected_states" style="margin-top: 20px;">
<!-- 									<input type="checkbox" id="florida">
									<label for="florida">Florida</label><br> -->
								</div>
							</div>

							<!-- Gender Filter -->
							<div class="filter-category">
								<div class="filter-title filter-main-title">Gender</div>
								<div class="filter-group">
									<input type="radio" id="gender" name="gender" value="1">
									<label for="male">Male</label><br>
									<input type="radio" id="gender" name="gender" value="2">
									<label for="female">Female</label><br>
								</div>
							</div>


							<!-- Ratings Filter -->
							<div class="filter-category">
								<div class="filter-title filter-main-title">Ratings</div>
								<div class="rating-stars">
									<i>&#9733;</i><i>&#9733;</i><i>&#9733;</i><i>&#9733;</i><i>&#9734;</i> <!-- 4 stars and 1 empty star -->
								</div>
							</div>

							<!-- Price Filter -->
							<div class="filter-category">
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
							</div>


							<!-- Age Filter -->
							<div class="filter-category">
								<div class="filter-title filter-main-title">Age</div>
								<div class="slider-group">
									<div class="slider-label">
										<span>0 Years</span><span>80+ Years</span>
									</div>
									<input type="range" min="0" max="80" value="40" id="age-range">
									<div id="selected-age">Selected Age: 40 Years</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
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
                                if($category['id']){
                                    array_push($categoriesNames,$category['name']);
                                }
                            }
                        }
                        $categoriesNames=implode(",",$categoriesNames);
                ?>
                <a href="/product-detail/?id=<?php echo $listing['id']; ?>" class="h_product-card ruk-test" data-category="<?php echo $categoriesNames; ?>" data-state="<?php echo $listing['state']; ?>" data-stock="<?php echo $listing['stock']; ?>" data-type="<?php echo $category['name']; ?>" data-title="<?php echo $listing['title']; ?>" data-price="<?php echo $listing['price']; ?>" data-age="<?php echo $listing['age']; ?>" data-gender="<?php echo $listing['gender']; ?>">
                    <?php if($listing['gallery1']!=''){ ?>
                    <img src="<?php echo $listing['gallery1']; ?>" alt="<?php echo $listing['title']; ?>">
                    <?php }else{ ?>
                    <img src="/wp-content/uploads/2024/05/images.png" alt="<?php echo $listing['title']; ?>">
                    <?php } ?>
                    <h3><?php echo $listing['title']; ?></h3>
                    <div class="meta">Type: <?php echo $category['name']; ?> | SKU: <?php echo $listing['stockNumber']; ?></div>
                    <div class="price">$<?php echo $listing['price']; ?></div>
                </a>
                <?php } ?>
            </div> 
        </div>
    </section>

</div>
	
	
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
	
<?php
get_footer();
?>
<script>
	

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
	
jQuery(document).ready(function($) {
	
	$('select').selectpicker();
	
	const urlParams = new URLSearchParams(window.location.search);
    const paramSearch = urlParams.get('search');
    const paramState = urlParams.get('state');
	
	if(urlParams){
		if(paramState){
			$('#state').selectpicker('val', paramState.split(',')); // Update to handle multiple states

			$('.selected_states').empty();
			paramState.split(',').forEach(state => {
				var label = $('option[value="' + state + '"]').text();
				var checkboxHtml = '<input type="checkbox" class="state-checkbox" id="' + state + '" value="' + state + '" checked> ' +
					'<label for="' + state + '">' + label + '</label><br>';
				$('.selected_states').append(checkboxHtml);
			});
		}
	}
	
	
	$('#state').on('changed.bs.select', function() {
		var selectedValues = $(this).val() || [];
		$('.selected_states').empty();
		selectedValues.forEach(function(value) {
			var label = $('option[value="' + value + '"]').text();
			var checkboxHtml = '<input type="checkbox" class="state-checkbox" id="' + value + '" value="' + value + '" checked> ' +
				'<label for="' + value + '">' + label + '</label><br>';
			$('.selected_states').append(checkboxHtml);
		});
	});

	$(document).on('change', '.state-checkbox', function() {
		var selectedStates = [];
		$('.state-checkbox:checked').each(function() {
			selectedStates.push($(this).val());
		});
		$('#state').selectpicker('val', selectedStates);
	});
	
			
    var selectedPrice = $('#price-range').val();
    $('#selected-price').text('$' + selectedPrice);

    $('#price-range').on('input', function() {
        selectedPrice = $(this).val();
        $('#selected-price').text('$' + selectedPrice);
    });
	
	var selectedAge = $('#age-range').val();
	$('#selected-age').text('Selected Age: ' + selectedAge + ' Years');

	$('#age-range').on('input', function() {
		selectedAge = $(this).val();
		$('#selected-age').text('Selected Age: ' + selectedAge + ' Years');
	});

	
    // Filtering for all views
    function applyFilters(price) {
		console.log('run');
		var minPrice = 0;
		var maxPrice = $('#price-range').val();
		var maxAge = $('#age-range').val();
	    var gender = $('input[name="gender"]:checked').val();

		var selectedCategories = $('input[name="categories"]:checked').map(function() {
			return $(this).val();
		}).get();
		
		var selectedStates = $('#state').val() || [];

		$('.h_product-card').each(function() {
			var price = parseInt($(this).data('price'));
			var age = parseInt($(this).data('age'));
			var category = $(this).data('category');
			var state = $(this).data('state');
			var title = $(this).data('title');

			var categoryArray = category.split(',');
			var matches = categoryArray.filter(function(item) {
				return selectedCategories.includes(item.trim());
			});
			
			var stateArray = state.split(',');
			var stateMatches = stateArray.filter(function(item) {
				return selectedStates.includes(item.trim());
			});

			if ((price <= maxPrice) && (age <= maxAge) && (selectedCategories.length === 0 || matches.length > 0)  && (selectedStates.length === 0 || stateMatches.length > 0) &&
				(gender === undefined || $(this).data('gender') == gender) || (paramSearch && (paramSearch == title))) {
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
	$('.filter-group input[type="checkbox"], #price-range, #age-range, #gender, #state').change(applyFilters);


    // Apply filters initially
    applyFilters();
//     applyMobileFilters();
});

<?php
        if(isset($_GET['category'])){
    ?>
// 	jQuery('div.custom-category-page .c_filters-section input[name="categories"][value="Breeders"]').prop('checked', true).trigger('change');
<?php } ?>

</script>