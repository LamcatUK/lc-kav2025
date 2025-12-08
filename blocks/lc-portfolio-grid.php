<?php
/**
 * Block template for LC Portfolio Grid.
 *
 * @package lc-kav2025
 */

defined( 'ABSPATH' ) || exit;

?>
<section class="portfolio-grid">
	<div class="container py-5">
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
			<div class="col-md-3 portfolio-card" data-aos="fade" data-aos-delay="<?php echo esc_attr( $c * 100 ); ?>">
				<a class="portfolio-card__link" href="<?php the_permalink(); ?>">
					<div class="portfolio-card__media">
						<?php
						echo get_the_post_thumbnail(
							get_the_ID(),
							'large',
							array(
								'class' => 'portfolio-card__img',
								'alt'   => the_title_attribute( array( 'echo' => false ) ),
							)
						);
						?>
					</div>

					<div class="portfolio-card__overlay">
						<h3 class="portfolio-card__title fs-500"><?php the_title(); ?></h3>
					</div>
				</a>
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
