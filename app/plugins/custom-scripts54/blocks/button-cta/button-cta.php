<?php

$cta = get_field('button-cta');
$link_url = !empty($cta['url']) ? $cta['url'] : '#';
$link_title = $cta['title'];

?>

<a class="button-cta" href="<?php echo esc_url($link_url); ?>"><?php echo esc_html($link_title); ?></a>