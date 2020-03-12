<?php 
$url = "$_SERVER[REQUEST_URI]";
if($url == "/belepteto"){
   if(isset(BelepesEllenorzes($connection, $felhasznalonev, $jelszo)["felhasznalonev"])){
   $felhasznalonev1 = BelepesEllenorzes($connection, $felhasznalonev, $jelszo)["felhasznalonev"];
   
   if(isset(BelepesEllenorzes($connection, $felhasznalonev, $jelszo)["jelszo"])){
   $jelszo1 = BelepesEllenorzes($connection, $felhasznalonev, $jelszo)["jelszo"];
   
   //itt valahogy a rangot is ki kéne nyerni
   if(isset(BelepesEllenorzes($connection, $felhasznalonev, $jelszo)["id"])){
   $id1 = BelepesEllenorzes($connection, $felhasznalonev, $jelszo)["id"];
   $rang1 = RangVisszaAdd($connection, $id1)[0]["megnevezes"];
   setcookie("rang", $rang1, time()+36);
   setcookie("felhasznalonev", $felhasznalonev1, time()+36);
   setcookie("jelszo", $jelszo1, time()+36);
    }}}
   //Itt hibát ír ki, ha nincs ilyen felhasználó vagy jelszó
  
   
}
//eddig minden szipi szuper, így közös a cél
$proba = "Látogató";
if(isset($_COOKIE["felhasznalonev"]) && isset($_COOKIE["jelszo"])) $proba = $_COOKIE["rang"];
//Azt amúgy meg kéne csinálni, hogy ha az Adott illető nem
//Mindenki, hanem egy feljebb lévő akárki, akkor ne tudja elérni a /belepes-t és A /regisztracio-t
class Mindenki {
	//private $balsav1 = MindenkiBalsav();
	//balsav osztaly
    //Mindenki rész tartalmazza:
    //Ezt leegyszerűsítem, és ennyi lesz most mára
    //Hát ez most nem ment, majd holnap
    /*private $balsavTomb = 
        array("Kérdések" => "/kerdesek",
              "Tagok"=>"/tagok",
              "Címkék"=>"/cimkek"
             );*/
    /*private $balsav1 = '';
    
     for($i = 0;$i<5;$i++)
    {
        $balsav1+='<li class="list-group-item d-flex justify-content-between align-items-center">
        <a href="Buzi">Kérdések</a>
        <span class="badge badge-primary badge-pill">12</span>
        </li>';
    }*/
       
    private $balsav1 = '<li class="list-group-item d-flex justify-content-between align-items-center">
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
    //Ezeket, majd le akarom egyszerűsíteni
	private $balsav2 = '<li class="list-group-item d-flex justify-content-between align-items-center">
    <a href="/profil">Profil</a>
    <span class="badge badge-primary badge-pill">12</span>
    </li>
    <li class="list-group-item d-flex justify-content-between align-items-center">
    <a href="/profil">Értesítések</a>
    <span class="badge badge-primary badge-pill">12</span>
    </li> 
    <li class="list-group-item d-flex justify-content-between align-items-center">
    <a href="/profil">Kérdéseim</a>
    <span class="badge badge-primary badge-pill">12</span>
    </li> 
    <li class="list-group-item d-flex justify-content-between align-items-center">
    <a href="/profil">Válaszaim</a>
    <span class="badge badge-primary badge-pill">12</span>
    </li>
    <li class="list-group-item d-flex justify-content-between align-items-center">
    <a href="/ujkerdes">Új Kérdés</a>
    <span class="badge badge-primary badge-pill">12</span>
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
//ezeket leegyszerűsítem, majd kicsit hanyagolom az oop-t
//annyira amúgy nem nehéz
class Admin extends Tag
{
    
    private $balsav3 = '<li class="list-group-item d-flex justify-content-between align-items-center">
    <a href="/profil">Profil</a>
    <span class="badge badge-primary badge-pill">14</span>
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
//Mindenki BALSÁV
/* Kérdések, Tagok, Címkék */
//Tag BALSÁV
/* Profil, Értesítések, Kérdéseim, Válaszaim, Új kérdés */
//Admin BALSÁV
/* MINDENKI -> Kérdések, Tagok, Címkék */
/* TAG -> Profil, Értesítések, Kérdéseim, Válaszaim, Új kérdés */

?>