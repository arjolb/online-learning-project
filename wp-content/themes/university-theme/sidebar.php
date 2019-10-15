<section class="events generic-content__border">

    <div class="generic-content__title">
        <h3>upcoming lectures</h3>
    </div>   
                <?php
                        $upcomingLectures=new WP_Query(array(
                            // 'posts_per_page' => -1,
                            'post_type' => 'lecture',
                            'order' => 'ASC',
                            'orderby' => 'meta_value_num',
                            'meta_key' => 'lecture_date',
                            'meta_query' => array(
                                array(
                                  'key' => 'lecture_date',
                                  'compare' => '>=',
                                  'value' => date('Ymd'),
                                  'type' => 'numeric'
                                )
                              )
                        ));?>
                <div class="events__info">
                    <?php    
                        while($upcomingLectures->have_posts()){
                        $upcomingLectures->the_post();
                           
                        $format_in = 'd/m/Y';
                        $format_out_DayOfTheWeek = 'D';
                        $format_out_DayOfTheWeekNumber = 'd';
                        $format_out_TheMonthTextual ='M';
                        $date = DateTime::createFromFormat($format_in, get_field('lecture_date')); 
   
                    ?>
                    <div class="events__info-">
                            <div class="row row-gutters">
                                <div class="col-md-3">
                                    <div class="events__info-date">
                                        <h4><?php echo $date->format($format_out_DayOfTheWeek);?></h4>  
                                        <h4><?php echo $date->format($format_out_DayOfTheWeekNumber); ?></h4>
                                        <h4><?php echo $date->format($format_out_TheMonthTextual); ?></h4>
                                    </div>                                    
                                </div>

                                <div class="col-md-9">
                                    <h3> 
                                        <?php
                                        echo '<a href="'.get_the_permalink().'">';
                                        $chapters=get_field('related_chapter');
                                            foreach ($chapters as $chapter) {
                                                echo get_the_title($chapter);
                                            }
                                        echo '</a>';
                                        ?>
                                    </h3>
                                    <h3><?php the_title(); ?></h3>

                                </div>

                            </div>
                    </div>
                        <?php 
                    }
                    wp_reset_postdata();?>
                                        

                </div>

</section>


            
            <section class="recent-posts">
                <div class="generic-content__title">
                    <h3>recent posts</h3>
                </div>

                <div class="generic-content__border">
                    <div class="recent-posts__post">
                    <?php 
                                $customLatestPosts = new WP_Query(array(
                                    'post_per_page'=>5,
                                    'order' => 'ASC',
                                    'orderby' => 'date'
                                ));

                                while ($customLatestPosts->have_posts()) {
                                    $customLatestPosts->the_post();?>
                             <h3><i class="fas fa-chevron-right"></i>
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                             </h3>
                        <?php 
                            }wp_reset_postdata();
                        ?>
                    </div>
                </div>

            </section>