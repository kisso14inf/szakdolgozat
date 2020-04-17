<div class="egybe">
<div class="card">
<div class="card-body">
<h4>Címkék</h4>
<?php 
$keresendo = urldecode($keresendo);
?>
Jelenlegi címke: <div class="osszesitett" id="cimke"><a href="/cimke/<?=$keresendo?>">#<?=$keresendo?></a></div>
<br> További címkék:
<?php 
$cimkek = CimkeAdat("","");
if($keresendo != "Összes"){?>
<div class="osszesitett" id="cimke"><a href="/cimke/Összes">#Összes</a></div>
<?php }
foreach($cimkek as $cimke):
if($cimke["megnevezes"]!= $keresendo):
?>
<div class="osszesitett" id="cimke"><a href="/cimke/<?=$cimke["megnevezes"]?>">#<?=$cimke["megnevezes"]?></a></div>
<?php endif;endforeach; ?>
<?php
if($keresendo == "Összes" || count(KerdesCimke("cimke",CimkeAdat("megnevezes",$keresendo)[0]["id"]))>0) {?>
<h5>A címkéhez tartozó kérdések 
(<?php if($keresendo == "Összes"): 
       echo count(KerdesAdat("","")); 
       else: 
       echo count(KerdesCimke("cimke",CimkeAdat("megnevezes",$keresendo)[0]["id"])); 
       endif;?>db)</h5> 
<?php
if($keresendo == "Összes"){
  $kerdesek = KerdesCimke("","");
/*$kerdesek =  array();
$KerdesCimkek = KerdesCimke("","");
foreach($KerdesCimkek as $KerdesCimke){
  if(!in_array($KerdesCimke["kerdes_id"],$kerdesek)){
      array_push($kerdesek,$KerdesCimke);
  }
}*/
}
else{
$cimkeID = CimkeAdat("megnevezes",$keresendo)[0]["id"];
$kerdesek = KerdesCimke("cimke",$cimkeID);}
foreach(array_reverse($kerdesek) as $kerdes){?>
<a href="/kerdes/<?=$kerdes['kerdes_id']?>">
                 <div class="card-body">
                  <?php 
                  $kerdesrov = KerdesAdat("id",$kerdes['kerdes_id'])[0]['kerdesrov'];
                  if(strlen($kerdesrov)>49) echo "<b>" . substr($kerdesrov,0,47) . "...</b>";
                  else{ echo "<b>" . $kerdesrov . "</b>";}
                  ?>
                  <br>
                  <?php
                  $akerdes = KerdesAdat("id",$kerdes['kerdes_id'])[0]['akerdes'];
                  if(strlen($akerdes)>99) echo substr($akerdes,0,97) . "...";
                  else{ echo $akerdes;}
                  ?>
                  <br>
                  <?php $kapcimke = KerdesCimke("kerdes",$kerdes['kerdes_id']); 
                        foreach($kapcimke as $cimke){
                          $megkCimke = CimkeAdat("id",$cimke['cimke_id']);
                          echo '<div class="osszesitett" id="cimke"><a href="/cimke/'. $megkCimke[0]['megnevezes'] .'">#' . $megkCimke[0]['megnevezes'] . '</a></div>';
                        }
                  ?>
                  <br> <div class="osszesitett" id="felhasznalo"><a href="/profil/<?=FelhasznaloAdat("id",FelhasznaloKerdes("kerdes",$kerdes["kerdes_id"])[0]["felh_id"])[0]["felhasznalonev"]?>"><?=FelhasznaloAdat("id",FelhasznaloKerdes("kerdes",$kerdes["kerdes_id"])[0]["felh_id"])[0]["felhasznalonev"]?></a></div> <div class="osszesitett float-right" id="valaszok">Válaszok: <?=ValaszSzam($kerdes['kerdes_id']);?> </div><div class="osszesitett float-right" id="latta">Látta: <?=count(KerdesLatta("kerdes",$kerdes["kerdes_id"]))?></div>
                  <div class="osszesitett" id="datum">Beküldve: <?=DatumAtalakit(KerdesAdat("id",$kerdes['kerdes_id'])[0]['datum'])?></div>
                  </div>
             </a>
             <hr>
<?php
}
}else{ ?>
<h5>Nincs hozzátartozó kérdés</h5>
<?php } ?>
</div>
</div>
</div>