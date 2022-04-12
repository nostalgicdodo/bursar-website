<?php

require_once THEME_PATH . '/lib/rest-api.php';
require_once THEME_PATH . '/lib/templating.php';

use ThisProject\CMS\WordPress\RESTApi\Validation;
use ThisProject\Templating;





register_rest_route( 'api', 'enquiry', [
	'methods'  => [ 'POST' ],
	'permission_callback' => '__return_true',
	'args' => [
		'alphabet' => [ 'required' => true ],	// honeypot
		'name' => [
			'required' => true,
			'validate_callback' => [ Validation::class, 'isString' ]
		],
		'emailAddress' => [
			'required' => true,
			'validate_callback' => [ Validation::class, 'isEmailAddress' ]
		],
		'phoneNumber' => [
			'required' => true,
			'validate_callback' => [ Validation::class, 'isString' ]
		],
		'company' => [
			'required' => true,
			'validate_callback' => [ Validation::class, 'isString' ]
		]
	],
	'callback' => function ( $request ) {
		if ( ! empty( $request->get_param( 'alphabet' ) ) )
			return [ 'code' => 'success', 'message' => 'All good.' ];

		$name = $request->get_param( 'name' );
		$phoneNumber = $request->get_param( 'phoneNumber' );
		$emailAddress = $request->get_param( 'emailAddress' );
		$company = $request->get_param( 'company' );


		// Create a new instance of an _enquiry_
		$enquiryId = wp_insert_post( [
			'post_type' => 'enquiry',
			// 'post_title' => wp_strip_all_tags( $nameOfPerson . ', from ' . $company ),
			// 'post_content' => '',
			// 'post_author' => 1,
			'post_status' => 'publish'
		] );
		update_field( 'name', $name, $enquiryId );
		update_field( 'phone_number', $phoneNumber, $enquiryId );
		update_field( 'email_address', $emailAddress, $enquiryId );
		update_field( 'company', $company, $enquiryId );

		// Schedule an email to be sent
		$emailContents = Templating\render( THEME_PATH . '/email-templates/new-enquiry.php', [
			'name' => $name,
			'phoneNumber' => $phoneNumber,
			'emailAddress' => $emailAddress,
			'company' => $company,
		] );
		wp_mail(
			// 'hello@bursar.in',
			'aditya.mohana.bhat@gmail.com',
			'An enquiry, from ' . $name . ' · Bursar',
			$emailContents,
			[ 'Content-Type: text/html; charset=UTF-8' ]	// email headers
		);

		// Respond back to the client
		$responseBody = [
			'code' => 'success',
			'message' => 'Enquiry processed.',
		];
		$response = new WP_REST_Response( $responseBody );
		$response->set_status( 200 );

		return $response;
	}
] );
