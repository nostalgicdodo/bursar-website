
/*
 |
 | Order Splitting
 |
 |
 */
jQuery( function ( $ ) {

	/**
	 | References
	 |
	 */
	const HTTP = window.__THIS.lib.HTTP
	const context = window.__THIS.context



	/**
	 | On _clicking_ the _Split order by Vendor_ button
	 |
	 */
	$( ".js_split_order" ).on( "click", function ( event ) {
		// const numberOfVendors = window.__THIS.data.numberOfVendors
		// let descriptionOfIntent = `This will split this order into ${numberOfVendors} smaller orders, each having products only from a single vendor. Continue?`
		let descriptionOfIntent = `This order will be split into smaller ones, grouped by vendor. Continue?`
		if ( ! userHasConfirmed( descriptionOfIntent ) )
			return;

		blockEditArea()

		let payload = {
			nonce: context.nonces.orderSplit,
			action: "woocommerce_split_order",
			orderId: context.orderId
		}
		HTTP.request( context.ajaxURL, "POST", payload )
			.then( function ( r ) {
				console.log( r )
			} )
			.catch( function ( e ) {
				console.log( e )
			} )

		unblockEditArea()
	} )





	/**
	 | Helper functions
	 |
	 */
	function userHasConfirmed ( descriptionOfIntent ) {
		return window.confirm( descriptionOfIntent )
	}

	function blockEditArea () {
		$( "#poststuff" ).block( {
			message: null,
			overlayCSS: {
				background: '#fff',
				opacity: 0.6
			}
		} )
	}

	function unblockEditArea () {
		$( "#poststuff" ).unblock()
	}

} )
