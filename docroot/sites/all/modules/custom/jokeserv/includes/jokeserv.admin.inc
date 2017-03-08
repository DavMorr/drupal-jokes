<?php

/**
 * @file
 * Administraive settings form and functions for module
 */

/**
 * Implements hook_admin_paths().
 */
function jokeserv_admin_form($form, &$form_state) {
  $ctypes = node_type_get_types();
  $defaults = _jokeserv_get_defaults();

  $form = array();
  $intro_text = t(
    '<p>Set the content type to be used for the joke source.  THe title and body 
    fields will be used for the call and response values, respectively, so most 
    content types should be sufficient as a source as long as these fields are 
    accessible to anonymous/non-authenticated users.</p> 
    <p>The content type %type will be used by default, but can be changed here.</p>',
    array(
      '%type' => $ctypes[$defaults['ctype']]->name,
    )
  );
  $ctype_curr = variable_get('jokeserv_ctype', $defaults['ctype']);
  $ctype_opts = array();

  foreach ($ctypes as $ctype) {
    $ctype_opts[$ctype->type] = $ctype->name;
  }

  $form['intro'] = array(
    '#markup' => $intro_text,
  );
  $form['jokeserv_ctype'] = array(
    '#type' => 'radios',
    '#title' => t('Content types'),
    '#default_value' => array_key_exists($ctype_curr, $ctypes) ? $ctype_curr : NULL,
    '#options' => $ctype_opts,
    '#description' => t('Select the node bundle to be used as the joke source.'),
  );

  return system_settings_form($form);
}
