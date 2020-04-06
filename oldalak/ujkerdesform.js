<script>
$(document).ready(function(){
    $("form[name='ujkerdes']").validate({
    // Specify validation rules
        
    rules: {
      // The key name on the left side is the name attribute
      // of an input field. Validation rules are defined
      // on the right side
      0: "required",
      kerdesrov: "required",
      akerdes: "required",
      
      akerdes:{
        required: true,
        minlength: 5,
        maxlength: 2000
      },
      kerdesrov: {
        required: true,
        minlength: 5,
        maxlength: 150
        
      }
    },
    // Specify validation error messages
    messages: {
      0 : "<b style='color: red;'>Kérlek válassz legalább egy cimkét!</b>",
      akerdes: {
        required: "",
        minlength: "Magának a kérdés kifejtésének legalább 5 karakternek kell lennie",
        maxlength: "A kérdés kifejtéséhez maximum 2000 karakter a megengedett."
      },
      kerdesrov: {
        required: "Ne hagyd üresen a kérdés címét!",
        minlength: "Minimum 5 karakter legyen a kérdés címe..",
        maxlength: "A kérdés címe maximum 150 karakter lehet. Majd a következő részben lesz esélyed kifejteni.."
      }
      
    },
    
    submitHandler: function(form) {
      form.submit();
    }
  })
})
</script>