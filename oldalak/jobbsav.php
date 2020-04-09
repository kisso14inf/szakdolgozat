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
    <?php 
    $legtobbvalaszok = KerdValSzam();
    foreach($legtobbvalaszok as $legtobbvalasz){?>
       <a href="/kerdes/<?=$legtobbvalasz["id"]?>"> <div class="osszesitett" id="felhasznalo"><?=$legtobbvalasz["kerdrov"]?></div> <?=$legtobbvalasz["szam"]?> válasz</a> <br>
    <?php } 
        for($i=0;$i<5-count($legtobbvalaszok);$i++){
    ?>
    <a href="/info"><div class="osszesitett" id="urescella">Üres cella</div></a> <br>
        <?php } ?>
    Erre még nem válaszoltak<br>
    <?php 
        $kerdesek = KerdesAdat("","");
        //maximum 5öt írjon ki
        $max5 = 0;
        foreach($kerdesek as $kerdes):
            if(count(KerdesValasz("kerdes",$kerdes["id"]))==0){
             if($max5<=5){?>
                <a href="/kerdes/<?=$kerdes["id"]?>"><div class="osszesitett" id="valasz"><?=$kerdes["kerdesrov"]?></div></a>
             <?php } } endforeach; 
             for($i=0;$i<5-$max5;$i++){ ?>
                <a href="/info"><div class="osszesitett" id="urescella">Üres cella</div></a> <br>
        <?php } ?>
             
    <br>Legaktívabb kérdezők<br>
    <?php 
    $legtobbkerdesek = FelhKerdSzam();
    foreach($legtobbkerdesek as $legtobbkerdes){?>
        <div class="osszesitett" id="felhasznalo"><?=$legtobbkerdes["felh"]?></div> <?=$legtobbkerdes["szam"]?> kérdés <br>
    <?php }
    for($i=0;$i<5-count($legtobbkerdesek);$i++){ ?>
    <a href="/info"><div class="osszesitett" id="urescella">Üres cella</div></a> <br>
        <?php } ?>
    Legaktívabb válaszolók<br>
    <?php 
    $legtobbkerdesek = FelhValSzam();
    foreach($legtobbkerdesek as $legtobbkerdes){?>
        <div class="osszesitett" id="felhasznalo"><?=$legtobbkerdes["felh"]?></div> <?=$legtobbkerdes["szam"]?> válasz <br>
    <?php } 
    for($i=0;$i<5-count($legtobbkerdesek);$i++){ ?>
    <a href="/info"><div class="osszesitett" id="urescella">Üres cella</div></a> <br>
        <?php } ?>
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
        if(count($tagok) <5){
        for($i=0;$i<5-count($tagok);$i++){
            ?>
            <a href="/info"><div class="osszesitett" id="urescella">Üres cella</div></a> <br>
                <?php } }?>
</div>
</div>
</div>