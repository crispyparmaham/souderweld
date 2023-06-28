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

global $posts;

// Load values and assign defaults.

$args = array(
    'post_type' => 'wissen', // Hier den Namen deines benutzerdefinierten Post-Typs einfügen
    'numberposts' => 12, // Hier kannst du die Anzahl der Beiträge festlegen. -1 zeigt alle Beiträge an.
    'orderby' => 'title', // Sortieren nach Titel
    'order' => 'ASC', // Aufsteigende Sortierung
);

$posts = get_posts( $args ); ?>

<div class="uppercase hsmall">Wissen A-Z</div>

<?php 
if ( $posts ) :
    foreach ( $posts as $post ) :
        // Hier kannst du auf die Daten jedes Beitrags zugreifen
        $post_title = $post->post_title;
        $post_content = $post->post_content;
        $permalink = $post->permalink; 
    ?>
    <div class="menu-list">
    <a href="<?php echo $permalink ?>"><?php echo $post_title ?></a>
    </div>
<?php 
endforeach;
endif;
?>
<div class="read-on">
<a href="/mehr">alle Themen anzeigen</a>
</div>