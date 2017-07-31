<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class SignupForm extends CFormModel
{
	public $email;
	public $phone_number;
	public $login;
	public $password;
	public $confirm_password;

	private $_identity;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('email, login, password, confirm_password, phone_number', 'required'),

			array('email', 'email'),

			// password needs to be authenticated
			array('password', 'authenticate'),

			array('email, login', 'unique', 'className' => 'UsuarioIps'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'email'  => 'Correo electronico',
			'login'  => 'Usuario',
			'password'  => 'Clave',
			'confirm_password'  => 'Confirmar clave',
			'phone_number'  => 'Numero de telefono',
			'rememberMe' => 'Recordar',
		);
	}

	/**
	 * Authenticates the password.
	 * This is the 'authenticate' validator as declared in rules().
	 */
	public function authenticate($attribute,$params)
	{
		if(!$this->hasErrors()){
			if($this->password != $this->confirm_password){
				$this->addError('password','Las claves no coinciden');
			}
		}
	}
}
