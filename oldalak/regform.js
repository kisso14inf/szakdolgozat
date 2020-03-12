 <script>
$(document).ready(function(){
  
    $("form[name='regisztracio']").validate({
    // Specify validation rules
    rules: {
      // The key name on the left side is the name attribute
      // of an input field. Validation rules are defined
      // on the right side
      email: "required",
      felhasznalonev: "required",
      email: {
        required: true,
        email: true
      },
      felhasznalonev:{
          required: true,
      },
      jelszo: {
        required: true,
        minlength: 5,
        maxlength: 25
        
      },
      jelszo_megegyszer: {
      equalTo: "#jelszo",
    }  
    },
    // Specify validation error messages
    messages: {
      email: "Kérlek töltsd ki, az email mezőt",
      felhasznalonev: "A felhasználónév mezőt üresen hagytad",
      jelszo: {
        required: "Jelszó nélkül sehol sem tudsz regisztrálni...",
        minlength: "A jelszavadnak minimum 5 karakternek kell lennie",
        maxlength: "A jelszavadnak max 25 karakternek szabad lennie"
      },
      jelszo_megegyszer: {
        equalTo: "Nem ugyan azt írtad be a jelszavaidhoz BRO"  
      },
      email: "Nem is ez az email címed... Töltsd ki rendesen"
    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
      form.submit();
    }
  })
})
</script>