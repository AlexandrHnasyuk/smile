<?php

namespace Drupal\namespaces\Controller;

/**
 * Provides route responses for the Namespaces module.
 */
class HelloController {
  /**
   * Returns a simple page.
   *
   * @return array
   *   A simple render array.
   */
  public function Hello() {
    $greeting = array(
      '#markup' => 'Hello Smile)))',
    );
    return $greeting;
  }
}
