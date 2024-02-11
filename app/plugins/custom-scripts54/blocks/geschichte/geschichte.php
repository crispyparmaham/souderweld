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
$class_name = 'geschichte-block';
if ( ! empty( $block['className'] ) ) {
$class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
$class_name .= ' align' . $block['align'];
} 

// Load values and assign defaults.
?>

<div <?php echo $anchor; ?>class="<?php echo esc_attr( $class_name ); ?>">

<?php
$event = 'event';
if (have_rows($event)) : ?>
<div class="swiper geschichteSwiper" id="geschichteSwiper">
<div class="swiper-wrapper"><?php 
while(have_rows($event)) : the_row();
$heading = get_sub_field( 'date' ) ?: 'Hier könnte dein Datum stehen';
$text = get_sub_field( 'text' ) ?: 'Hier könnte Ihr Text stehen';
?>

<div class="swiper-slide">
<h1 class="heading hmax title"><?php echo esc_html( $heading ); ?></h1>
<p class="text"><?php echo esc_html( $text ); ?></p>
</div>
<?php endwhile; ?>
</div>
<?php endif; ?>
</div>
</div>