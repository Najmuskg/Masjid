</div><!-- Holder--Container -->


</div><!-- main--wrapper -->

<!-- ==================== Start footer ==================== -->

<footer class="footer">
    <div class="footer--top">

        <div class="holder">
            <div class="row">
                <div class="footer-widget col-lg-6">
                    <div class="footer-widget_info">
                        <a href="index.php">
                            <?php
                            $footer_logo = get_field('footer_logo', 'options');
                            if ($footer_logo) : ?>
                            <img src="<?php echo esc_url($footer_logo['url']); ?>"
                                alt="<?php echo esc_attr($footer_logo['alt']); ?>" />
                            <?php endif; ?>
                        </a>
                        <div>
                            <h3>Misato <span>Masjid</span></h3>

                            <?php if ($adress = get_field('adress', 'options')) : ?>
                            <?php echo $adress; ?>
                            <?php endif; ?>

                            <div class="conatcts">
                                <ul>

                                    <?php if (have_rows('contact_box', 'options')) : ?>
                                    <?php while (have_rows('contact_box', 'options')) :
                                            the_row(); ?>
                                    <li>
                                        <?php if ($phone = get_sub_field('phone', 'options')) : ?>
                                        <span><?php echo esc_html($phone); ?></span>
                                        <?php endif; ?>
                                        <?php if ($number = get_sub_field('number', 'options')) : ?>
                                        <?php echo $number; ?>
                                        <?php endif; ?>
                                    </li>

                                    <?php endwhile; ?>
                                    <?php endif; ?>
                                </ul>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="footer-widget col-lg-3">

                    <?php if ($nav_title = get_field('nav_title', 'options')) : ?>
                    <h3><?php echo esc_html($nav_title); ?></h3>
                    <?php endif; ?>

                    <?php
                    wp_nav_menu($args = array(
                        'menu' => "footer_menu",
                        'menu_class' => "footer--menu",
                        'container' => "ul",
                        'theme_location' => "footer_menu",
                    ));
                    ?>
                </div>
                <div class="footer-widget col-lg-3">

                    <?php if ($library_title = get_field('library_title', 'options')) : ?>
                    <h3><?php echo esc_html($library_title); ?></h3>
                    <?php endif; ?>

                    <ul>
                        <?php if (have_rows('library_lists', 'options')) : ?>
                        <?php while (have_rows('library_lists', 'options')) :
                                the_row(); ?>
                        <?php if ($item = get_sub_field('item', 'options')) : ?>
                        <li><a href=""><?php echo esc_html($item); ?></a></li>
                        <?php endif; ?>

                        <?php endwhile; ?>
                        <?php endif; ?>

                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="footer--bottom">
        <div class="holder">
            <ul class="footer--footnote">
                <li><a href="#">© Misato Mashid <?php echo date('Y'); ?></a></li>
                <li><a href="#">Privacy Policy</a></li>
                <li><a href="#">Terms & Conditions</a></li>
            </ul>
        </div>
    </div>

</footer>

<!-- ==================== End footer ==================== -->
<?php wp_footer(); ?>
</body>

</html>