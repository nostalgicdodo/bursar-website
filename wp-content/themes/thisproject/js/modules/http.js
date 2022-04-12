
( function () {





window.__THIS = window.__THIS || { };
window.__THIS.lib = window.__THIS.lib || { };



/*
 |
 | HTTP Request function
 |
 | Relies on jQuery's ajax helper function
 |
 */
class HTTP {

	static request ( url, method, data, options ) {
		let $ = window.jQuery
		method = method || "GET"
		options = options || { }
		let ajaxParameters = {
			url,
			method,
			dataType: "json"
		}
		if ( [ "POST", "PUT" ].includes( method ) ) {
			if ( options.contentType && options.contentType.toLowerCase() === "json" ) {
				ajaxParameters.data = JSON.stringify( data || { } )
				ajaxParameters.contentType = "application/json"
			}
			else
				ajaxParameters.data = data
		}

		options = options || { }
		if ( options.sync )
			ajaxParameters.async = false

		let ajaxRequest = $.ajax( ajaxParameters )

		return new Promise( ( resolve, reject ) => {
			ajaxRequest.done( resolve )
			ajaxRequest.fail( ( jqXHR, textStatus, e ) => {
				var errorResponse = this.parseErrorResponse( jqXHR, textStatus, e )
				reject( errorResponse )
			} )
		} );
	}


	/**
	 | Handle error / exception response helper
	 |
	 */
	static parseErrorResponse ( jqXHR, textStatus, e ) {
		let code = -1;
		let message = "There was an issue.";
		let data = jqXHR.responseJSON;
		// if ( jqXHR.responseJSON ) {
		// 	code = jqXHR.responseJSON.code || jqXHR.responseJSON.statusCode;
		// 	message = jqXHR.responseJSON.message;
		// }
		if ( typeof e == "object" ) {
			message = e.stack;
		}
		else if ( ! data ) {
			message = jqXHR.responseText;
		}
		// var error = new Error( message );
		let error = { code, message }
		if ( data )
			error.data = data;

		return error;
	}

}



window.__THIS.lib.HTTP = HTTP;





}() )
