

<?php foreach ($kerdeshezTartozo as $kerdes):?>
<div class="egybe">
<div class="card">
<div class="card-body">
<h5><?=$kerdes['kerdesrov']?></h5>
<?=$kerdes['akerdes']?>
<br><b>Kérdező: <div class="osszesitett" id="felhasznalo"><?=FelhasznaloAdat("id",FelhasznaloKerdes("kerdes",$kerdes["id"])[0]["felh_id"])[0]["felhasznalonev"]?></div></b>
<br>
<?php $kapcimke = KerdesCimke($kerdes['id']); 
                        foreach($kapcimke as $cimke){
                          $megkCimke = KapCimke($cimke['cimke_id']);
                          echo '<div class="osszesitett" id="cimke"><a href="/cimke/'. $megkCimke[0]['megnevezes'] .'">#' . $megkCimke[0]['megnevezes'] . '</a></div>';
                          // <?=$megkCimke[0]['megnevezes']</div>
                        }
                  ?>
<div class="osszesitett float-right" id="valaszok">Válaszok: <?=ValaszSzam($kerdes['id'])?></div><div class="osszesitett float-right" id="latta">Látta: <?=count(KerdesLatta("kerdes",$kerdes["id"]))?></div>
</div>
<?php 
if(isset($_COOKIE["felhasznalonev"])){
    $felhID = FelhasznaloAdat("felhasznalonev", $_COOKIE["felhasznalonev"])[0]["id"];
    MostLattaAKerdestAFelhasznalo($kerdes['id'],$felhID);
}
?>
    <!--Na ez egy válasz a kérdésre
    //A kérdező is tudja értékelni, de csak egyszer
    //Más emberek is tudják értékelni, de ő nem
    //A kérdezőnek az értékelése, valamennyivel többet ér-->
<form action="/valaszelkuld" method="post">
    <div class="form-group" style="padding:5px;">
      <textarea name="valasz" class="form-control col-sm-15" rows="4" id="comment" placeholder="Van egy megoldásod erre a kérdésre? Ne habozz! Válaszolj!"></textarea>
      <input type="hidden" name="kerdes_id" id="kerdes_id" value="<?=$kerdes['id']?>">
      <input type="hidden" name="valaszolo_id" id="valaszolo_id" value="<?=$felhID?>">
      <button class="btn btn-primary float-right" type="submit" style="margin-top: 5px;" id="valaszgomb">Küldés</button>
    </div>
  </form>
<div class="card-body">
<?php 

$KerdeshezValasz = KerdeshezValasz($kerdes['id']);
if(count($KerdeshezValasz)<1)echo "Jelenleg nincs még válasz ehhez a kérdéshez."; 
foreach($KerdeshezValasz as $valasz):
    //itt ezt a részt, még alakítani kell még
 $v = ValaszIDhezAdat($valasz['valasz_id']); 
  foreach($v as $v2):
    ?>
  <!-- 
    div.kerdesvalasz
    div.kvbal
    //itt lesz a válasz rész
    div.kvjobb
    //itt lesz az értékelés rész
  -->
  <div id="kerdesvalasz">
    <div id="kvbal">
      <?=$v2["valasz"]?>
      <?php
      $ertek =  0;
      $valaszertekek = ValaszErtekeles("valasz",$valasz['valasz_id']);
      if(count($valaszertekek)>0){
      for($i=0;$i<count($valaszertekek);$i++){
            $ertek += ErtekelesAdat("id",$valaszertekek[$i]["ertekeles_id"])[0]["ertekeles"];
      }
      }
      ?>
       <br> 
        
       <div class="osszesitett" id="felhasznalo"><?=FelhasznaloAdat("id",FelhasznaloValasz("valasz",$v2["id"])[0]["felh_id"])[0]["felhasznalonev"]?></div>
       <div class="osszesitett" id="datum"><?=$v2["vdatum"]?></div>
       <div class="osszesitett" style="font-size:12px;">Ez a válasz 90%ban hasznos</div>
       </div>
       <div id="kvjobb" >
       <form action="/ertekeles" method="post">
       <input type="submit" class="osszesitett" name="hvnh" id="hasznos" value="Hasznos">
       <br>
       <div class="osszesitett" id="ertekelesszam"><?=$ertek?></div>
       <br> 
       <input type="submit" class="osszesitett" name="hvnh" id="nemhasznos" value="Nem Hasznos">
       <input type="hidden" name="valasz_id" value="<?=$v2['id']?>">
       <input type="hidden" name="felh_id" value="<?=FelhasznaloAdat("felhasznalonev", $_COOKIE["felhasznalonev"])[0]["id"]?>">
       </form>
       </div>
       </div>
        <?php
      endforeach; //$v as $v2
  endforeach; //$KerdeshezValasz as $valasz
?>
</div>
</div>
</div>
<?php endforeach ?> 
