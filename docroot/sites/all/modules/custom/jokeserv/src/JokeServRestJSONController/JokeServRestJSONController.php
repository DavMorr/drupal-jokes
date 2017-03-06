<?php
/**
 * @file
 * This class extends the JokeServRestController class for JSON requests
 */

// namespace Drupal\jokeserv\JokeServRestController;
// use JokeServQuery;


class JokeServRestJSONController extends JokeServRestController {

  /**
   * Performs JSON specific Read functionality
   */
  public function read() {
    $jokes = new JokeServQuery;
    $this->getJSON($jokes->getJokes());
  }

  /**
   * Performs JSON specific formatting and response reolution
   * @param $jokes_arr
   */
  protected function getJSON($jokes_arr) {
    drupal_json_output($jokes_arr);
    exit();
  }

}
