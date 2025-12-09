<?php
/**
 * Block template for LC YT Embed.
 *
 * @package lc-kav2025
 */

defined( 'ABSPATH' ) || exit;

$youtube_url = get_field( 'lc_yt_embed_url' );

// Convert YouTube watch URL to embed URL
if ( $youtube_url ) {
	// Extract video ID from various YouTube URL formats
	preg_match( '/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $youtube_url, $matches );
	$video_id = $matches[1] ?? '';
	
	if ( $video_id ) {
		$embed_url = 'https://www.youtube.com/embed/' . $video_id;
	} else {
		$embed_url = $youtube_url;
	}
} else {
	$embed_url = '';
}

?>
<div class="lc-yt-embed-wrapper">
	<?php if ( $embed_url ) : ?>
	<div class="ratio ratio-16x9">
		<iframe src="<?php echo esc_url( $embed_url ); ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
	</div>
	<?php endif; ?>
</div>