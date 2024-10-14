<?php
/*
* Visual Composer Social Media Links & Shortcode
*
* @file           vc_elements/gusta_social_media_links.php
* @package        Smart Sections
* @author         Bora Demircan & Ali Metehan Erdem
* @copyright      2017 Theme Gusta
* @license        license.txt
* @version        Release: 1.3.8
*
*/

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}


/*
Element Description: Gusta Social Media Links
*/
 
 // Element HTML
    function gusta_social_media_links_html( $atts ) {
    	$gusta_social_media_links_networks = array('facebook', 'twitter', 'instagram', 'youtube', 'snapchat', 'pinterest', 'linkedin', 'google_plus', 'vk', 'skype', 'whatsapp', 'tumblr', 'medium', 'vimeo', 'foursquare', 'wordpress', 'dribbble', 'flickr', '500px', 'deviantart', 'behance', 'stack_overflow', 'codepen', 'github', 'stumbleupon', 'soundcloud', 'yelp', 'reddit', 'odnoklassniki', 'digg', 'wechat', 'weibo', 'email', 'website', 'rss');
        $css = $el_class = $output = '';
		$shatts = array(
			'vc_id' => '',
			'custom_1_url' => '',
			'custom_1_icon' => '',
			'custom_1hovericon' => '',
			'custom_2_url' => '',
			'custom_2_icon' => '',
			'custom_2hovericon' => '',
			'custom_3_url' => '',
			'custom_3_icon' => '',
			'custom_3hovericon' => '',
			'layout' => 'horizontal',
			'buttons_size' => '',
			'alignment' => 'left',
			'display_inline' => '',
			'mobile_display' => '',
			'mobile_alignment' => '',
			'mobile_display_inline' => '',
			'show_labels' => 'false',
			'el_class' => ''
		);

		foreach ($gusta_social_media_links_networks as $nw):
			$shatts[$nw.'_url'] = '';
			$shatts[$nw.'_icon'] = '';
		endforeach;
		$att = shortcode_atts($shatts, $atts, 'gusta_social_media_links');
		extract($att);
		
		$show_labels = (isset($show_labels) && $show_labels!='' ? ($show_labels=='true' ? true : false ) : false);
		$layout = (isset($layout) && $layout!='' ? $layout : '');
		$align = (isset($align) && $align!='' ? $align : 'left');
		
		$has_span = ($show_labels==false ? '' : ' gusta-has-span');
		
		$mobile_disp = gusta_mobile_display($att);
		
		$output = '<div class="gusta-align-'.$alignment.' '.$display_inline.$mobile_disp.'"><div id="'.$vc_id.'" class="ss-element gusta-social-media-links layout-'.$layout.' '.esc_attr($el_class).'"><ul>';
		
		if ($buttons_size!=''): $buttons_size = ' gusta-'.$buttons_size; endif;
		
		foreach ($gusta_social_media_links_networks as $nw):
			if (isset($att[$nw.'_url']) && $att[$nw.'_url'] != ''):
				$icon = str_replace("_", "-", $nw);
				if ($nw=='pinterest'): $icon = 'pinterest-p'; endif;
				if ($nw=='snapchat'): $icon = 'snapchat-ghost'; endif;
				if ($nw=='reddit'): $icon = 'reddit-alien'; endif;
				if ($nw=='wechat'): $icon = 'weixin'; endif;
				if ($nw=='email'): $icon = 'envelope-o'; endif;
				if ($nw=='website'): $icon = 'globe'; endif;
				$link = gusta_serialize_link ($att[$nw.'_url'], '<i class="fa fa-' . $icon . ' gusta-icon"></i>', 'gusta-icon-link'.$has_span.$buttons_size.'', $show_labels);
				if ($link!=''):
					$output .= '<li class="gusta-'.$icon.'">'.$link.'</li>';
				endif;
			endif;
		endforeach;
		
		for ($i=1; $i<4; $i++):
			if (isset($att['custom_'.$i.'_url']) && $att['custom_'.$i.'_url']!=''):
				if (isset($att['custom_'.$i.'hovericon']) && $att['custom_'.$i.'hovericon']!=''):
					$image = wp_get_attachment_image( $att['custom_'.$i.'_icon'], 'full', true, array("class" => "icon-normal")).
					wp_get_attachment_image( $att['custom_'.$i.'hovericon'], 'full', true, array("class" => "icon-hover"));
				else:
					$image = wp_get_attachment_image( $att['custom_'.$i.'_icon'], 'full', true);
				endif;
				$link = gusta_serialize_link ($att['custom_'.$i.'_url'], $image, 'gusta-icon-link'.$has_span.$buttons_size.'', $show_labels);
				if ($link!=''):
					$output .= '<li>'.$link.'</li>';
				endif;
			endif;
		endfor;
		
		$output .= '</ul></div></div>';
		
		$output .= gusta_clear($att);
		
		return $output;
         
    }
    add_shortcode('gusta_social_media_links', 'gusta_social_media_links_html');

	 
    // Element Mapping
    $gusta_social_media_links_networks = array('facebook', 'twitter', 'instagram', 'youtube', 'snapchat', 'pinterest', 'linkedin', 'google_plus', 'vk', 'skype', 'whatsapp', 'tumblr', 'medium', 'vimeo', 'foursquare', 'wordpress', 'dribbble', 'flickr', '500px', 'deviantart', 'behance', 'stack_overflow', 'codepen', 'github', 'stumbleupon', 'soundcloud', 'yelp', 'reddit', 'odnoklassniki', 'digg', 'wechat', 'weibo', 'email', 'website', 'rss');
		$params[] = gusta_vc_id('social-media-links');
		$params[] = array(
			'type' => 'dropdown',
			'heading' => __( 'Show Labels?', 'mb_framework' ),
			'description' => __( 'If you select "Yes", the label of the link will be displayed near the icons.', 'mb_framework' ),
			'param_name' => 'show_labels',
			'admin_label' => false,
			'value' => array (
				'Default' => '',
				'No' => 'false',
				'Yes' => 'true',
			)
		);
		$params[] = array(
			'type' => 'dropdown',
			'heading' => __( 'Layout', 'mb_framework' ),
			'param_name' => 'layout',
			'admin_label' => false,
			'value' => array (
				'Default' => '',
				'Horizontal' => 'horizontal',
				'Vertical' => 'vertical',
			)
		);
		$params[] = array(
			'type' => 'dropdown',
			'heading' => __( 'Buttons Size', 'mb_framework' ),
			'param_name' => 'buttons_size',
			'value' => array(
				'Medium' => '',
				'Small' => 'small',
				'Big' => 'big'
			),
			'std' => ''
		);
		$params[] = array(
			'type' => 'dropdown',
			'heading' => __( 'Alignment', 'mb_framework' ),
			'param_name' => 'alignment',
			"value" => array(
				'Left'   => 'left',
				'Right'   	=> 'right',
				'Center'   => 'center',
				'Justify'   => 'justify',
			),
			'edit_field_class' => 'vc_col-xs-6',
			"std" => 'left',
		);
		$params[] = array(
			'type' => 'checkbox',
			'heading' => __( 'Display Inline', 'mb_framework' ),
			'param_name' => 'display_inline',
			'admin_label' => false,
			'edit_field_class' => 'vc_col-xs-3',
			'dependency' => array( 'element' => 'alignment', 'value' => array('left','right','center') ),
			'value' => array(
				__('Yes', 'mb_framework')   => 'gusta-inline',
			)
		);
		$params[] = array(
			'type' => 'checkbox',
			'heading' => __( 'Custom for Mobile', 'mb_framework' ),
			'param_name' => 'mobile_display',
			'admin_label' => false,
			'edit_field_class' => 'vc_col-xs-3',
			'value' => array(
				__('Yes', 'mb_framework')   => 'gusta-inline',
			)
		);
		$params[] = array(
			'type' => 'dropdown',
			'heading' => __( 'Mobile Alignment', 'mb_framework' ),
			'param_name' => 'mobile_alignment',
			"value" => array(
				'Left'   => '',
				'Right'   	=> 'right',
				'Center'   => 'center',
				'Justify'   => 'justify',
			),
			'edit_field_class' => 'vc_col-xs-6',
			'dependency' => array ('element' => 'mobile_display', 'not_empty' => true),
			"std" => 'left',
		);
		$params[] = array(
			'type' => 'checkbox',
			'heading' => __( 'Mobile Display Inline', 'mb_framework' ),
			'param_name' => 'mobile_display_inline',
			'admin_label' => false,
			'edit_field_class' => 'vc_col-xs-6',
			'dependency' => array( 'element' => 'mobile_alignment', 'value' => array('left','right','center') ),
			'value' => array(
				__('Yes', 'mb_framework')   => 'gusta-mobile-inline',
			)
		);

		foreach ($gusta_social_media_links_networks as $nw):
			$name = ucwords(str_replace('_', ' ', $nw));
			if ($nw=='imdb'): $name = 'IMDb'; endif;
			$params[] = array(
				'type' => 'vc_link',
				'heading' => $name.' '.__( 'URL', 'mb_framework' ),
				'description' => __( 'Enter the URL of your '.$name.'. If left blank, '.$name.' icon will not be displayed.', 'mb_framework' ),
				'param_name' => $nw.'_url',
				'admin_label' => false,
				'weight' => 0
			);
		endforeach;
		
		for ($i=1; $i<4; $i++):
			$params[] = array(
				'type' => 'vc_link',
				'heading' => __( 'Custom Network', 'mb_framework' ).' '.$i,
				'description' => __( 'Enter the URL of your custom social network page. If left blank, it will not be displayed.', 'mb_framework' ),
				'param_name' => 'custom_'.$i.'_url',
				'admin_label' => false,
				'weight' => 0
			);
			$params[] = array(
				'type' => 'attach_image',
				'heading' => __( 'Custom Network Icon', 'mb_framework' ).' '.$i,
				'description' => __( 'Upload the icon of your custom social network. If left blank, it will not be displayed.', 'mb_framework' ),
				'param_name' => 'custom_'.$i.'_icon',
				'edit_field_class' => 'vc_col-xs-6',
				'admin_label' => false,
				'weight' => 0
			);
			$params[] = array(
				'type' => 'attach_image',
				'heading' => __( 'Custom Network Icon on Hover', 'mb_framework' ).' '.$i,
				'description' => __( 'Upload the icon of your custom social network to display when hovered. If left blank, it will not be displayed.', 'mb_framework' ),
				'param_name' => 'custom_'.$i.'hovericon',
				'edit_field_class' => 'vc_col-xs-6',
				'admin_label' => false,
				'weight' => 0
			);
		endfor;
		
		$params[] = array(
			'type' => 'colorpicker',
			'heading' => __( 'Icons Color', 'mb_framework' ),
			'param_name' => 'icons_color',
			'admin_label' => false,
			'edit_field_class' => 'vc_col-xs-4',
			'group' => __( 'Icons', 'mb_framework' ),
		);
		$params[] = array(
			'type' => 'colorpicker',
			'heading' => __( 'Icons Hover Color', 'mb_framework' ),
			'param_name' => 'iconshovercolor',
			'admin_label' => false,
			'edit_field_class' => 'vc_col-xs-4',
			'group' => __( 'Icons', 'mb_framework' ),
		);
		$params[] = array(
			'type' => 'textfield',
			'heading' => __( 'Icons Size', 'mb_framework' ),
			'description' => __( 'In pixels (i.e. 15px).', 'mb_framework' ),
			'param_name' => 'icons_size',
			'admin_label' => false,
			'edit_field_class' => 'vc_col-xs-4',
			'group' => __( 'Icons', 'mb_framework' ),
		);
		
		$params[] = gusta_vc_extra_class_name();
		
		$params = gusta_styles_tab ( $params, array ( 
			array (	'sub_group' => __( 'Labels', 'mb_framework' ), 'el_slug' => 'labels', 'dependency' => array( 'element' => 'show_labels', 'value' => 'true' ), 'enable_hover' => 1, 'enable_active' => 0, 'enable_box' => 0, 'enable_text' => 1 ),
			array (	'sub_group' => __( 'Listing Container', 'mb_framework' ), 'el_slug' => 'listing_container', 'dependency' => 0, 'enable_hover' => 1, 'enable_active' => 0, 'enable_box' => 1, 'enable_text' => 1 ),
			array (	'sub_group' => __( 'Container', 'mb_framework' ), 'el_slug' => 'container', 'dependency' => 0, 'enable_hover' => 1, 'enable_active' => 0, 'enable_box' => 1, 'enable_text' => 0 ),
		));
		
        // Map the block with vc_map()
        vc_map( 
            array(
                "name" => __("Social Media Links", "mb_framework"), // add a name
				"base" => "gusta_social_media_links", // bind with our shortcode
				"content_element" => true, // set this parameter when element will has a content
				"is_container" => false, // set this param when you need to add a content element in this element
				'admin_enqueue_css' => array( SMART_SECTIONS_PLUGIN_URL . '/assets/admin/css/vc_style.css' ),
				"category" => "Smart Sections",
				"params" => $params
            )
        );                                
     
     unset($params);