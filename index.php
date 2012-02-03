<?php get_header(); ?>

  <?php query_posts( 'posts_per_page=1000' ); ?>
  <?php $sectionCount = 0 ?>
  <?php while (have_posts()) : the_post(); ?>
  <?php $media = get_post_meta($post->ID, 'image', true); ?>
  <?php $media4 = get_post_meta($post->ID, 'width', true); ?>
  <?php intermittent_date_header('Y', '</ul><h2 class="post the-year">', '</h2><ul class="content">', true, $sectionCount); ?>

    <div class="box <?php the_time('Y'); ?>">

     <?php get_template_part( 'content', get_post_format() ); ?>
             
    </div><!-- #post-<?php the_ID(); ?> -->
    
    <?php $sectionCount++ ?>
  <?php endwhile; ?>
</ul>
<!-- #content -->

<?php get_footer(); ?>