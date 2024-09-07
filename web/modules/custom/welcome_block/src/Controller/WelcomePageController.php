<?php

namespace Drupal\welcome_block\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Provides a welcome page.
 */
class WelcomePageController extends ControllerBase {

  /**
   * Returns the content for the welcome page.
   */
  public function content() {
   
    return [
      '#markup' => $this->t('Yayyyyyy'),
    ];
  }
}
