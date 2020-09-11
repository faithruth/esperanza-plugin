<?php

namespace Esperanza\Admin;

class Custom_Meta_Box {
    /**
     * Adds the meta box container.
     */
    public function add_meta_box( $post_type ) {
            add_meta_box(
                'target_meta',
                __( 'Target Amount', 'eperanza-custom-post-typ' ),
                array( $this, 'render_target' ),
                'campaigns',
                'advanced',
                'high'
            );
            add_meta_box(
                'raised_meta',
                __( 'Raised Amount', 'eperanza-custom-post-typ' ),
                array( $this, 'render_raised' ),
                'campaigns',
                'advanced',
                'high'
            );
            add_meta_box(
                'donations_link',
                __( 'Donations Link', 'eperanza-custom-post-typ' ),
                array( $this, 'render_link' ),
                'campaigns',
                'advanced',
                'high'
            );
    }
 
    /**
     * Save the target meta field.
     *
     * @param int $post_id The ID of the post being saved.
     */
    public function save_target( $post_id ) {
        // Check if our nonce is set.
        if ( ! isset( $_POST['esperanza_target_field_nonce'] ) ) {
            return $post_id;
        }
 
        $nonce = $_POST['esperanza_target_field_nonce'];
 
        // Verify that the nonce is valid.
        if ( ! wp_verify_nonce( $nonce, 'esperanza_target_field' ) ) {
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
        $mydata = sanitize_text_field( $_POST['esperanza_target'] );
 
        // Update the meta field.
        update_post_meta( $post_id, '_esperanza_target_field_key', $mydata );
    }
 
 
    /**
     * Render Meta Box content.
     *
     * @param WP_Post $post The post object.
     */
    public function render_target( $post ) {
 
        // Add an nonce field so we can check for it later.
        wp_nonce_field( 'esperanza_target_field', 'esperanza_target_field_nonce' );
 
        // Use get_post_meta to retrieve an existing value from the database.
        $value = get_post_meta( $post->ID, '_esperanza_target_field_key', true );
 
        // Display the form, using the current value.
        ?>
        <label for="esperanza_target">
            <?php _e( 'Enter targeted amount', 'eperanza-custom-post-typ' ); ?>
        </label>
        <input type="number" id="esperanza_target" min="0" name="esperanza_target" value="<?php echo esc_attr( $value ); ?>"/>
        <?php
    }

    /**
     * Save the raised meta field.
     *
     * @param int $post_id The ID of the post being saved.
     */
    public function save_raised( $post_id ) {
        // Check if our nonce is set.
        if ( ! isset( $_POST['esperanza_raised_field_nonce'] ) ) {
            return $post_id;
        }
 
        $nonce = $_POST['esperanza_raised_field_nonce'];
 
        // Verify that the nonce is valid.
        if ( ! wp_verify_nonce( $nonce, 'esperanza_raised_field' ) ) {
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
        $mydata = sanitize_text_field( $_POST['esperanza_raised'] );
 
        // Update the meta field.
        update_post_meta( $post_id, '_esperanza_raised_field_key', $mydata );
    }
 
 
    /**
     * Render Meta Box content.
     *
     * @param WP_Post $post The post object.
     */
    public function render_raised( $post ) {
 
        // Add an nonce field so we can check for it later.
        wp_nonce_field( 'esperanza_raised_field', 'esperanza_raised_field_nonce' );
 
        // Use get_post_meta to retrieve an existing value from the database.
        $value = get_post_meta( $post->ID, '_esperanza_raised_field_key', true );
 
        // Display the form, using the current value.
        ?>
        <label for="esperanza_raised">
            <?php _e( 'Enter raised amount', 'eperanza-custom-post-typ' ); ?>
        </label>
        <input type="number" id="esperanza_raised" min="0" name="esperanza_raised" value="<?php echo esc_attr( $value ); ?>"/>
        <?php
    }

    /**
     * Save the donation link.
     *
     * @param int $post_id The ID of the post being saved.
     */
    public function save_link( $post_id ) {
        // Check if our nonce is set.
        if ( ! isset( $_POST['esperanza_link_field_nonce'] ) ) {
            return $post_id;
        }
 
        $nonce = $_POST['esperanza_link_field_nonce'];
 
        // Verify that the nonce is valid.
        if ( ! wp_verify_nonce( $nonce, 'esperanza_link_field' ) ) {
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
        $mydata = sanitize_text_field( $_POST['esperanza_link'] );
 
        // Update the meta field.
        update_post_meta( $post_id, '_esperanza_link_field_key', $mydata );
    }
 
 
    /**
     * Render Meta Box content.
     *
     * @param WP_Post $post The post object.
     */
    public function render_link( $post ) {
 
        // Add an nonce field so we can check for it later.
        wp_nonce_field( 'esperanza_link_field', 'esperanza_link_field_nonce' );
 
        // Use get_post_meta to retrieve an existing value from the database.
        $value = get_post_meta( $post->ID, '_esperanza_link_field_key', true );
 
        // Display the form, using the current value.
        ?>
        <label for="esperanza_link">
            <?php _e( 'Enter donation link', 'eperanza-custom-post-typ' ); ?>
        </label>
        <input type="text" id="esperanza_link" name="esperanza_link" value="<?php echo esc_attr( $value ); ?>"/>
        <?php
    }
}