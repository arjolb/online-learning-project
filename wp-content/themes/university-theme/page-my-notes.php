<?php
if (!is_user_logged_in()) {
    wp_redirect(esc_url(site_url('/')));
    exit;
}?>

<?php get_header(); ?>
<?php 
    while (have_posts()) {
    the_post();
?>
    <div class="wrapper">
        <div class="row">
            <div class="row-gutters">
                <div class="col-md-8">
                    <div class="generic-content__border">
                        <div class="hero">

                    <div class="create-note">
                        <h3 class="create-note__heading">Add new note</h3>
                        <input type="text" class="create-note__title" id="create-note__title" placeholder="Title">
                        <textarea class="create-note__content" id="create-note__content" placeholder="Note Content"></textarea>
                        <span class="submit-note">Create Node</span>
                        <span class="create-note__limit">Note Limit reached: delete an existing note</span>
                    </div>

                    <div class="note-container">
                        <?php
                            $userNotes = new WP_Query(array(
                                'post_type' => 'note',
                                'posts_per_page' => -1,
                                'author' => get_current_user_id()
                            ));   
                        
                            while($userNotes->have_posts()) {
                                $userNotes->the_post(); ?>
                                  
                                    <div class="note" data-id="<?php the_ID(); ?>" data-state="cancel">
                                      <input readonly class="note-title-field" value="<?php echo str_replace('Private: ','',esc_textarea(get_the_title())); ?>">
                                      <span class="edit-note"><i class="fa fa-edit" aria-hidden="true"></i> Edit</span>
                                      <span class="delete-note"><i class="fas fa-trash"></i> Delete</span>
                                      <textarea readonly class="note-body-field"><?php echo esc_attr(get_the_content()); ?></textarea>
                                      <span class="update-note update-note__btn"><i class="fa fa-arrow-right" aria-hidden="true"></i> Save</span>
                                    </div>
                                  
                              <?php }
                    }
                        ?>
                    </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4"><?php get_sidebar(); ?></div>
            </div>
        </div>
    </div>


<?php get_footer(); ?>