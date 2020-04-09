<div class="egybe">
<div class="card">
<div class="card-body">
<h3>Keresés</h3>
<?php
$keresendo = str_replace("_"," ",urldecode($keresendo)); 
//A kérdésröv vagy a kerdeshossz ami tartalmazhatja a kifejezést
$kerdesek = array();
$kerdesekrov = KerdesAdat("kerdesrov",$keresendo);
foreach($kerdesekrov as $kerdesrov){
    array_push($kerdesek,$kerdesrov["id"]);
}
$akerdesek = KerdesAdat("akerdes",$keresendo);
foreach($akerdesek as $akerdes){
if(!in_array($akerdes["id"],$kerdesek)){
    array_push($kerdesek,$akerdes["id"]);
}
}?>
A keresett kifejezés: "<?=$keresendo?>" (<?=count($kerdesek)?>db)
<?php
foreach($kerdesek as $kerdes){
    $kiirasok = KerdesAdat("id",$kerdes);
    foreach($kiirasok as $kiiras){?>
            <a href="/kerdes/<?=$kiiras['id']?>">
                 <div class="card-body">
                  
                 
                  <?php 
                  $kerdesrov = $kiiras['kerdesrov'];
                  if(strlen($kerdesrov)>49) echo "<b>" . substr($kerdesrov,0,47) . "...</b>";
                  else{ echo "<b>" . $kerdesrov . "</b>";}
                  ?>
                  <br>
                  <?php
                  $akerdes = $kiiras['akerdes'];
                  if(strlen($akerdes)>99) echo substr($akerdes,0,97) . "...";
                  else{ echo $akerdes;}
                  ?>
                  <br>
                  <?php $kapcimke = KerdesCimke("kerdes",$kiiras['id']); 
                        foreach($kapcimke as $cimke){
                          $megkCimke = CimkeAdat("id",$cimke['cimke_id']);
                          echo '<div class="osszesitett" id="cimke"><a href="/cimke/'. $megkCimke[0]['megnevezes'] .'">#' . $megkCimke[0]['megnevezes'] . '</a></div>';
                          // <?=$megkCimke[0]['megnevezes']</div>
                        }
                  ?>
                  <br> <div class="osszesitett" id="felhasznalo"><?=FelhasznaloAdat("id",FelhasznaloKerdes("kerdes",$kiiras["id"])[0]["felh_id"])[0]["felhasznalonev"]?></div> <div class="osszesitett float-right" id="valaszok">Válaszok: <?=ValaszSzam($kiiras['id']);?> </div><div class="osszesitett float-right" id="latta">Látta: <?=count(KerdesLatta("kerdes",$kiiras["id"]))?></div>
                  <!-- 
                    A látta és a Válaszok résznél meghívni egy/két függvényt
                    pl.:LattaSzam($connection, $kerdes['id']);
                    pl.:ValaszSzam($connection, $kerdes['id']);
                  -->
                  <div class="osszesitett" id="datum">Beküldve <?=$kiiras['datum']?></div>
                  </div>
             </a>
             <hr>
    <?php
    }
}
?>
</div>
</div>
</div>