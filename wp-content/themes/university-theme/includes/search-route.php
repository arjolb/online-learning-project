<?php

add_action('rest_api_init','universitySearch');

function universitySearch()
{
    register_rest_route('university/v1','search',array(
        'methods' => WP_REST_SERVER::READABLE,
        'callback' => 'universitySearchResults'
    ));
}

function universitySearchResults($data)
{
    $query = new WP_Query(array(
        'post_type' => array('post','page','professor','subject','lecture'),
        's' => sanitize_text_field($data['keyword'])
    ));

    $results = array(
        'generalInfo' => array(),
        'professors' => array(),
        'subjects' => array(),
        'lectures' => array() 
    );

    while ($query->have_posts()) {
        $query->the_post();

        if (get_post_type() =='post' OR get_post_type() =='page') {
            array_push($results['generalInfo'],array(
                'title' => get_the_title(),
                'permalink' => get_the_permalink(),
                'postType' => get_post_type(),
                'authorName' => get_the_author()
            ));
        }
        
        if (get_post_type() =='professor') {
            array_push($results['professors'],array(
                'title' => get_the_title(),
                'permalink' => get_the_permalink(),
                'image' => get_the_post_thumbnail_url(0,'professorLandscape')
            ));
        }
    
        if (get_post_type() =='subject') {
            $relatedProfessors = get_field('related_professor');
            if ($relatedProfessors) {
                foreach ($relatedProfessors as $professor) {
                    array_push($results['professors'],array(
                        'title' => get_the_title($professor),
                        'permalink' => get_the_permalink($professor),
                        'image' => get_the_post_thumbnail_url(0,'professorLandscape')
                    ));
                }
            }

            array_push($results['subjects'],array(
                'title' => get_the_title(),
                'permalink' => get_the_permalink(),
                'id' => get_the_ID()
            ));
        }

        if (get_post_type() =='lecture') {
            $lectureDate = new DateTime();
            $date = $lectureDate->createFromFormat('d/m/Y',get_field('lecture_date'));
            $description = null;
            if (has_excerpt()) {
                $description = get_the_excerpt();
            }else{
                $description = wp_trim_words(get_the_content(), 18);
            }
            array_push($results['lectures'],array(
                'title' => get_the_title(),
                'permalink' => get_the_permalink(),
                'month' => $date->format('M'),
                'day' => $date->format('d'),
                'dayOfTheWeek' => $date->format('D'),
                'description' => $description
            ));
        }
    
    }
    
    // if ($results['subjects']) {
    //     $programsMetaQuery = array('relation' => 'OR');

    //     foreach ($results['subjects'] as $item) {
    //         array_push($programsMetaQuery,array(
    //             'key' => '',
    //             'compare' => 'LIKE',
    //             'value' => $item['id']
    //         ));

    //     }

    //     $programsRelationshipQuery = new WP_Query(array(
    //         'post_type' => array(),
    //         'meta_query' => $programsMetaQuery
    //     ));

    //     while ($programsRelationshipQuery->have_posts()) {
    //         $programsRelationshipQuery->the_post();
    //     }
    // }

    return $results;
}