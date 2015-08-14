<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    /*-ptr.nov- : Public Modules All*/
    'modules' => [
        'gridview' => [
            'class' => '\kartik\grid\Module',
            // enter optional module parameters below - only if you need to
            // use your own export download action or custom translation
            // message source
            // 'downloadAction' => 'gridview/export/download',
            'i18n' => [
                'class' => 'yii\i18n\PhpMessageSource',
                'basePath' => '@kvgrid/messages',
                'forceTranslation' => true
            ],
        ],
       'markdown' => [
            'class' => 'kartik\markdown\Module',
            'previewAction' => '/markdown/parse/preview',

            // the controller action route used for downloading the markdown exported file
            'downloadAction' => '/markdown/parse/download',

            // the list of custom conversion patterns for post processing
            'customConversion' => [
                '<table>' => '<table class="table table-bordered table-striped">'
            ],

            // whether to use PHP SmartyPantsTypographer to process Markdown output
            'smartyPants' => true,
        ],  
    
    ],

    /*-ptr.nov- : Public Components All*/
    'components' => [
         /* Author -ptr.nov- : Admin Menu  */
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=wnd_admin',
            'username' => 'xxx',
            'password' =>'xxx',
            'charset' => 'utf8',
        ], 
		
		/* Author -ptr.nov- : Payroll  */
        'db1' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=attpayroll',
            'username' => 'xxx',
            'password' =>'xxx',
            'charset' => 'utf8',
        ],
        'ambilkonci' =>[
            'class'=>'common\components\AmbilkeyComponent',
        ],
		
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],

        /*-ptr.nov-: Public Component UrlManager*/
        'urlManager' => [
            'enablePrettyUrl' => true, // Disable r= routes
            'showScriptName' => true, // Disable index.php
            'enableStrictParsing' => false,
            /*
			'rules'=>[
              'conatroller'=>'site/logout',
            ],
            */
        ],
        /*-ptr.nov- : Public AuthManager */
        'authManager'=>[
            'class'=>'yii\rbac\DbManager',
            'defaultRoles' => ['OWNER','KOMISARIS','CEO','GM','MANAGER','SUVERVISOR','DM','STAFF','OPS'],
            //'class'=>'yii\rbac\PhpManager',
            //'defaultRoles' => ['userGroup'],
            //'defaultRoles'=>['generic-user'],
            //'defaultRoles'=>['end-user'],
        ],

        /*-ptr.nov- : Public Permission */
        'as access'=>[
            'class'=>'mdm\admin\components\AccessControl',
            'allowActions'=>[
                '*',
                //'site/login',
                //'site/error',
            ]
        ],
        'view' => [
            'theme' => [
                'pathMap' => [
                    'modulprj/views' => '@vendor/dmstr/yii2-adminlte-asset/example-views/phundament/app'
                ],
            ],
        ],

		/*
		'curl' => [
            'class' => 'ext.Curl',
           // 'options' => array(/.. additional curl options ../)
        ];
		*/
    ],

    /*-ptr.nov- : Public Parm FOND AWSOME*/
    'params' => [ 
	//$params,
        'icon-framework' => 'fa',  // Font Awesome Icon framework
		//'HRD_EMP_UploadUrl'=>'/var/www/advanced/modulprj/web/upload/hrd/Employee/',
        'HRD_EMP_UploadUrl'=>'D:\xampp\htdocs\wnd\modulprj\web\upload\hrd\Employee',
    ],

];
