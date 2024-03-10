<?php if (have_rows('time_sheets')) : ?>
    <?php while (have_rows('time_sheets')) :
        the_row(); ?>
        <tr>
            <td>
                <?php if ($prayer_name = get_sub_field('prayer_name')) : ?>
                    <?php echo esc_html($prayer_name); ?>
                <?php endif; ?>
            </td>

            <td>
                <?php
                $image = get_sub_field('image');
                if ($image) : ?>
                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                <?php endif; ?>
            </td>

            <td>
                <?php if ($prayer_time = get_sub_field('prayer_time')) : ?>
                    <?php echo esc_html($prayer_time); ?>
                <?php endif; ?>
            </td>

        </tr>
    <?php endwhile; ?>
<?php endif; ?>