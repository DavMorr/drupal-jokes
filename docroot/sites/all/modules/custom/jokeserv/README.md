
JokeServe Module Readme
======================

# The JokeServ REST API module
## Contributed for your all of remote joke delivery needs.

This module provides a REST API allowing developers a flexible means for defining and or overriding custom CRUD operations via a hook and classes.  

The operations exposed via the class interface are the standard create, read, update and delete ops.  Included with the module are a read operation from incoming requests of the server HTTP Access Type 'application/json' and the read action/member function determined by the server request method 'GET', mainly for demonstration purposes. 

The above can be tesed from the command line:

    curl -i -H "Accept: application/json" -X GET [site_address]/joke

To add, modify or extend a resource, a hook function is provided: 
 - `hook_jokeserv_resource_info_alter()` 

This is where an optional type-label, HTTP access type and controller class are defined.  
Ex:

    /**
     * Implements hook_jokeserv_resource_info_alter().
     */
    function jokeserv_jokeserv_resource_info_alter(&$resources) {
      $resources['json'] = array(
        'type'            => t('json'),
        'httpAcceptTypes' => array('application/json'),
        'class'           => 'JokeServRestJSONController'
      );
    }

The basic CRUD member functions are exposed in the super-class `JokeServRestController`

 - public function read();
 - public function create();   
 - public function update();   
 - public function delete();

Note: by default, these functions all resolve to a 404 custom exception from the `JokeServRestController` class if not overriden from a derived class.

This class can be extended and called from the above alter hook rom a custom module. 

Ex:

    class JokeServRestJSONController extends JokeServRestController { }

From the derived class, the above member functions can be defined or overriden. 
 
A Query class is also provided, but this and the response process can be easily customized from the derived class defined in the resource info alter hook. 

Refer to the module, class and api code files for reference.

Note: 
The menu path is fixed to the [domain]/joke , which can be overriden via menu alter hook or redirect.