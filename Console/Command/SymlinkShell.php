<?php
/*
    Gintonic Web
    Author:    Philippe Lafrance
    Link:      http://gintonicweb.com
    
*/

class SymlinkShell extends AppShell {

    public function main() {
        if (!file_exists(WWW_ROOT.'GtwRequire')){
            symlink ( CakePlugin::path('GtwRequire').'webroot' , WWW_ROOT.'GtwRequire');
        }
    }
}

