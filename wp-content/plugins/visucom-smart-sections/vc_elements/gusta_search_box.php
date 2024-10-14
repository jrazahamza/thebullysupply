<?php
/*
* Visual Composer Search Box Element & Shortcode
*
* @file           vc_elements/gusta_search_box.php
* @package        Smart Sections
* @author         Bora Demircan & Ali Metehan Erdem
* @copyright      2017 Theme Gusta
* @license        license.txt
* @version        Release: 1.7.8
*
*/

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/*
Element Description: Gusta Search Box
*/

// Element HTML
    function gusta_search_box_html( $atts ) {
        $css = $el_class = ''; unset ($dynamic_css);
		
		$att = shortcode_atts(array(
			'vc_id' => '',
			'search_box_type' => 'default',
			'search_box_width' => '',
			'search_box_size' => '',
			'search_button_type' => 'icon_inside',
			'placeholder' => __('Enter search term', 'mb_framework'),
			'button_text' => __('Search', 'mb_framework'),
			'autosuggest' => '',
			'post_type' => '',
			'alignment' => 'left',
			'display_inline' => '',
			'mobile_display' => '',
			'mobile_alignment' => '',
			'mobile_display_inline' => '',
			'search_icon' => 'fontawesome',
			'search_icon_fontawesome' => 'fa fa-search',
			'search_icon_openiconic' => 'vc-oi vc-oi-dial',
			'search_icon_typicons' => 'typcn typcn-adjust-brightness',
			'search_icon_entypo' => 'entypo-icon entypo-icon-note',
			'search_icon_linecons' => 'vc_li vc_li-heart',
			'search_icon_pixelicons' => 'vc_pixel_icon vc_pixel_icon-alert',
			'search_icon_monosocial' => 'vc-mono vc-mono-fivehundredpx',
			'search_icon_material' => 'vc-material vc-material-cake',
			'el_class' => '',
			'css_animation' => ''
		), $atts, 'gusta_search_box');
		extract($att);
		
		$auto = '';
		if (isset($autosuggest) && $autosuggest=='true' && isset($post_type) && $post_type!=''):
			$auto = ' data-posttypes="'.$post_type.'"';
		endif;
		
		if (isset($post_type) && $post_type!=''):
			$action = get_post_type_archive_link( $post_type );
		else:
			$action = get_site_url();
		endif;
		
		if ($search_box_size!=''): $search_box_size = ' gusta-'.$search_box_size; endif;
		
		$mobile_disp = gusta_mobile_display($att);
		
		$s = esc_attr(get_search_query());
		if (!$s): if (isset($_GET["s"])): $s = esc_attr($_GET["s"]); endif; endif;
		
		$output = '<div id="'.$vc_id.'" class="gusta-search-form ss-element gusta-align-'.$alignment.' '.$display_inline.$mobile_disp.$search_box_size.' '.$el_class.'"><form method="get" action="'.$action.'">';
		
		$output .= '<div class="form-group '.$search_box_type.'"><input class="form-control search-query" autocomplete="off" name="s" id="gusta-search" placeholder="'.$placeholder.'" value="'.$s.'" type="text"'.$auto.'>';
		
		if ($search_button_type=="icon_inside"):
		
			$icon_class = $att['search_icon_'.$search_icon];
			if ($icon_class!='fa fa-search'):
				vc_icon_element_fonts_enqueue( $search_icon );
			endif;
			
			$output .= '<button type="submit" class="search-icon-button"><i class="'.$icon_class.'" aria-hidden="true"></i></button>';
		else: 
			$output .= '<button type="submit" class="search-button">'.$button_text.'</button>';
		endif;
		
		$output .=  '<ul class="results"></ul>
			</div>';
		if (isset($post_type) && $post_type!='' && $post_type!='post'):
			$output .= '<input type="hidden" name="post_type" value="'.$post_type.'" />';
		endif;
		$output .= '</form></div>';
		
		$output .= gusta_clear($att);
		
		return $output;
         
    }
 
	add_shortcode('gusta_search_box', 'gusta_search_box_html');

    // Element Mapping
		$params = array(
			gusta_vc_id('search-box'),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Search Box Type', 'mb_framework' ),
				'param_name' => 'search_box_type',
				'admin_label' => false,
				"value" => array(
					__('Standard', 'mb_framework')   => 'default',
					__('Expanding', 'mb_framework')  => 'expanding',
				),
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Search Button Type', 'mb_framework' ),
				'param_name' => 'search_button_type',
				'admin_label' => false,
				"value" => array(
					__('Icon Inside Search Field', 'mb_framework')   => 'icon_inside',
					__('Standard Button', 'mb_framework')  => 'standard_button',
				),
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Search Box Size', 'mb_framework' ),
				'param_name' => 'search_box_size',
				'value' => array(
					'Medium' => '',
					'Small' => 'small',
					'Big' => 'big'
				),
				'std' => ''
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Search Box Width', 'mb_framework' ),
				'param_name' => 'search_box_width',
				'description' => __( 'Enter a pixel or percentage value (i.e. 300px or 90%). Please make sure that the minimum width is higher than the width of the search button.', 'mb_framework' ),
				'admin_label' => false,
				'std' => '100%',
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Search Box Width (Expanded)', 'mb_framework' ),
				'param_name' => 'expand_width',
				'description' => __( 'Enter a pixel or percentage value (i.e. 400px or 120%) for your search field to expand on focus.', 'mb_framework' ),
				'admin_label' => false,
				'dependency' => array ('element' => 'search_box_type', 'value' => 'expanding'),
				'std' => '100%',
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Placeholder Text', 'mb_framework' ),
				'param_name' => 'placeholder',
				'admin_label' => false,
				'std' => __('Enter search term', 'mb_framework'),
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Search Button Text', 'mb_framework' ),
				'param_name' => 'button_text',
				'admin_label' => false,
				'std' => __('Search', 'mb_framework'),
			),
			array(
				'type' => 'checkbox',
				'heading' => __( 'Enable Autosuggest', 'mb_framework' ),
				'param_name' => 'autosuggest',
				'admin_label' => false,
				"value" => array(
					'Yes'   => 'true',
				),
			),
			array(
				'type'        => 'dropdown',
				'heading'     => __( 'Post Type', 'mb_framework' ),
				'param_name'  => 'post_type',
				'value'   => array_merge(array('All Post Types' => ''), gusta_get_post_types ()),
				'description' => __( 'Enter the post type to retreive in the search results  and the autosuggest area in this search box.', 'mb_framework' )
			),
		);
		
		$params = gusta_element_display($params);
		$params[] = gusta_vc_extra_class_name();
		
		$params = gusta_add_icon_field ( $params, array (
			'heading' => __('Search Icon', 'mb_framework'), 
			'param_name' => 'search_icon', 
			'dependency' => array ('element' => 'search_button_type', 'value' => 'icon_inside'),
			'group' => __( 'Icon', 'mb_framework' ),
			'std' => 'fa fa-search',
			'enable_hover' => 1,
			'enable_active' => 0
		));
		
		$params = gusta_styles_tab ( $params, array ( 
			array (	'sub_group' => __( 'Images', 'mb_framework' ), 'el_slug' => 'autosuggest_image', 'dependency' => array ('element' => 'autosuggest', 'value' => 'true'), 'enable_hover' => 1, 'enable_active' => 0, 'enable_box' => 1, 'enable_text' => 0 ),
			array (	'sub_group' => __( 'Suggest', 'mb_framework' ), 'el_slug' => 'autosuggest', 'dependency' => array ('element' => 'autosuggest', 'value' => 'true'), 'enable_hover' => 1, 'enable_active' => 0, 'enable_box' => 1, 'enable_text' => 1 ),
			array (	'sub_group' => __( 'Placeholder', 'mb_framework' ), 'el_slug' => 'placeholder', 'dependency' => 0, 'enable_hover' => 1, 'enable_active' => 0, 'enable_box' => 0, 'enable_text' => 1 ),
			array (	'sub_group' => __( 'Button', 'mb_framework' ), 'el_slug' => 'search_button', 'dependency' => 0, 'enable_hover' => 1, 'enable_active' => 0, 'enable_box' => 1, 'enable_text' => 1 ),
			array (	'sub_group' => __( 'Search Field', 'mb_framework' ), 'el_slug' => 'search_field', 'dependency' => 0, 'enable_hover' => 1, 'enable_active' => 1, 'enable_box' => 1, 'enable_text' => 1 ),
			array (	'sub_group' => __( 'Container', 'mb_framework' ), 'el_slug' => 'container', 'dependency' => 0, 'enable_hover' => 1, 'enable_active' => 0, 'enable_box' => 1, 'enable_text' => 0 ),
		));
		
        // Map the block with vc_map()
        vc_map( 
            array(
                "name" => __("Search Box", "mb_framework"), // add a name
				"base" => "gusta_search_box", // bind with our shortcode
				"content_element" => true, // set this parameter when element will has a content
				"is_container" => false, // set this param when you need to add a content element in this element
				//'admin_enqueue_css' => array( SMART_SECTIONS_PLUGIN_URL . '/assets/admin/css/vc_style.css' ),
				"category" => "Smart Sections",
				"params" => $params
            )
        );                                
        
  unset($params);
     
?>