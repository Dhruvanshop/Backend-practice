<?php

namespace Drupal\my_custom_field\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\TypedData\DataDefinition;

/**
 * @FieldType(
 *   id = "my_custom_field_type",
 *   label = @Translation("My Custom Field"),
 *   description = @Translation("A custom field type example."),
 *   default_widget = "my_custom_widget",
 *   default_formatter = "my_custom_formatter"
 * )
 */

 class MyCustomFieldType extends FieldItemBase {

  /**
   * {@inheritDoc}
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition) {
    return [
      'columns' => [
        'value' => [
          'type' => 'varchar',
          'length' => 255,
        ],
      ],
    ];
  }

  /**
   * {@inheritDoc}
   */

  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
    $properties['value'] = DataDefinition::create('string')
     ->setLabel(t('Value'));
     return $properties;
  }

  /**
   * {@inheritDoc}
   */

  public function isEmpty() {
    $value = $this->get('value')->getValue();
    return $value === null || $value === '';
  }
 }