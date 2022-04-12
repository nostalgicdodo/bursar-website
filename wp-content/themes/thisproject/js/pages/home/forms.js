
/**
 |
 | Enquiry Form
 |
 |
 */
$( function () {

// Imports
let BFSForm = window.__THIS.exports.BFSForm
let EmptyValueError = window.__THIS.exports.EmptyValueError
let InvalidValueError = window.__THIS.exports.InvalidValueError

// Set up the namespace
window.__THIS = window.__THIS || { };
window.__THIS.UI = window.__THIS.UI || { };





/*
 |
 | Form Setup
 |
 |
 */
let theForm = new BFSForm( ".js_contact_form" );

// Set up the form's input fields, data validators and data assemblers
	// Alphabet
theForm.addField( "alphabet", "[ name = 'alphabet' ]", function ( values ) {
	return values[ 0 ]
}, "Alphabet" );

	// Name
theForm.addField( "name", "[ name = 'name' ]", function ( values ) {
	let name = values[ 0 ]
	return BFSForm.validators.name( name )
}, "Name" );

	// Company
theForm.addField( "company", "[ name = 'company' ]", function ( values ) {
	let company = values[ 0 ]
	return BFSForm.validators.string( company )
}, "Company" );

	// Email address
theForm.addField( "emailAddress", "[ name = 'email-address' ]", function ( values ) {
	let emailAddress = values[ 0 ]
	return BFSForm.validators.emailAddress( emailAddress )
}, "Email address" )

	// Phone number (local)
theForm.addField( "phoneNumber", "[ name = 'phone-number' ]", function ( values ) {
	let phoneNumber = values[ 0 ]
	return BFSForm.validators.phoneNumberLocal( phoneNumber )
}, "Phone number" )




theForm.submit = function submit ( data ) {
	console.log( data )
	return registerEnquiry( data )
}



/**
 | Form submission handler
 |
 */
$( document ).on( "submit", ".js_contact_form", function ( event ) {

	/*
	 | Prevent default browser behaviour
	 */
	event.preventDefault();

	/*
	 | Prevent interaction with the form
	 */
	theForm.disable();

	/*
	 | Provide feedback to the user
	 */
	theForm.giveFeedback( "Sending..." );

	/*
	 | Extract data (and report issues if found)
	 */
	var data;
	try {
		data = theForm.getData();
	} catch ( error ) {
		// displayInlineIssues( error.issues )
		let feedbackMessage = "There are issues with the information you've provided:"
		for ( let issue of error.issues ) {
			feedbackMessage += `\n${ issue.e.fieldLabel || issue.key }: ${issue.e.message}`
		}
		console.error( error.issues )
		// console.error( error.message )
		alert( feedbackMessage )
		theForm.enable()
		// navigateToAndFocus( theForm.fields[ error.fieldName ] );
		theForm.setSubmitButtonLabel()
		return;
	}


	/*
	 | Submit data
	 */
	theForm.submit( data )
		.then( closeFormAndDisplayFeedback )
		.catch( function ( e ) {
			console.log( e )
			theForm.enable()
			theForm.setSubmitButtonLabel()
		} )

} );







/**
 |
 | Helper functions
 |
 |
 */
function registerEnquiry ( data ) {
	let payload = { ...data, timestamp: ( new Date ).toISOString() }
	return window.__THIS.lib.HTTP.request( "/wp-json/api/enquiry", "POST", payload, { contentType: "json" } )
}
function closeFormAndDisplayFeedback () {
	theForm.disable()
	theForm.giveFeedback( "We'll get in touch shortly" )
}





} )
