/*
    Gintonic Web
    Author:    Philippe Lafrance
    Link:      http://gintonicweb.com
*/

requirejs.config({

    baseUrl: '/GtwUi/js/lib',
    
    paths: {
        app: '/GtwUi/js/app',
        jquery: [
            '//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min',
            '/GtwUi/js/lib/jquery-2.0.3.min'
        ],
        bootstrap: '/GtwUi/js/bootstrap/bootstrap.min',
        datatables: '/GtwUi/js/lib/jquery.dataTables.min',
        datatablesBootstrap: '/GtwUi/js/app/datatables_bootstrap',
        datatablesEnable: '/GtwUi/js/app/datatables_enable',
    },
    
    shim: {
        'bootstrap': ['jquery'],
        'datatables': ['jquery'],
        'datatablesBootstrap': ['datatables', 'jquery'],
        'datatablesEnable': ['datatablesBootstrap', 'datatables', 'jquery'],
    },
    
    optimize: "none"
    
});

define(function(require) {
    
    // Global javascript
    require("jquery");
    require('bootstrap');
    require('datatablesEnable');
    
});