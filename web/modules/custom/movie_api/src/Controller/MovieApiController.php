<?php

namespace Drupal\movie_api\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Drupal\node\Entity\Node;
use Drupal\taxonomy\Entity\Term;

class MovieApiController {

  /**
   * Returns a list of movies.
   */
  public function getMovies() {
    // Query to get nodes of content type 'movie'.
    $query = \Drupal::entityQuery('node')
      ->condition('type', 'events')
      ->condition('status', 1) // Only published nodes
      ->accessCheck(TRUE);     // Check access for the current user

    $nids = $query->execute();

    // Load the movie nodes.
    $movies = Node::loadMultiple($nids);
    $movie_list = [];

    foreach ($movies as $movie) {
      $event_type_tid = $movie->get('field_event_type')->target_id; // Taxonomy term ID
      $event_date = $movie->get('field_event_date')->value; // Date value
      $event_type_term = Term::load($event_type_tid);
      $event_type_name = $event_type_term ? $event_type_term->getName() : '';
      $movie_list[] = [
        'title' => $movie->getTitle(),
        'body' => $movie->get('body')->summary, // Gets the summary of the body field
        'event_type' => $event_type_name, // Name of the taxonomy term
        'event_date' => $event_date, // Date of the event
      ];
    } 
    return new JsonResponse($movie_list);
    }
    // Return the data as JSON.
   
}
