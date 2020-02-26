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
<?php 
$connection = mysqli_connect($config['db_host'], $config['db_user'], $config['db_pass'], $config['db_name']);    
$sql = "SELECT ID, kerdesrov, akerdes, datum FROM kerdesek";
$result = $connection->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {?>
       <a href="/kerdes/<?=$row['ID']?>"><div class="card-body">
      <!-- Megadva a max karakterszám-->
      <b><?=$row["kerdesrov"]?></b>
      <!-- Megadva a max karakterszám -->
      <br><?=$row["akerdes"]?>
      <br>#címkék #címkék #címkék
      <br> <div class="osszesitett" id="latta">Látta: 54</div> <div class="osszesitett" id="valaszok">Válaszok: 15 </div> <div class="osszesitett" id="ertekeles">Értékelés: 0</div>
      <div class="osszesitett" id="felhasznalo">MasiXXX15</div>
      <div class="osszesitett" id="datum">Beküldve <?php echo $row["datum"];?></div>
      </div></a>
       
    <?php  }
} else {
    echo "Nincs találat";
}
$connection->close();
?>

 <?php require_once('oldalak/lapozo.php'); ?>
</div>
</div>