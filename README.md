# Requirejs plugin for CakePHP

This module facilitate the use of Requirejs through the Require helper.

* Modules can be added from views or view blocks
* Define your own config file, load modules according to your needs.
* Possibility of auto-loading modules based on action/controller names.

## Installation

Copy this plugin in a folder named `app/Plugin/GtwRequire` or add these lines to your `composer.json` file :

    {
        "require": {
            "phillaf/gtw_require": "*@dev"
        }
    }
    
Create a symlink from this plugin's webroot to the application webroot by running `Console/cake symlink` or the lines below

    # On windows
    mklink /J app\webroot\GtwUi app\Plugin\GtwUi\webroot

    # On linux
    ln -s app/Plugin/GtwUi/webroot app/webroot/GtwUi

Load the plugin by adding this line to `app/Config/bootstrap.php`

    CakePlugin::load('GtwRequire');
    
Add the Require helper to your AppController.php

    public $helpers = array(
        'Require' => array('className' => 'GtwRequire.GtwRequire'),
    );
    
## Including javascript

Create a config file as specified by requirejs. You can find a more exhaustive example [here](https://gist.github.com/Phillaf/7051827).

    // app/webroot/js/config.js
    requirejs.config({
        baseUrl: 'js/lib',
        paths: {
            app: '../app',
        }
    });
    
Load modules from your views, view blocks and elements using the req function.

    <?php echo $this->Require->req('my/module'); ?>

Load the main requirejs module at the bottom of your layout file. The param is the path of your config file.

    <?php echo $this->Require->load('/js/config');?>
    
The `req()` function can only be called before `load()`. However, in some case like with ajax views, you'll need to add modules dynamically. For this you can use:

    <?php echo $this->Require->ajax_req('my/module');?>
    
## Path-specific includes

If you want to auto-load action-specific or controller-specific files, you can create a folder structure like the one used in the Views.

    ├── lib
    │   └── library1.js
    │   └── library2.js
    ├── app
    │   └── homemade1.js
    │   └── homemade2.js
    ├── base
    │   ├── Example /* folder containing ExampleController.php actions */
    │   │   ├── someaction.js
    │   │   ├── otheraction.js
    │   ├── base.js
    │   ├── ExampleController.js
    │   ├── AnotherController.js
    └── require.js

To enable auto-load, call the following function above your `load()` call. First param is the base path of your folder structure, second param is the name of the default file.
    
    <?php echo $this->Require->basemodule('basePath', 'baseModuleName');?>

## Copyright and license
Author: Philippe Lafrance
Copyright 2013 [Gintonic Web](http://gintonicweb.com)
Licensed under the [Apache 2.0 license](http://www.apache.org/licenses/LICENSE-2.0.html)
