<?php

$anchor = '';
if (!empty($block['anchor'])) {
    $anchor = 'id="' . esc_attr($block['anchor']) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'wissen-grid-main';
if (!empty($block['className'])) {
    $class_name .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $class_name .= ' align' . $block['align'];
} ?>

<div <?php echo $anchor; ?>class="<?php echo esc_attr($class_name); ?>">

    <?php
    $args = array(
        'post_type' => 'wissen', 
        'posts_per_page' => -1,
        'orderby' => 'title',
        'order' => 'ASC'
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
            $post_title = get_the_title();
            $post_link = get_permalink();
            $first_letter = substr($post_title, 0, 1); 
    ?>

            <a href="<?php echo esc_url($post_link); ?>" class="wissen-post-wrap">
                <h4 class="h-s"><?php echo esc_html($post_title); ?></h4>
                <span class="first-letter"><?php echo esc_html($first_letter); ?></span>
                <div class="cta-arrow-small">
                    <span class="link-text">mehr erfahren</span>
                    <img class="arrow-icon" src="/app/uploads/2023/06/arrow-small-1.svg" alt="Arrow">
                </div>
            </a>

    <?php endwhile;
        wp_reset_postdata();
    endif; ?>

</div>
