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

    CakePlugin::load('GtwRequire');
    
Alias the HTML helper in your AppController.php

    public $helpers = array(
        'Require' => array('className' => 'GtwRequire.GtwRequire'),
    );
    
## Including javascript

Define Add your modules dependencies from your views and view blocks using the req function.

    <?php echo $this->Require->req('app/module_name'); ?>
    
Create a config file as specified by requirejs.

    // app/webroot/js/config.js
    requirejs.config({
        baseUrl: 'js/lib',
        paths: {
            app: '../app'
        }
    });
    
Initialize the main requirejs module at the bottom of your view file. This takes in param the path of your config file.

    <?php echo $this->Require->init('/js/config');?>
    
And you're done. 

## Path-specific includes

If you want to auto-load action-specific or controller-specific files, you can create a folder structure like the one used in the Views.

* base/
    * common.js
    * ControllerName/
        * action.js
    * ControllerName2.js

Then, you can then auto-load modules using this command in your default template. First param is the base path of your folder structure. second param is the name of the default file.
    
    <?php echo $this->Require->basemodule('base', 'common');?>

    
## Copyright and license
Author: Philippe Lafrance    
Copyright 2013 [Gintonic Web](http://gintonicweb.com)    
Licensed under the [Apache 2.0 license](http://www.apache.org/licenses/LICENSE-2.0.html)