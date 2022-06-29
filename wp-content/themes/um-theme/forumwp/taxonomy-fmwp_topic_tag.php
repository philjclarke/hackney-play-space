<?php if ( ! defined( 'ABSPATH' ) ) exit;

get_header(); ?>
<div class="website-canvas">
<div class="boot-row">
	<section id="primary" class="content-area <?php um_determine_single_content_width();?>">
		<main id="main" class="site-main" role="main">

			<header class="page-header">
				<?php the_archive_title( '<h1 class="page-title">', '</h1>' ); ?>
			</header><!-- .page-header -->

			<article class="fmwp_topic type-fmwp_topic status-publish format-standard hentry category-uncategorized entry">
				<div class="entry-content">
					<?php $term_id = get_queried_object_id();

					if ( version_compare( get_bloginfo( 'version' ),'5.4', '<' ) ) {
						echo do_shortcode( '[fmwp_topics tag="' . $term_id . '" new_topic="no" /]' );
					} else {
						echo apply_shortcodes( '[fmwp_topics tag="' . $term_id . '" new_topic="no" /]' );
					}
					?>
				</div>
			</article>
		</main><!-- #main -->
	</section><!-- #primary -->

	<?php get_sidebar(); ?>
</div>
</div>
<?php
get_footer();