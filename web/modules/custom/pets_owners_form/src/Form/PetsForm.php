<?php

namespace Drupal\pets_owners_form\Form;

use Drupal\Core\Database\Database;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

class PetsForm extends FormBase {
  /**
   * @inheritDoc
   */
  public function getFormId() {
    return 'pets_owners_form';
  }

  /**
   * @inheritDoc
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Your name: '),
    ];

    $form['gender'] = [
      '#type' => 'radios',
      '#title' => $this->t('Your gender: '),
      '#options' => [
        'male' => $this->t('male'),
        'female' => $this->t('female'),
        'unknown' => $this->t('unknown'),
      ],
    ];

    $form['prefix'] = [
      '#type' => 'select',
      '#options' => [
        'mr' => $this->t('mr'),
        'mrs' => $this->t('mrs'),
        'ms' => $this->t('ms'),
      ],
    ];

    $form['age'] = [
      '#type' => 'number',
      '#maxlength' => 3,
      '#title' => $this->t('Your age: '),
      '#ajax' => [
        'callback' => '::ageCallback',
        'event' => 'change',
        'wrapper' => 'form-container',
      ],
    ];

    $form['parents'] = [
      '#type' => 'container',
      '#prefix' => '<div id="form-container">',
      '#suffix' => '</div>',
    ];
    $form['parents']['father_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Your father name: '),
    ];

    $form['parents']['mother_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Your mother name: '),
    ];

    $form['pets'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Have you some pets? '),
      '#attributes' => [
        'name' => 'field_select_pets',
      ],
    ];

    $form['name_pets'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Your pats name: '),
      '#attributes' => [
        'id' => 'pets-name',
      ],
      '#states' => [
        'visible' => [
          ':input[name="field_select_pets"]' => ['checked' => TRUE],
        ],
      ],
    ];

    $form['email'] = [
      '#type' => 'email',
      '#title' => $this->t('Your email: '),
    ];

    $form['actions'] = [
      '#type' => 'actions',
    ];

    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Save'),
      '#button_type' => 'primary',
    ];

    return $form;
  }

  /**
   * @param array $form
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *
   * @return array|mixed
   */
  public function ageCallback(array &$form, FormStateInterface $form_state) {
    $age = $form_state->getValue('age');
    if ($age > 18) {
      $form['parents'] = [
        '#type' => 'hidden',
        '#prefix' => '<div id="form-container">',
        '#suffix' => '</div>',
      ];
      $form['parents']['father_name'] = [
        '#type' => 'textfield',
        '#title' => $this->t('Your father name: '),
      ];

      $form['parents']['mother_name'] = [
        '#type' => 'textfield',
        '#title' => $this->t('Your mother name: '),
      ];
    }

    return $form['parents'];
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    if ($form_state->getValue('age') < 0 || $form_state->getValue('age') > 120) {
      $form_state->setErrorByName('age', $this->t('is not correct.'));
    }

    if (strlen($form_state->getValue('name')) > 100) {
      $form_state->setErrorByName('name', $this->t('is not correct.'));
    }

    if (!$form_state->getValue('email') || !filter_var($form_state->getValue('email'), FILTER_VALIDATE_EMAIL)) {
      $form_state->setErrorByName('email', $this->t('is not correct.'));
    }
  }

  /**
   * @inheritDoc
   * @throws \Exception
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $conn = Database::getConnection();
    $conn->insert('pets_owners_storage')->fields(
      [
        'name' => $form_state->getValue('name'),
        'gender' => $form_state->getValue('gender'),
        'prefix' => $form_state->getValue('prefix'),
        'age' => $form_state->getValue('age'),
        'father_name' => $form_state->getValue('father_name'),
        'mother_name' => $form_state->getValue('mother_name'),
        'pets' => $form_state->getValue('pets'),
        'name_pets' => $form_state->getValue('name_pets'),
        'email' => $form_state->getValue('email'),
      ]
    )->execute();
    $url = Url::fromRoute('pets_owners.details');
    $form_state->setRedirectUrl($url);
  }
}
