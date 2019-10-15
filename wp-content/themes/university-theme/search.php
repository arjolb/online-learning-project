<?php get_header(); ?>


    <div class="wrapper">
        <div class="row">
            <div class="row-gutters">
                <div class="col-md-8">
                    <div class="generic-content__border">
                        <?php
                            if (have_posts()) {
                                while (have_posts()) {
                                    the_post();?>
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    <p>Posted by <?php the_author_posts_link(); ?> on <?php the_time('n.j.y'); ?> in <?php echo get_the_category_list(', '); ?></p>
                                    <?php the_excerpt(); ?>
                                    <p><a class="btn btn--blue" href="<?php the_permalink(); ?>">Continue reading &raquo;</a></p>
                                <?php }
                            }else{
                                echo '<h2>No results match that search.</h2>';;
                            }
                        ?>
                    </div>
                </div>
                <div class="col-md-4"><?php get_sidebar(); ?></div>
            </div>
        </div>
    </div>


<?php get_footer(); ?>