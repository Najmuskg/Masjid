<?php
$cont_coutries = array();
$page_id = get_the_ID();

$terms = get_terms('country', array(
    'hide_empty' => true,
    'orderby' => 'name',
    'order' => 'ASC',
));
foreach ($terms as $term) :
    $current_country = $term->name;
    $cont_coutries[] = [
        'name' => $current_country,
        'link' => '#' . sanitize_title($current_country)
        //'link' => get_permalink($page_id) . '#' . sanitize_title($current_country)
    ];

    // city name 
    $args = array(
        'post_type' => array('address'),
        'posts_per_page' => -1,
        'country' => $term->slug
    );

    $contact_posts = new WP_Query($args);
    if ($contact_posts->have_posts()) :
        while ($contact_posts->have_posts()) : $contact_posts->the_post();
            $cont_coutries[] = [
                'name' => get_the_title(),
                'link' => '#' . sanitize_title($current_country)
            ];
        endwhile;
    endif;

endforeach;
?>
<script>
    $(function() {
        var cons = <?php echo json_encode($cont_coutries); ?>;

        var cons_source = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            local: cons,
        });

        cons_source.initialize();

        $('#con-search .typeahead').typeahead({
            hint: true,
            highlight: true,
            minLength: 1,
            items: 'all'
        }, {
            name: 'matched-links',
            displayKey: 'name',
            limit: 30,
            source: cons_source.ttAdapter(),
            templates: {
                empty: [
                    '<div class="empty-message">',
                    'No matches found',
                    '</div>'
                ].join('\n'),
                suggestion: Handlebars.compile('<p><a href="{{link}}" class="typeahead-contact">{{name}}</a></p>')
            }
        });

        $('#con-search').on('click', '.typeahead-contact', function(e) {
            var id = $(this).attr('href');
            // target element
            var $id = $(id);
            if ($id.length === 0) {
                return;
            }
            e.preventDefault();
            var pos = $id.offset().top - 50;
            $('body, html').animate({
                scrollTop: pos
            });

        });
    });
</script>