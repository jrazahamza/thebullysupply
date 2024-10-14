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
    
    <section class="c_filters-section">
        <div class="c_filters-column">
            <div class="c_filter-group">
                <h2>Stock:</h2>
                <input type="checkbox" name="stock" value="Instock"> In Stock<br>
                <input type="checkbox" name="stock" value="Out of Stock"> Out of Stock<br>
            </div>
            <div class="c_filter-group">
                <h2>Price:</h2>
                <select id="minPrice" name="minPrice">
                    <option value="0">Min</option>
                    <option value="10">$10</option>
                    <option value="20">$20</option>
                    <option value="30">$30</option>
                    <option value="40">$40</option>
                    <option value="50">$50</option>
                    <option value="60">$60</option>
                    <option value="70">$70</option>
                    <option value="80">$80</option>
                    <option value="90">$90</option>
                    <option value="100">$100</option>
                    <!-- Add more options as needed -->
                </select>
                <select id="maxPrice" name="maxPrice">
                    <option value="0">Max</option>
                    <option value="50">$50</option>
                    <option value="100">$100</option>
                    <option value="200">$200</option>
                    <option value="300">$300</option>
                    <option value="400">$400</option>
                    <option value="500">$500</option>
                    <!-- Add more options as needed -->
                </select>
            </div>
            <div class="c_filter-group">
                <h2>Breed:</h2>
                <?php
                    $types=mysqli_query($con,"SELECT * FROM `types` where `status`='1' order by id desc ");      
                    while($type = mysqli_fetch_array($types)){
                ?>
                <input type="checkbox" name="breed" value="<?php echo $type['name']; ?>"> <?php echo $type['name']; ?><br>
                <?php } ?>
                <!-- Add more breed options -->
            </div>
            <div class="c_filter-group">
                <h2>Categories:</h2>
                <?php
                    $categories=mysqli_query($con,"SELECT * FROM `categories` where `status`='1' ");      
                    while($category = mysqli_fetch_array($categories)){
                ?>
                <input type="checkbox" name="categories" value="<?php echo $category['name']; ?>"> <?php echo $category['name']; ?><br>
                <?php } ?>
                <!-- Add more breed options -->
            </div>
        </div>
		
		<section class="m_c_filters-section">
    <div class="m_c_filters-row">
        <div class="m_c_filter-group">
            <label for="stock">Stock:</label>
            <select id="stock" name="stock">
                <option value="">Select Stock</option>
                <option value="Instock">In Stock</option>
                <option value="OutofStock">Out of Stock</option>
            </select>
        </div>
        <div class="m_c_filter-group">
            <label for="priceRange">Price Range:</label>
            <select id="priceRange" name="priceRange">
                <option value="">Select Price Range</option>
                <option value="10-50">$10 - $50</option>
                <option value="50-100">$50 - $100</option>
                <option value="100-200">$100 - $200</option>
                <option value="200-300">$200 - $300</option>
                <option value="300-400">$300 - $400</option>
                <option value="400-500">$400 - $500</option>
            </select>
        </div>
        <div class="m_c_filter-group">
            <label for="breed">Breed:</label>
            <select id="breed" name="breed">
                <option value="">Select Breed</option>
                <?php
                    $types = mysqli_query($con, "SELECT * FROM `types` WHERE `status`='1' ORDER BY id DESC");
                    while ($type = mysqli_fetch_array($types)) {
                        echo "<option value='{$type['name']}'>{$type['name']}</option>";
                    }
                ?>
            </select>
        </div>
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
</section>

		
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
                        $types=mysqli_query($con,"SELECT * FROM `types` where `id`=".$listing["type"]." ");      
                        $type = mysqli_fetch_array($types);
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
                <a href="/product-detail/?id=<?php echo $listing['id']; ?>" class="h_product-card" data-category="<?php echo $categoriesNames; ?>" data-stock="<?php echo $listing['stock']; ?>" data-type="<?php echo $type['name']; ?>" data-title="<?php echo $listing['title']; ?>" data-price="<?php echo $listing['price']; ?>">
                    <?php if($listing['gallery1']!=''){ ?>
                    <img src="<?php echo $listing['gallery1']; ?>" alt="<?php echo $listing['title']; ?>">
                    <?php }else{ ?>
                    <img src="/wp-content/uploads/2024/05/images.png" alt="<?php echo $listing['title']; ?>">
                    <?php } ?>
                    <h3><?php echo $listing['title']; ?></h3>
                    <div class="meta">Type: <?php echo $type['name']; ?> | SKU: <?php echo $listing['stockNumber']; ?></div>
                    <div class="price">$<?php echo $listing['price']; ?></div>
                </a>
                <?php } ?>
            </div>
            
        </div>
    </section>
</div>
<?php
get_footer();
?>
<script>
jQuery(document).ready(function($) {
    // Filtering for all views
    function applyFilters() {
        var stockStatus = $('input[name="stock"]:checked').map(function() {
            return $(this).val();
        }).get();
        var minPrice = parseInt($('#minPrice').val());
        var maxPrice = parseInt($('#maxPrice').val());
        var selectedBreeds = $('input[name="breed"]:checked').map(function() {
            return $(this).val();
        }).get();
        var selectedCategories = $('input[name="categories"]:checked').map(function() {
            return $(this).val();
        }).get();

        $('.h_product-card').each(function() {
            var stock = $(this).data('stock');
            var price = parseInt($(this).data('price'));
            var breed = $(this).data('type');
            var category = $(this).data('category');
            
            var categoryArray = category.split(',');
            var matches = categoryArray.filter(function(item) {
                return selectedCategories.includes(item.trim());
            });

            if ((stockStatus.length === 0 || $.inArray(stock, stockStatus) !== -1) &&
                (minPrice == 0 || price >= minPrice) &&
                (maxPrice == 0 || price <= maxPrice) &&
                (selectedBreeds.length === 0 || $.inArray(breed, selectedBreeds) !== -1) &&
                (selectedCategories.length === 0 || matches.length > 0)) {
                $(this).show(); // Show matching products
            } else {
                $(this).hide(); // Hide non-matching products
            }
        });
    }

    // Mobile view filtering
    const stockFilter = document.getElementById('stock');
    const minPriceFilter = document.getElementById('minPrice');
    const maxPriceFilter = document.getElementById('maxPrice');
    const breedFilter = document.getElementById('breed');
    const categoriesFilter = document.getElementById('categories');

    function applyMobileFilters() {
        const stockStatus = stockFilter.value;
        const minPrice = parseInt(minPriceFilter.value) || 0;
        const maxPrice = parseInt(maxPriceFilter.value) || Infinity;
        const selectedBreed = breedFilter.value;
        const selectedCategory = categoriesFilter.value;

        $('.h_product-card').each(function() {
            const stock = $(this).data('stock');
            const price = parseInt($(this).data('price'));
            const breed = $(this).data('type');
            const category = $(this).data('category');

            const categoryArray = category.split(',');
            const matchesCategory = categoryArray.includes(selectedCategory);

            if ((stockStatus === "" || stock === stockStatus) &&
                (price >= minPrice) &&
                (price <= maxPrice) &&
                (selectedBreed === "" || breed === selectedBreed) &&
                (selectedCategory === "" || matchesCategory)) {
                $(this).show(); // Show matching products
            } else {
                $(this).hide(); // Hide non-matching products
            }
        });
    }

    stockFilter.addEventListener('change', applyMobileFilters);
    minPriceFilter.addEventListener('change', applyMobileFilters);
    maxPriceFilter.addEventListener('change', applyMobileFilters);
    breedFilter.addEventListener('change', applyMobileFilters);
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
    $('.c_filter-group input[type="checkbox"], #minPrice, #maxPrice').change(applyFilters);

    // Apply filters initially
    applyFilters();
    applyMobileFilters();
});
    
    <?php
        if(isset($_GET['category'])){
    ?>    
      jQuery('div.custom-category-page .c_filters-section input[name="categories"][value="Breeders"]').prop('checked', true).trigger('change'); 
    <?php } ?>
    
});
    
</script>