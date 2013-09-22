Requirejs plugin for CakePHP
======================

This module facilitate the use of Requirejs through the use of a helper.
* Modules can be added from views or view blocks
* Define your own config file, load modules according to your needs.
* Possibility of auto-loading modules based on action/controller.

This plugin lets you manage requirejs. Modules can be loaded using the requirejs helper.

Installation
-------------

Load the plugin using bootstrap.php

    CakePlugin::load('GtwRequire');
    
Alias the HTML helper in your AppController.php

    public $helpers = array(
        'Require' => array('className' => 'GtwRequire.GtwRequire'),
    );
    
Documentation
-------------

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
    
Initialize the main requirejs module at the bottom of your view file. This takes in param the path
of your config file.

    <?php echo $this->Require->init('/js/config');?>
    
And you're done. Additionnaly, if you want to auto-load action-specific or controller-specific files,
you can create a folder structure like the one used in the Views.

* base/
    * common.js
    * ControllerName/
        * action.js
    * ControllerName2.js

Then, you can then auto-load modules using this command in your default template. First param is the
base path of your folder structure. second param is the name of the default file.
    
    <?php echo $this->Require->basemodule('base', 'common');?>

    