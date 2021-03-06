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
$routes['GET']['/cimke/(?<keresendo>[A-Za-z\P{L}]+)'] = 'CimkeController';
$routes['GET']['/temak'] = 'temakController';
$routes['GET']['/kerdes/(?<id>[\d]+)'] = 'egyKerdesController';
//kell tartalmaznia egy keresendőt, ami A-Za-z0-9_ és Latin betűs karaktereket tartalmazhat
//és kell tartalmaznia egy rendezo-t, aminek az első karaktere 0-1db / lehet és utána a többi.
$routes['GET']['/kereses/(?<keresendo>[A-Za-z0-9\_\P{L}]+)(?<rendezo>[\/]{1}[A-Za-z0-9\_\P{L}]+)'] = 'keresesController';
$routes['GET']['/info'] = 'InfoController';
$routes['GET']['/tagok'] = 'TagokController';
$routes['GET']['/profil/(?<felhasznalonev>[A-Za-z0-9]+)'] = 'ProfilController';

if(isset($_COOKIE["rang"])){
    //Egy felhasználó itt tud értékelni egy választ. Hasznos vagy Nem hasznos
    $routes['GET']['/ujkerdes'] = 'ujKerdesController';
    $routes['POST']['/ujkerdes/elkuld'] = 'ujKerdesElkuldController';
    $routes['POST']['/valaszelkuld'] = 'ValaszElkuldController';
    $routes['POST']['/ertekeles'] = 'ErtekelesController';
    
    $routes['GET']['/ertesitesek'] = 'ErtesitesekController';
    $routes['GET']['/kerdeseim'] = 'KerdeseimController';
    $routes['GET']['/valaszaim'] = 'ValaszaimController';

    $routes['GET']['/kijelentkezes'] = 'KijelentkezesController';
    if($_COOKIE["rang"] == "Admin"){
        //Itt tudnak az Adminok Cimkéket hozzáadni
        $routes['GET']['/cimkehozzaadd'] = 'CimkeHozzaaddController';
    }
}
//Ha valaki be van jelentkezve, akkor ezeket nem értheti el. Csak azok akik nincsenek
elseif(!isset($_COOKIE["rang"])){
    $routes['GET']['/belepes'] = 'BelepesController';
    $routes['POST']['/belepteto'] = 'BelepesElkuldController';
    $routes['GET']['/regisztracio'] = 'RegisztracioController';
    $routes['POST']['/regisztralo'] = 'RegisztracioElkuldController';
}