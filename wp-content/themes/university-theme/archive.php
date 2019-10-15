<?php
 get_header();
?>


    <div class="wrapper">
        <div class="row row-gutters">
            <div class="col-md-8">
                <div class="generic-content__border">
                   <div class="archives">
                       <div class="archives__content">
                            <h1 class="archives__content-primary-title"><?php  single_cat_title(); ?> Lectures</h1>
                       </div>

                    <?php 
                        while (have_posts()) { the_post();?>
                    <div class="archives__content">
                        <h1 class="archives__content-secondary-title"><?php the_title(); ?></h1>
                        <div class="wrapper">
                            <div class="row row-gutters">
                                <div class="col-md-4">
                                    <img src="<?php echo get_theme_file_uri('./img/algebra.jpg') ?>" alt="Algebra">
                                </div>
                                <div class="col-md-8">
                                    <a href="<?php the_permalink(); ?>"><?php the_excerpt(); ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php }
                    ?>

                   </div>
                </div>
            </div>
            <div class="col-md-4">
                <?php get_sidebar(); ?>
            </div>
        </div>
    </div>


<?php
  get_footer();
?>