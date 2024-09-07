<?php

declare(strict_types=1);

namespace Drupal\routechecker\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Returns responses for Routechecker routes.
 */
final class RoutecheckerController extends ControllerBase {

  /**
   * Builds the response.
   */
  public function __invoke(): array {

    $build['content'] = [
      '#type' => 'item',
      '#markup' => $this->t('It works!'),
    ];

    return $build;
  }

}
