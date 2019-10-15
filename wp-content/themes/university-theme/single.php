<?php get_header(); ?>

    <div class="wrapper">
        <div class="row row-gutters">
            <div class="col-md-8">
                <div class="generic-content__border">
                    <div class="single">
                        <div class="single__title">
                            <?php
                                while (have_posts()) {
                                    the_post();?>
                                <h1><?php the_title(); ?></h1>
                                <h3><?php the_author_posts_link(); ?> | <span><?php the_time('F j, Y'); ?></span></h3>
                        </div>
                        <p class="single__content"><?php the_content(); ?></p>
                            <?php    }
                            ?>
                        
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <?php get_sidebar(); ?>
            </div>
        </div>
    </div>

<?php get_footer(); ?>