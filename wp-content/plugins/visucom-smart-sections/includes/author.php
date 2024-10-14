<?php
/*
* Wordpress Author Functions
*
* @file           includes/author.php
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

/* Add Social Media fields to Author Profile */
if(!function_exists('gusta_user_social_info')):
	function gusta_user_social_info( $social ) {

		$social['facebook'] = 'Facebook';
		$social['twitter'] = 'Twitter';
		$social['instagram'] = 'Instagram';
		$social['linkedin'] = 'LinkedIn';
		$social['whatsapp'] = 'WhatsApp';
		$social['google-plus'] = 'GooglePlus';
		$social['pinterest'] = 'Pinterest';
		$social['youtube'] = 'YouTube';
		$social['skype'] = 'Skype';
		$social['whatsapp'] = 'Whatsapp';
		$social['snapchat'] = 'Snapchat';
		$social['vimeo'] = 'Vimeo';
		$social['tumblr'] = 'Tumblr';
		$social['medium'] = 'Medium';
		$social['stumbleupon'] = 'StumbleUpon';
		$social['reddit'] = 'Reddit';
		$social['flickr'] = 'Flickr';
		$social['foursquare'] = 'Foursquare';
		$social['wordpress'] = 'Wordpress';
		$social['deviantart'] = 'DeviantArt';
		$social['500px'] = '500px';
		$social['soundcloud'] = 'SoundCloud';
		$social['behance'] = 'Behance';
		$social['dribbble'] = 'Dribbble';
		$social['stack-overflow'] = 'StackOverflow';
		$social['codepen'] = 'Codepen';
		$social['github'] = 'GitHub';
		$social['vk'] = 'VKontakte';
		$social['odnoklassniki'] = 'Odnoklassniki';
		$social['yelp'] = 'Yelp';
		$social['digg'] = 'Digg';
		$social['wechat'] = 'Wechat';
		$social['weibo'] = 'Weibo';

		return $social;
	}
	add_filter('user_contactmethods','gusta_user_social_info',10,1);
endif;

/* User Social Links */
if(!function_exists('gusta_user_social_links')):
	function gusta_user_social_links ($author_id, $social_media_links_size='') {
		$auth_meta = wp_get_user_contact_methods($author_id);
		$output = '';
		if ($social_media_links_size!=''): $links_size = ' gusta-'.$social_media_links_size; endif;
		foreach ($auth_meta as $slug => $name):
			$link = get_the_author_meta($slug, $author_id);
			if ($link) :
				$icon = $slug;
				if ($icon=='pinterest'): $icon = 'pinterest-p'; endif;
				if ($icon=='snapchat'): $icon = 'snapchat-ghost'; endif;
				if ($icon=='reddit'): $icon = 'reddit-alien'; endif;
				if ($icon=='wechat'): $icon = 'weixin'; endif;
				$output .= '<li class="gusta-'.$icon.'"><a href="' . $link . '" target="_blank" class="gusta-icon-link'.$links_size.'" title="' . $name . '"><i class="fa fa-' . $icon . ' gusta-icon"></i></a></li>';
			endif;
		endforeach;
		
		return $output;
	}
endif;
?>