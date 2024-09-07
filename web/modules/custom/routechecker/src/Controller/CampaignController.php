<?php

namespace Drupal\routechecker\Controller;

use Drupal\Core\Controller\ControllerBase;

class CampaignController extends ControllerBase {

  /**
   * Returns a response for the campaign value route.
   *
   * @param int $number
   *   The dynamic parameter from the route.
   */
  public function value($number) {
    return [
      '#markup' => $this->t('This is the custom page.'.$number),
    ];
  }

}
