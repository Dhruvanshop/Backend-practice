<?php

namespace Drupal\color_field\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Render\Markup;

/**
 * Plugin implementation of the 'rgb_color_background' formatter.
 *
 * @FieldFormatter(
 *   id = "rgb_color_background",
 *   label = @Translation("Background Color"),
 *   field_types = {
 *     "rgb_color"
 *   }
 * )
 */
class RGBColorBackgroundFormatter extends FormatterBase {

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $elements = [];

    foreach ($items as $delta => $item) {
      if (!empty($item->hex)) {
        $color = $item->hex;
        $elements[$delta] = [
          '#markup' => Markup::create('<span style="display: inline-block; padding: 5px; background-color: ' . $color . ';">' . $color . '</span>'),
        ];
      }
    }

    return $elements;
  }
}
