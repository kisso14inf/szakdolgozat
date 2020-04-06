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
function getConnection(){
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
function FooldalKerdesek($connection, $size, $offset){
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
function FelhasznaloRegisztralas($connection, $email, $felhasznalonev, $jelszo){
    //ide kell az email, a felhasznalonev, a jelszo és a regisztrálás dátuma
    //időzóna meg a nyelv, elvileg nincs átállítva
    $titkosjelszo = password_hash($jelszo, PASSWORD_BCRYPT);
    $query = "INSERT INTO felhasznalok (email, felhasznalonev, jelszo, regdatum)
    VALUES (?, ?, ?, ?)";
    $regdatum = date("Y-m-d H:i:s");
    if ($statment = mysqli_prepare($connection, $query)) {
        mysqli_stmt_bind_param($statment, "ssss", $email, $felhasznalonev, $titkosjelszo, $regdatum); //bind-hozzákötés "i"-integer 
        mysqli_stmt_execute($statment); 
        
    } else {
        logMessage("ERROR", 'Query error: ' . mysqli_error($connection));
        errorPage();
    } 
   
}
function ValaszElkuld($connection, $valasz, $kerdes_id, $valaszolo_id){
    //ide kell az email, a felhasznalonev, a jelszo és a regisztrálás dátuma
    //időzóna meg a nyelv, elvileg nincs átállítva

    $query = "INSERT INTO valaszok (valasz, vdatum)
    VALUES (?, ?)";
    $vdatum = date("Y-m-d H:i:s");
    if ($statment = mysqli_prepare($connection, $query)) {
        mysqli_stmt_bind_param($statment, "ss", $valasz, $vdatum); //bind-hozzákötés "i"-integer 
        mysqli_stmt_execute($statment); 
        
    } else {
        logMessage("ERROR", 'Query error: ' . mysqli_error($connection));
        errorPage();
    } 
    $valaszID = ValaszAdat("vdatum", $vdatum)[0]["id"];
    if($valaszID != 0){
        $query = "INSERT INTO felhasznalo_valasz (valasz_id, felh_id)
    VALUES (?, ?)";
    if ($statment = mysqli_prepare($connection, $query)) {
        mysqli_stmt_bind_param($statment, "ii", $valaszID, $valaszolo_id); //bind-hozzákötés "i"-integer 
        mysqli_stmt_execute($statment); 
        
    } else {
        logMessage("ERROR", 'Query error: ' . mysqli_error($connection));
        errorPage();
    }
    $query = "INSERT INTO kerdes_valasz (kerdes_id, valasz_id)
    VALUES (?, ?)";
    if ($statment = mysqli_prepare($connection, $query)) {
        mysqli_stmt_bind_param($statment, "ii", $kerdes_id, $valaszID); //bind-hozzákötés "i"-integer 
        mysqli_stmt_execute($statment); 
        
    } else {
        logMessage("ERROR", 'Query error: ' . mysqli_error($connection));
        errorPage();
    }
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
function VeletlenSzam(){
    $veletlenSorSzam = array_rand(KerdesAdat("",""), 1);
    $veletlenSzam = KerdesAdat("","")[$veletlenSorSzam]["id"];
    return $veletlenSzam;
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
function KerdesCimke($id){
    $connection = getConnection();
    $query = "SELECT * FROM kerdes_cimke WHERE kerdes_id = ?";
   if ($statment = mysqli_prepare($connection, $query)) { //előkészítés
       mysqli_stmt_bind_param($statment, "i", $id); // itt kerül behelyettesítésre a kérdőjelek helyére a változó ii- integer and integer
       mysqli_stmt_execute($statment); //végrehajtás
       $result = mysqli_stmt_get_result($statment); //eredménymegszerzés
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
   } else {
       logMessage("ERROR", 'Query error: ' . mysqli_error($connection));
       errorPage();
   }
   //több lesz itt a return.
   //Ezt most nem tudom, hogyan csináljam meg
   //idk why
   //ez pl. visszaadd egy tömböt, aminek 5eleme van. 1-2-3-4-5
}
function KapCimke($id){
    $connection = getConnection();
    $query = "SELECT * FROM cimkek WHERE id = ?";
       if ($statment = mysqli_prepare($connection, $query)) { //előkészítés
           mysqli_stmt_bind_param($statment, "i", $id); // itt kerül behelyettesítésre a kérdőjelek helyére a változó ii- integer and integer
           mysqli_stmt_execute($statment); //végrehajtás
           $result = mysqli_stmt_get_result($statment); //eredménymegszerzés
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
       } else {
           logMessage("ERROR", 'Query error: ' . mysqli_error($connection));
           errorPage();
       }
}
function Cimke(){
    $connection = getConnection();
    $query = "SELECT * FROM cimkek ORDER BY megnevezes";
       if ($statment = mysqli_prepare($connection, $query)) { //előkészítés
           // itt kerül behelyettesítésre a kérdőjelek helyére a változó ii- integer and integer
           mysqli_stmt_execute($statment); //végrehajtás
           $result = mysqli_stmt_get_result($statment); //eredménymegszerzés
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
       } else {
           logMessage("ERROR", 'Query error: ' . mysqli_error($connection));
           errorPage();
       }
}
function ValaszSzam($id){
 //Megszámolom a válaszokat, az adott kérdésre
 //Lehet később ezt majd máshogy fogom csinálni
 //select from kerdes_valasz where kerdes_id = $id
 //jaaaa, de ez elég is lesz, és itt megszámolom, és azt returnolom
 $connection = getConnection();
 $query = "SELECT * FROM kerdes_valasz WHERE kerdes_id = ?";
    if ($statment = mysqli_prepare($connection, $query)) { //előkészítés
        mysqli_stmt_bind_param($statment, "i", $id); // itt kerül behelyettesítésre a kérdőjelek helyére a változó ii- integer and integer
        mysqli_stmt_execute($statment); //végrehajtás
        $result = mysqli_stmt_get_result($statment); //eredménymegszerzés
        $valaszok = mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        logMessage("ERROR", 'Query error: ' . mysqli_error($connection));
        errorPage();
    }
    $szamol = 0;
    foreach ($valaszok as $valasz) {$szamol++;}
    return $szamol;
}
function KerdeshezValasz($id){
    $connection = getConnection();
    $query = "SELECT * FROM kerdes_valasz WHERE kerdes_id = ?";
       if ($statment = mysqli_prepare($connection, $query)) { //előkészítés
           mysqli_stmt_bind_param($statment, "i", $id); // itt kerül behelyettesítésre a kérdőjelek helyére a változó ii- integer and integer
           mysqli_stmt_execute($statment); //végrehajtás
           $result = mysqli_stmt_get_result($statment); //eredménymegszerzés
           return mysqli_fetch_all($result, MYSQLI_ASSOC);
       } else {
           logMessage("ERROR", 'Query error: ' . mysqli_error($connection));
           errorPage();
       }
}
function ValaszIDhezAdat($id){
    $connection = getConnection();
    $query = "SELECT * FROM valaszok WHERE id = ?";
       if ($statment = mysqli_prepare($connection, $query)) { //előkészítés
           mysqli_stmt_bind_param($statment, "i", $id); // itt kerül behelyettesítésre a kérdőjelek helyére a változó ii- integer and integer
           mysqli_stmt_execute($statment); //végrehajtás
           $result = mysqli_stmt_get_result($statment); //eredménymegszerzés
           return mysqli_fetch_all($result, MYSQLI_ASSOC);
       } else {
           logMessage("ERROR", 'Query error: ' . mysqli_error($connection));
           errorPage();
       }
}

function UjKerdesElkuld($kerdesrov, $akerdes, $felh_id, $cimkek){
    //A "kerdesek"-be bele kell tenni:
    //kerdesrov, akerdes, datum
    //A "felhasznalo_kerdes"-be bele kell tenni:
    //kerdes_id, felhasznalo_id
    //A "kerdes_cimke"-be bele kell tenni:
    //kerdes_id, cimke_id
    //EZ IS KICSIT NEHÉZKES LESZ
    //LEHET ARRAY-VEL KÖNNYEBB LESZ
    $connection = getConnection();
    $query = "INSERT INTO kerdesek (kerdesrov, akerdes, datum)
    VALUES (?, ?, ?)";
    $datum = date("Y-m-d H:i:s");
    if ($statment = mysqli_prepare($connection, $query)) {
        mysqli_stmt_bind_param($statment, "sss", $kerdesrov, $akerdes, $datum); //bind-hozzákötés "i"-integer 
        mysqli_stmt_execute($statment);  
    } else {
        logMessage("ERROR", 'Query error: ' . mysqli_error($connection));
        errorPage();
    } 
    $kerdesek = KerdesAdat("","");
    $kerdesID = 0;
    $cimkekIDKer = CimkeAdat("","");
    $cimkekID = array();
    foreach($cimkekIDKer as $cimke){
       for($i=0;$i<5;$i++){
        if($cimke["megnevezes"] == $cimkek[$i]){
            array_push($cimkekID, $cimke["id"]);
        
        }
    }
    }
    //Megkapom itt a Kérdésnek az ID-ját, amit az előbb be INSERT-eltem
    foreach($kerdesek as $kerdes){
        if($kerdes["datum"] == $datum){ $kerdesID = $kerdes["id"];}
    }
    //Itt most nem tudom, hogy mi legyen
    //Nem a VALUE-t kéne POST-olnom, hanem az ID-ját
    //és ezt egy for ciklusba beteszem
    //majd egy IF-et beljebb, hogy kiszűrje, ha nincs értéke a küldött értéknek
    if($kerdesID != 0){
        for($i=0;$i<count($cimkekID);$i++){
        $query = "INSERT INTO kerdes_cimke (kerdes_id, cimke_id)
    VALUES (?, ?)";
    echo  $cimkekID[$i];
    if ($statment = mysqli_prepare($connection, $query)) {
        mysqli_stmt_bind_param($statment, "ii", $kerdesID, $cimkekID[$i]); //bind-hozzákötés "i"-integer 
        mysqli_stmt_execute($statment); 
        
    } else {
        logMessage("ERROR", 'Query error: ' . mysqli_error($connection));
        errorPage();
    }
    }
    //Itt összekötöm a felhasználót és a kérdést
    $query = "INSERT INTO felhasznalo_kerdes (kerdes_id, felh_id)
    VALUES (?, ?)";
    if ($statment = mysqli_prepare($connection, $query)) {
        mysqli_stmt_bind_param($statment, "ii", $kerdesID, $felh_id); //bind-hozzákötés "i"-integer 
        mysqli_stmt_execute($statment); 
        
    } else {
        logMessage("ERROR", 'Query error: ' . mysqli_error($connection));
        errorPage();
    }
    }
} 

//mindegyik adatbázis táblához kellene egy FUNCTION-t csinálni.
//És akkor külön azt is bekérni, hogy mi alapján kérek , vagy ha van bejövő érték, és mi, akkor azt adja vissza.
/**
 *  function Felhasznalok($mit, $mi){
 *   //$mi -> Egy feltétel, amihez csatlakozó adatokat SELECTelem.
 *   //$mit -> 
 *  }
 * 
 * 
 */

function MostLattaAKerdestAFelhasznalo($kerdes_id,$felhasznalo_id){
    $connection = getConnection();
    $query = "INSERT INTO lattak (datum)
    VALUES (?)";
    $datum = date("Y-m-d H:i:s");
    if ($statment = mysqli_prepare($connection, $query)) {
        mysqli_stmt_bind_param($statment, "s",$datum); //bind-hozzákötés "i"-integer 
        mysqli_stmt_execute($statment);  
    } else {
        logMessage("ERROR", 'Query error: ' . mysqli_error($connection));
        errorPage();
    }
    //itt ki kell keresni azt a Lattak sort, amelyiknek a $datum a dátuma
    $lattaID = LattaAdat("datum", $datum)[0]["id"]; 
    
    if($lattaID != 0){
        //itt a felhasznalo_latta táblába rakom bele a cuccost
        $query = "INSERT INTO felhasznalo_latta (latta_id, felh_id)
        VALUES (?, ?)";
            if ($statment = mysqli_prepare($connection, $query)) {
                mysqli_stmt_bind_param($statment, "ii", $lattaID, $felhasznalo_id); //bind-hozzákötés "i"-integer 
                mysqli_stmt_execute($statment); 
        
            } else {
                    logMessage("ERROR", 'Query error: ' . mysqli_error($connection));
                    errorPage();
                    }
    
    //itt meg a kerdes_latta táblába rakom bele a cuccost.
    $query = "INSERT INTO kerdes_latta (latta_id, kerdes_id)
    VALUES (?, ?)";
    if ($statment = mysqli_prepare($connection, $query)) {
        mysqli_stmt_bind_param($statment, "ii", $lattaID, $kerdes_id); //bind-hozzákötés "i"-integer 
        mysqli_stmt_execute($statment); 
        
    } else {
        logMessage("ERROR", 'Query error: ' . mysqli_error($connection));
        errorPage();
    }
    }
}
function FelhasznaloKerdes($mit, $mi){
    //$mit -> MI ALAPJÁN LEGYEN A WHERE
    //$mi -> Mi az érték
    $connection = getConnection();
    if($mit == "felhasznalo")
    $query = "SELECT * FROM felhasznalo_kerdes WHERE felh_id = ?";
    if($mit == "kerdes")
    $query = "SELECT * FROM felhasznalo_kerdes WHERE kerdes_id = ?";
    if($mit == "")
    $query = "SELECT * FROM felhasznalo_kerdes";
       if ($statment = mysqli_prepare($connection, $query)) { //előkészítés
            if($mit != "" && $mi != "")mysqli_stmt_bind_param($statment, "i", $mi);   
            mysqli_stmt_execute($statment); //végrehajtás
           $result = mysqli_stmt_get_result($statment); //eredménymegszerzés
           return mysqli_fetch_all($result, MYSQLI_ASSOC);
       } else {
           logMessage("ERROR", 'Query error: ' . mysqli_error($connection));
           errorPage();
       }
}
function FelhasznaloValasz($mit, $mi){
    //$mit -> MI ALAPJÁN LEGYEN A WHERE
    //$mi -> Mi az érték
    $connection = getConnection();
    if($mit == "felhasznalo")
    $query = "SELECT * FROM felhasznalo_valasz WHERE felh_id = ?";
    if($mit == "valasz")
    $query = "SELECT * FROM felhasznalo_valasz WHERE valasz_id = ?";
    if($mit == "")
    $query = "SELECT * FROM felhasznalo_valasz";
       if ($statment = mysqli_prepare($connection, $query)) { //előkészítés
            if($mit != "" && $mi != "")mysqli_stmt_bind_param($statment, "i", $mi);   
            mysqli_stmt_execute($statment); //végrehajtás
           $result = mysqli_stmt_get_result($statment); //eredménymegszerzés
           return mysqli_fetch_all($result, MYSQLI_ASSOC);
       } else {
           logMessage("ERROR", 'Query error: ' . mysqli_error($connection));
           errorPage();
       }
}
function KerdesValasz($mit, $mi){
    $connection = getConnection();
    if($mit == "kerdes")
    $query = "SELECT * FROM kerdes_valasz WHERE kerdes_id = ?";
    if($mit == "valasz")
    $query = "SELECT * FROM kerdes_valasz WHERE valasz_id = ?";
    if($mit == "")
    $query = "SELECT * FROM kerdes_valasz";
       if ($statment = mysqli_prepare($connection, $query)) { //előkészítés
            if($mit != "" && $mi != "")mysqli_stmt_bind_param($statment, "i", $mi);   
            mysqli_stmt_execute($statment); //végrehajtás
           $result = mysqli_stmt_get_result($statment); //eredménymegszerzés
           return mysqli_fetch_all($result, MYSQLI_ASSOC);
       } else {
           logMessage("ERROR", 'Query error: ' . mysqli_error($connection));
           errorPage();
       } 
}
function FelhasznaloLatta($mit,$mi){
    $connection = getConnection();
    if($mit == "felhasznalo")
    $query = "SELECT * FROM felhasznalo_latta WHERE felhasznalo_id = ?";
    if($mit == "latta")
    $query = "SELECT * FROM felhasznalo_latta WHERE latta_id = ?";
    if($mit == "")
    $query = "SELECT * FROM felhasznalo_latta";
       if ($statment = mysqli_prepare($connection, $query)) { //előkészítés
            if($mit != "" && $mi != "")mysqli_stmt_bind_param($statment, "i", $mi);   
            mysqli_stmt_execute($statment); //végrehajtás
           $result = mysqli_stmt_get_result($statment); //eredménymegszerzés
           return mysqli_fetch_all($result, MYSQLI_ASSOC);
       } else {
           logMessage("ERROR", 'Query error: ' . mysqli_error($connection));
           errorPage();
       } 
}
function KerdesLatta($mit, $mi){
    $connection = getConnection();
    if($mit == "kerdes")
    $query = "SELECT * FROM kerdes_latta WHERE kerdes_id = ?";
    if($mit == "latta")
    $query = "SELECT * FROM kerdes_latta WHERE latta_id = ?";
    if($mit == "")
    $query = "SELECT * FROM kerdes_latta";
       if ($statment = mysqli_prepare($connection, $query)) { //előkészítés
            if($mit != "" && $mi != "")mysqli_stmt_bind_param($statment, "i", $mi);   
            mysqli_stmt_execute($statment); //végrehajtás
           $result = mysqli_stmt_get_result($statment); //eredménymegszerzés
           return mysqli_fetch_all($result, MYSQLI_ASSOC);
       } else {
           logMessage("ERROR", 'Query error: ' . mysqli_error($connection));
           errorPage();
       } 
}
/** function KerdesCimke($mit,$mi){0} 
 *  function FelhasznaloRang($mit,$mi){0}
*/
function ValaszErtekeles($mit,$mi){
    $connection = getConnection();
    if($mit == "valasz")
    $query = "SELECT * FROM valasz_ertekeles WHERE valasz_id = ?";
    if($mit == "ertekeles")
    $query = "SELECT * FROM valasz_ertekeles WHERE ertekeles_id = ?";
    if($mit == "")
    $query = "SELECT * FROM valasz_ertekeles";
       if ($statment = mysqli_prepare($connection, $query)) { //előkészítés
            if($mit != "" && $mi != "")mysqli_stmt_bind_param($statment, "i", $mi);   
            mysqli_stmt_execute($statment); //végrehajtás
           $result = mysqli_stmt_get_result($statment); //eredménymegszerzés
           return mysqli_fetch_all($result, MYSQLI_ASSOC);
       } else {
           logMessage("ERROR", 'Query error: ' . mysqli_error($connection));
           errorPage();
       } 
}
function FelhasznaloErtekeles($mit,$mi){
    $connection = getConnection();
    if($mit == "felhasznalo")
    $query = "SELECT * FROM felhasznalo_ertekeles WHERE felh_id = ?";
    if($mit == "ertekeles")
    $query = "SELECT * FROM felhasznalo_ertekeles WHERE ertekeles_id = ?";
    if($mit == "")
    $query = "SELECT * FROM felhasznalo_ertekeles";
       if ($statment = mysqli_prepare($connection, $query)) { //előkészítés
            if($mit != "" && $mi != "")mysqli_stmt_bind_param($statment, "i", $mi);   
            mysqli_stmt_execute($statment); //végrehajtás
           $result = mysqli_stmt_get_result($statment); //eredménymegszerzés
           return mysqli_fetch_all($result, MYSQLI_ASSOC);
       } else {
           logMessage("ERROR", 'Query error: ' . mysqli_error($connection));
           errorPage();
       } 
}
function FelhasznaloAdat($mit, $mi){
    $connection = getConnection();
    if($mit == "id")
    $query = "SELECT * FROM felhasznalok WHERE id = ?";
    if($mit == "felhasznalonev")
    $query = "SELECT * FROM felhasznalok WHERE felhasznalonev = ?";
    if($mit == "regdatum")
    $query = "SELECT * FROM felhasznalok WHERE regdatum = ?";
    if($mit == "")
    $query = "SELECT * FROM felhasznalok";
       if ($statment = mysqli_prepare($connection, $query)) { //előkészítés
            if($mit == "id")mysqli_stmt_bind_param($statment, "i", $mi);  
            if($mit == "felhasznalonev" || $mit == "regdatum")mysqli_stmt_bind_param($statment, "s", $mi);    
            mysqli_stmt_execute($statment); //végrehajtás
           $result = mysqli_stmt_get_result($statment); //eredménymegszerzés
           return mysqli_fetch_all($result, MYSQLI_ASSOC);
       } else {
           logMessage("ERROR", 'Query error: ' . mysqli_error($connection));
           errorPage();
       }
}
function KerdesAdat($mit, $mi){
    $connection = getConnection();
    if($mit == "id")
    $query = "SELECT * FROM kerdesek WHERE id = ?";
    if($mit == "kerdesrov")
    $query = "SELECT * FROM kerdesek WHERE kerdesrov = ?";
    if($mit == "akerdes")
    $query = "SELECT * FROM kerdesek WHERE akerdes = ?";
    if($mit == "datum")
    $query = "SELECT * FROM kerdesek WHERE datum = ?";
    if($mit == "")
    $query = "SELECT * FROM kerdesek";
       if ($statment = mysqli_prepare($connection, $query)) { //előkészítés
            if($mit == "id")mysqli_stmt_bind_param($statment, "i", $mi);  
            if($mit == "kerdesrov" || $mit == "akerdes" || $mit == "datum")mysqli_stmt_bind_param($statment, "s", $mi);    
            mysqli_stmt_execute($statment); //végrehajtás
           $result = mysqli_stmt_get_result($statment); //eredménymegszerzés
           return mysqli_fetch_all($result, MYSQLI_ASSOC);
       } else {
           logMessage("ERROR", 'Query error: ' . mysqli_error($connection));
           errorPage();
       }
}
function ValaszAdat($mit, $mi){
    $connection = getConnection();
    if($mit == "id")
     $query = "SELECT * FROM valaszok WHERE id = ?";
    if($mit == "valasz")
    $query = "SELECT * FROM valaszok WHERE valasz = ?";
    if($mit == "vdatum")
    $query = "SELECT * FROM valaszok WHERE vdatum = ?";
    if($mit == "")
    $query = "SELECT * FROM valaszok";
           if ($statment = mysqli_prepare($connection, $query)) { //előkészítés
                if($mit == "id")mysqli_stmt_bind_param($statment, "i", $mi);  
                if($mit == "valasz" || $mit == "vdatum")mysqli_stmt_bind_param($statment, "s", $mi);    
                mysqli_stmt_execute($statment); //végrehajtás
               $result = mysqli_stmt_get_result($statment); //eredménymegszerzés
               return mysqli_fetch_all($result, MYSQLI_ASSOC);
           } else {
               logMessage("ERROR", 'Query error: ' . mysqli_error($connection));
               errorPage();
           }
}
function LattaAdat($mit,$mi){
    $connection = getConnection();
    if($mit == "id")
     $query = "SELECT * FROM lattak WHERE id = ?";
    if($mit == "datum")
    $query = "SELECT * FROM lattak WHERE datum = ?";
    if($mit == "")
    $query = "SELECT * FROM lattak";
           if ($statment = mysqli_prepare($connection, $query)) { //előkészítés
                if($mit == "id")mysqli_stmt_bind_param($statment, "i", $mi);  
                if($mit == "datum")mysqli_stmt_bind_param($statment, "s", $mi);    
                mysqli_stmt_execute($statment); //végrehajtás
               $result = mysqli_stmt_get_result($statment); //eredménymegszerzés
               return mysqli_fetch_all($result, MYSQLI_ASSOC);
           } else {
               logMessage("ERROR", 'Query error: ' . mysqli_error($connection));
               errorPage();
           }
}
function CimkeAdat($mit,$mi){
    $connection = getConnection();
    if($mit == "id")
    $query = "SELECT * FROM cimkek WHERE id = ?";
    if($mit == "megnevezes")
    $query = "SELECT * FROM cimkek WHERE megnevezes = ?";
    if($mit == "")
    $query = "SELECT * FROM cimkek";
       if ($statment = mysqli_prepare($connection, $query)) { //előkészítés
            if($mit == "id")mysqli_stmt_bind_param($statment, "i", $mi);  
            if($mit == "megnevezes")mysqli_stmt_bind_param($statment, "s", $mi);    
            mysqli_stmt_execute($statment); //végrehajtás
           $result = mysqli_stmt_get_result($statment); //eredménymegszerzés
           return mysqli_fetch_all($result, MYSQLI_ASSOC);
       } else {
           logMessage("ERROR", 'Query error: ' . mysqli_error($connection));
           errorPage();
       }

}
function RangAdat($mit,$mi){}
function ErtekelesAdat($mit,$mi){
    $connection = getConnection();
    if($mit == "id")
    $query = "SELECT * FROM ertekelesek WHERE id = ?";
    if($mit == "ertekeles")
    $query = "SELECT * FROM ertekelesek WHERE ertekeles = ?";
    if($mit == "datum")
    $query = "SELECT * FROM ertekelesek WHERE datum = ?";
    if($mit == "")
    $query = "SELECT * FROM ertekelesek";
       if ($statment = mysqli_prepare($connection, $query)) { //előkészítés
            if($mit == "id" || $mit == "ertekeles")mysqli_stmt_bind_param($statment, "i", $mi);  
            if($mit == "datum")mysqli_stmt_bind_param($statment, "s", $mi);    
            mysqli_stmt_execute($statment); //végrehajtás
           $result = mysqli_stmt_get_result($statment); //eredménymegszerzés
           return mysqli_fetch_all($result, MYSQLI_ASSOC);
       } else {
           logMessage("ERROR", 'Query error: ' . mysqli_error($connection));
           errorPage();
           
       }
       
}
function ValasztErtekel($mit, $felh_id, $valasz_id, $ertekeles){
    $connection = getConnection();
    if($mit == "Beilleszt"){
//$felh_id, $valasz_id, $ertekeles, kell majd még egy dátum is.

    $query = "INSERT INTO ertekelesek (ertekeles, datum)
    VALUES (?, ?)";
    $datum = date("Y-m-d H:i:s");
    if ($statment = mysqli_prepare($connection, $query)) {
        mysqli_stmt_bind_param($statment, "is", $ertekeles, $datum); //bind-hozzákötés "i"-integer 
        mysqli_stmt_execute($statment);  
    } else {
        logMessage("ERROR", 'Query error: ' . mysqli_error($connection));
        errorPage();
    }
    $ertekelesID = 0;
    $ertekelesID = ErtekelesAdat("datum",$datum)[0]["id"];
    if($ertekelesID != 0){
        $query = "INSERT INTO felhasznalo_ertekeles (felh_id, ertekeles_id)
    VALUES (?, ?)";
    if ($statment = mysqli_prepare($connection, $query)) {
        mysqli_stmt_bind_param($statment, "ii", $felh_id, $ertekelesID); //bind-hozzákötés "i"-integer 
        mysqli_stmt_execute($statment); 
        
    } else {
        logMessage("ERROR", 'Query error: ' . mysqli_error($connection));
        errorPage();
    }
    $query = "INSERT INTO valasz_ertekeles (valasz_id, ertekeles_id)
    VALUES (?, ?)";
    if ($statment = mysqli_prepare($connection, $query)) {
        mysqli_stmt_bind_param($statment, "ii", $valasz_id, $ertekelesID); //bind-hozzákötés "i"-integer 
        mysqli_stmt_execute($statment);   
    } else {
        logMessage("ERROR", 'Query error: ' . mysqli_error($connection));
        errorPage();
    }
    }
}
if($mit == "Töröl"){
    
    //ezt most nem tudom, hogy kell megcsinálni
    $felhasznaloertekelesek = FelhasznaloErtekeles("felhasznalo",$felh_id);
    $ertekelesID = 0;
    foreach($felhasznaloertekelesek as $felhasznaloertekeles){
        //itt kikérem a ertekeles id-t.
        if(count(ValaszErtekeles("ertekeles", $felhasznaloertekeles["ertekeles_id"]))>0){
            $ertekelesID = $felhasznaloertekeles["ertekeles_id"];
        }
    }
    if($ertekelesID != 0){
    $query = "DELETE FROM ertekelesek WHERE id = ?";
    if ($statment = mysqli_prepare($connection, $query)) {
        mysqli_stmt_bind_param($statment, "i", $ertekelesID); //bind-hozzákötés "i"-integer 
        mysqli_stmt_execute($statment);    
    } else {
        logMessage("ERROR", 'Query error: ' . mysqli_error($connection));
        errorPage();
    } 
    } 
}
if($mit == "Frissít"){
    $felhasznaloertekelesek = FelhasznaloErtekeles("felhasznalo",$felh_id);
    $ertekelesID = 0;
    foreach($felhasznaloertekelesek as $felhasznaloertekeles){
        //itt kikérem a ertekeles id-t.
        if(count(ValaszErtekeles("ertekeles", $felhasznaloertekeles["ertekeles_id"]))>0){
            $ertekelesID = $felhasznaloertekeles["ertekeles_id"];
        }
    }
    if($ertekelesID != 0){
    $datum = date("Y-m-d H:i:s");
    $query = "UPDATE ertekelesek SET ertekeles = 1 AND datum = ? WHERE id = ?";
    if ($statment = mysqli_prepare($connection, $query)) {
       mysqli_stmt_bind_param($statment, "si", $datum, $ertekelesID); //bind-hozzákötés "i"-integer 
        mysqli_stmt_execute($statment);   
    } else {
        logMessage("ERROR", 'Query error: ' . mysqli_error($connection));
        errorPage();
    }  
}
}
}

