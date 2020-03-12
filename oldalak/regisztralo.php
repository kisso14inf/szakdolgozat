<?php
/**
 * Ha nincs ilyen felhasználó, akkor tovább enged, ha nem, akkor ...
 * visszaküld a regisztráció.php-ba
 * és Hibás adattal jön elő, ha jó
 * akkor belepes.php-ba megy, és kiíra, hogy Jó volt a regisztráció, te fiú
 */

if(RegisztracioEllenorzes($connection, $email, $felhasznalonev) == 0){
FelhasznaloRegisztralas($connection, $email, $felhasznalonev, $jelszo);
?>
<div class="egybe">
<div class="card">
<div class="card-body">

Sikeres Regisztráció!
<a href="/belepes">Bejelentkezés</a>
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
 Sikertelen Regisztráció!
 (Van már ilyen email vagy felhasználónév) <br>
 <a href="/regisztracio"><b> Vissza a Regisztrációhoz!</b></a>
 </div>
 </div>
 </div>
 <?php
//location Regisztracio.php
//de oda ki kéne valamit írnia....
}
?>