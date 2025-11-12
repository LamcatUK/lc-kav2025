<?php
/**
 * Block template for LC Feed Container.
 *
 * @package lc-kav2025
 */

defined( 'ABSPATH' ) || exit;

?>
<section class="feed py-5">
	<div class="container">
		<?= do_shortcode( get_field( 'feed_shortcode' ) ); ?>
	</div>
</section>