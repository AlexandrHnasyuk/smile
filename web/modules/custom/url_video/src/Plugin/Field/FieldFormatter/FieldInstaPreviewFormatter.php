<?php

namespace Drupal\url_video\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin implementation of the 'field_youtube_thumbnail' formatter.
 *
 * @FieldFormatter(
 *   id = "field_insta_preview",
 *   module = "url_video",
 *   label = @Translation("Formatter with preview"),
 *   field_types = {
 *     "url_video"
 *   }
 * )
 */
class FieldInstaPreviewFormatter extends FormatterBase {
  /**
   * {@inheritdoc}
   */
  public static function defaultSettings() {
    return [
        'width' => '600',
        'height' => '450',
      ] + parent::defaultSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state) {
    $elements['width'] = [
      '#type' => 'textfield',
      '#title' => t('Instagram video width'),
      '#default_value' => $this->getSetting('width'),
    ];
    $elements['height'] = [
      '#type' => 'textfield',
      '#title' => t('Instagram video height'),
      '#default_value' => $this->getSetting('height'),
    ];

    return $elements;
  }

  /**
   * @inheritDoc
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $elements = [];
    $width = $this->getSetting('width');
    $height = $this->getSetting('height');

    foreach ($items as $delta => $item) {
      $url_link = $item->getValue()['value'];
      $elements[$delta] = [
//        '#type' => 'html_tag',
//        '#tag' => 'video',
        '#width' => $width,
        '#height' => $height,
        '#video_id' => stristr($url_link, '.'),
        '#attributes' => [
          'type' => 'video/mp4',
          'controls' => TRUE,
          'src' => $url_link,
        ],
        '#theme' => 'field_instagram_video',
      ];
    }

    return $elements;
  }

  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {
    $summary = [];

    $settings = $this->getSettings();

    if (!empty($settings['width']) && !empty($settings['height'])) {
      $summary[] = t('Video size: @width x @height', ['@width' => $settings['width'], '@height' => $settings['height']]);
    }
    else {
      $summary[] = t('Define video size');
    }

    return $summary;
  }
}
