<?php
/**
 * FAQ Block Template.
 *
 * @package lc-iology2025
 */

defined( 'ABSPATH' ) || exit;

$acc    = random_str( 8 );
$anchor = $block['anchor'] ?? '';

if ( $anchor ) {
	?>
<a id="<?= esc_attr( $anchor ); ?>" class="anchor"></a>
	<?php
}
?>
<!-- faq -->
<section class="faqs has-light-grey-background-color py-5">
	<div class="container-xl">
		<?php
		if ( get_field( 'title' ) ) {
			?>
		<h2 class="fs-600 text-center mb-4">
			<?= esc_html( get_field( 'title' ) ); ?>
		</h2>
			<?php
		}
		if ( get_field( 'faq_introduction' ) ) {
			?>
		<div class="row">
			<div class="col-lg-6 offset-lg-3 mb-4 text-center">
				<?= wp_kses_post( get_field( 'faq_introduction' ) ); ?>
			</div>
		</div>
			<?php
		}
		?>
		<div itemscope="" itemtype="https://schema.org/FAQPage" id="faqs" class="accordion accordion-flush">
			<?php
			$c = 0;
			while ( have_rows( 'faqs' ) ) {
				the_row();
				?>
			<div class="faq__card accordion-item" itemscope="" itemprop="mainEntity"
				itemtype="https://schema.org/Question">

				<div class="accordion-header" id="heading<?= esc_attr( $c ); ?>">

					<button class="accordion-button collapsed question" type="button" data-bs-toggle="collapse"
						itemprop="name" data-bs-toggle="collapse"
						data-bs-target="#c<?= esc_attr( $c ); ?>"
						aria-expanded="false">
						<h3><?= esc_html( get_sub_field( 'question' ) ); ?>
						</h3>
				</div>
				<div class="answer accordion-collapse collapse"
					id="c<?= esc_attr( $c ); ?>" itemscope="" data-bs-parent="#faqs"
					itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
					<div class="answer__inner px-3" itemprop="text">
						<?= wp_kses_post( get_sub_field( 'answer' ) ); ?>
					</div>
				</div>
			</div>
				<?php
				++$c;
			}
			?>
		</div>
	</div>
</section>
