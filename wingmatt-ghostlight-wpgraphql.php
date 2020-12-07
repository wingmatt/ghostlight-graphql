<?php
/**
 * Plugin Name: WPGraphQL Queries for Ghostlight Streaming
 * Plugin URI: https://github.com/wingmatt/ghostlight-wpgraphql
 * GitHub Plugin URI: https://github.com/wingmatt/ghostlight-wpgraphql
 * Description: Custom WPGraphQL queries to support Ghostlight Streaming app data neeeds.
 * Author: Matt Wing
 * Author URI: https://wingmatt.dev
 * Version: 1.0
 * Text Domain: wing-glp-gql
 * Domain Path: /languages/
 * Requires at least: 5.0
 * Tested up to: 5.4
 * Requires PHP: 7.1
 * License: GPL-3
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 *
 * @package  WPGraphQL
 * @category Core
 * @author   WPGraphQL
 * @version  1.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action('graphql_register_types', function () {

  register_graphql_field('RootQueryToProductConnectionWhereArgs', 'performanceDate', [
      'type' => 'string',
      'description' => __('The date to filter by', 'wing-glp-gql'),
  ]);
});

add_filter('graphql_post_object_connection_query_args', function ($query_args, $source, $args, $context, $info) {

  $post_object_id = $args['where']['performanceDate'];

  if (isset($post_object_id)) {
      $query_args['meta_query'] = [
          [
              'key' => 'performance_date',
              'value' => $post_object_id,
              'compare' => '='
          ]
      ];
  }

  return $query_args;
}, 10, 5);
