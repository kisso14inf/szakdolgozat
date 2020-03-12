<ul class="list-group" >
<!-- Ezt úgy kell megoldani, hogy foreacheljem ezt
 És csak azt adja ki, amihez az adott embernek jogosúltsága
  van
  A lényeg, hogy minnél kevesebb kód legyen, és automatizálva 
  legyen ez az egész
  pl. Legyen egy osztály, annak gyereke
  és legyen egy tömb, amit gyerekenként hozzáadok
   -->
  <?php 
    for($i=0;$i<sizeof($balsav);$i++){echo $balsav[$i];}
 ?>
    
  
</ul>