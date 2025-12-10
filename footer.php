<?php
/**
 * Footer template for the Harrier Gates 2025 theme.
 *
 * This file contains the footer section of the theme, including navigation menus,
 * office addresses, and colophon information.
 *
 * @package lc-kav2025
 */

defined( 'ABSPATH' ) || exit;
?>
<div id="footer-top"></div>

<footer class="footer pt-5 pb-3">
    <div class="container">
        <div class="row pb-4 g-4">
			<div class="col-sm-4">
				<img src="<?= esc_url( get_stylesheet_directory_uri() . '/img/kunal-vyas-logo--web-wo.svg' ); ?>" alt="Kunal A Vyas" class="mb-4 d-block" width="175" height="112">
            </div>
            <div class="col-sm-4">
                <?=
				wp_nav_menu(
					array(
						'theme_location' => 'footer_menu1',
						'menu_class'     => 'footer__menu',
					)
				);
				?>
            </div>
            <div class="col-sm-4 footer__contact">
                <div class="footer-title">Connect</div>
				<?= do_shortcode( '[social_icons class="d-flex justify-content-center gap-3 fs-h3"]' ); ?>
            </div>
        </div>

        <div class="colophon d-flex justify-content-between align-items-center flex-wrap">
            <div>
                &copy; <?= esc_html( gmdate( 'Y' ) ); ?> kunalavyas. All rights reserved.
            </div>
            <div>
				<a href="/terms-of-use/">Terms of use</a> | <a href="/privacy-policy/">Privacy</a> & <a href="/cookie-policy/">Cookies</a>
            </div>
        </div>
</footer>
<?php wp_footer(); ?>
</body>

</html>