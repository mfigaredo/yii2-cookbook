<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=yii2basic2',
    'username' => 'root',
    'password' => 'mysql',
    'charset' => 'utf8',

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
    
    /*
    'slaveConfig' => [
		'username' => 'slave_user',
		'password' => 'slave_pass',
	],
	// list of slave configurations
	// https://www.digitalocean.com/community/tutorials/how-to-set-up-master-slave-replication-in-mysql/
	'slaves' => [
		['dsn' => 'mysql:host=127.0.0.1:3308;dbname=yii2basic2'],
	],
	*/
];
