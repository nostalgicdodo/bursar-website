<?php
/**
 |
 | User Listing: Show the tenant of origin for each user
 |
 |
 */

namespace ThisProject\CMS\WordPress;

use const ThisProject\PLUGIN_PATH;

require_once PLUGIN_PATH . '/lib/user.php';

use ThisProject\CMS\WordPress\User;





add_filter( 'manage_' . 'users' . '_columns', function ( $columns ) {
	return array_merge(
		$columns,
		[ 'tenant_of_origin' => __( 'Region of Origin' ) ]
	);
} );
add_filter( 'manage_' . 'users' . '_custom_column', function ( $output, $columnName, $userId ) {
	if ( $columnName !== 'tenant_of_origin' )
		return $output;

	global $wp;
	$tenant = User::getTenantOfOrigin( User::getBy( 'id', $userId ) );

	return '<a href="' . esc_url( add_query_arg( 'tenant', $tenant, $_SERVER[ 'REQUEST_URI' ] ) ) . '">'
		. strtoupper( $tenant )
	. '</a>';
}, 11, 3 );

// This adds a Tenant filter at the top
/*add_action( 'manage_users_extra_tablenav', function ( string $which ) {
	if ( $which !== 'top' )
		return;

	$queryParameter = 'tenant_region';
	$selected = $_GET[ $queryParameter ] ?? '';
	$noTenantIsSelected = strlen( $selected ) === 0;
?>
<select id="<?= $queryParameter ?>">
	<?php if ( $noTenantIsSelected ) : ?>
		<option selected disabled>Select Region of Origin</option>
	<?php else : ?>
		<option value="">All regions of origin</option>
	<?php endif; ?>
	<?php foreach ( TENANT_REGIONS as $tenant => $data ) : ?>
		<option
			value="<?= $tenant ?>"
			<?= $tenant === $selected ? 'selected' : '' ?>>
				<?= strtoupper( $tenant ) ?>
		</option>
	<?php endforeach; ?>
</select>
<?= submit_button( __( 'Filter' ), '', 'tenant-submit', false ) ?>
<?php
} );*/

// add_filter( 'pre_get_users', function ( $query ) {
// 	if ( ! is_admin() )
// 		return;

// 	$tenant = $_GET[ 'tenant' ] ?? null;
// 	if ( empty( $tenant ) )
// 		return;

// 	$query->set( 'meta_query', [
// 		'key' => 'tenant_of_origin',
// 		'value' => $tenant,
// 		'compare' => 'LIKE'
// 	] );
// } );
