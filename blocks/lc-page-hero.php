<?php
/**
 * Block template for LC Page Hero.
 *
 * @package lc-kav2025
 */

defined( 'ABSPATH' ) || exit;

?>
<section class="page-hero">
	<div class="page-hero__lined-circle"></div>
	<div class="page-hero__blue-dots"></div>
	<div class="container pt-5">
		<div class="row align-items-center">
			<div class="col-lg-6">
				<h1><?= esc_html( get_field( 'title' ) ); ?></h1>
			</div>
			<div class="col-lg-6 page-hero__image-wrapper mt-5 mt-lg-0">
				<?php
				$hero_image = get_field( 'hero_image' );
				if ( $hero_image ) {
					?>
					<img src="<?= esc_url( $hero_image['url'] ); ?>"
						alt="<?= esc_attr( $hero_image['alt'] ); ?>"
						class="page-hero__image img-fluid mx-auto d-block">
					<?php
				}
				?>
			</div>
		</div>
	</div>
</section>