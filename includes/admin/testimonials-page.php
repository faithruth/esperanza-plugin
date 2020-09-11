<?php

namespace Esperanza\Admin;

class Testimonials_Page {

    public function  testimonials_post_type() {
        register_post_type('testimonials',
            array(
                'labels' => array(
                        'name' => __( 'Testimonials' ),
                        'singular_name' => __( 'Testimonial' )
                ),
                'public' => true,
                'has_archive' => true,
                'supports'            => array( 'title', 'editor', 'thumbnail', 'revisions' ),
                'show_in_menu' => 'edit.php?post_type=campaigns',
                'query_var'          => true,
                'can_export'          => true,
                'exclude_from_search' => false,
                'publicly_queryable'  => true
            )
        );
    }
    
    public function testimonial_menu() { 
       add_submenu_page('edit.php?post_type=campaigns', 'Testimonials', 'Testimonials', 'manage_options', 'edit.php?post_type=testimonials'); 
    }
    public function add_meta_box( $post_type ) {
        add_meta_box(
            'position_meta',
            __( 'Position', 'eperanza-custom-post-typ' ),
            array( $this, 'render_position' ),
            'testimonials',
            'advanced',
            'high'
        );
    }
        /**
     * Save the position meta field.
     *
     * @param int $post_id The ID of the post being saved.
     */
    public function save_position( $post_id ) {
        // Check if our nonce is set.
        if ( ! isset( $_POST['esperanza_position_field_nonce'] ) ) {
            return $post_id;
        }
 
        $nonce = $_POST['esperanza_position_field_nonce'];
 
        // Verify that the nonce is valid.
        if ( ! wp_verify_nonce( $nonce, 'esperanza_position_field' ) ) {
            return $post_id;
        }
 
        /*
         * If this is an autosave, our form has not been submitted,
         * so we don't want to do anything.
         */
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return $post_id;
        }
 
        if ( ! current_user_can( 'edit_page', $post_id ) ) {
                return $post_id;
        }
 
        // Sanitize the user input.
        $mydata = sanitize_text_field( $_POST['esperanza_position'] );
 
        // Update the meta field.
        update_post_meta( $post_id, '_esperanza_position_field_key', $mydata );
    }
 
 
    /**
     * Render Meta Box content.
     *
     * @param WP_Post $post The post object.
     */
    public function render_position( $post ) {
 
        // Add an nonce field so we can check for it later.
        wp_nonce_field( 'esperanza_position_field', 'esperanza_position_field_nonce' );
 
        // Use get_post_meta to retrieve an existing value from the database.
        $value = get_post_meta( $post->ID, '_esperanza_position_field_key', true );
 
        // Display the form, using the current value.
        ?>
        <label for="esperanza_position">
            <?php _e( 'Enter positioned amount', 'eperanza-custom-post-typ' ); ?>
        </label>
        <input type="text" id="esperanza_position" name="esperanza_position" value="<?php echo esc_attr( $value ); ?>"/>
        <?php
    }
} 
