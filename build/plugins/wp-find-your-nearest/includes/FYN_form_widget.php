<?php
add_action( 'widgets_init', 'register_widget_WP_Find_Your_Nearest');

function register_widget_WP_Find_Your_Nearest(){
	register_widget('WP_Find_Your_Nearest_Form');
}

class WP_Find_Your_Nearest_Form extends WP_Widget {
	function WP_Find_Your_Nearest_Form(){
		$widget_ops = array(
			'classname' => 'WP_Find_Your_Nearest_Form',
			'description'=> 'Find Your Nearest Search Form'
			);
		$this->WP_Widget( 'WP_Find_Your_Nearest_Form', 'FYN - Search Form', $widget_ops);
	}
	
     //build the widget settings form
    function form($instance) {
        $defaults = array( 'title' => 'Find Your Nearest', 'description' => "Enter your postcode to 'find your nearest'"  ); 
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
		$options= get_option('aphs_FYN_options');
		$searchresults_page=get_page_link( $options['searchresults_page_id'] );
        echo "<form id=\"form1\" name=\"form1\" method=\"post\" action=\"$searchresults_page\">
		<label>
		<input name=\"fyn_postalcode\" type=\"text\" class=\"formfield\" id=\"fyn_postalcode_field\" value=\"Enter Postal Code\"  onfocus=\"this.value=''\" />
		</label>
		<input name=\"send\" type=\"submit\" class=\"button\" id=\"send\" value=\"Find\" />
		</form>";
        echo $after_widget;
    }
}
?>
