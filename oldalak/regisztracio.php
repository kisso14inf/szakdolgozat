<div class="egybe">
 <div class="card">
  <div class="card-body">
     REGISZTRÁCIÓ
     <form action="/regisztralo" method="POST" name="regisztracio">
  <div class="form-group">
    <label for="email"></label>
    <input type="email" class="form-control" placeholder="Email cím" id="email" name="email">
    <label for="felhasznalonev"></label>
    <input type="text" class="form-control" placeholder="Felhasználónév" id="felhasznalonev" name="felhasznalonev">
    <label for="pwd"></label>
    <input type="password" class="form-control" placeholder="Jelszó" id="jelszo" name="jelszo">
    <label for="pwd"></label>
    <input type="password" class="form-control" placeholder="Jelszó mégegyszer" id="jelszo_megegyszer" name="jelszo_megegyszer" >
  </div>
  Van már fiókod? <a href="/belepes"><b>Kattints ide!</b></a> <br>
  <button type="submit" class="btn btn-primary">Regisztrálás</button>
</form>
    
     </div>
    </div>
</div>
<!-- //Ide majd egy kis feliratot is, de nem csak a regisztrációs form alá, hanem máshova is néha, ha nincs bejelentkezve.
Hogy miért jó, ha tagja valaki az oldalnak -->