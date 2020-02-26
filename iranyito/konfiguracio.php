<?php


    /**
     * $title: ide írd az alkalmazás nevét
     */
    /* Weboldal neve */
    $SiteName = "GyakoriKérdések";
    /**
     * lehetséges oldalméret értékek
     */
    //$possiblePageSize= [5, 10, 20, 30, 50, 100];
    
    /**
     * Adatbázis kapcsolodáshoz szükséges adat
     */
    $config['db_host'] = 'localhost';
    $config['db_user'] = 'root';
    $config['db_pass'] = '';
    $config['db_name'] = 'gyakorikerdesek';

/**
 * $routes - utvonalaktat tároló tömb
 */
$routes = [];
// utvonalak felvétele a $routes tömbbe
$routes['GET']['/'] = 'homeController';
$routes['GET']['/about'] = 'aboutController';
//$routes['GET']['/kerdes'] = 'kerdesController';
$routes['GET']['/temak'] = 'temakController';
$routes['GET']['/belepes'] = 'BelepesController';
$routes['GET']['/regisztracio'] = 'RegisztracioController';
$routes['GET']['/ujkerdes'] = 'ujKerdesController';
$routes['GET']['/kerdes/(?<ID>[\d]+)'] = 'egyKerdesController';

//$routes['POST']['/image/(?<id>[\d]+)/edit'] = 'singleImageEditController';
//$routes['POST']['/image/(?<id>[\d]+)/delete'] = 'singleImageDeleteController';
