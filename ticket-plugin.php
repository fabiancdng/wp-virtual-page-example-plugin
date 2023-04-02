<?php
/*
 * Plugin Name:       Example Ticket Plugin
 * Plugin URI:        https://fabiancdng.com/blog/how-to-programmatically-create-virtual-pages-in-wordpress
 * Description:       Example WordPress plugin to demonstrate how you can programmatically create virtual pages in WordPress using plugins.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Fabian Reinders
 * Author URI:        https://fabiancdng.com/
 */

/**
 * Add rewrite rules to WordPress.
 *
 * @return void
 */
function ticket_plugin_add_rewrite_rules(): void {
	// Slug of your virtual page (e.g. 'ticket').
	$slug = 'ticket';

	// Add rewrite rule (hook up the virtual page to a slug in WordPress).
	// Do some Regex magic to pass args within the URL for pretty URLs.
	add_rewrite_rule(
		$slug . '/([^/]*)[/]?$',
		'index.php?ticket-id=$matches[1]',
		'top'
	);
}

/**
 * Add query variables to WordPress using filter.
 *
 * @param $vars array The array of query variables.
 *
 * @return array The filtered array of query variables.
 */
function ticket_plugin_add_query_vars( array $vars ): array {
	$vars[] = 'ticket-id';

	return $vars;
}

/**
 * Include the template for the virtual page.
 *
 * @return void
 */
function ticket_plugin_template_redirect(): void {
	if ( get_query_var( 'ticket-id' ) ) {
		include_once plugin_dir_path( __FILE__ ) . 'templates/ticket-page-template.php';
		exit;
	}
}

// Action and filter calls.
add_action( 'init', 'ticket_plugin_add_rewrite_rules' );
add_filter( 'query_vars', 'ticket_plugin_add_query_vars' );
add_action( 'template_redirect', 'ticket_plugin_template_redirect' );