<?php get_header(); ?>

    <div class="wrapper">
        <div class="row row-gutters">
            <div class="col-md-8">
                <div class="generic-content__border">
                    <div class="single single__content">
                        <div class="single__title">
                            <?php
                                while (have_posts()) {
                                    the_post();?>
                                <h1><?php the_title(); } wp_reset_postdata(); ?></h1>
                        </div>
                        <div class="single__professor">
                            <div class="row row-gutters">
                                <div class="col-md-4">
                                    <?php the_post_thumbnail('professorLandscape'); ?>
                                </div>
                                <div class="col-md-8">
                                    <section class="single__description-professor"><?php  the_content(); ?></section>    
                                </div>
                            </div>
                        </div>
                        
                        
                        <?php 
                            $relatedProfessor = new WP_Query(array(
                                'posts_per_page' => -1,
                                'post_type' => 'subject',
                                'meta_query' => array(
                                    array(
                                        'key' => 'related_professor',
                                        'compare' => 'LIKE',
                                        'value' => get_the_ID()
                                    )
                                )
                            ));
                        if($relatedProfessor){
                            echo '<h3 class="single__subjects">Subject(s) Taught: ';
                            while ($relatedProfessor->have_posts()) {
                                $relatedProfessor->the_post();
                            // foreach ($relatedPrograms as $program) {
                               echo "<a href=".get_the_permalink().'>'.' '.get_the_title().'</a>';
                            // }
                            
                        }
                        echo '</h3>';
                        } wp_reset_postdata();
                        ?>
                        
                        <?php
                            $likeCount = new WP_Query(array(
                                'post_type' => 'like',
                                'meta_query' => array(
                                    array(
                                        'key' => 'liked_professor_id',
                                        'compare' => '=',
                                        'value' => get_the_ID()
                                    )
                                )
                            ));
                            $existStatus = 'no';

                            if (is_user_logged_in()) {
                                $authorLike = new WP_Query(array(
                                    'author' => get_current_user_id(),
                                    'post_type' => 'like',
                                    'meta_query' => array(
                                        array(
                                            'key' => 'liked_professor_id',
                                            'compare' => '=',
                                            'value' => get_the_ID()
                                        )
                                    )
                                ));
                                if ($authorLike->found_posts) {
                                    $existStatus = 'yes';
                                }
                            }

                        ?>
                        <span class="single__likes" data-professor="<?php the_ID(); ?>" data-exists="<?php echo $existStatus; ?>" data-like="<?php echo $authorLike->posts[0]->ID; ?>">
                            <i class="fa fa-heart"></i><span class="single__likes-count"><?php echo $likeCount->found_posts; ?></span>
                        </span>

                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <?php get_sidebar(); ?>
            </div>
        </div>
    </div>

<?php get_footer(); ?>