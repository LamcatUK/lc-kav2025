<?php
/**
 * File responsible for registering custom ACF blocks and modifying core block arguments.
 *
 * @package lc-kav2025
 */

/**
 * Registers custom ACF blocks.
 *
 * This function checks if the ACF plugin is active and registers custom blocks
 * for use in the WordPress block editor. Each block has its own name, title,
 * category, icon, render template, and supports various features.
 */
function acf_blocks() {
    if ( function_exists( 'acf_register_block_type' ) ) {

		// INSERT NEW BLOCKS HERE.

        acf_register_block_type(
            array(
                'name'            => 'lc_yt_embed',
                'title'           => __( 'LC YT Embed' ),
                'category'        => 'layout',
                'icon'            => 'cover-image',
                'render_template' => 'blocks/lc-yt-embed.php',
                'mode'            => 'preview',
                'supports'        => array(
                    'mode'      => true,
                    'anchor'    => true,
                    'className' => true,
                    'align'     => true,
                ),
            )
        );

        acf_register_block_type(
            array(
                'name'            => 'lc_portfolio_grid',
                'title'           => __( 'LC Portfolio Grid' ),
                'category'        => 'layout',
                'icon'            => 'cover-image',
                'render_template' => 'blocks/lc-portfolio-grid.php',
                'mode'            => 'edit',
                'supports'        => array(
                    'mode'      => false,
                    'anchor'    => true,
                    'className' => true,
                    'align'     => true,
                ),
            )
        );

        acf_register_block_type(
            array(
                'name'            => 'lc_two_cta_cards',
                'title'           => __( 'LC Two CTA Cards' ),
                'category'        => 'layout',
                'icon'            => 'cover-image',
                'render_template' => 'blocks/lc-two-cta-cards.php',
                'mode'            => 'edit',
                'supports'        => array(
                    'mode'      => false,
                    'anchor'    => true,
                    'className' => true,
                    'align'     => true,
                ),
            )
        );

        acf_register_block_type(
            array(
                'name'            => 'lc_page_hero',
                'title'           => __( 'LC Page Hero' ),
                'category'        => 'layout',
                'icon'            => 'cover-image',
                'render_template' => 'blocks/lc-page-hero.php',
                'mode'            => 'edit',
                'supports'        => array(
                    'mode'      => false,
                    'anchor'    => true,
                    'className' => true,
                    'align'     => true,
                ),
            )
        );

        acf_register_block_type(
            array(
                'name'            => 'lc_content_grid',
                'title'           => __( 'LC Content Grid' ),
                'category'        => 'layout',
                'icon'            => 'cover-image',
                'render_template' => 'blocks/lc-content-grid.php',
                'mode'            => 'edit',
                'supports'        => array(
                    'mode'      => false,
                    'anchor'    => true,
                    'className' => true,
                    'align'     => true,
                    'color'     => array(
                        'text'       => true,
                        'background' => true,
                        'gradients'  => false,
                    ),
                ),
            )
        );

        acf_register_block_type(
            array(
                'name'            => 'lc_feed_container',
                'title'           => __( 'LC Feed Container' ),
                'category'        => 'layout',
                'icon'            => 'cover-image',
                'render_template' => 'blocks/lc-feed-container.php',
                'mode'            => 'edit',
                'supports'        => array(
                    'mode'      => false,
                    'anchor'    => true,
                    'className' => true,
                    'align'     => true,
                ),
            )
        );

        acf_register_block_type(
            array(
                'name'            => 'lc_faqs',
                'title'           => __( 'LC FAQs' ),
                'category'        => 'layout',
                'icon'            => 'cover-image',
                'render_template' => 'blocks/lc-faqs.php',
                'mode'            => 'edit',
                'supports'        => array(
                    'mode'      => false,
                    'anchor'    => true,
                    'className' => true,
                    'align'     => true,
                ),
            )
        );

        acf_register_block_type(
            array(
                'name'            => 'lc_cta',
                'title'           => __( 'LC CTA' ),
                'category'        => 'layout',
                'icon'            => 'cover-image',
                'render_template' => 'blocks/lc-cta.php',
                'mode'            => 'edit',
                'supports'        => array(
                    'mode'      => false,
                    'anchor'    => true,
                    'className' => true,
                    'align'     => true,
                ),
            )
        );

        acf_register_block_type(
            array(
                'name'            => 'lc_featured_in',
                'title'           => __( 'LC Featured In' ),
                'category'        => 'layout',
                'icon'            => 'cover-image',
                'render_template' => 'blocks/lc-featured-in.php',
                'mode'            => 'edit',
                'supports'        => array(
                    'mode'      => false,
                    'anchor'    => true,
                    'className' => true,
                    'align'     => true,
                ),
            )
        );

        acf_register_block_type(
            array(
                'name'            => 'lc_latest_media',
                'title'           => __( 'LC Latest Media' ),
                'category'        => 'layout',
                'icon'            => 'cover-image',
                'render_template' => 'blocks/lc-latest-media.php',
                'mode'            => 'edit',
                'supports'        => array(
                    'mode'      => false,
                    'anchor'    => true,
                    'className' => true,
                    'align'     => true,
                ),
            )
        );

        acf_register_block_type(
            array(
                'name'            => 'lc_fixed_text_image',
                'title'           => __( 'LC Fixed Text Image' ),
                'category'        => 'layout',
                'icon'            => 'cover-image',
                'render_template' => 'blocks/lc-fixed-text-image.php',
                'mode'            => 'edit',
                'supports'        => array(
                    'mode'      => false,
                    'anchor'    => true,
                    'className' => true,
                    'align'     => true,
                ),
            )
        );

        acf_register_block_type(
            array(
                'name'            => 'lc_portfolio_list',
                'title'           => __( 'LC Portfolio List' ),
                'category'        => 'layout',
                'icon'            => 'cover-image',
                'render_template' => 'blocks/lc-portfolio-list.php',
                'mode'            => 'edit',
                'supports'        => array(
                    'mode'      => false,
                    'anchor'    => true,
                    'className' => true,
                    'align'     => true,
                ),
            )
        );

        acf_register_block_type(
            array(
                'name'            => 'lc_home_hero',
                'title'           => __( 'LC Home Hero' ),
                'category'        => 'layout',
                'icon'            => 'cover-image',
                'render_template' => 'blocks/lc-home-hero.php',
                'mode'            => 'edit',
                'supports'        => array(
                    'mode'      => false,
                    'anchor'    => true,
                    'className' => true,
                    'align'     => true,
                ),
            )
        );

        acf_register_block_type(
            array(
                'name'            => 'lc_text_image',
                'title'           => __( 'LC Text Image' ),
                'category'        => 'layout',
                'icon'            => 'cover-image',
                'render_template' => 'blocks/lc-text-image.php',
                'mode'            => 'edit',
                'supports'        => array(
                    'mode'      => false,
                    'anchor'    => true,
                    'className' => true,
                    'align'     => true,
                ),
            )
        );
    }
}
add_action( 'acf/init', 'acf_blocks' );

// Auto-sync ACF field groups from acf-json folder.
add_filter(
    'acf/settings/save_json',
    function () {
        // Always write ACF JSON to the theme's acf-json directory so field groups
        // are versioned with the theme and predictable across environments.
        return get_stylesheet_directory() . '/acf-json';
    }
);

add_filter(
	'acf/settings/load_json',
	function ( $paths ) {
		unset( $paths[0] );
		$paths[] = get_stylesheet_directory() . '/acf-json';
		return $paths;
	}
);

/**
 * Modifies the arguments for specific core block types.
 *
 * @param array  $args The block type arguments.
 * @param string $name The block type name.
 * @return array Modified block type arguments.
 */
function core_block_type_args( $args, $name ) {

	if ( 'core/paragraph' === $name ) {
		$args['render_callback'] = 'modify_core_add_container';
	}
	if ( 'core/heading' === $name ) {
		$args['render_callback'] = 'modify_core_add_container';
	}
	if ( 'core/list' === $name ) {
		$args['render_callback'] = 'modify_core_add_container';
	}

    return $args;
}
add_filter( 'register_block_type_args', 'core_block_type_args', 10, 3 );

/**
 * Helper function to detect if footer.php is being rendered.
 *
 * @return bool True if footer.php is being rendered, false otherwise.
 */
function is_footer_rendering() {
    $backtrace = debug_backtrace( DEBUG_BACKTRACE_IGNORE_ARGS ); // phpcs:ignore -- debug_backtrace used intentionally
    foreach ( $backtrace as $trace ) {
        if ( isset( $trace['file'] ) && basename( $trace['file'] ) === 'footer.php' ) {
            return true;
        }
    }
    return false;
}

/**
 * Adds a container div around the block content unless footer.php is being rendered.
 *
 * @param array  $attributes The block attributes.
 * @param string $content    The block content.
 * @return string The modified block content wrapped in a container div.
 */
function modify_core_add_container( $attributes, $content ) {
    if ( is_footer_rendering() ) {
        return $content;
    }

    ob_start();
    ?>
    <div class="container">
        <?= wp_kses_post( $content ); ?>
    </div>
	<?php
	$content = ob_get_clean();
    return $content;
}
