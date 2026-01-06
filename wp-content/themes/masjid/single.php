<?php
get_header();
if (have_posts()) : while (have_posts()) : the_post();
?>
        <article>
            <section class="announcements--wrapper">
                <h2><?php the_title(); ?></h2>
                <?php the_content(); ?>
            </section>
        </article>
        <?php require(get_template_directory() . '/layout-modules/prayers-sheets-block.php'); ?>
<?php endwhile;
endif; ?>
<?php get_footer();
