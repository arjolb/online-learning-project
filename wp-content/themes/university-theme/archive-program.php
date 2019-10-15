<?php
 get_header();
?>


    <div class="wrapper">
        <div class="row row-gutters">
            <div class="col-md-8">
                <div class="generic-content__border">
                   <div class="archives">
                       <!-- <div class="archives__content">
                            <h1 class="archives__content-primary-title"> Lectures</h1>
                       </div> -->

                    <?php 
                        while (have_posts()) { the_post();?>
                    <div class="archives__content">
                        <h1 class="archives__content-primary-title-programs"><?php the_title(); ?></h1>
                        <!-- <div class="wrapper"> -->
                            <div class="row row-gutters">
                                <div class="col-md-4">
                                    <?php the_post_thumbnail('medium'); ?>
                                </div>
                                <div class="col-md-8">
                                    <?php
                                     the_content();
                                     $subjects=get_field('related_subjects');
                                     echo '<h3 class="archives__content-link"> Related Subjects: ';
                                     if ($subjects) {
                                         foreach ($subjects as $subject) {
                                            echo '<a href="'.get_the_permalink($subject).'"'.'>'.get_the_title($subject).' '.'</a>';
                                         }
                                     }
                                     echo '</h3>';
                                    ?>
                                </div>
                            </div>
                        <!-- </div> -->
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