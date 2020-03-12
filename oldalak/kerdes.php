<?php foreach ($kerdeshezTartozo as $kerdes):?>
<div class="egybe">
<div class="card">
<div class="card-body">

<h5><?=$kerdes['kerdesrov']?></h5>
<?=$kerdes['akerdes']?>
<br><b>Kérdező: <div class="osszesitett" id="felhasznalo">xyhalmosi5400</div></b><br><div class="osszesitett float-right" id="valaszok">Válaszok: 23</div><div class="osszesitett float-right" id="latta">Látta: 54</div>
</div>
<div class="card-body">15 válasz van ezen a kérdésen (tőled 2):</div>

    <!--Na ez egy válasz a kérdésre
    //A kérdező is tudja értékelni, de csak egyszer
    //Más emberek is tudják értékelni, de ő nem
    //A kérdezőnek az értékelése, valamennyivel többet ér-->
    

    
<br>
<form>
    <div class="form-group">
      <label for="comment">Comment:</label>
      <textarea class="form-control" rows="4" id="comment"></textarea>
      <button class="btn btn-primary float-right" type="submit">Küldés</button>
    </div>
  </form>
    //De ha nincs bejelentkezve, akkor mást adjon ide ki,
    majd ezek után a kérdéseket
    card
<div class="card-body">
Jelenleg nincs is válasz
</div>
</div>
</div>
<?php endforeach ?> 