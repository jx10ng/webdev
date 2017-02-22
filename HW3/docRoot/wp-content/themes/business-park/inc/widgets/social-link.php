<?php
/**
 * Social Media Widget
 *
 * @package Theme Palace
 * @subpackage Business Park
 * @since Business Park 1.0.0
 */


/**
 * Social Media class.
 *
 * @since 1.0.0
 */
class Business_Park_Social_Link extends WP_Widget {
	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		$widget_ops = array(
			'classname'   => 'business_park_social_link',
			'description' => __( 'Enter the url only the icon will be displayed as per the links.', 'business-park' ),
		);
		parent::__construct( 'business_park_social_link', __( 'TP : Social Link','business-park' ), $widget_ops );
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		// outputs the content of the widget
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Stay Connected', 'business-park' );

		echo $args['before_widget'];
			if ( ! empty( $title ) ) {
				echo $args['before_title'] . esc_html( $title ) . $args['after_title'];
			}


		$number = isset( $instance['number'] ) ? absint( $instance['number'] ) : 3; ?>
		<div class="social-icons">
	   	<ul class="list-inline">
				<?php
				for ( $i=1; $i <= $number ; $i++ ) {
					if ( ! empty( $instance['link' . '-' . $i] ) ) : ?>
			        <li><a href="<?php echo esc_url( $instance['link' . '-' . $i] );?>" class="icon-animation icon-hover-effect"></a></li>
				<?php endif; ?>
				<?php } ?>
     		</ul>
     </div>
		<?php
		echo $args['after_widget'];
	}

	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	public function form( $instance ) {
		$title  = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : __( 'Stay Connected', 'business-park' );
		$number = isset( $instance['number'] ) ? absint( $instance['number'] ) : 3;
	   ?>

	   <p>
		   <label for="<?php echo esc_attr( $this->get_field_id('title') ); ?>"><?php _e( 'Title:', 'business-park' ); ?></label>
		   <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
	   </p>

	   <p>
	   	<label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php _e( 'Number of links to show:', 'business-park' ); ?></label>
	   	<input class="tiny-text" id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="number" step="1" min="1" value="<?php echo absint( $number ); ?>" size="3" />
	   </p>

	   <?php for ( $i=1; $i <= $number; $i++ ) {
	   	$link = isset( $instance['link'. '-' . $i ] ) ? $instance['link' . '-' . $i ] : '';?>
		   <p>
		   	<label for="<?php echo esc_attr( $this->get_field_id( 'link' . '-' . $i ) ); ?>"><?php printf( __( 'Link %s :', 'business-park' ), $i ); ?></label>
		   	<input type="url" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link' . '-' . $i ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link' . '-' . $i ) ); ?>" value="<?php echo esc_url( $link ); ?>"/>
		   </p>
	   <?php }?>

	   <?php
	}

	/**
	* Processing widget options on save
	*
	* @param array $new_instance The new options
	* @param array $old_instance The previous options
	*/
	public function update( $new_instance, $old_instance ) {
		// processes widget options to be saved
		$instance           = $old_instance;
		$instance['title']  = sanitize_text_field( $new_instance['title'] );
		$instance['number'] = (int) $new_instance['number'];
		for ( $i=1; $i <= $instance['number']; $i++ ) {
			$instance['link' . '-' . $i] = esc_url_raw( $new_instance['link' . '-' . $i] );
		}
		return $instance;
	}
}