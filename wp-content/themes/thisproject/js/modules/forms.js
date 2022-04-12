
$( function () {



// Exports [1/2]
window.__THIS = window.__THIS || { }
window.__THIS.exports = window.__THIS.exports || { }
window.__THIS.exports.BFSForm = BFSForm





/*
 |
 | the Form class
 |
 */
function BFSForm ( selector ) {

	selector = selector.trim()

	if ( ! selector )
		this.formSelector = "html"
	if ( selector )
		this.formSelector = selector

	this.fields = { };

}
BFSForm.getErrorResponse = function getErrorResponse ( jqXHR, textStatus, e ) {
	var code = -1;
	var message;
	if ( jqXHR.responseJSON ) {
		code = jqXHR.responseJSON.code || jqXHR.responseJSON.statusCode;
		message = jqXHR.responseJSON.message;
	}
	else if ( typeof e == "object" ) {
		message = e.stack;
	}
	else {
		message = jqXHR.responseText;
	}
	var error = new Error( message );
	error.code = code;
	return error;
}
BFSForm.prototype.getFormNode = function getFormNode () {
	return this.$formNode || $( this.formSelector )
}
BFSForm.prototype.bind = function bind ( formNode ) {
	var $formNode
	if ( formNode instanceof HTMLElement )
		$formNode = $( formNode )
	else if ( ! ( formNode instanceof jQuery ) )
		throw new Error( "A DOM node or jQuery object must be provided." )
	else
		$formNode = formNode

	// Clone the form instance
	var newBFSForm = new BFSForm( this.formSelector )
	newBFSForm.$formNode = $formNode
	newBFSForm.submit = this.submit
		// Clone the fields
	for ( let fieldKey in this.fields ) {
		newBFSForm.fields[ fieldKey ] = Object.create( Object.getPrototypeOf( this.fields[ fieldKey ] ) )
		newBFSForm.fields[ fieldKey ].bfsForm = newBFSForm
	}

	return newBFSForm
}

BFSForm.prototype.disable = function disable ( fn ) {
	var $formNode = this.getFormNode()
	$formNode.find( "input, textarea, select, button" ).prop( "disabled", true );
	if ( Object.prototype.toString.call( fn ).toLowerCase() === "[object function]" )
		fn.call( this, $formNode.get( 0 ) );
};
BFSForm.prototype.enable = function enable ( fn ) {
	var $formNode = this.getFormNode()
	$formNode.find( "input, textarea, select, button" ).prop( "disabled", false );
	if ( Object.prototype.toString.call( fn ).toLowerCase() === "[object function]" )
		fn.call( this, $formNode.get( 0 ) );
}
BFSForm.prototype.giveFeedback = function giveFeedback ( message ) {
	var $formNode = this.getFormNode()
	var $submitButton = $formNode.find( "[ type = 'submit' ]" )
	// Backup the initial label of the button
	if ( $submitButton.data( "initial-label" ) === void 0 /* i.e. `undefined` */ )
		$submitButton.data( "initial-label", $submitButton.text() )

	$submitButton.text( message )
}
BFSForm.prototype.setSubmitButtonLabel = function setSubmitButtonLabel ( label ) {
	var $formNode = this.getFormNode()
	var $submitButton = $formNode.find( "[ type = 'submit' ]" )
	var label = label || $submitButton.data( "initial-label" );
	$submitButton.text( label );
}

BFSForm.prototype.getFieldValue = function getFieldValue ( domField ) {
	var elementTag = domField.nodeName.toLowerCase();
	var value;

	switch ( elementTag ) {
		case "input": {
			let inputType = domField.getAttribute( "type" );
			if ( inputType === "checkbox" )
				value = domField.checked ? domField.value : null;
			else if ( inputType === "radio" )
				value = domField.checked ? domField.value : null;
			else
				value = domField.value;
			break;
		}
		case "select": {
			value = domField.value;
			break;
		}
		case "textarea": {
			value = domField.value;
			break;
		}
	}
	return value;
}

BFSForm.prototype.addField = function addField ( key, selectors, fn, label ) {
	if ( ! Array.isArray( selectors ) )
		selectors = [ selectors ];

	// The approach taken below is solely to serve the requirements of the `bind` method
		// When a BFSForm is bound to a form DOM node (using the `bind` method), we clone the BFSForm
		//  and swap out the context under which all the methods
		//  (especially the ones created for the field below) operate against.
		// The approach of storing the "field"'s properties and methods in its prototype is to facilitate
		//  cloning of the BFSForm with a low memory usage overhead. The fields property on the new
		//  BFSForm instance is the exact same object as that on the source BFSForm instance. Only the
		//  context (i.e. `bfsForm` property in this case) is different.
	let field = Object.create( {
		key,
		selectors,
		get () {
			let domFields = this.selectors.map(
				s => this.bfsForm.getFormNode().find( s ).get( 0 )
			)
			let valueParts = domFields.map( this.bfsForm.getFieldValue )
			let value = this.validateAndAssemble( valueParts )
			return value
		},
		set ( valueParts ) {
			return this.bfsForm.setFieldValue( this.key, valueParts )
		},
		getNode ( index ) {
			if ( typeof index !== "number" || Number.isNaN( index ) )
				index = 0
			if ( typeof this.selectors[ index ] !== "string" )
				index = 0
			return this.bfsForm.getFormNode()
					.find( this.selectors[ index ] )
		},
		getNodes () {
			return this.selectors.map(
				s => this.bfsForm.getFormNode().find( s ).get( 0 )
			)
		},
		focus ( domNodeIndex ) {
			return this.bfsForm.focus( this.key, domNodeIndex )
		},
		validateAndAssemble ( ...args ) {
			try {
				return fn.apply( null, args )
			}
			catch ( e ) {
				e.fieldLabel = label
				throw e
			}
		},
	} )
	// Associate the field with the BFSForm instance
	field.bfsForm = this

	this.fields[ key ] = field
}

BFSForm.prototype.setFieldValue = function setFieldValue ( key, valueParts ) {
	if ( ! Array.isArray( valueParts ) )
		valueParts = [ valueParts ];

	var $formNode = this.getFormNode()
	var field = this.fields[ key ];
	var $fields = field.selectors.map( s => $formNode.find( s ) )
	$fields.forEach( function ( $el, index ) {
		$el.val( valueParts[ index ] )
	} )
}

BFSForm.prototype.getData = function getData () {
	var $formNode = this.getFormNode()

	this.data = { };
	// var _key;
	// for ( _key in this.fields ) {
		// let field = this.fields[ _key ]
		// let domFields = field.selectors.map( s => $formNode.find( s ).get( 0 ) )
		// let valueParts = domFields.map( this.getFieldValue )
		// let value = field.validateAndAssemble( valueParts )
		// this.data[ _key ] = value;
	// }
	let issues = [ ]
	for ( let key in this.fields ) {
		let field = this.fields[ key ]
		try {
			this.data[ key ] = field.get()
		} catch ( e ) {
			issues = issues.concat( { key, e } )
		}
	}
	if ( issues.length > 0 )
		throw new BFSFormError( "There are issues with the form.", issues );

	return this.data;
}
// A form field can be comprised of one or more underlying DOM nodes,
//  hence when a field is to be "focused" on, the index of the DOM node needs to be provided
BFSForm.prototype.focus = function focus ( key, domNodeIndex ) {
	var $formNode = this.getFormNode()
	var field = this.fields[ key ]
	if ( typeof domNodeIndex !== "number" || Number.isNaN( domNodeIndex ) )
		domNodeIndex = field.defaultDOMNodeFocusIndex || 0
	var domFields = field.selectors.map( s => $formNode.find( s ).get( 0 ) )
	if ( domFields[ domNodeIndex ] )
		domFields[ domNodeIndex ].focus()
}

class BFSFormError extends Error {
	constructor ( message, issues ) {
		super( message );
		if ( Array.isArray( issues ) )
			this.issues = issues;
	}
}

class EmptyValueError extends Error {
	constructor ( message ) {
		super( message );
	}
}

class InvalidValueError extends Error {
	constructor ( message ) {
		super( message );
	}
}





// Exports [2/2]
window.__THIS.exports.EmptyValueError = EmptyValueError
window.__THIS.exports.InvalidValueError = InvalidValueError





} )
