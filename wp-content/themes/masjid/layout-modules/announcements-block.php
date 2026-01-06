<!-- ==================== Start announcements--wrapper ==================== -->

<article>
    <section class="announcements--wrapper">
        <?php if ($title = get_field('title')) : ?>
            <h2><?php echo esc_html($title); ?></h2>
        <?php endif; ?>
        <?php if ($caption = get_field('caption')) : ?>
            <?php echo $caption; ?>
        <?php endif; ?>

        <?php //echo display_custom_date(); 
        ?>

        <div class="swiper announcements--slider">

            <div class="swiper-wrapper">
                <?php
                // The Query
                $the_query = new WP_Query(array(
                    'posts_per_page' => 5, // Number of latest posts to display
                    'post_status' => 'publish', // Only show published posts
                ));

                // The Loop
                if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post(); ?>

                        <div class="swiper-slide">
                            <div class="card bg-white">
                                <img src="<?php echo (has_post_thumbnail()) ? get_the_post_thumbnail_url(get_the_ID(), 'full') : 'https://placehold.co/400'; ?>" alt="">
                                <div class="card-info">
                                    <h3><?php the_title(); ?></h3>
                                    <!-- <p class="date"><?php the_time('F jS, Y'); ?></p> -->
                                    <?php the_excerpt(); ?>

                                    <div class="btn--block">
                                        <a class="btn" href="<?php echo get_permalink(); ?>">Read More</a>
                                    </div>
                                </div>
                            </div>
                        </div><!--.Swiper-Slide -->
                <?php endwhile;
                endif;
                wp_reset_postdata(); ?>



            </div><!--.Swiper-Wrapper -->

            <div class="swiper-controls">
                <div class="swiper-controls__navigation">
                    <div class="swiper-button-previous announcements-prev">
                        <?php get_template_part('svgs/slider-pre'); ?>
                    </div>
                    <div class="swiper-button-next announcements-next">
                        <?php get_template_part('svgs/slider-next') ?>
                    </div>
                </div>

                <div class="swiper-controls__progress">
                    <div class="swiper-pagination announcements-progress"></div>
                </div>

            </div><!-- /.swiper-controls -->

        </div>


        <?php
        // global $post;
        // $posts = get_field('announcementspromo');
        // if ($posts) :
        //     foreach ($posts as $post) :
        //         setup_postdata($post);
        //         require get_template_directory() . '/layout-modules/_list-news-items.php';
        //     endforeach;
        //     wp_reset_postdata();
        // endif;
        ?>



    </section>

</article>

<!-- ==================== End announcements--wrapper ==================== -->