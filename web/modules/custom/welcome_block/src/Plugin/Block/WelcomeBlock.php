<?php

namespace Drupal\welcome_block\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'Welcome Block' block.
 *
 * @Block(
 *   id = "welcome_block",
 *   admin_label = @Translation("Welcome Block"),
 *   category = @Translation("Custom")
 * )
 */
class WelcomeBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $current_user = \Drupal::currentUser();
    $roles = $current_user->getRoles();
    
    // Ensure roles are retrieved properly.
    if ($roles[0]=='anonymous') {
      $role = 'Guest';
    }
    else {
      // Join roles with a comma if there are multiple roles.
      $role = $roles[1];
    }
    
    return [
      '#markup' => $this->t('Welcome @role', ['@role' => $role]),
    ];
  }
}
