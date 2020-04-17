<?php

/**
 * controllers.php: Az egyes útvonalakat (route) lekezelő függvények.
 * Minden függvénynek egy tömböt kell visszaadnia, aminek az első eleme a nézet (view)  neve.
 * Második eleme egy assoc tömb, amiben minden kulcs-érték párnak szerepelnie kell, amit a nézet használni fog.
 * return ["viewname", ['key1' => 'value1', 'key2' => 'value2', ...]];
 */
 
/**
 * notFoundController()
 *
 * @return void
 */

function notFoundController() {
    return [
        '404',
        [
            'title' => 'The page you are lookgin for is not found.'
        ]
    ];
}

/**
 * homeController()
 *
 * @return void
 */
function homeController() {
    /**
     * Query string változók: $_GET[]
     * PHP 7 új operátora: null coalescing operator
     * A ternary operátor (felt ? true : false) és az isset() fv. együttes használatát helyettesíti.
     * A null coalescing operator az első (bal oldali) operandusát adja vissza, ha az létezik és nem null, különben a másodikat (jobb oldalit)
     * Az isset() fv. igazat ad vissza, ha a paraméterül adott változó létezik és nem null (gyakran használatos a $_GET-ben levő változók ellenőrzésére).
     * Tehát az
     *   isset($_GET["size"]) ? $pageSize = $_GET["size"] : $pageSize = 10;
     * helyettesíthető ezzel:
     *   $pageSize = $_GET["size"] ??  10;
     * ami lényegesen tömörebb...
     */
    $size = $_GET["size"] ?? 10;    // $size: lapozási oldalméret
    $page = $_GET["page"] ?? 1;     // $page: oldalszám
    // $connection: Adatbázis kapcsolat
    $connection = getConnection();
    // $total: a képek számának meghatározása
    $total = Osszes($connection);
    // $offset: eltolás kiszámítása
    $offset = ($page - 1) * $size;
     //$content: egy oldalnyi kép
    $content =  FooldalKerdesek($connection, $size, $offset);
    
    $lastPage = $total % $size == 0 ? intdiv($total, $size) : intdiv($total, $size) + 1;
    
    //----------------------------------------------------------------------------------------
 
    return [
        'fooldal',
        [
            //Ezel azok, mármint szerintem, amit POST fügvénnyel átadok a gecibe
            'title' => 'Home page',
            'content' => $content,
            'total' => $total,
            'size' => $size,
            'page' => $page,
            'lastPage' => $lastPage
        ]
    ];
}

function egyKerdesController($params){
    $connection = getConnection();
    //itt meghívom a faszomat
    $kerdeshezTartozo = adatLeKeres($connection,$params['id']);
    
    return [
        'kerdes',
        [
            'title' => 'Kerdes',
            'kerdeshezTartozo' => $kerdeshezTartozo
        ]
    ];
}

function ujKerdesController(){
    //Ez csak akkor érje el, ha be van jelentkezve
    return
        [
        'ujkerdes',
        [
            'title' => 'Új Kérdés'
        ]
    ];
}
function ujKerdesElkuldController(){
    $kerdesrov = $_POST["kerdesrov"];
    $akerdes = $_POST["akerdes"];
    $felh_id = $_POST["felh_id"];
    $cimke1 = $_POST["0"];
    $cimke2 = $_POST["1"];
    $cimke3 = $_POST["2"];
    $cimke4 = $_POST["3"];
    $cimke5 = $_POST["4"];
    $cimkek = array($cimke1, $cimke2, $cimke3, $cimke4, $cimke5);
    //cimke1, cimke2, cimke3, cimke4, cimke5
    return[
        'ujkerdeselkuld',
        [
            'title' => 'Új kérdés elküldése',
            'kerdesrov' => $kerdesrov,
            'akerdes' => $akerdes,
            'felh_id' => $felh_id,
            'cimkek' => $cimkek
            
        ]
    ];
}
/**itt csak rámegyünk az oldalra, és 
meg tudjuk ejteni a bejelentkezést*/
function BelepesController(){
    return[
        'belepes',
        [
            'title' => 'Belépés'
        ]
    ];
}
/**
 * Ez meghívja azt az oldalt, ami
 * majd ellenőrzi a Belépési kéréseket
 */
function BelepesElkuldController()
{
    $felhasznalonev = $_POST['felhasznalonev'];
    $jelszo = $_POST['jelszo'];
    $connection = getConnection();
    //$id = $params['id'];
    //kell egy post email vagy post felhasznalonev és egy post jelszó
    return [
        'belepteto',
        [
            'title' => 'Belépés',
            'felhasznalonev' => $felhasznalonev,
            'jelszo' => $jelszo,
            'connection' => $connection
            
        ]
    ];
}
function KijelentkezesController(){
    return[
        'kijelentkezes',
        [
            'title' => 'Kijelentkezés'
        ]
    ];
}
function RegisztracioController(){
    return[
        'regisztracio',
        [
            'title' => 'Regisztráció'
        ]
    ];
    //elmegy a regisztralo.php-ba.
    //Ott megnézi, hogy az adatok jók-e,
    //ha igen, akkor továbbengedi
}
function RegisztracioElkuldController(){
    $email = $_POST['email'];
    $felhasznalonev = $_POST['felhasznalonev'];
    $jelszo = $_POST['jelszo'];
    $connection = getConnection();
    return [
        'regisztralo',
        [
            'title' => 'Regisztráció',
            'email' => $email,
            'felhasznalonev' => $felhasznalonev,
            'jelszo' => $jelszo,
            'connection' => $connection
            
        ]
    ];
}
    function ValaszElkuldController(){
        $valasz = $_POST['valasz'];
        $kerdes_id = $_POST['kerdes_id'];
        $valaszolo_id = $_POST['valaszolo_id'];
        $connection = getConnection();
        return [
            'valaszelkuld',
            [
                'title' => 'Válasz Elküldése',
                'valasz' => $valasz,
                'kerdes_id' => $kerdes_id,
                'valaszolo_id' => $valaszolo_id,
                'connection' => $connection
                
            ]
            ];
}
function RolunkController(){
    return [
        'rolunk',
        [
            'title' => 'Rolunk'
            
        ]
    ];
}
function ProfilController($params){
    return[
        'profil',
        [
            'title' => 'Profil',
            'felhasznalonev' => $params["felhasznalonev"]
        ]
    ];
}
function keresesController($params){
    return[
        'kereses',
        [
            'title' => 'Keresés',
            'keresendo' => $params["keresendo"],
            'rendezo' =>  $params["rendezo"]
        ]
    ];
}
function KerdeseimController(){
    
    return [
        'kerdeseim',
        [
            'title' => 'Kérdéseim'
            
        ]
    ];
}
function ValaszaimController(){
    return [
        'valaszaim',
        [
            'title' => 'Válaszaim'
        ]
    ];
}
function ErtesitesekController(){
    return [
        'ertesitesek',
        [
            'title' => 'Értesítések'
        ]
    ];
}
function CimkeController($params){
    return [
        'cimke',
        [
            'title' => 'Címkék',
            'keresendo' => $params["keresendo"]
            
        ]
    ];
}
function CimkeHozzaaddController(){
    return [
        'cimkehozzaadd',
        [
            'title' => 'Címkék Hozzáadása'
        ]
    ];
}
function ErtekelesController(){
    $hvnh = $_POST['hvnh'];
    $valasz_id = $_POST['valasz_id'];
    $felh_id = $_POST['felh_id'];
    $connection = getConnection();
    return [
        'ertekeles',
        [
            'title' => 'Értékelés',
            'hvnh' => $hvnh,
            'valasz_id' => $valasz_id,
            'felh_id' => $felh_id,
            'connection' => $connection
        ]
    ];
}
function InfoController(){
    return [
        'info',
        ['title' => 'Információk'
        ]
    ];
}
function TagokController(){
    return [
        'tagok',
        ['title' => 'Tagok'
        ]
    ];
}
function ProbaController(){
    return [
        'proba',
        ['title' => 'Próba'
        ]
    ];
}
function FormFeldolgozController(){
    return[
        'formfeldolgoz',
        [
            'title' => 'formfeldolgoz'
        ]
        ];
}
