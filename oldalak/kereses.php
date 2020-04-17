<div class="egybe">
  <div class="card">
    <div class="card-body">
      <button type="button" <?php if($rendezo=="/Friss"){?>class="btn btn-primary"
        <?php } else{ ?>class="btn btn-secondary" <?php } ?>onclick="Rendezes('Friss');">Friss</button>
      <button type="button" <?php if($rendezo=="/Hasznos"){?>class="btn btn-primary"
        <?php } else{ ?>class="btn btn-secondary" <?php } ?> onclick="Rendezes('Hasznos');">Hasznos</button>
      <button type="button" <?php if(urldecode($rendezo)=="/Válasz_nélküli"){?>class="btn btn-primary"
        <?php } else{ ?>class="btn btn-secondary" <?php } ?> onclick="Rendezes('Válasz_nélküli');">Válasz
        nélküli</button>
    </div>
  </div>
  <script>
    function Rendezes(ertek) {
      location.href = ertek;
    }
  </script>
  <div class="card">
    <div class="card-body">
      <h3>Keresés</h3>
      <?php
$keresendo = str_replace("_"," ",urldecode($keresendo)); 
//A kérdésröv vagy a kerdeshossz ami tartalmazhatja a kifejezést
$kerdesek = array();
      if($rendezo == "/Friss"){
        $kerdesekrov = KerdesAdat("kerdesrov",$keresendo);
        foreach($kerdesekrov as $kerdesrov){
            array_push($kerdesek,$kerdesrov["id"]);
        }
        $akerdesek = KerdesAdat("akerdes",$keresendo);
        foreach($akerdesek as $akerdes){
        if(!in_array($akerdes["id"],$kerdesek)){
            array_push($kerdesek,$akerdes["id"]);
        }
        }
        arsort($kerdesek);
      }
      elseif($rendezo == "/Hasznos"){
      $hasznoskerdesek = array();
      $kerdesadatok = KerdesAdat("","");
      foreach($kerdesadatok as $kerdesadat){
        $hasznoskerdesek[$kerdesadat["id"]] = 0;
      }
      $valaszertekelesek = ValaszErtekeles("","");
      foreach($valaszertekelesek as $valaszertekeles){
       $hasznoskerdesek[KerdesValasz("valasz",$valaszertekeles["valasz_id"])[0]["kerdes_id"]] += ErtekelesAdat("id",$valaszertekeles["ertekeles_id"])[0]["ertekeles"];
      }
        arsort($hasznoskerdesek);
        foreach($hasznoskerdesek as $key => $value){
          
          if(strpos(KerdesAdat("id",$key)[0]["kerdesrov"], $keresendo) !== false || strpos(KerdesAdat("id",$key)[0]["akerdes"], $keresendo) !== false){
            array_push($kerdesek, $key);
          }
        }
        
      }
    
      elseif(urldecode($rendezo) == "/Válasz_nélküli"){
        $kerdesekrov = KerdesAdat("kerdesrov",$keresendo);
        foreach($kerdesekrov as $kerdesrov){
          if(count(KerdesValasz("kerdes",$kerdesrov["id"]))==0){
            array_push($kerdesek,$kerdesrov["id"]);
          }
        }
        $akerdesek = KerdesAdat("akerdes",$keresendo);
        foreach($akerdesek as $akerdes){
        if(!in_array($akerdes["id"],$kerdesek)){
          if(count(KerdesValasz("kerdes",$akerdes["id"]))==0){
            array_push($kerdesek,$akerdes["id"]);
          }
        }
        }
        arsort($kerdesek);
      }
?>
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
                        }
                  ?>
          <br>
          <div class="osszesitett" id="felhasznalo">
            <?=FelhasznaloAdat("id",FelhasznaloKerdes("kerdes",$kiiras["id"])[0]["felh_id"])[0]["felhasznalonev"]?>
          </div>
          <div class="osszesitett float-right" id="valaszok">Válaszok: <?=ValaszSzam($kiiras['id']);?> </div>
          <div class="osszesitett float-right" id="latta">Látta: <?=count(KerdesLatta("kerdes",$kiiras["id"]))?></div>
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