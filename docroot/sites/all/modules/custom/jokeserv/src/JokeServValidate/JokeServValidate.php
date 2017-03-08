<?php

/**
 * @file
 * This class provides a top level default interface and CRUD functionality for
 *  extending sub-controller classes. By default, all exposed member functions
 *  throw exceptions to enforce intent of access, reaction and delivery.
 */

// namespace Drupal\jokeserv\JokeServValidate;

interface JokeServValidateInterface {
  /**
   * Validation interface definitions
   */
  public function validateArgSetNid();
}

class JokeServValidate implements JokeServValidateInterface {

  protected $arg;
  public $nid = NULL;

  public function __construct($_arg = NULL) {
    $this->arg = urldecode($_arg);
  }

  /**
   * Controller for URL arg to node ID validation methods.
   */
  public function validateArgSetNid() {
    if (!$this->arg) return;
    $this->_validateArgToNid();
    $this->_validateNidToNode();
  }

  /**
   * Validate the arg value as properly encoded number for node id validation.
   */
  public function _validateArgToNid() {
    $this->nid = (
      $this->arg
      && substr($this->arg, 0, 1) == ':'
      && is_numeric(substr($this->arg, 1))
    ) ? substr($this->arg, 1) : NULL;
  }

  /**
   * Validate the nid as valid node of the joke type.
   */
  public function _validateNidToNode() {
    $defaults = _jokeserv_get_defaults();
    $this->nid = (
      $this->nid
      && ($node = node_load($this->nid))
      && ($node->type == variable_get('jokeserv_ctype', $defaults['ctype']))
    ) ? $this->nid : NULL;
  }

}
