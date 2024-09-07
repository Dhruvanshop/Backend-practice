<?php

namespace Drupal\color_field\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin implementation of the 'rgb_color_hex' widget.
 *
 * @FieldWidget(
 *   id = "rgb_color_hex",
 *   label = @Translation("Hex Code"),
 *   field_types = {
 *     "rgb_color"
 *   }
 * )
 */
class RGBColorHexWidget extends WidgetBase {

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    $element['hex'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Hex Color Code'),
      '#default_value' => isset($items[$delta]->hex) ? $items[$delta]->hex : '#000000',
      '#size' => 7,
      '#maxlength' => 7,
      '#attributes' => ['pattern' => '^#[a-fA-F0-9]{6}$'],
    ];

    return $element;
  }
}
