<?php

/**
 * Get current screen URL
 *
 * @param NONE
 * @return STRING $url
 */
function ets_wp_openai_get_current_screen_url() {
	$parts           = parse_url( home_url() );
	$current_uri = "{$parts['scheme']}://{$parts['host']}" . ( isset( $parts['port'] ) ? ':' . $parts['port'] : '' ) . add_query_arg( null, null );
	
        return $current_uri;
}