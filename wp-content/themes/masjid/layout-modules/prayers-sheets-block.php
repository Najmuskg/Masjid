<aside>

    <div class="timesCard">

        <?php if ($title = get_field('title')) : ?>
            <h4><?php echo esc_html($title); ?></h4>
        <?php endif; ?>

        <div class="bg-white">
            <div class="tab-wrapper">

                <ul class="tabs">
                    <li class="tab-link"><a href="#tab-1">Prayer Times</a> </li>
                    <li class="tab-link"><a href="#tab-2">Jum'ah Prayer</a> </li>
                </ul>

            </div><!-- tab-wrapper -->

            <?php if ($caption = get_field('caption')) : ?>
                <?php echo $caption; ?>
            <?php endif; ?>

            <div class="content-wrapper">
                <div id="tab-1" class="tab-content">
                    <table class="rwd-table">
                        <tbody>

                            <?php
                            require(get_template_directory() . '/layout-modules/_list-prayers-items.php');
                            ?>

                        </tbody>

                    </table><!-- rwd-table -->

                </div><!-- tab-content -->

                <div id="tab-2" class="tab-content">
                    <h3>Sakib</h3>
                </div><!-- tab-content -->

            </div>
        </div>
    </div><!-- TimeCard -->



</aside>