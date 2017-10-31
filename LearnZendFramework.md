# LearnZendFramework

[TOC]

## Introduction

### Features

* Pure OO

* Advanced MVC implementation

* Supports multi dbs

* Simple cloud API

* Session management

* Data encryption

* Flexible URI Routing

* RESTful API

* Code reusable and easier to maintain

### Goals

* Flexibility

* Simple and productive

* Compatibility

* Extensibility

* Portability

### Advantages

* Loosely Coupled

* Preformance

* Security

* Testing

## Installation

### Installation Zend Framework

#### Composer Based Installation

```shell
$ composer require zendframework/zendframework
```

## Skeleton Application

### Installation using Composer

```shell
$ composer create-project -n -sdev zendframework/skeleton-application myzendapp
$ cd myzendapp
$ composer serve
> php -S 0.0.0.0:8080 -t public/ public/index.php
```

### Unit Tests

```shell
$ composer require --dev zendframework/zend-test
$ ./vendor/bin/phpunit
```

### Apache Web Server

```conf
<VirtualHost *:80>
    ServerName myzendapp.localhost
    DocumentRoot /path/to/install/myzendapp/public
    <Directory /path/to/install/myzendapp/public>
        DirectoryIndex index.php
        AllowOverride All
        Order allow, deny
        Allow from all
        <IfModule mod_authz_core.c>
            Require all granted
        </IfModule>
    </Directory>
</VirtualHost>
```

## MVC Architecture

## Concepts

Three most important components:

* **Event Manager**

  It gives the ability to create event based programming.
  This helps to create, inject and manage new events.

* **Service Manager**

  It gives the ability to consume any service (PHP classes) from anywhere with
  a little effort.

* **Module Manager**

  Ability to convert a collection of PHP classes with similar functionality
  into a single unit called as a **module**. The newly created modules can be
  used, maintained and configured as a single unit.

## Service Manager

A powerful service location pattern implementation.

### Install Service Manager

```shell
$ composer require zendframework/zend-servicemanager
```

#### Service Manager Registration

* Factory method

* Abstract factory method

* Initializer method

* Delegator factory method

### Factory Method

### Abstract Factory Method

### Initializer Method

### Delegator Factory Method

### Plugin Manager

### Configuration Option

## Event Manager

Helps to design high level architecture and supports subject/observer pattern
and aspect oriented programming.

### Install Event Manager

```shell
$ composer require zendframework/zend-eventmanager
```

## Module System

Has three components:

* **Module Autoloader**

  It is responsible for locating and loading of modules from variety of sources.
  It can load modules packaged as Phar archives as well.
  The implementation is located at `vender/zendframework/zend-loader/src/ModuleAutoloader.php`.

* **Module Manager**

  Once the Module Autoloader locates the modules, it fires a sequence of events
  for each module.
  The implementation is located at `vender/zendframework/zendmodulemanager/src/ModuleManager.php`.

* **Module Manager Listeners**

  They can be attached to the events fired by Module Manager.
  By attaching to the events of module manager, they can do everything
  from resolving and loading modules to performing complex work for each modules.

### MVC Web Module System

The recommended structure for MVC-Oriented module is as follows:

```
module_root/
    Modele.php
    autoload_classmap.php
    autoload_function.php
    autoload_register.php
    config/
        module.config.php
    public/
        images/
        css/
        js/
    src/
        <module_namespace>/
        <code files>
    test/
        phpunit.xml
        bootstrap.php
        <module_namespace>/
            <test code files>
    view/
        <dir-named-after-module-namespace>/
            <dir-named-after-a-controller>/
                <.phmtl files>
```

### Module Class

The Module class should be named **Module** and the namespace of the module
class should be **Module name**. This will help the Zend Framework to resolve
and load the module easily.

## Applications Structure

The Zend Framework application consists of different folders.
They are as follows:

* **Application**

  It will house the MVC system, as well as configurations, services used and
  bootstrap file.

* **Config**

  It contains the configuration files of an application.

* **Data**

  It provides a place to store application data that is volatile and possibly
  temporary.

* **Module**

  Modules allow a developer to group a set of related controllers into a
  logically organized group.

* **Public**

  It is The application's document root. It starts the Zend application.
  It also contains the assets of the application.

* **Vender**

  It contains composer dependencies.

### Structure of the Application Modules

This is the main directory of the application. The **Application** module of
the skeleton application provides bootstrapping, error and routing
configuration to the whole application. The structure is as shown below:

```
|-- module/
    |-- Application/
        |-- config/
            |-- module.config.php
        |-- src/
            |-- Controller/
                |-- IndexController.php
            |-- Module.php
        |-- test/
            |-- Controller/
                |-- IndexControllerTest.php
        |-- view/
            |-- application/
                |-- index/
                    |-- index.phtml
            |-- error/
                |-- 404.phtml
                |-- index.phtml
            |-- layout/
                |-- layout.phtml
```

* **Application**

  Root directory of the module. The name of the folder will match the name of
  the module and the name is also used as the PHP namespace of all the class
  defined inside the module. It will house the MVC system, as well as
  configurations, services used, and bootstrap file.

* **Config**

  Independent configuration of the module.

* **Src**

  Main business logic of the application.

* **View**

  Contains design / presentation files.

* **src/Module.php**

  The heart of the module. Works as a "front controller" for the module.
  The Zend process **src/Module.php** file before processing any PHP classes.

* **Application/config/module.config.php**

  Implemented for the router configuration and auto loading files.

* **Application/view/layoutModule.php**

  Layouts represent the common parts of multiple views.

## Creating a Module

0. Create the **Tutorial** module.

```php
<?php
// /module/Tutorial/src/Module.php

namespace Tutorial;

use Zend\ModuleManager\Feature\ConfigProviderInterface;

class Module implements ConfigProviderInterface
{
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }
}
```

1. Configure the **Tutorial** module.

```json
// /composer.json

"autoload": {
    "psr-4": {
        "Application\\": "module/Application/src",
        "Turorial\\": "module/Turorial/src"
    }
}
```

2. Update the application.

```shell
$ composer update
```

3. Create the **Tutorial** module configuration file.

```php
<?php
// /module/Tutorial/config/module.config.php

namespace Tutorial;

use Zend\ServiceManager\Factory\InvokableFactory;
use Zend\Router\Http\Segment;

return [
    'controller' => [
        'factories' => [
            Controller\TutorialController::class => InvokableFactory::class,
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            'tutorial' => __DIR__ . '/../view',
        ],
    ],
];
```

4. Configure the **Tutorial** module in the application level configuration file.

```php
// /config/modules.config.php

return [
    'Zend\Router',
    'Zend\Validator',
    'Application',
    'Tutorial',
];
```

## Controllers

0. Create the **Tutorial** controller.

```php
<?php
// /module/Tutorial/src/Controller/TutorialController.php

namespace Tutorial\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class TutorialController extends AbstractActionController
{
    public function indexAction()
    {
        $view = new ViewModel();

        return $view;
    }
}
```

1. Create the corresponding view file.

```shell
$ touch /module/Tutorial/view/tutorial/tutorial/index.phtml
```

## Routing

## View Layer

## Layout

## Models & Database

## Different Databases

## Froms & Validation

## File Uploading

## AJAX

## Cookie Management

## Session Mangement

## Authentication

## Email Management

## Unit Testing

## Error Handling

## Working Example
