<?php

namespace Drupal\hello_world\Access;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Routing\Access\AccessInterface;
use Drupal\Core\Session\AccountInterface;

class CustomRouteAccessCheck implements AccessInterface {


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
    if ($account->hasPermission('access the custom page')) {
      return AccessResult::allowed();
    }
    return AccessResult::forbidden();
  }
  public function accessWithoutEditor(AccountInterface $account) {


  }

}
