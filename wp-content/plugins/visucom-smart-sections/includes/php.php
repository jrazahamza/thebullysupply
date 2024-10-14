<?php
/*
* Useful PHP Functions
*
* @file           functions/php.php
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
 
/* Hex Code to RGB values */
if(!function_exists('gusta_hextorgbcss')):
	function gusta_hextorgbcss($hex, $alpha = false) {
		if (strpos($hex, '#') !== false): 
			$hex = str_replace('#', '', $hex);
			$a = $r = $g = $b = '';
			if ( strlen($hex) == 6 ) {
				$r = hexdec(substr($hex, 0, 2));
				$g = hexdec(substr($hex, 2, 2));
				$b = hexdec(substr($hex, 4, 2));
			} else if ( strlen($hex) == 3 ) {
				$r = hexdec(str_repeat(substr($hex, 0, 1), 2));
				$g = hexdec(str_repeat(substr($hex, 1, 1), 2));
				$b = hexdec(str_repeat(substr($hex, 2, 1), 2));
			} else {
				$r = '0';
				$g = '0';
				$b = '0';
			}
			if ( $alpha ) {
				$a = $alpha;
			}
			$rgb = 'rgba('.$r.','.$g.','.$b.','.$a.')';
		else:
			$rgb = $hex;
		endif;
		return $rgb;
	}
endif;


/* Gets a string between two strings */
if(!function_exists('gusta_get_string_between')):
	function gusta_get_string_between($string, $start, $end){
		$string = ' ' . $string;
		$ini = strpos($string, $start);
		if ($ini == 0) return '';
		$ini += strlen($start);
		$len = strpos($string, $end, $ini) - $ini;
		return substr($string, $ini, $len);
	}
endif;


/* Replaces the first occurance of a string in a string */
if(!function_exists('gusta_str_replace_first')):
	function gusta_str_replace_first($from, $to, $subject) {
		$from = '/'.preg_quote($from, '/').'/';

		return preg_replace($from, $to, $subject, 1);
	}
endif;
?>