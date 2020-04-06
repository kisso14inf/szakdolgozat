<script>
  
$(document).ready(function(){
    //var ures  = array{"kkk"},
    $("#gomb").click(function() { 
      var ertek = $("#exampleFormControlSelect1").val();
      
      if(ertek.length > 0){
      if($("#0").val() <1){
      $("#0").val(ertek);
      $("#0").css("visibility", "visible");
      $("#torol0").css("visibility", "visible");}
      else if($("#1").val() <1){
        $("#1").val(ertek);
        $("#1").css("visibility", "visible");
        $("#torol1").css("visibility", "visible");} 
    else if($("#2").val() <1){
          $("#2").val(ertek);
          $("#2").css("visibility", "visible");
          $("#torol2").css("visibility", "visible");} 
      else if($("#3").val() <1){
            $("#3").val(ertek);
            $("#3").css("visibility", "visible");
            $("#torol3").css("visibility", "visible");} 
      else if($("#4").val() <1){
              $("#4").val(ertek);
              $("#4").css("visibility", "visible");
              $("#torol4").css("visibility", "visible");} 
              $("#exampleFormControlSelect1 option[value='"+ertek+"']").remove();
             
            }}),
  $("#torol0").click(function(){
    var ertek = $("#0").val();
    $('#exampleFormControlSelect1').append('<option value="'+ertek+'">'+ertek+'</option>');
    $("#0").val("");
    $("#0").css("visibility", "hidden");
    $("#torol0").css("visibility", "hidden");
  }),
  $("#torol1").click(function(){
    var ertek = $("#1").val();
    $('#exampleFormControlSelect1').append('<option value="'+ertek+'">'+ertek+'</option>');
    $("#1").val("");
    $("#1").css("visibility", "hidden");
    $("#torol1").css("visibility", "hidden");
  }),
  $("#torol2").click(function(){
    var ertek = $("#2").val();
    $('#exampleFormControlSelect1').append('<option value="'+ertek+'">'+ertek+'</option>');
    $("#2").val("");
    $("#2").css("visibility", "hidden");
    $("#torol2").css("visibility", "hidden");
  }),
  $("#torol3").click(function(){
    var ertek = $("#3").val();
    $('#exampleFormControlSelect1').append('<option value="'+ertek+'">'+ertek+'</option>');
    $("#3").val("");
    $("#3").css("visibility", "hidden");
    $("#torol3").css("visibility", "hidden");
  }),
  $("#torol4").click(function(){
    var ertek = $("#4").val();
    $('#exampleFormControlSelect1').append('<option value="'+ertek+'">'+ertek+'</option>');
    $("#4").val("");
    $("#4").css("visibility", "hidden");
    $("#torol4").css("visibility", "hidden");
  })
 
})
</script>