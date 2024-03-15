<?php

$anchor = '';
if (!empty($block['anchor'])) {
    $anchor = 'id="' . esc_attr($block['anchor']) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'heading-wrap';
if (!empty($block['className'])) {
    $class_name .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $class_name .= ' align' . $block['align'];
}

// Load values and assign defaults.
$heading = get_field('header-heading') ?: 'Wir sind Souderweld';
$headingColor = get_field('header-heading-color');
$text = get_field('grid-text') ?: 'Ihr Spezialist für Schweißarbeiten';

?>

<div <?php echo $anchor; ?>class="<?php echo esc_attr($class_name); ?>">
    <h1 class="h-l"><?php echo esc_html($heading); ?></h1>
    <span class="key-color"><?php echo esc_html($headingColor); ?></span>

</div>
<span class="grid-text"><?php echo esc_html($text); ?></span>