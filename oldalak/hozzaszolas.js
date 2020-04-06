<script>
$(document).ready(function(){
  $("#valaszgomb").click(function(){
    $.post("/formfeldolgoz",
    {
      kerdes_id: $("#kerdes_id").val(),
      valaszolo_id: $("#valaszolo_id").val(),
      comment: $("#comment").val(),
    },
    $("#div1").load("/formfeldolgoz #mari")
});
});

</script>

