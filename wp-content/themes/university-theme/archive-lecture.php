<?php
 get_header();
?>


    <div class="wrapper">
        <div class="row row-gutters">
            <div class="col-md-8">
                <div class="generic-content__border">
                   <div class="archives">
                       <div class="archives__content">
                            <h1 class="archives__content-primary-title"><?php  single_cat_title(); ?>All Lectures</h1>
                       </div>

                    <?php 
                        while (have_posts()) { the_post();?>
                    <div class="archives__content">
                        <h1 class="archives__content-secondary-title">
                            <?php 
                              the_title(); 
                            ?>
                        </h1>


                        <div class="wrapper">
                            <div class="row row-gutters">
                                <div class="col-md-4">
                                    <?php the_post_thumbnail('thumbnail'); ?>
                                </div>
                                <div class="col-md-8">
                                    <a href="<?php the_permalink(); ?>"><?php the_excerpt(); ?></a>
                                    <?php
                                    echo "<h2>Related Program(s): ";                                        
                                    $relatedPrograms=get_field('related_chapter');
                                    foreach ($relatedPrograms as $key) {
                                        // echo $key->ID;
                                        $relatedSubjects = new WP_Query(array(
                                            'posts_per_page' => -1,
                                            'post_type' => 'chapter',
                                            'p' => $key->ID
                                          ));
                                          if ($relatedSubjects) {
                                              while ($relatedSubjects->have_posts()) {
                                                  $relatedSubjects->the_post();
                                                  $test = get_field('related_subjects');
                                                //   print_r($test);
                                                  foreach ($test as $test1) { ?>
                                                    
                                                    <a class="single__link" href="<?php the_permalink($test1); ?>"><?php echo get_the_title($test1); ?></a>
                                                 <?php }
                                              }
                                          }
                                    }
                                   echo '</h2>';
                                    ?>
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