<?php

/**
 * This is the model class for table "pagos".
 *
 * The followings are the available columns in table 'pagos':
 * @property integer $id_pago
 * @property integer $id_metodo_pago
 * @property string $fecha_pago
 * @property string $hora_pago
 * @property string $estado_compra
 * @property string $estado_pago
 * @property string $moneda
 * @property double $monto
 * @property string $payer_info_email
 * @property string $payer_id
 * @property string $id_compra
 * @property string $id_api_call
 * @property integer $id_producto
 * @property string $sms_id
 * @property string $sms_sc
 * @property string $sms_contenido
 * @property string $sms_key_name
 * @property string $redirect_url
 */
class Pagos extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'pagos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_metodo_pago, fecha_pago, hora_pago, estado_compra, estado_pago, moneda, monto, id_producto, sms_id, sms_sc, sms_contenido, sms_key_name, redirect_url', 'required'),
			array('id_metodo_pago, id_producto', 'numerical', 'integerOnly'=>true),
			array('monto', 'numerical'),
			array('estado_compra, estado_pago, payer_id', 'length', 'max'=>100),
			array('moneda', 'length', 'max'=>5),
			array('payer_info_email, id_api_call', 'length', 'max'=>200),
			array('id_compra, sms_id', 'length', 'max'=>150),
			array('sms_sc', 'length', 'max'=>20),
			array('sms_contenido, redirect_url', 'length', 'max'=>255),
			array('sms_key_name', 'length', 'max'=>250),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_pago, id_metodo_pago, fecha_pago, hora_pago, estado_compra, estado_pago, moneda, monto, payer_info_email, payer_id, id_compra, id_api_call, id_producto, sms_id, sms_sc, sms_contenido, sms_key_name, redirect_url', 'safe', 'on'=>'search'),
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
			'id_pago' => 'Id Pago',
			'id_metodo_pago' => 'Id Metodo Pago',
			'fecha_pago' => 'Fecha Pago',
			'hora_pago' => 'Hora Pago',
			'estado_compra' => 'Estado Compra',
			'estado_pago' => 'Estado Pago',
			'moneda' => 'Moneda',
			'monto' => 'Monto',
			'payer_info_email' => 'Payer Info Email',
			'payer_id' => 'Payer',
			'id_compra' => 'Id Compra',
			'id_api_call' => 'Id Api Call',
			'id_producto' => 'Id Producto',
			'sms_id' => 'Sms',
			'sms_sc' => 'Sms Sc',
			'sms_contenido' => 'Sms Contenido',
			'sms_key_name' => 'Sms Key Name',
			'redirect_url' => 'Redirect Url',
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

		$criteria->compare('id_pago',$this->id_pago);
		$criteria->compare('id_metodo_pago',$this->id_metodo_pago);
		$criteria->compare('fecha_pago',$this->fecha_pago,true);
		$criteria->compare('hora_pago',$this->hora_pago,true);
		$criteria->compare('estado_compra',$this->estado_compra,true);
		$criteria->compare('estado_pago',$this->estado_pago,true);
		$criteria->compare('moneda',$this->moneda,true);
		$criteria->compare('monto',$this->monto);
		$criteria->compare('payer_info_email',$this->payer_info_email,true);
		$criteria->compare('payer_id',$this->payer_id,true);
		$criteria->compare('id_compra',$this->id_compra,true);
		$criteria->compare('id_api_call',$this->id_api_call,true);
		$criteria->compare('id_producto',$this->id_producto);
		$criteria->compare('sms_id',$this->sms_id,true);
		$criteria->compare('sms_sc',$this->sms_sc,true);
		$criteria->compare('sms_contenido',$this->sms_contenido,true);
		$criteria->compare('sms_key_name',$this->sms_key_name,true);
		$criteria->compare('redirect_url',$this->redirect_url,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Pagos the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
