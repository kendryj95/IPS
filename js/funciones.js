
var currencyTemp = '';

$(document).ready(function() {
    $("#table-cart").DataTable({
        "language": {
            "emptyTable": "No hay registros disponibles",//tabla vacia
            "zeroRecords": "No hay registros disponibles para la consulta",
            "loadingRecords": "Espere un momento, cargando...",
            "search": "Buscar",
            "lengthMenu": "Desplegar _MENU_ registros por p&aacute;gina",
            "info": "Mostrando p&aacute;gina _PAGE_ de _PAGES_",
            "infoEmpty": "No se encuentra la informaci&oacute;n requerida",
            "infoFiltered": "(Filtrada de _MAX_ registros en total)",
            "paginate": {
                "first": "Primera",
                "last": "&Uacute;ltima",
                "next": "Sig",
                "previous": "Ant"
            }
        }
    });
    change_currency();

});

function getVariableURL(variable) {
    // Estoy asumiendo que query es window.location.search.substring(1);
    var query = window.location.search.substring(1);
    var vars = query.split("&");
    //alert(vars);
    for (var i=0; i < vars.length; i++) {
        var pair = vars[i].split("="); 
        if (pair[0] == variable) {
            return pair[1];
        }
    }
    return false;
}

function process_payment(cart, email, phone,dolartoday){ // parametros .. el parametro cart es un Json un array con los datos traidos de la base
    // de datos.. id_producto, descripcion del producto, precio, tipo de contenido. el parametro email si es un solo dato.. igual phone
    var items_list = [];
    //var currency_code = document.getElementById('tipo_de_moneda');
    //var currency_selected = currency_code.options[currency_code.selectedIndex].value;
    var currency_selected = "USD";

    var cur=document.getElementById("currency_selected_total").innerHTML;// ej: VEF
    
    if(currency_selected != ""){
        if (cur=="VEF") { // valido si la moneda elegida del select es vef, entonces multiplico los price de cada producto por el valor del dolar today..
             for (var i = 0; i < cart.length; i++) {
                var items_in_cart = {id: cart[i].id_producto, name: cart[i].descripcion_producto, description: cart[i].descripcion_producto, price: parseFloat(cart[i].precio)*dolartoday, quantity: cart[i].qty, type: cart[i].id_tipo_de_contenido};
                items_list[i] = items_in_cart;
             }

        }else{

        for (var i = 0; i < cart.length; i++) {
            var items_in_cart = {id: cart[i].id_producto, name: cart[i].descripcion_producto, description: cart[i].descripcion_producto, price: parseFloat(cart[i].precio), quantity: cart[i].qty, type: cart[i].id_tipo_de_contenido};
            items_list[i] = items_in_cart;
        }
        }
        //return false;
        /*console.log({
            token: "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJleHAiOjE1MDM4NTY5NDAxMTMsImNsaWVudGUiOnsiaWQiOiJJTUNASVBTXzk4NzMyMV8xNDk1MjE2OTQwMTEzIiwibm9tYnJlIjoiSU1DIiwib3JpZ2VuIjoiSVBTXzk4NzMyMSIsInNjIjoiSVBTXzk4NzMyMSJ9fQ.1LC_3QedkoK0Ud0_woL7POYQK9pZZDRGoO8ms7uDGYQ",
            
            purchase: {
                client: {
                    email: email,
                    telephone: phone,
                },
                currency: document.getElementById("currency_selected").innerHTML,
                products: items_list,
            }
        });*/
        

        IPS.purchase.pay({
            token: "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJleHAiOjE1MjY3MzIwMjYwMzksImNsaWVudGUiOnsiaWQiOiJLZW5kcnkgT3J0aXpAMTIzNDU2XzE1MTgwOTIwMjYwNTQiLCJub21icmUiOiJLZW5kcnkgT3J0aXoiLCJvcmlnZW4iOiIxMjM0NTYiLCJzYyI6IjEyMzQ1NiJ9fQ.acDNhLlcv4IgdpEDaVmBG4-Mc8G6E2Z6tBULPcfxlho",
            
            purchase: {
                client: {
                    email: email,
                    telephone: phone,
                },
                currency:cur,
                products: items_list,
                conversion:dolartoday
            }
            
        }, 'http://localhost/IPS/K3KPgBrvwQAAiHdIXsZVMEM5dnF8xj7STUtCbDSa_bI', 'ips-container');
        
        //http://localhost:8080/IPS/K3KPgBrvwQAAiHdIXsZVMEM5dnF8xj7STUtCbDSa_bI
        /*IPS.purchase.pay({
            token: "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJleHAiOjE1MDM4NTY5NDAxMTMsImNsaWVudGUiOnsiaWQiOiJJTUNASVBTXzk4NzMyMV8xNDk1MjE2OTQwMTEzIiwibm9tYnJlIjoiSU1DIiwib3JpZ2VuIjoiSVBTXzk4NzMyMSIsInNjIjoiSVBTXzk4NzMyMSJ9fQ.1LC_3QedkoK0Ud0_woL7POYQK9pZZDRGoO8ms7uDGYQ",
            purchase: {
                currency: document.getElementById("currency_selected_total").innerHTML,
                locale: "es_VE",
                client: {
                    email: email,
                    telephone: "+18085550167",
                },
                products: items_list
                /*products: [
                        {
                                id: 37064,
                                name: "Resultados hípicos",
                                description: "Resultados hipicos de la semana.",
                                price: 1.20878416579813,
                                quantity: 12,
                                type: "TEXTO"
                        },
                        {
                                id: 37064,
                                name: "SAJDHASKD",
                                description: "asjkdhasjkhdjkashdkasjhdasd",
                                price: 8.3541657654687457,
                                quantity: 2,
                                type: "TEXTO"
                        }
                ]
            }
    },
    
    'development',
    'http://192.168.1.46/ips/lib/success.html?beta=123456',
    'ips-container',
    'comprar'
    );*/

    }else{
        //alert("Debe elegir una moneda para pagar");
        swal(
          'Error',
          'Debe elegir una moneda para pagar',
          'error'
        )
    }  
}

function change_currency(dolartoday){

    var currency_code = document.getElementById('tipo_de_moneda');
      
      if(currency_code != null){
          var currency_selected = currency_code.options[currency_code.selectedIndex].value;

          var newCurrency = document.getElementsByClassName('currency_selected');
          var newPrice = document.getElementsByClassName('pri');
          var total = document.getElementById('hola').innerText;
          

          for (var i = 0; i < newCurrency.length; i++) {
              newCurrency[i].innerHTML = currency_selected;
              if (currency_selected == "VEF") {
                  currencyTemp = "VEF";
                  newPrice[i].innerHTML = (parseInt(newPrice[i].innerText) * dolartoday).toFixed(2);
              } else {
                  
                  if (currencyTemp == "VEF") {
                      newPrice[i].innerHTML = (parseInt(newPrice[i].innerText) / dolartoday).toFixed(2);
                  }
              } 
          }

          if (currency_selected=="VEF") {
            totalito=(total*dolartoday).toFixed(2);
            currTemp = "VEF";
            document.getElementById("hola").innerHTML=totalito;
          }else{
            if (currTemp=="VEF") {
                totalito=(total/dolartoday).toFixed(2);
                document.getElementById("hola").innerHTML=totalito;
            }
          }


          document.getElementById("currency_selected_total").innerHTML = currency_selected;    
           if (currency_selected=="VEF") {
             document.getElementById("msj").innerHTML = "<center><label class='alert alert-info'>SU CONVERSIÓN HA SIDO REALIZADA POR EL VALOR DEL DOLAR DICOM</label></center>";
         }else{
             document.getElementById("msj").innerHTML = "";
                   
         }
      }
    
}