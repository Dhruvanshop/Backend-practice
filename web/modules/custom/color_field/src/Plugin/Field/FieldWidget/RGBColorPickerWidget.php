<?php

namespace Drupal\color_field\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin implementation of the 'rgb_color_picker' widget.
 *
 * @FieldWidget(
 *   id = "rgb_color_picker",
 *   label = @Translation("Color Picker"),
 *   field_types = {
 *     "rgb_color"
 *   }
 * )
 */
class RGBColorPickerWidget extends WidgetBase {

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    $element['hex'] = [
      '#type' => 'color',
      '#title' => $this->t('Pick a color'),
      '#default_value' => isset($items[$delta]->hex) ? $items[$delta]->hex : '#000000',
    ];

    return $element;
  }
}
