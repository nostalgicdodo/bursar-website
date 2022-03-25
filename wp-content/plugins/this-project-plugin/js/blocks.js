
wp.domReady( function() {

	/*
	 *
	 * ----- Only allow specific blocks to be used
	 *
	 */
	let allowedBlockTypes = [
		"core/group",
		"core/column",
		"core/columns",
		"core/heading",
		"core/subhead",
		"core/paragraph",
		"core/quote",
		"core/pullquote",
		"core/image",
		"core/gallery",
		"core/list",
		"core/separator",
		"core/block",
		"core/spacer"
	];

	let allBlockTypes = wp.blocks.getBlockTypes();
	allBlockTypes.forEach( function ( blockType ) {
		if ( allowedBlockTypes.indexOf( blockType.name ) === -1 )
			wp.blocks.unregisterBlockType( blockType.name );
	} );

} );
