<?php
add_shortcode( 'header_search', 'add_header_search' );

function add_header_search () {ob_start();
	return get_template_part('templates/blocks/search-products');
}
