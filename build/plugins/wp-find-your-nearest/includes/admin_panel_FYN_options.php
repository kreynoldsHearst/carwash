<?php
add_action( 'admin_menu', 'aphs_FYN_add_menu' );

function aphs_FYN_add_menu() {
	$parent_slug='edit.php?post_type=find_your_nearest';
	$page_title='FYN Settings';
	$menu_title='Settings';
	$capability='manage_options';
	$menu_slug='_settings';
	$function='aphs_FYN_options_page';
	add_submenu_page( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function );
	//add_submenu_page('WP Themes by Screensize', 'WP Themes by Screensize', 'manage_options', 'aphs_WP_Themes_by_Screensize', aphs_FYN_options_page );
}


add_action('admin_init', 'aphs_FYN_admin_init');

function aphs_FYN_admin_init() {
	$option_group='aphs_FYN_options';
	$option_name='aphs_FYN_options';
	$sanitize_callback='aphs_FYN_validate_options';
	register_setting( $option_group, $option_name, $sanitize_callback );
	
	$id='aphs_FYN_Google_Maps_API_Key';
	$title='Google Maps API Key';
	$callback='aphs_FYN_Google_Maps_API_Key_text';
	$page='_settings';
	add_settings_section( $id, $title, $callback, $page );
	
	$id='aphs_FYN_Google_Maps_API_Key';
	$title='Google API Console Key';
	$callback='aphs_FYN_Google_Maps_API_Key_form';
	$page='_settings';
	$section='aphs_FYN_Google_Maps_API_Key';
	$args='';
	add_settings_field( $id, $title, $callback, $page, $section, $args );	

	$id='aphs_FYN_Distance_Units';
	$title='Distance Units';
	$callback='aphs_FYN_Distance_Units_text';
	$page='_settings';
	add_settings_section( $id, $title, $callback, $page );
	
	$id='aphs_FYN_Distance_Units';
	$title='Distance Units';
	$callback='aphs_FYN_Distance_Units_form';
	$page='_settings';
	$section='aphs_FYN_Distance_Units';
	$args='';
	add_settings_field( $id, $title, $callback, $page, $section, $args );
	
	$id='aphs_FYN_Display_Results';
	$title='Display Results';
	$callback='aphs_FYN_Display_Results_text';
	$page='_settings';
	add_settings_section( $id, $title, $callback, $page );
	
	$id='aphs_FYN_Display_Results';
	$title='Display Results';
	$callback='aphs_FYN_Display_Results_form';
	$page='_settings';
	$section='aphs_FYN_Display_Results';
	$args='';
	add_settings_field( $id, $title, $callback, $page, $section, $args );

	$id='aphs_FYN_Item_Name';
	$title='Item Name';
	$callback='aphs_FYN_Item_Name_text';
	$page='_settings';
	add_settings_section( $id, $title, $callback, $page );
	
	$id='aphs_FYN_Item_Name';
	$title='Item Name';
	$callback='aphs_FYN_Item_Name_form';
	$page='_settings';
	$section='aphs_FYN_Item_Name';
	$args='';
	add_settings_field( $id, $title, $callback, $page, $section, $args );

	$id='aphs_FYN_searchresults_page';
	$title='Search Results Page';
	$callback='aphs_FYN_searchresults_page_text';
	$page='_settings';
	add_settings_section( $id, $title, $callback, $page );
	
	$id='aphs_FYN_searchresults_page';
	$title='Search Results Page';
	$callback='aphs_FYN_searchresults_page_form';
	$page='_settings';
	$section='aphs_FYN_searchresults_page';
	$args='';
	add_settings_field( $id, $title, $callback, $page, $section, $args );
	
	$id='aphs_FYN_country';
	$title='Country';
	$callback='aphs_FYN_country_text';
	$page='_settings';
	add_settings_section( $id, $title, $callback, $page );
	
	$id='aphs_FYN_country';
	$title='Country';
	$callback='aphs_FYN_country_form';
	$page='_settings';
	$section='aphs_FYN_country';
	$args='';
	add_settings_field( $id, $title, $callback, $page, $section, $args );
}

function aphs_FYN_Google_Maps_API_Key_text() {
	echo '<p>The Google API Console Key is optional but recommended. Using an API key enables you to monitor your application\'s Maps API usage, and ensures that Google can contact you about your application if necessary. If your application\'s Maps API usage by exceeds the Usage Limits, you must load the Maps API using an API key in order to purchase additional quota. If you do not have a Google API Console Key you can get one here <a href=\'https://developers.google.com/maps/documentation/javascript/tutorial#api_key\'>https://developers.google.com/maps/documentation/javascript/tutorial</a></p>';
}

function aphs_FYN_Google_Maps_API_Key_form() {
	//get option 'Google_Maps_API_Key' from database
	$options= get_option('aphs_FYN_options');
	$Google_Maps_API_Key=$options['Google_Maps_API_Key'];
	//echo the field
	echo "<input id='Google_Maps_API_Key' name='aphs_FYN_options[Google_Maps_API_Key]' type='text' value='{$options['Google_Maps_API_Key']}' />";
}

function aphs_FYN_Distance_Units_text() {
	echo '<p>Choose the units you want to display distance in. If unset, no distance will be shown</p>';
}

function aphs_FYN_Distance_Units_form() {
	$options= get_option('aphs_FYN_options');
	$Distance_Units=$options['Distance_Units'];
	echo "<select name='aphs_FYN_options[Distance_Units]' > 
	<option value=''>".esc_attr( __( 'Select Units' ) )."</option>
	<option value='miles'";
	if($Distance_Units == 'miles' ){
		echo' selected="selected" ';
	}
	echo">Miles</option>
	<option value='kilometres'";
	if($Distance_Units == 'kilometres' ){
		echo' selected="selected" ';
	}
	echo">Kilometres</option>";
	echo "</select>";
}

function aphs_FYN_Display_Results_text() {
	echo '<p>Choose how many results you want returned from your search (max)</p>';
}

function aphs_FYN_Display_Results_form() {
	$options= get_option('aphs_FYN_options');
	$Display_Results=$options['Display_Results'];
	echo "<select name='aphs_FYN_options[Display_Results]' > 
	<option value=''>".esc_attr( __( 'Unlimited' ) )."</option>
	<option value='1'";
	if($Display_Results == 1 ){
		echo' selected="selected" ';
	}
	echo">One (1)</option>
	<option value='2'";
	if($Display_Results == 2 ){
		echo' selected="selected" ';
	}
	echo">Two (2)</option>
	<option value='3'";
	if($Display_Results == 3 ){
		echo' selected="selected" ';
	}
	echo">Three (3)</option>
	<option value='5'";
	if($Display_Results == 5 ){
		echo' selected="selected" ';
	}
	echo">Five (5)</option>
	<option value='10'";
	if($Display_Results == 10 ){
		echo' selected="selected" ';
	}
	echo">Ten (10)</option>";
	echo "</select>";
}

function aphs_FYN_Item_Name_text() {
	echo '<p>Whatever you use here will be the names of the entities that people can search for</p>';
}

function aphs_FYN_Item_Name_form() {
	//get option 'Google_Maps_API_Key' from database
	$options= get_option('aphs_FYN_options');
	$Item_Name=$options['Item_Name'];
	//echo the field
	echo "<input id='Item_Name' name='aphs_FYN_options[Item_Name]' type='text' value='{$options['Item_Name']}' />";
}

function aphs_FYN_searchresults_page_text() {
	echo '<p>Select the page you wish to use as your results page... all content on that page will be replaced with the search results</p>';
}

function aphs_FYN_searchresults_page_form() {
	$options= get_option('aphs_FYN_options');
	$searchresults_page_id=$options['searchresults_page_id'];
	//echo the field
	echo "<select name='aphs_FYN_options[searchresults_page_id]' > 
	<option value=''>".esc_attr( __( 'Select page' ) )."</option> ";
	$pages = get_pages(); 
	foreach ( $pages as $pagg ) {
		$option = '<option value="' . $pagg->ID . '"';
		if($searchresults_page_id == $pagg->ID ){
			$option .= ' selected="selected" ';
		}
		$option .='>';
		$option .= $pagg->post_title;
		$option .= '</option>';
		echo $option;
	}
	echo "</select>";
}

function aphs_FYN_country_text() {
	echo '<p>Select the country you will be using this plugin in</p>';
}

function aphs_FYN_country_form() {
	//get option 'Google_Maps_API_Key' from database
	$options= get_option('aphs_FYN_options');
	$countrycode_option=$options['countrycode'];
	//echo the field
	require_once('countrycodes.php');
	echo "<select name='aphs_FYN_options[countrycode]' > 
	<option value=''>".esc_attr( __( 'Select Country' ) )."</option> ";
	foreach ( $countrycodes_array as $countrycode=>$country ) {
		$option = '<option value="' . $countrycode . '"';
		if($countrycode_option == $countrycode ){
			$option .= ' selected="selected" ';
		}
		$option .='>';
		$option .= $country;
		$option .= '</option>';
		echo $option;
	}
	echo "</select>";
}


//validate screensize (numeric only) later to validate that theme is available
function aphs_FYN_validate_options($input){
	$valid=array();
	$valid['Google_Maps_API_Key']=$input['Google_Maps_API_Key'];
	$valid['searchresults_page_id']=$input['searchresults_page_id'];
	$valid['countrycode']=$input['countrycode'];
	$valid['Item_Name']=$input['Item_Name'];
	$valid['Distance_Units']=$input['Distance_Units'];
	$valid['Display_Results']=$input['Display_Results'];
	return $valid;
}
/**/
function aphs_FYN_options_page() {
?>
<div class="wrap">
<?php screen_icon(); ?><h2>"Find Your Nearest" Options</h2>
<form action="options.php" method="post">
<?php settings_fields('aphs_FYN_options'); ?>
<?php do_settings_sections('_settings'); ?>
<input name="Submit" type="submit" value="Save Changes" />
</form>
</div>
<?php
}
?>
