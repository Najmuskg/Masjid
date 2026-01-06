<?php
get_header();
if (have_posts()) : while (have_posts()) : the_post();
?> 
    <?php the_content(); ?> 
    <?php require(get_template_directory() . '/layout-modules/prayers-sheets-block.php'); ?>
<?php endwhile;
endif; ?>
<?php get_footer();
