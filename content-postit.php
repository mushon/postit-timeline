<?php
/**
 * The template for displaying content for the postit template
 *
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>

		<div class="entry-meta">
			<?php echo get_post_meta($post->ID, 'year', true); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
	</div><!-- .entry-content -->

	<footer class="entry-meta">
		<?php
			echo get_the_category_list( __( ', ', 'twentyeleven' ) );?>
	</footer><!-- .entry-meta -->
</article><!-- #post-<?php the_ID(); ?> -->
