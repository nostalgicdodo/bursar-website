
$( function () {

// Imports
let BFSForm = window.__THIS.exports.BFSForm
let EmptyValueError = window.__THIS.exports.EmptyValueError
let InvalidValueError = window.__THIS.exports.InvalidValueError



BFSForm.validators = {

	string ( value ) {
		value = value.trim();

		if ( value === "" )
			throw new EmptyValueError( "This cannot be empty." );

		return value;
	},

	name ( name ) {
		name = name.trim();

		if ( name === "" )
			throw new EmptyValueError( "This cannot be empty." );

		if ( name.match( /\d/ ) )
			throw new InvalidValueError( "Please provide a valid name." );

		return name;
	},

	emailAddress ( emailAddress ) {
		emailAddress = emailAddress.trim();
		emailAddress = emailAddress.replace( /\s/g, "" )

		if ( emailAddress === "" )
			throw new EmptyValueError( "This cannot be empty." );

		if ( ! /@/.test( emailAddress ) )
			throw new InvalidValueError( "Please provide a valid email address." );

		return emailAddress;
	},

	phoneNumber ( phoneCountryCode, phoneNumberLocal ) {
		phoneCountryCode = phoneCountryCode.replace( /[^\+\d+]/g, "" )
		phoneNumberLocal = phoneNumberLocal.trim();

		let phoneNumber = phoneCountryCode + phoneNumberLocal;

		if ( phoneNumberLocal.length <= 1 )
			throw new InvalidValueError( "Provide a valid phone number." );

		// For India
		if ( phoneCountryCode === "+91" && phoneNumberLocal.length !== 10 )
			throw new InvalidValueError( "Provide a valid 10-digit phone number." )

		if ( phoneNumberLocal.length > 1 )
			if ( ! (
				phoneNumber.match( /^\+\d[\d\-]+\d$/ )	// this is not a perfect regex, but it's close
				&& phoneNumberLocal.replace( /\D/g, "" ).length > 3
			) )
				throw new InvalidValueError( "Provide a valid phone number." );

		return phoneNumber;
	},

	phoneNumberLocal ( phoneNumber ) {
		phoneNumber = phoneNumber.trim();

		if ( phoneNumber.length <= 1 )
			throw new InvalidValueError( "Provide a valid phone number." );

		if ( phoneNumber.length > 1 )
			if ( ! (
				phoneNumber.match( /^\d[\d\-]+\d$/ )	// this is not a perfect regex, but it's close
				&& phoneNumber.replace( /\D/g, "" ).length > 3
			) )
				throw new InvalidValueError( "Provide a valid phone number." );

		return phoneNumber;
	}

};





/*
 *
 * Wire in the phone country code UI
 *
 */
$( document ).on( "change", ".js_phone_country_code", function ( event ) {
	var $countryCode = $( event.target );
	var countryCode = $countryCode.val().replace( /[^\+\d]/g, "" );
	$countryCode
		.closest( "form" )
		.find( ".js_phone_country_code_label" )
		.val( countryCode );
} );



} );
