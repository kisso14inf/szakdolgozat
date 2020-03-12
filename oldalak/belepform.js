 <script>
$(document).ready(function(){
  
    $("form[name='bejelentkezes']").validate({
    // Specify validation rules
    rules: {
      // The key name on the left side is the name attribute
      // of an input field. Validation rules are defined
      // on the right side
      
      felhasznalonev: "required",
      
      felhasznalonev:{
          required: true,
      },
      jelszo: {
        required: true,
        minlength: 5,
        maxlength: 25
        
      }
    },
    // Specify validation error messages
    messages: {
      
      felhasznalonev: "A felhasználónév mezőt üresen hagytad",
      jelszo: {
        required: "Jelszó nélkül sehol sem tudsz regisztrálni...",
        minlength: "A jelszavadnak minimum 5 karakternek kell lennie",
        maxlength: "A jelszavadnak max 25 karakternek szabad lennie"
      }
    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
      form.submit();
    }
  })
})
</script>