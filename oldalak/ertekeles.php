<?php
    $hvnh = $_POST['hvnh'];
    $valasz_id = $_POST['valasz_id'];
    $felh_id = $_POST['felh_id'];
    //$ertekelesSzam = 0;
    if($hvnh == "Hasznos")$ertekelesSzam = 1;
    if($hvnh == "Nem Hasznos") $ertekelesSzam = -1;
    $felhasznaloertekelesek = FelhasznaloErtekeles("felhasznalo",$felh_id);
    $ertekelesID = 0;
    foreach($felhasznaloertekelesek as $felhasznaloertekeles){
        //itt kikérem a ertekeles id-t.
        if(count(ValaszErtekeles("ertekeles", $felhasznaloertekeles["ertekeles_id"]))>0){
            $ertekelesID = $felhasznaloertekeles["ertekeles_id"];
        }
    }
    if($ertekelesID == 0){
      //itt akkor insert lesz
      ValasztErtekel("Beilleszt", $felh_id, $valasz_id, $ertekelesSzam);
      die();
    }
    else{
        //itt megnézem az ertekelesID-hoz kapcsolódó ertekeles-t
        if($ertekelesSzam != ErtekelesAdat("id",$ertekelesID)[0]["ertekeles"]){
            //ha nem egyenlő, akkor UPDATE
            ValasztErtekel("Frissít", $felh_id, $valasz_id, $ertekelesSzam);
            die();
        }
        elseif($ertekelesSzam == ErtekelesAdat("id",$ertekelesID)[0]["ertekeles"]){
            //ha egyenlő, akkor TÖRLÉS
            ValasztErtekel("Töröl", $felh_id, $valasz_id, $ertekelesSzam); //a hibánál, ennek a sorszámát írja ki
            die();
        }
    }
?>

