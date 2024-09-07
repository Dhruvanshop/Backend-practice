<?php

namespace Drupal\taxonomy_term_info\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Request;
use Drupal\node\Entity\Node;

class TermInfoController extends ControllerBase {

  public function termInfoPage(Request $request) {
    // Retrieve the term_name query parameter.
    $term_name = $request->query->get('term_name');

    if (!$term_name) {
      return [
        '#markup' => 'No term name provided.',
      ];
    }

    // Load the term by name.
    $terms = \Drupal::entityTypeManager()->getStorage('taxonomy_term')->loadByProperties(['name' => $term_name]);
    if (empty($terms)) {
      return [
        '#markup' => 'Term not found.',
      ];
    }

    $term = reset($terms);
    $term_id = $term->id();
    $term_uuid = $term->uuid();

    // Query nodes with the term.
    $query = \Drupal::entityQuery('node')
      ->condition('status', 1)
      ->condition('field_event_type.target_id', $term_id)
      ->accessCheck(TRUE);
    $nids = $query->execute();

    $nodes = Node::loadMultiple($nids);
    $node_info = [];

    foreach ($nodes as $node) {
      $node_info[] = [
        'title' => $node->getTitle(),
        'url' => $node->toUrl()->toString(),
      ];
    }

    // Prepare the output.
    $output = [
      '#markup' => '<div>Term ID: ' . $term_id . '<br>Term UUID: ' . $term_uuid . '</div>',
    ];

    if (!empty($node_info)) {
      foreach ($node_info as $info) {
        $output['#markup'] .= '<div>Node Title: ' . $info['title'] . ' | URL: ' . $info['url'] . '</div>';
      }
    } else {
      $output['#markup'] .= '<div>No nodes found for the term.</div>';
    }

    return $output;
  }
}
