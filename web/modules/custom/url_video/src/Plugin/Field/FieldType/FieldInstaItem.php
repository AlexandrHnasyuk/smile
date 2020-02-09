<?php

namespace Drupal\url_video\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\TypedData\DataDefinition;

/**
 * Plugin implementation of the 'url_video' field type.
 *
 * @FieldType(
 *   id = "url_video",
 *   label = @Translation("URL Instagram"),
 *   module = "url_video",
 *   description = @Translation("Field URL video with Instagram."),
 *   default_widget = "field_insta_widget",
 *   default_formatter = "field_insta_preview"
 * )
 */
class FieldInstaItem extends FieldItemBase {
  /**
   * @inheritDoc
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
    $properties['value'] = DataDefinition::create('string')
      ->setLabel(t('Url Instagram video:'));

    return $properties;
  }

  /**
   * @inheritDoc
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition) {
    return [
      'columns' => [
        'value' => [
          'type' => 'text',
          'size' => 'tiny',
          'not null' => FALSE,
        ],
      ],
    ];
  }
}
