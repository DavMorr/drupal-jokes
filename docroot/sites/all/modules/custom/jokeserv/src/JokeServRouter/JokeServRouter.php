<?php
/**
 * @file
 * This class provides routing and resource mapping resolutino functionality
 */

// namespace Drupal\jokeserv\includes\jokeserv;

class JokeServRouter {

  protected $controller;
  protected $resources;
  protected $validHttpAcceptTypes = array();
  public $resource;
  public $request_method;
  public $restMap = array();

  /**
   * JokeServRouter constructor.
   * @param $_resources
   *  Assigns request specific resource params to a public member variable
   */
  public function __construct($_resources) {
    $this->resources = $_resources;
  }

  /**
   * Provides an array of current request-level http access CSV values
   * @return array
   */
  protected function getHttpAcceptTypes() {
    return explode(',', $_SERVER['HTTP_ACCEPT']);
  }

  /**
   * Provides the current request method value
   * @return string
   */
  protected function getRequestMethod() {
    return $_SERVER['REQUEST_METHOD'];
  }

  /**
   * defines a mapping from server request method to their corresponding
   *  REST class function names
   * @return array
   */
  public function setRestMap() {
    $this->restMap = array(
      'GET'     => 'read',
      'POST'    => 'create',
      'PUT'     => 'update',
      'DELETE'  => 'delete',
    );
  }

  /**
   * Determine what the appropriate resource for the current request is, by
   *  http accept type. Falls back to a default resource definition if nothing
   *  has been defined for the current request type.
   */
  public function setCurrentResource() {
    $http_accept_types = $this->getHttpAcceptTypes();
    foreach ($this->resources as $_resource) {
      foreach($_resource['httpAcceptTypes'] as $atype) {
        if (in_array($atype, $http_accept_types)) {
          $this->resource = $_resource;
          return;
        }
      }
    }
    $this->resource = $this->resources['default'];
  }

  /**
   * Request routing handler
   */
  public function routeRequest() {
    $this->setCurrentResource();

    try {
      $this->processRequest();
    }
    catch (JokeServException $e){
      $e->noProcess();
    }
  }

  /**
   * Request process handler
   */
  public function processRequest() {

    $this->setRestMap();
    $this->request_method = $this->getRequestMethod();
    $this->controller = new $this->resource['class']();

    $procType = (in_array($this->request_method, $this->restMap)) ? $this->restMap[$this->request_method] : $this->restMap['GET'];

    $this->controller->$procType();
  }
}
