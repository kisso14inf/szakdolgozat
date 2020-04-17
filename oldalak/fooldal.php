
<div class="egybe">
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
                  <?php $kapcimke = KerdesCimke("kerdes",$kerdes['id']); 
                        foreach($kapcimke as $cimke){
                          $megkCimke = CimkeAdat("id",$cimke['cimke_id']);
                          echo '<div class="osszesitett" id="cimke"><a href="/cimke/'. $megkCimke[0]['megnevezes'] .'">#' . $megkCimke[0]['megnevezes'] . '</a></div>';
                        }
                  ?>
                  <br> <div class="osszesitett" id="felhasznalo"><a href="/profil/<?=FelhasznaloAdat("id",FelhasznaloKerdes("kerdes",$kerdes["id"])[0]["felh_id"])[0]["felhasznalonev"]?>"><?=FelhasznaloAdat("id",FelhasznaloKerdes("kerdes",$kerdes["id"])[0]["felh_id"])[0]["felhasznalonev"]?></a></div> <div class="osszesitett float-right" id="valaszok">Válaszok: <?=ValaszSzam($kerdes['id']);?> </div><div class="osszesitett float-right" id="latta">Látta: <?=count(KerdesLatta("kerdes",$kerdes["id"]))?></div>
                  <div class="osszesitett" id="datum">Beküldve: <?=DatumAtalakit($kerdes['datum'])?></div>
                  </div>
             </a>
             <hr>
            <?php endforeach ?> 
            
 <?php require "lapozo.php"; ?>
</div>
</div>