<?php
/*
* Add Theme Option Fields to Option Pages and Custom Meta Boxes
*
* @file           admin/option-fields.php
* @package        Smart Sections
* @author         Bora Demircan & Ali Metehan Erdem
* @copyright      2017 Theme Gusta
* @license        license.txt
* @version        Release: 1.5.8
*
*/

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
if (is_admin()):

//Outputs the current admin page name
if( !function_exists('gusta_get_admin_page') ):
	function gusta_get_admin_page () {
		global $wp;
		if (defined('GUSTA_ADMIN_PAGE')): return GUSTA_ADMIN_PAGE; endif;
		$current_path = $_SERVER['PHP_SELF'];
		if (isset($_GET["taxonomy"])):
			$post_type = $_GET["taxonomy"];
			if (($post_type!='category') && ($post_type!='post_tag')): $post_type = 'tax'; endif;
		elseif (isset($_GET["post"])):
			$post_type = get_post_type($_GET["post"]);
			if (($post_type!='page') && ($post_type!='post') && ($post_type!='gusta_section')): $post_type = 'cpt'; endif;
		elseif (strpos($current_path, 'post-new.php') !== false):
			$post_type = (isset($_GET["post_type"]) ? $_GET["post_type"] : 'post');
			if (($post_type!='page') && ($post_type!='post') && ($post_type!='gusta_section')): $post_type = 'cpt'; endif;
		elseif ((strpos($current_path, 'profile.php') !== false) || (strpos($current_path, 'user-edit.php') !== false) || (strpos($current_path, 'user_new.php') !== false)):
			$post_type = 'author';
		elseif (strpos($current_path, 'nav-menus.php') !== false):
			$post_type = 'menu';
		else:
			$post_type = '';
		endif;
		define ('GUSTA_ADMIN_PAGE', $post_type);
		return $post_type;
	}
endif;

//ACF Fields added
add_action( 'wp_loaded', 'register_post_options', 20 );
function register_post_options() {
	
	if( function_exists('acf_add_local_field_group') ):
	
	$gusta_admin_page = gusta_get_admin_page();
		
	function gusta_sections_array() {
		static $gusta_sections_array;
		if (!is_null($gusta_sections_array)):
			return $gusta_sections_array;
		endif;
		$gusta_sections_array = array();
		$gusta_sections_array['content'] = array();
		$gusta_sections_array['header'] = array();
		$gusta_sections_array['mega_menu'] = array();
		$gusta_sections_array['footer'] = array();
		$gusta_sections_array['sidebar'] = array();
		$gusta_sections_array['card'] = array();
		$gusta_sections_array['sticky'] = array();
		$sections = new WP_Query( array( 'post_type' => 'gusta_section', 'posts_per_page' => -1 ) );
		foreach ($sections->posts as $post):
			$purpose = get_post_meta($post->ID, 'gusta_section_purpose', true);
			if ($purpose=='vertical'): $purpose = 'header'; endif;
			$gusta_sections_array[$purpose][$post->ID] = $post->post_title;
		endforeach;
		return $gusta_sections_array;
	}
	$sections_array = gusta_sections_array();
	$content_sections_array = $sections_array['content'] + $sections_array['sidebar'];
	$header_sections_array = $sections_array['header'];	
	$mega_menu_sections_array = $sections_array['mega_menu'];
	$footer_sections_array = $sections_array['footer'];
	$sidebar_sections_array = $sections_array['sidebar'];
	$card_sections_array = $sections_array['card'];
	$sticky_sections_array = $sections_array['sticky'];
	
	
	/*
	

	Upload Your Own Font


	*/
	if (isset($_GET["page"]) && ($_GET["page"]=="gusta-font-manager")):
		acf_add_local_field_group(array (
			'key' => 'group_58cc875276332',
			'title' => __('Upload Your Own Fonts', 'mb_framework'),
			'fields' => array (
				array (
					'key' => 'field_58cc8769d7022',
					'label' => __('Add New Font', 'mb_framework'),
					'name' => 'gusta_add_new_font',
					'type' => 'repeater',
					'instructions' => __('Upload the files of your font.', 'mb_framework'),
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'collapsed' => 'field_58cc8b69a4c69',
					'min' => 0,
					'max' => 0,
					'layout' => 'row',
					'button_label' => __('Add New Font', 'mb_framework'),
					'sub_fields' => array (
						array (
							'key' => 'field_58cc8b69a4c69',
							'label' => __('Font Name', 'mb_framework'),
							'name' => 'custom_font_name',
							'type' => 'text',
							'instructions' => __('This name will be used in the font-family selection field.', 'mb_framework'),
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array (
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'default_value' => '',
							'placeholder' => '',
							'prepend' => '',
							'append' => '',
							'maxlength' => '',
						),
						array (
							'key' => 'field_58cc8796d7023',
							'label' => __('WOFF', 'mb_framework'),
							'name' => 'woff',
							'type' => 'file',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array (
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'return_format' => 'url',
							'library' => 'all',
							'min_size' => '',
							'max_size' => '',
							'mime_types' => '',
						),
						array (
							'key' => 'field_58cc87bdd7024',
							'label' => __('WOFF2', 'mb_framework'),
							'name' => 'woff2',
							'type' => 'file',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array (
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'return_format' => 'url',
							'library' => 'all',
							'min_size' => '',
							'max_size' => '',
							'mime_types' => '',
						),
						array (
							'key' => 'field_58cc87cbd7025',
							'label' => __('TTF', 'mb_framework'),
							'name' => 'ttf',
							'type' => 'file',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array (
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'return_format' => 'url',
							'library' => 'all',
							'min_size' => '',
							'max_size' => '',
							'mime_types' => '',
						),
						array (
							'key' => 'field_58cc87ded7026',
							'label' => __('SVG', 'mb_framework'),
							'name' => 'svg',
							'type' => 'file',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array (
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'return_format' => 'url',
							'library' => 'all',
							'min_size' => '',
							'max_size' => '',
							'mime_types' => '',
						),
						array (
							'key' => 'field_58cc87e8d7027',
							'label' => __('EOT', 'mb_framework'),
							'name' => 'eot',
							'type' => 'file',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array (
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'return_format' => 'url',
							'library' => 'all',
							'min_size' => '',
							'max_size' => '',
							'mime_types' => '',
						),
					),
				),
			),
			'location' => array (
				array (
					array (
						'param' => 'options_page',
						'operator' => '==',
						'value' => 'gusta-font-manager',
					),
				),
			),
			'menu_order' => 3,
			'position' => 'normal',
			'style' => 'default',
			'label_placement' => 'top',
			'instruction_placement' => 'label',
			'hide_on_screen' => '',
			'active' => 1,
			'description' => '',
		));
	endif;

	/*
		
		
	Font Manager


	*/
	if (isset($_GET["page"]) && ($_GET["page"]=="gusta-font-manager")):
		acf_add_local_field_group(array (
			'key' => 'gusta_font_manager_navigation',
			'title' => __('Help', 'mb_framework'),
			'fields' => array (
				array (
					'key' => 'gusta_font_manager_navigation_message',
					'label' => '',
					'type' => 'message',
					'name' => '',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'message' => '<p><a class="smart-sections-sidebar-help" href="https://www.youtube.com/watch?v=iAZ5rOJz1ek&index=4&list=PLhHXQ5n2SiyHgqG7qr-DMLKkJSu3N-7fO" target="_blank">'.__('Font Manager Overview', 'mb_framework').'</a></p>',
					'new_lines' => '',
					'esc_html' => 0,
				)
			),
			'location' => array (
				array (
					array (
						'param' => 'options_page',
						'operator' => '==',
						'value' => 'gusta-font-manager',
					),
				),
			),
			'menu_order' => 1,
			'position' => 'side',
			'style' => 'default',
			'label_placement' => 'top',
			'instruction_placement' => 'label',
			'active' => 1,
		));
		
		$apikey = get_option('options_gusta_google_api_key');
		
		$font_option_fields = array();

		$font_option_fields[] = array (
			'key' => 'field_58b201473391f',
			'label' => __('Google API Key', 'mb_framework'),
			'name' => 'gusta_google_api_key',
			'type' => 'text',
			'instructions' => __('Enter your Google API Key here to use Google Fonts dynamically in smart sections. <a href="https://developers.google.com/maps/documentation/javascript/get-api-key" target="_blank">Get an API Key here</a>', 'mb_framework'),
		);
		
		$font_option_fields[] = array (
			'key' => 'gusta_google_fonts',
			'label' => __('Google Fonts', 'mb_framework'),
			'name' => 'gusta_google_fonts',
			'type' => 'select',
			'instructions' => __('Select the Google Fonts to use in your site.', 'mb_framework').(!$apikey ? __( ' You can leverage from extra Google Fonts options by entering your Google API Key above.', 'mb_framework') : '').__('When you click on "Update", new options related to selected fonts will appear.', 'mb_framework'),
			'choices' => gusta_get_google_fonts(),
			'allow_null' => 1,
			'multiple' => 1,
			'return_format' => 'value',
			'ui' => 1,
		);
		
		$fonts_array = get_option('options_gusta_google_fonts');
		if ($apikey && $fonts_array):
			foreach ($fonts_array as $i => $font):
				$key = str_replace(' ', '', $font);
				$font_option_fields[] = array (
					'key' => 'font_variants_'.$key,
					'label' => $font.__(' Variants', 'mb_framework'),
					'name' => 'font_variants_'.$key,
					'type' => 'select',
					'instructions' => sprintf(__( 'Select the variants of %s font. If no variants are selected, "regular" variant will be applied.', 'mb_framework'), $font),
					'conditional_logic' => array (
						array (
							array (
								'field' => 'gusta_google_fonts',
								'operator' => '==',
								'value' => $font,
							),
						),
					),
					'wrapper' => array (
						'width' => '50%',
						'class' => '',
						'id' => '',
					),
					'choices' => gusta_get_google_font_variants($font),
					'allow_null' => 1,
					'multiple' => 1,
					'return_format' => 'value',
					'ui' => 1,
				);
				$font_option_fields[] = array (
					'key' => 'font_subsets_'.$key,
					'label' => $font.__(' Subsets', 'mb_framework'),
					'name' => 'font_subsets_'.$key,
					'type' => 'select',
					'instructions' => sprintf(__( 'Select the subsets of %s font. If no subsets are selected, "latin" subset will be applied.', 'mb_framework'), $font),
					'conditional_logic' => array (
						array (
							array (
								'field' => 'gusta_google_fonts',
								'operator' => '==',
								'value' => $font,
							),
						),
					),
					'wrapper' => array (
						'width' => '50%',
						'class' => '',
						'id' => '',
					),
					'choices' => gusta_get_google_font_subsets($font),
					'allow_null' => 1,
					'multiple' => 1,
					'return_format' => 'value',
					'ui' => 1,
				);
			endforeach;
		endif;
		
		acf_add_local_field_group(array (
			'key' => 'gusta_google_fonts_options',
			'title' => __('Google Fonts', 'mb_framework'),
			'fields' => $font_option_fields,
			'location' => array (
				array (
					array (
						'param' => 'options_page',
						'operator' => '==',
						'value' => 'gusta-font-manager',
					),
				),
			),
			'menu_order' => 1,
			'position' => 'normal',
			'style' => 'default',
			'label_placement' => 'top',
			'instruction_placement' => 'label',
			'active' => 1,
		));
		
		$adobe_fields[] = array (
			'key' => 'field_58b203ef8faa5',
			'label' => __('Adobe Typekit Kit ID', 'mb_framework'),
			'name' => 'gusta_adobe_typekit_kit_id',
			'type' => 'text',
			'instructions' => __('If you want to use typekit in your site simply enter the TypeKit Kit ID you get from the Typekit site. <a href="https://helpx.adobe.com/typekit/using/using-typekit-blog.html" target="_blank">Learn more here</a>', 'mb_framework'),
		);
		
		if (get_option('options_gusta_adobe_typekit_kit_id')):
			$a=0;
			$adobe_fonts = "";
			$adobe_fonts_array = gusta_get_adobe_fonts();
			if ($adobe_fonts_array):
				$ac = count($adobe_fonts_array);
				foreach ($adobe_fonts_array as $font):
					$a++;
					$adobe_fonts .= $font;
					$adobe_fonts .= ( $a!=$ac ? ', ' : '');
				endforeach;
			endif;
			$adobe_fields[] = array (
				'key' => 'gusta_adobe_fonts',
				'label' => __('Current Fonts in your Kit', 'mb_framework'),
				'type' => 'message',
				'name' => 'gusta_adobe_fonts',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'message' => $adobe_fonts.' <a href="https://typekit.com/account/kits" target="_blank">'.__('Click here to manage your fonts', 'mb_framework').'</a>',
				'new_lines' => '',
				'esc_html' => 0,
			);
		endif;
		
		acf_add_local_field_group(array (
			'key' => 'gusta_adobe_typekit_options',
			'title' => __('Adobe Typekit', 'mb_framework'),
			'fields' => $adobe_fields,
			'location' => array (
				array (
					array (
						'param' => 'options_page',
						'operator' => '==',
						'value' => 'gusta-font-manager',
					),
				),
			),
			'menu_order' => 2,
			'position' => 'normal',
			'style' => 'default',
			'label_placement' => 'top',
			'instruction_placement' => 'label',
			'active' => 1,
		));
	endif;
	
	
	/*
	
	
	Smart Section Options Page
	
	
	*/
	if (isset($_GET["page"]) && ($_GET["page"]=="assign-smart-sections")):
		
		/*
	
		
		Override
		
		
		*/
		
		/*acf_add_local_field_group(array (
			'key' => 'smart_sections_main',
			'title' => __('Smart Sections', 'mb_framework'),
			'fields' => array (
				array (
					'key' => 'gusta_override_theme_header',
					'label' => __('Override Default Theme Header', 'mb_framework'),
					'name' => 'gusta_override_theme_header',
					'type' => 'true_false',
					'instructions' => __('Enabling this option will remove the default header of your theme and replace it with Smart Sections header area where you can create your own header (or select from pre-designed Smart Headers).', 'mb_framework'),
					'default_value' => 0,
					'ui' => 1,
					'wrapper' => array (
						'width' => '50',
					),
				),
				array (
					'key' => 'gusta_override_theme_footer',
					'label' => __('Override Default Theme Footer', 'mb_framework'),
					'name' => 'gusta_override_theme_footer',
					'type' => 'true_false',
					'instructions' => __('Enabling this option will remove the default header of your theme and replace it with Smart Sections header area where you can create your own footer (or select from pre-designed Smart Footers).', 'mb_framework'),
					'default_value' => 0,
					'ui' => 1,
					'wrapper' => array (
						'width' => '50',
					),
				),
			),
			'location' => array (
				array (
					array (
						'param' => 'options_page',
						'operator' => '==',
						'value' => 'smart-sections-theme-compatibility',
					),
				),
			),
			'menu_order' => 1,
			'position' => 'normal',
			'style' => 'default',
			'label_placement' => 'top',
			'instruction_placement' => 'label',
			'active' => 1,
		));*/
		
		/*
	
		
		Select Smart Sections
		
		
		*/
	
		acf_add_local_field_group(array (
			'key' => 'gusta_assign_sections_navigation',
			'title' => __('Help', 'mb_framework'),
			'fields' => array (
				array (
					'key' => 'gusta_assign_sections_navigation_message',
					'label' => '',
					'type' => 'message',
					'name' => '',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'message' => '<p><a class="smart-sections-sidebar-help" href="https://www.youtube.com/watch?v=dVOlFf0mAnM&index=3&list=PLhHXQ5n2SiyHgqG7qr-DMLKkJSu3N-7fO" target="_blank">'.__('How to create an archive layout with Smart Sections?', 'mb_framework').'</a></p><p><a class="smart-sections-sidebar-help" href="https://www.youtube.com/watch?v=7FpVLlf-pTs&list=PLhHXQ5n2SiyHgqG7qr-DMLKkJSu3N-7fO&index=16" target="_blank">'.__('How to create a 404 page with Smart Sections?', 'mb_framework').'</a></p>',
					'new_lines' => '',
					'esc_html' => 0,
				)
			),
			'location' => array (
				array (
					array (
						'param' => 'options_page',
						'operator' => '==',
						'value' => 'assign-smart-sections',
					),
				),
			),
			'menu_order' => 1,
			'position' => 'side',
			'style' => 'default',
			'label_placement' => 'top',
			'instruction_placement' => 'label',
			'active' => 1,
		));
		
		$option_pages = array( 
			array ( 'slug' => 'all', 'name' => 'All Pages', 'singular_name' => 'all', 'archive' => 1, 'single' => 1 ),
			array (	'slug'  => 'post', 'name' => 'Posts',  'singular_name'  => 'single blog post', 'archive' => 0, 'single' => 1 ),
			array (	'slug'  => 'page', 'name' => 'Pages',  'singular_name'  => 'page post type', 'archive' => 0, 'single' => 1 ),
			array (	'slug'  => 'category', 'name' => 'Categories',  'singular_name'  => 'category', 'archive' => 1, 'single' => 0 ),
			array (	'slug'  => 'post_tag', 'name' => 'Post Tags',  'singular_name'  => 'post tag', 'archive' => 1, 'single' => 0 ),
			array (	'slug'  => 'search', 'name' => 'Search Results',  'singular_name'  => 'search result', 'archive' => 1, 'single' => 0 ),
			array (	'slug'  => 'author', 'name' => 'Author Archives', 'singular_name'  => 'author archive', 'archive' => 1, 'single' => 0 ),
			array (	'slug'  => 'date',	 'name' => 'Date Archives',	  'singular_name'  => 'date archive', 'archive' => 1, 'single' => 0 ),
			array (	'slug'  => '404',	 'name' => '404 Page',	  	  'singular_name'  => '404', 'archive' => 0, 'single' => 1 ),
			array (	'slug'  => 'cpt', 'name' => 'All Custom Post Types',  'singular_name'  => 'all custom post type', 'archive' => 0, 'single' => 1 ),
			array (	'slug'  => 'tax', 'name' => 'All Custom Taxonomies',  'singular_name'  => 'all custom taxonomy', 'archive' => 1, 'single' => 0 ),
		);
		if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins')))):
			$option_pages[] = array (	'slug'  => 'shop', 'name' => 'Shop Page',  'singular_name'  => 'shop page', 'archive' => 1, 'single' => 0 );
		endif;
	
		/*$product_options = array(
			array (	'slug'  => 'product', 'name' => 'Products',  'singular_name'  => 'product', 'archive' => 0, 'single' => 1 ),
			array (	'slug'  => 'product_cat', 'name' => 'Product Categories',  'singular_name'  => 'product category', 'archive' => 1, 'single' => 0 ),
			array (	'slug'  => 'product_tag', 'name' => 'Product Tags',  'singular_name'  => 'product tag', 'archive' => 1, 'single' => 0 ),
		);
	
		if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ):
			$option_pages = array_merge ($option_pages, $product_options);
		endif;*/
		
		$pargs = array(
		   'public'   => true,
			'publicly_queryable' => true,
			'_builtin' => false,
			'rewrite' => true
		);

		$poutput = 'objects'; 
		$poperator = 'and'; 

		$all_post_types = get_post_types( $pargs, $poutput, $poperator );
	
		foreach ( $all_post_types as $the_post_type ) {
			if ($the_post_type->name!='gusta_section'):
				$option_pages = array_merge ($option_pages, array(
					array (	
						'slug'  => $the_post_type->name, 
						'name' => ucwords($the_post_type->labels->name),  
						'singular_name'  => $the_post_type->labels->singular_name, 
						'archive' => 1, 
						'single' => 1 
					)
				));
			endif;
		}
	
		$targs = array(
			'public'   => true,
			'publicly_queryable' => true,
			'_builtin' => false,
			'rewrite' => true
		);

		$toutput = 'objects'; 
		$toperator = 'and'; 

		$all_taxonomies = get_taxonomies( $targs, $toutput, $toperator );
	
		foreach ( $all_taxonomies as $the_taxonomy ) {
			if ($the_taxonomy->name!='gusta_section_category'):
				$option_pages = array_merge ($option_pages, array(
					array (	
						'slug'  => $the_taxonomy->name, 
						'name' => ucwords($the_taxonomy->labels->name),  
						'singular_name'  => $the_taxonomy->labels->singular_name, 
						'archive' => 1, 
						'single' => 0
					)
				));
			endif;
		}
	
		$page_options = array();
		$section_options = array();
		foreach ($option_pages as $option_page):
			$page_options[] = array ( 'key' => ''.$option_page["slug"].'_options_tab',	'label' => $option_page["name"], 'type' => 'tab', 'placement' => 'left', );
			$section_options[] = array ( 'key' => ''.$option_page["slug"].'_section_options_tab',	'label' => $option_page["name"], 'type' => 'tab', 'placement' => 'left', );
			
			if ($option_page["slug"]!='all'):
				$section_options[] = array (
					'key' => 'gusta_override_section_options_'.$option_page["slug"],
					'label' => __('Override Section Options for ', 'mb_framework') . $option_page["name"],
					'name' => 'gusta_override_section_options_'.$option_page["slug"],
					'type' => 'true_false',
					'instructions' => __('Enabling this option lets you customize header, footer and other sections for '.$option_page["singular_name"].' pages, different from global options.', 'mb_framework'),
					'ui' => 1,
				);
				$override_section = array (
					array (
						array (
							'field' => 'gusta_override_section_options_'.$option_page["slug"],
							'operator' => '==',
							'value' => '1',
						),
					),
				);
			else:
				$override_section = 0;
			endif;
			
			$section_options[] = array (
				'key' => 'gusta_header_sections_tab_'.$option_page["slug"],
				'label' => __('Header Sections for ', 'mb_framework').$option_page["name"],
				'name' => 'gusta_header_sections_tab_'.$option_page["slug"],
				'type' => 'group',
				'required' => 0,
				'wrapper' => array (
					'class' => 'gusta_tab_active',
				),
				'layout' => 'block',
				'conditional_logic' => $override_section,
				'sub_fields' => array (
					/*array (
						'key' => 'gusta_above_header_sections_'.$option_page["slug"],
						'label' => __('Above Header Area Sections for ', 'mb_framework').$option_page["name"],
						'name' => 'gusta_above_header_sections_'.$option_page["slug"],
						'type' => 'select',
						'conditional_logic' => $override_section,
						'choices' => $content_header,
						'default_value' => get_gusta_option('gusta_above_header_sections', $option_page["slug"], 'section'),
						'return_format' => 'value',
						'multiple' => 1,
						'ui' => 1,
					),*/
					array (
						'key' => 'gusta_header_sections_'.$option_page["slug"],
						'label' => __('Header Area Sections for ', 'mb_framework').$option_page["name"],
						'name' => 'gusta_header_sections_'.$option_page["slug"],
						'type' => 'select',
						'instructions' => __('If you leave this field empty, default theme header will be displayed.', 'mb_framework'),
						'conditional_logic' => $override_section,
						'choices' => $header_sections_array,
						'default_value' => get_gusta_option('gusta_header_sections', $option_page["slug"], 'section'),
						'return_format' => 'value',
						'multiple' => 1,
						'ui' => 1,
					),
					/*array (
						'key' => 'gusta_below_header_sections_'.$option_page["slug"],
						'label' => __('Below Header Area Sections for ', 'mb_framework').$option_page["name"],
						'name' => 'gusta_below_header_sections_'.$option_page["slug"],
						'type' => 'select',
						'conditional_logic' => $override_section,
						'choices' => $content_header,
						'default_value' => get_gusta_option('gusta_below_header_sections', $option_page["slug"], 'section'),
						'return_format' => 'value',
						'multiple' => 1,
						'ui' => 1,
					),*/
				),
			);
			
			if ($option_page["single"]==1): if ($option_page["archive"]==1): $area_name = 'Content or Archive'; else: $area_name = 'Content'; endif; else: $area_name = 'Archive'; endif;
			
			$content_sub_fields = array();
			
			$content_sub_fields[] = array (
				'key' => 'gusta_above_content_sections_'.$option_page["slug"],
				'label' => __('Above', 'mb_framework') . ' ' . $area_name . ' ' .__('Area Sections for ', 'mb_framework').$option_page["name"],
				'name' => 'gusta_above_content_sections_'.$option_page["slug"],
				'type' => 'select',
				'conditional_logic' => $override_section,
				'choices' => $content_sections_array,
				'default_value' => get_gusta_option('gusta_above_content_sections', $option_page["slug"], 'section'),
				'return_format' => 'value',
				'multiple' => 1,
				'ui' => 1,
			);
			if ($option_page["single"]==1):
				if ($option_page["slug"]=='all'):
					$inst = __('Using this field, you can create your own custom page or post layout templates (you should insert "Post Content" shortcode element in the section, to display existing content). The section added here will replace the default theme post or page layout. If you leave this field empty, default page or post layout will be displayed. Sections added in this field will be displayed only in posts, pages or other custom post types.', 'mb_framework');
				else:
					$inst = '';
				endif;
				$content_sub_fields[] = array (
					'key' => 'gusta_content_sections_'.$option_page["slug"],
					'label' => __('Main Content Area Template Sections for ', 'mb_framework').$option_page["name"],
					'name' => 'gusta_content_sections_'.$option_page["slug"],
					'instructions' => $inst,
					'type' => 'select',
					'conditional_logic' => $override_section,
					'choices' => $content_sections_array,
					'default_value' => get_gusta_option('gusta_content_sections', $option_page["slug"], 'section'),
					'return_format' => 'value',
					'multiple' => 1,
					'ui' => 1,
				);
			endif;
			if ($option_page["archive"]==1):
				if ($option_page["slug"]=='all'):
					$inst = __('Using this field, you can create your own custom archive layout templates (you should insert "Post Listing" shortcode element in the section to display archive listings). The section added here will replace the default theme archive layout. If you leave this field empty, default archive layout will be displayed. Sections added in this field will be displayed only in search result pages, category, tag, date, author or other custom taxonomy archives.', 'mb_framework');
				else:
					$inst = '';
				endif;
				$content_sub_fields[] = array (
					'key' => 'gusta_archive_sections_'.$option_page["slug"],
					'label' => __('Archive Area Template Sections for ', 'mb_framework').$option_page["name"],
					'name' => 'gusta_archive_sections_'.$option_page["slug"],
					'instructions' => $inst,
					'type' => 'select',
					'conditional_logic' => $override_section,
					'choices' => $content_sections_array,
					'default_value' => get_gusta_option('gusta_archive_sections', $option_page["slug"], 'section'),
					'return_format' => 'value',
					'multiple' => 1,
					'ui' => 1,
				);
			endif;
			$content_sub_fields[] = array (
				'key' => 'gusta_below_content_sections_'.$option_page["slug"],
				'label' => __('Below', 'mb_framework') . ' ' . $area_name . ' ' .__('Area Sections for ', 'mb_framework').$option_page["name"],
				'name' => 'gusta_below_content_sections_'.$option_page["slug"],
				'type' => 'select',
				'conditional_logic' => $override_section,
				'choices' => $content_sections_array,
				'default_value' => get_gusta_option('gusta_below_content_sections', $option_page["slug"], 'section'),
				'return_format' => 'value',
				'multiple' => 1,
				'ui' => 1,
			);
			$section_options[] = array (
				'key' => 'gusta_content_sections_tab_'.$option_page["slug"],
				'label' => __('Content Sections for ', 'mb_framework').$option_page["name"],
				'name' => 'gusta_content_sections_tab_'.$option_page["slug"],
				'type' => 'group',
				'required' => 0,
				'layout' => 'block',
				'conditional_logic' => $override_section,
				'sub_fields' => $content_sub_fields,
			);
			
			$footer_sub_fields = array();
			
			/*$footer_sub_fields[] = array (
				'key' => 'gusta_above_footer_sections_'.$option_page["slug"],
				'label' => __('Above Footer Area Sections for ', 'mb_framework').$option_page["name"],
				'name' => 'gusta_above_footer_sections_'.$option_page["slug"],
				'type' => 'select',
				'conditional_logic' => $override_section,
				'choices' => $content_sections_array,
				'default_value' => get_gusta_option('gusta_above_footer_sections', $option_page["slug"], 'section'),
				'return_format' => 'value',
				'multiple' => 1,
				'ui' => 1,
			);*/
			$footer_sub_fields[] = array (
				'key' => 'gusta_footer_sections_'.$option_page["slug"],
				'label' => __('Footer Area Sections for ', 'mb_framework').$option_page["name"],
				'name' => 'gusta_footer_sections_'.$option_page["slug"],
				'type' => 'select',
				'instructions' => __('If you leave this field empty, default theme footer will be displayed.', 'mb_framework'),
				'conditional_logic' => $override_section,
				'choices' => $footer_sections_array,
				'default_value' => get_gusta_option('gusta_footer_sections', $option_page["slug"], 'section'),
				'return_format' => 'value',
				'multiple' => 1,
				'ui' => 1,
			);
			/*$footer_sub_fields[] = array (
				'key' => 'gusta_below_footer_sections_'.$option_page["slug"],
				'label' => __('Below Footer Area Sections for ', 'mb_framework').$option_page["name"],
				'name' => 'gusta_below_footer_sections_'.$option_page["slug"],
				'type' => 'select',
				'conditional_logic' => $override_section,
				'choices' => $content_sections_array,
				'default_value' => get_gusta_option('gusta_below_footer_sections', $option_page["slug"], 'section'),
				'return_format' => 'value',
				'multiple' => 1,
				'ui' => 1,
			);*/
			$section_options[] = array (
				'key' => 'gusta_footer_sections_tab_'.$option_page["slug"],
				'label' => __('Footer Sections for ', 'mb_framework').$option_page["name"],
				'name' => 'gusta_footer_sections_tab_'.$option_page["slug"],
				'type' => 'group',
				'required' => 0,
				'layout' => 'block',
				'conditional_logic' => $override_section,
				'sub_fields' => $footer_sub_fields,
			);
			$section_options[] = array (
				'key' => 'gusta_sticky_sections_tab_'.$option_page["slug"],
				'label' => __('Sticky Sections for ', 'mb_framework').$option_page["name"],
				'name' => 'gusta_sticky_sections_tab_'.$option_page["slug"],
				'type' => 'group',
				'required' => 0,
				'layout' => 'block',
				'conditional_logic' => $override_section,
				'sub_fields' => array (
					array (
						'key' => 'gusta_sticky_sections_'.$option_page["slug"],
						'label' => __('Sticky Sections for ', 'mb_framework').$option_page["name"],
						'name' => 'gusta_sticky_sections_'.$option_page["slug"],
						'type' => 'select',
						'conditional_logic' => $override_section,
						'choices' => $sticky_sections_array,
						'default_value' => get_gusta_option('gusta_sticky_sections', $option_page["slug"], 'section'),
						'return_format' => 'value',
						'multiple' => 1,
						'ui' => 1,
					),
				),
			);
		endforeach;
		
		acf_add_local_field_group(array (
			'key' => 'gusta_section_options',
			'title' => __('Assign Smart Sections', 'mb_framework'),
			'fields' => $section_options,
			'location' => array (
				array (
					array (
						'param' => 'options_page',
						'operator' => '==',
						'value' => 'assign-smart-sections',
					),
				),
			),
			'menu_order' => 0,
			'position' => 'normal',
			'style' => 'default',
			'label_placement' => 'top',
			'instruction_placement' => 'label',
			'active' => 1,
		));
		
	endif;
	
	if (isset($_GET["page"]) && ($_GET["page"]=="smart-sections-theme-compatibility")):
	
		acf_add_local_field_group(array (
			'key' => 'smart_sections_navigation',
			'title' => __('Help', 'mb_framework'),
			'fields' => array (
				array (
					'key' => 'smart_sections_navigation',
					'label' => '',
					'type' => 'message',
					'name' => '',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'message' => '<p>Smart Sections is implemented to work with most of the modern Wordpress themes available. However, if your theme has a different semantic structure different than the global web standards, you may need to fill in the fields in this page. If you are not sure or you are having a problem, please <a href="https://support.themegusta.com/" target="_blank">click here</a> to open a ticket in our support portal and we will do our best to help you make your theme compatible with Smart Sections.</p>',
					'new_lines' => '',
					'esc_html' => 0,
				),
				/*array (
					'key' => 'gusta_live_mode',
					'label' => __('Live Mode', 'mb_framework'),
					'name' => 'gusta_live_mode',
					'type' => 'true_false',
					'instructions' => __('If this option is disabled, the changes you make in your website with Smart Sections will only visible to administrators of your Wordpress website. If you enable this option, it will be live and visible to public visitors.', 'mb_framework'),
					'ui' => 1,
				)*/
			),
			'location' => array (
				array (
					array (
						'param' => 'options_page',
						'operator' => '==',
						'value' => 'smart-sections-theme-compatibility',
					),
				),
			),
			'menu_order' => 1,
			'position' => 'side',
			'style' => 'default',
			'label_placement' => 'top',
			'instruction_placement' => 'label',
			'active' => 1,
		));

		/*
		
		
		Section Layout Size
		
		
		
		
		acf_add_local_field_group(array (
			'key' => 'gusta_display_layout_size',
			'title' => __('Smart Section Layout Sizes', 'mb_framework'),
			'fields' => array (
				array (
					'key' => 'field_58b6b256805b6',
					'label' => __('Large Desktop Display Layout', 'mb_framework'),
					'name' => 'gusta_large_desktop_display_layout',
					'type' => 'text',
					'instructions' => __('Enter the display layout size of your smart sections in large desktop screens (1200px and up). If you enter 100%, it will be fluid layout. Default: 1140px', 'mb_framework'),
					'default_value' => ''
				),
				array (
					'key' => 'field_58b6abf4805b5',
					'label' => __('Default Desktop Display Layout', 'mb_framework'),
					'name' => 'gusta_default_display_layout',
					'type' => 'text',
					'instructions' => __('Enter the display layout size of your smart sections in default desktop screens (992px - 1199px). If you enter 100%, it will be fluid layout. Default: 960px', 'mb_framework'),
					'default_value' => '',
				),
				array (
					'key' => 'field_58b6b331805b7',
					'label' => __('Tablet (Portrait & Landscape) & Small Desktop Display Layout', 'mb_framework'),
					'name' => 'gusta_tablet_portrait_landscape_small_desktop_display_layout',
					'type' => 'text',
					'instructions' => __('Enter the display layout size of your smart sections in tablet (portrait and lanscape) and small desktop screens (768px to 991px). If you enter 100%, it will be fluid layout. Default: 720px', 'mb_framework'),
					'default_value' => '',
				),
				array (
					'key' => 'field_58b6b4fc805b8',
					'label' => __('Landscape Phone & Portrait Tablet Display Layout', 'mb_framework'),
					'name' => 'gusta_landscape_phone_portrait_tablet_display_layout',
					'type' => 'text',
					'instructions' => __('Enter the display layout size of your smart sections in landscape phone and portrait tablet screens (576px to 767px). If you enter 100%, it will be fluid layout. Default: 540px', 'mb_framework'),
					'default_value' => '',
				),
				array (
					'key' => 'field_58b6b762805b9',
					'label' => __('Portrait & Landscape Phone Display Layout', 'mb_framework'),
					'name' => 'gusta_portrait_landscape_phone_display_layout',
					'type' => 'text',
					'instructions' => __('Enter the display layout size of your smart sections in landscape and portrait phone screens (575px and down). If you enter 100%, it will be fluid layout. Default: 100%', 'mb_framework'),
					'default_value' => '',
				),
			),
			'location' => array (
				array (
					array (
						'param' => 'options_page',
						'operator' => '==',
						'value' => 'smart-sections-theme-compatibility',
					),
				),
			),
			'menu_order' => 3,
			'position' => 'normal',
			'style' => 'default',
			'label_placement' => 'left',
			'instruction_placement' => 'field',
			'active' => 1,
		));*/
		
		/*$advanced_fields = array (
			array (
				'key' => 'gusta_move_dynamic_css_to_file',
				'label' => __('Move Dynamic CSS to File', 'mb_framework'),
				'name' => 'gusta_move_synamic_css_to_file',
				'type' => 'true_false',
				'instructions' => __('Enabling this option will copy all the inline css created by Smart Sections options and shortcodes to a static css file (style customizations that you make on your pages will not be available on preview).', 'mb_framework'),
				'default_value' => 0,
				'ui' => 1,
			)/*,
			array (
				'key' => 'gusta_disable_custom_fields_meta_box_meta',
				'label' => __('Disable Custom Fields Meta Box', 'mb_framework'),
				'name' => 'gusta_disable_custom_fields_meta_box',
				'type' => 'true_false',
				'instructions' => __('Enabling this option will remove "custom fields meta box" from your posts meta boxes. If you are not using the "custom fields meta box", it is recommended to disable this feature for faster page loads in your edit pages.', 'mb_framework'),
				'default_value' => 0,
				'ui' => 1,
			)
		);*/
		
		/*
		
		
		Theme Compatibility Options
		
		
		*/
		if (THEME_MODE==false):
			$advanced_fields = array (
				array (
					'key' => 'smart_sections_theme-compatibility-message',
					'label' => '',
					'type' => 'message',
					'name' => '',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'message' => '<p>If Smart Sections works fine with your theme, you do not need to fill any of these fields. Please check the links from the help section on the sidebar to see what kind of theme incompatibility may occur.</p>',
					'new_lines' => '',
					'esc_html' => 0,
				),
				array (
					'key' => 'gusta_header_area_selector',
					'label' => __('Header Area Selectors', 'mb_framework'),
					'name' => 'gusta_header_area_selector',
					'type' => 'text',
					'instructions' => __('Enter the CSS selector of your header section area. You can enter more than one selector seperating with a comma if there are more than one header sections in your theme. For example, if your header section area has an id "main-header" (&lt;header id=&quot;main-header&quot;...&gt; or &lt;div id=&quot;main-header&quot;...&gt;), you need to enter <strong>"#main-header"</strong> above. If it only has a class like "&lt;div class=&quot;main-header&quot;...&gt;", then enter ".main-header" above (supports every kind of advanced css selector). Multiple selectors example: <strong>"#main-header, #top-bar"</strong>', 'mb_framework'),
				),
				array (
					'key' => 'gusta_footer_area_selector',
					'label' => __('Footer Area Selectors', 'mb_framework'),
					'name' => 'gusta_footer_area_selector',
					'type' => 'text',
					'instructions' => __('Enter the CSS selector of your footer section area. You can enter more than one selector seperating with a comma if there are more than one footer sections in your theme. For example, if your footer section area has an id "main-footer" (&lt;footer id=&quot;main-footer&quot;...&gt; or &lt;div id=&quot;main-footer&quot;...&gt;), you need to enter <strong>"#main-footer"</strong> above. If it only has a class like "&lt;div class=&quot;main-footer&quot;...&gt;", then enter ".main-footer" above (supports every kind of advanced css selector). Multiple selectors example: <strong>"#main-footer, #copyright"</strong>', 'mb_framework'),
				),
				array (
					'key' => 'gusta_main_content_area_selector',
					'label' => __('Main Content Area Selector', 'mb_framework'),
					'name' => 'gusta_main_content_area_selector',
					'type' => 'text',
					'instructions' => __('Enter the CSS selector of your main content section area <strong>(excluding the sidebar area)</strong>. This field only supports a single selector. For example, if your main content section area has an id "main-body" (&lt;div id=&quot;main-body&quot;...&gt;), you need to enter <strong>"#main-body"</strong> above. If it only has a class like "&lt;div class=&quot;main-body&quot;...&gt;", then enter ".main-body" above (supports every kind of advanced css selector).', 'mb_framework'),
				),
				array (
					'key' => 'gusta_container_class',
					'label' => __('Container Class', 'mb_framework'),
					'name' => 'gusta_container_class',
					'type' => 'text',
					'instructions' => __('Enter the container class of your theme (or wrapper class). Examples: container, wrapper, wrap, grid, site-content etc...', 'mb_framework'),
				)
			);
		
			acf_add_local_field_group(array (
				'key' => 'smart_sections_other',
				'title' => __('Advanced Options', 'mb_framework'),
				'fields' => $advanced_fields,
				'location' => array (
					array (
						array (
							'param' => 'options_page',
							'operator' => '==',
							'value' => 'smart-sections-theme-compatibility',
						),
					),
				),
				'menu_order' => 4,
				'position' => 'normal',
				'style' => 'default',
				'label_placement' => 'top',
				'instruction_placement' => 'field',
				'active' => 1,
			));
		
		endif;
		
	endif;
	/*
	
	
	Meta Box Options
	
	
	*/
	
	
	/*
	
	
	Category Options
	
	
	
	acf_add_local_field_group(array (
		'key' => 'group_taxonomy_meta_box',
		'title' => __('Featured Options', 'mb_framework'),
		'fields' => array ( 
			array (
				'key' => 'gusta_featured_color',
				'label' => __('Featured Color', 'mb_framework'),
				'name' => 'gusta_taxonomy_featured_color',
				'type' => 'color_picker',
				'instructions' => __('Selected color will be used in taxonomy listing, post listing or archive pages.', 'mb_framework'),
				'default_value' => '',
			),
			array (
				'key' => 'gusta_taxonomy_featured_image',
				'label' => __('Featured Image', 'mb_framework'),
				'name' => 'gusta_taxonomy_featured_image',
				'type' => 'image',
				'instructions' => __('Selected image will be used in taxonomy listing, post listing or archive pages.', 'mb_framework'),
				'return_format' => 'url',
				'preview_size' => 'medium',
				'library' => 'all',
			),
		),
		'location' => array ( 
			array (
				array (
					'param' => 'taxonomy',
					'operator' => '!=',
					'value' => 'gusta_section_category',
				),
				array (
					'param' => 'taxonomy',
					'operator' => '!=',
					'value' => 'nav_menu',
				),
				array (
					'param' => 'taxonomy',
					'operator' => '!=',
					'value' => 'post_format',
				),
			), 
		),
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'left',
		'instruction_placement' => 'field',
		'active' => 1,
	));
	
	/*
	
	
	Post Format Meta Box
	
	
	
	
	acf_add_local_field_group(array (
		'key' => 'group_58c3695a5032c',
		'title' => __('Post Format Options', 'mb_framework'),
		'fields' => array (
			array (
				'key' => 'field_58c3698716849',
				'label' => __('Post Format', 'mb_framework'),
				'name' => 'gusta_post_format',
				'type' => 'select',
				'choices' => array (
					'standard' => __('Standard', 'mb_framework'),
					'video' => __('Video', 'mb_framework'),
					'image' => __('Image', 'mb_framework'),
					'gallery' => __('Gallery', 'mb_framework'),
					'quote' => __('Quote', 'mb_framework'),
					'instagram' => __('Instagram', 'mb_framework'),
					'twitter' => __('Twitter', 'mb_framework'),
					'facebook' => __('Facebook', 'mb_framework'),
				),
				'default_value' => array (
				),
				'return_format' => 'value',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'post',
				),
			),
		),
		'position' => 'side',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'active' => 1,
	));

	/*
	
	
	Single & Archive Sections Meta Box 
	
	
	*/
	
	$override_section_meta = array (
		array (
			array (
				'field' => 'gusta_override_section_options_meta',
				'operator' => '==',
				'value' => '1',
			),
		),
	);
	
	$override_section_meta = 0;
	
	$content_section_fields = array();
	
	$content_section_fields[] = array (
		'key' => 'gusta_above_content_sections_meta',
		'label' => __('Above Content Area Sections', 'mb_framework'),
		'name' => 'gusta_above_content_sections',
		'type' => 'select',
		'conditional_logic' => $override_section_meta,
		'choices' => $content_sections_array,
		'default_value' => get_gusta_option('gusta_above_content_sections', gusta_get_post_type(), 'section'),
		'return_format' => 'value',
		'multiple' => 1,
		'ui' => 1,
	);
	$gusta_admin_page = gusta_get_admin_page();
	/*if ($gusta_admin_page == 'tax' || $gusta_admin_page == 'category' || $gusta_admin_page == 'post_tag' || $gusta_admin_page == 'author'):*/
		$content_section_fields[] = array (
			'key' => 'gusta_archive_sections_meta',
			'label' => __('Archive Area Template Sections', 'mb_framework'),
			'name' => 'gusta_archive_sections',
			'type' => 'select',
			'conditional_logic' => $override_section_meta,
			'choices' => $content_sections_array,
			'default_value' => get_gusta_option('gusta_archive_sections', gusta_get_post_type(), 'section'),
			'return_format' => 'value',
			'multiple' => 1,
			'ui' => 1,
		);
	//else:
		$content_section_fields[] = array (
			'key' => 'gusta_content_sections_meta',
			'label' => __('Main Content Area Template Sections', 'mb_framework'),
			'name' => 'gusta_content_sections',
			'type' => 'select',
			'conditional_logic' => $override_section_meta,
			'choices' => $content_sections_array,
			'default_value' => get_gusta_option('gusta_content_sections', gusta_get_post_type(), 'section'),
			'return_format' => 'value',
			'multiple' => 1,
			'ui' => 1,
		);
	//endif;
	$content_section_fields[] = array (
		'key' => 'gusta_below_content_sections_meta',
		'label' => __('Below Content Area Sections', 'mb_framework'),
		'name' => 'gusta_below_content_sections',
		'type' => 'select',
		'conditional_logic' => $override_section_meta,
		'choices' => $content_sections_array,
		'default_value' => get_gusta_option('gusta_below_content_sections', gusta_get_post_type(), 'section'),
		'return_format' => 'value',
		'multiple' => 1,
		'ui' => 1,
	);
	
	acf_add_local_field_group(array (
		'key' => 'group_single_archive_sections_meta_box',
		'title' => __('Smart Sections', 'mb_framework'),
		'fields' => array (
			array (
				'key' => 'gusta_override_section_options_meta',
				'label' => __('Override Section Options', 'mb_framework'),
				'name' => 'gusta_override_section_options',
				'type' => 'true_false',
				'instructions' => __('Enabling this option lets you customize header, footer and other sections for this post type, different from global options.', 'mb_framework'),
				'ui' => 1,
			),
			array (
				'key' => 'gusta_header_sections_tab',
				'label' => __('Header Sections', 'mb_framework'),
				'name' => 'gusta_header_sections_tab',
				'type' => 'group',
				'required' => 0,
				'wrapper' => array (
					'class' => 'gusta_tab_active',
				),
				'layout' => 'block',
				'conditional_logic' => $override_section_meta,
				'sub_fields' => array (
					/*array (
						'key' => 'gusta_above_header_sections_meta',
						'label' => __('Above Header Area Sections', 'mb_framework'),
						'name' => 'gusta_above_header_sections',
						'type' => 'select',
						'conditional_logic' => $override_section_meta,
						'choices' => $content_header,
						'default_value' => get_gusta_option('gusta_above_header_sections', gusta_get_post_type(), 'section'),
						'return_format' => 'value',
						'multiple' => 1,
						'ui' => 1,
					),*/
					array (
						'key' => 'gusta_header_sections_meta',
						'label' => __('Header Area Sections', 'mb_framework'),
						'name' => 'gusta_header_sections',
						'type' => 'select',
						'conditional_logic' => $override_section_meta,
						'choices' => $header_sections_array,
						'default_value' => get_gusta_option('gusta_header_sections', gusta_get_post_type(), 'section'),
						'return_format' => 'value',
						'multiple' => 1,
						'ui' => 1,
					),
					/*array (
						'key' => 'gusta_below_header_sections_meta',
						'label' => __('Below Header Area Sections', 'mb_framework'),
						'name' => 'gusta_below_header_sections',
						'type' => 'select',
						'conditional_logic' => $override_section_meta,
						'choices' => $content_header,
						'default_value' => get_gusta_option('gusta_below_header_sections', gusta_get_post_type(), 'section'),
						'return_format' => 'value',
						'multiple' => 1,
						'ui' => 1,
					),*/
				),
			),
			array (
				'key' => 'gusta_content_sections_tab',
				'label' => __('Content Sections', 'mb_framework'),
				'name' => 'gusta_content_sections_tab',
				'type' => 'group',
				'required' => 0,
				'layout' => 'block',
				'conditional_logic' => $override_section_meta,
				'sub_fields' => $content_section_fields,
			),
			array (
				'key' => 'gusta_footer_sections_tab',
				'label' => __('Footer Sections', 'mb_framework'),
				'name' => 'gusta_footer_sections_tab',
				'type' => 'group',
				'required' => 0,
				'layout' => 'block',
				'conditional_logic' => $override_section_meta,
				'sub_fields' => array (
					/*array (
						'key' => 'gusta_above_footer_sections_meta',
						'label' => __('Above Footer Area Sections', 'mb_framework'),
						'name' => 'gusta_above_footer_sections',
						'type' => 'select',
						'conditional_logic' => $override_section_meta,
						'choices' => $content_sections_array,
						'default_value' => get_gusta_option('gusta_above_footer_sections', gusta_get_post_type(), 'section'),
						'return_format' => 'value',
						'multiple' => 1,
						'ui' => 1,
					),*/
					array (
						'key' => 'gusta_footer_sections_meta',
						'label' => __('Footer Area Sections', 'mb_framework'),
						'name' => 'gusta_footer_sections',
						'type' => 'select',
						'conditional_logic' => $override_section_meta,
						'choices' => $footer_sections_array,
						'default_value' => get_gusta_option('gusta_footer_sections', gusta_get_post_type(), 'section'),
						'return_format' => 'value',
						'multiple' => 1,
						'ui' => 1,
					),
					/*array (
						'key' => 'gusta_below_footer_sections_meta',
						'label' => __('Below Footer Area Sections', 'mb_framework'),
						'name' => 'gusta_below_footer_sections',
						'type' => 'select',
						'conditional_logic' => $override_section_meta,
						'choices' => $content_sections_array,
						'default_value' => get_gusta_option('gusta_below_footer_sections', gusta_get_post_type(), 'section'),
						'return_format' => 'value',
						'multiple' => 1,
						'ui' => 1,
					),*/
				),
			),
			array (
				'key' => 'gusta_sticky_sections_tab',
				'label' => __('Sticky Sections', 'mb_framework'),
				'name' => 'gusta_sticky_sections_tab',
				'type' => 'group',
				'required' => 0,
				'layout' => 'block',
				'conditional_logic' => $override_section_meta,
				'sub_fields' => array (
					array (
						'key' => 'gusta_sticky_sections_meta',
						'label' => __('Sticky Sections', 'mb_framework'),
						'name' => 'gusta_sticky_sections',
						'type' => 'select',
						'conditional_logic' => $override_section_meta,
						'choices' => $sticky_sections_array,
						'default_value' => get_gusta_option('gusta_sticky_sections', gusta_get_post_type(), 'section'),
						'return_format' => 'value',
						'multiple' => 1,
						'ui' => 1,
					),
				),
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'taxonomy',
					'operator' => '!=',
					'value' => 'gusta_section_category',
				),
			),
			array (
				array (
					'param' => 'user_form',
					'operator' => '==',
					'value' => 'edit',
				),
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '!=',
					'value' => 'vc_grid_item',
				),
				array (
					'param' => 'post_type',
					'operator' => '!=',
					'value' => 'gusta_section',
				),
			),
		),
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'field',
		'active' => 1,
		'menu_order' => 10,
	));

	/*
	
	
	Section Meta Boxes
	
	
	*/

	acf_add_local_field_group(array (
		'key' => 'group_58b4beab72894',
		'title' => __('Responsive Options', 'mb_framework'),
		'fields' => array (
			array (
				'key' => 'field_58b4bedc56504',
				'label' => __('Select Media Query Sizes', 'mb_framework'),
				'name' => 'gusta_display_this_section_when',
				'type' => 'repeater',
				'instructions' => __('The min. and max. pixel values determine the screen widths that this section will be displayed. Leave empty if you want your section to displayed in every screen size.', 'mb_framework'),
				'collapsed' => '',
				'min' => 0,
				'max' => 1,
				'layout' => 'table',
				'button_label' => __('Add Media Query', 'mb_framework'),
				'sub_fields' => array (
					array (
						'key' => 'field_58b4bf6e56505',
						'label' => __('Min-Width', 'mb_framework'),
						'name' => 'gusta_min_width',
						'type' => 'text',
						'instructions' => __('i.e. 768px', 'mb_framework'),
					),
					array (
						'key' => 'field_58b4bfbb56506',
						'label' => __('Max-Width', 'mb_framework'),
						'name' => 'gusta_max_width',
						'type' => 'text',
						'instructions' => __('i.e. 991px', 'mb_framework'),
					),
				),
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'gusta_section',
				),
			),
		),
		'hide_on_screen' => array (
			0 => 'permalink',
			1 => 'excerpt',
			2 => 'custom_fields',
			3 => 'discussion',
			4 => 'comments',
			5 => 'format',
			6 => 'tags',
			7 => 'send-trackbacks',
		),		'menu_order' => 0,		'position' => 'side',		'active' => 1
	));

	function gusta_get_nav_menu_items( $menu, $args = array() ) {
	    $menu = wp_get_nav_menu_object( $menu );
	 
	    if ( ! $menu ) {
	        return false;
	    }
	 
	    static $fetched = array();
	 
	    $items = get_objects_in_term( $menu->term_id, 'nav_menu' );
	    if ( is_wp_error( $items ) ) {
	        return false;
	    }
	 
	    $defaults = array( 'order' => 'ASC', 'orderby' => 'menu_order', 'post_type' => 'nav_menu_item',
	        'post_status' => 'publish', 'output' => ARRAY_A, 'output_key' => 'menu_order', 'nopaging' => true );
	    $args = wp_parse_args( $args, $defaults );
	    $args['include'] = $items;
	 
	    if ( ! empty( $items ) ) {
	        $items = get_posts( $args );
	    } else {
	        $items = array();
	    }
	 
	    // Get all posts and terms at once to prime the caches
	    if ( empty( $fetched[ $menu->term_id ] ) && ! wp_using_ext_object_cache() ) {
	        $fetched[$menu->term_id] = true;
	        $posts = array();
	        $terms = array();
	        foreach ( $items as $item ) {
	            $object_id = get_post_meta( $item->ID, '_menu_item_object_id', true );
	            $object    = get_post_meta( $item->ID, '_menu_item_object',    true );
	            $type      = get_post_meta( $item->ID, '_menu_item_type',      true );
	 
	            if ( 'post_type' == $type )
	                $posts[$object][] = $object_id;
	            elseif ( 'taxonomy' == $type)
	                $terms[$object][] = $object_id;
	        }
	 
	        if ( ! empty( $posts ) ) {
	            foreach ( array_keys($posts) as $post_type ) {
	                get_posts( array('post__in' => $posts[$post_type], 'post_type' => $post_type, 'nopaging' => true, 'update_post_term_cache' => false) );
	            }
	        }
	        unset($posts);
	    }
	 
	    $items = array_map( 'wp_setup_nav_menu_item', $items );
	 
	    if ( ! is_admin() ) { // Remove invalid items only in front end
	        $items = array_filter( $items, '_is_valid_nav_menu_item' );
	    }
	 
	    if ( ARRAY_A == $args['output'] ) {
	        $items = wp_list_sort( $items, array(
	            $args['output_key'] => 'ASC',
	        ) );
	        $i = 1;
	        foreach ( $items as $k => $item ) {
	            $items[$k]->{$args['output_key']} = $i++;
	        }
	    }
	 
	    /**
	     * Filters the navigation menu items being returned.
	     *
	     * @since 3.0.0
	     *
	     * @param array  $items An array of menu item post objects.
	     * @param object $menu  The menu object.
	     * @param array  $args  An array of arguments used to retrieve menu item objects.
	     */
	    return apply_filters( 'wp_get_nav_menu_items', $items, $menu, $args );
	}

	$menu = array('0'=>'Select...');

	if ($gusta_admin_page == 'gusta_section'):
	$dump = get_terms( 'nav_menu', array( 'hide_empty' => true ) );
	
	foreach ($dump as $dmp):
		$menu_id = $dmp->term_id;
		$menu_name = $dmp->name;
		$array_menu = gusta_get_nav_menu_items($menu_id);
		foreach ($array_menu as $m) {
			if (empty($m->menu_item_parent)) {
				$menu[$menu_name][$m->ID] = $m->title;
			}
		}
	endforeach;
	endif;

	acf_add_local_field_group(array (
		'key' => 'group_58b560d18cd04',
		'title' => __('Advanced Section Options', 'mb_framework'),
		'fields' => array (
			array (
				'key' => 'gusta_section_purpose',
				'label' =>  __('Section Purpose', 'mb_framework'),
				'name' => 'gusta_section_purpose',
				'type' => 'radio',
				'instructions' => __('Select the purpose that this section is created for.', 'mb_framework'),
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => 'gusta_section_purpose',
					'id' => '',
				),
				'choices' => array (
					'content' => '<span>'.__('Content Template', 'mb_framework').'</span>',
					'header' => '<span>'.__('Header', 'mb_framework').'</span>',
					'mega_menu' => '<span>'.__('Mega Menu', 'mb_framework').'</span>',
					'footer' => '<span>'.__('Footer', 'mb_framework').'</span>',
					'sticky' => '<span>'.__('Sticky', 'mb_framework').'</span>',
					'sidebar' => '<span>'.__('Sidebar Widget', 'mb_framework').'</span>',
					'vertical' => '<span>'.__('Vertical Header', 'mb_framework').'</span>',
					'card' => '<span>'.__('Listing Card Template', 'mb_framework').'</span>',
				),
				'allow_null' => 0,
				'other_choice' => 0,
				'save_other_choice' => 0,
				'default_value' => 'content',
				'layout' => 'vertical',
				'return_format' => 'value',
			),
			array (
				'key' => 'gusta_overlapping_section',
				'label' => __('Overlapping Section', 'mb_framework'),
				'name' => 'gusta_overlapping_section',
				'type' => 'true_false',
				'instructions' => __('Set to "Yes" if you want this section to overlap over the content below it. This feature is useful for creating a transparent header or sticky overlapping sections throughout the page.', 'mb_framework'),
				'ui' => 1,
				'conditional_logic' => array (
					array (
						array (
							'field' => 'gusta_section_purpose',
							'operator' => '==',
							'value' => 'header',
						),
					),
					array (
						array (
							'field' => 'gusta_section_purpose',
							'operator' => '==',
							'value' => 'sidebar',
						),
					),
					array (
						array (
							'field' => 'gusta_section_purpose',
							'operator' => '==',
							'value' => 'content',
						),
					),
				),
			),
			array (
				'key' => 'gusta_sticky_section',
				'label' => __('Sticky Section', 'mb_framework'),
				'name' => 'gusta_sticky_section',
				'type' => 'true_false',
				'instructions' => __('Set to "Yes" if you want this section to be sticky, which means it will always be visible even if you scroll down the page. If you select "Sidebar Widget" as the section purpose. the widget will be sticky inside its container.', 'mb_framework'),
				'ui' => 1,
				'conditional_logic' => array (
					array (
						array (
							'field' => 'gusta_section_purpose',
							'operator' => '==',
							'value' => 'sidebar',
						),
					),
				),
			),
			
			array (
				'key' => 'gusta_ver_section_alignment',
				'label' => __('Alignment', 'mb_framework'),
				'name' => 'gusta_ver_section_alignment',
				'type' => 'select',
				'choices' => array (
					'left' => __('Left', 'mb_framework'),
					'right' => __('Right', 'mb_framework'),
				),
				'default_value' => array (
					'0' => 'left'
				),
				'conditional_logic' => array (
					array (
						array (
							'field' => 'gusta_section_purpose',
							'operator' => '==',
							'value' => 'vertical',
						),
					),
				),
				'return_format' => 'value',
			),
			array (
				'key' => 'gusta_menu_item',
				'label' => __('Menu Item', 'mb_framework'),
				'instructions' => __('Select the menu item that will trigger this mega menu.', 'mb_framework'),
				'name' => 'gusta_menu_item',
				'type' => 'select',
				'wrapper' => array (
					'width' => '50',
				),
				'choices' => $menu,
				'default_value' => false,
				'conditional_logic' => array (
					array (
						array (
							'field' => 'gusta_section_purpose',
							'operator' => '==',
							'value' => 'mega_menu',
						),
					),
				),
				'return_format' => 'value',
			),
			array (
				'key' => 'gusta_menu_trigger_type',
				'label' => __('Trigger Type', 'mb_framework'),
				'instructions' => __('Select the trigger type of this mega menu.', 'mb_framework'),
				'name' => 'gusta_menu_trigger_type',
				'type' => 'select',
				'wrapper' => array (
					'width' => '50',
				),
				'choices' => array(
					'hover' => __('Hover', 'mb_framework'),
					'click' => __('Click', 'mb_framework'),
				),
				'default_value' => false,
				'conditional_logic' => array (
					array (
						array (
							'field' => 'gusta_section_purpose',
							'operator' => '==',
							'value' => 'mega_menu',
						),
					),
				),
				'return_format' => 'value',
			),
			array (
				'key' => 'gusta_sticky_section_position',
				'label' => __('Sticky Section Position', 'mb_framework'),
				'name' => 'gusta_sticky_section_position',
				'type' => 'select',
				'choices' => array (
					'top-left' => __('Top Left', 'mb_framework'),
					'top-center' => __('Top', 'mb_framework'),
					'top-right' => __('Top Right', 'mb_framework'),
					'middle-left' => __('Middle Left', 'mb_framework'),
					'middle-center' => __('Middle', 'mb_framework'),
					'middle-right' => __('Middle Right', 'mb_framework'),
					'bottom-left' => __('Bottom Left', 'mb_framework'),
					'bottom-center' => __('Bottom', 'mb_framework'),
					'bottom-right' => __('Bottom Right', 'mb_framework'),
				),
				'default_value' => array (
					'0' => 'top-center'
				),
				'conditional_logic' => array (
					array (
						array (
							'field' => 'gusta_section_purpose',
							'operator' => '==',
							'value' => 'sticky',
						),
					),
				),
				'return_format' => 'value',
			),
			array (
				'key' => 'gusta_sticky_section_layer_order',
				'label' => __('Sticky Section Layer Stack Order (z-index)', 'mb_framework'),
				'name' => 'gusta_sticky_section_layer_order',
				'type' => 'text',
				'instructions' => __("Enter an integer value. Sections with higher order number will be displayed in front of sections with lower order.", 'mb_framework'),
				'conditional_logic' => array (
					array (
						array (
							'field' => 'gusta_section_purpose',
							'operator' => '==',
							'value' => 'sticky',
						),
					),
				),
				'default_value' => '1000',
				'return_format' => 'value',
			),
			array (
				'key' => 'gusta_scroll_inside',
				'label' => __('Scroll Inside', 'mb_framework'),
				'name' => 'gusta_scroll_inside',
				'type' => 'true_false',
				'instructions' => __('Set to "true" if you want this section to be scrolled inside.', 'mb_framework'),
				'required' => 0,
				'conditional_logic' => array (
					array (
						array (
							'field' => 'gusta_section_purpose',
							'operator' => '==',
							'value' => 'vertical',
						),
					),
					array (
						array (
							'field' => 'gusta_section_purpose',
							'operator' => '==',
							'value' => 'sticky',
						),
					),
				),
				'default_value' => 0,
				'ui' => 1,
			),
			array (
				'key' => 'gusta_section_display',
				'label' => __('Display/hide this section when...', 'mb_framework'),
				'name' => 'gusta_section_display',
				'type' => 'select',
				'choices' => array (
					'' => __('Display when the page is loaded.', 'mb_framework'),
					'href' => __('Display when a specific link with class name (i.e. my-link-class) is clicked.', 'mb_framework'),
					'div' => __('Display when specific elements are displayed in the page on scroll.', 'mb_framework'),
					'offset' => __('Display when page scrolled between specific scroll positions, in pixels.', 'mb_framework'),
					'hide' => __('Hide when specific elements are displayed in the page on scroll.', 'mb_framework'),
					'window' => __('Display when the mouse cursor is out of the window.', 'mb_framework')
				),
				'default_value' => '',
				'conditional_logic' => array (
					array (
						array (
							'field' => 'gusta_section_purpose',
							'operator' => '==',
							'value' => 'vertical',
						),
						array (
							'field' => 'gusta_sticky_section',
							'operator' => '==',
							'value' => '1',
						),
					),
					array (
						array (
							'field' => 'gusta_section_purpose',
							'operator' => '==',
							'value' => 'sticky',
						),
					),
				),
				'return_format' => 'value',
			),
			array (
				'key' => 'gusta_section_href',
				'label' => __("HREF Link", 'mb_framework'),
				'name' => 'gusta_section_href',
				'type' => 'text',
				'instructions' => __("Enter the class name (i.e. 'my-link-class'). This section will only be displayed when an anchor link with this class and a '#!' href value is clicked anywhere in the page. You still need to add this section in the 'Sticky Sections' field in 'Assign Sections'", 'mb_framework'),
				'conditional_logic' => array (
					array (
						array (
							'field' => 'gusta_section_purpose',
							'operator' => '==',
							'value' => 'vertical',
						),
						array (
							'field' => 'gusta_sticky_section',
							'operator' => '==',
							'value' => '1',
						),
						array (
							'field' => 'gusta_section_display',
							'operator' => '==',
							'value' => 'href',
						),
					),
					array (
						array (
							'field' => 'gusta_section_purpose',
							'operator' => '==',
							'value' => 'sticky',
						),
						array (
							'field' => 'gusta_section_display',
							'operator' => '==',
							'value' => 'href',
						),
					),
				),
				'default_value' => '',
			),
			array (
				'key' => 'gusta_section_div_ids',
				'label' => __("Element ID's", 'mb_framework'),
				'name' => 'gusta_section_div_ids',
				'type' => 'text',
				'instructions' => __("Enter the id of an element in the page (i.e. 'div-id'). This section will only be displayed if any element with entered id is found inside the page.", 'mb_framework'),
				'conditional_logic' => array (
					array (
						array (
							'field' => 'gusta_section_purpose',
							'operator' => '==',
							'value' => 'vertical',
						),
						array (
							'field' => 'gusta_sticky_section',
							'operator' => '==',
							'value' => '1',
						),
						array (
							'field' => 'gusta_section_display',
							'operator' => '==',
							'value' => 'div',
						),
					),
					array (
						array (
							'field' => 'gusta_section_purpose',
							'operator' => '==',
							'value' => 'sticky',
						),
						array (
							'field' => 'gusta_section_display',
							'operator' => '==',
							'value' => 'div',
						),
					),
				),
				'default_value' => '',
			),
			array (
				'key' => 'gusta_section_hide_selector',
				'label' => __("Selector to hide", 'mb_framework'),
				'name' => 'gusta_section_hide_selector',
				'type' => 'text',
				'instructions' => __("Enter the selector of an element in the page (i.e. '#div-id' or 'footer' etc). This section will be hidden if any element with entered selector is found inside the page.", 'mb_framework'),
				'conditional_logic' => array (
					array (
						array (
							'field' => 'gusta_section_purpose',
							'operator' => '==',
							'value' => 'vertical',
						),
						array (
							'field' => 'gusta_sticky_section',
							'operator' => '==',
							'value' => '1',
						),
						array (
							'field' => 'gusta_section_display',
							'operator' => '==',
							'value' => 'hide',
						),
					),
					array (
						array (
							'field' => 'gusta_section_purpose',
							'operator' => '==',
							'value' => 'sticky',
						),
						array (
							'field' => 'gusta_section_display',
							'operator' => '==',
							'value' => 'hide',
						),
					),
				),
				'default_value' => '',
			),
			array (
				'key' => 'gusta_section_offset',
				'label' => __('Offset', 'mb_framework'),
				'name' => 'gusta_section_offset',
				'type' => 'group',
				'required' => 0,
				'layout' => 'block',
				'conditional_logic' => array (
					array (
						array (
							'field' => 'gusta_section_purpose',
							'operator' => '==',
							'value' => 'vertical',
						),
						array (
							'field' => 'gusta_sticky_section',
							'operator' => '==',
							'value' => '1',
						),
						array (
							'field' => 'gusta_section_display',
							'operator' => '==',
							'value' => 'offset',
						),
					),
					array (
						array (
							'field' => 'gusta_section_purpose',
							'operator' => '==',
							'value' => 'sticky',
						),
						array (
							'field' => 'gusta_section_display',
							'operator' => '==',
							'value' => 'offset',
						),
					),
				),
				'sub_fields' => array (
					array (
						'key' => 'gusta_section_offset_from',
						'label' => __("Offset From (In pixels)", 'mb_framework'),
						'name' => 'gusta_section_offset_from',
						'type' => 'text',
						'instructions' => __('This section will be displayed when the page is scrolled down to the pixel value you enter here. If you want this section to be displayed continuously, select "when the page is loaded" from the menu above. (i.e. 500px).', 'mb_framework'),
						'wrapper' => array (
							'width' => '50',
						),
						'default_value' => '',
					),
					array (
						'key' => 'gusta_section_offset_to',
						'label' => __("Offset To", 'mb_framework'),
						'name' => 'gusta_section_offset_to',
						'type' => 'text',
						'instructions' => __("This section won't be displayed any longer after the page is scrolled down to the pixel value you enter here. Leave the field blank if you don't want this section to disappear on a particular scroll. (i.e. 1000px).", 'mb_framework'),
						'wrapper' => array (
							'width' => '50',
						),
						'default_value' => '',
					),
				),
			),
			array (
				'key' => 'gusta_section_timing',
				'label' => __('Timing', 'mb_framework'),
				'name' => 'gusta_section_timing',
				'type' => 'group',
				'required' => 0,
				'layout' => 'block',
				'conditional_logic' => array (
					array (
						array (
							'field' => 'gusta_section_purpose',
							'operator' => '!=',
							'value' => 'mega_menu',
						),
						array (
							'field' => 'gusta_section_purpose',
							'operator' => '!=',
							'value' => 'card',
						),
					),
				),
				'sub_fields' => array (
					array (
						'key' => 'gusta_section_delay',
						'label' => __("Delay (seconds)", 'mb_framework'),
						'name' => 'gusta_section_delay',
						'type' => 'text',
						'instructions' => __("In number (i.e. 5). The section will be displayed after entered seconds when triggered. Leave empty for no delay.", 'mb_framework'),
						'wrapper' => array (
							'width' => '50',
						),
						'default_value' => '',
					),
					array (
						'key' => 'gusta_section_duration',
						'label' => __("Duration (seconds)", 'mb_framework'),
						'name' => 'gusta_section_duration',
						'type' => 'text',
						'instructions' => __("In number (i.e. 10) The section will be hidden after entered seconds once displayed. Leave empty to display till the end of time!", 'mb_framework'),
						'wrapper' => array (
							'width' => '50',
						),
						'default_value' => '',
					),
				),
			),
			array (
				'key' => 'gusta_section_background',
				'label' => __('Background', 'mb_framework'),
				'name' => 'gusta_section_background',
				'type' => 'group',
				'required' => 0,
				'layout' => 'block',
				'sub_fields' => array (
					array (
						'key' => 'gusta_section_background_color',
						'label' => __('Section Background Color', 'mb_framework'),
						'name' => 'gusta_section_background_color',
						'type' => 'color_picker',
						'wrapper' => array (
							'width' => '50',
						),
						'instructions' => __('Select the background color. If you select no color, it will be fully transparent.', 'mb_framework'),
						'default_value' => '',
					),
					array (
						'key' => 'gusta_section_background_transparency',
						'label' => __('Section Background Transparency (%)', 'mb_framework'),
						'name' => 'gusta_section_background_transparency',
						'type' => 'text',
						'wrapper' => array (
							'width' => '50',
						),
						'instructions' => __('Set a percentage value to set the background transparency value of this section (i.e. 60%).', 'mb_framework'),
						'default_value' => '100%',
					),
				),
			),
			array (
				'key' => 'gusta_ver_section_width',
				'label' => __('Section Width', 'mb_framework'),
				'name' => 'gusta_ver_section_width',
				'type' => 'text',
				'conditional_logic' => array (
					array (
						array (
							'field' => 'gusta_sticky_section',
							'operator' => '!=',
							'value' => '1',
						),
						array (
							'field' => 'gusta_section_purpose',
							'operator' => '==',
							'value' => 'vertical',
						),
						array (
							'field' => 'gusta_overlapping_section',
							'operator' => '!=',
							'value' => '1',
						),
					),
				),
				'instructions' => __('In pixels (i.e. 500px). Set to "100%" if you want this section to be full-width. Leave empty for default options.', 'mb_framework')
			),
			array (
				'key' => 'gusta_section_width_height',
				'label' => __('Width & Height', 'mb_framework'),
				'name' => 'gusta_section_width_height',
				'type' => 'group',
				'required' => 0,
				'conditional_logic' => array (
					array (
						array (
							'field' => 'gusta_sticky_section',
							'operator' => '==',
							'value' => '1',
						),
						array (
							'field' => 'gusta_section_purpose',
							'operator' => '!=',
							'value' => 'mega_menu',
						),
						array (
							'field' => 'gusta_section_purpose',
							'operator' => '!=',
							'value' => 'header',
						),
						array (
							'field' => 'gusta_section_purpose',
							'operator' => '!=',
							'value' => 'footer',
						),
						array (
							'field' => 'gusta_section_purpose',
							'operator' => '!=',
							'value' => 'content',
						),
					),
					array (
						array (
							'field' => 'gusta_overlapping_section',
							'operator' => '==',
							'value' => '1',
						),
						array (
							'field' => 'gusta_section_purpose',
							'operator' => '!=',
							'value' => 'mega_menu',
						),
						array (
							'field' => 'gusta_section_purpose',
							'operator' => '!=',
							'value' => 'header',
						),
						array (
							'field' => 'gusta_section_purpose',
							'operator' => '!=',
							'value' => 'footer',
						),
						array (
							'field' => 'gusta_section_purpose',
							'operator' => '!=',
							'value' => 'content',
						),
					),
					array (
						array (
							'field' => 'gusta_section_purpose',
							'operator' => '==',
							'value' => 'sticky',
						),
					),
				),
				'layout' => 'block',
				'sub_fields' => array (
					array (
						'key' => 'gusta_section_width',
						'label' => __('Section Width', 'mb_framework'),
						'name' => 'gusta_section_width',
						'type' => 'text',
						'wrapper' => array (
							'width' => '50',
						),
						'instructions' => __('In pixels (i.e. 500px). Set to "100%" if you want this section to be full-width. Leave empty for default options.', 'mb_framework')
					),
					array (
						'key' => 'gusta_section_height',
						'label' => __('Section Height', 'mb_framework'),
						'name' => 'gusta_section_height',
						'type' => 'text',
						'wrapper' => array (
							'width' => '50',
						),
						'instructions' => __('In pixels (i.e. 500px). Set to "100%" if you want this section to be full-height. Leave empty for default options.', 'mb_framework')
					),
				),			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'gusta_section',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'active' => 1,
	));
	
	acf_add_local_field_group(array(
		'key' => 'group_5a39589a0acd8',
		'title' => 'Section Preview',
		'fields' => array(
			array(
				'key' => 'field_5a3958ba1fdcc',
				'label' => 'Preview Image',
				'name' => 'preview_image',
				'type' => 'image',
				'instructions' => 'This image field is only visible on the admin listing area to help you find your sections easier.',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'return_format' => 'array',
				'preview_size' => 'medium',
				'library' => 'all',
				'min_width' => '',
				'min_height' => '',
				'min_size' => '',
				'max_width' => '',
				'max_height' => '',
				'max_size' => '',
				'mime_types' => '',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'gusta_section',
				),
				array(
					'param' => 'current_user_role',
					'operator' => '==',
					'value' => 'administrator',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'side',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => 1,
		'description' => '',
	));

	/*
	
	
	Mega Menu
	
	
	

	acf_add_local_field_group(array (
		'key' => 'group_59c08907dc01b',
		'title' => 'Menu Items',
		'fields' => array (
			array (
				'key' => 'gusta_mega_menu',
				'label' => 'Mega Menu',
				'name' => 'gusta_mega_menu',
				'type' => 'true_false',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'default_value' => 0,
				'ui' => 1,
			),
			array (
				'key' => 'gusta_mega_menu_section',
				'label' => __('Select Mega Menu Section', 'mb_framework'),
				'name' => 'gusta_mega_menu_section',
				'type' => 'select',
				'conditional_logic' => array (
					array (
						array (
							'field' => 'gusta_mega_menu',
							'operator' => '==',
							'value' => '1',
						),
					),
				),
				'choices' => $mega_menu_sections_array,
				'default_value' => get_option('gusta_mega_menu_section'),
				'return_format' => 'value',
				'multiple' => 0,
				'ui' => 1,
			),
			array (
				'key' => 'gusta_mega_menu_on_click',
				'label' => 'Mega Menu on Click?',
				'name' => 'gusta_mega_menu_on_click',
				'type' => 'true_false',
				'conditional_logic' => array (
					array (
						array (
							'field' => 'gusta_mega_menu',
							'operator' => '==',
							'value' => '1',
						),
					),
				),
				'instructions' => __('If you set this option to "Yes", the mega menu will open on click, If you set it to "No", the mega menu will open on hover.', 'mb_framework'),
				'required' => 0,
				'default_value' => 0,
				'ui' => 1,
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'nav_menu_item',
					'operator' => '==',
					'value' => 'all',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => 1,
		'description' => '',
	));*/

	endif;
}
endif;
?>