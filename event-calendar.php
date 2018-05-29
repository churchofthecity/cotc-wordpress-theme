<?php

function cotc_campus_codes() {
  return array("antioch"        => "AN",
               "east-nashville" => "EN",
               "franklin"       => "FR",
               "spring-hill"    => "SH",
               "sylvan-park"    => "SP");
}

function cotc_campus_names() {
  return array("Antioch"        => "AN",
               "East Nashville" => "EN",
               "Franklin"       => "FR",
               "Spring Hill"    => "SH",
               "Sylvan Park"    => "SP");
}

/* Map the category slug to a campus code */
function campus_code_for_event($event) {
  $event_cats = tribe_get_event_cat_slugs($event->id);

  foreach(cotc_campus_codes() as $shortname => $code) {
    if (in_array($shortname, $event_cats)) {
      return $code;
    }
  }
}

// Override the event link
add_filter( 'tribe_get_event_link', 'cotc_tribe_get_event_link', 10, 4);
function cotc_tribe_get_event_link($link, $postId, $full_link, $url ) {
  $event_url = tribe_get_event_meta( $postId, '_EventURL', true );
  if ( ! empty( $event_url ) ) {
    $parseUrl = parse_url( $event_url );
    if ( empty( $parseUrl['scheme'] ) ) {
      $event_url = "http://$event_url";
    }
    return $event_url;
  } else {
    return $link;
  }
}

/* Setup campus selection in the event calendar filter bar */
add_filter( 'tribe-events-bar-filters', 'setup_cotc_campus_in_event_bar', -1, 1 );
function setup_cotc_campus_in_event_bar( $filters ) {
  $query = tribe_get_global_query_object();
  $eventsSlug = tribe_get_option( 'eventsSlug');

  $campuses = "";
  $legend = "<div class='cotc-legend'>";
  foreach(cotc_campus_codes() as $shortname => $code) {
    $class = "";
    if ($query->query_vars["tribe_events_cat"] == $shortname) {
      $class = "inverted";
      $link = "/" . $eventsSlug;
    } else {
      $link = "/" . $eventsSlug . "/category/" . $shortname;
    }
    $campuses .= "<a class='cotc-campus " . $class . "' href=". $link . ">" . $code . "</a>";
  }
  $campuses .= "<a href=/". $eventsSlug . ">All</a>";
  foreach(cotc_campus_names() as $name => $code) {
    $legend .= "<span>" . $code . ': ' . $name . "</span>";
  }
  $legend .= "</div>";

  if ( tribe_get_option( 'tribeDisableTribeBar', false ) == false ) {
    $filters['tribe-bar-cotc-campus'] = array(
      'name'    => 'tribe-bar-cotc-campus',
      'caption' => esc_html__( 'Neighborhood Church', 'the-events-calendar' ),
      'html'    => $campuses . $legend
    );
  }

  return $filters;
}
//
// add_filter( 'tribe_events_before_the_title', 'setup_cotc_campus_legend', 1, 1 );
// function setup_cotc_campus_legend() {
//   echo "FOO!";
// }
?>
