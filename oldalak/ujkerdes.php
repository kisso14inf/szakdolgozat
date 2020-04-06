<div class="egybe">
 <div class="card">
  <div class="card-body">
     <h3>Új kérdés</h3> <br>
     <form action="/ujkerdes/elkuld" method="POST" name="ujkerdes" id="ujkerdes">
  <div class="form-group">
    <label for="kerdesrov">A kérdés röviden</label>
    <input type="text" name="kerdesrov" class="form-control" placeholder="A kérdés röviden..." id="kerdesrov">
  </div>
  <div class="form-group">
    <label for="akerdes">A kérdés kifejtése</label>
    <textarea name="akerdes" class="form-control" rows="4" id="akerdes" placeholder="A kérdés kifejtésének helye. (Min 15karakter, Maximum 1500)"></textarea>
  </div>
  <div class="form-group">
  <?php $cimkek = Cimke();?>
  <div class="form-group">
  <label for="exampleFormControlSelect1">Címkék</label> <br>
    <select class="form-control" id="exampleFormControlSelect1" style="width: 100px; display:inline-block;" name="cimke1">
    <option value="">Válassz egy cimkét:</option>
      <?php foreach($cimkek as $cimke):?>
      <option value="<?=$cimke["megnevezes"]?>"><?=$cimke["megnevezes"]?></option>
      <?php endforeach ?>
    </select>
    <b  id="gomb" class="gomb btn btn-primary">+</b>
    (Minimum egyet válassz ki, maximum 5öt) //ha nincs benne semmi sem, akkor ne engedje tovább
  </div>
  </div>
<div class="form-group">
<?php 
for($i=0;$i<5;$i++)
{
  ?>
  <input type="text" name="<?=$i?>" id="<?=$i?>" style="margin-bottom: 3px;visibility:hidden;" readonly>
  <b name="torol<?=$i?>" id="torol<?=$i?>" style="margin-bottom: 3px;visibility:hidden;" class="btn btn-danger">X</b>
  
  <?php
}
?>
<?php
$felhID = FelhasznaloAdat("felhasznalonev", $_COOKIE["felhasznalonev"])[0]["id"];?>
<input type="hidden" value="<?=$felhID?>" name="felh_id">
</div>
  <button type="submit" class="btn btn-primary float-right">Küldés</button>
</form>
     </div>
    </div>
</div>