<?php get_header(); ?>

<div class="content--block">
    <div class="holder holder--alt">
        <div class="content-404 text-center" data-scroll>
            <h1 class=""><?php the_field('404__title', 'option'); ?></h1>
            <?php echo wpautop(get_field('404__text', 'option')); ?>
            <br />
            <br />
            <div class="btn--block">
            <a class="btn" href="<?php echo home_url('/'); ?>"><?php get_template_part('svgs/back')?>&nbsp;&nbsp;&nbsp;<?php _e('Back to Home'); ?></a>
               
              
            </div>
               <br />
                <br />
                <br />
                <br />
        </div>

    </div>
</div>
<?php get_footer(); ?>