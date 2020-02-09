<?php

namespace Drupal\url_video\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin implementation of the 'field_insta_widget' widget.
 *
 * @FieldWidget(
 *   id = "field_insta_widget",
 *   module = "url_video",
 *   label = @Translation("URL Instagram Widget"),
 *   field_types = {
 *     "url_video"
 *   }
 * )
 */
class FieldInstaWidget extends WidgetBase {

  /**
   * @inheritDoc
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    $value = isset($items[$delta]->value) ? $items[$delta]->value : '';
    $element += array(
      '#type' => 'textfield',
      '#default_value' => $value,
      '#size' => 32,
      '#maxlength' => 256,
      '#element_validate' => array(
        array($this, 'validate'),
      ),
    );

    return array('value' => $element);
  }

  /**
   * Validate the color text field.
   */
  public function validate($element, FormStateInterface $form_state) {
    $value = $element['#value'];
    if (strlen($value) == 0) {
      $form_state->setValueForElement($element, '');
      return;
    }
    if(strpos($value, "https://instagram") === FALSE) {
      $form_state->setError($element, t("Sorry it's not Instagram video((("));
    }
  }
}
