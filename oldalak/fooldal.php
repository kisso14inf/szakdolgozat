<!-- Friss/Hasznos/Válasz nélküli -->
<div class="egybe">
 <div class="card">
  <div class="card-body">
    <button type="button" class="btn btn-primary">Friss</button>
    <button type="button" class="btn btn-secondary">Hasznos</button>
    <button type="button" class="btn btn-secondary">Válasz nélküli</button>
  </div>
</div>
<div class="card">

<?php foreach ($content as $kerdes):?>
             <a href="/kerdes/<?=$kerdes['id']?>">
                 <div class="card-body">
                  
                 
                  <?php 
                  $kerdesrov = $kerdes['kerdesrov'];
                  if(strlen($kerdesrov)>49) echo "<b>" . substr($kerdesrov,0,47) . "...</b>";
                  else{ echo "<b>" . $kerdesrov . "</b>";}
                  ?>
                  <br>
                  <?php
                  $akerdes = $kerdes['akerdes'];
                  if(strlen($akerdes)>99) echo substr($akerdes,0,97) . "...";
                  else{ echo $akerdes;}
                  ?>
                  <br>
                  <?php $kapcimke = KerdesCimke($kerdes['id']); 
                        foreach($kapcimke as $cimke){
                          $megkCimke = KapCimke($cimke['cimke_id']);
                          echo '<div class="osszesitett" id="cimke"><a href="/cimke/'. $megkCimke[0]['megnevezes'] .'">#' . $megkCimke[0]['megnevezes'] . '</a></div>';
                          // <?=$megkCimke[0]['megnevezes']</div>
                        }
                  ?>
                  <br> <div class="osszesitett" id="felhasznalo"><?=FelhasznaloAdat("id",FelhasznaloKerdes("kerdes",$kerdes["id"])[0]["felh_id"])[0]["felhasznalonev"]?></div> <div class="osszesitett float-right" id="valaszok">Válaszok: <?=ValaszSzam($kerdes['id']);?> </div><div class="osszesitett float-right" id="latta">Látta: <?=count(KerdesLatta("kerdes",$kerdes["id"]))?></div>
                  <!-- 
                    A látta és a Válaszok résznél meghívni egy/két függvényt
                    pl.:LattaSzam($connection, $kerdes['id']);
                    pl.:ValaszSzam($connection, $kerdes['id']);
                  -->
                  <div class="osszesitett" id="datum">Beküldve <?=$kerdes['datum']?></div>
                  </div>
             </a>
             <hr>
            <?php endforeach ?> 
            
 <?php /*Ezzel is majd kellene valamit kezdeni*/ 
        require "lapozo.php";
?>
</div>
</div>