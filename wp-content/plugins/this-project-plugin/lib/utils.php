<?php

namespace ThisProject\CMS\WordPress\Utils;

/*
 |
 | Determine if the given priority is valid for a meta-box
 | 	i.e. either 'core', 'default', 'low', or 'high'
 |
 |
 */
function isValidMetaboxPriority ( $priority ) {
	if ( empty( $priority ) )
		return false;

	$allPriorities = [ 'core', 'default', 'low', 'high' ];
	if ( ! in_array( $priority, $allPriorities ) )
		return false;

	return true;
}

/*
 |
 | Get a meta-box's priority
 |
 |
 */
function getMetaboxPriority ( $id, $screenName, $context ) {
	$priority = null;

	$screen = convert_to_screen( $screenName );
	if ( ! ( $screen instanceof \WP_Screen ) )
		return false;

	global $wp_meta_boxes;
	$metaboxesAtContext = $wp_meta_boxes[ $screen->id ][ $context ] ?? null;
	if ( empty( $metaboxesAtContext ) )
		return false;

	$allPriorities = [ 'core', 'default', 'low', 'high' ];
	foreach ( $allPriorities as $currentPriority ) {
		if ( ! is_array( $metaboxesAtContext[ $currentPriority ][ $id ] ?? null ) )
			continue;
		$priority = $currentPriority;
		break;
	}
	return $priority ?: false;
}



/*
 |
 | Get a reference to a meta-box
 |
 |
 */
function getMetabox ( $id, $screenName, $context, $priority = null ) {
	$priority = isValidMetaboxPriority( $priority ) ? $priority : getMetaboxPriority( $id, $screenName, $context );
	if ( empty( $priority ) )
		return;

	$screen = convert_to_screen( $screenName );
	if ( ! ( $screen instanceof \WP_Screen ) )
		return;

	global $wp_meta_boxes;
	return $wp_meta_boxes[ $screen->id ][ $context ][ $priority ][ $id ] ?? null;
}



/*
 |
 | Removes a meta-box
 |
 | The global `$wp_meta_boxes` var organizes metaboxes like so:
 | [
 | 	'<screen>' => [
 | 		'<context>' => [
 | 			'<priority>' => [
 | 				'<metabox>' => [
 | 					'id' => '<id>',
 | 					'title' => '<title>',
 | 					'callback' => '<callback>',
 | 					'args' => '<args>'
 | 				],
 | 				...
 | 			],
 | 			...
 | 		],
 | 		...
 | 	],
 | 	...
 | ]
 |
 | On calling the `remove_meta_box` function, the `<metabox>` key is simply set to `false`,
 | 	but **not removed** from the array. Hence, we directly access the global var and remove it entirely.
 |
 | References:
 | https://developer.wordpress.org/reference/functions/remove_meta_box/
 |
 */
function removeMetabox ( $id, $screenName, $context, $priority = null ) {
	$screen = convert_to_screen( $screenName );
	if ( ! ( $screen instanceof \WP_Screen ) )
		return false;

	$priority = isValidMetaboxPriority( $priority ) ? $priority : getMetaboxPriority( $id, $screenName, $context );
	if ( empty( $priority ) )
		return false;

	// Approach #1: WordPress' `remove_meta_box` function
		// This won't work if you want re-add the metabox but in a different position
	// remove_meta_box( $id, $screenName, $options[ 'currentContext' ] );

	// Approach #2: the `unset` function
	// global $wp_meta_boxes;
	// unset( $wp_meta_boxes[ $screen->id ][ $options[ 'currentContext' ] ][ $priority ][ $id ] );

	// Approach #3: Directly access the global `$wp_meta_boxes` array and filter out the metabox
	global $wp_meta_boxes;
	$wp_meta_boxes[ $screen->id ][ $context ][ $priority ] = array_filter(
		$wp_meta_boxes[ $screen->id ][ $context ][ $priority ],
		function ( $key ) use ( $id ) { return $key !== $id; },
		ARRAY_FILTER_USE_KEY
	);

	return true;
}



/*
 |
 | Re-registers an already registered metabox with a different configuration
 |
 |
 */
function moveMetabox ( $id, $screenName, $options ) {
	$context = $options[ 'currentContext' ];
	$priority = getMetaboxPriority( $id, $screenName, $context );
	$metabox = getMetabox( $id, $screenName, $context, $priority );
	if ( empty( $metabox ) )
		return;

	removeMetabox( $id, $screenName, $context, $priority );

	add_meta_box(
		$id,
		$options[ 'title' ] ?? $metabox[ 'title' ],
		is_callable( $options[ 'callback' ] ?? null ) ? function ( $post, $box ) use ( $options, $metabox ) {
			return $options[ 'callback' ]( $metabox, $post, $box );
		} : $metabox[ 'callback' ],
		$screenName,
		$options[ 'context' ] ?? $options[ 'currentContext' ],
		$options[ 'priority' ] ?? $priority,
		$metabox[ 'args' ] ?? null
	);
}
