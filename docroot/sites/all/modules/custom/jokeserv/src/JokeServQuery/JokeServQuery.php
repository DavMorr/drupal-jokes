<?php
/**
 * @file
 * Provides a Query class for database & data CRUD processes and functions.
 */

// namespace Drupal\jokeserv\JokeServQuery;

class JokeServQuery {

  /**
   * Read action interface
   * @return array|null
   */
  public function getJokes() {
    return $this->getJokesArray($this->getJokeNodes());
  }

  /**
   * fetch an aray of all Joke nodes
   * @return array
   */
  public function getJokeNodes() {
    $jokes_items = array();

    $query = new EntityFieldQuery();
    $query->entityCondition('entity_type', 'node')
      ->entityCondition('bundle', 'joke')
      ->propertyCondition('status', NODE_PUBLISHED)
    ;

    $result = $query->execute();

    if (isset($result['node'])) {
      $jokes_items_nids = array_keys($result['node']);
      $jokes_items = entity_load('node', $jokes_items_nids);
    }

    return $jokes_items;
  }

  /**
   * Provides an array of Joke item Q&A pairs (node title and body values)
   * @param null $joke_nodes
   *  An array of Joke node objects
   * @return array|null
   */
  public function getJokesArray($joke_nodes = NULL) {
    if (!$joke_nodes) {
      return NULL;
    }
    $jnodes = array();
    foreach ($joke_nodes as $jnode) {
      $jnodes[] = array(
        //  'nid'   => $jnode->nid,
        'title' => $jnode->title,
        'body'  => $jnode->body['und'][0]['value'],
      );
    }

    return $jnodes;
  }

}