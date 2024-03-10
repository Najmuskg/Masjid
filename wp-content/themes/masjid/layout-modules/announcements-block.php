<!-- ==================== Start announcements--wrapper ==================== -->

<article>
    <section class="announcements--wrapper">
        <?php if ($title = get_field('title')) : ?>
            <h2><?php echo esc_html($title); ?></h2>
        <?php endif; ?>
        <?php if ($caption = get_field('caption')) : ?>
            <?php echo $caption; ?>
        <?php endif; ?>

        <?php
        $args = array(
            'post_type' => 'post',
            'posts_per_page' => 3
        );

        $announcements_query = new WP_Query($args);

        if ($announcements_query->have_posts()) :
            while ($announcements_query->have_posts()) : $announcements_query->the_post();
                require(get_template_directory() . '/layout-modules/_list-news-items.php');
            endwhile;
            wp_reset_postdata();
        else :
        // No posts found
        endif;
        ?>


    </section>

</article>

<!-- ==================== End announcements--wrapper ==================== -->