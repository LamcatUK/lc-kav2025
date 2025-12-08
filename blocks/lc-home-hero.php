<?php
/**
 * Block template for LC Home Hero.
 *
 * @package lc-kav2025
 */

defined( 'ABSPATH' ) || exit;

?>
<section class="home-hero">
	<div class="home-hero__lined-circle"></div>
	<div class="home-hero__blue-dots"></div>
	<div class="container pt-5">
		<div class="row align-items-center">
			<div class="col-lg-6">
				<h2 class="home-hero__title mb-4" 
					data-typewriter="<?= esc_attr( get_field( 'hero_quote' ) ); ?>">
				</h2>
				<h1 class="home-hero__subtitle">
					Kunal A. Vyas
				</h1>
			</div>
			<div class="col-lg-6 home-hero__image-wrapper mt-5 mt-lg-0">
				<?php
				$hero_image = get_field( 'hero_image' );
				if ( $hero_image ) {
					?>
					<img src="<?= esc_url( $hero_image['url'] ); ?>"
						alt="<?= esc_attr( $hero_image['alt'] ); ?>"
						class="home-hero__image img-fluid mx-auto d-block">
					<?php
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
	// Typewriter effect for home hero
	document.addEventListener('DOMContentLoaded', function() {
		// Wait for GSAP to be available
		if (typeof gsap === 'undefined') {
			console.warn('GSAP not loaded');
			return;
		}

		var typewriterElement = document.querySelector('[data-typewriter]');
		var subtitleElement = document.querySelector('.home-hero__subtitle');
		
		if (!typewriterElement) {
			console.warn('Typewriter element not found');
			return;
		}
		
		var text = typewriterElement.getAttribute('data-typewriter');
		
		if (!text) {
			console.warn('No text to type');
			return;
		}
		
		// Register GSAP TextPlugin
		gsap.registerPlugin(TextPlugin);
		
		// Set initial states
		typewriterElement.textContent = '';
		if (subtitleElement) {
			gsap.set(subtitleElement, { opacity: 0 });
		}
		
		// Split text by periods and type each segment
		var segments = text.split('.');
		var typewriterDelay = 0.5;
		
		// Create timeline
		var tl = gsap.timeline();
		
		// Type each segment with pause after periods
		var currentText = '';
		segments.forEach(function(segment, index) {
			if (segment.trim().length > 0) {
				currentText += segment + (index < segments.length - 1 ? '.' : '');
				
				tl.to(typewriterElement, {
					duration: (segment.length + 1) * 0.05,
					text: {
						value: currentText,
						delimiter: ''
					},
					ease: 'none',
					delay: index === 0 ? typewriterDelay : 0.3
				});
			}
		});
		
		// Subtitle fade-in animation
		if (subtitleElement) {
			tl.to(subtitleElement, {
				duration: 0.3,
				opacity: 1,
				ease: 'power2.out',
				delay: 0.5
			});
		}
	});
</script>
		<?php
	}
);
