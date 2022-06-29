<?php
	$addons = array(
		'activity' => array(
			'title'			=> __( 'Activity Wall', 'gallery-for-ultimate-member' ),
			'description'	=> __( 'Enable the ability to add to post new albums to wall', 'gallery-for-ultimate-member' ),
			'status'		=> true,
			'enabled'		=> um_gallery_pro_addon_enabled( 'activity' ),
			'pro_only'      => true,
		),
		'category' => array(
			'title'			=> __( 'Categories', 'gallery-for-ultimate-member' ),
			'description'	=> __( 'Enable the ability to organize media items by category', 'gallery-for-ultimate-member' ),
			'status'		=> true,
			'enabled'		=> um_gallery_pro_addon_enabled( 'category' ),
			'pro_only'      => true,
		),
		'comments' => array(
			'title'			=> __( 'Comments', 'gallery-for-ultimate-member' ),
			'description'	=> __( 'Enable the ability to add Comment to gallery', 'gallery-for-ultimate-member' ),
			'status'		=> true,
			'enabled'		=> um_gallery_pro_addon_enabled( 'comments' ),
			'pro_only'      => true,
		),
		'ratings' => array(
			'title'			=> __( 'Ratings', 'gallery-for-ultimate-member' ),
			'description'	=> __( 'Enable the ability to rate photos', 'gallery-for-ultimate-member' ),
			'status'		=> false,
			'enabled'		=> um_gallery_pro_addon_enabled( 'ratings' ),
			'pro_only'      => true,
		),
		'privacy' => array(
			'title'			=> __( 'Privacy', 'gallery-for-ultimate-member' ),
			'description'	=> __( 'Enable the ability to set media privacy', 'gallery-for-ultimate-member' ),
			'status'		=> true,
			'enabled'		=> um_gallery_pro_addon_enabled( 'privacy' ),
			'pro_only'      => true,
		),
		'tags' => array(
			'title'			=> __( 'Tags', 'gallery-for-ultimate-member' ),
			'description'	=> __( 'Enable the ability to use tags on media items', 'gallery-for-ultimate-member' ),
			'status'		=> true,
			'enabled'		=> um_gallery_pro_addon_enabled( 'tags' ),
			'pro_only'      => true,
		),
		'videos' => array(
			'title'			=> __( 'Videos', 'gallery-for-ultimate-member' ),
			'description'	=> __( 'Enable the ability to add YouTube videos through the gallery', 'gallery-for-ultimate-member' ),
			'status'		=> true,
			'enabled'		=> um_gallery_pro_addon_enabled( 'videos' ),
			'pro_only'      => false,
		),
	);
?>
<div class="um-gallery--addons-wrapper">
	<?php foreach ( $addons as $id => $data ) { ?>
	<form method="post" action="">
	<div class="um-gallery--addon-item postbox">
		<div class="inside">
			<h3><?php echo esc_html( $data['title'] ); ?></h3>
			<p><?php echo esc_html( $data['description'] ); ?></p>
			<?php if ( $data['status'] ) { ?>
			<?php if ( false == $data['enabled'] && ! $data['pro_only'] ) { ?>
			<input type="submit" class="button button-primary" value="<?php echo __( 'Enable', 'gallery-for-ultimate-member' ); ?>" <?php echo $data['pro_only'] ? 'disabled' : '' ?>>
			<input type="hidden" name="addon_action" value="enable">
			<?php } else { ?>
			<input type="submit" class="button button-primary" value="<?php echo __( 'Disable', 'gallery-for-ultimate-member' ); ?>" <?php echo $data['pro_only'] ? 'disabled' : '' ?>>
			<input type="hidden" name="addon_action" value="disable">
			<?php } ?>
			<?php } else { ?>
			<div class="um-gallery--addon-item-dev"><?php _e( 'To be developed', 'gallery-for-ultimate-member' ); ?></div>
			<?php } ?>
			<?php if ( 'true9' == $data['pro_only'] ) { ?>
			<div class="um-gallery--addon-item-pro"><?php _e( 'UM Gallery Pro', 'gallery-for-ultimate-member' ); ?></div>
			<?php } ?>
		</div>
	</div>
	<?php wp_nonce_field( 'um_verify_addon_admin', 'um_verify_addon_field' ); ?>
	<input type="hidden" name="addon_id" value="<?php echo esc_attr( $id ); ?>" />
	</form>
	<?php } ?>
	<div class="um-gallery--addon-item postbox">
		<div class="inside">
			<h3><?php echo __( 'Upgrade to UM Gallery Pro', 'gallery-for-ultimate-member' ); ?></h3>
			<p><?php echo __( 'Ready for more features? Use coupon code <strong>WPUPGRADE</strong> <a href="https://suiteplugins.com/downloads/gallery-for-ultimate-members/?utm_source=wordpress&utm_medium=upgrade">here</a> to get 25% off UM Gallery Pro', 'gallery-for-ultimate-member' ); ?></p>
		</div>
	</div>
</div>
