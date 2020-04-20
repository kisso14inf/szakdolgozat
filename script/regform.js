$(document).ready(function(){
    //A regisztráció input-jaihoz hozzákapcsolt szabályok
    $("form[name='regisztracio']").validate({
    rules: {
      
      email: "required",
      felhasznalonev: "required",
      email: {
        required: true,
        email: true
      },
      felhasznalonev:{
          required: true,
          alphanumeric: true,
          minlength: 3,
          maxlength: 18
      },
      jelszo: {
        required: true,
        alphanumeric: true,
        minlength: 5,
        maxlength: 25
        
      },
      jelszo_megegyszer: {
      equalTo: "#jelszo",
    }  
    },
    //hiba üzenetek
    messages: {
      email: "Kérlek töltsd ki, az email mezőt",
      felhasznalonev: {
        required: "A felhasználónév mezőt üresen hagytad",
        alphanumeric: "A felhasználóneved nem tartalmazhat speciális karaktereket",
        minlength: "A felhasználónevednek minimum 3 karakternek kell lennie",
        maxlength: "A felhasználónevednek maximum 18 karakternek szabad lennie"
      },
      jelszo: {
        required: "Jelszó nélkül sehol sem tudsz regisztrálni...",
        alphanumeric: "A jelszavad nem tartalmazhat speciális karaktereket",
        minlength: "A jelszavadnak minimum 5 karakternek kell lennie",
        maxlength: "A jelszavadnak max 25 karakternek szabad lennie"
      },
      jelszo_megegyszer: {
        equalTo: "A két jelszó nem egyezik"  
      },
      email: "Nem is ez az email címed... Töltsd ki rendesen"
    },
    //Csak akkor enged tovább, ha mindegyik szabálynak megfelelt.
    submitHandler: function(form) {
      form.submit();
    }
  })
})
