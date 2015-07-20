<?php
add_action( 'wp_dashboard_setup', 'aphs_FYN_dashboard_widget' );

function aphs_FYN_dashboard_widget() {

	//create a custom dashboard widget
	wp_add_dashboard_widget( 'dashboard_custom_feed', 'WP Find Your Nearest Premium', 'aphs_FYN_dashboard_display' );
	
}

function aphs_FYN_dashboard_display()
{
    echo '<p><a href="http://www.sargant.net/projects/wordpress-plug-ins/wp-find-your-nearest-premium/" target="_blank">WP Find Your Nearest Premium</a> is now available. WP Find Your Nearest Premium extends the functionality of the standard version by adding 
	<ul>
	<li>- the ability to use a hierarchical taxonomy (category, which can also be included in the url of entry pages for improved SEO), with a widget menu of category entries (ideal for sorting entries by region and subregion for example)</li>
	<li>- the ability to apply non-hierarchical taxonomy (tags) and to restrict search to specific tags- suitable for differentiating between entry types (e.g if you were running a "Find Your Nearest Leisure Facility site, you could distinguish between libraries, swimming pools, cinemas)</li>
	<li>- the ability to limit search by radius/distance from</li>
	<li>- shortcode functionality to insert search form into post or page rather than only a widget</li>
	<li>- the ability to add explanatory text to the top of the search results page</li>
	<li>- the ability to use shortcodes within returned search results</li>
	<li><strong>- support and lifetime upgrades, all for a <a href="http://www.sargant.net/projects/wordpress-plug-ins/wp-find-your-nearest-premium/" target="_blank">one off &pound;15 sterling</a></strong></li>
</ul></p>';	
}
?>