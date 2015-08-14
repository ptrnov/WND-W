<?php
/**
 * NOTE: Nama Class harus diawali Hurup Besar
 * Server Linux 	: hurup besar/kecil bermasalah -case sensitif-
 * Server Windows 	: hurup besar/kecil tidak bermasalah
 * Author: -ptr.nov-
*/

namespace modulprj\controllers\system;

/* VARIABLE BASE YII2 Author: -YII2- */
	use Yii;
	use yii\web\Controller;
	use yii\web\NotFoundHttpException;
	use yii\filters\VerbFilter;
/* CLASS USER Author: -ptr.nov- */
use app\models\system\user\Userlogin;			/* TABLE CLASS JOIN */
use app\models\system\user\UserloginSearch;		/* TABLE CLASS SEARCH */
use app\models\system\user\PasswordResetRequestForm;
use app\models\system\user\ResetPasswordForm;
use app\models\system\user\SignupForm;
use app\models\system\user\ContactForm;
/**
 * HRD | CONTROLLER MODUL HRD .
 */
class UserController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(['Userlogin']),
                'actions' => [
                    //'delete' => ['post'],
					'save' => ['post'],
                ],
            ],
        ];
    }

    /**
     * ACTION INDEX
     */
    public function actionIndex()
    {
		/*	variable content View Modul Hrd Author: -ptr.nov- */
        $searchModel_Userlogin = new UserloginSearch();
		$dataProvider_Userlogin = $searchModel_Userlogin->search(Yii::$app->request->queryParams);
		
		return $this->render('index', [
			'searchModel_Userlogin'=>$searchModel_Userlogin,
			'dataProvider_Userlogin'=>$dataProvider_Userlogin,
        ]);
    }

    /**
	 * ACTION VIEW -> $id=PrimaryKey
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);;
		if ($model->load(Yii::$app->request->post())){
			if($model->validate()){
				if($model->save()) {
					return $this->redirect(['view', 'id' => $model->username]);	
				} 
			}
		}else {
            return $this->render('view', [
                'model' => $model,
            ]);
        }
    }

    /**
     * ACTION CREATE note | $id=PrimaryKey -> TRIGER FROM VIEW  -ptr.nov-
     */
    public function actionCreate()
    {		
        $model = new Modulset();
        if ($model->load(Yii::$app->request->post())){
				if($model->validate()){
				if($model->save()) {
					return $this->redirect(['view', 'id' => $model->username]);	
				} 
			}
		}else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * ACTION UPDATE -> $id=PrimaryKey
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->username]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * ACTION DELETE -> $id=PrimaryKey | CHANGE STATUS -> lihat Standart table status | Jangan dihapus dari record
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * CLASS TABLE FIND PrimaryKey
     * Example:  Employe::find()
     */
    protected function findModel($id)
    {
        if (($model = Userlogin::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	
	public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                /*if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
				*/
				//return $this->goBack();//.'/admin'; // Return url user menu admin -ptr.nov-
				return $this->redirect('/index.php/admin');
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }
	
}
