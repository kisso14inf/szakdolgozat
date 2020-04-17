<div class="egybe">
    <div class="card">
        <div class="card-body">
            <h3>Profil</h3> <br>
            <div style="width:100%;overflow:hidden;">
                <div id="profilbal"></div>
                <div id="profiljobb">
                    Felhasználónév: <?=$felhasznalonev?>  <br>
                    Email: <?php echo (isset($_COOKIE["felhasznalonev"])) ? FelhasznaloAdat("felhasznalonev",$felhasznalonev)[0]["email"] : "Rejtve van"; ?> <br>
                    Kérdések száma: <?=count(FelhasznaloKerdes("felhasznalo",FelhasznaloAdat("felhasznalonev",$felhasznalonev)[0]["id"]))?> <br>
                    Válaszok száma: <?=count(FelhasznaloValasz("felhasznalo",FelhasznaloAdat("felhasznalonev",$felhasznalonev)[0]["id"]))?> <br>
                    Értékelések száma: <?=count(FelhasznaloErtekeles("felhasznalo",FelhasznaloAdat("felhasznalonev",$felhasznalonev)[0]["id"]))?> <br>
                    A legtöbbet használt címke: 
                    <?php  
                       $cimkeTomb = array();
                       $felhasznaloKerdesek = FelhasznaloKerdes("felhasznalo",FelhasznaloAdat("felhasznalonev",$felhasznalonev)[0]["id"]);
                            foreach($felhasznaloKerdesek as $felhasznaloKerdes){
                                $KerdesCimkek = KerdesCimke("kerdes", $felhasznaloKerdes["kerdes_id"]);
                             foreach($KerdesCimkek as $KerdesCimke){
                                    $kc = $KerdesCimke["cimke_id"];
                                    if(array_key_exists($kc,$cimkeTomb)){
                                        $ertek = $cimkeTomb[$kc];
                                        $ertek++;
                                        $cimkeTomb[$kc] = $ertek;
                                    }
                                    else{
                                        $ertek=1;
                                        $cserelendoTomb = array($kc=>$ertek);
                                        $cimkeTomb[$kc] = $ertek;
                                    }
                                }
                            }
                            arsort($cimkeTomb);
                            $szamol = 0;
                            foreach ($cimkeTomb as $key => $value) {
                                if($szamol<1){?>
                                <div class="osszesitett" id="cimke"><a href="/cimke/<?=CimkeAdat("id",$key)[0]["megnevezes"]?>">#<?=CimkeAdat("id",$key)[0]["megnevezes"]?></a></div> 
                                <?php $szamol++;}
                            }?>
                </div>
            </div>
        </div>
    </div>
</div>