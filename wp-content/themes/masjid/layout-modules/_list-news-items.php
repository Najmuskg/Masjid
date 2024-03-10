<div class="card bg-white">
    <img src="<?php echo (has_post_thumbnail()) ? get_the_post_thumbnail_url(get_the_ID(), 'full') : get_template_directory_uri() . '/_/images/eid.jpg'; ?>" alt="">
    <div class="card-info">
        <h3><?php the_title(); ?></h3>
        <p class="date"><?php the_time('F jS, Y'); ?></p>
        <?php the_excerpt(); ?>

        <div class="btn--block">
            <a class="btn" href="#" target="_blank">View All</a>
        </div>
    </div>
</div><!-- card -->