<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand" href="/">GyakoriKérdések</a>

  <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item active">
        <a class="nav-link" href="/tema">Témák<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
       
        <a class="nav-link" href="/kerdes/<?=VeletlenSzam()?>">Egy véletlen kérdés</a>
        </li>
    </ul>
    <!-- Meg kell nyitni egy oldalt, pl.: /kereses/ki-ez-a-cigany-ha részen.-->
    <!--  Szerintem nem is form (POST-tal) kellene ezt megcsinálni-->
    
    
      <input class="form-control mr-sm-2" style="width:200px;" type="search" placeholder="Írd be a kulcsszavakat" aria-label="Search" id="k" onkeyup="Gepel();">
      <button class="btn btn-outline-success my-2 my-sm-0" style="margin-right:5px;" type="submit" onclick="KeresesMegnyom();">Keresés</button>
    <?=$menusav[0]?>
  </div>
</nav>
<script>
function KeresesMegnyom(){
  var value = $("#k").val().replace(/\s/g, '_');
  location.href = "/kereses/" + value;
}
</script>