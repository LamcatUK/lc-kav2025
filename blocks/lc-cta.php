<?php
/**
 * Block template for LC CTA.
 *
 * @package lc-kav2025
 */

defined( 'ABSPATH' ) || exit;

$l = get_field( 'cta_link' );

?>
<section class="cta py-5">
	<div class="cta__lined-circle"></div>
	<div class="cta__blue-dots"></div>
	<div class="container">
		<div class="row g-5">
			<div class="col-lg-8 text-center">
				<h2 class="cta__title fs-900 mb-4" data-aos="fade-right">
					<?= esc_html( get_field( 'cta_title' ) ); ?>
				</h2>
				<div data-aos="fade-right" data-aos-delay="100">
					<a href="<?= esc_url( $l['url'] ); ?>"
						class="btn-rr">
						<span><?= esc_html( $l['title'] ); ?></span>
					</a>
				</div>
			</div>
			<div class="col-lg-4 text-center">
				<img src="<?= esc_url( get_stylesheet_directory_uri() . '/img/kav-logo--full.svg' ); ?>"
					alt="Kunal A. Vyas Logo"
					class="img-fluid cta__logo"
					width="200"
					height="auto"
					data-aos="fade-left"
					data-aos-delay="200">
			</div>
		</div>
	</div>
</section>