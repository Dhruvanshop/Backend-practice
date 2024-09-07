<?php
namespace Drupal\my_custom_field\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Render\Element\RenderElement;

/**
 * @FieldFormatter(
 *   id = "my_custom_formatter",
 *   label = @Translation("My Custom Formatter"),
 *   field_types = {
 *     "my_custom_field_type"
 *   }
 * )
 */
class MyCustomFormatter extends FormatterBase {

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $elements = [];

    foreach ($items as $delta => $item) {
      $elements[$delta] = [
        '#markup' => $this->t('@value', ['@value' => $item->value]),
      ];
    }

    return $elements;
  }

}
