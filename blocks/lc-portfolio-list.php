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
		<?php
		if ( get_field( 'title' ) ) {
			?>
		<h2 class="text-center fs-600 mb-4" data-aos="fade"><?= esc_html( get_field( 'title' ) ); ?></h2>
			<?php
		}
		?>
		<div class="portfolio-list__grid">
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
					$show_teaser = get_field( 'show_teaser', get_the_ID() );
					$excerpt     = get_the_excerpt();
					?>
			<article class="portfolio-card" data-aos="fade" data-aos-delay="<?php echo esc_attr( $c * 80 ); ?>">
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
						<?php if ( $show_teaser ) : ?>
							<div class="portfolio-card__excerpt"><?php echo wp_kses_post( wp_trim_words( $excerpt, 30 ) ); ?></div>
						<?php endif; ?>
					</div>
				</a>
			</article>
					<?php
					++$c;
				}
				wp_reset_postdata();
			}
			?>
		</div>
	</div>
</section>