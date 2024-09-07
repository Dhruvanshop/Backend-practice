<?php

namespace Drupal\color_field\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin implementation of the 'rgb_color_fields' widget.
 *
 * @FieldWidget(
 *   id = "rgb_color_fields",
 *   label = @Translation("RGB Fields"),
 *   field_types = {
 *     "rgb_color"
 *   }
 * )
 * 
 */
class RGBColorFieldsWidget extends WidgetBase {

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    $hex = isset($items[$delta]->hex) ? $items[$delta]->hex : '#000000';
    list($r, $g, $b) = sscanf($hex, "#%02x%02x%02x");

    $element['r'] = [
      '#type' => 'number',
      '#title' => $this->t('R'),
      '#default_value' => $r,
      '#min' => 0,
      '#max' => 255,
    ];

    $element['g'] = [
      '#type' => 'number',
      '#title' => $this->t('G'),
      '#default_value' => $g,
      '#min' => 0,
      '#max' => 255,
    ];

    $element['b'] = [
      '#type' => 'number',
      '#title' => $this->t('B'),
      '#default_value' => $b,
      '#min' => 0,
      '#max' => 255,
    ];

    return $element;
  }
}
