<?php
namespace Drupal\my_custom_field\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * @FieldWidget(
 *   id = "my_custom_widget",
 *   label = @Translation("My Custom Widget"),
 *   field_types = {
 *     "my_custom_field_type"
 *   }
 * )
 */

 class MyCustomWidget extends WidgetBase {

  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    $element['value'] = [
      '#type' => 'textfield',
      '#title' => $this->t('My Custom Field'),
      '#default_value' => isset($items[$delta]->value) ? $items[$delta]->value : '',
      '#size' => 60,
      '#maxlength' => 255,
    ];
    return $element;
    
   }

 }