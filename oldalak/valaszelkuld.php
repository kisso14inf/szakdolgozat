<div class="egybe">
<?php 
//kell egy komment ide
ValaszElkuld($connection, $valasz, $kerdes_id, $valaszolo_id);
?>
<script type="text/javascript">
setTimeout(myFunction, 500);
function myFunction() {
  alert('Sikeresen válaszoltál a kérdésre. Köszönjük!');
  window.location = '/kerdes/<?=$kerdes_id?>';
}
</script>
</div>