<?php
$url= "https://s3.amazonaws.com/dolartoday/data.json";
$hola=utf8_encode($json =file_get_contents($url));
if ($hola!=500) {
    # code...

$json=json_decode($hola);
//var_dump($json = json_decode($json));

$promedio= $json->USD->promedio_real;
}else{
    $promedio=123;
}
 ?>

<script>
    /*$(document).ready(function(){
        $('.paginate_button.active > a').css({'backgroundColor':'#C30B13','borderColor':'#C30B13'});
    });*/
</script>
<div  id="page-content-wrapper">
    <?php
        /* @var $this SiteController */
        $this->pageTitle=Yii::app()->name . ' - Carrito';
        $baseUrl = Yii::app()->baseUrl; 
        Yii::app()->clientScript->registerScriptFile($baseUrl.'/js/funciones.js');
        if($count_items > 0){ 
    ?>
            <h2 style="text-align: center;">Resumen del pedido</h2>
            <hr>
            <div>
                <?php 
                    echo CHtml::link('<span class="glyphicon glyphicon-trash"></span> Limpiar carrito', Yii::app()->createUrl('/cart/removeToCart', array('tipo' => '2')), array('class' => 'btn btn-sm btn-primaryIPS'));
                ?>    
            </div>
            <br><br>
            <div>
               <div class="table-responsive">     
                <table id="table-cart" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead class="tableHover">
                        <tr>
                            <th style="text-align: center;" hidden='hidden'>C&oacute;digo</th>
                            <th style="text-align: center;">Cantidad</th>
                            <th style="text-align: center;">Descripci&oacute;n</th>
                            <th style="text-align: center;">Precio</th>
                            <th style="text-align: center;">Acci&oacute;n</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                            foreach($cart->getPositions() as $item) { 
                                //echo var_dump($item);
                                $isSaldo = $item->tipo_contenido == 'saldo' ? true : false; // Valido si el item es un producto de tipo saldo o es un producto digital.
                                echo "<tr>";
                                    echo "<td style='text-align: center;' hidden='hidden'>".$item->idproductos_digitales."</td>";
                                    echo "<td style='text-align: center;'>".$item->getQuantity()."</td>";
                                    echo "<td style='text-align: center;'>".$item->nombre_producto."</td>";
                                    echo "<td style='text-align: center;' ><span class='currency_selected'></span><span class='pri'>".number_format((float)$item->getSumPrice(), 2, '.', '')."</span></td>";
                                    echo "<td style='text-align: center;'>".CHtml::link('<span class="glyphicon glyphicon-trash"></span>', Yii::app()->createUrl('/cart/removeToCart', array('id_producto' => $item->idproductos_digitales, 'tipo' => '1', 'prodIsSaldo' => $isSaldo)), array('style' => 'color: black'))."</td>";
                                    $cart_temp[] = array('idproductos_digitales' => $item->idproductos_digitales.'_'.$item->tipo_contenido, 'qty' => $item->getQuantity(), 'descripcion_producto' => $item->nombre_producto, 'precio' => (float)$item->precio, 'tipo_de_contenido' => $item->tipo_contenido, 'id_producto' => $item->id_producto);
                                    //$cart_temp[] = array();
                            }

                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2" style="text-align: right;"><strong>MONTO TOTAL</strong></td>
                            <td style='text-align: center;'><span id='currency_selected_total'></span><span id="hola"><?php echo number_format((float)$cart->getCost(), 2, '.', ''); ?> </span><span id='currency_selected'></span></td>
                            <td></td>
                        </tr>
                        <span id='msj'></span>
                    </tfoot>
                </table>
                </div>
                <br>
                
                <?php
                    
                    if (!Yii::app()->user->isGuest) {
                        $monto_total = number_format((float)$cart->getCost(), 2, '.', '');
                        $saldoUserIPS = number_format(Yii::app()->user->getState("saldo_ips"),2,'.','');
                        $diff_saldo = $saldoUserIPS - $monto_total;
                    }
                ?>

                 <div class="col col-xs-4 col-md-4 col-lg-4">
                   <select class="form-control input-sm" onChange='change_currency(<?php echo $promedio;?>)' type="hidden" name="tipo_de_moneda" id="tipo_de_moneda"/>
                        <option value="" selected disabled >Seleccione la moneda de pago</option>
                        <option value="VEF">Bolivares Fuertes</option>
                        <option value="USD" selected="selected">Dólar estadounidense</option>
                    </select> 

                </div> 
                <div class="col col-xs-2 col-md-8 col-lg-6" style="text-align: center;">
                    <div class="text-center">
                        <?php if(Yii::app()->user->isGuest): ?>
                            <button type="button" class="btn btn-sm btn-default" id="btn_pay_ips" data-toggle="tooltip" data-placement="right" title="Debe iniciar sesión antes de pagar">   <strong>Facturar</strong> <?php echo CHtml::image(Yii::app()->getBaseUrl().'/images/logo_ips.png',  '', array('style' => 'width:15px; height: 25px;')); ?></button>
                        <?php else: ?>
                            <a type="button" href="javascript:void(0)" class="btn btn-sm btn-warning" id="" data-toggle="modal" data-target=".facturar">   <strong>Facturar</strong> <?php echo CHtml::image(Yii::app()->getBaseUrl().'/images/logo_ips.png',  '', array('style' => 'width:15px; height: 25px;')); ?>
                            </a>
                        <?php endif; ?>
                        <div id="ips-container"></div>
                    </div>
                </div>
            </div>
    <?php } else { ?>
                <div class="container">
                    <div class="row">
                        <div class="col-md-3" style="text-align: center;">
                            <img src="images/cart_empty.png"  alt="Shopping Cart" width="200" height="200">
                        </div>
                        <div class="col-md-9">
                            <h2>Oops!</h2>
                            <h3>No hay productos en el carrito.</h3>
                        </div>
                    </div>
                </div>
    <?php } ?>
</div>

<div class="modal fade facturar" tabindex="-1" role="dialog" aria-labelledby="prueba">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header modal-headerIPS">
            <a class="close" data-dismiss="modal">&times;</a>
            <h4>Facturar</h4>
        </div>
     
        <div class="modal-body" style="background: #EDECED;">
            <div class="text-center">
            <?php if(!Yii::app()->user->isGuest): ?>
                <?php if(@$diff_saldo < 0): ?> <!-- Valido si el saldo no es suficiente para realizar su compra -->
                    <button style="height: 37px" type="button" class="btn btn-sm btn-default" id="btn_pay_ips" data-toggle="tooltip" data-placement="left" title="No tienes saldo suficiente para pagar con tus fondos">   <strong>PAGA CON TU SALDO</strong> <i class="fa fa-money fa-2x" aria-hidden="true" style="font-size: 1.5em; color: brown"></i>
                    </button>
                <?php else: ?>
                    <button type="button" class="btn btn-sm btn-primary" id="" onclick='process_payment(<?= json_encode(@$cart_temp); ?>, "<?= Yii::app()->user->getInfoUserIps()->email; ?>", "<?= Yii::app()->user->getInfoUserIps()->telefono; ?>");'> <strong>PAGA CON TU SALDO</strong>  <i class="fa fa-money fa-2x" aria-hidden="true" style="font-size: 1.5em; color: brown"></i>
                    </button>
                <?php endif; ?>
                    <button type="button" class="btn btn-sm btn-warning" id="btn_pay_ips" onclick='process_payment(<?= json_encode(@$cart_temp); ?>, "<?= Yii::app()->user->getInfoUserIps()->email; ?>", "<?= Yii::app()->user->getInfoUserIps()->telefono; ?>",<?php echo json_encode($promedio);?>);'>   <strong>PAGA CON INSIGNIA</strong> <?php echo CHtml::image(Yii::app()->getBaseUrl().'/images/logo_ips.png',  '', array('style' => 'width:15px; height: 25px;')); ?>
                    </button>
            <?php endif; ?>

           
            </div>
        </div>
    </div>
  </div>
</div>