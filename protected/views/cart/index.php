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
                            /*$cart_temp[] = array();
                            foreach($cart->getPositions() as $item) {
                                echo "<pre>";
                                print_r($item);
                                echo "<pre>";
                                exit;
                            }*/
                            foreach($cart->getPositions() as $item) { 
                                //echo var_dump($item);
                                echo "<tr>";
                                    echo "<td style='text-align: center;' hidden='hidden'>".$item->idproductos_digitales."</td>";
                                    echo "<td style='text-align: center;'>".$item->getQuantity()."</td>";
                                    echo "<td style='text-align: center;'>".$item->nombre_producto."</td>";
                                    echo "<td style='text-align: center;'><span class='currency_selected'></span> ".number_format((float)$item->getSumPrice(), 2, '.', '')."</td>";
                                    echo "<td style='text-align: center;'>".CHtml::link('<span class="glyphicon glyphicon-trash"></span>', Yii::app()->createUrl('/cart/removeToCart', array('id_producto' => $item->idproductos_digitales, 'tipo' => '1')), array('style' => 'color: black'))."</td>";
                                    $cart_temp[] = array('idproductos_digitales' => $item->idproductos_digitales, 'qty' => $item->getQuantity(), 'descripcion_producto' => $item->nombre_producto, 'precio' => (float)$item->precio, 'tipo_de_contenido' => $item->tipo, 'id_producto' => $item->id_producto);
                                    //$cart_temp[] = array();
                            }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2" style="text-align: right;"><strong>MONTO TOTAL</strong></td>
                            <td style='text-align: center;'><span id='currency_selected_total'></span> <?php echo number_format((float)$cart->getCost(), 2, '.', ''); ?> <span id='currency_selected'></span></td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
                </div>
                <br>
                <!-- <div class="col col-xs-6 col-md-4 col-lg-6">
                    <?php 
                        //echo CHtml::dropDownList('tipo_de_moneda', 'USD', $currencies, array('empty' => 'Seleccione la moneda de pago', 'class' => 'form-control input-sm',  'onChange' => 'javascript:change_currency()' ));
                    ?> 
                </div> -->
                <!-- <div class="col col-xs-2 col-md-8 col-lg-6" style="text-align: center;"> -->
                    
                    <div class="text-center">
                        <?php if(Yii::app()->user->isGuest){ ?>
                            <button type="button" class="btn btn-sm btn-default" id="btn_pay_ips" data-toggle="tooltip" data-placement="right" title="Debe iniciar sesión antes de pagar">   <strong>
                                <?php echo CHtml::link('PAGA CON INSIGNIA', array('/site/login')); ?>

                            </strong> <?php echo CHtml::image(Yii::app()->getBaseUrl().'/images/logo_ips.png',  '', array('style' => 'width:15px; height: 25px;')); ?></button>
                        <?php }else{ ?>
                            <button type="button" class="btn btn-sm btn-warning" id="btn_pay_ips" onclick='process_payment(<?= json_encode($cart_temp); ?>, "<?= Yii::app()->user->getInfoUserIps()->email; ?>", "<?= Yii::app()->user->getInfoUserIps()->telefono; ?>");'>   <strong>PAGA CON INSIGNIA</strong> <?php echo CHtml::image(Yii::app()->getBaseUrl().'/images/logo_ips.png',  '', array('style' => 'width:15px; height: 25px;')); ?></button>
                        <?php } ?>
                        <div id="ips-container"></div>
                    </div>
                <!-- </div> -->
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