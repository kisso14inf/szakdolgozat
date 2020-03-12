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
                  <!-- Megadva a max karakterszám-->
                  <b><?=$kerdes['kerdesrov']?></b>
                  <!-- Megadva a max karakterszám -->
                  <br><?=$kerdes['akerdes']?>
                  <br>#címkék #címkék #címkék
                  <br> <div class="osszesitett" id="latta">Látta: 54</div> <div class="osszesitett" id="valaszok">Válaszok: 15 </div> <div class="osszesitett" id="ertekeles">Értékelés: 0</div>
                  <div class="osszesitett" id="felhasznalo">MasiXXX15</div>
                  <div class="osszesitett" id="datum">Beküldve <?=$kerdes['datum']?></div>
                  </div>
             </a>
            <?php endforeach ?> 
 <?php /*Ezzel is majd kellene valamit kezdeni*/ 
        require "lapozo.php";
?>
</div>
</div>