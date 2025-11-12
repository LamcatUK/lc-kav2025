<?php
/**
 * Block template for LC Fixed Text Image.
 *
 * @package lc-kav2025
 */

defined( 'ABSPATH' ) || exit;

$bg_id  = get_field( 'background' );
$bg_url = wp_get_attachment_image_url( $bg_id, 'full' );

?>
<style>
.fixed-text-image {
	--_bg: <?= $bg_url ? 'url(' . esc_url( $bg_url ) . ')' : 'none'; ?>;
}
</style>
<section class="fixed-text-image">
	<div class="overlay"></div>
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<div class="fixed-text-image__img-container" data-aos="fade">
					<?=
					wp_get_attachment_image(
						get_field( 'image' ),
						'full',
						false,
						array(
							'class' => 'fixed-text-image__img',
						)
					);
					?>
				</div>
			</div>
			<div class="col-md-6 py-5">
				<h2 class="fs-600" data-aos="fade-up"><?= esc_html( get_field( 'title' ) ); ?></h2>
				<div data-aos="fade-up" data-aos-delay="100"><?= wp_kses_post( get_field( 'content' ) ); ?></div>
				<?php
				if ( get_field( 'link' ) ) {
					$l = get_field( 'link' );
					?>
				<div data-aos="fade-up" data-aos-delay="200">
					<a href="<?= esc_url( $l['url'] ); ?>"
						class="btn-rr">
						<span><?= esc_html( $l['title'] ); ?></span>
					</a>
				</div>
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
document.addEventListener('DOMContentLoaded', function() {
	const fixedImage = document.querySelector('.fixed-text-image__img');
	if (fixedImage) {
		gsap.to(fixedImage, {
			scale: 1.1,
			duration: 20,
			ease: 'none'
		});
	}
});
</script>
		<?php
	}
);