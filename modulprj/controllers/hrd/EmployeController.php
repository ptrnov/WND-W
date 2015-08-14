<?php
/**
 * NOTE: Nama Class harus diawali Hurup Besar
 * Server Linux 	: hurup besar/kecil bermasalah -case sensitif-
 * Server Windows 	: hurup besar/kecil tidak bermasalah
 * Author: -ptr.nov-
*/

namespace modulprj\controllers\hrd;

/* VARIABLE BASE YII2 Author: -YII2- */
	use Yii;
	use yii\web\Controller;
	use yii\web\NotFoundHttpException;
	use yii\filters\VerbFilter;

/* VARIABLE PRIMARY JOIN/SEARCH/FILTER/SORT Author: -ptr.nov- */
	use modulprj\models\hrd\Karyawan;			/* TABLE CLASS JOIN */
	use modulprj\models\hrd\KaryawanSearch;	    /* TABLE CLASS SEARCH */
	


	use yii\web\UploadedFile;
	
/**
 * HRD | CONTROLLER EMPLOYE .
 */
class EmployeController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(['Employe']),
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
		/*	variable content View Side Menu Author: -Eka- */
		//set menu side menu index - Array Jeson Decode
       // $side_menu=M1000::find()->findMenu('sss_berita_acara')->one()->jval;
        //$side_menu=json_decode($side_menu,true);

		/*	variable content View Employe Author: -ptr.nov- */
        $searchModel = new KaryawanSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		 
		/*	variable content View Additional Author: -ptr.nov- */ 
		//$searchFilter = $searchModel->searchALL(Yii::$app->request->queryParams);
       // $dataProvider1 = $searchModel->searchAll(Yii::$app->request->queryParams);
		
		/*SHOW ARRAY YII Author: -Devandro-*/
		//print_r($dataProvider->getModels());
		
		/*SHOW ARRAY JESON Author: -ptr.nov-*/
		//echo  \yii\helpers\Json::encode($dataProvider->getModels());
        
		return $this->render('index', [
			//'side_menu'=>$side_menu,			/* Content variable Array -SideMenu- */
            'searchModel' => $searchModel, 		/* Content variable Array -Filter Search- */
            'dataProvider' => $dataProvider,	/* Content variable Array -Class Table Join- */
            //'dataProvider1' => $dataProvider1,  /* Content variable Array Aditional -Class Table Join- */
        ]);
    }

    /**
	 * ACTION VIEW -> $id=PrimaryKey
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);;
		if ($model->load(Yii::$app->request->post())){
			$upload_file=$model->uploadFile();
			var_dump($model->validate());
			if($model->validate()){
				if($model->save()) {
					if ($upload_file !== false) {
						$path=$model->getUploadedFile();
						$upload_file->saveAs($path);
					}
					return $this->redirect(['view', 'id' => $model->EMP_ID]);	
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
        $model = new Employe();

        if ($model->load(Yii::$app->request->post())){
			$upload_file=$model->uploadFile();
			var_dump($model->validate());
			if($model->validate()){
				if($model->save()) {
					if ($upload_file !== false) {
						$path=$model->getUploadedFile();
						$upload_file->saveAs($path);
					}
					return $this->redirect(['view', 'id' => $model->EMP_ID]);	
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
            return $this->redirect(['view', 'id' => $model->EMP_ID]);
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
        if (($model = Employe::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	
	
}
