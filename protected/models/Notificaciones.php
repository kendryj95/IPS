<?php

/**
 * This is the model class for table "notificaciones".
 *
 * The followings are the available columns in table 'notificaciones':
 * @property integer $id_notificacion
 * @property integer $idusuario_ips
 * @property integer $id_cliente
 * @property string $asunto
 * @property string $mensaje
 * @property string $fecha
 * @property string $hora
 * @property integer $estado
 */
class Notificaciones extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'notificaciones';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idusuario_ips, id_compra, asunto, mensaje, fecha, hora', 'required'),
			array('idusuario_ips, estado', 'numerical', 'integerOnly'=>true),
			array('id_compra', 'length', 'max'=>145),
			array('asunto', 'length', 'max'=>50),
			array('mensaje', 'length', 'max'=>2000),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_notificacion, idusuario_ips, id_compra, asunto, mensaje, fecha, hora, estado', 'safe', 'on'=>'search'),
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
			'id_notificacion' => 'Notificacion',
			'idusuario_ips' => 'Usuario',
			'asunto' => 'Asunto',
			'mensaje' => 'Mensaje',
			'fecha' => 'Fecha',
			'hora' => 'Hora',
			'estado' => 'Estado',
			'id_compra' => 'Ticket'
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

		$criteria->compare('id_notificacion',$this->id_notificacion);
		$criteria->compare('idusuario_ips',$this->idusuario_ips);
		$criteria->compare('asunto',$this->asunto,true);
		$criteria->compare('mensaje',$this->mensaje,true);
		$criteria->compare('fecha',$this->fecha,true);
		$criteria->compare('hora',$this->hora,true);
		$criteria->compare('id_compra',$this->id_compra,true);
		$criteria->compare('estado',$this->estado);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array('pageSize' => 10, 'route' => 'notificaciones/index'),
			'sort' => array('defaultOrder' => 'fecha DESC, hora DESC')
		));
	}

	public function detalle_compra($id_compra){
		
		$detalle_compra = array();

		$sql = "SELECT pp.desc_producto, p.estado_compra, p.estado_pago, p.payer_info_email, p.id_compra, p.id_producto_insignia, p.sms_sc, p.consumidor_email, p.consumidor_telefono, pd.id_producto AS all_id_productos, cc.descripcion AS categoria, cc.deporte, cc.abreviatura, cc.pais, tc.descripcion AS tipo, tc.abreviatura, pd.contenido_texto, pd.nombre_archivo, pd.contenido_archivo, pd.tipo_contenido, s.sc, s.desp_op
				FROM
					pagos p,
					productos_digitales pd,
					categorias_contenido cc,
					tipo_contenido tc,
					sms.smsin s,
					sms.producto pp
				WHERE
				    p.id_compra = '".$id_compra."'
				AND pp.id_producto IN(pd.id_producto)
				AND s.id_producto = pd.id_producto
				AND pd.id_categoria = cc.idcategorias_contenido
				AND pd.tipo = tc.id_tipo_de_contenido
				AND p.sms_id = s.id_sms
				AND p.fecha_pago = s.data_arrive GROUP BY s.id_producto";

		$compra = Yii::app()->db->createCommand($sql)->queryAll();

		foreach($compra as $data){
			if (($data['contenido_archivo'] != "") || ($data['contenido_archivo'] != null)) {
				$data['contenido_archivo'] = base64_encode($data['contenido_archivo']);
			}
		    $detalle_compra[] = $data;
		}
		/*echo "<pre>";
		print_r($detalle_compra);
		echo "</pre>";
		exit;*/
		return $detalle_compra;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Notificaciones the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
