$(window).on('load', function() { // makes sure the whole site is loaded 
  $('.loader').fadeOut(1200); // will first fade out the loading animation 
  $('#preloader').delay(1240).fadeOut('slow'); // will fade out the white DIV that covers the website. 
  $('body').delay(1240).css({'overflow':'visible'});
})

$("#formu").validate({ // <<< LIBRERIA JQUERY....
    rules: {
      idpay:{
                required:true,
                number:true,
                minlength:10,
                maxlength:10
            }

    },
      messages: {

            idpay: {
                    required: "Porfavor ingrese el id de compra",
                    number: "Solo numeros porfavor",
                    minlength: "10 digitos necesarios",
                    maxlength: "Maximo 10 digitos"
                    }
        },

    highlight: function(element) {
        var id_attr = "#" + $( element ).attr("id") + "1";
        $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
        $(id_attr).removeClass('glyphicon-ok').addClass('glyphicon-remove');
    },
    unhighlight: function(element) {
        var id_attr = "#" + $( element ).attr("id") + "1";
        $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
        $(id_attr).removeClass('glyphicon-remove').addClass('glyphicon-ok');
    },
    errorElement: 'span',
        errorClass: 'help-block',
        errorPlacement: function(error, element) {
            if(element.length) {
                error.insertAfter(element);
            } else {
            error.insertAfter(element);
            }
        }
 });