<?php
Yii::import('application.extensions.shoppingCart.ECartPositionBehaviour');

class CartController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/cart/pages'
			// They can be accessed via: index.php?r=cart/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	public function filters() {
	    return array(
	        
	        array('booster.filters.BoosterFilter')
	    );
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex() {
		$count_items = Yii::app()->shoppingCart->getCount();
		$cart = Yii::app()->shoppingCart;
		/*echo "<pre>";
		$positions = Yii::app()->shoppingCart->getPositions();
		foreach($positions as $position) {
			print_r($position);
		}
		echo "</pre>";
		exit;*/
		/*echo "<pre>";
		print_r($cart->getPositions());
		echo "</pre>";
		exit;*/
		$currencies = CHtml::listData(TipoDeMonedas::model()->findAll("estatus=1"), 'abreviatura', 'descripcion');

		$this->render('index', array('cart' => $cart, 'count_items' => $count_items, 'currencies' => $currencies));
	}

	/***************************************************************************************************************************************/	
	/*** 
		Yii::app()->shoppingCart->clear(); // Limpia el carrito
		$book = ProductosDigitales::model()->findByPk(1);
		Yii::app()->shoppingCart->put($book); //1 item with id=1, quantity=1.
		Yii::app()->shoppingCart->put($book,2); //1 item with id=1, quantity=3.
		$book2 = ProductosDigitales::model()->findByPk(2);
		Yii::app()->shoppingCart->put($book2); //2 items with id=1 and id=2.

		Yii::app()->shoppingCart->remove($book->getId()); // Elimina un elemento del carrito por su id

		Yii::app()->shoppingCart->getCount(); // Cantidad de productos diferentes
		Yii::app()->shoppingCart->getItemsCount(); // Cantidad total de productos
		Yii::app()->shoppingCart->getCost(); // Total
		
		Yii::app()->shoppingCart->itemAt(0); // ------------------------------------------> NO SIRVE
		Yii::app()->shoppingCart->isEmpty(); // ------------------------------------------> NO SIRVE
		

		TODO EL CARRITO
		echo "<pre>";
		$positions = Yii::app()->shoppingCart->getPositions();
		foreach($positions as $position) {
			print_r($position);
		}
		echo "</pre>";

		PRECIO DE CADA ITEM EN EL CARRITO
		$positions = Yii::app()->shoppingCart->getPositions();
		foreach($positions as $position) {
			$price = $position->getPrice();
			//echo "<br>".$price;
		}

		PRECIO DE CADA ITEM EN EL CARRITO POR LA CANTIDAD AÑADIDA
		foreach($positions as $position) {
			$price = $position->getSumPrice(); //200 (2*100)
			//echo "<br>".$price;
		}
	***/

	public function actionAddToCart($id_producto = null, $paqueteSaldo = null, $categoria = null){		
		if($id_producto == null){
			if(isset($_POST['id_producto'])){
				$id_producto = $_POST['id_producto'];
			}
		}

		//ProductosDigitales::model()->findallbyattr('idproductos_digitales',$id_producto);

		$p = new ProductosDigitales();

		if ($id_producto != null) {
			
			$producto = ProductosDigitales::model()->findallbyattr(1, 'idproductos_digitales',$id_producto); //ProductosDigitales::model()->findByPk($id_producto);

			$p->breve_descripcion = $producto[0]['breve_descripcion'];
			$p->nombre_producto = $producto[0]['nombre_producto'];
			$p->precio = $producto[0]['precio'];
			$p->abrev_tipo = $producto[0]['abrev_tipo'];
			$p->deporte = $producto[0]['deporte'];
			$p->categoria = $producto[0]['categoria'];
			$p->abrev_deporte = $producto[0]['abrev_deporte'];
			$p->idproductos_digitales = $producto[0]['idproductos_digitales'];
			$p->id_producto = $producto[0]['id_producto_sms'];
			$p->tipo_contenido = $producto[0]['tipo_contenido'];
		} else {
			$getPaqueteSaldo = PaquetesSaldos::model()->findByPk($paqueteSaldo);

			$p->breve_descripcion = "Compra de saldo IPS de $".$getPaqueteSaldo->saldo;
			$p->nombre_producto = "saldo_".$getPaqueteSaldo->saldo;
			$p->precio = $getPaqueteSaldo->saldo;
			$p->abrev_tipo = "Saldo IPS";
			$p->deporte = "No aplica";
			$p->categoria = "No aplica";
			$p->abrev_deporte = "No aplica";
			$p->idproductos_digitales = $getPaqueteSaldo->id;
			$p->id_producto = $getPaqueteSaldo->id;
			$p->tipo_contenido = "saldo";
		}
		

		Yii::app()->shoppingCart->put($p);
		if ($p->tipo_contenido != "saldo") {
			$this->redirect(Yii::app()->createUrl('site/prod_categoria', array('cat' => $categoria)));
		} else {
			$this->redirect(Yii::app()->createUrl('paquetesSaldos/index'));
		}
		
	}

	public function actionRemoveToCart($id_producto = null, $tipo = null, $prodIsSaldo = null){
		if($tipo == null){
			if (isset($_POST['tipo'])) {
				$tipo = $_POST['tipo'];
			}
		}
		$removeProd = null;
		if($tipo == 1){
			if($id_producto == null){
				if(isset($_POST['id_producto'])){
					$id_producto = $_POST['id_producto'];
				}
			}

			if ($prodIsSaldo != null && $prodIsSaldo) { // Valido si el producto en el carrito es de tipo saldo o no.
				$paqueteSaldo = PaquetesSaldos::model()->findByPk($id_producto);
				$removeProd = 'digital_products'.$paqueteSaldo->id;
			} else {
				$producto = ProductosDigitales::model()->findByPk($id_producto);
				$removeProd = $producto->getId();
			}

			Yii::app()->shoppingCart->remove($removeProd);
			$this->actionIndex();
		}else{
			Yii::app()->shoppingCart->clear();
			$this->redirect(Yii::app()->user->returnUrl);
		}
	}
}