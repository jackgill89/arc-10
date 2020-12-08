<?php

/**
 * Testimonials Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

$testimonial = 'testimonial-' . $block['id'];
?>
<h4>Testimonials</h4>
<div class="<?php echo $testimonial; ?>" data-aos="fade-right">

	<?php
$args = array(
        'post_type' => 'testimonial',
        'post_status' => 'publish',
        'posts_per_page' => -1,
    );

    $loop = new WP_Query( $args );

    while ( $loop->have_posts() ) : $loop->the_post();
    ?>
	<div>
		<?php the_content(); ?>
        <p class="testimonial-author"><?php the_title();?></p>
	</div>
    <?php endwhile;

    wp_reset_postdata();
?>
</div>
<script>
	jQuery(document).ready(function(){
		jQuery('.<?php echo esc_attr($testimonial); ?>').slick({
			autoplay:true,
			dots: true,
			infinite: true,
			pauseOnFocus: true,
			arrows:false
		});
	});
</script>
