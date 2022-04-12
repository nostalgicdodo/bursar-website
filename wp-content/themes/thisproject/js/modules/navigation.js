
/**
 |
 | On cliking an in-page link,
 | 	smooth-scroll to the section
 |
 | Limitation: This assumes that the link clicked does not have query parameters
 |
 */
$( document ).on( "click", "a[ href *= '#' ]", function ( event ) {
	let $link = $( event.target ).closest( "a" )
	let href = $link.get( 0 ).href
	let fullPathOfCurrentPage = window.location.origin + window.location.pathname

	// If the link is not an in-page link, do nothing and resume default behavior
	let sectionId = href.replace( fullPathOfCurrentPage, "" )
	if ( sectionId === href )
		return;

	event.preventDefault()

	// Close any navigation or modals that may be open
	closeNavigationMenu()

	window.__THIS.utils.smoothScrollTo( sectionId )

} );




/**
 |
 | Navigation Menu Toggle (for small devices)
 |
 |
 */
let navigationMenuIsOpen = false

function openNavigationMenu () {
	$( "body" ).addClass( "nav-open" )
	navigationMenuIsOpen = true
}
function closeNavigationMenu () {
	$( "body" ).removeClass( "nav-open" )
	navigationMenuIsOpen = false
}

// Toggling of the navigation menu
$( ".js_nav_toggle" ).on( "click", function ( event ) {
	if ( navigationMenuIsOpen )
		closeNavigationMenu()
	else
		openNavigationMenu()
} )




/**
 |
 | Navigation Menu Sticky-fication (for large devices)
 |
 |
 |
 | 1. When the user is past a certain point on the page,
 | 		stick the navigation menu to the top
 | 2. When the user is before a certain point on the page,
 | 		un-stick the navigation menu from the top
 | 		and restore it back to wherever it was
 |
 */
let domStickyThreshold = $( ".js_nav_menu_sticky_threshold" ).get( 0 )
let $stickySection = $( ".js_section_header__sticky" )

$( window ).on( "scroll", window.__THIS.utils.throttle( function ( event ) {
	if ( $stickySection.height() + domStickyThreshold.getBoundingClientRect().top < 0 )
		slideNavigationMenuIn();
	else
		slideNavigationMenuOut();
}, 0.25 ) )

function slideNavigationMenuIn () {
	$( "body" ).addClass( "nav-stick" )
}
function slideNavigationMenuOut () {
	$( "body" ).removeClass( "nav-stick" )
}
