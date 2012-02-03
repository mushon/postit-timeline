<?php
// For use on pages which list posts, and to be used within the_loop(). Outputs a
// date header to split up the post listings. See the_date() template tag docs for
// usage: http://codex.wordpress.org/Template_Tags/the_date


/* Add Arabella header & footer
-------------------------------------------------------------- */


function arabella_footer ($content){
  echo '</div>
  </div>
    <iframe id="siteFooter" src="http://dev-arabella.thisisvisceral.com/static-footer/"></iframe>
  <div>' . $content;
}

add_filter('get_footer','arabella_footer');

/* Add to HEAD
-------------------------------------------------------------- */


function headjs(){
  ?>  
  
  <!-- jQuery
  *************************************************** -->
  <script src="<?php bloginfo('wpurl') ?>/wp-includes/js/jquery/jquery.js" type="text/javascript"></script>
  <script src="<?php bloginfo('stylesheet_directory') ?>/js/jquery.scrollTo.js" type="text/javascript"></script>
  <script src="<?php bloginfo('stylesheet_directory') ?>/js/jquery.localscroll.js" type="text/javascript"></script>
  

  <script type="text/javascript">

  jQuery(document).ready(function(){

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
    
    
/* One Page Nav
  ***************************************************/
  
    jQuery('#page').append(jQuery('<ul id="nav"><li><h3>now</h3></li></ul>'));
    
    jQuery("div.content").each(function() {
      var navItem = '<li><a href="#' + jQuery(this).attr("id") + '"><span>' + jQuery(this).attr("name") + '</span></a></li>';
      jQuery('ul#nav').append(navItem);
    });
    
    jQuery('ul#nav').append('<li><h3>then</h3></li>');
    
    jQuery('ul#nav').localScroll();
    
  }); 
  </script>
  
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
  $date = get_the_date( 'Y' );
  
  if($date<1800){
    $date = substr($date,0,-2)+1 . "th century";
  }else{
    $date = substr($date,0,-1) . "0's";
  }
  
  // Crop & Construct
  $date_header .= '<div class="content" id=' . str_replace(array(" ", "'"), "", $date) . ' name="' . $date . '">
                     <h2 class="post the-year"><span>' . 
                     $date . 
                     '</span></h2>';
                     
  // If it's the same, don't bother continuing
  if ( $date_header == $idh_last_date_header ) return;
  
  // Record the current date header as the last one
  $idh_last_date_header = $date_header;
  
  // Decide what to do, and do it. Return, or echo…
  if ( ! $echo ) return $date_header;
  echo $close . $date_header;
}

?>