<?php
/**
 * Template for displaying the blog index page.
 *
 * @package lc-kav2025
 */

defined( 'ABSPATH' ) || exit;

$page_for_posts = get_option( 'page_for_posts' );

get_header();
?>
<main id="main">
	<?php
	$post      = get_post($page_for_posts);
	$cta_block = '';

	if ( $post ) {
		// Check if lc-cta block exists and extract it before applying filters.
		if ( has_block( 'acf/lc-cta', $post ) ) {
			$blocks          = parse_blocks( $post->post_content );
			$filtered_blocks = array();

			foreach ( $blocks as $block ) {
				if ( 'acf/lc-cta' === $block['blockName'] ) {
					$cta_block = render_block( $block );
				} else {
					$filtered_blocks[] = $block;
				}
			}

			// Rebuild content without the CTA block.
			$post->post_content = serialize_blocks( $filtered_blocks );
		}

		$content = apply_filters('the_content', $post->post_content);
		echo $content;
	}
	?>
	<section class="latest-posts mt-5">
		<div class="container pb-5">
			<?php
			// phpcs:disable
            // Get all categories for filter buttons.
            $all_categories = get_categories(
				array(
					'hide_empty' => true,
					'orderby'    => 'name',
					'order'      => 'ASC',
				)
			);

            if ( ! empty( $all_categories ) ) {
                ?>
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="filter-buttons">
                            <button class="btn btn-outline-primary filter-btn active" data-filter="all">All</button>
                            <?php
							foreach ( $all_categories as $category ) {
								?>
                                <button class="btn btn-outline-primary filter-btn" data-filter="<?= esc_attr( $category->slug ); ?>"><?= esc_html( $category->name ); ?></button>
                            	<?php
							}
							?>
                        </div>
                    </div>
                </div>
                <?php
            }
			// phpcs:enable
			?>
			<div class="row g-4 w-100">
			<?php
			$args = array(
				'post_type'      => 'post',
				'post_status'    => array( 'publish' ),
				'orderby'        => 'date',
				'order'          => 'DESC', // Descending order.
				'posts_per_page' => -1,    // Get all posts.
			);

			$q = new WP_Query( $args );

			if ( $q->have_posts() ) {
				$d = 0;
				while ( $q->have_posts() ) {
					$q->the_post();
					// get categories.
					$categories = get_the_category();
					if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) {
						// get space separated list of category slugs.
						$first_category = $categories[0];
						// If there are multiple categories, use the first one.
						if ( count( $categories ) > 1 ) {
							// Get the first category slug.
							$categories = array_slice( $categories, 0, 1 );
						}
						// Convert to space separated list.
						$categories = implode( ' ', wp_list_pluck( $categories, 'slug' ) );
					}
					?>
					<div class="col-md-6 col-lg-4" data-aos="fade" data-aos-delay="<?= esc_attr( $d ); ?>" data-category="<?= esc_attr( $categories ); ?>">
						<a href="<?= esc_url( get_permalink() ); ?>" class="latest-posts__item">
							<div class="latest-posts__img-wrapper">
								<?= get_the_post_thumbnail( get_the_ID(), 'large', array( 'class' => 'latest-posts__image' ) ); ?>
								<div class="latest-posts__pill"><?= esc_html( $first_category->name ); ?></div>
							</div>
							<div class="latest-posts__inner">
								<h3><?= esc_html( get_the_title() ); ?></h3>
								<div class="latest-posts__meta">
									<?= esc_html( get_the_date( 'jS F Y' ) ); ?>
								</div>
							</div>
						</a>
					</div>
					<?php
					$d += 100;
				}
			} else {
				echo '<p>No posts found.</p>';
			}
			wp_reset_postdata();
			?>
			</div>
		</div>
	</section>
	<?php
	// Output the CTA block if it was found.
	if ( ! empty( $cta_block ) ) {
		echo $cta_block;
	}
	?>
</main>
<script>
document.addEventListener('DOMContentLoaded', function() {
	const filterButtons = document.querySelectorAll('.filter-btn');
	const posts = document.querySelectorAll('[data-category]');

	// Add post-item class to all posts
	posts.forEach(post => {
		post.classList.add('post-item');
	});

	filterButtons.forEach(button => {
		button.addEventListener('click', function() {
			const filterValue = this.getAttribute('data-filter');
			
			// Update active button
			filterButtons.forEach(btn => btn.classList.remove('active'));
			this.classList.add('active');
			
			// Filter posts
			posts.forEach(post => {
				const postCategories = post.getAttribute('data-category');
				const shouldShow = filterValue === 'all' || (postCategories && postCategories.includes(filterValue));
				
				if (shouldShow) {
					post.style.display = 'block';
				} else {
					post.style.display = 'none';
				}
			});
		});
	});
});
</script>

<?php

get_footer();
?>