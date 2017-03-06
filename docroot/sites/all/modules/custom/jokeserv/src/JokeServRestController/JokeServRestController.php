<?php

/**
 * @file
 * This class provides a top level default interface and CRUD functionality for
 *  extending sub-controller classes. By default, all exposed member functions
 *  throw exceptions to enforce intent of access, reaction and delivery.
 */

// namespace Drupal\jokeserv\JokeServRestController;
// use JokeServException;

interface JokeServRestControllerInterface {
  /**
   * Rest API CRUD interface definitions
   * @return mixed
   */
  public function read();
  public function create();
  public function update();
  public function delete();
}

class JokeServRestController implements JokeServRestControllerInterface {

  public function __construct() {}

  /**
   * Rest API CRUD top level member functions.
   * @throws \JokeServException
   */
  public function read() {
    throw new JokeServException();
  }
  public function create() {
    throw new JokeServException();
  }
  public function update() {
    throw new JokeServException();
  }
  public function delete() {
    throw new JokeServException();
  }
}
