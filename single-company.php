<?php
/**
 * Template for displaying single companies.
 *
 * @package lc-kav2025
 */

defined( 'ABSPATH' ) || exit;
get_header();
?>
<main id="main" class="company">
	<section class="breadcrumbs fs-ui mb-4">
		<div class="container pt-4 pb-5">
        <?php
        if ( function_exists( 'yoast_breadcrumb' ) ) {
            yoast_breadcrumb( '<div id="breadcrumbs" class="my-2">', '</div>' );
        }
        ?>
		</div>
	</section>
	<article class="container pt-4 pb-5">
		<h1 class="h2"><?= esc_html( get_the_title() ); ?></h1>
		<?= wp_kses_post( get_the_content() ); ?>
		<?php
		$prev = get_previous_post();
		$next = get_next_post();
		// Determine the correct Bootstrap class for alignment.
		if ( $prev && $next ) {
			$justify_class = 'justify-content-between'; // Both buttons → space them apart.
		} elseif ( $next ) {
			$justify_class = 'justify-content-end'; // Only Next → Align right.
		} else {
			$justify_class = 'justify-content-start'; // Only Previous → Align left.
		}
		?>
	</article>
	<div class="container mb-5">
		<div class="post-navigation mt-4 d-flex <?= esc_attr( $justify_class ); ?>">
			<?php
			if ( $prev ) {
				?>
			<a href="<?= esc_url( get_permalink( $prev ) ); ?>" class="btn btn--outline">← Previous</a>
				<?php
			}
			if ( $next ) {
				?>
			<a href="<?= esc_url( get_permalink( $next ) ); ?>" class="btn btn--outline">Next →</a>
				<?php
			}
			?>
		</div>
	</div>
</main>
<?php
get_footer();
?>