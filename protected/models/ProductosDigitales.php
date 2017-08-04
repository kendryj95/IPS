<?php
Yii::import('application.extensions.shoppingCart.IECartPosition');
/**
 * This is the model class for table "productos_digitales".
 *
 * The followings are the available columns in table 'productos_digitales':
 * @property integer $idproductos_digitales
 * @property string $id_producto
 * @property integer $id_categoria
 * @property integer $tipo
 * @property string $contenido_texto
 * @property string $nombre_archivo
 * @property string $contenido_archivo
 * @property string $tipo_contenido
 */

class ProductosDigitales extends CActiveRecord implements IECartPosition
{
	/**
	 * @return string the associated database table name
	 */

	public $breve_descripcion;
	public $nombre_producto;
	public $precio;
	public $abrev_tipo;
	public $deporte;
	public $categoria;
	public $abrev_deporte;
	public $idproductos_digitales;
	public $id_producto;
	public $tipo_contenido;

	public function tableName()
	{
		return 'productos_digitales';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_producto, id_categoria, tipo', 'required'),
			array('id_categoria, tipo', 'numerical', 'integerOnly'=>true),
			array('id_producto', 'length', 'max'=>250),
			array('contenido_texto', 'length', 'max'=>255),
			array('nombre_archivo', 'length', 'max'=>100),
			array('tipo_contenido', 'length', 'max'=>45),
			array('contenido_archivo', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idproductos_digitales, id_producto, id_categoria, tipo, contenido_texto, nombre_archivo, contenido_archivo, tipo_contenido', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idproductos_digitales' => 'Idproductos Digitales',
			'id_producto' => 'Id Producto',
			'id_categoria' => 'Id Categoria',
			'tipo' => 'Tipo',
			'contenido_texto' => 'Contenido Texto',
			'nombre_archivo' => 'Nombre Archivo',
			'contenido_archivo' => 'Contenido Archivo',
			'tipo_contenido' => 'Tipo Contenido',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('idproductos_digitales',$this->idproductos_digitales);
		$criteria->compare('id_producto',$this->id_producto,true);
		$criteria->compare('id_categoria',$this->id_categoria);
		$criteria->compare('tipo',$this->tipo);
		$criteria->compare('contenido_texto',$this->contenido_texto,true);
		$criteria->compare('nombre_archivo',$this->nombre_archivo,true);
		$criteria->compare('contenido_archivo',$this->contenido_archivo,true);
		$criteria->compare('tipo_contenido',$this->tipo_contenido,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ProductosDigitales the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getId(){
        return 'digital_products'.$this->idproductos_digitales;
    }

    public function getPrice(){
        return $this->precio;
    }

	public function findallbyattr($tipo = null, $valor = null){
		
		$productos = array();
		$condition = "";

		if($tipo != null){
			$condition = " AND ".$tipo." IN(".$valor.")";	
		}
		
		/*$sql = "SELECT p.idproductos_digitales, p.id_producto, p.descripcion  AS descripcion_producto, pp.cliente, pp.usuario, t.descripcion, t.abreviacion, pm.id_metodo_de_pago, p.id_categoria, p.precio
				FROM productos_digitales p, tipo_contenido t, categorias_contenido c, metodos_de_pago pm, sms.producto pp
				WHERE pp.id_producto IN(p.id_producto) AND t.id_tipo_de_contenido = p.id_tipo_de_contenido AND p.id_categoria = c.idcategorias_contenido AND p.id_metodo_de_pago = pm.id_metodo_de_pago".$condition;*/

		$sql = "SELECT pd.idproductos_digitales, pd.id_producto AS id_producto_sms, pd.contenido_texto AS breve_descripcion, p.desc_producto AS nombre_producto, pr.precio, tc.descripcion AS tipo_contenido, tc.abreviatura AS abrev_tipo, cc.deporte, cc.descripcion AS categoria, cc.abreviatura AS abrev_deporte FROM productos_digitales pd, precios_productos_digitales pr, tipo_contenido tc, categorias_contenido cc,  sms.producto p WHERE pd.id_producto = pr.id_producto AND pr.estatus = 1 AND p.id_producto IN(pd.id_producto) AND pd.tipo = tc.id_tipo_de_contenido AND pd.id_categoria = cc.idcategorias_contenido ".$condition." GROUP BY p.id_producto";

		$list_productos = Yii::app()->db->createCommand($sql)->queryAll();

		foreach($list_productos as $data){
		    $productos[] = $data;
		}
		/*echo "<pre>";
		print_r($productos);
		echo "</pre>";
		exit;*/
		return $productos;
	}
}
