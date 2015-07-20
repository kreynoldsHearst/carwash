<?php
/*
Plugin Name: WP Find Your Nearest
Plugin URI: http://www.sargant.net/projects/wordpress-plug-ins/wp-find-your-nearest/
Description: "Find Your Nearest" creates a custom post type which can be associated with a latitude and longitude calculated from your local postal code, which can then be sorted by distance from a postal code entered into a search field.
Version: 0.2.5
Author: Adam Sargant
Author URI: http://www.sargant.net/
License: GPL2
Copyright 2011  Adam Sargant  (email : adam@sargant.net)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
define('WP_APHS_FYN_PLUGIN_URL',$plugin_url=plugin_dir_url(__FILE__));
require_once( dirname(__FILE__) . '/includes/setup.php' );
require_once( dirname(__FILE__) . '/includes/FYN_form_widget.php' );
require_once( dirname(__FILE__) . '/includes/FYN_categories_widget.php' );
require_once( dirname(__FILE__) . '/includes/countrycodes.php' );

add_action('template_redirect','load_conditional_public_pages');
function load_conditional_public_pages(){
	//enqueue the following script postcodefinder_search.js when we are on the page option selected for search results
	$options= get_option('aphs_FYN_options');
	$searchresults_page_id=$options['searchresults_page_id'];
	if(is_page($searchresults_page_id)){
        global $countrycodes_array;
		$options= get_option('aphs_FYN_options');
        
		$Google_Maps_API_Key=$options['Google_Maps_API_Key'];
		$key="";
		if($Google_Maps_API_Key){
			$key="&key=$Google_Maps_API_Key";
		}
		wp_register_script( 'googlemapapi', "http://maps.google.com/maps/api/js?sensor=false$key", FALSE );
		wp_enqueue_script( 'googlemapapi' );	
		wp_register_script( 'googleapi', "http://www.google.com/uds/api?file=uds.js&v=1.0", FALSE );
		wp_enqueue_script( 'googleapi' );
		wp_enqueue_script( 'jquery-ui-core' );
		wp_enqueue_script( 'jquery-ui-dialog' );
		wp_register_script( 'jquery_gmap', WP_APHS_FYN_PLUGIN_URL."js/jquery.gmap.min.js", array('jquery'), "", FALSE );
		wp_enqueue_script( 'jquery_gmap' );
		wp_register_script( 'postcodefinder_search', WP_APHS_FYN_PLUGIN_URL."js/postcodefinder_search.js", array('jquery'), "", FALSE );
		wp_enqueue_script( 'postcodefinder_search' );		
		$protocol = isset ( $_SERVER["HTTPS"])? 'https://':'http://';
		$countrycode_option=$countrycodes_array[$options['countrycode']];
		$params=array(
			'ajaxurl'=>admin_url( 'admin-ajax.php', $protocol),
			'countrycode'=>$countrycode_option
		);
		wp_localize_script ('postcodefinder_search','FYN_search',$params);
		wp_enqueue_style( 'wp-jquery-ui-dialog' );
	}	
}

if ( is_admin() ) {
	require_once( dirname(__FILE__) . '/includes/FYN_premium_promo.php' );
	add_action( 'admin_print_scripts-post-new.php', 'FYN_admin_script', 11 );
	add_action( 'admin_print_scripts-post.php', 'FYN_admin_script', 11 );

	function FYN_admin_script() {
		global $post_type, $countrycodes_array;
		if( 'find_your_nearest' == $post_type ){
			$options= get_option('aphs_FYN_options');
			$Google_Maps_API_Key=$options['Google_Maps_API_Key'];
            $key="";
            if($Google_Maps_API_Key){
                $key="&key=$Google_Maps_API_Key";
            }
            wp_register_script( 'googlemapapi', "http://maps.google.com/maps/api/js?sensor=false$key", FALSE );
			wp_enqueue_script( 'googlemapapi' );	
			wp_register_script( 'googleapi', "http://www.google.com/uds/api?file=uds.js&v=1.0", FALSE );
			wp_enqueue_script( 'googleapi' );
			wp_register_script( 'postcodefinder', WP_APHS_FYN_PLUGIN_URL."js/postcodefinder.js", array('jquery'), "", FALSE );
			wp_enqueue_script( 'postcodefinder' );
            $countrycode_option=$countrycodes_array[$options['countrycode']];
			wp_localize_script('postcodefinder','countrycode',$countrycode_option );			
		}
	}
	// we're in wp-admin
	require_once( dirname(__FILE__) . '/includes/admin_panel_FYN_custom_post_type.php' );
	require_once( dirname(__FILE__) . '/includes/admin_panel_FYN_options.php' );
}
else{
	// we're elsewhere
	require_once( dirname(__FILE__) . '/includes/FYN_searchresults_filter.php' );
}

add_action('wp_ajax_aphs_FYN_search_ajax', 'aphs_FYN_search_ajax');
add_action('wp_ajax_nopriv_aphs_FYN_search_ajax', 'aphs_FYN_search_ajax');
//process ajax data and send response
function aphs_FYN_search_ajax(){
	//echo var_export($_POST, true);
	$options= get_option('aphs_FYN_options');
	$Distance_Units=$options['Distance_Units'];
	$Display_Results=$options['Display_Results'];
	$lat1=$_POST['lat'];
	$lng1=$_POST['lng'];
	//$args=array( 'post_type' => array( 'FYN' ) ) ;
	$args=array(
				'post_type' => 'find_your_nearest',
				'posts_per_page' => '-1'
			);
	// The Query
	$the_query = new WP_Query( $args );

	// build array from The Loop
	$results=array();
	while ( $the_query->have_posts() ) : $the_query->the_post();
		$lng2=get_post_meta (get_the_ID(), '_aphs_FYN_longitude', TRUE );
		$lat2=get_post_meta (get_the_ID(), '_aphs_FYN_latitude', TRUE );
		$aphs_FYN_postcode = get_post_meta ($post->ID, '_aphs_FYN_postcode', TRUE );
		//calculate distance from 
		$theta = $lng1 - $lng2; 
		$dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)); 
		$dist = acos($dist); 
		$dist = rad2deg($dist); 
		$miles = $dist * 60 * 1.1515;
		$content = get_the_content();
		$content = nl2br($content);
		$content = str_replace('><br />', '>', $content);
		$title=get_the_title();
		switch($Distance_Units){
			case "miles":$results["$miles"][$title]="<h2>$title</h2><em>Distance ".round($miles)." miles</em> <span class='FYN_viewmap' style='cursor: pointer' id='".get_the_ID()."'>view map</span><p>".$content."</p>";
			break;
			case "kilometres":$results["$miles"][$title]="<h2>$title</h2><em>Distance ".round($miles * 1.609344)."km</em> <span class='FYN_viewmap' style='cursor: pointer' id='".get_the_ID()."'>view map</span><p>".$content."</p>";
			break;
			default:$results["$miles"][$title]="<h2>$title</h2> <span class='FYN_viewmap' style='cursor: pointer' id='".get_the_ID()."'>view map</span><p>".$content."</p>";
			break;
		}
		
	endwhile;
	// Reset Post Data
	wp_reset_postdata();
	ksort($results);
	if($Display_Results!=0 AND $Display_Results<count($results)){
		$results = array_slice($results, 0, $Display_Results);
	}
	foreach($results as $distance=>$content){
		ksort($content);
		foreach($content as $item){
			echo $item;
		}
	}
	die();
}

add_action('wp_ajax_aphs_FYN_get_postcode_from_postID', 'aphs_FYN_get_postcode_from_postID');
add_action('wp_ajax_nopriv_aphs_FYN_get_postcode_from_postID', 'aphs_FYN_get_postcode_from_postID');
//process ajax data and send response
function aphs_FYN_get_postcode_from_postID(){
	$aphs_FYN_postcode = get_post_meta ($_GET['postID'], '_aphs_FYN_postcode', TRUE );
	$aphs_FYN_latitude = get_post_meta ($_GET['postID'], '_aphs_FYN_latitude', TRUE );
	$aphs_FYN_longitude = get_post_meta ($_GET['postID'], '_aphs_FYN_longitude', TRUE );
	$title=get_the_title($_GET['postID']);
	$arr=array(
		'postcode'=>$aphs_FYN_postcode,
		'latitude'=>$aphs_FYN_latitude,
		'longitude'=>$aphs_FYN_longitude,
		'title'=>$title
	);
	echo json_encode($arr);
	die();
}
?>
