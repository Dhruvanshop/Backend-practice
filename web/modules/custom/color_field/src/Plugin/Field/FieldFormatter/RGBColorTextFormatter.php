<?php

namespace Drupal\color_field\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;
// use Drupal\Core\Session\AccountInterface;

/**
 * Plugin implementation of the 'rgb_color_default' formatter.
 *
 * @FieldFormatter(
 *   id = "rgb_color_default",
 *   label = @Translation("Static Text"),
 *   field_types = {
 *     "rgb_color"
 *   }
 * )
 */
class RGBColorTextFormatter extends FormatterBase {

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $elements = [];
       // Get the current user.
    $current_user = \Drupal::currentUser();
    if ($current_user->hasPermission('view rgb color field')) {

    foreach ($items as $delta => $item) {
      $elements[$delta] = [
        '#markup' => $item->hex,
      ];
    }
  }
    return $elements;
  }
}
