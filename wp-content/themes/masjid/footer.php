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
                                <img src="<?php echo esc_url($footer_logo['url']); ?>" alt="<?php echo esc_attr($footer_logo['alt']); ?>" />
                            <?php endif; ?>
                        </a>
                        <div>
                            <h3>Misato <span>Masjid</span></h3>
                            <p>341-0011, 1Chome-228-2 Uneme, Misato-shi,
                                Saitama, Japan</p>
                            <div class="conatcts">
                                <ul>
                                    <li>
                                        <span>Mobile No 1</span>
                                        90-7735-2450
                                    </li>
                                    <li>
                                        <span>Mobile No 2</span>
                                        90-7735-2450
                                    </li>
                                    <li>
                                        <span>Mobile No 3</span>
                                        90-7735-2450
                                    </li>
                                    <li>
                                        <span>Mobile No 4</span>
                                        90-7735-2450
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="footer-widget col-lg-3">
                    <h3>Navigations</h3>
                    <ul>
                        <li><a href="">Home</a></li>
                        <li><a href="">Pray Times</a></li>
                        <li><a href="">Donation</a></li>
                        <li><a href="">Contact US</a></li>
                        <li><a href="">About Us</a></li>
                    </ul>
                </div>
                <div class="footer-widget col-lg-3">
                    <h3>Library</h3>
                    <ul>
                        <li><a href="">Study Room</a></li>
                        <li><a href="">Videos</a></li>
                        <li><a href="">Prayer Shedule</a></li>
                        <li><a href="">Nikah</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="footer--bottom">
        <div class="holder">
            <ul class="footer--footnote">
                <li><a href="#">© Misato Mashid 2022</a></li>
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