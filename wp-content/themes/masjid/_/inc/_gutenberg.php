<?php

/**
 * Add support for Gutenberg features
 */
function underpants_setup_theme_supported_features()
{
    add_theme_support('align-wide');

    //add_theme_support( 'disable-custom-colors' ); // removes color options completely
    add_theme_support('disable-custom-font-sizes');
}

add_action('after_setup_theme', 'underpants_setup_theme_supported_features');

// ----------------

/**
 * Enqueue editor styles for Gutenberg
 */
function underpants_editor_styles()
{
    wp_enqueue_style('underpants-editor-style', get_template_directory_uri() . '/_/css/_editor-styles.css', array(), substr(md5(rand()), 0, 5));
}

add_action('enqueue_block_editor_assets', 'underpants_editor_styles');

// ----------------
// Colour palette - add basic darks and white and leave rest to colour picker

function underpants_gutenberg_color_palette()
{
    add_theme_support(
        'editor-color-palette',
        array(
            // ----------------
            array(
                'name' => esc_html__('Black', 'underpants'),
                'slug' => 'black',
                'color' => '#2a2a2a',
            ),
         
            array(
                'name' => esc_html__('White', 'underpants'),
                'slug' => 'white',
                'color' => '#FFFFFF',
            )

            // ----------------
        )
    );
}

add_action('after_setup_theme', 'underpants_gutenberg_color_palette');

add_filter('allowed_block_types_all', 'underpants_allowed_block_types_all', 10, 2);

function underpants_allowed_block_types_all($allowed_blocks, $post)
{

    $allowed_blocks = array(
        // -- Common
        'core/paragraph',
        'core/image',
        'core/heading',
        //(Deprecated) core/subhead — Subheading
        'core/gallery',
        'core/list',
       // 'core/quote',
        //'core/audio',
        'core/cover',
        'core/file',
        'core/video',
        // -- Formatting
        'core/table',
        'core/verse',
        'core/code',
        //'core/freeform', // Classic
        'core/html', // Custom HTML
         
        // -- Layout
        'core/button',
        'core/columns', // Columns
        'core/media-text', // Media and Text
        'core/more',
        //core/nextpage — Page break
        'core/separator',
        'core/spacer',
       
        // -- Embeds
        'core/embed', // Disabled becuase HTML block can cover other embeds, this only asks for URL
        //'core-embed/twitter',
        'core-embed/youtube',
       
        'core-embed/vimeo',

        // --- Reusable
        'core/block',
        'core/template', 
        // --- Custom/ACF
        'acf/announcements-block',  
        'acf/footer-contact',  
        'acf/prayers-sheets-block',  
       
         
    );

    
    return $allowed_blocks;
}

add_action('acf/init', 'blocks_acf_init');

function blocks_acf_init()
{

    // check function exists
    if (function_exists('acf_register_block')) {

        acf_register_block(array(
            'name' => 'announcements-block',
            'title' => __('Announcements Block'),
            'description' => __('Announcements Block'),
            'render_callback' => 'my_acf_block_render_callback',
            'category' => 'layout',
            'icon' => 'chart-area',
            'mode' => 'edit',
            'supports' => array('align' => false),
            'anchor' => true,
            'example' => array(
                'attributes' => array(
                    'mode' => 'preview',
                    'is_preview' => true,
                ),
            ),
        ));    
        acf_register_block(array(
            'name' => 'prayers-sheets-block',
            'title' => __('Prayer Sheets Block'),
            'description' => __('Prayer Sheets Block'),
            'render_callback' => 'my_acf_block_render_callback',
            'category' => 'layout',
            'icon' => 'chart-area',
            'mode' => 'edit',
            'supports' => array('align' => false),
            'anchor' => true,
            'example' => array(
                'attributes' => array(
                    'mode' => 'preview',
                    'is_preview' => true,
                ),
            ),
        ));    
    }
}

function my_acf_block_render_callback($block, $content = '', $is_preview = false)
{

    // convert name ("acf/testimonial") into path friendly slug ("testimonial")
    $slug = str_replace('acf/', '', $block['name']);

    // include a template part from within the "template-parts/block" folder
    if (file_exists(get_theme_file_path("/layout-modules/{$slug}.php"))) {
        include(get_theme_file_path("/layout-modules/{$slug}.php"));
    }
}

// Until we can remove or disable the Drop cap feature, the best we can do is stop it rendering on the templates
add_filter('render_block', function ($block_content, $block) {
    // only affect the Core Paragraph block
    if ('core/paragraph' === $block['blockName']) {
        // remove the class that creates the drop cap
        $block_content = str_replace('class="has-drop-cap"', '', $block_content);

       
    }
    

    // always return the content, whether we changed it or not
    return $block_content;
}, 10, 2);

// ----------------
// Add custom fonts to admin

function gb_custom_admin_css()
{

    get_template_part('page-templates/_meta-fonts');
}

add_action('admin_head', 'gb_custom_admin_css');
