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
$routes['GET']['/kereses/(?<keresendo>[A-Za-z0-9\_\P{L}]+)(?<rendezo>[\/]{1}[A-Za-z0-9\_\P{L}]+)'] = 'keresesController';
$routes['GET']['/proba'] = 'ProbaController';
$routes['GET']['/formfeldolgoz'] = 'FormFeldolgozController';
$routes['GET']['/info'] = 'InfoController';
$routes['GET']['/tagok'] = 'TagokController';
$routes['GET']['/profil/(?<felhasznalonev>[A-Za-z0-9]+)'] = 'ProfilController';
//Ha nincs rangja
  //Itt lehet a bejelentkezés rész is 
//Ha van rangja
  //+Az adminnál még egy-két dolog
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
elseif(!isset($_COOKIE["rang"])){
    $routes['GET']['/belepes'] = 'BelepesController';
    $routes['POST']['/belepteto'] = 'BelepesElkuldController';
    $routes['GET']['/regisztracio'] = 'RegisztracioController';
    $routes['POST']['/regisztralo'] = 'RegisztracioElkuldController';
}