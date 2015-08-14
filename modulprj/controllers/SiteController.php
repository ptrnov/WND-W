<?php
namespace modulprj\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\LoginForm;
use common\components\GcodeComponent;
use yii\filters\VerbFilter;





/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        // Author: -ptr.nov- : Permission Allow No Login |index|error|login
                        'actions' => ['index', 'error','login'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        /* Author: -ptr.nov- : Split Index Before/After Login */
        if (\Yii::$app->user->isGuest) {
            $model = new LoginForm();
            return $this->render('_index_nologin', [
                'model' => $model,
            ]);
        } else {
            return $this->render('index');
        }
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
           // return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            //return $this->render('login', [
            //    'model' => $model,
            // ]);
            // SHOW MODEL render via Ajax Author: -ptr.nov-
            $js='$("#modal_login").modal("show")';
            $this->getView()->registerJs($js);
            $pk_emp= Yii::$app->ambilkonci->getKey_Employe();
            echo $pk_emp;
            return $this->render('login',['model' => $model,'pk_emp'=>$pk_emp]); //'mdl'=>$test1]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
