<?php

add_filter( 'wp_pre_insert_user_data', function ( $data, $userIsBeingUpdated, $userId, $userData ) {
	return array_merge( $data, [ 'user_url' => '' ] );
}, 10, 4 );
