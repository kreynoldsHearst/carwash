<?php

add_action( 'add_meta_boxes', 'aphs_FYN_meta_box' );
add_action( 'add_meta_boxes', 'aphs_FYN_premium_promo_meta_box' );

function aphs_FYN_premium_promo_meta_box(){
	add_meta_box('aphs_FYN_premium_promo_meta_box','WP Find Your Nearest Premium','aphs_FYN_meta_box_premium_promo_function','find_your_nearest','side');
}

function aphs_FYN_meta_box(){
	add_meta_box('aphs_FYN_meta_box','Postal Code Data','aphs_FYN_meta_box_function','find_your_nearest','side','high');
}

function aphs_FYN_meta_box_premium_promo_function( $post ){
?>
<p><a href="http://www.sargant.net/projects/wordpress-plug-ins/wp-find-your-nearest-premium/" target="_blank">WP Find Your Nearest Premium</a> is now available. WP Find Your Nearest Premium extends the functionality of the standard version by adding 
	<ul>
	<li>- the ability to use a hierarchical taxonomy (category), ideal for sorting entries by region and subregion for example</li>
	<li>- the ability to apply non-hierarchical taxonomy (tags) and to restrict search to specific tags - suitable for differentiating between entry types</li>
	<li>- the ability to limit search by radius/distance from</li>
	<li>- the ability to show shortenedexcerpts in the returned results</li>
	<li>- shortcode functionality to insert search form into post or page rather than only a widget</li>
	<li>- the ability to add explanatory text to the top of the search results page</li>
	<li>- the ability to use shortcodes within returned search results</li>
	<li><strong>- support and lifetime upgrades, all for a <a href="http://www.sargant.net/projects/wordpress-plug-ins/wp-find-your-nearest-premium/" target="_blank">one off &pound;15 sterling</a></strong></li>
</ul></p>
<?php
}

function aphs_FYN_meta_box_function( $post ){
	$aphs_FYN_postcode = get_post_meta ($post->ID, '_aphs_FYN_postcode', TRUE );
	$aphs_FYN_latitude = get_post_meta ($post->ID, '_aphs_FYN_latitude', TRUE );
	$aphs_FYN_longitude = get_post_meta ($post->ID, '_aphs_FYN_longitude', TRUE );
?>
<table>
	<tr>
		<td>Postal Code: </td><td><input name="aphs_FYN_postcode" type="text" class="formfield" id="fyn_postalcode" value="<?php echo $aphs_FYN_postcode;?>" size="16" /></td>
	</tr>
	<tr>
		<td colspan='2'><button id="update_latlong">Update Latitude and Longitude</button><br /></td>
	</tr>
	<tr>
		<td>Latitude:</td><td><input name="aphs_FYN_latitude" type="text" class="formfield" id="aphs_FYN_latitude" value="<?php echo $aphs_FYN_latitude;?>" size="16" /></td>
	</tr>
	<tr>
		<td>Longitude:</td><td><input name="aphs_FYN_longitude" type="text" class="formfield" id="aphs_FYN_longitude" value="<?php echo $aphs_FYN_longitude;?>" size="16" /</td>
	</tr>	
</table>
<?php
}


add_action( 'save_post', 'aphs_save_FYN_meta' );

function aphs_save_FYN_meta( $post_id ){
	if(isset($_POST['aphs_FYN_postcode']) AND isset($_POST['aphs_FYN_latitude']) AND isset($_POST['aphs_FYN_longitude'])){
		update_post_meta( $post_id, '_aphs_FYN_postcode', $_POST['aphs_FYN_postcode']);
		update_post_meta( $post_id, '_aphs_FYN_latitude', $_POST['aphs_FYN_latitude']);
		update_post_meta( $post_id, '_aphs_FYN_longitude', $_POST['aphs_FYN_longitude']);
	}
}
?>
