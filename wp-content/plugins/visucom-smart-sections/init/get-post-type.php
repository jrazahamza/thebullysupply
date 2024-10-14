<?php
/*
* Smart Sections Init
*
* @file           init/get-post-type.php
* @package        Smart Sections
* @author         Bora Demircan & Ali Metehan Erdem
* @copyright      2018 Theme Gusta
* @license        license.txt
* @version        Release: 1.5.6
*
*/

//Outputs the post type of the archive type of the page being viewed
  if(!function_exists('gusta_get_post_type')):
    function gusta_get_post_type () {
      global $wp;
      if (defined('GUSTA_POST_TYPE')): return GUSTA_POST_TYPE; endif;
      $current_path = $_SERVER['PHP_SELF'];
      if (isset($_GET["taxonomy"])):
		$post_type = (isset($_GET["taxonomy"]) ? $_GET["taxonomy"] : 'tax');
		/*echo $post_type."-";
        if (($post_type!='category') && ($post_type!='post_tag') && ($post_type!='product_cat') && ($post_type!='product_tag')): $post_type = 'tax'; endif;*/
      elseif (isset($_GET["post"])):
        $post_type = get_post_type($_GET["post"]);
		/*echo $post_type."-";
        if (($post_type!='page') && ($post_type!='post') && ($post_type!='product') && ($post_type!='gusta_section')): $post_type = 'cpt'; endif;*/
      elseif (strpos($current_path, 'post-new.php') !== false):
        $post_type = (isset($_GET["post_type"]) ? $_GET["post_type"] : 'post');
        /*if (($post_type!='page') && ($post_type!='post') && ($post_type!='product') && ($post_type!='gusta_section')): $post_type = 'cpt'; endif;*/
      elseif (strpos($current_path, 'profile.php') !== false):
        $post_type = 'author';
      else:
        $post_type = '';
      endif;
      define ('GUSTA_POST_TYPE', $post_type);
      return $post_type;
    }
    $post_type = gusta_get_post_type();
  endif;
?>