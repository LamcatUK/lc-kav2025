<?php
/**
 * Block template for LC Latest Media.
 *
 * @package lc-kav2025
 */

defined( 'ABSPATH' ) || exit;

?>
<section class="latest-media">
	<div class="container py-5">
		<h2 class="text-center fs-600 text-white mb-4" data-aos="fade">Media</h2>
		<div class="row g-5">
			<?php
			$q = new WP_Query(
				array(
					'post_type'      => 'post',
					'posts_per_page' => 6,
					'orderby'        => 'date',
					'order'          => 'DESC',
				)
			);
			if ( $q->have_posts() ) {
				$counter = 0;
				while ( $q->have_posts() ) {
					$q->the_post();
					++$counter;
					switch ( $counter ) {
						case 1:
							$col_class = 'col-md-4 col-lg-3 latest-media__card-1';
							break;
						case 2:
							$col_class = 'col-md-8 col-lg-6 latest-media__card-2';
							break;
						case 3:
							$col_class = 'col-md-8 col-lg-3 latest-media__card-3';
							break;
						case 4:
							$col_class = 'col-md-4 col-lg-6 latest-media__card-4';
							break;
						case 5:
							$col_class = 'col-md-6 col-lg-3 latest-media__card-5';
							break;
						case 6:
							$col_class = 'col-md-6 col-lg-3 latest-media__card-6';
							break;
						default:
							$col_class = 'col-md-6';
							break;
					}

					?>
			<div class="<?php echo esc_attr( $col_class ); ?>">			
				<a href="<?php echo esc_url( get_permalink() ); ?>" class="latest-media__card" data-aos="fade-up" data-aos-delay="<?php echo esc_attr( $counter * 100 ); ?>">
					<div class="latest-media__image-wrapper">
						<?php
						if ( get_the_post_thumbnail( get_the_ID() ) ) {
							echo get_the_post_thumbnail(
								get_the_ID(),
								'full',
								array(
									'class' => 'latest-media__image',
									'alt'   => get_post_meta( get_post_thumbnail_id( get_the_ID() ), '_wp_attachment_image_alt', true ),
								)
							);
						} else {
							echo '<img src="' . esc_url( get_stylesheet_directory_uri() . '/img/default-post-image.png' ) . '" alt="" class="latest-media__image" />';
						}
						?>
					</div>
					<div class="latest-media__content">
						<div class="latest-media__type">
							<?php
							$categories = get_the_category();
							if ( ! empty( $categories ) ) {
								echo esc_html( $categories[0]->name );
							}
							?>
						</div>
						<div class="latest-media__title">
							<?php the_title(); ?>
						</div>
						<!-- <div class="latest-media__excerpt">
							<?php echo wp_kses_post( wp_trim_words( get_the_excerpt(), 18, '...' ) ); ?>
						</div> -->
					</div>
				</a>	
			</div>
					<?php
				}
				wp_reset_postdata();
			}
			?>
		</div>
	</div>
</section>