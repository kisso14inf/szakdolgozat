<?php

    //Fuggvények

    /**
     * Lapozást megvalósító függvény
     *
     * @param [type] $total Összes kép szám 
     * @param [type] $currentPage Aktuális oldal száma
     * @param [type] $size Lapméret
     * @return [string] A lapozósáv listaelemeinek a markupja-ját adja vissza
     */
function paginate($total, $currentPage, $size)
    {
        $page = 0;
        $markup = "";
       //Előző oldal
       if ($currentPage > 1) {
           $prevPage = $currentPage -1;
           $markup .=     
            "<li class=\"page-item \">
           <a class =\"page-link\" href=\"?size=$size&page=$prevPage\">Prev</a>
           </li>";
       }
       else {
           
           $markup .=     
           "<li class=\"page-item disabled\">
          <a class =\"page-link\" href=\"#\">Prev</a>
          </li>";

       }

        // számozott lapok
       for ($i=0; $i < $total; $i+=$size) { 
           $page++;
           $activeClass = $currentPage == $page ? "active":"";
           $markup .= 
           "<li class=\"page-item $activeClass\">
           <a class=\"page-link\" href=\"?size=$size&page=$page\">$page</a>
           </li>";
       }

       //Következő oldal

       if ($currentPage < $page) {
           $nextPage = $currentPage +1;
           $markup .=     
            "<li class=\"page-item \">
           <a class =\"page-link\" href=\"?size=$size&page=$nextPage\">Prev</a>
           </li>";
       }
       else {
           
           $markup .=     
           "<li class=\"page-item disabled\">
          <a class =\"page-link\" href=\"#\">Prev</a>
          </li>";

       }

       return $markup;

    }

/**
 * Hiba esetén megjeleníti a templates/error.php oldalt
 *
 * @return void
 */
function errorPage() {
    include "oldalak/error.php";
    die();
}

/**
 * Kiír egy hibát a logfájlba (logs/application.log)
 *
 * @param [string] $level Hiba szint.
 * @param [string] $message Hibaüzenet szövege.
 * @return void
 */
function logMessage($level, $message) {
    $file = fopen("logok/application.log", "a"); // megynyit és bővít
    fwrite($file, "[$level] " . date("Y-m-d H:i:s") . "$message" . PHP_EOL); //PHP_EOL lezárás
    fclose($file);
}
function getConnection()
{
global $config;
$connection = mysqli_connect($config['db_host'], $config['db_user'], $config['db_pass'], $config['db_name']); //el kell tárolni egy változóban
mysqli_set_charset($connection,"utf8");
date_default_timezone_set('Europe/Budapest');

if (!$connection) {
    logMessage("Error", "Failed to connect to MySQL:" . mysqli_connect_error());
    errorPage();
    //die(mysqli_connect_error()); //ha a die-t meghívom akkor megáll az oldal betőltése
}

return $connection;

}

/**
 * getTotal() a képek számának meghatározása
 *
 * @param [type] $connection MySQL kapcsolat
 * @return [int] A képek száma
 */
function Osszes($connection) {
    $query = "SELECT count(*) AS count FROM kerdesek";
    if ($result = mysqli_query($connection, $query)) {
        $row = mysqli_fetch_assoc($result);
        return $row['count'];
    } else {
        logMessage("ERROR", 'Query error: ' . mysqli_error($connection));
        errorPage();
    }  
}

/**
 * Egy oldalnyi képet ad vissza az adatbázisból, a lapméret és az eltolás alapján.
 *
 * @param [type] $connection MySQL kapcsolat
 * @param [int] $size Lapméret
 * @param [int] $offset Eltolás
 * @return void MYSQLI_ASSOC
 */
function getPhotosPaginated($connection, $size, $offset) {
    $query = "SELECT * FROM kerdesek LIMIT ?, ?";
    if ($statment = mysqli_prepare($connection, $query)) { //előkészítés
        mysqli_stmt_bind_param($statment, "ii", $offset, $size); // itt kerül behelyettesítésre a kérdőjelek helyére a változó ii- integer and integer
        mysqli_stmt_execute($statment); //végrehajtás
        $result = mysqli_stmt_get_result($statment); //eredménymegszerzés
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        logMessage("ERROR", 'Query error: ' . mysqli_error($connection));
        errorPage();
    } 
}


/**
 * Egy képet ad vissza, azonosító alapján
 *
 * @param [type] $connection
 * @param integer $id
 * @return void
 */
function getImageById($connection, $id) {
    $query = "SELECT * FROM kerdesek WHERE ID = ?";
    if ($statment = mysqli_prepare($connection, $query)) {
        mysqli_stmt_bind_param($statment, "i", $id); //bind-hozzákötés "i"-integer 
        mysqli_stmt_execute($statment);
        $result = mysqli_stmt_get_result($statment);
        return mysqli_fetch_assoc($result);
    } else {
        logMessage("ERROR", 'Query error: ' . mysqli_error($connection));
        errorPage();
    }  
}

/**
 * Egy route (útvonal) és a hozzá tartozó kezelő függvény hozzáadása a $routes assoc tömbhöz.
 *
 * @global
 * @param   mixed   $route      Útvonal
 * @param   mixed   $callable   Handler function (Controller)
 * @param   string  $method     Default: "GET"
 * @return  void
 */
/*function route($route, $callable, $method = "GET") {
    global $routes;
   // $route = "%^$route$%"; //itt csinál mintát belőle a % -ék a / jel kizárása , A helyett nem itt adjuk hozzá hanem akkor amikor kiveszük a tömből.
    $routes[strtoupper($method)][$route] = $callable;
} */

/**
 * Az aktuális útvonalhoz tartozó kezelő függvény(Controller) kikeresése, meghívása
 *
 * @param [string] $actualRoute Az aktuális útvonal
 * @return [bool] true - találat esetén | false egyébként
 */
function dispatch($actualRoute, $notFound) {
    global $routes;
    $method = $_SERVER["REQUEST_METHOD"];   // POST GET PATH DELETE
    if (key_exists($method, $routes)) { //key_exists -van e az adott kulcs(létezik e)
        foreach ($routes[$method] as $route => $callable) {
            $route = "%^$route$%"; //itt tesszük rá
            if (preg_match($route, $actualRoute, $matches)) { //$matches -kimeneti paraméter
                return $callable($matches);
            }
        }
    }
    return $notFound();
}
function veletlenKerdes()
{
    //Amikor a véletlenkérdés gombra kapcsol az emberke, ezt hívja meg
}
function FooldalKerdesek($connection, $size, $offset)
{
    $query = "SELECT * FROM kerdesek LIMIT ?, ?";
    if ($statment = mysqli_prepare($connection, $query)) { //előkészítés
        mysqli_stmt_bind_param($statment, "ii", $offset, $size); // itt kerül behelyettesítésre a kérdőjelek helyére a változó ii- integer and integer
        mysqli_stmt_execute($statment); //végrehajtás
        $result = mysqli_stmt_get_result($statment); //eredménymegszerzés
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        logMessage("ERROR", 'Query error: ' . mysqli_error($connection));
        errorPage();
    } 
    
}
  
function Kereses(){
 //Amit a főkeresőbe beírunk, egy  függvény segíségével futtassa le
//NA TALÁN ENNEK IS ELJÖTT AZ IDEJE    
}

function StatisztikaK($connection){
    //EZT MÉG ÁT KELL GONDLNOM A GECIBEEEEE
    
    
    //A jobbsávban lévő adatok statistikájának összegyűjtése
    //Kérdések száma, Válaszok száma, Tagok száma
    //Top5 legfelkapottabb kérdés
    //Top5 erre még nem válaszoltak
    //Top5 legaktívabb kérdezők
    //Top5 legaktívabb válaszolók
    //top5 új tag
    $query = "SELECT * FROM kerdesek";
    if ($statment = mysqli_prepare($connection, $query)) { //előkészítés
        //mysqli_stmt_bind_param($statment, "ii", $offset, $size); // itt kerül behelyettesítésre a kérdőjelek helyére a változó ii- integer and integer
        mysqli_stmt_execute($statment); //végrehajtás
        $result = mysqli_stmt_get_result($statment);
        //eredménymegszerzés
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    } 
    else {
        logMessage("ERROR", 'Query error: ' . mysqli_error($connection));
        errorPage();
    } 
    
}
function StatisztikaV($connection){
    //EZT MÉG ÁT KELL GONDLNOM A GECIBEEEEE
    
    
    //A jobbsávban lévő adatok statistikájának összegyűjtése
    //Kérdések száma, Válaszok száma, Tagok száma
    //Top5 legfelkapottabb kérdés
    //Top5 erre még nem válaszoltak
    //Top5 legaktívabb kérdezők
    //Top5 legaktívabb válaszolók
    //top5 új tag
    $query = "SELECT * FROM valaszok";
    if ($statment = mysqli_prepare($connection, $query)) { //előkészítés
        //mysqli_stmt_bind_param($statment, "ii", $offset, $size); // itt kerül behelyettesítésre a kérdőjelek helyére a változó ii- integer and integer
        mysqli_stmt_execute($statment); //végrehajtás
        $result = mysqli_stmt_get_result($statment);
        //eredménymegszerzés
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    } 
    else {
        logMessage("ERROR", 'Query error: ' . mysqli_error($connection));
        errorPage();
    } 
    
}
function StatisztikaF($connection){
    //EZT MÉG ÁT KELL GONDLNOM A GECIBEEEEE
    
    
    //A jobbsávban lévő adatok statistikájának összegyűjtése
    //Kérdések száma, Válaszok száma, Tagok száma
    //Top5 legfelkapottabb kérdés
    //Top5 erre még nem válaszoltak
    //Top5 legaktívabb kérdezők
    //Top5 legaktívabb válaszolók
    //top5 új tag
    $query = "SELECT * FROM felhasznalok";
    if ($statment = mysqli_prepare($connection, $query)) { //előkészítés
        //mysqli_stmt_bind_param($statment, "ii", $offset, $size); // itt kerül behelyettesítésre a kérdőjelek helyére a változó ii- integer and integer
        mysqli_stmt_execute($statment); //végrehajtás
        $result = mysqli_stmt_get_result($statment);
        //eredménymegszerzés
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    } 
    else {
        logMessage("ERROR", 'Query error: ' . mysqli_error($connection));
        errorPage();
    } 
    
}
//balsav adatok
//jobbsav adatok
function FelhasznaloRegisztralas($connection, $email, $felhasznalonev, $jelszo){
    //ide kell az email, a felhasznalonev, a jelszo és a regisztrálás dátuma
    //időzóna meg a nyelv, elvileg nincs átállítva
    $titkosjelszo = password_hash($jelszo, PASSWORD_BCRYPT);
    $query = "INSERT INTO felhasznalok (email, felhasznalonev, jelszo, regdatum)
    VALUES (?, ?, ?, ?)";
    $regdatum = date("Y-m-d H:i:s");
    //$query = "UPDATE photos set title = ? WHERE id = ?";
    if ($statment = mysqli_prepare($connection, $query)) {
        mysqli_stmt_bind_param($statment, "ssss", $email, $felhasznalonev, $titkosjelszo, $regdatum); //bind-hozzákötés "i"-integer 
        mysqli_stmt_execute($statment); 
        
    } else {
        logMessage("ERROR", 'Query error: ' . mysqli_error($connection));
        errorPage();
    } 
   
}
function RegisztracioEllenorzes($connection, $email, $felhasznalonev){
    //Ellenőrzi, hogy van-e ilyen felhasználó már
    //Ha van, akkor vissza adja a számát, és ezért egy while ciklussal csinálom,
    //hogy ne fusson tovább feleslegesen
    $query = "SELECT * FROM felhasznalok WHERE email = ? OR felhasznalonev = ?";
    if ($statment = mysqli_prepare($connection, $query)) { //előkészítés
        mysqli_stmt_bind_param($statment, "ss", $email, $felhasznalonev); // itt kerül behelyettesítésre a kérdőjelek helyére a változó ii- integer and integer
        mysqli_stmt_execute($statment); //végrehajtás
        $result = mysqli_stmt_get_result($statment); //eredménymegszerzés
        $talalat =  mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        logMessage("ERROR", 'Query error: ' . mysqli_error($connection));
        errorPage();
    } 
    $szam = 0;
    foreach($talalat as $tal){$szam++; }
    return $szam;
}
function FelhasznaloBeleptetes()
{
    //Adok itt neki Cookie-t
    
}
function BelepesEllenorzes($connection, $felhasznalonev, $jelszo){
    //itt ellenőrzöm ezt a faszomat
    //Ellenőrzi, hogy van-e ilyen felhasználó már
    //Ha van, akkor vissza adja a számát, és ezért egy while ciklussal csinálom,
    //hogy ne fusson tovább feleslegesen
    
    $query = "SELECT * FROM felhasznalok WHERE  felhasznalonev = ?";
    if ($statment = mysqli_prepare($connection, $query)) { //előkészítés
        mysqli_stmt_bind_param($statment, "s", $felhasznalonev); // itt kerül behelyettesítésre a kérdőjelek helyére a változó ii- integer and integer
        mysqli_stmt_execute($statment); //végrehajtás
        $result = mysqli_stmt_get_result($statment); //eredménymegszerzés
        $talalat =  mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        logMessage("ERROR", 'Query error: ' . mysqli_error($connection));
        errorPage();
    } 
    $szam = 0;
    foreach($talalat as $tal){if(password_verify($jelszo, $tal["jelszo"])){return $tal;}else{return "";} }
    
}
function adatLeKeres($connection, $parameter_id){
    //Egy faszom SELECT-et ide a picsába beilleszteni
    //na itt visszaadom az id-t
    //A kérdés címét
    //A kérdés szövegét
    //A kérdés dátumát
    //A felhasználót is, aki feltette
    $query = "SELECT * FROM kerdesek WHERE id = ?";
    if ($statment = mysqli_prepare($connection, $query)) { //előkészítés
        mysqli_stmt_bind_param($statment, "i", $parameter_id); // itt kerül behelyettesítésre a kérdőjelek helyére a változó ii- integer and integer
        mysqli_stmt_execute($statment); //végrehajtás
        $result = mysqli_stmt_get_result($statment); //eredménymegszerzés
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        logMessage("ERROR", 'Query error: ' . mysqli_error($connection));
        errorPage();
    } 
}
function StatVanMa(){
/*
$tomb=array("a"=>"red","b"=>"green");
array_push($tomb,"blue"=>"","yellow"=>"");
*/

$connection = getConnection();
$statisztikaK = StatisztikaK($connection);
$statisztikaV = StatisztikaV($connection);
$statisztikaF = StatisztikaF($connection);
$szamolKerdes = 0;
$szamolValasz = 0;
$szamolFelhasznalo = 0;

foreach ($statisztikaK as $szam){
$szamolKerdes++;
}
foreach ($statisztikaV as $szam){
$szamolValasz++;
}
foreach ($statisztikaF as $szam){
$szamolFelhasznalo++;
}
//Legfelkapottabb kerdesek
//Erre még nem válaszoltak
//Top5 legaktívabb kérdező
//TOP5 legaktívabb válaszolók
//Ezt még nem tudom, hogy hogyan oldom meg
$veletlenSzam = rand(1, $szamolKerdes);
$tomb=array(
    "szamolKerdes"=>$szamolKerdes, 
    "szamolValasz"=>$szamolValasz,
    "szamolFelhasznalo"=>$szamolFelhasznalo,
    "veletlenSzam"=>$veletlenSzam
);   
return $tomb;
}
function RangMegKap($felhasznalonev, $jelszo){
$connection = getConnection();
//Itt megnézem, hogy az adott felhasználó, az adott jelszóval
//A rang táblában milyen Értéket ad vissza
//Ahj, hát ez nem lesz olyan nagyon egyszerű
}
function RangVisszaAdd($connection, $id){
    
    //itt id kéne nekem, meg connection. Semmi más.
    //És visszaértékből meg a rangoknál a megnevezést kell majd
    //Keresés a felhasznalo_rang-ban, és ott elkérem a rang_id-t és
    //és utána a rang-ból a megnevezes-t írom ki
    $query = "SELECT * FROM felhasznalo_rang WHERE felh_id = ?";
    if ($statment = mysqli_prepare($connection, $query)) { //előkészítés
        mysqli_stmt_bind_param($statment, "i", $id); // itt kerül behelyettesítésre a kérdőjelek helyére a változó ii- integer and integer
        mysqli_stmt_execute($statment); //végrehajtás
        $result = mysqli_stmt_get_result($statment); //eredménymegszerzés
        $talalat = mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        logMessage("ERROR", 'Query error: ' . mysqli_error($connection));
        errorPage();
    }
    //mi a faszomért nem jó ez
    
    if(isset($talalat[0]["rang_id"])){
    $rangid = $talalat[0]["rang_id"];
    $query2 = "SELECT * FROM rangok WHERE id = ?";
    if ($statment2 = mysqli_prepare($connection, $query2)) { //előkészítés
        mysqli_stmt_bind_param($statment2, "i", $rangid); // itt kerül behelyettesítésre a kérdőjelek helyére a változó ii- integer and integer
        mysqli_stmt_execute($statment2); //végrehajtás
        $result2 = mysqli_stmt_get_result($statment2); //eredménymegszerzés
        return mysqli_fetch_all($result2, MYSQLI_ASSOC);
    } else {
        logMessage("ERROR", 'Query error: ' . mysqli_error($connection));
        errorPage();
    }}
    
}
function MindenkiBalsav(){
return '<li class="list-group-item d-flex justify-content-between align-items-center">
<a href="/profil">Kérdések</a>
<span class="badge badge-primary badge-pill">12</span>
</li>
<li class="list-group-item d-flex justify-content-between align-items-center">
<a href="/profil">Tagok</a>
<span class="badge badge-primary badge-pill">12</span>
</li>
<li class="list-group-item d-flex justify-content-between align-items-center">
<a href="/profil">Címkék</a>
<span class="badge badge-primary badge-pill">12</span>
</li>
';
}