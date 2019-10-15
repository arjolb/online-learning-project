<?php get_header(); ?>

    <div class="wrapper">
        <div class="row row-gutters">
            <div class="col-md-8">
                <div class="generic-content__border">
                    <div class="single">
                        <div class="single__content">                   
                            <?php 
                            while (have_posts()) {
                                the_post();
                            ?>                            
                                <h1 class="single__title"><?php the_title();} wp_reset_postdata(); ?></h1>
                                <?php
                                    $relatedChapters = new WP_Query(array(
                                        'posts_per_page' => -1,
                                        'post_type' => 'chapter',
                                        'orderby' => 'title',
                                        'order' => 'ASC',
                                        'meta_query' => array(
                                          array(
                                            'key' => 'related_subjects',
                                            'compare' => 'LIKE',
                                            'value' => '"' . get_the_ID() . '"'
                                          )
                                        )
                                      ));
                                    if ($relatedChapters) {
                                        while ($relatedChapters->have_posts()) {
                                            $relatedChapters->the_post();
                                            echo '<h2 class="single__chapter">'.get_the_title().'</h2>';
                                ?>
                                <section class="single__lectures">
                                    <?php
                                            $chapterId=get_the_ID();
                                            $relatedLectues=new WP_Query(array(
                                                'posts_per_page' => -1,
                                                'post_type' => 'lecture',
                                                'orderby' => 'date',
                                                'order' => 'ASC',
                                                'meta_query' => array(
                                                    array(
                                                        'key' => 'lecture_date',
                                                        'compare' => '<=',
                                                        'value' => date('Ymd'),
                                                        'type' => 'numeric'
                                                    ),
                                                    array(
                                                        'key' => 'related_chapter',
                                                        'compare' => 'LIKE',
                                                        'value' => '"' . $chapterId . '"'
                                                    )
                                                )
                                                ));
                                            if ($relatedLectues) {
                                                while ($relatedLectues->have_posts()) {
                                                    $relatedLectues->the_post();
                                                    $lectureTitle = get_field('lecture_title');
                                        ?>
                                    <div class="single__lectures-lecture">
                                        <div class="row row-gutters">
                                            <div class="col-md-4">
                                                <?php  the_post_thumbnail('lecture-thumbnail'); ?>
                                            </div>
                                            <div class="col-md-8">
                                                <h4 class="single__lecture-title"><?php echo $lectureTitle;?></h4>
                                                <a class="single__link" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php }}
                                    ?>
                                </section>
                                <?php }}?>
                        </div>
                            
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <?php get_sidebar(); ?>
            </div>
        </div>
    </div>

<?php get_footer(); ?>