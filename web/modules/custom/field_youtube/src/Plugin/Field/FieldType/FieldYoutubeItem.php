<?php

namespace Drupal\field_youtube\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\TypedData\DataDefinition;

/**
 * Plugin implementation of the 'field_youtube' field type.
 *
 * @FieldType(
 *   id = "field_youtube",
 *   label = @Translation("Youtube video field"),
 *   module = "field_youtube",
 *   description = @Translation("Output video from Youtube."),
 *   default_widget = "field_youtube_widget",
 *   default_formatter = "field_youtube_thumbnail"
 * )
 */
class FieldYoutubeItem extends FieldItemBase {
  /**
   * {@inheritdoc}
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition) {
    return array(
      'columns' => array(
        'value' => array(
          'type' => 'text',
          'size' => 'tiny',
          'not null' => FALSE,
        ),
      ),
    );
  }

  /**
   * {@inheritdoc}
   */
  public function isEmpty() {
    $value = $this->get('value')->getValue();
    return $value === NULL || $value === '';
  }

  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
    $properties['value'] = DataDefinition::create('string')
      ->setLabel(t('Youtube video URL'));

    return $properties;
  }

}
