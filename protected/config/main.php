<?php

/*if(($_SERVER['SERVER_NAME'] == 'localhost') || ($_SERVER['SERVER_NAME'] == '72.14.188.47') || ($_SERVER['SERVER_NAME'] == '192.168.1.48') || ($_SERVER['SERVER_NAME'] == '192.168.1.203')){

	//Datos F1
	$host_F1 = "192.168.1.117";//"200.109.237.18";
	$user_F1 = 'robertocanua';
	$pwd_F1 = 'KwZUkeWB';

	//Datos F2
	$host_F2 = "192.168.1.117";//"200.109.237.18";
	$user_F2 = 'robertocanua';
	$pwd_F2 = 'KwZUkeWB';

	//Datos Hostgator
	$host_Hostgator = "192.168.1.117";//"200.109.237.18";
	$user_Hostgator = 'robertocanua';//roberth.riera
	$pwd_Hostgator = 'KwZUkeWB';//WPjvzyb7na

} else {

	//Datos F1
	$host_F1 = "72.233.82.70";
	$user_F1 = 'robertocanua';
	$pwd_F1 = 'KwZUkeWB';

	//Datos F2
	$host_F2 = "72.232.85.20";
	$user_F2 = 'robertocanua';
	$pwd_F2 = 'KwZUkeWB';

	//Datos Hostgator
	$host_Hostgator = "www.insigniamobile.com.ve";
	$user_Hostgator = 'insignia_envios';
	$pwd_Hostgator = 'fkhXOF3UXhIMC2015';
}*/

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
Yii::setPathOfAlias('booster', dirname(__FILE__).'/../extensions/booster');
Yii::setPathOfAlias('shoppingCart', dirname(__FILE__).'/../extensions/shoppingCart');
Yii::setPathOfAlias('highcharts', dirname(__FILE__).'/../extensions/highcharts/highcharts');
Yii::setPathOfAlias('editable', dirname(__FILE__).'/../extensions/x-editable');
Yii::setPathOfAlias('jphpmailer', dirname(__FILE__).'/../extensions/phpmailer');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Insignia Payments Solutions',
	'timeZone' => 'America/Caracas',
    'language' => 'es',
    //'language' => 'en',
	// preloading 'log' component
	'preload'=>array('log','booster'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'12345',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		
	),

	// application components
	'components'=>array(

		'Funciones'=>array(
			'class'=>'ext.Funciones',
		),

		'user'=>array(
			'class' => 'WebUser',
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),

		'format' => array(
        	'timeFormat' => 'h:i a',
        	'dateFormat' => 'Y-m-d',
    	),

		// uncomment the following to enable URLs in path-format
		
		'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName' => false,
            'rules' => array(
                '' => 'site/index', // normal URL rules
                array(// your custom URL handler
                    'class' => 'application.components.CustomUrlRule',
                ),
            ),
        ),

		/*'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),*/

		'booster' => array(
    		'class' => 'booster.components.Booster',
		),

		'shoppingCart' => array(
			'class' => 'shoppingCart.EShoppingCart',
		),

		// uncomment the following to use a MySQL database
		
		'db'=>array(
			'connectionString' => 'mysql:host=192.168.1.117;dbname=insignia_payments_solutions_mm',
			'emulatePrepare' => true,
			'username' => 'moises.marquina',
			'password' => 'QzSgay2j',
			'charset' => 'utf8',
		),

		'db_sms'=>array(
			'class' => 'CDbConnection',
			'connectionString' => 'mysql:host=192.168.1.117;dbname=sms',
			'emulatePrepare' => true,
			'username' => 'robertocanua',
			'password' => 'KwZUkeWB',
			'charset' => 'utf8',
		),
		
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning, trace',
				),
				// uncomment the following to show log messages on web pages
				
				/*array(
					'class'=>'CWebLogRoute',
				),*/
				
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'kendry.ortiz@insignia.com.ve',
	),
);