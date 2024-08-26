<?php

namespace Drupal\routechecker\Access;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Routing\Access\AccessInterface;
use Drupal\Core\Session\AccountInterface;

class CustomRouteAccessChecker implements AccessInterface {


  /**
   * Checks access for the custom page.
   *
   * @param \Drupal\Core\Session\AccountInterface $account
   *   The currently logged in user.
   *
   * @return \Drupal\Core\Access\AccessResult
   *   The access result.
   */
  public function access(AccountInterface $account) {
    // Add custom logic here.
    if ($account->hasPermission('access custom page') || $account->hasRole('administrator') || $account->hasRole('editor')) {
      return AccessResult::allowed();
    }
    return AccessResult::forbidden();
  }
  public function accessWithoutEditor(AccountInterface $account) {
   
    if($account->hasRole('administrator')){
      return AccessResult::allowed();

    }
    return AccessResult::forbidden();

  }

}
