<?php
/**
 * Gintonic Web
 * @author    Philippe Lafrance
 * @link      http://gintonicweb.com
 */

class GtwRequireHelper extends AppHelper {
    
    public function init($config, $require = '//cdnjs.cloudflare.com/ajax/libs/require.js/2.1.8/require.min.js'){
       $modules = implode(',',$this->_View->get('requiredeps'));
       return
           "<script data-main='".$config."' src='".$require."'></script>
            <script type='text/javascript'>
                require(['js/config.js'], function () {
                    require([". $modules ."]);
                });
            </script>";
    }
    
    public function req($name){
        if (!isset($this->_View->viewVars['requiredeps'])){
            $this->_View->viewVars['requiredeps'] = array();
        }
        array_push($this->_View->viewVars['requiredeps'], "'".$name."'");
        return;
    }
    
    public function basemodule($base, $default){
    
        $jsController = $base . Inflector::camelize($this->params['controller']);
        
        // if action exists
        if (is_file($jsController . '/' . $this->params['action'] . '.js')) {
            $file = $base . Inflector::camelize($this->params['controller']) . '/' . $this->params['action'];
            $this->req($file);
            return;
        } 
        
        // if controller exists
        if(is_file($jsController . '.js')) {
            $file = $base . Inflector::camelize($this->params['controller']);
            $this->req($file);
            return;
        }
        
        // if nothing else exists
        return $this->req($base.'/'.$default);
    }
}