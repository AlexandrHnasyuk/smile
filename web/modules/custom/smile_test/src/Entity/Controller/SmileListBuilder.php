<?php

namespace Drupal\smile_test\Controller;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;

class SmileListBuilder extends EntityListBuilder {
  public function render() {
    $build['description'] = [
      '#markup' => $this->t('Smile Entity Example implements a Contacts model. These contacts are fieldable entities. You can manage the fields on the <a href="@adminlink">Contacts admin page</a>.', [
        '@adminlink' => \Drupal::urlGenerator()
          ->generateFromRoute('smile_test.smile_test_settings'),
      ]),
    ];
    $build['table'] = parent::render();
    return $build;
  }

  /**
   * @return array
   */
  public function buildHeader() {
    $header['id'] = $this->t('ContactID');
    $header['name'] = $this->t('Name');
    $header['preferred_brand'] = $this->t('Preferred brand');
    $header['products_owned_count'] = $this->t('Products count');
    $header['registered'] = $this->t('Date registered');
    return $header + parent::buildHeader();
  }

  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\smile_test\Entity\SmileTest */
    $row['id'] = $entity->id();
    $row['name'] = $entity->label();
    $row['preferred_brand'] = $entity->preferred_brand->value;
    $row['products_owned_count'] = $entity->products_owned_count->value;
    $row['registered'] = gmdate("M d Y", $entity->created->value);
    return $row + parent::buildRow($entity);
  }

}
