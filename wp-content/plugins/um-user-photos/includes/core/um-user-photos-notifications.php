<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Send a mail notification
 *
 * @param $album_id
 *
 * @return void
 */
function um_user_photos_album_created_notification( $album_id ) {
	global $current_user;

	$profile_url = um_user_profile_url( $current_user->ID ) . '?profiletab=photos&subnav=albums';
	$site_name   = get_bloginfo( 'name' );
	$emails      = um_multi_admin_email();

	$album       = get_post( $album_id );
	$album_title = $album->post_title;

	if ( ! empty( $emails ) ) {
		foreach ( $emails as $email ) {
			UM()->mail()->send(
				$email,
				'new_album',
				array(
					'path'         => um_user_photos_path . 'templates/email/',
					'tags'         => array(
						'{album_title}',
						'{user_name}',
						'{profile_url}',
						'{site_name}',
					),
					'tags_replace' => array(
						$album_title,
						$current_user->display_name,
						$profile_url,
						$site_name,
					),
				)
			);
		}
	}
}
add_action( 'um_user_photos_after_album_created', 'um_user_photos_album_created_notification', 20 );


/**
 * Send a mail notification
 *
 * @param $album_id
 * @param \WP_Post $album_data
 *
 * @return void
 */
function um_user_photos_album_deleted_notification( $album_id, $album_data ) {
	global $current_user;

	$profile_url = um_user_profile_url( $current_user->ID ) . '?profiletab=photos&subnav=albums';
	$site_name   = get_bloginfo( 'name' );
	$emails      = um_multi_admin_email();

	$album_title = $album_data->post_title;

	if ( ! empty( $emails ) ) {
		foreach ( $emails as $email ) {
			UM()->mail()->send(
				$email,
				'album_deleted',
				array(
					'path'         => um_user_photos_path . 'templates/email/',
					'tags'         => array(
						'{album_title}',
						'{user_name}',
						'{profile_url}',
						'{site_name}',
					),
					'tags_replace' => array(
						$album_title,
						$current_user->display_name,
						$profile_url,
						$site_name,
					),
				)
			);
		}
	}
}
add_action( 'um_user_photos_after_album_deleted', 'um_user_photos_album_deleted_notification', 20, 2 );


/**
 * Send a mail notification
 *
 * @param $album_id
 *
 * @return void
 */
function um_user_photos_album_updated_notification( $album_id ) {
	global $current_user;

	$profile_url = um_user_profile_url( $current_user->ID ) . '?profiletab=photos&subnav=albums';
	$site_name   = get_bloginfo( 'name' );
	$emails      = um_multi_admin_email();

	$album       = get_post( $album_id );
	$album_title = $album->post_title;

	if ( ! empty( $emails ) ) {
		foreach ( $emails as $email ) {
			UM()->mail()->send(
				$email,
				'album_updated',
				array(
					'path'         => um_user_photos_path . 'templates/email/',
					'tags'         => array(
						'{album_title}',
						'{user_name}',
						'{profile_url}',
						'{site_name}',
					),
					'tags_replace' => array(
						$album_title,
						$current_user->display_name,
						$profile_url,
						$site_name,
					),
				)
			);
		}
	}
}
add_action( 'um_user_photos_after_album_updated', 'um_user_photos_album_updated_notification', 20 );


/**
 * Extends email notifications settings
 *
 * @param $email_notifications
 *
 * @return mixed
 */
function um_user_photos_mail_notification_album( $email_notifications ) {
	$email_notifications['new_album'] = array(
		'key'            => 'new_album',
		'title'          => __( 'User Photos - New album has been created', 'um-user-photos' ),
		'subject'        => __( '[{site_name}] User Photo - has been created.', 'um-user-photos' ),
		'body'           => 'User "{user_name}" created the album "{album_title}".<br />Click on the following link to see user\'s albums:<br />{profile_url}',
		'description'    => __( 'Send a notification to admin when user creates an album.', 'um-user-photos' ),
		'recipient'      => 'admin',
		'default_active' => true,
	);

	$email_notifications['album_deleted'] = array(
		'key'            => 'album_deleted',
		'title'          => __( 'User Photos - Album has been deleted', 'um-user-photos' ),
		'subject'        => __( '[{site_name}] User Photo - Album has been deleted.', 'um-user-photos' ),
		'body'           => 'User "{user_name}" deleted the album "{album_title}".<br />Click on the following link to see user\'s albums:<br />{profile_url}',
		'description'    => __( 'Send a notification to admin when user deletes an album.', 'um-user-photos' ),
		'recipient'      => 'admin',
		'default_active' => true,
	);

	$email_notifications['album_updated'] = array(
		'key'            => 'album_updated',
		'title'          => __( 'User Photos - Album has been updated', 'um-user-photos' ),
		'subject'        => __( '[{site_name}] User Photo - Album has been updated.', 'um-user-photos' ),
		'body'           => 'User "{user_name}" updated the album "{album_title}".<br />Click on the following link to see user\'s albums:<br />{profile_url}',
		'description'    => __( 'Send a notification to admin when user updates an album.', 'um-user-photos' ),
		'recipient'      => 'admin',
		'default_active' => true,
	);

	return $email_notifications;
}
add_filter( 'um_email_notifications', 'um_user_photos_mail_notification_album', 20, 1 );


/**
 * @param $slugs
 *
 * @return mixed
 */
function um_user_photos_email_templates_path_by_slug( $slugs ) {
	$slugs['new_album'] = um_user_photos_path . 'templates/email/';
	$slugs['album_deleted'] = um_user_photos_path . 'templates/email/';
	$slugs['album_updated'] = um_user_photos_path . 'templates/email/';

	return $slugs;
}
add_filter( 'um_email_templates_path_by_slug', 'um_user_photos_email_templates_path_by_slug', 10, 1 );
