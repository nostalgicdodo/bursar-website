
window.__THIS = window.__THIS || { };
window.__THIS.utils = window.__THIS.utils || { };

/*
 *
 * Wait for the specified number of seconds.
 * This facilitates a Promise or syncrhonous (i.e., using async/await ) style
 * 	of programming
 *
 */
function waitFor ( seconds ) {
	return new Promise( function ( resolve, reject ) {
		setTimeout( function () {
			resolve();
		}, seconds * 1000 );
	} );
}
window.__THIS.utils.waitFor = waitFor;



function slugify ( string ) {
	return string
		.normalize( "NFD" )
		.replace( /[\u0300-\u036f]/g, "" )
		.replace( /\W/g, "-" )
		.toLowerCase()
}
window.__THIS.utils.slugify = slugify;



/*
 |
 | Cookie abstraction
 |
 | Relies on the js-cookie library
 |
 */
// window.CookieJar = function () {

// 	// Re-assign the library's namespace to a locally-scoped variable
// 	let Cookies = window.Cookies.noConflict()

// 	function setDefaultOptions ( options ) {
// 		options = options || { }

// 		if ( typeof options.expires === "number" && !Number.isNaN( options.expires ) )
// 			options.expires = 365
// 		else if ( ! ( options.expires instanceof Date ) )
// 			options.expires = 365

// 		options.secure = window.location.protocol.includes( "https" )

// 		return options
// 	}

// 	function get ( key ) {
// 		var data = Cookies.get( key );
// 		var parsedValue;
// 		if ( typeof data == "string" )
// 			parsedValue = JSON.parse( window.Base64.decode( data ) ).value
// 		else
// 			parsedValue = data;
// 		return parsedValue;
// 	}

// 	function set ( key, value, options ) {
// 		options = setDefaultOptions( options )
// 		value = window.Base64.encode( JSON.stringify( { value: value } ) )
// 		return Cookies.set( key, value, options )
// 	}

// 	function remove ( key, options ) {
// 		options = setDefaultOptions( options )
// 		return Cookies.remove( key, options )
// 	}

// 	return {
// 		get,
// 		set,
// 		remove
// 	}

// }()



/*
 *
 * Smooth scroll to a section
 *
 */
function smoothScrollTo ( locationHash ) {

	if ( ! locationHash )
		return;

	var locationId = locationHash.replace( "#", "" );
	var domLocation = document.getElementById( locationId );
	if ( ! domLocation )
		return;

	window.scrollTo( { top: domLocation.offsetTop, behavior: "smooth" } );

}
window.__THIS.utils.smoothScrollTo = smoothScrollTo;



/*
 *
 * Schedule a function to execute on the *next* browser paint
 *
 */
function onNextPaint ( fn ) {
	return window.requestAnimationFrame( function () {
		return window.requestAnimationFrame( function () {
			return fn();
		} );
	} );
}
window.__THIS.utils.onNextPaint = onNextPaint;



/*
 *
 * Recur a given function every given interval
 *
 */
function executeEvery ( interval, fn ) {

	interval = ( interval || 1 ) * 1000;

	var timeoutId;
	var frameId;
	var running = false;

	return {
		_schedule: function () {
			var _this = this;
			timeoutId = window.setTimeout( function () {
				frameId = window.requestAnimationFrame( function () {
					fn();
					_this._schedule()
				} );
			}, interval );
		},
		start: function () {
			if ( running )
				return;
			running = true;
			this._schedule();
		},
		stop: function () {
			window.cancelAnimationFrame( frameId );
			frameId = null;
			window.clearTimeout( timeoutId );
			timeoutId = null;
			running = false;
		}
	}

}
window.__THIS.utils.executeEvery = executeEvery;



/*
 *
 * Debounce a given function if invoked within the given period
 *
 */
function debounce ( fn, duration ) {

	duration = ( duration || 1 ) * 1000;
	var timeoutId;
	var frameId;

	return function () {
		// Clear any previously scheduled execution *always*
		window.cancelAnimationFrame( frameId );
		window.clearTimeout( timeoutId );
		// Schedule a fresh execution of the provided function
		var context = this;
		var functionArguments = Array.prototype.slice.call( arguments );
		timeoutId = setTimeout( function () {
			frameId = window.requestAnimationFrame( function () {
				fn.apply( context, functionArguments );
			} );
		}, duration );
	};

}
window.__THIS.utils.debounce = debounce;




/*
 *
 * Throttle the execution of a given function to a fixed frequency interval, regardless of how many times it is invoked
 *
 */
function throttle ( fn, duration ) {

	duration = ( duration || 1 ) * 1000;
	var timeoutId = null;
	var frameId = null;

	return function () {
		// If the function is yet to be executed, do nothing and simply return
		if ( frameId !== null || timeoutId !== null )
			return;

		// Else, schedule the function to execute at the end of the given interval
		var context = this;
		var functionArguments = Array.prototype.slice.call( arguments );
		timeoutId = setTimeout( function () {
			frameId = window.requestAnimationFrame( function () {
				fn.apply( context, functionArguments );
				frameId = null;
				timeoutId = null;
			} );
		}, duration );
	};

}
window.__THIS.utils.throttle = throttle;



/*
 |
 | This opens a new page in an iframe and closes it once it has loaded
 |
 */
function openPageInIframe ( url, name, options ) {

	options = options || { };
	var closeOnLoad = options.closeOnLoad || false;

	var $iframe = $( "<iframe>" );
	$iframe.attr( {
		width: 0,
		height: 0,
		title: name,
		src: url,
		style: "display:none;",
		class: "js_iframe_trac"
	} );

	$( "body" ).append( $iframe );

	if ( closeOnLoad ) {
		$( window ).one( "message", function ( event ) {
			if ( location.origin != event.originalEvent.origin )
				return;
			var message = event.originalEvent.data;
			if ( message.status == "ready" )
				setTimeout( function () { $iframe.remove() }, 19 * 1000 );
		} );
	}
	else {
		return $iframe.get( 0 );
	}

}



/*
 *
 * "Track" a page visit
 *
 * @params
 * 	name -> the url of the page
 *
 */
function trackPageVisit ( name ) {

	/*
	 *
	 * Open a blank page and add the tracking code to it
	 *
	 */
	// Build the URL
	var baseTrackingURL = ( "/" + Cupid.settings.trackingURL + "/" ).replace( /(\/+)/g, "/" );
	var baseURL = location.origin.replace( /\/$/, "" ) + baseTrackingURL;
	name = name.replace( /^[/]*/, "" );
	var url = baseURL + name;

	// Build the iframe
	openPageInIframe( url, "", {
		closeOnLoad: true
	} );

}



/*
 *
 * Add given data to the data layer variable established by GTM
 *
 */
function gtmPushToDataLayer ( data ) {
	if ( ! window.dataLayer )
		return;
	window.dataLayer.push( data );
}
window.__THIS.utils.gtmPushToDataLayer = gtmPushToDataLayer;



/*
 *
 * ----- Renders a template with data
 *
 */
window.__THIS.utils.renderTemplate = function () {

	var d;
	function replaceWith ( m ) {

		var pipeline = m.slice( 2, -2 ).trim().split( / *\| */ );
		var value = d[ pipeline[ 0 ] ];
		for ( var _i = 1; _i < pipeline.length; _i +=1 ) {
			value = __UTIL.template[ pipeline[ _i ] ]( value );
		}

		return value;

	}

	return function renderTemplate ( template, data ) {
		d = data;
		return template.replace( /({{[^{}]+}})/g, replaceWith );
	}

}();



/*
 *
 * Managerial Hub for "scroll" event handlers
 *
 */
function onScroll ( fn, options ) {

	options = options || { };

	// Create frequency controlled versions of the provided function
	if ( options.frequencyMode === "debounce" )
		fn = debounce( fn, options.interval );
	else if ( options.frequencyMode === "throttle" )
		fn = throttle( fn, options.interval );
	else if ( options.frequencyMode !== false || options.frequencyMode !== "none" || options.frequencyMode !== "default" )
		console.log( "WARNING: Please provide an explicity frequency mode so that your intention is explicit and clear." );

	// Add the provided function to the queue
	window.__THIS = window.__THIS || { };
	window.__THIS.bevahior = window.__THIS.bevahior || { };
	window.__THIS.bevahior.scrollHandlers = window.__THIS.bevahior.scrollHandlers || [ ];
	var scrollHandlers = window.__THIS.bevahior.scrollHandlers;
	scrollHandlers.push( { fn: fn, options: options } );

	if ( scrollHandlers.length > 1 )
		return;

	// Set up the scroll event handling mechanism
	initializeGlobalScrollHandler();

}
window.__THIS.utils.onScroll = onScroll;

function initializeGlobalScrollHandler () {

	// var currentScrollY = window.scrollY || document.body.scrollTop;
	// var previousScrollY = currentScrollY;
	var scrollHandlers = window.__THIS.bevahior.scrollHandlers;
	function globalScrollHandler ( event ) {
		var context = this;
		// Call all the registered scroll handlers one after the other, providing useful data
		var _i;
		for ( _i = 0; _i < scrollHandlers.length; _i += 1 )
			scrollHandlers[ _i ].fn.call( context, event );

	};
	window.__THIS.bevahior.globalScrollHandler = globalScrollHandler;

	window.addEventListener( "scroll", globalScrollHandler, true );

}
window.__THIS.utils.initializeGlobalScrollHandler = initializeGlobalScrollHandler;
