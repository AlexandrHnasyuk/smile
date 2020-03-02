<?php

namespace Drupal\custom_batch\Plugin\QueueWorker;

use Drupal\Core\Queue\QueueWorkerBase;

/**
 *
 * @QueueWorker(
 *   id = "email_queue",
 *   title = @Translation("Email queue"),
 *   cron = {"time" = 10}
 * )
 */
class EmailQueue extends QueueWorkerBase {
  /**
   * @inheritDoc
   */
  public function processItem($data) {
    $user_storage = \Drupal::service('entity_type.manager')->getStorage('user');

    $ids = $user_storage->getQuery()
      ->condition('status', 1)
      ->condition('roles', 'administrator')
      ->execute();
     $users = $user_storage->loadMultiple($ids);

    foreach ($users as $user) {
      $mailManager = \Drupal::service('plugin.manager.mail');
      $module = 'document';
      $key = 'send_file';
      $params['mail_title'] = 'Message';
      $params['message'] = 'Hello';
      $langcode = \Drupal::currentUser()->getPreferredLangcode();
      $send = true;
      $mailManager->mail($module, $key, $user->getEmail(), $langcode, $params, null, $send);
    }
  }
}
