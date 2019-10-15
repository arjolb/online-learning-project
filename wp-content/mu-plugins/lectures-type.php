<?php

function lectures_post_types(){
    register_post_type('lecture',array(
        'capability_type' => 'lecture',
        'map_meta_cap'=> true,
        'supports' => array('title','editor','excerpt','thumbnail'),
        'public' => true,
        'rewrite' => array('slug' => 'lectures'),
        'menu_icon' => 'dashicons-book',
        'has_archive' => true,
        'labels' => array(
            'name' => 'Lectures',
            'add_new_item' => 'Add New Lecture',
            'edit_item' => 'Edit Lecture',
            'all_items' => 'All Lectures',
            'singular_name' => 'Lecture'
        )
        // 'taxonomies' => array('category')
    ));

//Chapter post type
register_post_type('chapter',array(
    'supports' => array('title','editor'),
    'public' => true,
    'rewrite' => array('slug' => 'chapters'),
    'menu_icon' => 'dashicons-welcome-write-blog',
    'has_archive' => true,
    'labels' => array(
        'name' => 'Chapters',
        'add_new_item' => 'Add New Chapter',
        'edit_item' => 'Edit Chapter',
        'all_items' => 'All Chapters',
        'singular_name' => 'Chapter'
    )
    // 'taxonomies' => array('category')
));    
    
//Program post type
register_post_type('program',array(
    'supports' => array('title','editor','thumbnail'),
    'public' => true,
    'rewrite' => array('slug' => 'programs'),
    'menu_icon' => 'dashicons-welcome-learn-more',
    'has_archive' => true,
    'labels' => array(
        'name' => 'Programs',
        'add_new_item' => 'Add New Program',
        'edit_item' => 'Edit Program',
        'all_items' => 'All Programs',
        'singular_name' => 'Program'
    )
));

//Subjects post type
register_post_type('subject',array(
    'supports' => array('title','editor','thumbnail'),
    'public' => true,
    'rewrite' => array('slug' => 'subjects'),
    'menu_icon' => 'dashicons-format-aside',
    // 'has_archive' => true,
    'labels' => array(
        'name' => 'Subjects',
        'add_new_item' => 'Add New Subject',
        'edit_item' => 'Edit Subject',
        'all_items' => 'All Subjects',
        'singular_name' => 'Subject'
    )
));

//Professor post type
register_post_type('professor',array(
    'supports' => array('title','editor','thumbnail'),
    'public' => true,
    'rewrite' => array('slug' => 'professors'),
    'menu_icon' => 'dashicons-groups',
    // 'has_archive' => true,
    'labels' => array(
        'name' => 'Professors',
        'add_new_item' => 'Add New Professor',
        'edit_item' => 'Edit Professor',
        'all_items' => 'All Professors',
        'singular_name' => 'Professor'
    )
));

//Note post type
register_post_type('note', array(
    'capability_type' => 'note',
    'map_meta_cap' => true,
    'show_in_rest' => true,
    'supports' => array('title', 'editor'),
    'public' => false,
    'show_ui' => true,
    'labels' => array(
      'name' => 'Notes',
      'add_new_item' => 'Add New Note',
      'edit_item' => 'Edit Note',
      'all_items' => 'All Notes',
      'singular_name' => 'Note'
    ),
    'menu_icon' => 'dashicons-welcome-write-blog'
));

//Note post type
register_post_type('like', array(
    // 'capability_type' => 'note',
    // 'map_meta_cap' => true,
    // 'show_in_rest' => true,
    'supports' => array('title'),
    'public' => false,
    'show_ui' => true,
    'labels' => array(
      'name' => 'Likes',
      'add_new_item' => 'Add New Like',
      'edit_item' => 'Edit Like',
      'all_items' => 'All Likes',
      'singular_name' => 'Like'
    ),
    'menu_icon' => 'dashicons-heart'
));

}

add_action('init','lectures_post_types');