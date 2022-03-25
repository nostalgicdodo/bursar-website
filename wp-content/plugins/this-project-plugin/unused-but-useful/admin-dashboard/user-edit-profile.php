<?php
/*
 |
 | User Profile Edit Page
 |
 */


/*
 |
 | For users with the "Vendor" role
 | - Hide the `Nickname` field
 | - Move the Personal Options section to the bottom
 |
 | (Code derived from studying wp-admin/user-edit.php)
 |
 */
add_action( 'user_edit_form_tag', function () {
	$currentUser = wp_get_current_user();
	if ( in_array( 'administrator', $currentUser->roles ) )
		return;

	if ( ! current_user_can( 'edit_user', get_current_user_id() ) )
		return;

?>><!-- Here, we close the <form> tag -->

<style type="text/css">
	/* Hide the entire `Profile` form section (this is temporary) */
	#your-profile {
		opacity: 0;
		transition: opacity 0.25 ease-in-out;
	}
</style>
<!-- The following is a stub `div` without the closing angle bracket, as a closing angle bracket is what immediately follows this action hook -->
<div></div<?php
}, 10000 );



add_action( 'show_user_profile', function ( WP_User $wpUser ) {
	$currentUser = wp_get_current_user();
	if ( in_array( 'administrator', $currentUser->roles ) )
		return;

	if ( ! current_user_can( 'edit_user', $wpUser->ID ) )
		return;

?>

<!-- <div class="js_show_user_profile"></div> -->
<script type="text/javascript">
	jQuery( function ( $ ) {
		// `Profile` form
		let $profileForm = $( "#your-profile" )

		// `Personal Options` section
		let $personalOptions__SectionHeading = $profileForm.find( `h2:contains("Personal Options")` )
		let $personalOptions__SectionForm = $personalOptions__SectionHeading.next( ".form-table" )
		$personalOptions__SectionHeading.hide()
		$personalOptions__SectionForm.hide()

		// `Name` section
		let $nameSection__Heading = $profileForm.find( `h2:contains("Name")` )
		$nameSection__Heading.hide()

		// `Nickname` field
		let $userNickname__Field = $profileForm.find( ".user-nickname-wrap" )
		$userNickname__Field.hide()

		// `Display Name Publicly As` field
		let $displayNamePubliclyAs__Field = $profileForm.find( ".user-display-name-wrap" )
		$displayNamePubliclyAs__Field.hide()

		// `Contact Info` section
		let $contactInfo__SectionHeading = $profileForm.find( `h2:contains("Contact Info")` )
		$contactInfo__SectionHeading.hide()

		// `Accounts Management` section
		let $accountManagement__SectionHeading = $profileForm.find( `h2:contains("Account Management")` )
		let $accountManagement__SectionForm = $accountManagement__SectionHeading.next( ".form-table" )
		let $newPassword__FieldLabel = $accountManagement__SectionForm.find( `label[ for = "pass1" ]` )
		$accountManagement__SectionHeading.hide()
		$newPassword__FieldLabel.text( "Edit Password" )

		// `Application Passwords` section
		let $applicationPasswords__Section = $profileForm.find( "#application-passwords-section" )
		$applicationPasswords__Section.hide()

		// **for Vendor users only**
		<?php if ( in_array( 'vendor', $currentUser->roles ) ) : ?>
			// `Username` field
				// Change label to `Vendor ID`
			let $username__FieldLabel = $profileForm.find( `label[ for = "user_login" ]` )
			$username__FieldLabel.text( "Vendor ID" )

			// `About Yourself` section
			let $aboutYourself__SectionHeading = $profileForm.find( `h2:contains("About Yourself")` )
			let $aboutYourself__SectionForm = $aboutYourself__SectionHeading.next( ".form-table" )
			$aboutYourself__SectionHeading.hide()
			$aboutYourself__SectionForm.hide()

			// `Vendor` section
			let $vendor__SectionHeading = $profileForm.find( `h2:contains("Users: Vendors")` )
			$vendor__SectionHeading.hide()
		<?php endif; ?>

		// `Profile` form
			// Un-hide it
		$profileForm.css( { opacity: 1 } )
	} )
</script>

<?php
} );




/*
 |
 | Have the vendor-specific fields be read-only (for users with the "Vendor" role)
 |
 |
 */
add_action( 'plugins_loaded', function () {
	if ( !in_array( 'vendor', wp_get_current_user()->roles ) )
		return;

	add_action( PLUGIN_DOMAIN_SLUG . '/backend/on-screen', function ( $screenId, $screenSlug, $screenPostType ) {
		if ( $screenId !== 'profile' )
			return;

		add_filter( 'acf/load_field', function ( $field ) {
			$field[ 'disabled' ] = true;
			return $field;
		} );
	}, 10, 3 );
}, 10, 2 );
