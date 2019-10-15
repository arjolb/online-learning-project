<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset') ?>">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>


<header class="site-header">
    <div class="wrapper">
        <ul class="site-header__links">
            <li><a href="<?php echo site_url() ?>">Home</a></li>
            <li><a href="<?php echo site_url('about') ?>">About</a></li>
            <li><a href="<?php echo site_url('contact-us') ?>">Contact Us</a></li>
        </ul>
    </div>
</header>

<nav class="site-navigation">
    <div class="wrapper">
        <img src="<?php echo get_theme_file_uri('./img/logo.jpg') ?>" alt="Logo">
        <ul class="site-navigation__links generic-content__border">
            <li <?php if (get_post_type()=='program' || get_post_type()=='subject') echo 'class="current-menu-item"' ?> class="generic-content__border-right"><a href="<?php echo get_post_type_archive_link('program'); ?>">Programs</a></li>
            <li <?php if (get_post_type()=='lecture') echo 'class="current-menu-item"' ?> class="generic-content__border-right"><a href="<?php echo get_post_type_archive_link('lecture') ?>">Lectures</a></li>
            <!-- <li class="generic-content__border-right"><a href="#">test 3</a></li> -->
            <!-- <li class="generic-content__border-right"><a href="#">test 4</a></li> -->
<!--              -->
            <!-- <li><a href="<?php echo esc_url(site_url('/search')); ?>" class="site-navigation__search-icon"><i class="fa fa-search"></i></a></li> -->
        <!-- </ul>
        <ul class="site-navigation__search-registration"> -->
            <li class="site-navigation__search-icon"><i class="fa fa-search"></i></li>
            <?php if (is_user_logged_in()) {?>
                <li class="site-navigation__signup generic-content__border-right"><a href="<?php echo esc_url(site_url('/my-notes')) ?>">My Notes</a></li>
                <li class="site-navigation__signup generic-content__border-right"><a href="<?php echo wp_logout_url(); ?>">Logout</a></li>
                <li class="site-navigation__signup generic-content__border-right"><?php echo get_avatar(get_current_user_id(), 60); ?></li>
            <?php }else{?>
                <li class="site-navigation__signup generic-content__border-right"><a href="<?php echo wp_registration_url(); ?>">Sign Up</a></li>
                <li class="site-navigation__login generic-content__border-right"><a href="<?php echo wp_login_url(); ?>">Login</a></li>
            <?php }?>            
        </ul>
    </div>
</nav>
