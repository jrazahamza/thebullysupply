<?php
/*
* Widget Class
*
* @file           includes/widget.php
* @package        Smart Sections
* @author         Bora Demircan & Ali Metehan Erdem
* @copyright      2017 Theme Gusta
* @license        license.txt
* @version        Release: 1.0.0
*
*/

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/* WP Widget to add widget content created with Visual Composer */
class gusta_vc_widget extends WP_Widget {
    /**
     * Widget constructor.
     *
     * @since  1.0
     *
     * @access public
     */
	 static $add_script;
	 
     function __construct() {
        parent::__construct(
            'gusta_vc_widget', // Base ID
            __( 'Smart Sections Widget', 'mb_framework' ), // Name
            array( 'description' => __( 'Adds a Smart Section to the sidebar widget areas.', 'mb_framework' ), )
        );
		add_action('wp_footer', array( $this, 'gusta_print_script'));
     }
	 
	 /**
     * Widget output.
     *
     * @since  1.0
     *
     * @access public
     * @param  array $args
     * @param  array $instance
     */
     function widget($args, $instance) {
		extract( $args );
		$gusta_sidebar_section = $instance['gusta_sidebar_section'];
		
		echo $before_widget;

		?>
		<div class="widget-text gusta_section_widget">
			<?php

				if( $gusta_sidebar_section ): 
					$post_array = array(
						'post_type' => 'gusta_section', 
						'p' => $gusta_sidebar_section,
					);
					$posts_query = new WP_Query( $post_array );
					if ($posts_query->have_posts()) :
						while ( $posts_query->have_posts() ) : $posts_query->the_post(); ?>
						
							<div id="section-widget-<?php echo $gusta_sidebar_section; ?>" class="gusta_section_widget_container ss-element">
								
								<?php
								$the_content = gusta_fix_shortcodes(get_the_content($gusta_sidebar_section));
								if (strpos($the_content, 'post_listing') !== false):
									self::$add_script = true;
								endif;
								
								do_shortcode(the_content());
								
								if( current_user_can('editor') || current_user_can('administrator') ) :
									echo '<div class="edit-link edit-widget" title="'.__('Edit Custom Widget', 'mb_framework').'">
										<a href="'.get_edit_post_link( $gusta_sidebar_section ).'" target="_blank" class="post-edit-link"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
									</div>';
								endif; ?>
							</div>
						<?php endwhile; wp_reset_postdata();
					endif;
				endif; ?>
		</div>
		<?php
		echo $after_widget;
		
		$widget_css["@media screen"] = get_post_meta( $gusta_sidebar_section, '_wpb_shortcodes_custom_css', true ) . get_post_meta( $gusta_sidebar_section, '_wpb_post_custom_css', true );
		$widget_css = gusta_inline_shortcode_css ( $widget_css, $gusta_sidebar_section, 'section-inner' );
		
		$parse_css = '';
		foreach ($widget_css as $var => $val):
			if ($val): $parse_css .= ' '. $var . ' { ' . $val . ' }'; endif;
		endforeach;				
		
		$parse_css = trim ( preg_replace( '/\s+/', ' ', $parse_css) );

		if ($parse_css!=''): echo '<style id="gusta_inline_widget_css_'.$gusta_sidebar_section.'">'.$parse_css.'</style>'; endif;
	}
	
	/**
     * Saves widget settings.
     *
     * @since  1.0
     *
     * @access public
     * @param  array $new_instance
     * @param  array $old_instance
     * @return array
     */
	 
	static function gusta_print_script() {
        if ( ! self::$add_script )
            return;
        wp_enqueue_script( 'salvattore' );
		wp_enqueue_script( 'loop' );
		wp_localize_script( 'loop', 'loop', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));
    }
	 
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		// Fields
		$instance['gusta_sidebar_section'] = strip_tags($new_instance['gusta_sidebar_section']);
		return $instance;
	}

   /**
     * Prints the settings form.
     *
     * @since  1.0
     *
     * @access public
     * @param  array $instance
     */
     function form($instance) {

		// Check values
		if( $instance):
			$gusta_sidebar_section = esc_attr($instance['gusta_sidebar_section']);
		else:
			$gusta_sidebar_section = '';
		endif;
		?>

		<p>
			<label for="<?php echo $this->get_field_id('gusta_sidebar_section'); ?>"><?php _e( 'Select Section for Sidebar:', 'smart-sections' ); ?></label> 
			<?php 
			$args = array(
				'post_type' => 'gusta_section',
				'meta_query' => array(
					array(
						'key' => 'gusta_section_purpose', 
						'value' => 'sidebar',
					)
				)
			);
			$dropdown = new WP_Query( $args );
			echo '<select name="'.$this->get_field_name('gusta_sidebar_section').'" id="'.$this->get_field_id('gusta_sidebar_section').'">';
			if ( $dropdown->have_posts() ) : 
				
				echo '<option value="">'.__('Select Section','mb_framework').'</option>'; 
				while ( $dropdown->have_posts() ) : $dropdown->the_post(); 
					 echo '<option value="'.get_the_id().'"';
					 if (get_the_id()==$gusta_sidebar_section): echo ' selected="selected"'; endif;
					 echo '>'.get_the_title().'</option>'; 
				endwhile;
				
				wp_reset_postdata();

			endif;
			echo '</select>'; ?>
		</p>
		
		<?php
	}
 }
 
// register gusta_vc_widget widget
function gusta_register_vc_widget () {
	return register_widget("gusta_vc_widget");
}
add_action( 'widgets_init', 'gusta_register_vc_widget' );