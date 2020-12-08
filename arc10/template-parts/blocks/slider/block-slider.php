<?php

/**
 * Slider Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

$slider = 'slider-' . $block['id'];

if( have_rows('slider') ): ?>
	<div class="<?php echo esc_attr($slider); ?>">
		<?php
		// Loop through rows.
		while( have_rows('slider') ) : the_row();

			// Load sub field value.
			$title = get_sub_field('title');
			$text = get_sub_field('text');
			$image = get_sub_field('image');
			$url = get_sub_field('url'); ?>
		<div>
			<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>">
			<div class="caption">
				<div class="caption-title"><?php echo $title;?></div>
				<div class="caption-text"><?php echo $text;?>
					<?php if ($url) : ?>
					<br><a href="<?php echo $url;?>">Read More</a>
					<?php endif;?>
				</div>


			</div>
		</div>
		<?php endwhile; ?>
	</div>
	<script>
		jQuery(document).ready(function(){
			jQuery('.<?php echo esc_attr($slider); ?>').slick({
				autoplay:true,
				dots: true,
				fade: true,
				infinite: true,
				arrows: false,
				pauseOnFocus: false,
			});
		});
	</script>
<?php endif; ?>
