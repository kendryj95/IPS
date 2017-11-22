<?php

/**
 * This is the model class for table "historial_saldos_usuarios_ips".
 *
 * The followings are the available columns in table 'historial_saldos_usuarios_ips':
 * @property integer $id
 * @property integer $id_usuario
 * @property double $saldo_ips
 * @property string $cambios
 * @property string $fecha_actualizacion
 *
 * The followings are the available model relations:
 * @property UsuarioIps $idUsuario
 */
class HistorialSaldosUsuariosIps extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'historial_saldos_usuarios_ips';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_usuario, saldo_ips, cambios, fecha_actualizacion', 'required'),
			array('id_usuario', 'numerical', 'integerOnly'=>true),
			array('saldo_ips', 'numerical'),
			array('cambios', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_usuario, saldo_ips, cambios, fecha_actualizacion', 'safe', 'on'=>'search'),
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
			'idUsuario' => array(self::BELONGS_TO, 'UsuarioIps', 'id_usuario'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_usuario' => 'Id Usuario',
			'saldo_ips' => 'Saldo Ips',
			'cambios' => 'Cambios',
			'fecha_actualizacion' => 'Fecha Actualizacion',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('id_usuario',$this->id_usuario);
		$criteria->compare('saldo_ips',$this->saldo_ips);
		$criteria->compare('cambios',$this->cambios,true);
		$criteria->compare('fecha_actualizacion',$this->fecha_actualizacion,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return HistorialSaldosUsuariosIps the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
