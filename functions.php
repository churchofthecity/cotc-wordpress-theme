//Customize Login PAGE
function wpb_login_logo() { ?>
  <style type="text/css">
  #login h1 a, .login h1 a {
    background-image: url(https://churchofthecity.com/wp-content/uploads/2018/05/COTC-Logo-Story-Submission.png);
    height:100px;
    width:300px;
    background-size: 300px 100px;
    background-repeat: no-repeat;
    padding-bottom: 10px;
  }
  </style>
<?php }
add_action( 'login_enqueue_scripts', 'wpb_login_logo' );

<?php
require 'event-calendar.php';



function remove_lostpassword_text ( $text ) {
  if ($text == 'Lost your password?'){$text = '';}
  return $text;
}
add_filter( 'gettext', 'remove_lostpassword_text' );

function disable_password_reset() { return false; }
add_filter ( 'allow_password_reset', 'disable_password_reset' );



// enqueue the child theme stylesheet

Function wp_schools_enqueue_scripts() {
  wp_register_style( 'childstyle', get_stylesheet_directory_uri() . '/style.css'  );
  wp_enqueue_style( 'childstyle' );
  wp_enqueue_script("cotc_custom", get_stylesheet_directory_uri() ."/js/cotc_custom.js", array('jquery'), false, true);
}
add_action( 'wp_enqueue_scripts', 'wp_schools_enqueue_scripts', 11);


// include_once('the-events-calendar-short-code.php');
include_once( get_stylesheet_directory() . '/the-events-calendar-short-code.php' );


// Override the rss event link
// This causes an error here:
// http://churchofthecity.com/category/40-days/feed/
// add_filter( 'the_permalink_rss', 'cotc_the_permalink_rss', 10, 0);
function cotc_the_permalink_rss() {
  global $post;
  if ($post->post_type == 'tribe_events') {
    $event_url = tribe_get_event_meta( $post->id, '_EventURL', true );
    if ( ! empty( $event_url ) ) {
      $parseUrl = parse_url( $event_url );
      if ( empty( $parseUrl['scheme'] ) ) {
        $event_url = "http://$event_url";
      }
      return $event_url;
    }
  } else {
    return the_permalink_rss();
  }
}



// Override the RSS2 feed
// remove_all_actions( 'do_feed_rss2' );
add_action( 'do_feed_rss2', 'cotc_feed_rss2', 10, 1 );

function cotc_feed_rss2( $for_comments ) {
    $rss_template = get_stylesheet_directory() . '/feed-cotc-rss2.php';
    if( get_query_var( 'post_type' ) == 'tribe_events' and file_exists( $rss_template ) )
        load_template( $rss_template );
    else
        do_feed_rss2( $for_comments ); // Call default function
}

// Supply the event date in the RSS feed content
function event_date_in_rss($content) {
  global $post;
  $news_only = get_post_custom_values('news_only');
  if( $post->post_type == 'tribe_events' && !$news_only ) {
    $content = '<p><em>Starts ' . tribe_get_start_date( $post, false, 'l F jS Y \a\t h:i A' ) . "</em></p>" . $content;
  }
  return $content;
}
