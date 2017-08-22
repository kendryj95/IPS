<?php

/**
 * This is the model class for table "usuario_ips".
 *
 * The followings are the available columns in table 'usuario_ips':
 * @property integer $idusuario_ips
 * @property string $login
 * @property string $pwd
 * @property integer $estatus
 * @property string $fecha_creado
 * @property string $hora_creado
 * @property string $fecha_expiracion
 * @property string $hora_expiracion
 * @property string $tipo_usuario
 */
class UsuarioIps extends CActiveRecord
{
	public $confirm_password;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'usuario_ips';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('login, email, pwd, confirm_password, fecha_creado, hora_creado, telefono, nombres, apellidos, direccion', 'required'),
			array('estatus', 'numerical', 'integerOnly'=>true),
			array('login', 'length', 'max'=>20),
			array('pwd', 'length', 'max'=>90),
			array('confirm_password', 'length', 'max'=>90),
			array('tipo_usuario', 'length', 'max'=>45),
			// password needs to be authenticated
			array('pwd', 'authenticate'),

			array('pwd', 'safe_md5'),
			//array('pwd', 'compare', 'compareAttribute'=>'pwd'),
			array('fecha_expiracion, hora_expiracion', 'safe'),

			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idusuario_ips, email, login, pwd, confirm_password, telefono, estatus, fecha_creado, hora_creado, fecha_expiracion, hora_expiracion, tipo_usuario', 'safe', 'on'=>'search'),
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
			'idusuario_ips' => 'Idusuario Ips',
			'nombres' => 'Nombres',
			'apellidos' => 'Apellidos',
			'email' => 'Correo',
			'telefono' => 'Telefono',
			'direccion' => 'Dirección',
			'login' => 'Usuario',
			'pwd' => 'Contraseña',
			'estatus' => 'Estatus',
			'fecha_creado' => 'Fecha de registro',
			'hora_creado' => 'Hora de registro',
			'fecha_expiracion' => 'Fecha de expiración',
			'hora_expiracion' => 'Hora de expiración',
			'tipo_usuario' => 'Tipo de usuario',
			'confirm_password' => 'Confirmar contraseña'
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

		$criteria->compare('idusuario_ips',$this->idusuario_ips);
		$criteria->compare('nombres',$this->nombres,true);
		$criteria->compare('apellidos',$this->apellidos,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('telefono',$this->telefono,true);
		$criteria->compare('direccion',$this->direccion,true);
		$criteria->compare('login',$this->login,true);
		$criteria->compare('pwd',$this->pwd,true);
		$criteria->compare('estatus',$this->estatus);
		$criteria->compare('fecha_creado',$this->fecha_creado,true);
		$criteria->compare('hora_creado',$this->hora_creado,true);
		$criteria->compare('fecha_expiracion',$this->fecha_expiracion,true);
		$criteria->compare('hora_expiracion',$this->hora_expiracion,true);
		$criteria->compare('tipo_usuario',$this->tipo_usuario,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UsuarioIps the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * Authenticates the password.
	 * This is the 'authenticate' validator as declared in rules().
	 */
	public function authenticate($attribute,$params)
	{
		if(!$this->hasErrors()){
			if($this->pwd != $this->confirm_password){
				$this->addError('pwd','Las claves no coinciden');
			}
		}
	}

	public function safe_md5(){
		$this->pwd = md5($this->pwd);
	}
}
