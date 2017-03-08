<?php
/**
 * @file
 * Provides a Query class for database & data CRUD processes and functions.
 */

// namespace Drupal\jokeserv\JokeServQuery;

interface JokeServQueryInterface {
  /**
   * Validation interface definitions
   */
  public function getJokes();
}

class JokeServQuery implements JokeServQueryInterface {

  protected $jokes_nodes;
  public $nid;
  public $jokes;

  public function __construct($_nid = NULL) {
    $this->nid = $_nid;
  }

  /**
   * Execute read processes to set title|body jokes array class variable.
   * Allow for variant formats to be returned, default to array.
   */
  public function getJokes($format = 'array') {
    $this->_getJokeNodes();
    switch ($format) {
      case 'array':
      default:
        $this->_setJokesArray();
        break;
    }
  }

  /**
   * Fetch an array of Joke nodes
   */
  public function _getJokeNodes() {
    $this->jokes_nodes = array();
    $jokeserv_defaults = _jokeserv_get_defaults();
    $joke_bundle = variable_get('jokeserv_ctype', $jokeserv_defaults['ctype']);

    $query = new EntityFieldQuery();
    $query->entityCondition('entity_type', 'node')
      ->entityCondition('bundle', $joke_bundle)
      ->propertyCondition('status', NODE_PUBLISHED)
    ;

    if ($this->nid) {
      $query->entityCondition('entity_id', $this->nid);
    }

    $result = $query->execute();

    if (isset($result['node'])) {
      $jokes_items_nids = array_keys($result['node']);
      $this->jokes_nodes = entity_load('node', $jokes_items_nids);
    }
  }

  /**
   * Set an array of Joke item Q&A pairs (joke node title and body values)
   */
  public function _setJokesArray() {
    if (!$this->jokes_nodes) {
      return NULL;
    }
    foreach ($this->jokes_nodes as $joke_node) {
      $this->jokes[] = array(
        //  'nid'   => $jnode->nid,
        'title' => $joke_node->title,
        'body'  => $joke_node->body['und'][0]['value'],
      );
    }
  }
}