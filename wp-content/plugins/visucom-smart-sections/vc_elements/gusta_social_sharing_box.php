<?php
/*
* Visual Composer Social Sharing Box & Shortcode
*
* @file           vc_elements/gusta_social_sharing_box.php
* @package        Smart Sections
* @author         Bora Demircan & Ali Metehan Erdem
* @copyright      2017 Theme Gusta
* @license        license.txt
* @version        Release: 1.6.1
*
*/

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}


/*
Element Description: Gusta Social Sharing Box
*/
 
$gusta_social_sharing_box_networks = array ('facebook', 'twitter', 'google_plus', 'pinterest', 'linkedin', 'whatsapp', 'tumblr', 'stumbleupon', 'digg', 'vk', 'print', 'email', 'reddit', 'weibo', 'delicious', 'get_pocket', 'mail.ru', 'odnoklassniki');
	

   // Element HTML
    function gusta_social_sharing_box_html( $atts ) {
        $css = $el_class = $output = '';
		$shatts = array(
			'vc_id' => '',
			'select_buttons' => '',
			'layout' => 'horizontal',
			'buttons_size' => '',
			'alignment' => 'left',
			'display_inline' => '',
			'mobile_display' => '',
			'mobile_alignment' => '',
			'mobile_display_inline' => '',
			'show_label' => '',
			'button_colors' => '',
			'el_class' => ''
		);
		$att = shortcode_atts($shatts, $atts, 'gusta_social_sharing_box');
		extract($att);
		
		
		$layout = (isset($layout) && $layout!='' ? $layout : '');
		$alignment = (isset($alignment) && $alignment!='' ? $alignment : 'left');
		
		$mobile_disp = gusta_mobile_display($att);
		
		$output = '<div class="gusta-align-'.$alignment.' '.$display_inline.$mobile_disp.'"><div id="'.$vc_id.'" class="ss-element gusta-social-sharing-box gusta-social-media-links layout-'.$layout.' '.esc_attr($el_class).'"><ul>';
		
		$selected = explode (',', $select_buttons);
		
		if ($buttons_size!=''): $buttons_size = ' gusta-'.$buttons_size; endif;
		
		foreach ($selected as $nw):
			$nw = trim($nw);
			$icon = str_replace("_", "-", $nw);
			if ($nw=='pinterest'): $icon = 'pinterest-p'; endif;
			if ($nw=='reddit'): $icon = 'reddit-alien'; endif;
			if ($nw=='mail.ru'): $icon = 'at'; endif;
			if ($nw=='email'): $icon = 'envelope-o'; endif;
			if ($nw=='reddit'): $icon = 'reddit-alien'; endif;
			$pageurl = get_the_permalink();
			if ($pageurl==''): $pageurl = '//' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; endif;
			$title = get_the_title();
			$desc = get_gusta_excerpt(25);
			$thumbnail = get_the_post_thumbnail_url(get_the_ID(),'large');
			$link = '';
			switch ($nw) {
				case ('facebook'):
					$link = 'https://www.facebook.com/share.php?u='.$pageurl;
				break;
				case ('twitter'):
					$link = 'https://twitter.com/intent/tweet?text='.$title.'%20'.$pageurl.'&source=webclient';
				break;
				case ('google_plus'):
					$link = 'https://plus.google.com/share?url='.$pageurl;
				break;
				case ('pinterest'):
					$link = 'https://tr.pinterest.com/pin/create/button/?url='.$pageurl.'&media='.$thumbnail.'';
				break;
				case ('linkedin'):
					$link = 'https://www.linkedin.com/shareArticle?mini=true&url='.$pageurl;
				break;
				case ('whatsapp'):
					if (wp_is_mobile()):
						$link = 'whatsapp://send?text='.$title.'%20'.$pageurl.'" data-action="share/whatsapp/share';
					else:
						$link = 'https://web.whatsapp.com/send?text='.$title.'%20'.$pageurl;
					endif;
				break;
				case ('tumblr'):
					$link = 'https://www.tumblr.com/widgets/share/tool?&url='.$pageurl;
				break;
				case ('stumbleupon'):
					$link = 'http://www.stumbleupon.com/submit?url='.$pageurl;
				break;
				case ('digg'):
					$link = 'http://digg.com/submit?url='.$pageurl.'&title='.$title;
				break;
				case ('vk'):
					$link = 'http://vk.com/share.php?url='.$pageurl;
				break;
				case ('odnoklassniki'):
					$link = 'https://connect.ok.ru/dk?st.cmd=WidgetSharePreview&st.shareUrl='.$pageurl.'&title='.$title;
				break;
				case ('email'):
					$link = 'mailto:someone@example.com?subject='.$title.'&body='.$desc.'%20'.$pageurl;
				break;
				case ('reddit'):
					$link = 'http://www.reddit.com/submit?url='.$pageurl;
				break;
				case ('weibo'):
					$link = 'http://service.weibo.com/share/share.php?url='.$pageurl.'&title='.$title;
				break;
				case ('get_pocket'):
					$link = 'https://getpocket.com/save?url='.$pageurl.'&title='.$title;
				break;
				case ('mail.ru'):
					$link = 'http://connect.mail.ru/share?share_url='.$pageurl;
				break;
				case ('delicious'):
					$link = 'https://delicious.com/save?v=5&provider=&noui&jump=close&url='.$pageurl.'&title='.$title;
				break;
				case ('print'):
					$link = 'javascript:window.print()';
				break;
			}
			
			if ($link!=''):
				if ($nw=='google_plus'): $nw = 'Google+'; endif;
				if ($nw == 'print'): 
					$link_title = __('Print this page', 'mb_framework');
				else:
					$link_title = __('Share via', 'mb_framework') . ' ' . ucwords(str_replace('_', '-',$nw));
				endif;
				$label_text = $label_class = '';
				if (isset($show_label) && $show_label!=''): 
					$label_text = ' <span>'.ucwords(str_replace('_', '-',$nw)).'</span>'; 
					$label_class = ' label-'.$show_label;
				endif;
				$has_span = ($label_text!='' ? ' gusta-has-span'.$label_class : '');
				$output .= '<li class="gusta-'.$icon.'"><a title="'.$link_title.'" class="gusta-icon-link'.$has_span.$buttons_size.'" href="'.$link.'"';
				if ($nw!='print'): $output .= ' target="_blank"'; endif;
				$output .='><i class="fa fa-' . $icon . ' gusta-icon"></i> '.$label_text.'</a></li>';
			endif;
			
		endforeach;
		
		$output .= '</ul></div></div>';
		
		$output .= gusta_clear($att);
		
		return $output;
         
    }


	add_shortcode( 'gusta_social_sharing_box', 'gusta_social_sharing_box_html' );

		
		$buttons = array();
		foreach ($gusta_social_sharing_box_networks as $nw):
			$buttons[] = array( 'label' => ucwords(str_replace('_', ' ', $nw)), 'value' => $nw );
		endforeach;
		
		$params[] = gusta_vc_id('social-sharing-box');
		$params[] = array(
			'type'        => 'autocomplete',
			'heading' => __( 'Select Share Buttons to Display', 'mb_framework' ),
			'param_name'  => 'select_buttons',
			'settings'    => array(
				'multiple' => true,
				'sortable' => true,
				'min_length' => 1,
				'no_hide' => false,
				'groups' => false,
				'unique_values' => true,
				'display_inline' => false, 
				'values'   => $buttons,
			),
			'description' => __( 'From the autocomplete field above, add the social networks you want to add to your social sharing box.', 'mb_framework' ),
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
		$params[] = array(
			'type' => 'dropdown',
			'heading' => __( 'Show Label', 'mb_framework' ),
			'param_name' => 'show_label',
			'admin_label' => false,
			'value' => array (
				__('No', 'mb_framework') => '',
				__('Right', 'mb_framework') => 'right',
				__('Bottom', 'mb_framework') => 'bottom',
			)
		);
		
		$params[] = array(
			'type' => 'colorpicker',
			'heading' => __( 'Icons Color', 'mb_framework' ),
			'param_name' => 'icons_color',
			'admin_label' => false,
			'edit_field_class' => 'vc_col-xs-6',
			'group' => __( 'Icons', 'mb_framework' ),
		);
		$params[] = array(
			'type' => 'colorpicker',
			'heading' => __( 'Icons Hover Color', 'mb_framework' ),
			'param_name' => 'iconshovercolor',
			'admin_label' => false,
			'edit_field_class' => 'vc_col-xs-6',
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
			array (	'sub_group' => __( 'Labels', 'mb_framework' ), 'el_slug' => 'labels', 'dependency' => 0, 'enable_hover' => 1, 'enable_active' => 0, 'enable_box' => 0, 'enable_text' => 1 ),
			array (	'sub_group' => __( 'Listing Container', 'mb_framework' ), 'el_slug' => 'listing_container', 'dependency' => 0, 'enable_hover' => 1, 'enable_active' => 0, 'enable_box' => 1, 'enable_text' => 1 ),
			array (	'sub_group' => __( 'Container', 'mb_framework' ), 'el_slug' => 'container', 'dependency' => 0, 'enable_hover' => 1, 'enable_active' => 0, 'enable_box' => 1, 'enable_text' => 0 ),
		));
		
        // Map the block with vc_map()
        vc_map( 
            array(
                "name" => __("Social Sharing Box", "mb_framework"), // add a name
				"base" => "gusta_social_sharing_box", // bind with our shortcode
				"content_element" => true, // set this parameter when element will has a content
				"is_container" => false, // set this param when you need to add a content element in this element
				'admin_enqueue_css' => array( SMART_SECTIONS_PLUGIN_URL . '/assets/admin/css/vc_style.css' ),
				"category" => "Smart Sections",
				"params" => $params
            )
        );

unset($params);