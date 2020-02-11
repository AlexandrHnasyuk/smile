<?php

namespace Drupal\routing_system\Controller;

/**
 * Provides route responses for the Routing System module.
 */
class RoutingSystemController {
  /**
   * Returns a simple page.
   *
   * @return array
   *   A simple render array.
   */
  public function Test() {
    $greeting = array(
      '#markup' => 'Test page for Smile)))',
    );
    return $greeting;
  }
}
