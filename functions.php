<?php
// For use on pages which list posts, and to be used within the_loop(). Outputs a
// date header to split up the post listings. See the_date() template tag docs for
// usage: http://codex.wordpress.org/Template_Tags/the_date


/* Add to HEAD
-------------------------------------------------- */


function headjs(){
  ?>  
  
  <!-- jQuery
  *************************************************** -->
  <script src="<?php bloginfo('wpurl') ?>/wp-includes/js/jquery/jquery.js" type="text/javascript"></script>
  

  <script type="text/javascript">

  jQuery(document).ready(function(){
  
  
  /* count posts
  ***************************************************/
/*
    jQuery(".content").each(function() {
      var unit = jQuery(this).children(":first").width;
      var count = jQuery(this).children().length;
      var max = unit * count + 'px';
      //if (max < jQuery('#main').width){
        jQuery(this).css({'width': max});
      //}
    });
*/

  /* Randomize
  ***************************************************/
    jQuery(".box").each(function() {
       var numRand = Math.floor(30-Math.random()*30);
       var padd = "10px " + numRand + "px ";
       var wid =  180 - 2*numRand + "px ";
       var rot = 'rotate(' + (15 - numRand)/3 + 'deg)';
       jQuery(this).css({
              'padding': padd,
              'width': wid,
              'transform': rot,
              '-moz-transform': rot,
              'WebkitTransform': rot,
              '-o-transform': rot,
              '-ms-transform': rot
              });
    });
    
    
  }); 
  </script>
  
  <!-- Isotope
  *************************************************** -->
  <!--
  <script src="<?php bloginfo('stylesheet_directory') ?>/js/jquery.isotope.min.js" type="text/javascript"></script>

  <script type='text/javascript'>
    jQuery(document).ready(function() {
      jQuery('.content').isotope({
        // options
        itemSelector : '.box',
        layoutMode : 'masonry'
      });
    });
  </script>
  -->
  
  <link href='http://fonts.googleapis.com/css?family=Handlee' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Permanent+Marker' rel='stylesheet' type='text/css'>
  <?php

}
add_filter('wp_head','headjs');


function intermittent_date_header( $d='', $before='', $after='', $echo = true, $sectionCount )
{
  
  if($sectionCount > 0) $close = '</div>';
  
  global $idh_last_date_header;
  
  // Get the current date:
  $date = substr(get_the_date( 'Y' ),0,-1) . "0";
  
  // Crop & Construct
  $date_header .= '<div class="content" id=' . $date . '>
                     <h2 class="post the-year">' . 
                     $date . "'s". 
                     '</h2>';
  
  // If it's the same, don't bother continuing
  if ( $date_header == $idh_last_date_header ) return;
  
  // Record the current date header as the last one
  $idh_last_date_header = $date_header;
  
  // Decide what to do, and do it. Return, or echo…
  if ( ! $echo ) return $date_header;
  echo $close . $date_header;
}

?>