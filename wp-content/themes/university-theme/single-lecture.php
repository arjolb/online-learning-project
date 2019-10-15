<?php get_header(); ?>

    <div class="wrapper">
        <div class="row row-gutters">
            <div class="col-md-8">
                <div class="generic-content__border">
                    <div class="single single__content">
                        <div class="single__title">
                            <?php
                                while (have_posts()) {
                                    the_post();
                                    $lectureDate = get_field('lecture_date');
                                    echo $lectureDate;
                                    if ($lectureDate<date('Ymd')) {
                                                    
                            ?>
                                <h1><?php the_title(); ?></h1>
                                <h3><?php the_author_posts_link(); ?> | <span><?php 
                                $date = DateTime::createFromFormat('d/m/Y', $lectureDate);
                                echo $date->format('F j, Y');
                                 ?></span></h3>
                        </div>
                        <article class="single__description"><?php the_content(); ?></article>
                        
                        <?php 
                            $relatedProfessor = get_field('related_professor');
                            echo '<h3 class="single__link">Lecture By: ';
                            $relatedProfessorCount = count($relatedProfessor);
                        if($relatedProfessor && $relatedProfessorCount>1){
                            foreach ($relatedProfessor as $professor) {
                               echo "<a href=".get_the_permalink($professor).'>'.get_the_title($professor).'    '.'</a>';   
                            }
                        }else{
                            foreach ($relatedProfessor as $professor) {
                                echo "<a href=".get_the_permalink($professor).'>'.get_the_title($professor).'</a>';   
                            }
                        }
                            echo '</h3>';
                    }else{
                        echo 'TEst!';;
                    }?>
                        
                        <span class="single__ratings"></span>
                        
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

<?php get_footer(); ?>