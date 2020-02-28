<?php

namespace Drupal\views_pets\Plugin\views\filter;

use Drupal\Core\Form\FormStateInterface;
use Drupal\views\Plugin\views\filter\FilterPluginBase;

/**
 * Simple filter to handle filtering by gender.
 *
 * @ViewsFilter("views_pets_prefix")
 */
class NodePrefix extends FilterPluginBase {
  /**
   * @inheritDoc
   */
  protected function valueForm(&$form, FormStateInterface $form_state) {
    $form['value'] = [
      '#type' => 'select',
      '#title' => $this->t('Prefix for pets'),
      '#options' => [
        'mr' => $this->t('male'),
        'ms' => $this->t('female'),
      ],
      '#default_value' => $this->value,
    ];
  }

  public function query() {
    $this->ensureMyTable();
    if ($this->value[0] == 'mr') {
      $this->query->addWhere($this->options['group'], "$this->tableAlias.$this->realField", $this->value[0], $this->operator);
    } else {
      $this->query->addWhere($this->options['group'], "$this->tableAlias.$this->realField", 'mr', '!=');
    }
  }

}
