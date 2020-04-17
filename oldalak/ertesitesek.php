<div class="egybe">
<div class="card">
<div class="card-body">
<h3>Értesítések</h3>
<?php
$ma = Ertesiteseim($_COOKIE["felhasznalonev"],"ma");
$tegnap = Ertesiteseim($_COOKIE["felhasznalonev"],"tegnap");
$tegnapelott = Ertesiteseim($_COOKIE["felhasznalonev"],"tegnapelott");
?>

<h5 style="display:inline-block">Ma</h5> (+<?php echo array_sum($ma); ?> válasz) <br>
<?php if(array_sum($ma)>0){ ?>
<u>A kérdések:</u> <br>
<?php } ?>
<?php foreach($ma as $key => $value): 
      $kerdesrov = (strlen(KerdesAdat("id",$key)[0]["kerdesrov"])>25) ?  substr(KerdesAdat("id",$key)[0]["kerdesrov"],0,20) . "...?" : KerdesAdat("id",$key)[0]["kerdesrov"];
?>
<div class="alert alert-dark" role="alert">
<a href="/kerdes/<?=$key?>">
<?=$kerdesrov?> <div class="osszesitett float-right" id="latta">+<?=$value?> válasz</div><div class="osszesitett float-right" id="datum"><?=KerdesAdat("id",$key)[0]["datum"]?></div>
</a>
</div>
<?php endforeach; ?>

<h5 style="display:inline-block">Tegnap</h5>(+<?php echo array_sum($tegnap); ?> válasz) <br>
<?php if(array_sum($tegnap)>0){ ?>
<u>A kérdések:</u> <br>
<?php } ?>
<?php foreach($tegnap as $key => $value): 
      $kerdesrov = (strlen(KerdesAdat("id",$key)[0]["kerdesrov"])>25) ?  substr(KerdesAdat("id",$key)[0]["kerdesrov"],0,20) . "...?" : KerdesAdat("id",$key)[0]["kerdesrov"];
?>
<div class="alert alert-dark" role="alert">
<a href="/kerdes/<?=$key?>">
<?=$kerdesrov?> <div class="osszesitett float-right" id="latta">+<?=$value?> válasz</div><div class="osszesitett float-right" id="datum"><?=KerdesAdat("id",$key)[0]["datum"]?></div>
</a>
</div>
<?php endforeach; ?>

<h5 style="display:inline-block">Tegnapelőtt</h5> (+<?php echo array_sum($tegnapelott); ?> válasz) <br>
<?php if(array_sum($tegnapelott)>0){ ?>
<u>A kérdések:</u> <br>
<?php } ?>
<?php foreach($tegnapelott as $key => $value): 
      $kerdesrov = (strlen(KerdesAdat("id",$key)[0]["kerdesrov"])>25) ?  substr(KerdesAdat("id",$key)[0]["kerdesrov"],0,20) . "...?" : KerdesAdat("id",$key)[0]["kerdesrov"];
?>
<div class="alert alert-dark" role="alert">
<a href="/kerdes/<?=$key?>">
<?=$kerdesrov?> <div class="osszesitett float-right" id="latta">+<?=$value?> válasz</div><div class="osszesitett float-right" id="datum"><?=KerdesAdat("id",$key)[0]["datum"]?></div>
</a>
</div>
<?php endforeach; ?>

</div>
</div>
</div>