$(document).ready(function(){
    $("form[name='valaszelkuld']").validate({
    // Specify validation rules
        
    rules: {
      valasz: "required",
      valasz: {
        required: true,
        minlength: 5,
        maxlength: 1500
      }
    },
    messages: {
      valasz: {
        required: "Ne hagyd üresen",
        minlength: "A kérdéshez hozzáfűzött válasznak legalább 5 karakternek kell lennie",
        maxlength: "A válaszhoz maximum 1500 karakter a megengedett."
      }
    },
    submitHandler: function(form) {
      form.submit();
    }
  })
})
