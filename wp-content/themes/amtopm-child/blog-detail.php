<?php
/**
 * Template Name: Blog Detail
 * Description: A custom template for the blog-detail page
 */
get_header();
?>
<style>
.ruk-bully-blog-detail {
    margin: 100px 0px;
}

.ruk-bully-blog-detail .left-column {
  max-width: 70%;
}
.ruk-bully-blog-detail .right-column {
    width: 28%;
}
.ruk-bully-blog-detail .left-column .card h1 {
  font-size: 21px;
  font-weight: 800;
  line-height: 61px;
  color: #000;
  margin-bottom: 32px;
}
.left-column .card {
    border: unset !important;
}
.ruk-bully-blog-detail .left-column .card-img img {
  width: 100%;
  border-radius: 5px;
}
.related-article-title a {
    color: #000;
}
.ruk-bully-blog-detail .desc {
  display: flex;
  align-items: center;
  gap: 6px;
  margin-top: 36px;
  margin-bottom: 20px;
}

.ruk-bully-blog-detail .desc .name {
  font-size: 14px;
  font-weight: 600;
  color: #6d7d8b;
}
.ruk-bully-blog-detail .v-line {
  border-left: 4px solid #bbc8d4;
  height: 10px;
}

.ruk-bully-blog-detail .paras p {
  font-size: 16px;
  font-weight: 500;
  line-height: 31px;
  color: 454545;
}
.ruk-bully-blog-detail .rating {
  /* background-color: gray; */
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 26px;
  margin-top: 80px;
}
.ruk-bully-blog-detail .rating h1 {
  font-size: 21px;
  font-weight: 800;
  color: #000;
}

.ruk-bully-blog-detail .rating .like-dislike {
  font-size: 35px;
}

.ruk-bully-blog-detail .right-column h1 {
  font-size: 21px;
  font-weight: 800;
  color: #000;
  margin-bottom: 29px;
}

.ruk-bully-blog-detail .right-column .card {
  border: 1px solid #eaeaea;
  border-radius: 5px;
  margin-bottom: 29px;
}
.ruk-bully-blog-detail .right-column .card-img img {
  width: 100%;
  border-top-left-radius: 5px;
  border-top-right-radius: 5px;
}

.ruk-bully-blog-detail .right-column .card .right-card-desc {
    padding: 9px;
}
.ruk-bully-blog-detail .right-card-desc h2 {
    font-size: 16px;
    font-weight: bold;
    line-height: 28px;
}
.ruk-bully-blog-detail .right-card-desc p {
    font-size: 12px;
    font-weight: 400;
    line-height: 24px;
    color: #686868;
}
	.ruk-bully-blog-detail .blog-featured-image img {
    max-height: 320px;
}
</style>

<section class="ruk-bully-blog-detail">
	 <div class="container-footer">
      <div class="row">

<?php  
// Start the WordPress Loop
if (have_posts()) :
    while (have_posts()) : the_post(); ?>		  
        <div class="left-column">
          <div class="card">
            <h1>
              <?php the_title(); ?>
            </h1>
            <div class="card-img" style="height: 291px">
				<!-- Blog Post Featured Image -->
				<?php if (has_post_thumbnail()) : ?>
					<div class="blog-featured-image">
						<?php the_post_thumbnail('full'); ?>
					</div>
				<?php endif; ?>							
<!--               <img src="/wp-content/uploads/2024/11/blog-img-1.png" alt="" /> -->
            </div>
            <div class="desc">
              <div class="desc-img">
                <img src="/wp-content/uploads/2024/11/desc-img.png" alt="" />					  
              </div>
              <h3 class="name">By the: <?php the_author(); ?></h3>
              <div class="v-line"></div>
              <h3 class="name"><?php the_date(); ?></h3>
				<div class="v-line"></div>
				<h3 class="name"><?php the_category(', '); ?></h3>
				
            </div>

            <div class="paras">
              <p class="ruk-bully-content">
              <?php the_content(); ?>
              </p>          
            </div>
			   <!-- Blog Post Tags -->
            <div class="ruk-bully-blog-tags">
				<h6>Tag: <?php the_tags('<span>Tags: </span>', ', ', ''); ?></h6>
            </div>
          </div>
        </div>
    <?php endwhile;
else : ?>
    <p>No content found for this post.</p>
<?php endif; ?>
		  
        <div class="right-column">
          <div class="related-post">
            <h1>RELATED ARTICLES</h1>
          </div>
			<?php
			// Get the current post ID and categories
			$current_post_id = get_the_ID();
			$categories = wp_get_post_categories($current_post_id);

			if (!empty($categories)) {
				// Query for related posts
				$related_args = array(
					'category__in' => $categories, // Get posts in the same categories
					'post__not_in' => array($current_post_id), // Exclude the current post
					'posts_per_page' => 4, // Number of related posts to display
				);

				$related_query = new WP_Query($related_args);

				if ($related_query->have_posts()) {
					echo '<div class="related-articles">';
					echo '<div class="card-list">';

					while ($related_query->have_posts()) {
						$related_query->the_post(); ?>

						<div class="card">
							<!-- Display Featured Image -->
							<?php if (has_post_thumbnail()) : ?>
							<div class="card-img">
								<a href="<?php the_permalink(); ?>" class="related-article-image">
									<?php the_post_thumbnail('thumbnail'); // Use 'thumbnail' or another size ?>
								</a>
							</div>
							<?php endif; ?>
				
							<div class="right-card-desc">
							<!-- Display Title -->
							<h2 class="related-article-title">
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h2>

							<!-- Display Excerpt -->
							<p class="related-article-excerpt">
								<?php echo wp_trim_words(get_the_excerpt(), 15, '...'); // Trim excerpt to 15 words ?>
							</p>
							</div>
						</div>

					<?php }
					echo '</div>';
					echo '</div>';
				}

				// Reset the global post data
				wp_reset_postdata();
			}
			?>			      
			
        </div>
      </div>
      <div class="rating">
        <h1>Was This Article Helpful?</h1>
        <div class="like-dislike">
          <img src="/wp-content/uploads/2024/11/thumb-up.png" alt="" />
          <img src="/wp-content/uploads/2024/11/thumb-down.png" alt="" />
        </div>
      </div>
    </div>


</section>


<?php get_footer(); ?>
