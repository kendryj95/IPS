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

function process_payment(cart, email, phone){
    var items_list = [];
    var currency_code = document.getElementById('tipo_de_moneda');
    var currency_selected = currency_code.options[currency_code.selectedIndex].value;

    if(currency_selected != ""){
        for (var i = 0; i < cart.length; i++) {
            var items_in_cart = {id: cart[i].id_producto, name: cart[i].descripcion_producto, description: cart[i].descripcion_producto, price: parseFloat(cart[i].precio), quantity: cart[i].qty, type: cart[i].id_tipo_de_contenido};
            items_list[i] = items_in_cart;
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
            token: "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJleHAiOjE1MTgwMTcyNjA3MDUsImNsaWVudGUiOnsiaWQiOiJLZW5kcnkgT3J0aXpAMTIzNDU2XzE1MDkzNzcyNjA3MDUiLCJub21icmUiOiJLZW5kcnkgT3J0aXoiLCJvcmlnZW4iOiIxMjM0NTYiLCJzYyI6IjEyMzQ1NiJ9fQ.QSK7h6DjtaToZZfMzu0rn3sHD6Z0gvcHNx09LKEBPPY",
            
            purchase: {
                client: {
                    email: email,
                    telephone: phone,
                },
                currency: document.getElementById("currency_selected_total").innerHTML,
                products: items_list,
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

function change_currency(){

    var currency_code = document.getElementById('tipo_de_moneda');
    if(currency_code != null){
        var currency_selected = currency_code.options[currency_code.selectedIndex].value;

        var newCurrency = document.getElementsByClassName('currency_selected');

        for (var i = 0; i < newCurrency.length; i++) {
            newCurrency[i].innerHTML = currency_selected;
        }
        
        //newCurrency.innerHTML = currency_selected;

        //document.getElementsByClassName('currency_selected')[0].innerHTML = currency_selected;
        //document.getElementById("currency_selected").innerHTML = currency_selected;
        document.getElementById("currency_selected_total").innerHTML = currency_selected;    
    }
    
}