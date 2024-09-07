<?php

namespace Drupal\color_field\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\TypedData\DataDefinition;

/**
 * Defines the 'rgb_color' field type.
 *
 * @FieldType(
 *   id = "rgb_color",
 *   label = @Translation("RGB Color"),
 *   description = @Translation("Stores an RGB color value."),
 *   default_widget = "rgb_color_hex",
 *   default_formatter = "rgb_color_default",
 * )
 */
class RGBColorItem extends FieldItemBase {

  /**
   * {@inheritdoc}
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition) {
    return [
      'columns' => [
        'hex' => [
          'type' => 'varchar',
          'length' => 7,
          'not null' => FALSE,
        ],
      ],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
    $properties['hex'] = DataDefinition::create('string')
      ->setLabel(t('Hex Color Code'));
    return $properties;
  }

  /**
   * {@inheritdoc}
   */
  public function isEmpty() {
    $value = $this->get('hex')->getValue();
    return $value === NULL || $value === '';
  }
}
