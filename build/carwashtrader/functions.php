<?php 

	//Hide posts from menu - use custom post types for intuitiveness
	function remove_menus(){
  
	  remove_menu_page( 'edit.php' );                   //Posts
	  remove_menu_page( 'upload.php' );                 //Media
	  remove_menu_page( 'edit-comments.php' );          //Comments
	  
	}
	add_action( 'admin_menu', 'remove_menus' );
	
	
	add_theme_support( 'post-thumbnails' );
	
	
	//Register custom post types
	add_action( 'init', 'create_post_type');
	function create_post_type() {
	  register_post_type( 'cwt_carwashes',
		array('labels' => array( 'name' => __( 'Carwashes' ), 'singular_name' => __( 'Carwash' )),
		  'public' => true, 'has_archive' => true, 'menu_position' => 5)
	  );
	  
	  register_post_type( 'cwt_suppliers',
		array('labels' => array( 'name' => __( 'Suppliers' ), 'singular_name' => __( 'Supplier' )),
		  'public' => true, 'has_archive' => true, 'menu_position' => 5)
	  );
	  
	  register_post_type( 'cwt_products',
		array('labels' => array( 'name' => __( 'Products' ), 'singular_name' => __( 'Product' )),
		  'public' => true, 'has_archive' => true, 'menu_position' => 5)
	  );
	  
	  register_post_type( 'cwt_jobs',
		array('labels' => array( 'name' => __( 'Jobs' ), 'singular_name' => __( 'Job' )),
		  'public' => true, 'has_archive' => true, 'menu_position' => 5)
	  );
	  
	  register_post_type( 'cwt_banners',
		array('labels' => array( 'name' => __( 'Banners' ), 'singular_name' => __( 'Banner' )),
		  'public' => true, 'has_archive' => true, 'menu_position' => 5)
	  );
	}
	
	
	// Custom Taxonomy Code
	add_action( 'init', 'build_taxonomies');
	function build_taxonomies() {
		register_taxonomy( 'cwt_carwash_types','cwt_carwashes',array('hierarchical'=>true,'label'=>'Car Wash Types','query_var'=>true,'rewrite'=>true));
		register_taxonomy( 'cwt_forsale_types','cwt_carwashes',array('hierarchical'=>true,'label'=>'For Sale Types','query_var'=>true,'rewrite'=>true));
		register_taxonomy( 'cwt_prodsupp_cats',array('cwt_products','cwt_suppliers'),array('hierarchical'=>true,'label'=>'Product/Supplier Categories','query_var'=>true,'rewrite'=>true));
		register_taxonomy( 'cwt_job_types','cwt_jobs',array('hierarchical'=>true,'label'=>'Job Types','query_var'=>true,'rewrite'=>true));
		register_taxonomy( 'cwt_banner_types','cwt_banners',array('hierarchical'=>true,'label'=>'Banner Types','query_var'=>true,'rewrite'=>true));
	}
	
	
?>