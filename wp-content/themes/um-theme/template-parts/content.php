<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package um-theme
 */

global $defaults;

// Layout 1
if ( 1 === $defaults['um_theme_blog_posts_layout'] ) :

	// First Post
	if ( 0 === $wp_query->current_post ) : ?>

		<article id="post-<?php the_ID();?>" <?php post_class( 'boot-col-sm-6' );?>>
			<div class="blog-post-container blog-post-one boot-text-center">

				<?php um_theme_post_thumbnail();?>

				<div class="blog-post-title entry-header boot-text-center">
					<h3 class="entry-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
				</div>

				<?php um_theme_category(); ?>

				<div class="entry-excerpt"><?php the_excerpt();?></div>

				<p class="more-link-wrap">
					<a href="<?php the_permalink();?>">
						<?php esc_html_e( 'Continue Reading', 'um-theme' );?>
					</a>
				</p>
			</div>
		</article>

	<?php
	endif;

	// Second Post
	if ( 1 === $wp_query->current_post ) : ?>

			<article id="post-<?php the_ID();?>" <?php post_class( 'boot-col-sm-6' );?> >
				<div class="blog-post-container blog-post-one boot-text-center">

					<?php um_theme_post_thumbnail();?>

					<div class="blog-post-title entry-header boot-text-center">
						<h3 class="entry-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
					</div>

					<?php um_theme_category(); ?>

					<div class="entry-excerpt"><?php the_excerpt();?></div>

					<p class="more-link-wrap">
						<a href="<?php the_permalink();?>">
							<?php esc_html_e( 'Continue Reading', 'um-theme' );?>
						</a>
					</p>

				</div>
			</article>

	<?php
	endif;

	// rest of the posts.
	if ( $wp_query->current_post > 1 ) : ?>

			<article id="post-<?php the_ID();?>" <?php post_class( 'boot-col-sm-4' );?>>
				<div class="blog-post-container blog-post-one-alt boot-text-center">

					<?php um_theme_post_thumbnail();?>

					<div class="blog-post-title entry-header boot-text-center">
						<h4 class="entry-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
					</div>

				</div>
			</article>

	<?php endif;
endif;

// Layout 2
if ( 2 === $defaults['um_theme_blog_posts_layout'] ) : ?>

	<article id="post-<?php the_ID();?>" <?php post_class( 'boot-col-sm-12' );?>>

		<header class="entry-header">
			<h3 class="entry-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
		</header>

		<div class="post-header-meta">
			<?php um_published_on();?>
			<?php um_post_author();?>
			<span class="meta"><a href="<?php comments_link(); ?>"><?php comments_number( 'Leave a comment', '1 Response', '% Responses' ); ?></a></span>
		</div>

		<?php um_theme_post_thumbnail();?>

		<div class="post-content-meta excerpt"><?php the_excerpt();?></div>

	</article>

<?php endif;?>