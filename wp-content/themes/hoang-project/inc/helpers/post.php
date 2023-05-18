<?php

function kesbie_get_post_data($post_id, $post_taxonomy = 'category', $excerpt_limit_words = 1000)
{

	$result = [];

	$post_object = get_post($post_id);

	//Get data
	$post_title = $post_object->post_title;
	$post_content = strip_tags($post_object->post_content);
	$post_excerpt = !empty($post_object->post_excerpt) ? $post_object->post_excerpt : wp_trim_words($post_content, $excerpt_limit_words, '...');
	$post_url = get_permalink($post_id);
	$post_image_id = has_post_thumbnail($post_id) ? get_post_thumbnail_id($post_id) : '';

	$post_categories = get_the_terms($post_id, $post_taxonomy);

	$post_category 		= null;
	$post_category_id 	= null;
	$post_category_name = null;
	$post_category_url 	= null;


	if (!empty($post_categories)) {
		$post_category 		= $post_categories[0];
		$post_category_id 	= $post_category->term_id;
		$post_category_name = $post_category->name;
		$post_category_url 	= get_term_link($post_category->term_id, $post_taxonomy);
	}

	$result = [
		'title' => $post_title,
		'content' => $post_content,
		'excerpt' => $post_excerpt,
		'url' => $post_url,
		'image_id' => $post_image_id,
		'category_id' => $post_category_id,
		'category_name' => $post_category_name,
		'category_url' => $post_category_url
	];

	return $result;
}
