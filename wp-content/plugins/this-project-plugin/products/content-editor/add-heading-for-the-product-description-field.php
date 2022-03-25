<?php
/*
 |
 | Add a heading before the product description,
 |   so that users will know to what put in there.
 |
 |
 */

add_action( 'edit_form_after_title', function ( $post ) use ( $contentTypeSlug ) {
	if ( $post->post_type !== $contentTypeSlug )
		return;
?>
<h1 class="wp-heading-inline" style="width: 100%; margin-top: 1.5rem; border-bottom: 1px solid #c3c4c7;">Product Description</h1>
<?php
} );
