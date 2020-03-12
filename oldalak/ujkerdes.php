<div class="egybe">
 <div class="card">
  <div class="card-body">
     ÚJ KÉRDÉS <br>
     A kérdés röviden
     
     A kérdés hosszan
     Címkék(Max 5 címke)
     <form action="/ujkerdeselkuld.php" method="POST">
  <div class="form-group">
    <label for="email">A kérdés röviden</label>
    <input type="email" class="form-control" placeholder="A kérdés röviden..." id="email">
  </div>
  <div class="form-group">
    <label for="pwd">A kérdés kifejtése</label>
    <textarea class="form-control" rows="4" id="comment" placeholder="A kérdés kifejtésének helye. (Min 15karakter, Maximum 1500)"></textarea>
  </div>
  <div class="form-group">
    <input type="text" class="form-control" placeholder="#Címke1 #Címke2 #Címke3" id="pwd">
    
  </div>
  <button type="submit" class="btn btn-primary float-right">Küldés</button>
</form>
     </div>
    </div>
</div>