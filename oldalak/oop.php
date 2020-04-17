<?php 
$url = "$_SERVER[REQUEST_URI]";

if($url == "/belepteto"){
   if(isset(BelepesEllenorzes($connection, $felhasznalonev, $jelszo)["felhasznalonev"])){
   $felhasznalonev1 = BelepesEllenorzes($connection, $felhasznalonev, $jelszo)["felhasznalonev"];
   
   if(isset(BelepesEllenorzes($connection, $felhasznalonev, $jelszo)["jelszo"])){
   $jelszo1 = BelepesEllenorzes($connection, $felhasznalonev, $jelszo)["jelszo"];
   
   //
   if(isset(BelepesEllenorzes($connection, $felhasznalonev, $jelszo)["id"])){
   $id1 = BelepesEllenorzes($connection, $felhasznalonev, $jelszo)["id"];
   $rang1 = RangVisszaAdd($connection, $id1)[0]["megnevezes"];
   setcookie("rang", $rang1, time()+3600);
   setcookie("felhasznalonev", $felhasznalonev1, time()+3600);
   setcookie("jelszo", $jelszo1, time()+3600);

    }}}
}
elseif($url == "/kijelentkezes"){
    if(isset($_COOKIE["rang"])){$rang1 = $_COOKIE["rang"];
    if(isset($_COOKIE["felhasznalonev"])){$felhasznalonev1 = $_COOKIE["felhasznalonev"];
    if(isset($_COOKIE["jelszo"])){$jelszo1 = $_COOKIE["jelszo"];
    setcookie("rang", $rang1, time()-3600);
    setcookie("felhasznalonev", $felhasznalonev1, time()-3600);
    setcookie("jelszo", $jelszo1, time()-3600);
    }}}
    header( "Refresh:1.5; url=/", true, 303);
    
}
elseif($url == "/profil"){
    if(isset($_COOKIE["felhasznalonev"]))
    header( "Refresh:0; url=/profil/{$_COOKIE['felhasznalonev']}", true, 303);
}
$proba = "Látogató";
if(isset($_COOKIE["felhasznalonev"]) && isset($_COOKIE["jelszo"])) $proba = $_COOKIE["rang"];
class Mindenki {
    private $balsav1 = '<li class="list-group-item d-flex justify-content-between align-items-center">
    <a href="/kereses/_/Friss">Kérdések</a>
    <span class="badge badge-primary badge-pill">K</span>
    </li>
    <li class="list-group-item d-flex justify-content-between align-items-center">
    <a href="/tagok">Tagok</a>
    <span class="badge badge-primary badge-pill">T</span>
    </li>
    <li class="list-group-item d-flex justify-content-between align-items-center">
    <a href="/cimke/Összes">Címkék</a>
    <span class="badge badge-primary badge-pill">C</span>
    </li>
    ';
    private $sav = "";
	public function setBalsav1($balsav1) {
		$this->balsav1 = $balsav1;
       
	}
	public function getBalsav1() {
		return $this->balsav1;
    }
    
    private $menusav1 = '<a href="/belepes"><button type="button" class="btn btn-outline-secondary">Belépés</button></a>';
    public function setMenusav1($menusav1) {
		$this->menusav1 = $menusav1;
       
	}
    public function getMenusav1() {
		return $this->menusav1;
	}
    //private menusav2... ha Mindenki, akkor Belépés
}
class Latogato extends Mindenki{}
//Mindenki, Tag, Admin
//child class
class Tag extends Mindenki {
	private $balsav2 = '<li class="list-group-item d-flex justify-content-between align-items-center">
    <a href="/profil">Profil</a>
    <span class="badge badge-primary badge-pill">P</span>
    </li>
    <li class="list-group-item d-flex justify-content-between align-items-center">
    <a href="/ertesitesek">Értesítések</a>
    <span class="badge badge-primary badge-pill">É</span>
    </li> 
    <li class="list-group-item d-flex justify-content-between align-items-center">
    <a href="/kerdeseim">Kérdéseim</a>
    <span class="badge badge-primary badge-pill">K</span>
    </li> 
    <li class="list-group-item d-flex justify-content-between align-items-center">
    <a href="/valaszaim">Válaszaim</a>
    <span class="badge badge-primary badge-pill">V</span>
    </li>
    <li class="list-group-item d-flex justify-content-between align-items-center">
    <a href="/ujkerdes">Új Kérdés</a>
    <span class="badge badge-primary badge-pill">+</span>
    </li>
    ';
	public function setBalsav2($balsav2) {
		$this->balsav2 = $balsav2;
	}
	public function getBalsav2() {
		return $this->balsav2;
	}
     private $menusav2 = '<a href="/kijelentkezes"><button type="button" class="btn btn-outline-secondary">Kijelentkezés</button></a>';
    public function setMenusav2($menusav2) {
		$this->menusav2 = $menusav2;
       
	}
    public function getMenusav2() {
		return $this->menusav2;
	}
    //private menusav2... Ha tag, akkor Kilépés lesz helyette
}
//Ennek, nem tudom még, hogy milyen plusz funkciói lesznek, majd kiderül
class Admin extends Tag
{
    
    private $balsav3 = '<li class="list-group-item d-flex justify-content-between align-items-center">
    <a href="/cimkehozzaadd">Címkék Hozzáadása</a>
    <span class="badge badge-primary badge-pill">CH</span>
    </li><br>';
	public function setBalsav3($balsav3) {
		$this->balsav3 = $balsav3;
	}
	public function getBalsav3() {
		return $this->balsav3;
	}
    
}
//Ha Mindenki
if($proba=="Látogató"){
$obj = new Latogato();
$balsav = array($obj->getBalsav1());
$menusav = array($obj->getMenusav1());
}
//Ha Tag
if($proba=="Tag"){
$obj = new Tag();
$balsav = array($obj->getBalsav2());
$menusav = array($obj->getMenusav2());
}
//Ha Admin
if($proba=="Admin"){
$obj = new Admin();
$balsav = array($obj->getBalsav2(), $obj->getBalsav3());
$menusav = array($obj->getMenusav2());
}
?>