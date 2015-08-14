<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-modulprj',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'modulprj\controllers',
    'bootstrap' => ['log'],
    'modules' => [
		'admin' => [
				'class' => 'mdm\admin\Module',
				'controllerMap' => [
					 'assignment' => [
						'class' => 'mdm\admin\controllers\AssignmentController',
						'userClassName' => 'common\models\User',
						'idField' => 'id', //user_id id field of model User
					]
				],  
				/*'layout'=>'mdm\admin\views\layouts\top-menu',*/
				//'layout'=>'left-menu',
				'menus' =>[
					'assignment'=>[
						'label'=>'Grand Access'
					],
					/*'route'=> null,*/
				],
		],
	],
    'components' => [
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
        ],


        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'view' => [
            'theme' => [
                'pathMap' => [
                    'modulprj/views' => '@vendor/dmstr/yii2-adminlte-asset/example-views/phundament/app'
                ],
            ],
        ],
    ],
    'params' => $params,
];
