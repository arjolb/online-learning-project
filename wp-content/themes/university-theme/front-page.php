<?php get_header(); ?>

<div class="wrapper">
    <div class="row row-gutters">
        <div class="col col-md-8">
            <div class="generic-content__border">                
            
                <div class="hero">
                    <div class="hero__content">
                        <img src="<?php echo get_theme_file_uri('./img/hero.jpg') ?>" alt="Hero">
                        <div class="hero__text">
                            <h1>Free Online Lectures</h1>
                            <h5>Lorem ipsum dolor sit amet consectetur.</h5>
                        </div>
                    </div>

                
                <div class="topics">
                
                    <div class="row row-gutters">
                        <?php $programs = new WP_Query(array(
                            'posts_per_page' => -1,
                            'post_type' => 'program'
                        ));

                        if ($programs->have_posts()) {
                            while ($programs->have_posts()) {
                                $programs->the_post();?>
                                <div class="col-md-6">
                                    <div class="topics__category">
                                        <h1><?php the_title(); ?></h1>
                                    </div>
                                    <ul class="topics__category-sub">
                                        <?php 
                                            $subjects = get_field('related_subjects');
                                            if ($subjects) {
                                                foreach ($subjects as $subject) {
                                                    echo "<li><a href=".get_the_permalink($subject).'>'.' '.get_the_title($subject).'</a></li>';
                                                }
                                            }
                                        ?>
                                    </ul>
                                </div>
                                
                            <?php }
                        }
                        ?>                                                                                          
                    </div>
                </div>


                </div>

            </div>
        </div>


        <div class="col col-md-4">
            <?php get_sidebar(); ?>
        </div>


    </div>
</div>

<?php get_footer(); ?>