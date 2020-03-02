<?php

namespace Drupal\custom_cash\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 *
* @Block(
*   id = "custom_cash_block",
*   admin_label = @Translation("Custom Cash Block"),
*   category = @Translation("Custom Cash Block"),
* )
*/
class CustomCashBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $nids = \Drupal::entityQuery('node')
      ->condition('type', 'mediaelement')
      ->execute();

    $nodes = \Drupal::entityTypeManager()
      ->getStorage('node')
      ->loadMultiple($nids);

    foreach ($nids as $nid) {
      $titles[$nid] = $nodes[$nid]->label();
      $tags[] = 'node:' . $nid;
    }

    $tags[] = 'node_list';
    
    $build['content'] = [
      '#theme' => 'item_list',
      '#list_type' => 'ul',
      '#title' => 'Media Elements:',
      '#items' => $titles,
    ];

    $build['#cache'] = [
      'tags' => $tags,
      'contexts' => ['user.roles'],
    ];
    return $build;
  }
}
