<?php
/**
 * Block template for LC Portfolio List.
 *
 * @package lc-kav2025
 */

defined( 'ABSPATH' ) || exit;

?>
<section class="portfolio-list my-5">
	<div class="container">
		<h2 class="text-center fs-600" data-aos="fade">brief history</h2>
		<div class="row">
			<?php
			$c = 0;
			$q = new WP_Query(
				array(
					'post_type'      => 'company',
					'posts_per_page' => -1,
					'orderby'        => 'menu_order',
					'order'          => 'ASC',
				)
			);
			if ( $q->have_posts() ) {
				while ( $q->have_posts() ) {
					$q->the_post();
					?>
			<div class="col-md-6 col-lg-3 mb-4">
					<?=
					get_the_post_thumbnail(
						get_the_ID(),
						'full',
						array(
							'class'          => 'portfolio-list__img img-fluid',
							'data-aos'       => 'fade',
							'data-aos-delay' => $c * 100,
						)
					);
					?>
			</div>
					<?php
					++$c;
				}
				wp_reset_postdata();
			}
			?>
		</div>
	</div>
</section>