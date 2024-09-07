<?php

namespace Drupal\hello_world\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Response;

class CustomPageController extends ControllerBase {

  public function view() {
    return new Response('This is the custom page.');
  }

}
