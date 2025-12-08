<?php
/**
 * Block template for LC Two CTA Cards.
 *
 * @package lc-kav2025
 */

defined( 'ABSPATH' ) || exit;

?>
<section class="two-cta-cards">
	<div class="has-blue-dots--left"></div>
	<div class="container py-5">
		<div class="row">
			<div class="col-md-6">
				<div class="card has-light-grey-background-color has-background-color h-100">
					<div class="card-body d-flex flex-column">
						<h3><?= get_field( 'title_1' ); ?></h3>
						<div class="mb-4"><?= wp_kses_post( get_field( 'content_1' ) ); ?></div>
						<?php
						$l1 = get_field( 'link_1' );
						?>
						<a href="<?= esc_url( $l1['url'] ); ?>"
							class="btn-rr mt-auto align-self-start">
							<span><?= esc_html( $l1['title'] ); ?></span>
						</a>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="card has-light-grey-background-color has-background-color h-100">
					<div class="card-body d-flex flex-column">
						<h3><?= get_field( 'title_2' ); ?></h3>
						<div class="mb-4"><?= wp_kses_post( get_field( 'content_2' ) ); ?></div>
						<?php
						$l2 = get_field( 'link_2' );
						?>
						<a href="<?= esc_url( $l2['url'] ); ?>"
							class="btn-rr mt-auto align-self-start">
							<span><?= esc_html( $l2['title'] ); ?></span>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>