<?php
add_action('acf/init', 'my_acf_init');
function my_acf_init(){
	if( function_exists('acf_register_block') ) {
		// register a services block.
		acf_register_block_type(array(
			'name' => 'slider',
			'title' => __('Slider'),
			'description' => __('Add a full screen image slider'),
			'render_callback' => 'slider_block_render_callback',
			'category' => 'widgets',
			'icon' => 'admin-comments',
			'keywords' => array('slider,images,image,sliders,full screen'),
			'mode' => 'edit',
		));
		acf_register_block_type(array(
			'name' => 'testimonial',
			'title' => __('Testimonials'),
			'description' => __('Add a testimonials slider'),
			'render_callback' => 'testimonial_block_render_callback',
			'category' => 'widgets',
			'icon' => 'admin-comments',
			'keywords' => array('testimonial, testimonials, slider, quote'),
			'mode' => 'edit',
		));
	}
}

function slider_block_render_callback( $block ) {
	$slug = str_replace('acf/', '', $block['name']);
	if( file_exists( get_theme_file_path("/template-parts/blocks/{$slug}/block-{$slug}.php") ) ) {
		include( get_theme_file_path("/template-parts/blocks/{$slug}/block-{$slug}.php") );
	}
}

function testimonial_block_render_callback( $block ) {
	$slug = str_replace('acf/', '', $block['name']);
	if( file_exists( get_theme_file_path("/template-parts/blocks/{$slug}/block-{$slug}.php") ) ) {
		include( get_theme_file_path("/template-parts/blocks/{$slug}/block-{$slug}.php") );
	}
}
?>
