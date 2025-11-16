<?php
/**
 * LC Content Grid template.
 *
 * @package lc-kav2025
 */

defined( 'ABSPATH' ) || exit;

$rows = array();
if ( function_exists( 'get_field' ) ) {
    $acf_rows = get_field( 'grid_rows' );
    if ( ! empty( $acf_rows ) && is_array( $acf_rows ) ) {
        $rows = $acf_rows;
    }
}

if ( empty( $rows ) ) {
    $rows = $block['data']['grid_rows'] ?? array();
}

if ( empty( $rows ) ) {
    return;
}

$wrapper_attributes = function_exists( 'get_block_wrapper_attributes' )
    ? get_block_wrapper_attributes( array( 'class' => 'content-grid' ) )
    : 'class="content-grid"';
?>
<section <?php echo wp_kses_post( $wrapper_attributes ); ?>>
    <div class="container">
        <?php
		foreach ( $rows as $row_index => $row ) {
            $modules = array();
            if ( is_array( $row ) && isset( $row['modules'] ) && is_array( $row['modules'] ) ) {
                $modules = $row['modules'];
            } elseif ( is_array( $row ) && isset( $row['module'] ) && is_array( $row['module'] ) ) {
                $modules = $row['module'];
            }
            if ( empty( $modules ) ) {
                continue;
            }
            ?>
            <div class="row g-5 pb-5">
                <?php
				foreach ( $modules as $module_index => $module ) {
                    $mtype = is_array( $module ) ? ( $module['module_type'] ?? $module['type'] ?? '' ) : '';

                    $width  = intval( is_array( $module ) ? ( $module['column_width'] ?? 12 ) : 12 );
                    $offset = intval( is_array( $module ) ? ( $module['column_offset'] ?? 0 ) : 0 );

                    if ( $width < 1 || $width > 12 ) {
                        $width = 12;
                    }
                    if ( $offset < 0 ) {
                        $offset = 0;
                    }
                    if ( $offset > 11 ) {
                        $offset = 11;
                    }
                    if ( $width + $offset > 12 ) {
                        $offset = max( 0, 12 - $width );
                    }

                    $col_classes = array( 'col-md-' . esc_attr( $width ) );
                    if ( $offset ) {
                        $col_classes[] = 'offset-md-' . esc_attr( $offset );
                    }

                    // Render module wrapper.
                    ?>
                    <div class="<?php echo esc_attr( implode( ' ', $col_classes ) ); ?>" data-aos="fade-up">
                        <?php
                        if ( 'image' === strtolower( $mtype ) ) {
                            $image_id = is_array( $module ) ? ( $module['image'] ?? null ) : null;
                            $caption  = is_array( $module ) ? ( $module['caption'] ?? '' ) : '';
                            $aspect   = is_array( $module ) ? ( $module['aspect_ratio'] ?? '' ) : '';

                            switch ( $aspect ) {
                                case '21x9':
                                    $aspect_class = 'ratio ratio-21x9';
                                    break;
                                case '16x9':
                                    $aspect_class = 'ratio ratio-16x9';
                                    break;
                                case '4x3':
                                    $aspect_class = 'ratio ratio-4x3';
                                    break;
                                case '1x1':
                                    $aspect_class = 'ratio ratio-1x1';
                                    break;
                                default:
                                    $aspect_class = '';
                                    break;
                            }

                            if ( $image_id ) {
                                $alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
                                if ( empty( $alt ) ) {
                                    $caption_alt = wp_get_attachment_caption( $image_id );
                                    if ( ! empty( $caption_alt ) ) {
                                        $alt = $caption_alt;
                                    } else {
                                        $alt = get_the_title( $image_id );
                                    }
                                }

                                $img_attrs = array(
                                    'class' => 'img-fluid',
                                    'alt'   => esc_attr( $alt ),
                                );
                                ?>
                                <figure class="img-cover <?php echo esc_attr( $aspect_class ); ?>">
                                    <?= wp_get_attachment_image( $image_id, 'full', false, $img_attrs ); ?>
                                </figure>
                                <?php
                            }
                        } elseif ( 'text' === strtolower( $mtype ) ) {
                            $text = is_array( $module ) ? ( $module['text'] ?? '' ) : '';
                            echo wp_kses_post( do_shortcode( $text ) );

                        } else {
                            $text = is_array( $module ) ? ( $module['text'] ?? '' ) : '';
                            if ( $text ) {
                                echo wp_kses_post( do_shortcode( $text ) );
                            }
                        }
                        ?>
                    </div>
            	    <?php
				} /* end foreach modules */
				?>
            </div>
	        <?php
		} /* end foreach rows */
		?>
    </div>
</section>

