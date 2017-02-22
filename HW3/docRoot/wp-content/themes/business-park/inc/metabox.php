<?php
/**
 * Adds a meta box to the post editing screen
 */
function business_park_custom_meta() {
	$post_types = array( 'post', 'page', 'jetpack-testimonial' );
    add_meta_box( 'business_park_meta', __( 'Sidebar Layout', 'business-park' ), 'business_park_sidebar_position_callback', $post_types );
}
add_action( 'add_meta_boxes', 'business_park_custom_meta' );


/**
 * Outputs the content of the sidebar position
 */
function business_park_sidebar_position_callback( $post ) {
	wp_nonce_field( basename( __FILE__ ), 'business_park_nonce' );
	$stored_sidebar_position = get_post_meta( $post->ID, 'business-park-sidebar-position', true );

	$sidebar_positions       = business_park_sidebar_position();
	 ?>

	<p>
     <label for="business-park-sidebar-position" class="business-park-row-title"><?php _e( 'Sidebar Position', 'business-park' )?></label>
     <select name="business-park-sidebar-position" id="business-park-sidebar-position">
      <option value=""><?php _e( 'Default ( to customizer option )', 'business-park' ); ?></option>

     	<?php foreach ( $sidebar_positions as $sidebar_position => $value ) { ?>
         <option value="<?php echo esc_attr( $sidebar_position );?>" <?php if ( isset ( $stored_sidebar_position ) ) selected( $stored_sidebar_position, $sidebar_position ); ?>><?php echo esc_html( $value ); ?></option>
     	<?php } ?>
     </select>
	</p>
	<?php
}


/**
 * Saves the sidebar position input
 */
function business_park_meta_save( $post_id ) {

    // Checks save status
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'business_park_nonce' ] ) && wp_verify_nonce( $_POST[ 'business_park_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';

    // Exits script depending on save status
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }

    // Checks for input and sanitizes/saves if needed
    if( isset( $_POST[ 'business-park-sidebar-position' ] ) ) {
        update_post_meta( $post_id, 'business-park-sidebar-position', sanitize_text_field( $_POST[ 'business-park-sidebar-position' ] ) );
    }
}
add_action( 'save_post', 'business_park_meta_save' );