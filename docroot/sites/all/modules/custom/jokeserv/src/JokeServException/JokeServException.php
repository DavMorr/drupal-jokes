<?php
/**
 * @file
 * Provides class for custom Exceptions
 */

class JokeServException extends Exception {
  /**
   * returns a system "page not found" page resolution, initially implemented
   *  for unresolved CRUD functions
   */
  public function noProcess() {
    // returns a "page not found".
    // drupal_add_http_header('Status', 401);
    drupal_not_found();
    exit();
  }
}
