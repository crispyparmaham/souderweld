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
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
$anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'header-section';
if ( ! empty( $block['className'] ) ) {
$class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
$class_name .= ' align' . $block['align'];
}

// Load values and assign defaults.
$heading = get_field( 'site-heading' ) ?: 'Wir sind Souderweld';
$text = get_field( 'site-text' ) ?: 'Ihr Spezialist für Schweißarbeiten';
$cta = get_field( 'site-cta' ) ?: ' ';
$ctaText = get_field('site-cta-text') ?: ' ';
$image = get_field( 'site-image' );
?>

<div <?php echo $anchor; ?>class="<?php echo esc_attr( $class_name ); ?>">
<div class="inner-max-width">
<div class="text-wrapper">
<h1 class="heading hmax title"><?php echo esc_html( $heading ); ?></h1>
<p class="text"><?php echo esc_html( $text ); ?></p>
<a href="<?php echo esc_html( $cta ); ?>"><?php echo $ctaText ?></a>
</div>
<div class="image">
<?php if($image) : ?>
<img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
<?php else : ?>
<img src="/app/uploads/2023/06/fallback-image.png" alt="Souderweld - die ganze Welt des Schweissens" />
<?php endif; ?>
</div>
</div>
</div>