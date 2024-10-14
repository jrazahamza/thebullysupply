<?php
/*
* Social Media Related Functions
*
* @file           functions/social.php
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

/* Facebook Comment Box */
if(!function_exists('gusta_facebook_comments')):
	function gusta_facebook_comments () {
		global $post;
		$app_id = get_option('options_gusta_facebook_api_key');
		if (!$app_id):
			echo '<p>Facebook API Key Missing.</p>';
		else:
			$url = get_permalink($post->ID);
			echo '<div class="fb-comments" data-href="'.$url.'" data-num-posts="2" data-width="100%" data-colorscheme="light" data-mobile="false"></div>';
		endif;
	}
endif;

/* Get combined FB and WordPress comment count 
if(!function_exists('gusta_full_comment_count')):
	function gusta_full_comment_count() {
		global $post;
		$url = get_permalink($post->ID);
		 
		$filecontent = file_get_contents('https://graph.facebook.com/?ids=' . $url);
		$json = json_decode($filecontent);
		$count = $json->$url->comments;
		$wpCount = get_comments_number();
		$realCount = $count + $wpCount;
		if ($realCount == 0 || !isset($realCount)) {
			$realCount = 0;
		}
		return $realCount;
	}
endif;*/

/* Disqus Comment Box */
function gusta_get_disqus_count($shortname, $articleUrl) {
	$json = json_decode(file_get_contents("https://disqus.com/api/3.0/forums/listThreads.json?forum=".$shortname."&api_key=".$YourPublicAPIKey),true);

	$array = $json['response'];
	$key = array_search($articleUrl, array_column($array, 'link'));
	return $array[$key]['posts'];
}
?>