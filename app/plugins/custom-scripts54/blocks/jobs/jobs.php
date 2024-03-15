<?php

$anchor = '';
if (!empty($block['anchor'])) {
    $anchor = 'id="' . esc_attr($block['anchor']) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'job-grid-main';
if (!empty($block['className'])) {
    $class_name .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $class_name .= ' align' . $block['align'];
} ?>

<div <?php echo $anchor; ?>class="<?php echo esc_attr($class_name); ?>">

    <?php
    $args = array(
        'post_type' => 'job', 
        'posts_per_page' => -1,
        'orderby' => 'title',
        'order' => 'ASC'
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
            $post_title = get_the_title();
            $post_link = get_permalink();
            $post_excerpt = wp_trim_words(get_the_excerpt(), 20); // Begrenze den Auszug auf 20 Wörter
    ?>

            <a href="<?php echo esc_url($post_link); ?>" class="job-post-wrap">
                <div class="job-heading-wrap">
                    <h4 class="h-s"><?php echo esc_html($post_title); ?></h4>
                    <span>(m/w/d)</span>
                </div>
                <div class="job-content-wrap">
                    <span><?php echo $post_excerpt; ?></span>
                    <div class="cta-arrow-small">
                        <span class="link-text">in 5 Minuten bewerben</span>
                        <img class="arrow-icon" src="/app/uploads/2023/06/arrow-small-1.svg" alt="Arrow">
                    </div>
                </div>
            </a>

    <?php endwhile;
        wp_reset_postdata();
    endif; ?>

</div>
