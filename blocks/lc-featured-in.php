<?php
/**
 * Block template for LC Featured In.
 *
 * @package lc-kav2025
 */

defined( 'ABSPATH' ) || exit;

?>
<section class="featured-in py-5">
	<div class="container featured-in__marquee" data-aos="fade">
		<h2 class="text-center fs-600 text-white mb-4">featured in</h2>
		<div class="featured-in__track">
			<div class="swiper-wrapper">
				<?php
				$logos = get_field( 'featured_in', 'option' );
				if ( $logos ) {
					foreach ( $logos as $logo ) {
						?>
				<div class="swiper-slide">
						<?=
						wp_get_attachment_image(
							$logo,
							'full',
							false,
							array(
								'class' => 'featured-in__logo img-fluid',
								'alt'   => get_post_meta(
									$logo,
									'_wp_attachment_image_alt',
									true
								),
							)
						);
						?>
				</div>
						<?php
					}
				}
				?>
			</div>
		</div>
	</div>
</section>
<?php
add_action(
	'wp_footer',
	function () {
		?>
<script>
document.addEventListener('DOMContentLoaded', function() {
	var wrapper = document.querySelector('.featured-in__track .swiper-wrapper');
	if (!wrapper) return;
	var wrapperWidth = wrapper.scrollWidth;
	var container = document.querySelector('.featured-in__marquee');
	var containerWidth = container.offsetWidth;
	// Duplicate logos for seamless loop if needed
	if (wrapperWidth < containerWidth * 2) {
		wrapper.innerHTML += wrapper.innerHTML;
		wrapperWidth = wrapper.scrollWidth;
	}
	var pxPerSecond = 80; // Adjust for desired speed
	var distance = wrapperWidth / 2;
	var duration = distance / pxPerSecond;
	gsap.to(wrapper, {
		x: -distance,
		duration: duration,
		ease: 'none',
		repeat: -1,
	});
});
</script>
		<?php
	}
);