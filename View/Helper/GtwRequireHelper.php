<?php
/**
 * Gintonic Web
 * @author    Philippe Lafrance
 * @link      http://gintonicweb.com
 */

class GtwRequireHelper extends AppHelper {
    
    public $helpers = array('Html');
    
    public function load($config, $require = '//cdnjs.cloudflare.com/ajax/libs/require.js/2.1.8/require.min.js'){
        $modules = '';
        if (!is_null($this->_View->get('requiredeps'))){
            $modules = "require([". implode(',',$this->_View->get('requiredeps')) . "]);";
        }
        $configStripped = substr( $config, strrpos( $config, '/' )+1 );
        
        return
            "<script>var baseUrl = '". $this->Html->url('/', true) ."';</script>
            <script data-main='".$config."' src='".$require."'></script>
            <script type='text/javascript'>
                require(['". $configStripped . "'], function () {
                    require (['basepath']);
                    ". $modules ."
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
    
    public function ajax_req($name){
        return 
            '<script>'.
                'require(["'.$name.'"]);'.
            '</script>';
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