<script>
var tomb = [];
var inputTomb = ["#0","#1","#2","#3","#4"];
var inputTorol = ["#torol0","#torol1","#torol2","#torol3","#torol4"];
$(document).ready(function(){
    //var ures  = array{"kkk"},
    $("#gomb").click(function() { 
      var ertek = $("#exampleFormControlSelect1").val();
      
      
      /*for(var i=0;i<inputTomb.length;i++){
        if($(inputTomb[i]).val().length>0) tomb.push($(inputTomb[i]).val());
      }*/
      if(tomb.length<5 && ertek.length > 0){
        tomb.push(ertek);
      for(var i=0;i<tomb.length;i++){
        $(inputTomb[i]).val(tomb[i]);
        $(inputTomb[i]).css("visibility", "visible");
        $(inputTorol[i]).css("visibility", "visible");
      }
      $("#rejtett").val($("#0").val());
      $("#exampleFormControlSelect1 option[value='"+ertek+"']").remove();}
      }),
  $("#torol0").click(function(){
    var ertek = $("#0").val();
    $('#exampleFormControlSelect1').append('<option value="'+ertek+'">'+ertek+'</option>');
    /*$("#0").val("");
    $("#0").css("visibility", "hidden");
    $("#torol0").css("visibility", "hidden");*/
    tomb = $.grep(tomb, function(value) {
      return value != ertek;
    });
    /*
      itt azt csinálom, ha pl. két(1) elemű a tömb
      #0 input megkapja a tomb[0] értékét.
      #0 látható lesz.
      #torol0 látható lesz
    */
    
    for(var i=0;i<5;i++){
      if(tomb.length > i){
      $(inputTomb[i]).val(tomb[i]);
      $(inputTomb[i]).css("visibility", "visible");
      $(inputTorol[i]).css("visibility", "visible");
      }
      else{
        $(inputTomb[i]).val("");
        $(inputTomb[i]).css("visibility", "hidden");
        $(inputTorol[i]).css("visibility", "hidden");
      }
    }
    $("#rejtett").val($("#0").val());
  }),
  $("#torol1").click(function(){
    var ertek = $("#1").val();
    $('#exampleFormControlSelect1').append('<option value="'+ertek+'">'+ertek+'</option>');
    /*$("#1").val("");
    $("#1").css("visibility", "hidden");
    $("#torol1").css("visibility", "hidden");*/
    tomb = $.grep(tomb, function(value) {
      return value != ertek;
    });
    for(var i=0;i<5;i++){
      if(tomb.length > i){
      $(inputTomb[i]).val(tomb[i]);
      $(inputTomb[i]).css("visibility", "visible");
      $(inputTorol[i]).css("visibility", "visible");
      }
      else{
        $(inputTomb[i]).val("");
        $(inputTomb[i]).css("visibility", "hidden");
        $(inputTorol[i]).css("visibility", "hidden");
      }
    }
    
  }),
  $("#torol2").click(function(){
    var ertek = $("#2").val();
    $('#exampleFormControlSelect1').append('<option value="'+ertek+'">'+ertek+'</option>');
    /*$("#2").val("");
    $("#2").css("visibility", "hidden");
    $("#torol2").css("visibility", "hidden");*/
    tomb = $.grep(tomb, function(value) {
      return value != ertek;
    });
    for(var i=0;i<5;i++){
      if(tomb.length > i){
      $(inputTomb[i]).val(tomb[i]);
      $(inputTomb[i]).css("visibility", "visible");
      $(inputTorol[i]).css("visibility", "visible");
      }
      else{
        $(inputTomb[i]).val("");
        $(inputTomb[i]).css("visibility", "hidden");
        $(inputTorol[i]).css("visibility", "hidden");
      }
    }
  }),
  $("#torol3").click(function(){
    var ertek = $("#3").val();
    $('#exampleFormControlSelect1').append('<option value="'+ertek+'">'+ertek+'</option>');
   /* $("#3").val("");
    $("#3").css("visibility", "hidden");
    $("#torol3").css("visibility", "hidden");*/
    tomb = $.grep(tomb, function(value) {
      return value != ertek;
    });
    for(var i=0;i<5;i++){
      if(tomb.length > i){
      $(inputTomb[i]).val(tomb[i]);
      $(inputTomb[i]).css("visibility", "visible");
      $(inputTorol[i]).css("visibility", "visible");
      }
      else{
        $(inputTomb[i]).val("");
        $(inputTomb[i]).css("visibility", "hidden");
        $(inputTorol[i]).css("visibility", "hidden");
      }
    }
  }),
  $("#torol4").click(function(){
    var ertek = $("#4").val();
    $('#exampleFormControlSelect1').append('<option value="'+ertek+'">'+ertek+'</option>');
    /*$("#4").val("");
    $("#4").css("visibility", "hidden");
    $("#torol4").css("visibility", "hidden");*/
    tomb = $.grep(tomb, function(value) {
      return value != ertek;
    });
    for(var i=0;i<5;i++){
      if(tomb.length > i){
      $(inputTomb[i]).val(tomb[i]);
      $(inputTomb[i]).css("visibility", "visible");
      $(inputTorol[i]).css("visibility", "visible");
      }
      else{
        $(inputTomb[i]).val("");
        $(inputTomb[i]).css("visibility", "hidden");
        $(inputTorol[i]).css("visibility", "hidden");
      }
    }
  })
 
})
</script>