<?php foreach ($kerdeshezTartozo as $kerdes):?>
<div class="egybe">
  <div class="card">
    <div class="card-body">
      <h5><?=$kerdes['kerdesrov']?></h5>
      <?=$kerdes['akerdes']?>
      <br><b>Kérdező: <div class="osszesitett" id="felhasznalo">
          <?=FelhasznaloAdat("id",FelhasznaloKerdes("kerdes",$kerdes["id"])[0]["felh_id"])[0]["felhasznalonev"]?></div>
      </b>
      <br>
      <?php $kapcimke = KerdesCimke("kerdes",$kerdes['id']); 
                        foreach($kapcimke as $cimke){
                          $megkCimke = CimkeAdat("id",$cimke['cimke_id']);
                          echo '<div class="osszesitett" id="cimke"><a href="/cimke/'. $megkCimke[0]['megnevezes'] .'">#' . $megkCimke[0]['megnevezes'] . '</a></div>';
                          // <?=$megkCimke[0]['megnevezes']</div>
                        }?>
      <div class="osszesitett float-right" id="valaszok">Válaszok: <?=ValaszSzam($kerdes['id'])?></div>
      <div class="osszesitett float-right" id="latta">Látta: <?=count(KerdesLatta("kerdes",$kerdes["id"]))?></div>
    </div>
    <?php 
        if(isset($_COOKIE["felhasznalonev"])){
    $felhID = FelhasznaloAdat("felhasznalonev", $_COOKIE["felhasznalonev"])[0]["id"];
    MostLattaAKerdestAFelhasznalo($kerdes['id'],$felhID);
    }?>
    <!--Na ez egy válasz a kérdésre
    //A kérdező is tudja értékelni, de csak egyszer
    //Más emberek is tudják értékelni, de ő nem
    //A kérdezőnek az értékelése, valamennyivel többet ér-->
    <form action="/valaszelkuld" method="post">
      <div class="form-group" style="padding:5px;">
        <textarea name="valasz" class="form-control col-sm-15" rows="4" id="comment"
          placeholder="Van egy megoldásod erre a kérdésre? Ne habozz! Válaszolj!"></textarea>
        <input type="hidden" name="kerdes_id" id="kerdes_id" value="<?=$kerdes['id']?>">
        <input type="hidden" name="valaszolo_id" id="valaszolo_id" value="<?=$felhID?>">
        <button class="btn btn-primary float-right" type="submit" style="margin-top: 5px;"
          id="valaszgomb">Küldés</button>
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
      <!-- 1 -->
      <div class="alert alert-secondary" style="padding:0;min-height:100px;overflow:hidden;">
        <!-- 1.1 -->
        <div style="min-height:100px;display:inline-block;width:80%;float:left;">
          <!-- 1.1.1 -->
          <div style="width:100%;min-height:65px;padding:5px 0px 0px 10px;">
            <?=$v2["valasz"]?>
            <?php
            $ertek =  0;
            $valaszertekek = ValaszErtekeles("valasz",$valasz['valasz_id']);
            if(count($valaszertekek)>0){
            for($i=0;$i<count($valaszertekek);$i++){
            $ertek += ErtekelesAdat("id",$valaszertekek[$i]["ertekeles_id"])[0]["ertekeles"];
            }}
        ?>
          </div> <!-- 1.1.1 lezárója -->
          <!-- 1.1.2 -->
          <div style="height:35px;padding:0px 0px 5px 10px;">
            <div class="osszesitett" id="felhasznalo">
              <?=FelhasznaloAdat("id",FelhasznaloValasz("valasz",$v2["id"])[0]["felh_id"])[0]["felhasznalonev"]?></div>
            <div class="osszesitett" id="datum"><?=$v2["vdatum"]?></div>
          </div> <!-- 1.1.2 lezárója -->
        </div> <!-- 1.1 lezárója -->
        <!-- 1.2 nyitója -->
        <div style="display:inline-block;width:20%;min-height:100px;float:right;">
          <div
            style="background-color: darkgray;padding: 5px;border-radius: 5px; border: 1px solid black;margin:auto;width:80%;margin:auto;">
            <form action="/ertekeles" method="post">

              <input type="submit" class="osszesitett btn btn-light" name="hvnh"
                style="width:100%;text-align:center;border:1px solid lightgray;" value="Hasznos"><br>
              <div class="osszesitett" id="datum" style="width:100%;text-align:center;"><?=$ertek?></div> <br>
              <input type="submit" class="osszesitett btn btn-light" name="hvnh"
                style="width:100%;text-align:center;border:1px solid lightgray;" value="Nem Hasznos">
              <input type="hidden" name="valasz_id" value="<?=$v2['id']?>">
              <input type="hidden" name="felh_id"
                value="<?=FelhasznaloAdat("felhasznalonev", $_COOKIE["felhasznalonev"])[0]["id"]?>">
            </form>
          </div>
        </div> <!-- 1.2 zárója -->
        </div> <!-- 1 zárója -->
        <?php
      endforeach; //$v as $v2
      endforeach; //$KerdeshezValasz as $valasz
      ?>
      

    </div>
  </div>
</div>
<?php endforeach ?>