<div class="egybe">
<div class="card">
<div class="card-body">
<h3>Kérdéseim</h3> <br>
<?php 
$kerdesIDk = FelhasznaloKerdes("felhasznalo",FelhasznaloAdat("felhasznalonev", $_COOKIE["felhasznalonev"])[0]["id"]);

//ez csak a kérdés ID-ket adja oda
foreach($kerdesIDk as $kerdesID):
  $kerdesid = $kerdesID["kerdes_id"];
  $kerdesrov = KerdesAdat("id", $kerdesid)[0]["kerdesrov"];
  $akerdes = KerdesAdat("id", $kerdesid)[0]["akerdes"];
  $datum = KerdesAdat("id", $kerdesid)[0]["datum"];

?>
<a href="/kerdes/<?=$kerdesid?>">
    <div class="card-body">
   
                  
    <a class="btn btn-danger float-right">Törlés</a>
     <?php 
     if(strlen($kerdesrov)>49) echo "<b>" . substr($kerdesrov,0,47) . "...</b>";
     else{ echo "<b>" . $kerdesrov . "</b>";}
     ?>
     <br>
     <?php
     if(strlen($akerdes)>99) echo substr($akerdes,0,97) . "...";
     else{ echo $akerdes;}
     ?>
     <br>
     <?php $kapcimke = KerdesCimke("kerdes",$kerdesid); 
           foreach($kapcimke as $cimke){
             $megkCimke = CimkeAdat("id",$cimke['cimke_id']);
             echo '<div class="osszesitett" id="cimke"><a href="/cimke/'. $megkCimke[0]['megnevezes'] .'">#' . $megkCimke[0]['megnevezes'] . '</a></div>';
            
           }
     ?>
     <div class="osszesitett float-right" id="valaszok">Válaszok: <?=ValaszSzam($kerdesid);?> </div>
     <div class="osszesitett float-right" id="latta">Látta: <?=count(KerdesLatta("kerdes",$kerdesid))?></div>
     <br>
     <div class="osszesitett" id="datum">Beküldve <?=$datum?></div>
     
     Itt majd hozzon be egy alert-et
     </div>
</a>
<hr>
<?php endforeach?>            
</div>
</div>
</div>