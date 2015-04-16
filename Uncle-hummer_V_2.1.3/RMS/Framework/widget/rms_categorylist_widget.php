<?php
/**
 * Creates widget with Category List
 */

class rms_category_list extends WP_Widget
{
    function __construct() 
    {
        $widget_opt = array(
            'classname'     => 'rms_widget',
            'description'   => 'RMS Category List'
        );
        
        $this->WP_Widget('rms-widget3', __('RMS Category List', 'rms'), $widget_opt);
    }
    
    function widget( $args, $instance )
    {
        global $wp_query;
        
        $title = apply_filters( 'widget_title', $instance['title'] );
        echo $args['before_widget'];
        if ( ! empty( $title ) )
        {
            echo $args['before_title'] . $title . $args['after_title'];
        }
        
        if(!empty($instance['post_count']))
        {
            $ppp = $instance['post_count'];
        }
        else
        {
            $ppp = 0;
        }
        
        if(!empty($instance['show_empty']))
        {
            $se = $instance['show_empty'];
        }
        else
        {
            $se = 0;
        }
        
        $argu = array(
            'orderby'            => 'name',
            'order'              => 'ASC',
            'hide_empty'         => $se,
            'taxonomy'           => 'category',
            'show_count'         => $ppp,
            'depth'              => 1,
            'title_li'           => ''
        );
        echo '<ul class="rms_cat_list">';
        echo wp_list_categories($argu);
        echo '</ul>';
       
        echo $args['after_widget'];
    }
    
    
    function update ( $new_instance, $old_instance ) 
    {
        $old_instance['title'] = strip_tags( $new_instance['title'] );
        $old_instance['post_count'] = $new_instance['post_count'];
        $old_instance['show_empty'] = $new_instance['show_empty'];

        return $old_instance;
    }
    
    function form($instance)
    {
        if(isset($instance['title']))
        {
            $title = $instance['title'];
        }
        else
        {
            $title = __( 'New title', 'wpb_widget_domain' );
        }
        if(isset($instance['post_count']))
        {
            $pc = $instance['post_count'];
        }
        else
        {
            $pc = 0;
        }
        if(isset($instance['show_empty']))
        {
            $es = $instance['show_empty'];
        }
        else
        {
            $es = 0;
        }
        ?>
        <p>
	<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'rms' ); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
	</p>
        <p>
	<label for="<?php echo $this->get_field_id( 'post_count' ); ?>"><?php _e( 'Show Post Count:', 'rms' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'post_count' ); ?>" name="<?php echo $this->get_field_name( 'post_count' ); ?>" type="checkbox" value="1" <?php if($pc == 1) echo 'Checked'; ?> />
	</p>
        <p>
	<label for="<?php echo $this->get_field_id( 'show_empty' ); ?>"><?php _e( 'Hide Empty:', 'rms' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'show_empty' ); ?>" name="<?php echo $this->get_field_name( 'show_empty' ); ?>" type="checkbox" value="1" <?php if($es == 1) echo 'Checked'; ?> />
	</p>
        <?php
    }
}
register_widget( 'rms_category_list' );