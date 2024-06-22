# IpOnline User Registration With Smarty Engine Template MVC
##Open Source MVC Framework with Smarty Template Engine for PHP.

[![N|Solid](https://cldup.com/dTxpPi9lDf.thumb.png)](https://nodesource.com/products/nsolid)

[![Build Status](https://travis-ci.org/joemccann/dillinger.svg?branch=master)](https://travis-ci.org/joemccann/dillinger)
## Table of Contents
* **Introduction**
* **Quick Start**
* **Folder Structure**
* **Core Components**
* **Validation**
* **Template Rendering**
* **Controller, View and model**
* **Challenges Faced**
* **Contributing**
## Introduction

> MVCFramework is an open-source MVC framework built in PHP, utilizing the Smarty template engine for creating dynamic and maintainable web applications. This framework includes robust form handling and validation mechanisms.

## Quick Start

1. Clone the repo: git clone **https://github.com/davidakpele/ipOnlineKyc.git**
2. Install dependencies using Composer: **composer install**
3. Set up your web server to point to the **public **directory.

## Folder Structure
```
ipOline/
├───app
│   ├───controllers
│   ├───core
│   │   └───env
│   ├───helpers
│   ├───models
│   ├───services
│   └───views
│       └───templates
│           └───auth
├───cache
├───config
├───DB
├───public
│   └───assets
│       ├───css
│       ├───fontawesome
│       │   ├───css
│       │   ├───js
│       │   ├───less
│       │   ├───metadata
│       │   ├───scss
│       │   ├───sprites
│       │   ├───svgs
│       │   │   ├───brands
│       │   │   ├───regular
│       │   │   └───solid
│       │   └───webfonts
│       ├───img
│       └───js
├───templates_c
└───vendor
    ├───composer
    ├───smarty
    │   └───smarty
    │       ├───changelog
    │       ├───demo
    │       │   ├───configs
    │       │   └───templates
    │       ├───docs
    │       │   ├───api
    │       │   │   ├───caching
    │       │   │   ├───extending
    │       │   │   ├───filters
    │       │   │   └───variables
    │       │   ├───appendixes
    │       │   ├───designers
    │       │   │   ├───language-basic-syntax
    │       │   │   ├───language-builtin-functions
    │       │   │   ├───language-custom-functions
    │       │   │   ├───language-modifiers
    │       │   │   └───language-variables
    │       │   ├───img
    │       │   └───programmers
    │       │       ├───api-functions
    │       │       └───api-variables
    │       ├───libs
    │       └───src
    │           ├───BlockHandler
    │           ├───Cacheresource
    │           ├───Compile
    │           │   ├───Modifier
    │           │   └───Tag
    │           ├───Compiler
    │           ├───Extension
    │           ├───Filter
    │           │   └───Output
    │           ├───FunctionHandler
    │           ├───Lexer
    │           ├───Parser
    │           ├───ParseTree
    │           ├───Resource
    │           ├───Runtime
    │           └───Template
    └───symfony
        └───polyfill-mbstring
            └───Resources
                └───unidata
```
## Core Components
**Application.php**
```php

<?php
class Application {
    // Default controller and method
    protected $controller = 'HomeController'; 
    protected $method = 'index'; 
    protected $params = []; // Parameters for methods

    // Constructor method that initializes the application
    public function __construct() {
        // Parse the URL to get controller, method, and parameters
        $this->parseUrl();

        // Check if the controller file exists
        if (file_exists('../app/controllers/' . $this->controller . '.php')) {
            // Include the controller file
            require_once '../app/controllers/' . $this->controller . '.php';
            // Instantiate the controller
            $this->controller = new $this->controller();
        } else {
            // Display an error if the controller file is not found
            echo "Controller not found.";
            return;
        }

        // Check if the method exists in the controller
        if (method_exists($this->controller, $this->method)) {
            // Call the method with parameters
            call_user_func_array([$this->controller, $this->method], $this->params);
        } else {
            // Display an error if the method is not found
            echo "Method not found.";
            return;
        }
    }

    // Method to parse the URL
    public function parseUrl() {
        // Check if 'url' is set in the GET request
        if (isset($_GET['url'])) {
            // Trim the trailing slash
            $url = rtrim($_GET['url'], '/');
            // Sanitize the URL
            $url = filter_var($url, FILTER_SANITIZE_URL);
            // Split the URL into an array
            $url = explode('/', $url);

            // Set the controller from the URL, or default to 'HomeController'
            $this->controller = isset($url[0]) ? ucfirst($url[0]) . 'Controller' : 'HomeController';
            // Set the method from the URL, or default to 'index'
            $this->method = isset($url[1]) ? $url[1] : 'index';
            // Remove the controller and method from the URL array
            unset($url[0], $url[1]);

            // Rebase the array and assign remaining values as parameters
            $this->params = $url ? array_values($url) : [];
        }
    }
}
?>


```	
## Controller.php
```php
<?php 
class Controller
{
    // Method to load a view
    protected function view($view, $data = []){
        // Check if the view file exists
        if(file_exists("../app/views/". $view .".php")) {
            // Include the view file
            include "../app/views/". $view .".php";
        } else {
            // If the view file doesn't exist, include an error view
            include "../app/views/DeniedAccess.php";
        }
    } 

    // Method to load a model
    protected function loadModel($model){
        // Check if the model file exists
        if(file_exists("../app/models/". $model .".php")) {
            // Include the model file
            include "../app/models/". $model .".php";
            // Instantiate and return the model object
            return $model = new $model();
        }
        // If the model file doesn't exist, return false
        return false;
    }
}
```
## User Class Validation

```php

  <?php
namespace Services\Validate\Request;

// User class for handling user data and validation
class User {
    public $username;
    public $email;
    public $password;

    // Constructor to initialize User object
    public function __construct($username, $email, $password) {
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
    }

    // Method to validate username format
    public function validateUsername() {
        return preg_match('/^[a-zA-Z0-9]{3,20}$/', $this->username);
    }

    // Method to validate email format
    public function validateEmail() {
        return filter_var($this->email, FILTER_VALIDATE_EMAIL);
    }

    // Method to validate password strength
    public function validatePassword() {
        return preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/', $this->password);
    }

    // Method to validate all user inputs and return errors if any
    public function validate() {
        $errors = [
            'username' => '', // Initialize error message for username
            'email' => '',    // Initialize error message for email
            'password' => ''  // Initialize error message for password
        ];

        // Check if username is empty
        if (empty($this->username)) {
            $errors['username'] = "Username is required.";
        } elseif (!$this->validateUsername()) {
            // Validate username format
            $errors['username'] = "Username must be alphanumeric and between 3-20 characters.";
        }

        // Check if email is empty
        if (empty($this->email)) {
            $errors['email'] = "Email is required.";
        } elseif (!$this->validateEmail()) {
            // Validate email format
            $errors['email'] = "Invalid email format.";
        }

        // Check if password is empty
        if (empty($this->password)) {
            $errors['password'] = "Password is required.";
        } elseif (!$this->validatePassword()) {
            // Validate password strength
            $errors['password'] = "Password must be at least 8 characters long and include at least one uppercase letter, one lowercase letter, and one number.";
        }

        return $errors; // Return the errors array
    }
}  
```
## Template Rendering
### config.php

```php
<?php
// Include the Smarty class
require_once('vendor/smarty/smarty/libs/Smarty.class.php');

// Use the Smarty namespace
use Smarty\Smarty;

// Create a new Smarty object
$smarty = new Smarty();

// Set the directory for Smarty templates
$smarty->setTemplateDir([
    __DIR__ . '/app/views/templates',       // Main templates directory
    __DIR__ . '/app/views/templates/auth',  // Additional templates directory for authentication views
]);

// Set the directory for compiled templates
$smarty->setCompileDir(__DIR__ . '/templates_c');

// Set the directory for cache
$smarty->setCacheDir(__DIR__ . '/cache');

// Set the directory for configuration files
$smarty->setConfigDir(__DIR__ . '/configs');

```
## Controller and View
###HomeController 

- To display Default or Home page

```php
<?php
final class HomeController extends Controller {

    private $store_db_model;
    private $smarty;

    public function __construct() {
        global $smarty;
        $this->smarty = $smarty;
        $this->store_db_model = $this->loadModel('Store');
    }

    public function index(){
        
        $this->smarty->assign('page_title', 'Home | ipOnline');
        $this->smarty->assign('root_link', ROOT);
        $this->smarty->assign('assets_link', ASSETS);
        $this->smarty->display('index.tpl');
    }

}
```

## AuthController 

- responsible to display and handle register authentications

```php
<?php

use Request\Method\RequestHelper;
use Services\Validate\Request\User;

class AuthController extends Controller {

    private $smarty;
    private $store_db_model;

    public function __construct() {
        global $smarty;
        $this->smarty = $smarty;
        $this->store_db_model = $this->loadModel('UserRepository');
    }

    public function register(){
        //check method
        if (RequestHelper::isRequestMethod('POST')) {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $response = array();
            $errors = array(
                'username' => '',
                'email' => '',
                'password' => ''
            );
            $username= isset($_POST['username'])? strip_tags(trim(filter_var($_POST['username'], FILTER_SANITIZE_STRING))):'';
            $email= isset($_POST['email'])? strip_tags(trim(filter_var($_POST['email'], FILTER_SANITIZE_STRING))):'';
            $password= isset($_POST['password'])? strip_tags(trim(filter_var($_POST['password'], FILTER_SANITIZE_STRING))):'';

            $user = new User($username, $email, $password);
            $validationErrors = $user->validate();

            if (empty($validationErrors['username']) && empty($validationErrors['email']) && empty($validationErrors['password'])) {
                //check if username and email already been used.

                if ($this->store_db_model->findUserByEmail($email)) {
                    $errors['email'] = "Email already in used by another user, please choose a different email address.";
                }
                if ($this->store_db_model->findUserByUsername($username)) {
                    $errors['username'] = "This username has already been taken by a user, please choose a different username.";
                }else{
                    //hash password using password_hash() Argon2i
                    $hash_password = password_hash($password, PASSWORD_ARGON2ID);
                    if($this->store_db_model->save_user($username, $email, $hash_password)){
                        $response['success'] = array('status' => 'success', 'details' => 'Registration successful! Welcome, ' . htmlspecialchars($user->username) . '.', http_response_code(201));
                    }else{
                        $errors['username'] = "Unable to register user at this time, please try again later.";
                    }
                }
            } else {
                $errors = array_merge($errors, $validationErrors);
            }
            $this->smarty->assign('errors', $errors);
            $this->smarty->assign('success', isset($response['success']) ? $response['success'] : null);
            $this->smarty->assign('submitted_username', isset($username) ? htmlspecialchars($username) : '');
            $this->smarty->assign('submitted_email', isset($email) ? htmlspecialchars($email) : '');
            $this->smarty->assign('submitted_password', isset($password) ? htmlspecialchars($password) : '');
        }else {
            $this->smarty->assign('errors', array('username' => '', 'email' => '', 'password' => ''));
            $this->smarty->assign('submitted_username', '');
            $this->smarty->assign('submitted_email', '');
        }
            $this->smarty->assign('page_title', 'Register Account');
            $this->smarty->assign('root_link', ROOT);
            $this->smarty->assign('assets_link', ASSETS);
            $this->smarty->display('auth/register.tpl');

    }


    public function login(){
        $this->smarty->assign('page_title', 'Login');
        $this->smarty->assign('root_link', ROOT);
        $this->smarty->assign('assets_link', ASSETS);
        $this->smarty->display('auth/login.tpl');

    }
}

```
### index.tpl
```tpl
<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta name="theme-color" content="#c9190c">
            <meta name="robots" content="index,follow">
            <meta htttp-equiv="Cache-control" content="no-cache">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="msapplication-TileColor" content="#c9190c">
            <meta name="apple-mobile-web-app-capable" content="yes">
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
            <meta name="keywords" content="" />
            <meta name="description" content="" />
            <link href="{$assets_link}css/styles.css" rel="stylesheet">
            <link href="{$assets_link}css/bootstrap.min.css" rel="stylesheet">
            <link href="{$assets_link}fontawesome/css/all.css" rel="stylesheet">
            <link href="{$assets_link}css/styles.css" rel="stylesheet">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
            <script type='text/javascript' src='{$assets_link}js/jquery.min.js'></script>
            <script type='text/javascript' src='{$assets_link}js/bootstrap.min.js'></script>
            <title>{$page_title}</title>
        </head>
<body>
<body>
    <h1>Welcome, {$name}!</h1>
</body>
</html>
```
## Challenges Faced
- **Smarty Integration:** Integrating Smarty required careful configuration to ensure templates were correctly rendered and cached.
- **Form Validation:** Developing a robust validation mechanism that was both flexible and reusable posed a significant challenge.
- **URL Parsing:** Ensuring accurate and secure URL parsing to handle controller and method routing without exposing vulnerabilities.
