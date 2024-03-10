<header class="header">
    <div class="holder">

        <div class="header__logo">
            <h1 title="Misato Masjid"><a href="index.html">
                    <?php
                    $header_Logo = get_field('header_Logo', 'options');
                    if ($header_Logo) : ?>
                        <img src="<?php echo esc_url($header_Logo['url']); ?>" alt="<?php echo esc_attr($header_Logo['alt']); ?>" />
                    <?php endif; ?>
                    misato <span>masjid</span>
                </a>
            </h1>

        </div>




        <div class="header__right">

            <div class="donate">
                <?php
                $link = get_field('donate_button', 'options');
                if ($link) :
                    $link_url = $link['url'];
                    $link_title = $link['title'];
                    $link_target = $link['target'] ? $link['target'] : '_self';
                ?>
                    <a class="btn" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a>
                <?php endif; ?>
            </div>

            <div class="switch">
                <input id="language-toggle" class="check-toggle check-toggle-round-flat" type="checkbox">
                <label for="language-toggle"></label>
                <span class="on">BN</span>
                <span class="off">EN</span>
            </div>

        </div>
    </div>
</header><!-- Header -->