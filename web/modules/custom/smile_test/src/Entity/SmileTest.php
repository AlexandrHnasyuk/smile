<?php

namespace Drupal\smile_test\Entity;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\smile_test\ContactInterface;
use Drupal\user\UserInterface;

/**
 * @ContentEntityType(
 *   id = "smile_test",
 *   label = @Translation("Custom entity"),
 *   base_table = "smile_test",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "smile test",
 *   },
 *   admin_permission = "administer site configuration",
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\smile_test\Entity\Controller\SmileListBuilder",
 *     "form" = {
 *       "default" = "Drupal\smile_test\Form\DefaultForm",
 *       "delete" = "Drupal\smile_test\Form\DeleteForm",
 *     },
 *   },
 *   links = {
 *     "canonical" = "/smile_test_contact/{smile_test_contact}",
 *     "edit-form" = "/smile_test_contact/{smile_test_contact}/edit",
 *     "delete-form" = "/smile_test_contact/{smile_test_contact}/delete",
 *     "collection" = "/smile_test_contact/list"
 *   },
 *   field_ui_base_route = "smile_test.contact_settings",
 * )
 */
class SmileTest extends ContentEntityBase implements ContactInterface {
  /**
   * @inheritDoc
   */
  public static function preCreate(EntityStorageInterface $storage_controller, array &$values) {
  parent::preCreate($storage_controller, $values);
  $values += array(
    'user_id' => \Drupal::currentUser()->id(),
  );
}

  /**
   * @inheritDoc
   */
  public function getChangedTime() {
    return $this->get('created')->value;
  }

  /**
   * @inheritDoc
   */
  public function setChangedTime($timestamp) {
    return $this->set('changed', $timestamp);
  }

  /**
   * @inheritDoc
   */
  public function getChangedTimeAcrossTranslations() {
    $changed = $this->getUntranslated()->getChangedTime();
    foreach ($this->getTranslationLanguages(FALSE) as $language) {
      $translation_changed = $this->getTranslation($language->getId())
        ->getChangedTime();
      $changed = max($translation_changed, $changed);
    }
    return $changed;
  }

  /**
   * @inheritDoc
   */
  public function getOwner() {
    return $this->get('user_id')->entity;
  }

  /**
   * @inheritDoc
   */
  public function setOwner(UserInterface $account) {
    return $this->set('user_id', $account->id());
  }

  /**
   * @inheritDoc
   */
  public function getOwnerId() {
    return $this->get('user_id')->target_id;
  }

  /**
   * @inheritDoc
   */
  public function setOwnerId($uid) {
    return $this->set('user_id', $uid);
  }

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields['id'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('ID'))
      ->setDescription(t('The ID of the Smile Test entity.'))
      ->setReadOnly(TRUE);

    $fields['uuid'] = BaseFieldDefinition::create('uuid')
      ->setLabel(t('UUID'))
      ->setDescription(t('The UUID of the Smile Test entity.'))
      ->setReadOnly(TRUE);

    $fields['name'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Client name'))
      ->setDescription(t('Client name'))
      ->setSettings([
        'default_value' => '',
        'max_length' => 100,
        'text_processing' => 0,
      ])
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'string',
        'weight' => -6,
      ])
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => -6,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['preferred_brand'] = BaseFieldDefinition::create('list_string')
      ->setLabel(t('Brand field'))
      ->setDescription(t('Client preferred brand'))
      ->setSettings([
        'allowed_values' => [
          'zara' => 'zara',
          'nike' => 'nike',
          'bershke' => 'bershke',
        ],
      ])
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'list_default',
        'weight' => -4,
      ])
      ->setDisplayOptions('form', [
        'type' => 'options_select',
        'weight' => -4,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['products_owned_count'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('Products count'))
      ->setDescription(t('Products owned count'))
      ->setSetting('unsigned', TRUE)
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'integer',
        'weight' => -2,
      ])->setDisplayOptions('form', [
        'type' => 'number',
        'weight' => -3,
      ])
      ->setDisplayConfigurable('view', TRUE)
      ->setDisplayConfigurable('form', TRUE);

    $fields['user_id'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('User Name'))
      ->setDescription(t('The Name of the associated user.'))
      ->setSetting('target_type', 'user')
      ->setSetting('handler', 'default')
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'entity_reference',
        'weight' => -2,
      ])
      ->setDisplayOptions('form', [
        'type' => 'entity_reference_autocomplete',
        'settings' => [
          'match_operator' => 'CONTAINS',
          'size' => 60,
          'autocomplete_type' => 'tags',
          'placeholder' => '',
        ],
        'weight' => -3,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['langcode'] = BaseFieldDefinition::create('language')
      ->setLabel(t('Language code'))
      ->setDescription(t('The language code of Smile Test entity.'));

    $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Registered'))
      ->setDescription(t('The time that the user was registered.'));

    $fields['changed'] = BaseFieldDefinition::create('changed')
      ->setLabel(t('Changed'))
      ->setDescription(t('The time that the entity was last edited.'));

    return $fields;
  }
}
