# Requirejs plugin for CakePHP

This module facilitate the use of Requirejs through the use of a helper.

* Modules can be added from views or view blocks
* Define your own config file, load modules according to your needs.
* Possibility of auto-loading modules based on action/controller.

## Installation

Ensure require is present in composer.json. This will install the plugin into Plugin/GtwRequire:

    {
        "require": {
            "phillaf/gtw_require": "*@dev"
        }
    }

Load the plugin using bootstrap.php

    CakePlugin::load('GtwRequire' => array('bootstrap' => 'init'));
    
Alias the HTML helper in your AppController.php

    public $helpers = array(
        'Require' => array('className' => 'GtwRequire.GtwRequire'),
    );
    
## Including javascript

Define Add your modules dependencies from your views and view blocks using the req function.

    <?php echo $this->Require->req('app/module_name'); ?>
    
Create a config file as specified by requirejs. `basepath` is the application base path. Some Gtw Plugins are dependent on this to make ajax calls.

    // app/webroot/js/config.js
    requirejs.config({
        baseUrl: 'js/lib',
        paths: {
            app: '../app',
            basepath: '/GtwRequire/js/app/basepath' //application base path
        }
    });
    
Initialize the main requirejs module at the bottom of your view file. This takes in param the path of your config file.

    <?php echo $this->Require->init('/js/config');?>
    
And you're done.

## Path-specific includes

If you want to auto-load action-specific or controller-specific files, you can create a folder structure like the one used in the Views.

    ├── lib
    │   └── librairie1.js
    │   └── librairie2.js
    ├── app
    │   └── homemade1.js
    │   └── homemade2.js
    ├── base
    │   ├── Random /* for Random controller */
    │   │   ├── someaction.js
    │   │   ├── otheraction.js
    │   ├── base.js
    │   ├── RandomController.js
    │   ├── AnotherController.js
    └── reqauire.js

Then, you can then auto-load modules using this command in your default template. First param is the base path of your folder structure. second param is the name of the default file.
    
    <?php echo $this->Require->basemodule('basePath', 'baseModuleName');?>

## Performance    
    
This plugin creates a symlink to your webroot directory to make it easier on CakePHP's router. However, the symlink only needs to be created once. Therefore you can remove the folder check from every page load by changing your call to `CakePlugin::load('GtwRequire');` in bootstrap.php
    
## Copyright and license
Author: Philippe Lafrance
Copyright 2013 [Gintonic Web](http://gintonicweb.com)
Licensed under the [Apache 2.0 license](http://www.apache.org/licenses/LICENSE-2.0.html)
