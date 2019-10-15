<?php get_header(); ?>


    <div class="wrapper">
        <div class="row">
            <div class="row-gutters">
                <div class="col-md-8">
                    <div class="generic-content__border">
                        <div class="hero">
                        <?php
                            wp_reset_query();
                            while (have_posts()) {?>
                            <h1 class="hero__title">
                               <?php  the_title(); ?>
                            </h1>
                               <?php the_post(); ?>
                               <p class="hero__page-content">
                                 <?php the_content(); ?>
                               </p>
                              <?php }?>
                            
                        </div>
                    </div>
                </div>
                <div class="col-md-4"><?php get_sidebar(); ?></div>
            </div>
        </div>
    </div>


<?php get_footer(); ?>