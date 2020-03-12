<?php


    /**
     * $title: ide írd az alkalmazás nevét
     */
    /* Weboldal neve */
    //Ezt majd talán később felhasználom
    $SiteName = "GyakoriKérdések";
    
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
//majd ha minden kész van, akkor az egészet, majd le kéne magyarosítani, ha már elkezdtem
$routes['GET']['/'] = 'homeController';
$routes['GET']['/fooldal'] = 'homeController';
$routes['GET']['/rolunk'] = 'RolunkController';
$routes['GET']['/profil'] = 'ProfilController';
//$routes['GET']['/kerdes'] = 'kerdesController';
$routes['GET']['/temak'] = 'temakController';
$routes['GET']['/belepes'] = 'BelepesController';
//belepesPostController kéne ide
//és akkor nem edit, hanem ellenőrzés vagy betöltés vagy valami ilyesmi
//lehet, hogy this is nem kell ide
$routes['POST']['/belepteto'] = 'BelepesElkuldController';
$routes['GET']['/regisztracio'] = 'RegisztracioController';
//regisztracioPostController kéne ide
$routes['POST']['/regisztralo'] = 'RegisztracioElkuldController';
$routes['GET']['/ujkerdes'] = 'ujKerdesController';
//Ezt még át kell írnom majd. 1-2 címke, id, meg utána a kérdéscímből 1-2szó
//A címből maximum 74karakter, úgy, hogy ékezeteseket vagy az ékezet nélkülire átírni, vagy "-" jelre
$routes['GET']['/kerdes/(?<id>[\d]+)'] = 'egyKerdesController';
$routes['POST']['/image/(?<id>[\d]+)/edit'] = 'singleImageEditController';
//$routes['POST']['/image/(?<id>[\d]+)/delete'] = 'singleImageDeleteController';
