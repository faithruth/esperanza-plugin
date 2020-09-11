<?php

namespace Esperanza\Admin;

class Custom_Post_Type 
{
public function register_custom_post_type() {
 
        $labels = array(
            'name'                => _x( 'Campaigns', 'Post Type General Name', 'eperanza-custom-post-type' ),
            'singular_name'       => _x( 'Campaign', 'Post Type Singular Name', 'eperanza-custom-post-type' ),
            'menu_name'           => __( 'Esperanza Campaigns', 'eperanza-custom-post-type' ),
            'parent_item_colon'   => __( 'Parent Campaign', 'eperanza-custom-post-type' ),
            'all_items'           => __( 'All Campaigns', 'eperanza-custom-post-type' ),
            'view_item'           => __( 'View Campaign', 'eperanza-custom-post-type' ),
            'add_new_item'        => __( 'Add New Campaign', 'eperanza-custom-post-type' ),
            'add_new'             => __( 'Add New', 'eperanza-custom-post-type' ),
            'edit_item'           => __( 'Edit Campaign', 'eperanza-custom-post-type' ),
            'update_item'         => __( 'Update Campaign', 'eperanza-custom-post-type' ),
            'search_items'        => __( 'Search Campaign', 'eperanza-custom-post-type' ),
            'not_found'           => __( 'Not Found', 'eperanza-custom-post-type' ),
            'not_found_in_trash'  => __( 'Not found in Trash', 'eperanza-custom-post-type' ),
        );
         
        $args = array(
            'label'               => __( 'campaigns', 'eperanza-custom-post-type' ),
            'description'         => __( 'Esperanza donation campaigns', 'eperanza-custom-post-type' ),
            'labels'              => $labels,
            'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
            'hierarchical'        => false,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_nav_menus'   => true,
            'show_in_admin_bar'   => true,
            'query_var'          => true,
            'menu_position'       => 6,
            'rewrite'            => array( 'slug' => 'donation' ),
            'can_export'          => true,
            'has_archive'         => true,
            'exclude_from_search' => false,
            'publicly_queryable'  => true,
            'capability_type'     => 'post',
            'show_in_rest' => true,
     
        );
        register_post_type( 'campaigns', $args );
     
    }
      
}