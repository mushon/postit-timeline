<?php
// For use on pages which list posts, and to be used within the_loop(). Outputs a
// date header to split up the post listings. See the_date() template tag docs for
// usage: http://codex.wordpress.org/Template_Tags/the_date


/* Add Arabella footer
-------------------------------------------------------------- */

function arabella_footer ($content){
  
  $page_data = get_page_by_path( 'add' );
  $form = '<h2>' . apply_filters('the_content', $page_data->post_title) . '</h2>';  
  $form .= apply_filters('the_content', $page_data->post_content);
  echo '</div>
  </div>
  <section id="add">' . $form . '</section>
    <iframe id="siteFooter" src="http://www.arabellaadvisors.com/static-footer/"></iframe>
  <div>' . $content;
}

add_filter('get_footer','arabella_footer');

/* Add to HEAD
-------------------------------------------------------------- */


function headjs(){
  ?>  
  
  <!-- jQuery + Plugins
  *************************************************** -->
  <script src="<?php bloginfo('wpurl') ?>/wp-includes/js/jquery/jquery.js" type="text/javascript"></script>
  <!-- For the scroll -->
  <script src="<?php bloginfo('stylesheet_directory') ?>/js/jquery.scrollTo.js" type="text/javascript"></script>
  <script src="<?php bloginfo('stylesheet_directory') ?>/js/jquery.localscroll.js" type="text/javascript"></script>
  <!-- For the focus -->
  <script src="<?php bloginfo('stylesheet_directory') ?>/js/jquery-ui.js" type="text/javascript"></script>
  <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_directory') ?>/js/jquery-ui.css" />
  <!-- For the future -->
  <script src="<?php bloginfo('stylesheet_directory') ?>/js/modernizr-2.js" type="text/javascript"></script>
  
  
  

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
  
    jQuery('#page').append(jQuery('<ul id="nav" class="internal"><li><h3>now</h3></li></ul>'));
    
    jQuery("div.content").each(function() {
      var navItem = '<li><a href="#' + jQuery(this).attr("id") + '"><span>' + jQuery(this).attr("name") + '</span></a></li>';
      jQuery('ul#nav').append(navItem);
    });
    
    jQuery('ul#nav').append('<li><h3>then</h3></li>');
    
    jQuery('.internal').localScroll();
    

/* Flip on click
  ***************************************************/
			
			jQuery('body.home').append(jQuery('<div id="shade"></div>'));
			
			// set up click/tap panels
			jQuery('.box .post').toggle(function(){
			  jQuery('.box').removeClass('top');
				jQuery(this).parent().addClass('flip');
				jQuery('body').addClass('flipped');
				
				// set up shade interaction:
  			jQuery('#shade').click(function(){
  				jQuery('.flip').removeClass('flip').addClass('top');
  				jQuery('body').removeClass('flipped');
  				jQuery('.top').addEventListener("transitionend", function(){
    				jQuery('.top').removeClass('top');
          }, true);
  			});
  			
			},function(){
				jQuery(this).parent().removeClass('flip').addClass('top');
				jQuery('body').removeClass('flipped');
				jQuery('.top').addEventListener("transitionend", function(){
  				jQuery('.top').removeClass('top');
        }, true);
			});
			
		});
  
  </script>
  
  <link rel="stylesheet" href="http://use.typekit.com/k/lft2tly-d.css?3bb2a6e53c9684ffdc9a9bf01f5b2a62dc1020e61a7e41334f5590cfa9cb5688e25e70b94b41ca58a824b5df6ba2cc0c3d7772edab072324bd83f861dfc769caca8b1e59a31d7fd90553e586cb2a606505a656e45793c5063b4719fccff0d9d73780587de8ea2e23c25a60b4c124ab36aeb484dc97400efa6c3acdd7055ce26978fcf85775c2ece7fd09422545a41356d747476d2ccc03693a1c97bac4a4d50dba9fed657d">
  <script type="text/javascript">
    try{Typekit.load();}catch(e){}
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