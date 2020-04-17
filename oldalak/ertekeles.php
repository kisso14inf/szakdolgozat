<div class="egybe">
<?php
    $hvnh = $_POST['hvnh'];
    $valasz_id = $_POST['valasz_id'];
    $felh_id = $_POST['felh_id'];
    if($hvnh == "Hasznos")$ertekelesSzam = 1;
    if($hvnh == "Nem Hasznos") $ertekelesSzam = -1;
    $felhasznaloertekelesek = FelhasznaloErtekeles("felhasznalo",$felh_id);
    $ertekelesID = 0;
    foreach($felhasznaloertekelesek as $felhasznaloertekeles){
        //itt kikérem a ertekeles id-t.
        $valaszertekelesek = ValaszErtekeles("ertekeles", $felhasznaloertekeles["ertekeles_id"]);
        if(count($valaszertekelesek)>0){
            foreach($valaszertekelesek as $valaszertekeles){
                if($valaszertekeles["valasz_id"]==$valasz_id){
                    $ertekelesID = $valaszertekeles["ertekeles_id"];
                }
            }
        }
    }
    if($ertekelesID == 0){
      //itt akkor insert lesz
      ValasztErtekel("Beilleszt", $felh_id, $valasz_id, $ertekelesSzam);
    }
    else{
        //itt megnézem az ertekelesID-hoz kapcsolódó ertekeles-t
        if($ertekelesSzam != ErtekelesAdat("id",$ertekelesID)[0]["ertekeles"]){
            //ha nem egyenlő, akkor UPDATE
            ValasztErtekel("Frissít", $felh_id, $valasz_id, $ertekelesSzam);
        }
        elseif($ertekelesSzam == ErtekelesAdat("id",$ertekelesID)[0]["ertekeles"]){
            //ha egyenlő, akkor TÖRLÉS
            ValasztErtekel("Töröl", $felh_id, $valasz_id, $ertekelesSzam); //a hibánál, ennek a sorszámát írja ki
            
        }
    }//itt ha nincs bejelkezve,akkor belepes
    
?>
<script type="text/javascript">
setTimeout(myFunction, 500);
function myFunction() {
  alert('Sikeres értékelés. Köszönjük!');
  window.location = '/kerdes/<?=KerdesValasz("valasz",$valasz_id)[0]["kerdes_id"]?>';
}
</script>
</div>
