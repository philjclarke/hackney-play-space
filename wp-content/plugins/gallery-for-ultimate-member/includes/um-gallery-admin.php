<?php
/**
 * UM Gallery Pro Admin Option
 *
 * @version 1.0.0
 */

class UM_GalleryPro_Admin {

	/**
	* Option key, and option page slug
	* @var string
	*/
	private $key = 'um_gallery';

	/**
	* Option key, and option page slug
	* @var string
	*/
	private $setting_key = 'um_gallery_pro_settings';

	/**
	* Options page metabox id
	* @var string
	*/
	private $metabox_id = 'um_gallery_pro';

	/**
	 * Options Page title
	 * @var string
	 */
	protected $title = '';

	/**
	 * Options Page hook
	 * @var string
	 */
	protected $options_page = '';

	/**
	 * Active Tab
	 * @var string
	 */
	public $active_tab = '';

	/**
	 * Holds an instance of the object
	 *
	 * @var UM_GalleryPro_Admin
	 **/
	private static $instance = null;

	public $album = array();
	/**
	 * Constructor
	 * @since 0.1.0
	 */
	public function __construct() {
		// Set our title
		$this->title = __( 'UM Gallery', 'gallery-for-ultimate-member' );
		$this->active_tab = ( isset( $_GET['tab'] ) && ! empty( $_GET['tab'] ) ? esc_attr( $_GET['tab'] ) : 'general' );

		if ( isset( $_GET['view'] ) ) {
			$album_id = isset( $_GET['album_id'] ) && ! empty( $_GET['album_id'] ) ? esc_attr( $_GET['album_id'] ) : 0;
			global $wpdb, $album;

			$query = "SELECT a.* FROM {$wpdb->prefix}um_gallery_album AS a WHERE a.id='{$album_id}' ORDER BY a.id DESC";
			$this->album = $wpdb->get_row( $query );
		}
	}

	/**
	 * Returns the running object
	 *
	 * @return UM_GalleryPro_Admin
	 **/
	public static function get_instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
			self::$instance->hooks();
		}
		return self::$instance;
	}

	/**
	 * Initiate our hooks
	 * @since 0.1.0
	 */
	public function hooks() {
		add_action( 'admin_init', array( $this, 'init' ) );
		add_action( 'admin_init', array( $this, 'update_admin_search_url' ) );
		add_action( 'admin_init', array( $this, 'update_album' ) );
		add_action( 'admin_init', array( $this, 'moderate_addon' ) );
		add_action( 'admin_notices', array( $this, 'admin_notices' ) );
		add_action( 'admin_menu', array( $this, 'add_options_page' ) );
		add_action( 'cmb2_admin_init', array( $this, 'add_options_page_metabox' ) );
		add_action( 'um_gallery_addon_updated', array( $this, 'alter_database' ), 12, 1 );

		add_action( 'cmb2_render_gheader', array( $this, 'header_field' ), 10, 1 );
		// ajax
		add_action( 'wp_ajax_um_gallery_admin_delete',  array( $this, 'um_gallery_admin_delete' ) );

		//add_action( 'um_gallery_pro_album_after_sidebarbox',  array( $this, 'categories_meta_box' ), 12, 1 );
	}

	public function categories_meta_box( $object = array() ) {
		$tax_name = um_gallery()->field->category;
		$args = array('orderby' => 'name', 'order' => 'ASC', 'fields' => 'ids' );
		$album_terms = wp_get_object_terms( $object->album->id,  'um_gallery_category', $args );
		?>
		<div id="um-gallery-pro-categories" class="postbox">
			<div class="inside">
				<ul id="<?php echo $tax_name; ?>checklist" data-wp-lists="list:<?php echo $tax_name; ?>" class="categorychecklist form-no-clear">
					<?php wp_terms_checklist( $object->album->id, array( 'taxonomy' => $tax_name, 'selected_cats' => $album_terms ) ); ?>
				</ul>
			</div>
		</div>
		<?php
	}
	public function header_field( $field = array() ) {
		//printf( '<h3 class="um-gallery-fields-sub-title">%s</h3>', $field->args['name'] );
	}
	public function alter_database( $addon_id = '' ) {
		global $wpdb;
		$charset_collate = ! empty( $wpdb->charset ) ? "DEFAULT CHARACTER SET $wpdb->charset" : '';
		// add the type column to table
		if ( 'videos' == $addon_id ) {
			$result = $wpdb->query( "SHOW COLUMNS FROM `" . $wpdb->prefix . "um_gallery` LIKE 'type'" );
			// if the column doesn't exists then let's add it
			// TODO: In later version, add this to option table to skip this step
			if ( ! $result ) {
				$wpdb->query( 'ALTER TABLE `' . $wpdb->prefix . 'um_gallery` ADD `type` VARCHAR(100) NOT NULL AFTER `description`' );
			}
		}

		if ( 'comments' == $addon_id ) {
			$result = $wpdb->get_var( "SHOW TABLES LIKE '{$wpdb->prefix}um_gallery_comments'" );
			if ( ! $result ) {
				$comments_query = "CREATE TABLE IF NOT EXISTS {$wpdb->prefix}um_gallery_comments (
					  `id` bigint(20) NOT NULL AUTO_INCREMENT PRIMARY KEY,
					  `parent_id` bigint(20) NOT NULL,
					  `user_id` bigint(20) NOT NULL,
					  `photo_id` bigint(20) NOT NULL,
					  `comment` text NOT NULL,
					  `file_url` varchar(255) NOT NULL,
					  `file` varchar(255) NOT NULL,
					  `file_mime_type` varchar(255) NOT NULL,
					  `upvote_count` bigint(20) NOT NULL,
					  `user_has_upvoted` tinyint(2) NOT NULL,
					  `modified_date` DATETIME NULL DEFAULT NULL,
					  `creation_date` DATETIME NULL DEFAULT NULL
				) {$charset_collate};";
				$wpdb->query( $comments_query );
			}
		}

	}
	/**
	 * Add admin notice on album save
	 *
	 * @return  void
	 */
	public function admin_notices() {
		if ( isset( $_GET['album_updated'] ) ) {
		?>
			<div id="message" class="updated notice notice-success">
			  <p><?php esc_html_e( 'Gallery Updated', 'gallery-for-ultimate-member' ); ?></p>
			</div>
		<?php
		}

		if ( isset( $_GET['addons_updated'] ) ) {
		?>
		<div id="message" class="updated notice notice-success">
		  <p><?php esc_html_e( 'Addons Updated', 'gallery-for-ultimate-member' ); ?></p>
		</div>
		<?php
		}
	}

	/**
	 * Enable or disable addons
	 *
	 *
	 * @return void
	 */
	public function moderate_addon() {
		$option = 'um_gallery_pro_addons';
		if ( isset( $_POST['um_verify_addon_field'] ) ) {
			$nonce = $_POST['um_verify_addon_field'];
			if ( wp_verify_nonce( $nonce, 'um_verify_addon_admin' ) ) {

				$current_addons = get_option( $option );
				if ( empty( $current_addons ) ) {
					$current_addons = array();
				}
				$addon_id = esc_attr( $_POST['addon_id'] );
				if ( 'enable' == $_POST['addon_action'] && ! in_array( $_POST['addon_id'], $current_addons ) ) {
					$current_addons[] = esc_attr( $_POST['addon_id'] );
				} elseif ( 'disable' == $_POST['addon_action'] && in_array( $_POST['addon_id'], $current_addons ) ) {
					$key = array_search( $_POST['addon_id'], $current_addons );
					unset( $current_addons[ $key ] );
				}

				update_option( $option, $current_addons );
				do_action( 'um_gallery_addon_updated', $addon_id, $current_addons );
				$redirect_url = add_query_arg( 'addons_updated', '1', $_POST['_wp_http_referer'] );
				wp_safe_redirect( $redirect_url );
			}
		}
	}

	/**
	 * Update album from admin
	 *
	 * @return void
	 */
	public function update_album() {
		if ( isset( $_POST['um_verify_album_admin_field'] ) ) {
			$nonce = $_POST['um_verify_album_admin_field'];
			if ( wp_verify_nonce( $nonce, 'um_verify_album_admin' ) ) {
				global $wpdb;
				$results = array();
				$album_id = 0;
				global $wpdb;
				$user_id = ( ! empty( $_POST['user_id'] ) ? (int) $_POST['user_id'] : get_current_user_id() );
				$album_name        = ( ! empty( $_POST['title'] ) ? sanitize_text_field( $_POST['title'] ) : um_gallery_get_default_album_name( $user_id ) );
				$album_description = ( ! empty( $_POST['description'] ) ? wp_kses_post( $_POST['description'] ) : '' );
				if ( empty( $_POST['album_id'] ) ) {
					$wpdb->insert(
						$wpdb->prefix . 'um_gallery_album',
						array(
							'album_name' => $album_name,
							'album_description' => $album_description,
							'creation_date'	=> date( 'Y-m-d H:i:s' ),
							'user_id' => $user_id,
							'album_status' => 1,
						),
						array(
							'%s',
							'%s',
							'%s',
							'%d',
							'%d',
						)
					);
					$album_id = $wpdb->insert_id;
					$results['new'] = true;
				} else {
					$id = (int) $_POST['album_id'];
					$wpdb->update(
						$wpdb->prefix . 'um_gallery_album',
						array(
							'album_name' 		=> $album_name,
							'album_description' => $album_description,
							'user_id' 			=> $user_id,
						),
						array( 'id' => $id ),
						array(
							'%s',
							'%s',
							'%d',
						),
						array( '%d' )
					);
					$album_id = $id;
					$results['new'] = false;
				}

				// Set categories
				// An array of IDs of categories we want this post to have.
				$cat_ids = ! empty( $_POST['tax_input']['um_gallery_category'] ) ?  $_POST['tax_input']['um_gallery_category'] : array();
				$cat_ids = array_map( 'intval', $cat_ids );
				$cat_ids = array_unique( $cat_ids );

				$term_taxonomy_ids = wp_set_object_terms( $album_id, $cat_ids, um_gallery()->field->category );

				$results['id'] 		= $album_id;
				$results['user_id'] = $user_id;
				do_action( 'um_gallery_album_updated', $results );
				if ( ! empty( $_POST['_wp_http_referer'] ) ) {
					$redirect_url = add_query_arg( 'album_updated', '1', $_POST['_wp_http_referer'] );
					wp_safe_redirect( $redirect_url );
				}
			}
		}
	}
	public function um_gallery_admin_delete() {
		check_ajax_referer( 'um_gallery_pro_sec', 'sec' );
		$type 	= sanitize_text_field( $_POST['type'] );
		$id		= (int) $_POST['id'];

		if ( empty( $type ) ) {
			wp_send_json_error();
		}

		if ( 'album' == $type ) {
			//delete album
			um_gallery_delete_album( $id );
		} elseif ( 'photo' == $type ) {
			//delete photo
			um_gallery_delete_photo( $id );
		}
		wp_send_json( $_POST );
	}

	public function update_admin_search_url() {
		//$doaction = $wp_list_table->current_action();
		if ( ! empty( $_REQUEST['page'] ) && $this->key == $_REQUEST['page'] && ! empty( $_GET['_wp_http_referer'] ) ) {
			wp_redirect( remove_query_arg( array( '_wp_http_referer', '_wpnonce' ), stripslashes( $_SERVER['REQUEST_URI'] ) ) );
			exit;
		}
	}
	public function cmb2_celebrations_sanitization( $override_value, $value ) {
		if ( ! empty( $value ) ) {
			$value = maybe_serialize( $value );
		}
		return $value;
	}
	/**
	 * Register our setting to WP
	 * @since  0.1.0
	 */
	public function init() {
		register_setting( $this->key, $this->key );
	}

	/**
	 * Add menu options page
	 * @since 0.1.0
	 */
	public function add_options_page() {
		$this->options_page = add_menu_page(
			$this->title,
			$this->title,
			'manage_options',
			$this->key,
			array( $this, 'gallery_list' ),
			'dashicons-format-gallery',
			50
		);
		add_submenu_page(
			$this->key,
			__( 'Albums', 'gallery-for-ultimate-member' ),
			__( 'Albums', 'gallery-for-ultimate-member' ),
			'manage_options',
			$this->key,
			array( $this, 'gallery_list' )
		);

		if ( um_gallery_pro_addon_enabled( 'category' ) ) {
			add_submenu_page( 
				'um_gallery_pro',
				__( 'Categories', 'gallery-for-ultimate-member' ),
				__( 'Categories', 'gallery-for-ultimate-member' ),
				'manage_options',
				'edit-tags.php?taxonomy=' . um_gallery()->field->category
			);
		}

		if ( um_gallery_pro_addon_enabled( 'tags' ) ) { 
			add_submenu_page( 
				'um_gallery_pro',
				__( 'Tags', 'gallery-for-ultimate-member' ),
				__( 'Tags', 'gallery-for-ultimate-member' ),
				'manage_options',
				'edit-tags.php?taxonomy=um_gallery_tag'
			);
		}
		// Release in 1.0.9
		/*
		add_submenu_page( 
			'um_gallery_pro',
			__( 'Fields', 'gallery-for-ultimate-member' ),
			__( 'Fields', 'gallery-for-ultimate-member' ),
			'manage_options',
			'edit.php?post_type=' . um_gallery()->field->field_post_type
		);
		*/
		add_submenu_page(
			$this->key,
			__( 'Settings', 'gallery-for-ultimate-member' ),
			__( 'Settings', 'gallery-for-ultimate-member' ),
			'manage_options',
			$this->setting_key,
			array( $this, 'um_gallery_settings_page' )
		);
		// Include CMB CSS in the head to avoid FOUC
		//add_action( "admin_print_styles-{$this->options_page}", array( 'CMB2_hookup', 'enqueue_cmb_css' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_cmb_css' ) );
		// Include CMB CSS in the head to avoid FOUC
		add_action( "admin_print_styles-{$this->options_page}", array( 'CMB2_hookup', 'enqueue_cmb_css' ) );
	}
	/*
	*	Returns album single view
	*/
	public function album_view_url() {
		global $album;
		return admin_url( 'admin.php?page=' . $this->key . '&view=edit_album&album_id=' . $album['id'] );
	}
	/*
	*
	*/
	public function load_template( $tpl ) {
		$file = UM_GALLERY_LITE_PATH . 'admin/templates/' . $tpl . '.php';
		if ( file_exists( $file ) ) {
			include $file;
		}
	}
	/*
	*
	*/
	public function gallery_list() {
		if ( is_admin() ) {
			$screen = get_current_screen();
		}
		if ( empty( $_GET['view'] ) ) {
			$this->load_template( 'gallery-list' );
		} elseif ( ! empty( $_GET['view'] ) && 'edit_album' == $_GET['view'] ) {
			$this->load_template( 'gallery-view' );
		} else {
			$this->load_template( 'gallery-view' );
		}
	}
	/**
	 * Load Settings Template
	 */
	public function um_gallery_settings_page() {
		$this->load_template( 'settings' );
	}


	public function enqueue_cmb_css( $hook ) {
		if ( 'ultimate-member_page_um_gallery_pro' != $hook ) {
			//return;
		}

		wp_enqueue_script(
			'um-gallery-dropzone',
			um_gallery()->plugin_url . '/assets/js/src/dropzone.js',
			array( 'jquery' )
		);
		wp_enqueue_style( 'um-gallery-admin-ui', '//ajax.googleapis.com/ajax/libs/jqueryui/1/themes/flick/jquery-ui.css' );
		wp_enqueue_style( 'um-gallery-admin-tag', um_gallery()->plugin_url . 'assets/css/src/jquery.tagit.css' );
		wp_enqueue_script( 'um-gallery-admin-tagit', um_gallery()->plugin_url . 'assets/js/src/tag-it.min.js', array( 'jquery','jquery-ui-core', 'jquery-ui-widget', 'jquery-ui-autocomplete', 'jquery-ui-position' ) );
		wp_enqueue_style( 'um-gallery-admin', um_gallery()->plugin_url . 'admin/assets/css/um-gallery-admin.css' );
		wp_enqueue_script( 'um-gallery-admin-reveal', um_gallery()->plugin_url . '/admin/assets/js/jquery.slidereveal.min.js', array( 'jquery' ) );
		wp_enqueue_script( 'um-gallery-admin-hb', um_gallery()->plugin_url . '/admin/assets/js/handlebars.js', array( 'jquery' ) );

		// Register the script
		wp_register_script( 'um_gallery_pro', um_gallery()->plugin_url . 'admin/assets/js/um-gallery-admin.js', array( 'jquery' ) );

		// Localize the script with new data
		$obj = array(
			'ajaxurl' 	=> admin_url( 'admin-ajax.php' ),
			'nonce' 	=> wp_create_nonce( 'um_gallery_pro_sec' ),
		);
		wp_localize_script( 'um_gallery_pro', 'um_gallery_obj', $obj );
		// Localize the script with new data
		$localization = array(
			'site_url' 				=> site_url(),
			'nonce' 				=> wp_create_nonce( 'um-event-nonce' ),
			'ajax_url' 				=> admin_url( 'admin-ajax.php' ),
			'loading_icon'          => admin_url( 'images/loading.gif' ),
			'is_owner' 				=> true,
			'save_text' 			=> __( 'Save', 'gallery-for-ultimate-member' ),
			'edit_text' 			=> __( '<i class="um-faicon-pencil"></i> Edit Caption', 'gallery-for-ultimate-member' ),
			'cancel_text' 			=> __( 'Cancel', 'gallery-for-ultimate-member' ),
			'album_id' 				=> um_galllery_get_album_id(),
			'dictDefaultMessage' 	=> '<span class="icon"><i class="um-faicon-picture-o"></i></span>
		<span class="str">' . __( 'Upload your photos', 'gallery-for-ultimate-member' ) . '</span>',
			'upload_complete' 		=> __( 'Upload Complete', 'gallery-for-ultimate-member' ),
			'no_events_txt' 		=> __( 'No photos found.', 'gallery-for-ultimate-member' ),
			'confirm_delete' 		=> __( 'Are you sure you want to delete this?', 'gallery-for-ultimate-member' ),
		);
		wp_localize_script( 'um_gallery_pro', 'um_gallery_config', $localization );
		// Enqueued script with localized data.
		wp_enqueue_script( 'um_gallery_pro' );
	}
	/**
	 * Admin page markup. Mostly handled by CMB2.
	 *
	 * @since  0.1.0
	 */
	public function admin_page_display() {
		$active_tab = $this->active_tab;
		?>
		<div class="wrap cmb2-options-page <?php echo $this->key; ?>">
			<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>
			<h2 class="nav-tab-wrapper">
				<a href="<?php echo admin_url( 'admin.php?page=' . $this->key . '&tab=general' ); ?>" class="nav-tab <?php echo ( 'general' == $active_tab ? 'nav-tab-active' : '' ); ?>"><?php _e( 'General', 'gallery-for-ultimate-member' ); ?></a>
				<a href="<?php echo admin_url( 'admin.php?page=' . $this->key . '&tab=labels' ); ?>" class="nav-tab <?php echo 'labels' == $active_tab  ? 'nav-tab-active' : ''; ?>"><?php _e( 'Labels', 'gallery-for-ultimate-member' ); ?></a>
				<a href="<?php echo admin_url( 'admin.php?page=' . $this->key . '&tab=addons' ); ?>" class="nav-tab <?php echo ( 'addons' == $active_tab ? 'nav-tab-active' : '' ); ?>"><?php _e( 'Addons', 'gallery-for-ultimate-member' ); ?></a>
			</h2>
			<?php
			if ( 'addons' === $active_tab ) {
				$this->addons_tab();
			} elseif ( 'advanced' === $active_tab ) {
				$this->tools_tab();
			} elseif ( 'labels' == $active_tab ) {
				cmb2_metabox_form( $this->metabox_id . '-labels', $this->key );
			} elseif ( 'layout' == $active_tab ) {
				cmb2_metabox_form( $this->metabox_id . '-layout', $this->key );
			} else {
				cmb2_metabox_form( $this->metabox_id, $this->key );
			}
			?>
		</div>
		<?php
	}

	public function gallery_admin_head() {
		$active_tab = $this->active_tab;
		?>
		<div class="wrap cmb2-options-page <?php echo $this->setting_key; ?>">
			<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>
			<h2 class="nav-tab-wrapper">
				<a href="<?php echo admin_url( 'admin.php?page=' . $this->setting_key . '&tab=general' ); ?>" class="nav-tab <?php echo ( 'general' == $active_tab ? 'nav-tab-active' : '' ); ?>"><?php _e( 'General', 'gallery-for-ultimate-member' ); ?></a>
				<a href="<?php echo admin_url( 'admin.php?page=' . $this->setting_key . '&tab=layout' ); ?>" class="nav-tab <?php echo 'layout' == $active_tab  ? 'nav-tab-active' : ''; ?>"><?php _e( 'Layout', 'gallery-for-ultimate-member' ); ?></a>
				<a href="<?php echo admin_url( 'admin.php?page=' . $this->setting_key . '&tab=labels' ); ?>" class="nav-tab <?php echo 'labels' == $active_tab  ? 'nav-tab-active' : ''; ?>"><?php _e( 'Labels', 'gallery-for-ultimate-member' ); ?></a>
				<a href="<?php echo admin_url( 'admin.php?page=' . $this->setting_key . '&tab=addons' ); ?>" class="nav-tab <?php echo ( 'addons' == $active_tab ? 'nav-tab-active' : '' ); ?>"><?php _e( 'Addons', 'gallery-for-ultimate-member' ); ?></a>
			</h2>
			<?php /*if ( 'layout' == $active_tab || ! $active_tab ) { ?>
			<div>
				<ul class="subsubsub">
					<a href="<?php echo admin_url( 'admin.php?page=' . $this->setting_key . '&tab=layout' . '&section=main' ); ?>" class="current">Default Tab</a> | 
					<a href="<?php echo admin_url( 'admin.php?page=' . $this->setting_key . '&tab=layout' . '&section=tab' ); ?>" class="">Tab</a>
				</ul>
			</div>
			<?php }*/ ?>
			<?php
	}

	/**
	 * Add the options metabox to the array of metaboxes.
	 *
	 * @since  0.1.0
	 */
	function add_options_page_metabox() {
		global $ultimatemember;
		// hook in our save notices
		add_action( "cmb2_save_options-page_fields_{$this->metabox_id}", array( $this, 'settings_notices' ), 10, 2 );

		$cmb = new_cmb2_box( array(
			'id'		 => $this->metabox_id,
			'hookup'	 => false,
			'cmb_styles' => true,
			'show_on'	=> array(
				// These are important, don't remove
				'key'   => 'options-page',
				'value' => array( $this->key ),
			),
		) );

		if ( ! empty( $ultimatemember ) || function_exists( 'UM' ) ) {
			$cmb->add_field( array(
				'name'		=> __( 'Allowed User Roles', 'um-classifieds' ),
				'id'	  	=> 'allowed_roles',
				'type'		=> 'multicheck',
				'options' 	=> function_exists( 'UM' ) ? UM()->roles()->get_roles() : $ultimatemember->query->get_roles(),
			) );

			$cmb->add_field( array(
					'id'       		=> 'um_gallery_profile',
					'type'     		=> 'radio_inline',
					'name'   		=> __( 'Show on Main Tab','gallery-for-ultimate-member' ),
					'default' 		=> 'on',
					'desc' 	   		=> __( 'If enabled, recent photo uploads will be placed on a user\'s profile main tab','gallery-for-ultimate-member' ),
					'options' => array(
						'on'			=> __( 'Yes','gallery-for-ultimate-member' ),
						'off'			=> __( 'No','gallery-for-ultimate-member' ),
					),
			) );

			$cmb->add_field( array(
					'id'       		=> 'um_gallery_cropped_images',
					'type'     		=> 'radio_inline',
					'name'   		=> __( 'Disable thumbnails','gallery-for-ultimate-member' ),
					'default' 		=> 'off',
					'desc' 	   		=> __( 'Use full images instead of cropped thumbnails','gallery-for-ultimate-member' ),
					'options' => array(
						'on'			=> __( 'Yes','gallery-for-ultimate-member' ),
						'off'			=> __( 'No','gallery-for-ultimate-member' ),
					),
			) );

			$cmb = new_cmb2_box( array(
				'id'         => $this->metabox_id . '-labels',
				'hookup'     => false,
				'cmb_styles' => true,
				'show_on'    => array(
					// These are important, don't remove
					'key'   => 'options-page',
					'value' => array( $this->key ),
				),
			) );

			$cmb->add_field( array(
					'id'       		=> 'um_gallery_tab_name',
					'type'     		=> 'text',
					'name'   		=> __( 'Tab Name','gallery-for-ultimate-member' ),
					'default'		=> __( 'Gallery', 'gallery-for-ultimate-member' ),
			) );

			$cmb->add_field( array(
					'id'       		=> 'um_gallery_tab_slug',
					'type'     		=> 'text',
					'name'   		=> __( 'Tab Slug','gallery-for-ultimate-member' ),
					'desc' 	   		=> __( 'Slug that displays in URL', 'gallery-for-ultimate-member' ),
					'default'		=> __( 'gallery', 'gallery-for-ultimate-member' ),
			) );

			$cmb->add_field( array(
					'id'       		=> 'um_gallery_tab_icon',
					'type'     		=> 'text',
					'name'   		=> __( 'Tab Icon','gallery-for-ultimate-member' ),
					'desc' 	   		=> __( 'Icon displayed in profile tab', 'gallery-for-ultimate-member' ),
					'default'		=> 'um-faicon-camera',
			) );
			
			$cmb->add_field( array(
				'id'       		=> 'um_gallery_default_album_name',
				'type'     		=> 'text',
				'name'   		=> __( 'Default Album Name', 'gallery-for-ultimate-member' ),
				'desc' 	   		=> __( 'Give each album a custom name in single album mode. Use the shortcode [username] or [user_id] to give each album something unique.', 'um-gallery-pro' ),
				'default'		=> __( 'Album by [user_id]', 'gallery-for-ultimate-member' ),
			) );

			$cmb->add_field( array(
					'id'       		=> 'um_gallery_add_photo_btn',
					'type'     		=> 'text',
					'name'   		=> __( 'Add Photo Button Text','gallery-for-ultimate-member' ),
					'desc' 	   		=> __( 'Displays in single album mode', 'gallery-for-ultimate-member' ),
					'default'		=> __( 'Add Photo','gallery-for-ultimate-member' ),
			) );

			$cmb->add_field( array(
					'id'       		=> 'um_gallery_modal_title',
					'type'     		=> 'text',
					'name'   		=> __( 'Manage Album Title', 'gallery-for-ultimate-member' ),
					'desc' 	   		=> __( 'Displays above modal popup', 'gallery-for-ultimate-member' ),
					'default'		=> __( 'Manage Album','gallery-for-ultimate-member' ),
			) );

			$cmb->add_field( array(
					'id'       		=> 'um_gallery_add_photos_tab',
					'type'     		=> 'text',
					'name'   		=> __( 'Add Photos', 'gallery-for-ultimate-member' ),
					'desc' 	   		=> __( 'Photos Tab inside Modal Uploader', 'gallery-for-ultimate-member' ),
					'default'		=> __( 'Add Photos','gallery-for-ultimate-member' ),
			) );

			$cmb->add_field( array(
					'id'       		=> 'um_gallery_add_videos_tab',
					'type'     		=> 'text',
					'name'   		=> __( 'Add Videos', 'gallery-for-ultimate-member' ),
					'desc' 	   		=> __( 'Videos Tab inside Modal Uploader', 'gallery-for-ultimate-member' ),
					'default'		=> __( 'Add Videos','gallery-for-ultimate-member' ),
			) );

			$cmb->add_field( array(
					'id'       		=> 'um_gallery_upload_photos_text',
					'type'     		=> 'text',
					'name'   		=> __( 'Upload your photos placeholder', 'gallery-for-ultimate-member' ),
					'desc' 	   		=> __( 'Text inside modal photos upload screen', 'gallery-for-ultimate-member' ),
					'default'		=> __( 'Upload your photos','gallery-for-ultimate-member' ),
			) );

			$cmb->add_field( array(
					'id'       		=> 'um_gallery_video_placeholder_text',
					'type'     		=> 'text',
					'name'   		=> __( 'Video URL Placeholder', 'gallery-for-ultimate-member' ),
					'desc' 	   		=> __( 'Placeholder text inside of video uploader field', 'gallery-for-ultimate-member' ),
					'default'		=> __( 'Video URL','gallery-for-ultimate-member' ),
			) );

			$cmb->add_field( array(
					'id'       		=> 'um_gallery_add_video_button',
					'type'     		=> 'text',
					'name'   		=> __( 'Add Video Button Text', 'gallery-for-ultimate-member' ),
					'desc' 	   		=> __( 'Text inside of video add button', 'gallery-for-ultimate-member' ),
					'default'		=> __( 'Add Video','gallery-for-ultimate-member' ),
			) );

			$cmb->add_field( array(
					'id'       		=> 'um_gallery_save_button',
					'type'     		=> 'text',
					'name'   		=> __( 'Save Button', 'gallery-for-ultimate-member' ),
					'desc' 	   		=> __( 'Save button inside of modal photos uploader', 'gallery-for-ultimate-member' ),
					'default'		=> __( 'Save','gallery-for-ultimate-member' ),
			) );

			$cmb->add_field( array(
					'id'       		=> 'um_gallery_cancel_button',
					'type'     		=> 'text',
					'name'   		=> __( 'Cancel Button', 'gallery-for-ultimate-member' ),
					'desc' 	   		=> __( 'Cancel button inside of modal photos uploader', 'gallery-for-ultimate-member' ),
					'default'		=> __( 'Cancel','gallery-for-ultimate-member' ),
			) );

			$cmb = new_cmb2_box( array(
				'id'         => $this->metabox_id . '-layout',
				'hookup'     => false,
				'cmb_styles' => true,
				'show_on'    => array(
					// These are important, don't remove
					'key'   => 'options-page',
					'value' => array( $this->key ),
				),
			) );
			$cmb->add_field( array(
					'id'       		=> 'main_tab_header',
					'type'     		=> 'gheader',
					'name'			=> __( 'Gallery Tab', 'gallery-for-ultimate-member' )
			) );

			$cmb->add_field( array(
					'id'       		=> 'um_gallery_profile_count',
					'type'     		=> 'text',
					'name'   		=> __( 'Photos on profile','gallery-for-ultimate-member' ),
					'desc' 	   		=> __( 'Set the number of photos on profile','gallery-for-ultimate-member' ),
					'default'		=> 10,
			) );

			$cmb->add_field( array(
					'id'       		=> 'um_gallery_tab',
					'type'     		=> 'radio_inline',
					'name'   		=> __( 'Show Gallery Tab','gallery-for-ultimate-member' ),
					'default' 		=> 'off',
					'desc' 	   		=> __( 'If enabled, a gallery tab will be placed on a user\'s profile page','gallery-for-ultimate-member' ),
					'options' => array(
						'on'			=> __( 'Yes','gallery-for-ultimate-member' ),
						'off'			=> __( 'No','gallery-for-ultimate-member' ),
					),
			) );

			$cmb->add_field( array(
					'id'       		=> 'main_profile_header',
					'type'     		=> 'gheader',
					'name'			=> __( 'Main/Profile Tab' )
			) );

			$cmb->add_field( array(
					'id'       		=> 'um_main_gallery_type',
					'type'     		=> 'select',
					'select2'		=> array( 'allowClear' => 0, 'minimumResultsForSearch' => -1 ),
					'name'    		=> __( 'Profile Layout Type','gallery-for-ultimate-member' ),
					'desc' 	   		=> __( 'Select the type of layout for gallery on gallery tab','gallery-for-ultimate-member' ),
					'default'  		=> 'grid',
					'options' 		=> array(
										'carousel' 		=> __( 'Carousel','gallery-for-ultimate-member' ),
										'grid' 			=> __( 'Grid','gallery-for-ultimate-member' ),
										'slideshow' 	=> __( 'Slideshow','gallery-for-ultimate-member' ),
					),
					'placeholder' 	=> __( 'Choose layout...','gallery-for-ultimate-member' ),
			) );

			$cmb->add_field( array(
					'id'       		=> 'carousel_setting',
					'type'     		=> 'gheader',
					'name'			=> __( 'Carousel/Slideshow settings', 'gallery-for-ultimate-member' ),
					'description'	=> __( 'Changed the settings used by the Carousel or Slideshow below.', 'gallery-for-ultimate-member' ),
			) );

			$cmb->add_field( array(
					'id'       		=> 'um_gallery_carousel_item_count',
					'type'     		=> 'text',
					'name'   		=> __( 'Number of items in Carousel','gallery-for-ultimate-member' ),
					'desc' 	   		=> __( 'Set the number of photos to display in Carousel','gallery-for-ultimate-member' ),
					'default'		=> 10,
			) );
			$cmb->add_field( array(
					'id'       		=> 'um_gallery_seconds_count',
					'type'     		=> 'text',
					'name'   		=> __( 'Number of seconds for Autoplay','gallery-for-ultimate-member' ),
					'desc' 	   		=> __( 'Set the Slideshow/Carousel Autoplay in seconds','gallery-for-ultimate-member' ),
					'default'		=> 0,
			) );
			$cmb->add_field( array(
					'id'       		=> 'um_gallery_autoplay',
					'type'     		=> 'radio_inline',
					'name'   		=> __( 'AutoPlay Slideshow/Carousel','gallery-for-ultimate-member' ),
					'default' 		=> 'off',
					'desc' 	   		=> __( 'If enabled, the gallery will auto play on a user\'s profile page','gallery-for-ultimate-member' ),
					'options' => array(
						'on'			=> __( 'Yes','gallery-for-ultimate-member' ),
						'off'			=> __( 'No','gallery-for-ultimate-member' ),
					),
			) );

			$cmb->add_field( array(
					'id'       		=> 'um_gallery_pagination',
					'type'     		=> 'radio_inline',
					'name'   		=> __( 'Turn Pagination On','gallery-for-ultimate-member' ),
					'default' 		=> 'off',
					'desc' 	   		=> __( 'Enable this to display Pagination','gallery-for-ultimate-member' ),
					'options' => array(
						'on'			=> __( 'Yes','gallery-for-ultimate-member' ),
						'off'			=> __( 'No','gallery-for-ultimate-member' ),
					),
			) );
			$cmb->add_field( array(
					'id'       		=> 'um_gallery_autoheight',
					'type'     		=> 'radio_inline',
					'name'   		=> __( 'Turn AutoHeight On','gallery-for-ultimate-member' ),
					'default' 		=> 'off',
					'desc' 	   		=> __( 'Enable this to turn AutoHeight on','gallery-for-ultimate-member' ),
					'options' => array(
						'on'			=> __( 'Yes','gallery-for-ultimate-member' ),
						'off'			=> __( 'No','gallery-for-ultimate-member' ),
					),
			) );

			$cmb->add_field( array(
					'id'       		=> 'mischeader',
					'type'     		=> 'gheader',
					'name'			=> __( 'Other', 'gallery-for-ultimate-member' ),
			) );

			$cmb->add_field( array(
					'id'       		=> 'um_gallery_fullscreen',
					'type'     		=> 'radio_inline',
					'name'   		=> __( 'Show full screen button','gallery-for-ultimate-member' ),
					'default' 		=> 'on',
					'desc' 	   		=> __( 'Enable this to show the fullscreen button','gallery-for-ultimate-member' ),
					'options' => array(
						'on'			=> __( 'Yes','gallery-for-ultimate-member' ),
						'off'			=> __( 'No','gallery-for-ultimate-member' ),
					),
			) );

			$cmb->add_field( array(
					'id'       		=> 'close_modal_save',
					'type'     		=> 'radio_inline',
					'name'   		=> __( 'Close Modal after update','gallery-for-ultimate-member' ),
					'default' 		=> 'off',
					'desc' 	   		=> __( 'Enable this to close modal after an album is updated or after files and videos have been added.','gallery-for-ultimate-member' ),
					'options' => array(
						'on'			=> __( 'Yes','gallery-for-ultimate-member' ),
						'off'			=> __( 'No','gallery-for-ultimate-member' ),
					),
			) );
		}

	}

	/**
	 * Private method used to output field name and description fields.
	 *
	 * @since 1.0.6
	 */
	private function name_and_description() {
		global $album;
	?>

		<div id="titlediv">
			<div class="titlewrap">
				<label id="title-prompt-text" for="title"></label>
				<input type="text" name="title" id="title" value="<?php echo esc_attr( $album->album_name ); ?>" placeholder="<?php echo esc_attr__( 'Name (required)', 'gallery-for-ultimate-member' ); ?>" autocomplete="off" />
			</div>
		</div>

		<div class="postbox">
			<h2><?php echo esc_html_x( 'Description', 'UM Gallery Pro admin edit field', 'gallery-for-ultimate-member' ); ?></h2>
			<div class="inside">
				<label for="description" class="screen-reader-text"><?php
					/* translators: accessibility text */
					esc_html_e( 'Add description', 'buddypress' );
				?></label>
				<textarea name="description" class="um-gallery-text-edit" id="description" rows="8" cols="60"><?php echo esc_textarea( $album->album_description ); ?></textarea>
			</div>
		</div>

	<?php
	}

	private function add_photo_button() {
		/**
		 * TODO: Make functional in next version
		 */
		return;
		?>
		<div class="um-gallery-pro-button-wrapper"><a href="#" class="um-gallery-form"><span class="dashicons dashicons-plus-alt"></span> <?php _e( 'Add Images','gallery-for-ultimate-member' ); ?></a></div>
		<?php
	}
	private function gallery_items( $album_id ) {
		global $wpdb;
		global $photo;
		$query = "SELECT a.* FROM {$wpdb->prefix}um_gallery AS a WHERE a.album_id='{$album_id}' ORDER BY a.id DESC";
		$photos = $wpdb->get_results( $query );
		if ( ! empty( $photos ) ) :
			echo '<div class="um-gallery-album-list">';
			foreach ( $photos as $item ) :
				$photo = um_gallery_setup_photo( $item );
				?>
				<div class="um-gallery-grid-item">
				  <div class="um-gallery-inner">
					<div class="um-gallery-img"><a href="#"><img src="<?php um_gallery_the_image_url(); ?>"></a></div>
					<div class="um-gallery-info">
					  <div class="um-gallery-title"><h2><?php echo $photo->caption; ?></h2><?php /*?><a href="<?php //echo um_gallery()->admin->album_view_url(); ?>"><?php echo $photo->caption; ?></a><?php */?></div>
					  <div class="um-gallery-meta"></div>
					  <div class="um-gallery-action">
						  <a href="#" class="um-gallery-delete-photo" data-item_id="<?php echo $photo->id; ?>" data-type="photo"><span class="dashicons dashicons-trash"></span></a>
						  <a href="#" class="um-gallery-edit-photo" data-ps-options="{bodyClass: 'ps-active'}" data-item_id="<?php echo $photo->id; ?>" data-type="photo"><span class="dashicons dashicons-edit"></span></a>
					  </div>
					</div>
				  </div>
				</div>
				<?php
			endforeach;
			echo '</div>';
		else :
			?>
			<div class="um-gallery-none postbox">
				<div class="inside">
					<?php _e( 'No media found', 'gallery-for-ultimate-member' ); ?>
				</div>
			</div>
			<?php
		endif;
	}

	private function publishing_options() {
		global $album;
		$selected_user = $album->user_id;
		?>
		<div id="um-gallery-pro-publishing" class="postbox">
			<h2><?php _e( 'Actions', 'buddypress' ); ?></h2>
			<div class="inside">
				<div class="um-gallery-pro-user-list um-gallery-pro-action-row">
					<label for="user_id"><?php _e( 'Owner', 'gallery-for-ultimate-member' ); ?></label>
					<select name="user_id" id="user_id">
					<?php foreach ( $this->get_users_list() as $k => $user_id ) { ?>
						<?php um_fetch_user( $user_id ); ?>
						<option value="<?php echo $user_id; ?>" <?php echo ( $user_id == $selected_user ? ' selected="selected" ' : '' ); ?>><?php echo um_user( 'display_name' ) ?></option>
						<?php um_reset_user(); ?>
					<?php } ?>
					</select>
				</div>
				<div class="um-gallery-pro-button-wrapper"><input type="submit" name="submit_album_admin" value="<?php _e( 'Save Album','gallery-for-ultimate-member' ); ?>" class="button button-primary" /></div>
			</div>
		</div>
		<?php
	}

	private function get_users_list() {
		global $wpdb;
		$users = $wpdb->get_col( "SELECT ID FROM {$wpdb->users} ORDER BY display_name" );
		return $users;
	}

	public function addons_tab() {
		$this->load_template( 'addons' );
	}

	public function tools_tab() {
		$this->load_template( 'tools' );
	}

	/**
	 * Register settings notices for display
	 *
	 * @since  0.1.0
	 * @param  int   $object_id Option key
	 * @param  array $updated   Array of updated fields
	 * @return void
	 */
	public function settings_notices( $object_id, $updated ) {
		if ( $object_id !== $this->key || empty( $updated ) ) {
			return;
		}

		add_settings_error( $this->key . '-notices', '', __( 'Settings updated.', 'myprefix' ), 'updated' );
		settings_errors( $this->key . '-notices' );
	}

	/**
	 * Public getter method for retrieving protected/private variables
	 * @since  0.1.0
	 * @param  string  $field Field to retrieve
	 * @return mixed		  Field value or exception is thrown
	 */
	public function __get( $field ) {
		// Allowed fields to retrieve
		if ( in_array( $field, array( 'key', 'metabox_id', 'title', 'options_page' ), true ) ) {
			return $this->{$field};
		}

		throw new Exception( 'Invalid property: ' . $field );
	}

}

/**
 * Helper function to get/return the UM_GalleryPro_Admin object
 * @since  0.1.0
 * @return UM_GalleryPro_Admin object
 */
function um_gallery_pro_admin() {
	return UM_GalleryPro_Admin::get_instance();
}

// Get it started
um_gallery_pro_admin();
