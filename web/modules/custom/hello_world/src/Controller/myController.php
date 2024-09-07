<?php 
namespace Drupal\hello_world\Controller;
use Drupal\Core\Controller\ControllerBase;
global $user;
class myController extends ControllerBase {
  function content(){
    $current_user = \Drupal::currentUser();
    $username = $current_user->getDisplayName();
    return [
      '#type' => 'markup',
      '#markup' => $this->t('Hello, @username', ['@username' => $username]),
    ];
  }
}