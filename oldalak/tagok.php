<div class="egybe">
<div class="card">
<div class="card-body">
<h3>Tagok</h3> <br>
<?php  
$tagok = FelhasznaloAdat("","");
foreach($tagok as $tag){ ?>
Összesen <?=count($tagok)?> felhasználó <br>
<a href="/profil/<?=$tag['felhasznalonev']?>"><div class="osszesitett" id="felhasznalo"><?=$tag["felhasznalonev"]?></div></a>
<?php }
?>
</div>
</div>
</div>