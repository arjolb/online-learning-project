<?php

use ParagonIE\Sodium\Core\Curve25519\Ge\P1p1;

function theme_files(){
    wp_enqueue_script('jquery',get_theme_file_uri('//code.jquery.com/jquery-3.4.1.min.js'),NULL,'1.0',true);
    wp_enqueue_script('searchJs',get_theme_file_uri('./js/search.js'),NULL,'1.0',true);
    wp_enqueue_script('notesJs',get_theme_file_uri('./js/notes.js'),NULL,'1.0',true);
    wp_enqueue_script('likeJs',get_theme_file_uri('./js/like.js'),NULL,'1.0',true);
    wp_enqueue_script('ratingsJs',get_theme_file_uri('./js/ratings.js',NULL,'1.0',true));
    wp_enqueue_style('main_styles',get_stylesheet_uri());
    wp_enqueue_style('custom-google-fonts','//fonts.googleapis.com/css?family=Roboto&display=swap');
    wp_enqueue_style('font-awesome','//cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css');
    wp_localize_script('searchJs','universityData',array(
      'root_url' => get_site_url(),
      'nonce' => wp_create_nonce('wp_rest')
    ));
}

add_action('wp_enqueue_scripts','theme_files');


function theme_features(){
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_image_size('professorLandscape', 400, 280);
    add_image_size('lecture-thumbnail', 100, 100);
}

add_action('after_setup_theme','theme_features');


function university_adjust_queries($query) {
    // if (!is_admin() AND is_post_type_archive('program') AND $query->is_main_query()) {
    //   $query->set('orderby','title');
    //   $query->set('order','ASC');
    // }


    if (!is_admin() AND is_post_type_archive('lecture') AND $query->is_main_query()) {
      $today = date('Ymd');
      $query->set('meta_key', 'lecture_date');
      $query->set('orderby', 'meta_value_num');
      $query->set('order', 'ASC');
      $query->set('meta_query', array(
                array(
                  'key' => 'lecture_date',
                  'compare' => '<=',
                  'value' => $today,
                  'type' => 'numeric'
                )
              ));
    }
  }
  
  add_action('pre_get_posts', 'university_adjust_queries');




function change_category_order( $query ) {
    if ( $query->is_post_type_archive() && $query->is_main_query() ) {
        $query->set( 'order', 'ASC' );
    }
}
add_action('pre_get_posts', 'change_category_order');


function custom_api(){
  register_rest_field('post','authorName',array(
    'get_callback' => function (){ return get_the_author(); }
  ));

  register_rest_field('note','userNoteCount',array(
    'get_callback' => function (){ return count_user_posts(get_current_user_id(),'note'); }
  ));
}


add_action('rest_api_init','custom_api');



require get_theme_file_path('/includes/search-route.php');
require get_theme_file_path('/includes/like-route.php');

//Redirect subscriber accounts into homepage
function redirectSubscribersToFrontEnd(){
  $currentUser = wp_get_current_user();
  if (count($currentUser->roles) ==1 && $currentUser->roles[0]=='subscriber') {
    wp_redirect(site_url('/'));
    exit;
  }
}

add_action('admin_init','redirectSubscribersToFrontEnd');


//Hide admin bar on subscribers
add_action('wp_loaded', 'noSubsAdminBar');

function noSubsAdminBar() {
  $ourCurrentUser = wp_get_current_user();

  if (count($ourCurrentUser->roles) == 1 AND $ourCurrentUser->roles[0] == 'subscriber') {
    show_admin_bar(false);
  }
}

//Customize Login Screen
add_filter('login_headerurl', 'headerUrl');

function headerUrl(){
  return esc_url(site_url('/'));
}

add_action('login_enqueue_scripts', 'loginCss');

function loginCss(){
  wp_enqueue_style('main_styles',get_stylesheet_uri());
}

add_filter('login_headertitle', 'loginTitle');

function loginTitle(){
  // return get_bloginfo('name');
  return 'Online Learning';
}

//* Redirect WordPress to Homepage Upon Logout
add_action('wp_logout','redirectAfterLogout');

function redirectAfterLogout(){
  wp_redirect(site_url('/'));
  exit;
}

//Note to be private
add_filter('wp_insert_post_data', 'privateNote',10,2);

function privateNote($data,$post){
  if ($data['post_type'] == 'note') {

    if(count_user_posts(get_current_user_id(), 'note') > 4 AND !$post['ID']) {
      die("You have reached your note limit.");
    }


    $data['post_title'] = sanitize_text_field($data['post_title']);
    $data['post_content'] = sanitize_textarea_field($data['post_content']);
  }

  if ($data['post_type'] == 'note' AND $data['post_status']!='trash') {
    $data['post_status']='private';
  }
  return $data;
}