<?php
/**
 * Template for the UM User Photos, the "New Album" modal content
 *
 * Page: "Profile", tab "Photos"
 * Caller: User_Photos_Ajax->get_um_ajax_gallery_view() method
 *
 * This template can be overridden by copying it to yourtheme/ultimate-member/um-user-photos/modal/add-album.php
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$disable_title = UM()->options()->get( 'um_user_photos_disable_title' );
$disable_cover = UM()->options()->get( 'um_user_photos_disable_cover' );
$count_user_photos = UM()->Photos_API()->common()->photos_count( $user_id );
$limit_user_photos = UM()->Photos_API()->common()->photos_limit( $user_id );
?>

<div class="um-form">
	<form method="post" action="<?php echo esc_url( admin_url( 'admin-ajax.php?action=create_um_user_photos_album' ) ); ?>" enctype="multipart/form-data" class="um-user-photos-modal-form"  data-max_size_error="<?php esc_html_e( 'is too large. File should be less than ', 'um-user-photos' ); ?>" data-max_size="<?php echo esc_attr( wp_max_upload_size() ); ?>" data-limit="<?php echo esc_attr( $limit_user_photos ); ?>" data-count="<?php echo esc_attr( $count_user_photos ); ?>">

		<div class="um-galley-form-response"></div>

		<?php if ( 1 !== (int) $disable_title ) { ?>
			<div class="um-field">
				<input type="text" name="title" placeholder="<?php esc_html_e( 'Album title', 'um-user-photos' ); ?>" required/>
			</div>
		<?php } ?>

		<div class="um-field">
			<?php if ( 1 !== (int) $disable_cover ) { ?>
			<div class="text-center">
				<h1 class="album-poster-holder">
					<label class="album-poster-label">
						<i class="um-faicon-picture-o"></i><br/>
						<span><?php esc_html_e( 'Album cover', 'um-user-photos' ); ?></span>
						<input id="um-user-photos-input-album-cover" style="display:none;" type="file" name="album_cover" accept="image/*" />
					</label>
				</h1>
			</div>
			<?php } ?>
			<div id="um-user-photos-images-uploaded"></div>
			<div class="um-clearfix"></div>
		</div>
		<div class="um-user-photos-error" <?php echo ( false !== $limit_user_photos && (int) $count_user_photos >= (int) $limit_user_photos ) ? '' : 'style="display:none;"'; ?>><?php esc_html_e( 'You cannot upload more photos, you have reached the limit of uploads. Delete old photos to add new ones.', 'um-user-photos' ); ?></div>
		<div class="um-field um-user-photos-modal-footer text-right">
			<button type="button" class="um-modal-btn um-galley-modal-update"><?php esc_html_e( 'Publish', 'um-user-photos' ); ?></button>
			<label class="um-modal-btn alt" <?php echo ( false === $limit_user_photos || (int) $count_user_photos < (int) $limit_user_photos ) ? '' : 'style="display:none;"'; ?>>
				<i class="um-icon-plus"></i>
				<?php esc_html_e( 'Select photos', 'um-user-photos' ); ?>
				<input id="um-user-photos-input-album-images" style="display:none;" type="file" name="album_images[]" accept="image/*" multiple <?php echo ( false === $limit_user_photos || (int) $count_user_photos < (int) $limit_user_photos ) ? '' : 'disabled'; ?> />
			</label>
			<a href="javascript:void(0);" class="um-modal-btn alt um-user-photos-modal-close-link"><?php esc_html_e( 'Cancel', 'um-user-photos' ); ?></a>
		</div>
		<?php wp_nonce_field( 'um_add_album' ); ?>
	</form>
</div>
