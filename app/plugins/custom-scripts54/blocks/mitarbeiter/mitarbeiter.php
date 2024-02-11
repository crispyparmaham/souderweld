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
$class_name = 'mitarbeiter';
if ( ! empty( $block['className'] ) ) {
$class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
$class_name .= ' align' . $block['align'];
} ?>

<div <?php echo $anchor; ?>class="<?php echo esc_attr( $class_name ); ?>">

<?php 

$chosen_mitarbeiter = get_field('mitarbeiter_wahlen');
if($chosen_mitarbeiter ) :

$countHash = 0;

foreach($chosen_mitarbeiter as $id) :

$image = get_field( 'bild', $id );
$name = get_field( 'name', $id );
$nameClean = str_replace(' ', '_', strtolower($name));
$position = get_field( 'position', $id );
$bereich = get_field('bereich', $id);
$telefon = get_field( 'phone', $id);
$mobile = get_field( 'mobile', $id);
$mail = get_field( 'mail', $id);
$zertifikate = 'zertifikate';
$anzahlZertifikate = 0;
?> 

<div class="teammitglied">

<?php if ($image) : ?>
<div class="bild-team">
<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
</div>
<?php endif;  ?>

<?php if( have_rows($zertifikate, $id) ): ?>
<div class="gallery-hidden" style="display: none;">
<div class="lightgallery gallery-<?php echo $nameClean; ?>">    
<?php while( have_rows($zertifikate, $id)): the_row(); ?>
<?php 
$anzahlZertifikate++ ;
$nameCertificate = get_sub_field('name');
$imageCertificate = get_sub_field('bild');
?>   
<a class="certificate-gallery-item" href="<?php echo esc_url($imageCertificate['url']); ?>">
<img src="<?php echo esc_url($imageCertificate['url']); ?>" alt="<?php echo esc_attr($imageCertificate['alt']); ?>" />   
</a> 
<?php endwhile; ?>
</div>
</div>
<div id="galleryButton-<?php echo $nameClean?>" data-gallery="gallery-<?php echo $nameClean; ?>" class="button-certificate "><span class="button-text"><?php echo $anzahlZertifikate ?></span>
<img style="width: calc(var(--certificateButtonWidth) + <?php echo $anzahlZertifikate ?>); height: calc(var(--certificateButtonHeight) + <?php echo $anzahlZertifikate?> );" src="<?= plugin_dir_url(__DIR__) ?>../dist/assets/icons/souderweld-star.svg" alt="">
</div>
<?php else : ?>
<div class="button-certificate "><span class="button-text"><?php echo $anzahlZertifikate ?></span>
<img src="<?= plugin_dir_url(__DIR__) ?>../dist/assets/icons/souderweld-star.svg" alt="">
</div>
<?php endif; ?>

<div class="teammitglied-text-wrapper">
<div class="teammitglied-text">
<?php if ($name) : ?><h3><?php echo $name; ?></h3><?php endif;  ?>
<?php if ($position) : ?><h4 class="position"><?php echo $position; ?></h4><?php endif;  ?>
</div>

<div class="buttons-team">
<?php if($telefon) : ?>	
<a href="tel:<?php echo $telefon; ?>">
<div class="contact-button">
<img src="<?= plugin_dir_url(__DIR__) ?>../dist/assets/icons/souderweld-phone.svg" alt="">
</div>
</a>
<?php endif;  ?>
<?php if($mail) : ?>	
<a href="mailto:<?php echo ($mail); ?>">
<div class="contact-button">
<img src="<?= plugin_dir_url(__DIR__) ?>../dist/assets/icons/souderweld-mail.svg" alt="">
</div>
</a>
<?php endif;  ?>
<?php if($mobile) : ?>	
<a href="mailto:<?php echo ($mail); ?>">
<div class="contact-button">
<img src="<?= plugin_dir_url(__DIR__) ?>../dist/assets/icons/souderweld-mobile.svg" alt="">
</div>
</a>
<?php endif;  ?>
</div>
</div>
</div>

<?php 
$countHash++;
endforeach; ?> 
<?php endif; ?> 

</div>