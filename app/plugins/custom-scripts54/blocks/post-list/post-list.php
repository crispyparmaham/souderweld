<?php

$anchor = '';
if (!empty($block['anchor'])) {
    $anchor = 'id="' . esc_attr($block['anchor']) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'post-list';
if (!empty($block['className'])) {
    $class_name .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $class_name .= ' align' . $block['align'];
} ?>

<div <?php echo $anchor; ?>class="<?php echo esc_attr($class_name); ?>">


    <?php

    $chosen_post = get_field('auswahl');
    if ($chosen_post) :

        $countHash = 0;

        foreach ($chosen_post as $id) :

            $image = get_field('bild', $id);
            $title = get_the_title($id);
            $description = get_field('beschreibung', $id);
            $excerpt = wp_trim_words($description, 20);
            $link = get_the_permalink($id);

    ?>

            <div class="post-item-box">
                <?php if ($image) : ?>
                    <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
                <?php endif;  ?>
                <div class="post-content-wrap">
                    <h4 class="post-heading h-s"><?php echo $title; ?></h4>
                    <span class="post-content"><?php echo $excerpt; ?></span>
                </div>  
                <a class="button secondary arrow" href="<?php echo $link; ?>"><svg viewBox="0 0 73.953 11.156">
  <path id="noun-arrow-5574219-FFFFFF" d="M315.891,395.817a.8.8,0,0,0-.176-.87l-4.787-4.787a.8.8,0,0,0-1.125,1.125l3.423,3.423H242.8a.8.8,0,1,0,0,1.6h70.439l-3.423,3.423a.8.8,0,0,0,0,1.125.784.784,0,0,0,.567.231.817.817,0,0,0,.566-.231l4.787-4.787a.763.763,0,0,0,.176-.263Z" transform="translate(-241.997 -389.926)" fill="#82cbe6"></path>
</svg>Mehr erfahren
</a>
            </div>

        <?php
            $countHash++;
        endforeach; ?>
    <?php endif; ?>
</div>
