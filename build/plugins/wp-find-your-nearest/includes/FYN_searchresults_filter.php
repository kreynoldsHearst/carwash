<?php
//replace the select search results page content with the code we need to display the search results
add_filter ( 'the_content', 'aphs_pcf_replacewith_search_results');

function aphs_pcf_replacewith_search_results($content){
	$options= get_option('aphs_FYN_options');
	$searchresults_page_id=$options['searchresults_page_id'];
	if(is_page($searchresults_page_id)){
		if(isset($_POST['fyn_postalcode'])){
			return '
			<div id="FYN-viewmap-dialog" title="Map">
			<div id="FYN_map" style="width:540px; height:518px;"></div>
			</div>
			<div id="search_results">
			<img src="'.WP_APHS_FYN_PLUGIN_URL.'/images/loading.gif'.'"/>
			<input type="hidden" id="fyn_postalcode" name="fyn_postalcode" value="'.$_POST['fyn_postalcode'].'" />
			</div>';
		}
		else{
			return $content;
		}	
		
	}
	else{
		return $content;
	}
}
?>
