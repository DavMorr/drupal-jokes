<?php

/**
 * @file
 * This file contains no working PHP code; it exists to provide additional
 * documentation for doxygen as well as to document hooks in the standard
 * Drupal manner.
 */


/**
 * @defgroup jokeserv JokeServ module integrations.
 *
 * Module integrations with the jokeserv module.
 */

/**
 * @defgroup jokeserv_hooks JokeServ hooks
 * @{
 * Hooks that can be implemented by other modules in order to extend jokeserv.
 */

/**
 * Define jokeserv compatible resources.
 *
 * This hook is required in order to add new restws resources.
 *
 * @param array $resources
 */

function hook_jokeserv_resource_info_alter(&$resources) {
  $resources['xml'] = array(
    'type' => t('xml'),
    'httpAcceptTypes' => array(
      'application/xhtml+xml',
      'application/xml'
    ),
    'class' => 'JokeServRestXMLMLController'
  );
}