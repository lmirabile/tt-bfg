<?php
add_filter( 'http_request_args', 'bfg_prevent_child_theme_update', 5, 2 );
/**
 * Prevent the child theme from being overwritten by a WordPress.org theme with the same name.
 *
 * See: Mark Jaquith (http://markjaquith.wordpress.com/2009/12/14/excluding-your-plugin-or-theme-from-update-checks/)
 *
 * @since 1.x
 */
function bfg_prevent_child_theme_update( $r, $url ) {

	if ( 0 !== strpos( $url, 'http://api.wordpress.org/themes/update-check' ) )
		return $r; // Not a theme update request. Bail immediately.
	$themes = unserialize( $r['body']['themes'] );
	unset( $themes[ get_option( 'template' ) ] );
	unset( $themes[ get_option( 'stylesheet' ) ] );
	$r['body']['themes'] = serialize( $themes );
	return $r;

}

add_action( 'pre_ping', 'bfg_disable_self_pings' );
/**
 * Prevent the child theme from being overwritten by a WordPress.org theme with the same name.
 *
 * See: http://wp-snippets.com/disable-self-trackbacks/
 *
 * @since 2.0.0
 */
function bfg_disable_self_pings( &$links ) {

    foreach ( $links as $l => $link )
        if ( 0 === strpos( $link, get_option( 'home' ) ) )
            unset($links[$l]);

}

/**
 * Add new image sizes
 *
 * See: http://wp-snippets.com/disable-self-trackbacks/
 *
 * @since 2.0.0
 */
// add_image_size( 'desktop-size', 1024, 768, false);
// add_image_size( 'size-slug', width, height, crop?);

// add_filter( 'image_size_names_choose', 'bfg_image_size_names_choose' );
/**
 * Add new image sizes to media size selection menu
 *
 * See: http://wpdaily.co/top-10-snippets/
 *
 * @since 2.0.0
 */
function bfg_image_size_names_choose( $sizes ) {
	$sizes['desktop-size'] = 'Desktop';
	return $sizes;
}