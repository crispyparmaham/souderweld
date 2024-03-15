<?php
/**
 * Testimonial Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during backend preview render.
 * @param   int $post_id The post ID the block is rendering content against.
 *          This is either the post ID currently being displayed inside a query loop,
 *          or the post ID of the post hosting this block.
 * @param   array $conheading The conheading provided to the block by the post or it's parent block.
 */

// Support custom "anchor" values.
$anchor = !empty($block['anchor']) ? 'id="' . esc_attr($block['anchor']) . '" ' : '';

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'header-section';
$class_name .= !empty($block['className']) ? ' ' . $block['className'] : '';
$class_name .= !empty($block['align']) ? ' align' . $block['align'] : '';

// Load values and assign defaults.
$heading = get_field('header-heading') ?: 'Wir sind Souderweld';
$headingColor = get_field('header-heading-color');
$text = get_field('header-text') ?: 'Ihr Spezialist für Schweißarbeiten';

$cta = get_field('header-cta');
$link_url = !empty($cta['url']) ? $cta['url'] : '';
$link_title = !empty($cta['title']) ? $cta['title'] : '';

$image = get_field('header-image');
$image_url = !empty($image['url']) ? $image['url'] : '/app/uploads/2023/06/fallback-image.png';
$image_alt = !empty($image['alt']) ? $image['alt'] : 'Souderweld - die ganze Welt des Schweissens';
?>

<div <?php echo $anchor; ?>class="<?php echo esc_attr($class_name); ?>">
    <div class="inner-max-width">
        <div class="heading-wrap">
            <h1 class="h-xxl"><?php echo esc_html($heading); ?></h1>
            <span class="key-color"><?php echo esc_html($headingColor); ?></span>
        </div>
        <span class="heading-text"><?php echo esc_html($text); ?></span>
        <?php if (!empty($link_url) && !empty($link_title)) : ?>
            <a class="button-cta" href="<?php echo esc_url($link_url); ?>"><?php echo esc_html($link_title); ?></a>
        <?php endif; ?>
        <div class="header-image">
            <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>" />
        </div>
    </div>
</div>
