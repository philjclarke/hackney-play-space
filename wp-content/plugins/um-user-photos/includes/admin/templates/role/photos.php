<?php if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>

<div class="um-admin-metabox">

	<?php
	$role = $object['data'];

	UM()->admin_forms(
		array(
			'class'     => 'um-role-photos um-half-column',
			'prefix_id' => 'role',
			'fields'    => array(
				array(
					'id'      => '_um_enable_user_photos',
					'type'    => 'checkbox',
					'default' => 0,
					'label'   => __( 'Enable photos feature?', 'um-user-photos' ),
					'tooltip' => __( 'Can this role have user photos feature?', 'um-user-photos' ),
					'value'   => isset( $role['_um_enable_user_photos'] ) ? $role['_um_enable_user_photos'] : 0,
				),
				array(
					'id'          => '_um_limit_user_photos',
					'type'        => 'number',
					'default'     => 0,
					'label'       => __( 'The number of photos that the user can add', 'um-user-photos' ),
					'tooltip'     => __( '0 or empty for unlimited upload', 'um-user-photos' ),
					'value'       => isset( $role['_um_limit_user_photos'] ) ? $role['_um_limit_user_photos'] : 0,
					'conditional' => array( '_um_enable_user_photos', '=', '1' ),
					'size'        => 'small',
				),
			),
		)
	)->render_form();
	?>

	<div class="um-admin-clear"></div>
</div>
