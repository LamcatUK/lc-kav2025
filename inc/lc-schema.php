<?php
/**
 * LC Schema Markup
 *
 * Schema.org structured data output for better SEO and rich snippets.
 *
 * @package lc-kav2025
 */

defined( 'ABSPATH' ) || exit;

// Disable Yoast's organization schema completely.
add_filter( 'wpseo_schema_organization', '__return_false' );
add_filter( 'wpseo_schema_company_logo_id', '__return_false' );

/**
 * Clean Yoast schema.
 *
 * Removes Yoast's Organization and Person pieces,
 * and rewrites all Yoast references so they point
 * to the custom business entity (#business).
 */
add_filter(
	'wpseo_schema_graph_pieces',
	function ( $pieces, $context ) {

		foreach ( $pieces as $index => $piece ) {

			// Remove Yoast Organisation.
			if ( $piece instanceof \Yoast\WP\SEO\Generators\Schema\Organization ) {
				unset( $pieces[ $index ] );
				continue;
			}

			// Remove Yoast Person (author schema).
			if ( $piece instanceof \Yoast\WP\SEO\Generators\Schema\Person ) {
				unset( $pieces[ $index ] );
				continue;
			}

			// Remove WebPage schema on contact page.
			if ( is_page( 'contact' ) && $piece instanceof \Yoast\WP\SEO\Generators\Schema\WebPage ) {
				unset( $pieces[ $index ] );
				continue;
			}

			// Rewrite Yoast WebPage and WebSite references.
			if ( method_exists( $piece, 'context' ) ) {
				$context_data = $piece->context;
				$site_url     = get_site_url();

				// Replace Yoast's #organization ID with your #business ID.
				if ( isset( $context_data['id'] ) && false !== strpos( $context_data['id'], '#organization' ) ) {
					$context_data['id'] = $site_url . '/#business';
				}

				// Rewrite publisher.
				if ( isset( $context_data['publisher'] ) &&
					isset( $context_data['publisher']['@id'] ) &&
					false !== strpos( $context_data['publisher']['@id'], '#organization' )
				) {
					$context_data['publisher']['@id'] = $site_url . '/#business';
				}

				// Rewrite about → #business.
				if ( isset( $context_data['about'] ) &&
					isset( $context_data['about']['@id'] ) &&
					false !== strpos( $context_data['about']['@id'], '#organization' )
				) {
					$context_data['about']['@id'] = $site_url . '/#business';
				}

				// Push changes back into piece.
				$piece->context = $context_data;
			}
		}

		return $pieces;
	},
	20,
	2
);

/**
 * Output schema markup for the site.
 *
 * @return void
 */
function lc_output_schema() {
	$site_url = get_site_url();

	if ( is_front_page() || is_home() ) {

		// ORGANIZATION SCHEMA - customize this for your business.
		$schema = array(
			'@context'    => 'https://schema.org',
			'@type'       => 'Organization',
			'@id'         => $site_url . '/#business',
			'name'        => get_bloginfo( 'name' ),
			'url'         => $site_url . '/',
			'logo'        => get_site_icon_url(),
			'description' => get_bloginfo( 'description' ),
		);

		// Add contact information if available from ACF options.
		if ( function_exists( 'get_field' ) ) {
			$phone = get_field( 'phone', 'options' );
			if ( $phone ) {
				$schema['telephone'] = $phone;
			}

			$address_street   = get_field( 'address_street', 'options' );
			$address_locality = get_field( 'address_locality', 'options' );
			$address_postcode = get_field( 'address_postcode', 'options' );

			if ( $address_street || $address_locality || $address_postcode ) {
				$schema['address'] = array(
					'@type'           => 'PostalAddress',
					'streetAddress'   => $address_street,
					'addressLocality' => $address_locality,
					'postalCode'      => $address_postcode,
					'addressCountry'  => 'GB',
				);
			}

			// Social media profiles.
			$social_links = array();
			$facebook     = get_field( 'facebook', 'options' );
			$twitter      = get_field( 'twitter', 'options' );
			$linkedin     = get_field( 'linkedin', 'options' );
			$instagram    = get_field( 'instagram', 'options' );

			if ( $facebook ) {
				$social_links[] = $facebook;
			}
			if ( $twitter ) {
				$social_links[] = $twitter;
			}
			if ( $linkedin ) {
				$social_links[] = $linkedin;
			}
			if ( $instagram ) {
				$social_links[] = $instagram;
			}

			if ( ! empty( $social_links ) ) {
				$schema['sameAs'] = $social_links;
			}
		}

		echo '<script type="application/ld+json">';
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE );
		echo '</script>';
	}

	// Check for custom schema first (works on all pages including contact).
	if ( function_exists( 'get_field' ) ) {
		$custom_schema = get_field( 'schema' );
		if ( ! empty( $custom_schema ) ) {
			// Decode to validate JSON, then re-encode for consistent output.
			$schema_data = json_decode( $custom_schema, true );
			if ( json_last_error() === JSON_ERROR_NONE && is_array( $schema_data ) ) {
				echo '<script type="application/ld+json">';
				// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				echo wp_json_encode( $schema_data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE );
				echo '</script>';
				return;
			}
		}
	}

	// Fallback contact page schema if no custom schema defined.
	if ( is_page( 'contact' ) ) {
		$contact_schema = array(
			'@context' => 'https://schema.org',
			'@type'    => 'ContactPage',
			'name'     => 'Contact ' . get_bloginfo( 'name' ),
			'url'      => get_permalink(),
			'about'    => array(
				'@id' => $site_url . '/#business',
			),
		);
		echo '<script type="application/ld+json">';
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo wp_json_encode( $contact_schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE );
		echo '</script>';
	}
}
add_action( 'wp_head', 'lc_output_schema', 99 );
