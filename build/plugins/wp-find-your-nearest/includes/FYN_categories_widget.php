<?php
/*
add_action( 'widgets_init', 'register_widget_WP_Find_Your_Nearest_Form_categories');

function register_widget_WP_Find_Your_Nearest_Form_categories(){
	register_widget('WP_Find_Your_Nearest_Form_categories');
}

class WP_Find_Your_Nearest_Form_categories extends WP_Widget {
	
	function WP_Find_Your_Nearest_Form_Categories(){
		$widget_ops = array(
			'classname' => 'WP_Find_Your_Nearest_Form_Categories',
			'description'=> 'Find Your Nearest Categories'
			);
		$this->WP_Widget( 'WP_Find_Your_Nearest_Form_Categories', 'FYN - Regional Categories', $widget_ops);
	}
	
 
     //build the widget settings form
    function form($instance) {
        $defaults = array( 'title' => 'Categories', 'description' => ""  ); 
        $instance = wp_parse_args( (array) $instance, $defaults );
        $title = $instance['title'];
        $description = $instance['description'];

        ?>
            <p>Title: <input class="widefat" name="<?php echo $this->get_field_name( 'title' ); ?>"  type="text" value="<?php echo esc_attr( $title ); ?>" /></p>
			<p>Descriptive Text:<br />
			<textarea class="widefat" name="<?php echo $this->get_field_name( 'description' ); ?>" ><?php echo esc_attr( $description ); ?></textarea></p>
		<?php
    }
 
    //save the widget settings
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags( $new_instance['title'] );
		$instance['description'] = strip_tags( $new_instance['description'] );
        return $instance;
    }
	
    //display the widget
    function widget($args, $instance) {
        extract($args);
        echo $before_widget;
        $title = apply_filters( 'widget_title', $instance['title'] );
        $description = $instance['description'] ;
        if ( !empty( $title ) ) { echo $before_title . $title . $after_title; };
        if ( !empty( $description ) ) { echo "<p>$description</p>"; };
		$this->hierarchical_category_tree(); // the function call; 0 for all categories; or cat ID  
        echo $after_widget;
    }
    
	function hierarchical_category_tree() {
		//first pass
		$args = array(
				'parent'                   => 0,
				'orderby'                  => 'name',
				'order'                    => 'ASC',
				'hide_empty'               => 0,
				'taxonomy'                 => 'regional_category');
		$top = get_categories($args);
		if( $top ) {
			echo "\n<ul class='FYN_regional_categories'>\n";
			foreach( $top as $cat ) {
				$category_link = get_term_link( $cat, 'regional_category' );
				echo "<li class='topcat'><a href='$category_link' class='topcatlink'> $cat->name ($cat->count)</a>\n";
				//now get second level
				$args = array(
					'parent'                   => $cat->term_id,
					'orderby'                  => 'name',
					'order'                    => 'ASC',
					'hide_empty'               => 0,
					'taxonomy'                 => 'regional_category');
				$sub = get_categories($args);
				if( $sub ) {
					echo "\t<ul>\n";
					foreach( $sub as $subcat ){
						//$category_link = get_category_link( $subcat->term_id );
						echo "\t\t<li class='subcat'>\n";
						$category_link = get_term_link( $subcat, 'regional_category' );
						echo "\t\t\t<a href='$category_link' class='subcatlink'> $subcat->name ($subcat->count)</a>\n";
						echo "\t\t</li>\n";
					}
					echo "\t</ul>\n";
				}
				echo "</li>\n";
			}
			echo '</ul>'; echo "\n";
		}
	}  
}
* */
?>
