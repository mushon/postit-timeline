<?php
get_header();

  query_posts( 'posts_per_page=1000' );
  query_posts( "meta_key=year&orderby=meta_value_num&order=DESC" );
  $sectionCount = 0;
  while (have_posts()) : the_post();
    $post_id = $post->ID;
    $year = get_post_meta($post_id, 'year', true);
    $media = get_post_meta($post_id, 'image', true);
    $media4 = get_post_meta($post_id, 'width', true);
    intermittent_date_header('Y', '</ul><h2 class="post the-year">', '</h2><ul class="content">', true, $sectionCount, $year); ?>

    <div class="box <?php echo $year; ?>">

     <?php get_template_part( 'content', 'postit' ); ?>
             
    </div><!-- #post-<?php the_ID(); ?> -->
    
    <?php $sectionCount++ ?>
  <?php endwhile; ?>
</ul>
<!-- #content -->

<?php get_footer(); ?>