<?php

/**
 * This is the model class for table "publicidad".
 *
 * The followings are the available columns in table 'publicidad':
 * @property integer $idpublicidad
 * @property integer $idtipo_publicidad
 * @property string $nombre_de_archivo
 * @property string $titulo
 * @property string $descripcion
 * @property integer $status
 */
class Publicidad extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'publicidad';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idtipo_publicidad, nombre_de_archivo, titulo', 'required'),
			array('idtipo_publicidad, status', 'numerical', 'integerOnly'=>true),
			array('nombre_de_archivo', 'length', 'max'=>250),
			array('titulo', 'length', 'max'=>45),
			array('descripcion', 'length', 'max'=>125),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idpublicidad, idtipo_publicidad, nombre_de_archivo, titulo, descripcion, status', 'safe', 'on'=>'search'),
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
			'idpublicidad' => 'Idpublicidad',
			'idtipo_publicidad' => 'Idtipo Publicidad',
			'nombre_de_archivo' => 'Nombre De Archivo',
			'titulo' => 'Titulo',
			'descripcion' => 'Descripcion',
			'status' => 'Status',
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

		$criteria->compare('idpublicidad',$this->idpublicidad);
		$criteria->compare('idtipo_publicidad',$this->idtipo_publicidad);
		$criteria->compare('nombre_de_archivo',$this->nombre_de_archivo,true);
		$criteria->compare('titulo',$this->titulo,true);
		$criteria->compare('descripcion',$this->descripcion,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Publicidad the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function findallbytypeimage($tipo){
		$list_publicidad = Yii::app()->db->createCommand("SELECT p.nombre_de_archivo, p.titulo, p.descripcion FROM insignia_payments_solutions.publicidad p, insignia_payments_solutions.tipo_publicidad t WHERE p.idtipo_publicidad = p.idtipo_publicidad AND p.status = 1 AND t.descripcion = '".$tipo."'")->queryAll();

		foreach($list_publicidad as $data){
		    $publicidad[] = $data;
		}

		return $publicidad;
	}
}
