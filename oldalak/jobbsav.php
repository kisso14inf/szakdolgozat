<div class="jobbsav">
    
    <div class="card">
    <div class="card-body">
   <h4>Statisztika:</h4> <br>
    Kérdések száma 
    <div class="osszesitett" id="statisztikaszam"><?=count(KerdesAdat("",""))?></div> <br>
    Válaszok száma 
    <div class="osszesitett" id="statisztikaszam"><?=count(ValaszAdat("",""))?></div> <br>
    Tagok száma 
    <div class="osszesitett" id="statisztikaszam"><?=count(FelhasznaloAdat("",""))?></div>
</div>
<div class="card-body">
    Legfelkapottabb kérdések <br>
    <div class="osszesitett" id="kerdes">Miért van ez így úgy? 15 válasz</div>
    <div class="osszesitett" id="kerdes">Miért van ez így úgy? 15 válasz</div>
    <div class="osszesitett" id="kerdes">Miért van ez így úgy? 15 válasz</div>
    <div class="osszesitett" id="kerdes">Miért van ez így úgy? 15 válasz</div>
    <div class="osszesitett" id="kerdes">Miért van ez így úgy? 15 válasz</div>
    Erre még nem válaszoltak<br>
    
    <?php 
        $kerdesek = KerdesAdat("","");
        //maximum 5öt írjon ki
        $max5 = 0;
        foreach($kerdesek as $kerdes):
            if(count(KerdesValasz("kerdes",$kerdes["id"]))==0){
             if($max5<=5){?>
                <a href="/kerdes/<?=$kerdes["id"]?>"><div class="osszesitett" id="valasz"><?=$kerdes["kerdesrov"]?></div></a>
             <?php }
            }
        endforeach;
         ?>
    Legaktívabb kérdezők<br>
    1. <div class="osszesitett" id="felhasznalo">macilaci15</div> 230 kérdés <br>
    2. <div class="osszesitett" id="felhasznalo">macilaci15</div> 230 kérdés <br>
    3. <div class="osszesitett" id="felhasznalo">macilaci15</div> 230 kérdés <br>
    4. <div class="osszesitett" id="felhasznalo">macilaci15</div> 230 kérdés <br>
    5. <div class="osszesitett" id="felhasznalo">macilaci15</div> 230 kérdés <br>
    Legaktívabb válaszolók<br>
    1. <div class="osszesitett" id="felhasznalo">macilaci15</div> 230 válasz <br>
    2. <div class="osszesitett" id="felhasznalo">macilaci15</div> 230 válasz <br>
    3. <div class="osszesitett" id="felhasznalo">macilaci15</div> 230 válasz <br>
    4. <div class="osszesitett" id="felhasznalo">macilaci15</div> 230 válasz <br>
    5. <div class="osszesitett" id="felhasznalo">macilaci15</div> 230 válasz <br>
    A legújabb tagok<br>
    <?php 
        $tagok = FelhasznaloAdat("","");
        //maximum 5öt írjon ki
        if(count($tagok)>=5):
           for($i=count($tagok)-1;$i>count($tagok)-6;$i--): ?>
           <div class="osszesitett" id="felhasznalo"><?=FelhasznaloAdat("","")[$i]["felhasznalonev"]?></div>  <br>
           <?php endfor; 
        else:
           if(count($tagok)>0):
           for($i=count($tagok)-1;$i>=0;$i--): ?>
           <div class="osszesitett" id="felhasznalo"><?=FelhasznaloAdat("","")[$i]["felhasznalonev"]?></div>  <br>
    <?php  endfor;
           endif;
        endif;
    ?>
</div>
</div>
</div>