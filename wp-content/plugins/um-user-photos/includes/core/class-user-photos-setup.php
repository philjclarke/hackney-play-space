<?php
namespace um_ext\um_user_photos\core;


if ( ! defined( 'ABSPATH' ) ) exit;


/**
 * Class User_Photos_Setup
 *
 * @package um_ext\um_user_photos\core
 */
class User_Photos_Setup {

	/**
	 * @var array
	 */
	var $settings_defaults;


	/**
	 * User_Photos_Setup constructor.
	 */
	function __construct() {
		//settings defaults
		$this->settings_defaults = array(
			'um_user_photos_albums_column'  => 'um-user-photos-col-3',
			'um_user_photos_images_column'  => 'um-user-photos-col-3',
			'um_user_photos_images_row'     => '2',
			'um_user_photos_cover_size'     => '',
			'um_user_photos_image_size'     => '',
			'um_user_photos_disable_title'	=> 0,
			'um_user_photos_disable_cover'	=> 0,
			'profile_tab_photos'            => 1,

			'new_album_on'      => 1,
			'new_album_sub'     => __( '[{site_name}] User Photo - has been created.', 'um-user-photos' ),
			'new_album'         => 'User "{user_name}" created the album "{album_title}".<br />Click on the following link to see user\'s albums:<br />{profile_url}',
			'album_deleted_on'  => 1,
			'album_deleted_sub' => __( '[{site_name}] User Photo - Album has been deleted.', 'um-user-photos' ),
			'album_deleted'     => 'User "{user_name}" deleted the album "{album_title}".<br />Click on the following link to see user\'s albums:<br />{profile_url}',
			'album_updated_on'  => 1,
			'album_updated_sub' => __( '[{site_name}] User Photo - Album has been updated.', 'um-user-photos' ),
			'album_updated'     => 'User "{user_name}" updated the album "{album_title}".<br />Click on the following link to see user\'s albums:<br />{profile_url}',
		);
	}


	/**
	 * Set default settings function
	 */
	function set_default_settings() {
		$options = get_option( 'um_options', array() );

		foreach ( $this->settings_defaults as $key => $value ) {
			//set new options to default
			if ( ! isset( $options[$key] ) ) {
				$options[$key] = $value;
			}
		}

		update_option( 'um_options', $options );
	}


	/**
	 * Run User Photos Setup
	 */
	function run_setup() {
		$this->set_default_settings();
	}
}
