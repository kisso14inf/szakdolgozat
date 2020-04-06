<div class="egybe">
   <div class="card">
       <div class="card-body">
       <p></p>
 <input type="text" name="cimke23" id="cimke23">
 <select id="single">
   <option>Single</option>
   <option>Single2</option>
 </select>
  
 <select id="multiple" multiple="multiple">
   <option selected="selected">Multiple</option>
   <option>Multiple2</option>
   <option selected="selected">Multiple3</option>
 </select>
  
 <script>
 function displayVals() {
   var singleValues = $( "#single" ).val();
   var multipleValues = $( "#multiple" ).val() || [];
   // When using jQuery 3:
   // var multipleValues = $( "#multiple" ).val();
   $("#cimke23").val(singleValues);
 }
  
 $( "select" ).change( displayVals );
 displayVals();
 </script>
       </div>
   </div>
</div>