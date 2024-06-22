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
    protected $controller = 'HomeController';
    protected $method = 'index';
    protected $params = [];

    public function __construct() {
        $this->parseUrl();

        if (file_exists('../app/controllers/' . $this->controller . '.php')) {
            require_once '../app/controllers/' . $this->controller . '.php';
            $this->controller = new $this->controller();
        } else {
            echo "Controller not found.";
            return;
        }

        if (method_exists($this->controller, $this->method)) {
            call_user_func_array([$this->controller, $this->method], $this->params);
        } else {
            echo "Method not found.";
            return;
        }
    }
    public function parseUrl() {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            $this->controller = isset($url[0]) ? ucfirst($url[0]) . 'Controller' : 'HomeController';
            $this->method = isset($url[1]) ? $url[1] : 'index';
            unset($url[0], $url[1]);
            $this->params = $url ? array_values($url) : [];
        }
    }
}
?>
```	
## Controller.php
```php
<?php 
Class Controller
{
	protected function view($view,$data = []){
		if(file_exists("../app/views/". $view .".php"))
 		{
 			include "../app/views/". $view .".php";
 		}else{
 			include "../app/views/DeniedAccess.php";
 		}
	} 

	protected function loadModel($model){
		if(file_exists("../app/models/". $model .".php")){
 			include "../app/models/". $model .".php";
 			return $model = new $model();
 		}
 		return false;
	}
}
```
## User Class Validation

```php
<?php
 namespace Services\Validate\Request;
 
class User {
    public $username;
    public $email;
    public $password;

    public function __construct($username, $email, $password) {
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        
    }

    public function validateUsername() {
        return preg_match('/^[a-zA-Z0-9]{3,20}$/', $this->username);
    }

    public function validateEmail() {
        return filter_var($this->email, FILTER_VALIDATE_EMAIL);
    }

    public function validatePassword() {
        return preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/', $this->password);
    }

    public function validate() {
        $errors = [
            'username' => '',
            'email' => '',
            'password' => ''
        ];

        if (empty($this->username)) {
            $errors['username'] = "Username is required.";
        } elseif (!$this->validateUsername()) {
            $errors['username'] = "Username must be alphanumeric and between 3-20 characters.";
        }

        if (empty($this->email)) {
            $errors['email'] = "Email is required.";
        } elseif (!$this->validateEmail()) {
            $errors['email'] = "Invalid email format.";
        }

        if (empty($this->password)) {
            $errors['password'] = "Password is required.";
        } elseif (!$this->validatePassword()) {
            $errors['password'] = "Password must be at least 8 characters long and include at least one uppercase letter, one lowercase letter, and one number.";
        }

        return $errors;
    }
}
```
## Template Rendering
### config.php

```php
<?php
require_once('vendor/smarty/smarty/libs/Smarty.class.php');

use Smarty\Smarty;
$smarty = new Smarty();

$smarty->setTemplateDir([
    __DIR__ . '/app/views/templates',
    __DIR__ . '/app/views/templates/auth',
]);
$smarty->setCompileDir(__DIR__ . '/templates_c');
$smarty->setCacheDir(__DIR__ . '/cache');
$smarty->setConfigDir(__DIR__ . '/configs');
```
## Controller and View

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

    public function about(){
        $this->smarty->display('about.tpl');
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
