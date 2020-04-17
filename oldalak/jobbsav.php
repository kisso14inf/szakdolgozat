<div id="jobbsav">
    
    <div class="card">
    <div class="card-body" style="margin:auto;">
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
       <a href="/kerdes/<?=$legtobbvalasz["id"]?>"> <div class="osszesitett" id="felhasznalo" style="max-width:100%;"><?=$legtobbvalasz["kerdrov"]?></div> <?=$legtobbvalasz["szam"]?> válasz</a> <br>
    <?php } 
        for($i=0;$i<5-count($legtobbvalaszok);$i++){
    ?>
    <a href="/info"><div class="osszesitett" id="urescella">Üres cella</div></a> <br>
        <?php } ?>
    Erre még nem válaszoltak<br>
    <?php 
        $kerdesek = KerdesAdat("","");
        $max5 = 0;
        foreach($kerdesek as $kerdes):
            if(count(KerdesValasz("kerdes",$kerdes["id"]))==0 && $max5<5){?>
             <a href="/kerdes/<?=$kerdes["id"]?>"><div class="osszesitett" id="valasz" style="max-width:100%;"><?=$kerdes["kerdesrov"]?></div></a> <br>
             <?php  $max5++; } endforeach; 
             for($i=0;$i<5-$max5;$i++){ ?>
                <a href="/info"><div class="osszesitett" id="urescella">Üres cella</div></a> <br>
        <?php } ?>
             
    <br>Legaktívabb kérdezők<br>
    <?php 
    $legtobbkerdesek = FelhKerdSzam();
    foreach($legtobbkerdesek as $legtobbkerdes){?>
        <div class="osszesitett" id="felhasznalo"><a href="/profil/<?=$legtobbkerdes["felh"]?>"><?=$legtobbkerdes["felh"]?></a></div> <?=$legtobbkerdes["szam"]?> kérdés <br>
    <?php }
    for($i=0;$i<5-count($legtobbkerdesek);$i++){ ?>
    <a href="/info"><div class="osszesitett" id="urescella">Üres cella</div></a> <br>
        <?php } ?>
    Legaktívabb válaszolók<br>
    <?php 
    /*A legtöbb válaszokkal rendelkező felhasználókat íratom ki */
    //Max 5öt --> Ha akarok többet, ezért a LIMIT 5 lekerüljön
    $legtobbkerdesek = FelhValSzam();
    foreach($legtobbkerdesek as $legtobbkerdes){?>
        <div class="osszesitett" id="felhasznalo"><a href="/profil/<?=$legtobbkerdes["felh"]?>"><?=$legtobbkerdes["felh"]?></a></div> <?=$legtobbkerdes["szam"]?> válasz <br>
    <?php } 
    for($i=0;$i<5-count($legtobbkerdesek);$i++){ ?>
    <a href="/info"><div class="osszesitett" id="urescella">Üres cella</div></a> <br>
        <?php } ?>
    
    A legújabb tagok<br>
    <?php 
        /*Ezzel kilistázom a felhasználókat, majd az array_reverse segítségével megfordítom, így a legújabb tagokkal 
        kezdődik a foreach ciklus, és ebből maximum az első 5öt veszem ki.*/
        $tagok = FelhasznaloAdat("","");
        $szamol = 0;
        foreach(array_reverse($tagok) as $tag){
            if($szamol<5){?>
            <div class="osszesitett" id="felhasznalo"><a href="/profil/<?=$tag["felhasznalonev"]?>"><?=$tag["felhasznalonev"]?></a></div>  <br>
            <?php $szamol++;
            }
        } 
        if($szamol <5){
        for($i=0;$i<5-$szamol;$i++){?>
            <a href="/info"><div class="osszesitett" id="urescella">Üres cella</div></a> <br>
        <?php } }?>
</div>
</div>
</div>