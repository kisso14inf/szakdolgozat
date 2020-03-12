<?php
/**
 * Ha nincs ilyen felhasználó, akkor tovább enged, ha nem, akkor ...
 * visszaküld a regisztráció.php-ba
 * és Hibás adattal jön elő, ha jó
 * akkor belepes.php-ba megy, és kiíra, hogy Jó volt a regisztráció, te fiú
 */

//$talalat = BelepesEllenorzes($connection, $felhasznalonev, $jelszo)




//echo $talalat["felhasznalonev"];
//foreach($talalat as $talalat1){$felhasznalonev = $talalat1["felhasznalonev"];}
if((BelepesEllenorzes($connection, $felhasznalonev, $jelszo)) != null){
   
?>
<div class="egybe">
<div class="card">
<div class="card-body">

Sikeres Bejelentkezés!
<!-- Itt megkéne adni egy függvényt, vagy mi a 
Faszomat ami, cookie-t ad ennek a mocsoknak.
-->
</div>
</div>
</div>
<?php
//location Belépés.php
}
else
{
 ?>
 <div class="egybe">
 <div class="card">
 <div class="card-body">
 Sikertelen Bejelentkezés!
 (Nincs ilyen felhasznélónév és jelszó páros) <br>
 <a href="/belepes"><b> Vissza a Bejelentkezéshez!</b></a>
 </div>
 </div>
 </div>
 <?php
//location Regisztracio.php
//de oda ki kéne valamit írnia....
}
?>