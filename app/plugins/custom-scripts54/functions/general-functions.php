<?php
class Walker_Sub_Menu_Pointers extends Walker_Nav_Menu {

	function start_el(&$output, $item, $depth=0, $args=array(), $id = 0) {

		$object = $item->object;
		$type = $item->type;
		$target = $item->target;
		$title = $item->title;
		$description = $item->description;
		$permalink = $item->url;
		$classes = $item->classes;
		$target_blank = "target='_blank'";

		$output .= "<li class='".  implode(" ", $item->classes) . "'>";


		// Add SPAN if no Permalink
		if( $permalink && $permalink != '#nolink' && !$target ) {
			$output .= '<a href="' . $permalink . '">';
		} else if ($permalink && $permalink != '#nolink' && $target) {
			$output .= '<a href="' . $permalink . '" target="_blank" >';
		}
		else {
			$output .= '<span>';
		}

		$output .= '<p class="hsmall uppercase">' . $title . '</p>';

		if( $description != '' && $depth == 0 ) {
			$output .= '<p class="description">' . $description . '</p>';
		}

		if( $permalink && $permalink != '#nolink' ) {
			$output .= '</a>';

			if (in_array('menu-item-has-children', $classes)) { 
				$output .= '<div class="sub-menu-wrapper"> ';
			}

		} else {
			$output .= '</span>';
			
			if (in_array('menu-item-has-children', $classes)) { 
				$output .= '<div class="sub-menu-wrapper"> ';
			}
		}


		// Add arrow to the li element
		$output .= '<svg xmlns="http://www.w3.org/2000/svg" width="15.953" height="11.156" viewBox="0 0 15.953 11.156">
  <path id="noun-arrow-5574219-FFFFFF" d="M315.891,395.817a.8.8,0,0,0-.176-.87l-4.787-4.787a.8.8,0,0,0-1.125,1.125l3.423,3.423H300.8a.8.8,0,1,0,0,1.6h12.439l-3.423,3.423a.8.8,0,0,0,0,1.125.784.784,0,0,0,.567.231.817.817,0,0,0,.566-.231l4.787-4.787a.763.763,0,0,0,.176-.263Z" transform="translate(-299.997 -389.926)" fill="#82cbe6"/>
</svg>';

		$output .= '</li>'; // Close the li tag

	}
}

// Funktion fürs Hauptmenü
class Walker_Main_Menu_Pointers extends Walker_Nav_Menu {

	function start_el(&$output, $item, $depth=0, $args=array(), $id = 0) {

		$image = get_field('bild', $item);
		$size = 'full';
		$url = $image ? $image['url'] : false;

		$object = $item->object;
		$type = $item->type;
		$target = $item->target;
		$title = $item->title;
		$description = $item->description;
		$permalink = $item->url;
		$classes = $item->classes;
		$hasImageSubMenu = "";
		$target_blank = "target='_blank'";
		$arrow = '<svg xmlns="http://www.w3.org/2000/svg" width="15.953" height="11.156"><path fill="#82cbe6" d="M15.894 5.891a.8.8 0 0 0-.176-.87L10.931.234a.8.8 0 0 0-1.125 1.125l3.423 3.423H.803a.8.8 0 1 0 0 1.6h12.439L9.819 9.805a.8.8 0 0 0 0 1.125.784.784 0 0 0 .567.231.817.817 0 0 0 .566-.231l4.787-4.787a.763.763 0 0 0 .176-.263Z"/></svg>';


		$output .= "<li class='".  implode(" ", $item->classes) . $hasImageSubMenu . "'>";

		//Add SPAN if no Permalink
		if( $permalink && $permalink != '#nolink' && !$target ) {
			$output .= '<a class="uppercase" href="' . $permalink . '">';
		} else if ($permalink && $permalink != '#nolink' && $target) {
			$output .= '<a class="uppercase" href="' . $permalink . '" target="_blank" >';
		}
		else {
			$output .= '<span>';
		}

		$output .= $title;

		if( $depth > 0 ) {
			$output .= $arrow;
		}

		if( $description != '' && $depth == 0 ) {
			$output .= '<small class="description">' . $description . '</small>';
		}

		if( $permalink && $permalink != '#nolink' ) {
			$output .= '</a>';

			if (in_array('menu-item-has-children', $classes)) { 
				$output .= '<div class="sub-menu-wrapper"> ';
			}

		} else {
			$output .= '</span>';
		}

		if( $image ) {
			$output .= '<div class="sub-menu-image-wrapper"><img class="sub-menu-image" src="' . $url . '" alt="' . $title . '" ></div>' ;
		}
	}
}

/*Add Page Overlay for Menu*/

add_action('wp_footer', 'add_overlay_element'); 
function add_overlay_element() { 
	echo '<div class="overlay"></div>'; 
}

//Menü Einträge automatisch hinzufügen

/** $custom_post_types = array(
	'wissen' => array(
		'class_name' => 'wissen-menu',
		'post_name' => 'wissen'
	),
	'mitarbeiter' => array(
		'class_name' => 'mitarbeiter',
		'post_name' => 'mitarbeiter-menu'
	)
);

add_filter( 'wp_get_nav_menu_items', 'nested_menu_filter',10, 3 );

function nested_menu_filter($items, $menu, $args) {
	global $custom_post_types;
	foreach ($custom_post_types as $post_type) {
		$post_name = $post_type['post_name'];
		$class_name = $post_type['class_name'];
		nested_menu_filter_items($items, $menu, $args,  $post_name, $class_name);
	}
}

function nested_menu_filter_items($items, $menu, $args,  $post_name, $class_name) {
	$child_items = array(); 
	$menu_order = count($items); 
	$parent_item_id = 0; 

	foreach ( $items as $item ) {
		if ( in_array($class_name, $item->classes) ){
			$parent_item_id = $item->ID;
		}
	}

	if($parent_item_id > 0){

		foreach (get_posts( 'post_type=' . $post_name . 'numberposts=-1' ) as $post) {
			$post->menu_item_parent = $parent_item_id;
			$post->post_type = 'nav_menu_item';
			$post->object = 'custom';
			$post->type = 'custom';
			$post->menu_order = ++$menu_order;
			$post->title = $post->post_title;
			$post->url = get_permalink( $post->ID );
			array_push($child_items, $post);
		}
	}
	return array_merge( $items, $child_items );
} **/

?>