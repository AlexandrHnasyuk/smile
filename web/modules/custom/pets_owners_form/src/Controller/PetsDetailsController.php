<?php

namespace Drupal\pets_owners_form\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Drupal\Core\Database\Database;

/**
 * Provides route responses for the Example module.
 */
class PetsDetailsController extends ControllerBase {
  /**
   * Returns a simple page.
   *
   * @return array
   *   A simple renderable array.
   */
  public function successpage() {
    $element = [
      '#markup' => 'Thank you',
    ];
    return $element;
  }

  public function getDetails() {
    $db = \Drupal::database();
    $query = $db->select('pets_owners_storage', 'n');
    $query->fields('n');
    $response = $query->execute()->fetchAll();
    return new JsonResponse( $response );
  }
}
