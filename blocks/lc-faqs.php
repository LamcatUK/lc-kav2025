<?php
/**
 * Block template for LC FAQs.
 *
 * @package lc-kav2025
 */

defined( 'ABSPATH' ) || exit;

?>
<section class="faqs has-light-grey-background-color" itemscope itemtype="https://schema.org/FAQPage">
	<div class="container py-5">
		<h2 class="text-center fs-600 mb-4" data-aos="fade"><?= esc_html( get_field( 'title' ) ); ?></h2>
		<?php
		if ( have_rows( 'faqs' ) ) {
			$c = 0;
			?>
			<div class="faqs__container">
				<?php
				while ( have_rows( 'faqs' ) ) {
					the_row();
					?>
					<div class="faqs__item mb-3" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question" data-aos="fade-up" data-aos-delay="<?php echo esc_attr( $c * 100 ); ?>">
						<div class="faqs__icon"></div>
						<h3 class="faqs__question fs-500 mb-2" itemprop="name">
							<?= esc_html( get_sub_field( 'question' ) ); ?>
						</h3>
						<div class="faqs__answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
							<div itemprop="text">
								<?= wp_kses_post( get_sub_field( 'answer' ) ); ?>
							</div>
						</div>
					</div>
					<?php
				}
				?>
			</div>
			<?php
		}
		?>
	</div>
</section>