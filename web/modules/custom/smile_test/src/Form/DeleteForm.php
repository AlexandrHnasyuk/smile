<?php

namespace Drupal\smile_test\Form;

use Drupal\Core\Url;
use Drupal\Core\Entity\ContentEntityConfirmFormBase;
use Drupal\Core\Form\FormStateInterface;

class DeleteForm extends ContentEntityConfirmFormBase {
  /**
   * @inheritDoc
   */
  public function getQuestion() {
    return $this->t('Are you sure you want to delete entity %name?', ['%name' => $this->entity->label()]);
  }

  /**
   * @inheritDoc
   */
  public function getCancelUrl() {
    return new Url('entity.smile_test.collection');
  }

  /**
   * @inheritDoc
   */
  public function getConfirmText() {
    return $this->t('Delete');
  }

  /**
   * @inheritDoc
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $entity = $this->getEntity();
    $entity->delete();

    \Drupal::logger('manage_inventory')->notice('@type: deleted %title', [
      '@type' => $this->entity->bundle(),
      '%title' => $this->entity->label(),
    ]);
    $form_state->setRedirect('entity.smile_test.collection');
  }
}
