# Socha Dev Drupal module exercice
## Create a simple REST API that serves jokes using Drupal 7.

### Task
We use REST APIs for a number of internal and client applications. We have built these APIs using several different design methods and toolkits. This exercise will allow you to demonstrate how you would implement your own simple REST API. 

*Note: This task could be completed using the RESTful Web Services contrib, but for this exercise we would like this to be a custom implementation.*

### Requirements

* The API will need only 1 endpoint:
  * GET /joke{/:id}
    * When someone makes a request to this endpoint, the API should return the joke in this JSON format: { “title”: “What does a nosy pepper do?”, “body”: “Gets jalapeño business.” }
    * The :id parameter is optional. If included, the API should return the joke that matches a node ID or return a 404.
* The API should respond only to Accept: application/json requests
* The API should return a JSON object
* The module should pass Coder module review, follow standard Drupal and PSR-3 coding standards and be reasonably well documented. 
* When delivered, we should be able to install the module and have a functioning API. 

### Setup
* We have already created a skeleton Drupal 7 project & installation the contains a Joke content type and a handful of joke nodes that you will use for this. 
* Fork the SochaDev/drupal-jokes repo from the SochaDev Github. The project contains a full Drupal 7 installation and database dump.
* Configure your local environment to work with the Drupal 7 installation. Create your local settings.php, files dir, etc. 
* Create a MySQL database and import the database.sql.gz dump.

### Deliverables
* A custom Drupal module containing all the REST API functionality and endpoints.
* Include a README.md file your module that documents the API usage.
* Commit your changes to your forked Github repo and create a pull request back to SochaDev/Repo
