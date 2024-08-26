<?php

namespace Drupal\routechecker\Controller;

use Drupal\Core\Controller\ControllerBase;

class CustomPagController extends ControllerBase {

  public function customPage() {
    return [
      '#markup' => $this->t('This is the custom page.'),
    ];
  }

}
