<aside>

    <div class="timesCard">

        <?php if ($pt_title = get_field('pt_title', 'options')) : ?>
            <h4><?php echo esc_html($pt_title); ?></h4>
        <?php endif; ?>

        <div class="bg-white">

            <?php if ($pt_caption = get_field('pt_caption', 'options')) : ?>
                <?php //echo esc_html($pt_caption); 
                ?>
            <?php endif; ?>
            <?php echo display_custom_date(); ?>

            <div class="content-wrapper">
                <div id="tab-1" class="tab-content">
                    <?php
                    // Prayer Times Table 
                    //$salat_times = get_field('salat_times', 'options');
                    //$time_sheets = get_field('time_sheets', 'options');

                    //print_r($salat_times);
                    //print_r($time_sheets);
                    ?>
                    <table class="rwd-table">
                        <tbody>

                            <?php if (have_rows('time_sheets', 'options')) : ?>
                                <?php while (have_rows('time_sheets', 'options')) : the_row(); ?>
                                    <tr>
                                        <td>
                                            <?php if ($prayer_name = get_sub_field('prayer_name')) : ?>
                                                <?php echo esc_html($prayer_name); ?>
                                            <?php endif; ?>
                                        </td>

                                        <td>
                                            <img src="<?php bloginfo('template_url'); ?>/_/images/miner_green.png" alt="" />
                                        </td>

                                        <td>
                                            <?php if ($prayer_time = get_sub_field('prayer_time')) : ?>
                                                <?php echo esc_html($prayer_time); ?>
                                            <?php endif; ?>
                                        </td>

                                    </tr>
                                <?php endwhile; ?>
                            <?php endif; ?>

                        </tbody>

                    </table><!-- rwd-table -->

                </div><!-- tab-content -->

            </div>
        </div>
    </div><!-- TimeCard -->



</aside>