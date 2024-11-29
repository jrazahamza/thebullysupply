<?php
/**
 * Template Name: blog
 * Description: A custom template for the blog page
 */
get_header();
// Custom query arguments to fetch blog posts
$args = array(
    'post_type' => 'post',       // Fetch only blog posts
    'posts_per_page' => 9,      // Number of posts per page
    'orderby' => 'date',         // Order by date
    'order' => 'DESC',           // Order in descending order
);

// The custom query
$custom_query = new WP_Query($args);

?>
<style>
.thebully-blog-page {
    margin: 100px 0px;
}
.list-blog-post {
	 width: 100%;
	display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 26px;
}
@media screen and (min-width: 1441px) {
	
.list-blog-post {
	 width: 100%;
	display: grid;
    grid-template-columns: repeat(auto-fit, minmax(340px, 1fr));
    gap: 26px;
	}
	}  
	
.blog-post-dev {
    padding: 0;
	border: 1px solid #EAEAEA;
	border-radius: 10px 10px 0px 0px;
}	
/* .blog-post-dev {
    border: 1px solid #EAEAEA;
    width:minmax(456px, 350px) !important;
	width:32% !important;
  padding: 0;
} */
.thebully-blog-page .blog-post-dev .blog-content {
    padding: 19px 9px;
}
.thebully-blog-page .blog-post-dev .blog-post-img{
    min-width: 100%;
    border-radius:10px 10px 0px 0px;
  height: 270px;
}
.blog-post-dev .post-tile {
    color: #000;
    font-size: 16px;
    font-weight: bold;
}
.blog-post-dev .blo-post-description {
    display: none;
}
.blog-post-dev .blog-content p {
    color: #686868;
    font-size:12px;
    padding: 0;
    margin: 0px;
}
</style>

<section class="thebully-blog-page">
	<div class="container-footer">
		<div class="bully-blog-main-heading">
			<h2 class="buly-heading">Blog</h2>
		</div>
		<?php if ($custom_query->have_posts()) : ?>
        <div class="row list-blog-post">
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
                <p class="blo-post-description">
                    <?php the_excerpt(); ?>
                </p>
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



<?php get_footer(); ?>
