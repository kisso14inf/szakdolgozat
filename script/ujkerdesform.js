
$(document).ready(function(){
    $("form[name='ujkerdes']").validate({
        
    rules: {
      rejtett: "required",
      kerdesrov: "required",
      akerdes: "required",
      kerdesrov: {
        required: true,
        minlength: 5,
        maxlength: 150,
        //Az első betű Nagybetű legyen. Az utolsó egy kérdőjel.
        //Szerintem a többi mindegy.
        pattern:"^[A-Z][A-Za-z0-9_-\\s\\&\\,\\#\\@\\%\\=\\(\\)\\+\\{ÁÉÍÓÖŐÚÜŰáéíóöőúüű}]*[?]{1}$"
      },
      akerdes:{
        required: true,
        minlength: 5,
        maxlength: 2000
      }
      
    },
    // Specify validation error messages
    messages: {
      rejtett : "Kérlek válassz legalább egy cimkét!",
      kerdesrov: {
        required: "Ne hagyd üresen a kérdés címét!",
        minlength: "Minimum 5 karakter legyen a kérdés címe..",
        maxlength: "A kérdés címe maximum 150 karakter lehet. Majd a következő részben lesz esélyed kifejteni..",
        pattern: "A kérdés nagybetűvel kezdődjön, '?' jellel végződjön! <br> Az alábbi speciális karakterek a megengedettek <br> (_- &#%@=(),) "
      },
      akerdes: {
        required: "Ne hagyd üresen",
        minlength: "Magának a kérdés kifejtésének legalább 5 karakternek kell lennie",
        maxlength: "A kérdés kifejtéséhez maximum 2000 karakter a megengedett."
      }
    },
    submitHandler: function(form) {
      form.submit();
    }
  })
})