<?php
/* Set up the Postcoded Entity Post type */
add_action( 'init', 'aphs_register_FYN_post_types' );
/* Registers Postcoded Entity Post types */
function aphs_register_FYN_post_types(){
	$options= get_option('aphs_FYN_options');
	$Item_Name=$options['Item_Name'];
	if(!$Item_Name){
		$Item_Name="FYN Item";
		$slug="find-your-nearest";
	}
	else{
		$slug=str_replace(' ','-',strtolower($Item_Name));
	}

	$FYN_args = array(
        'public' => true,
        'show_in_nav_menus' => false,
        'query_var' => 'find_your_nearest',
        'rewrite' => array(
            'slug' => $slug.'/%regional_category%',
            'with_front' => false
        ),
        'has_archive'=> true,
        'supports' => array(
            'title',
            'editor',
            'thumbnail'
        ),
        'register_meta_box_cb' => 'aphs_FYN_meta_box',
        'labels' => array(
            'name' => "Find Your Nearest",
            'all_items'=> "All ".$Item_Name."s",
            'singular_name' => $Item_Name,
            'add_new' => 'Add New '.$Item_Name,
            'add_new_item' => 'Add New '.$Item_Name,
            'edit_item' => 'Edit '.$Item_Name,
            'new_item' => 'New '.$Item_Name,
            'view_item' => 'View '.$Item_Name,
            'search_items' => 'Search '.$Item_Name.'s',
            'not_found' => 'No '.$Item_Name.' Found',
            'not_found_in_trash' => 'No '.$Item_Name.'s Found In Trash'
        ),
    );

    /* Register the FYN post type. */
    register_post_type( 'find_your_nearest', $FYN_args );
}

/*Set up Regional taxonomy */
add_action('init', 'aphs_register_FYN_regional_categories');
function aphs_register_FYN_regional_categories(){
	$options= get_option('aphs_FYN_options');
	$Item_Name=$options['Item_Name'];
	if(!$Item_Name){
		$Item_Name="FYN Item";
		$slug="regional_categories";
	}
	else{
		$slug=str_replace(' ','-',strtolower($Item_Name));
	}
	$regional_category_args = array(
		'hierarchical'=>true,
		'query_var'=>'regional_category',
		'show_tagcloud'=>false,
		'rewrite' => array (
			'slug'=>$slug,
			'with_front'=>false
		),
		'labels'=>array(
			'name'=>'Regional Category',
			'singular_name' => 'Regional Category',
            'edit_item' => 'Edit Regional Category',
            'update_item' => 'Update Regional Category',
            'add_new_item' => 'Add New Regional Category',
            'new_item_name' => 'New Regional Category Name',
            'all_items' => 'All Regional Categories',
            'search_items' => 'Search Regional Categories',
            'popular_items' => 'Popular Regional Categories',
            'separate_items_with_commas' => 'Separate Regional Categories with commas',
            'add_or_remove_items' => 'Add or remove Regional Categories',
            'choose_from_most_used' => 'Choose from the most popular Regional Categories',
        ),
    );
    
    /* Register the product_category taxonomy. */
    register_taxonomy( 'regional_category', array( 'find_your_nearest' ), $regional_category_args );
    
	function regional_category_link_filter_function( $post_link, $id = 0, $leavename = FALSE ) {
		$options= get_option('aphs_FYN_options');
		$Item_Name=$options['Item_Name'];
		if(!$Item_Name){
			$Item_Name="FYN Item";
			$slug="regional_categories";
		}
		else{
			$slug=str_replace(' ','-',strtolower($Item_Name));
		}
		if ( strpos('%regional_category%', $post_link) === 'FALSE' ) {
			return $post_link;
		}
		$post = get_post($id);
		if ( !is_object($post) || $post->post_type != 'find_your_nearest' ) {
			return $post_link;
		}
		$terms = wp_get_object_terms($post->ID, 'regional_category');
		if ( !$terms ) {
			return str_replace($slug.'/%regional_category%/', '', $post_link);
		}
		return str_replace('%regional_category%', $terms[0]->slug, $post_link);
	}
	add_filter('post_type_link', 'regional_category_link_filter_function', 1, 3);
}
?>
